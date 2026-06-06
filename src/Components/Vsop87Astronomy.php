<?php

namespace JapaneseDate\Components;

/**
 * VSOP87 による太陽黄経計算クラス。
 *
 * 地球の日心黄経を VSOP87 の周期項から求め、地球から見た太陽の視黄経へ変換します。
 * 二十四節気の判定では太陽黄経の境界通過日が重要になるため、従来式より高精度な
 * 太陽位置計算を利用するための {@see \JapaneseDate\Components\Astronomy} 派生実装です。
 *
 * **計算の概要:**
 * - 入力日時を天文計算用の連続ユリウス日に変換
 * - VSOP87 の周期項から地球の日心黄経を算出
 * - 180° 反転して地心から見た太陽黄経に変換
 * - 光行差・章動の簡易補正を適用し、0°〜360° に正規化
 *
 * VSOP87 は惑星運動の理論であり、月の運動を直接扱うものではありません。
 * 月齢や月相の計算は親クラスの従来実装を継承しています。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-04
 */
class Vsop87Astronomy extends Astronomy
{
    /**
     * J2000.0 のユリウス日。
     *
     * VSOP87 の時間引数は J2000.0 からの経過時間で表すため、各計算の基準値として使用します。
     */
    protected const J2000 = 2451545.0;

    /**
     * 使用中の天文計算アルゴリズム名を返します。
     *
     * @return string VSOP87 アルゴリズムを表す識別子
     */
    public function algorithmName(): string
    {
        return parent::algorithmName();
    }

    /**
     * 太陽の視黄経を求めます。
     *
     * 入力された日時を天文学用のユリウス日に変換し、VSOP87 の地球日心黄経から
     * 地心視黄経へ変換します。戻り値は 0° 以上 360° 未満に正規化された角度です。
     *
     * 同じ日時の計算結果は一時キャッシュし、二十四節気探索などで同一日時を
     * 繰り返し評価する場合の計算負荷を抑えます。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param float $day グレゴリオ暦の日。小数部を含めることができます
     * @param float $hour 時
     * @param float $min 分
     * @param float $sec 秒
     * @return float 太陽の視黄経（度）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
    {
        $key = __METHOD__ . '-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, function () use ($year, $month, $day, $hour, $min, $sec) {
            $julianDate = $this->astronomicalJulianDate($year, $month, $day, $hour, $min, $sec);

            return $this->apparentSolarLongitude($julianDate);
        });
    }

    /**
     * 天文計算で使用するユリウス日を求めます。
     *
     * PHP 標準の gregoriantojd() は日単位の整数ユリウス日を返すため、時分秒と
     * 日の小数部を加算して連続値に変換します。さらに親クラスと同じ時刻系の扱いに
     * 揃えるため、JST と UTC の差に相当する補正を差し引きます。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param float $day グレゴリオ暦の日。小数部を含めることができます
     * @param float $hour 時
     * @param float $min 分
     * @param float $sec 秒
     * @return float 天文計算用のユリウス日
     */
    protected function astronomicalJulianDate(int $year, int $month, float $day, float $hour, float $min, float $sec): float
    {
        return gregoriantojd($month, (int) floor($day), $year)
            - 0.5
            + ($hour / self::DAY_TO_HOUR_FLOAT)
            + ($min / self::DAY_TO_MINUTE_FLOAT)
            + ($sec / self::DAY_TO_SECOND_FLOAT)
            + ($day - floor($day))
            - self::JD_TIME_ZONE_ADJUSTMENT;
    }

    /**
     * ユリウス日から太陽の視黄経を求めます。
     *
     * VSOP87 で得られるのは地球の日心黄経です。地球から見た太陽の黄経は
     * その反対方向なので 180° を加え、最後に光行差と章動の簡易補正を適用します。
     *
     * @param float $julianDate 天文計算用のユリウス日
     * @return float 太陽の視黄経（度）
     */
    protected function apparentSolarLongitude(float $julianDate): float
    {
        $t = ($julianDate - self::J2000) / 365250.0;
        $earthLongitude = rad2deg($this->earthHeliocentricLongitude($t));
        $sunLongitude = $this->normalizeAngle($earthLongitude + 180.0);

        $omega = 125.04 - 1934.136 * (($julianDate - self::J2000) / 36525.0);

        return $this->normalizeAngle(
            $sunLongitude - 0.00569 - 0.00478 * sin(deg2rad($omega))
        );
    }

    /**
     * 地球の日心黄経を VSOP87 の L0〜L5 系列から求めます。
     *
     * VSOP87 の黄経は時間引数 t のべき級数として表されます。各系列を評価し、
     * L0 + L1*t + L2*t^2 ... の形で合成した後、ラジアン角として 0〜2π に正規化します。
     *
     * @param float $t J2000.0 からのユリウス千年単位の時間引数
     * @return float 地球の日心黄経（ラジアン）
     */
    protected function earthHeliocentricLongitude(float $t): float
    {
        return $this->normalizeRadians(
            $this->vsopSeries(self::L0, $t)
            + $this->vsopSeries(self::L1, $t) * $t
            + $this->vsopSeries(self::L2, $t) * $t * $t
            + $this->vsopSeries(self::L3, $t) * $t * $t * $t
            + $this->vsopSeries(self::L4, $t) * $t * $t * $t * $t
            + $this->vsopSeries(self::L5, $t) * $t * $t * $t * $t * $t
        );
    }

    /**
     * VSOP87 の 1 系列を評価します。
     *
     * 各項は A * cos(B + C * t) の形で、係数表には A, B, C の順に格納しています。
     * 係数 A は VSOP87 の慣例に従い 10^8 倍された値なので、合計後に 100000000 で割ります。
     *
     * @param array<int, array{0: float, 1: float, 2: float}> $terms VSOP87 の係数列
     * @param float $t J2000.0 からのユリウス千年単位の時間引数
     * @return float 系列の評価値（ラジアン）
     */
    protected function vsopSeries(array $terms, float $t): float
    {
        $result = 0.0;
        foreach ($terms as [$a, $b, $c]) {
            $result += $a * cos($b + $c * $t);
        }

        return $result / 100000000.0;
    }

    /**
     * ラジアン角を 0 以上 2π 未満に正規化します。
     *
     * @param float $angle 正規化前の角度（ラジアン）
     * @return float 正規化後の角度（ラジアン）
     */
    protected function normalizeRadians(float $angle): float
    {
        $twoPi = 2.0 * M_PI;

        return $angle - $twoPi * floor($angle / $twoPi);
    }

    /**
     * 地球日心黄経 L0 系列の VSOP87 係数。
     *
     * L0 は黄経の主成分です。配列の各要素は [A, B, C] を表し、
     * A * cos(B + C * t) として評価します。
     */
    protected const L0 = [
        [175347046.0, 0.0, 0.0],
        [3341656.0, 4.6692568, 6283.07585],
        [34894.0, 4.6261, 12566.1517],
        [3497.0, 2.7441, 5753.3849],
        [3418.0, 2.8289, 3.5231],
        [3136.0, 3.6277, 77713.7715],
        [2676.0, 4.4181, 7860.4194],
        [2343.0, 6.1352, 3930.2097],
        [1324.0, 0.7425, 11506.7698],
        [1273.0, 2.0371, 529.691],
        [1199.0, 1.1096, 1577.3435],
        [990.0, 5.233, 5884.927],
        [902.0, 2.045, 26.298],
        [857.0, 3.508, 398.149],
        [780.0, 1.179, 5223.694],
        [753.0, 2.533, 5507.553],
        [505.0, 4.583, 18849.228],
        [492.0, 4.205, 775.523],
        [357.0, 2.92, 0.067],
        [317.0, 5.849, 11790.629],
        [284.0, 1.899, 796.298],
        [271.0, 0.315, 10977.079],
        [243.0, 0.345, 5486.778],
        [206.0, 4.806, 2544.314],
        [205.0, 1.869, 5573.143],
        [202.0, 2.458, 6069.777],
        [156.0, 0.833, 213.299],
        [132.0, 3.411, 2942.463],
        [126.0, 1.083, 20.775],
        [115.0, 0.645, 0.98],
        [103.0, 0.636, 4694.003],
        [102.0, 0.976, 15720.839],
        [102.0, 4.267, 7.114],
        [99.0, 6.21, 2146.17],
        [98.0, 0.68, 155.42],
        [86.0, 5.98, 161000.69],
        [85.0, 1.3, 6275.96],
        [85.0, 3.67, 71430.7],
        [80.0, 1.81, 17260.15],
        [79.0, 3.04, 12036.46],
        [75.0, 1.76, 5088.63],
        [74.0, 3.5, 3154.69],
        [74.0, 4.68, 801.82],
        [70.0, 0.83, 9437.76],
        [62.0, 3.98, 8827.39],
        [61.0, 1.82, 7084.9],
        [57.0, 2.78, 6286.6],
        [56.0, 4.39, 14143.5],
        [56.0, 3.47, 6279.55],
        [52.0, 0.19, 12139.55],
        [52.0, 1.33, 1748.02],
        [51.0, 0.28, 5856.48],
        [49.0, 0.49, 1194.45],
        [41.0, 5.37, 8429.24],
        [41.0, 2.4, 19651.05],
        [39.0, 6.17, 10447.39],
        [37.0, 6.04, 10213.29],
        [37.0, 2.57, 1059.38],
        [36.0, 1.71, 2352.87],
        [36.0, 1.78, 6812.77],
        [33.0, 0.59, 17789.85],
        [30.0, 0.44, 83996.85],
        [30.0, 2.74, 1349.87],
        [25.0, 3.16, 4690.48],
    ];

    /**
     * 地球日心黄経 L1 系列の VSOP87 係数。
     *
     * L1 は時間引数 t の 1 次項に掛ける系列です。
     */
    protected const L1 = [
        [628331966747.0, 0.0, 0.0],
        [206059.0, 2.678235, 6283.07585],
        [4303.0, 2.6351, 12566.1517],
        [425.0, 1.59, 3.523],
        [119.0, 5.796, 26.298],
        [109.0, 2.966, 1577.344],
        [93.0, 2.59, 18849.23],
        [72.0, 1.14, 529.69],
        [68.0, 1.87, 398.15],
        [67.0, 4.41, 5507.55],
        [59.0, 2.89, 5223.69],
        [56.0, 2.17, 155.42],
        [45.0, 0.4, 796.3],
        [36.0, 0.47, 775.52],
        [29.0, 2.65, 7.11],
        [21.0, 5.34, 0.98],
        [19.0, 1.85, 5486.78],
        [19.0, 4.97, 213.3],
        [17.0, 2.99, 6275.96],
        [16.0, 0.03, 2544.31],
        [16.0, 1.43, 2146.17],
        [15.0, 1.21, 10977.08],
        [12.0, 2.83, 1748.02],
        [12.0, 3.26, 5088.63],
        [12.0, 5.27, 1194.45],
        [12.0, 2.08, 4694.0],
        [11.0, 0.77, 553.57],
        [10.0, 1.3, 6286.6],
        [10.0, 4.24, 1349.87],
        [9.0, 2.7, 242.73],
        [9.0, 5.64, 951.72],
        [8.0, 5.3, 2352.87],
        [6.0, 2.65, 9437.76],
        [6.0, 4.67, 4690.48],
    ];

    /**
     * 地球日心黄経 L2 系列の VSOP87 係数。
     *
     * L2 は時間引数 t の 2 次項に掛ける系列です。
     */
    protected const L2 = [
        [52919.0, 0.0, 0.0],
        [8720.0, 1.0721, 6283.0758],
        [309.0, 0.867, 12566.152],
        [27.0, 0.05, 3.52],
        [16.0, 5.19, 26.3],
        [16.0, 3.68, 155.42],
        [10.0, 0.76, 18849.23],
        [9.0, 2.06, 77713.77],
        [7.0, 0.83, 775.52],
        [5.0, 4.66, 1577.34],
        [4.0, 1.03, 7.11],
        [4.0, 3.44, 5573.14],
        [3.0, 5.14, 796.3],
        [3.0, 6.05, 5507.55],
        [3.0, 1.19, 242.73],
        [3.0, 6.12, 529.69],
        [3.0, 0.31, 398.15],
        [3.0, 2.28, 553.57],
        [2.0, 4.38, 5223.69],
        [2.0, 3.75, 0.98],
    ];

    /**
     * 地球日心黄経 L3 系列の VSOP87 係数。
     *
     * L3 は時間引数 t の 3 次項に掛ける系列です。
     */
    protected const L3 = [
        [289.0, 5.844, 6283.076],
        [35.0, 0.0, 0.0],
        [17.0, 5.49, 12566.15],
        [3.0, 5.2, 155.42],
        [1.0, 4.72, 3.52],
        [1.0, 5.3, 18849.23],
        [1.0, 5.97, 242.73],
    ];

    /**
     * 地球日心黄経 L4 系列の VSOP87 係数。
     *
     * L4 は時間引数 t の 4 次項に掛ける系列です。
     */
    protected const L4 = [
        [114.0, 3.142, 0.0],
        [8.0, 4.13, 6283.08],
        [1.0, 3.84, 12566.15],
    ];

    /**
     * 地球日心黄経 L5 系列の VSOP87 係数。
     *
     * L5 は時間引数 t の 5 次項に掛ける系列です。
     */
    protected const L5 = [
        [1.0, 3.14, 0.0],
    ];
}
