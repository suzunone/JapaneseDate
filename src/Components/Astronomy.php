<?php

namespace JapaneseDate\Components;

use DateTimeZone;
use JapaneseDate\Components\Traits\OneTimeCacheTrait;
use JapaneseDate\DateTime;

class Astronomy
{
    use OneTimeCacheTrait;

    public const DAY_TO_HOUR_FLOAT = 24.0;

    public const DAY_TO_MINUTE_FLOAT = 1440.0;

    public const DAY_TO_SECOND_FLOAT = 86400.0;

    /**
     * 9/24
     */
    public const JD_TIME_ZONE_ADJUSTMENT = 0.375;

    /**
     * 1.0 / 86400.0;
     *  @var float
     */
    public const DAYS_PER_SEC = 0.00001157407;

    /**
     * $base_time = DateTime::factory(
     * '2000-01-02 12:00:00',
     * new DateTimeZone('UTC')
     * )->timestamp;
     *
     * @var int
     */
    public const BASE_TIME = 946814400;

    /**
     * @return static
     */
    public static function factory(): self
    {
        static $instance;

        if (!$instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * 月齢を求める（視黄経）
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour , $min, $sec 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return    float 月齢（視黄経）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function moonAge($year, $month, $day, $hour, $min, $sec): float
    {
        $julian_date_0 = $this->gregorian2JD($year, $month, $day, $hour, $min, $sec) + self::JD_TIME_ZONE_ADJUSTMENT;

        $tm1 = floor($julian_date_0);
        $tm2 = $julian_date_0 - $tm1;

        // 朔の時刻を計算
        // 誤差が±1 sec以内になったら打ち切る
        $counter = 1;
        $delta_t1 = 0;
        $delta_t2 = 1;

        while (($delta_t1 + abs($delta_t2)) > self::DAYS_PER_SEC) {
            $julian_date = $tm1 + $tm2;
            [$year, $month, $day, $hour, $min, $sec] = $this->jD2Gregorian($julian_date);
            $longitude_sun = $this->longitudeSun($year, $month, $day, $hour, $min, $sec);
            $longitude_moon = $this->longitudeMoon($year, $month, $day, $hour, $min, $sec);

            // ΔΛ ＝Λ moon－Λ sun
            $delta_rm = $longitude_moon - $longitude_sun;

            if ($counter === 1 && $delta_rm < 0) {
                // ループ1回目 で $delta_rm < 0 の場合には引き込み範囲に入るよう補正
                $delta_rm = $this->normalizeAngle($delta_rm);
            } elseif ($longitude_sun >= 0 && $longitude_sun <= 20 && $longitude_moon >= 300) {
                // 春分の近くで朔がある場合 ( 0 ≦Λ sun≦ 20 ) で、月の黄経Λ moon≧300 の
                // 場合には、ΔΛ ＝ 360 － ΔΛ  と計算して補正
                $delta_rm = $this->normalizeAngle($delta_rm);
                $delta_rm = 360 - $delta_rm;
            } elseif (abs($delta_rm) > 40.0) {
                // ΔΛ の引き込み範囲 ( ±40°) を逸脱した場合には補正
                $delta_rm = $this->normalizeAngle($delta_rm);
            }

            // 時刻引数の補正値 Δt
            $delta_t2 = $delta_rm * 29.530589 / 360.0;
            $delta_t1 = floor($delta_t2);
            $delta_t2 -= $delta_t1;

            // 時刻引数の補正
            $tm1 -= $delta_t1;
            $tm2 -= $delta_t2;
            if ($tm2 < 0) {
                $tm2++;
                $tm1--;
            }

            // @codeCoverageIgnoreStart
            if ($counter === 15 && abs($delta_t1 + $delta_t2) > self::DAYS_PER_SEC) {
                // ループ回数が15回になったら、初期値を-26
                $tm1 = floor($julian_date_0 - 26);
                $tm2 = 0;
            } elseif ($counter > 30 && abs($delta_t1 + $delta_t2) > self::DAYS_PER_SEC) {
                // 初期値を補正したにも関わらず振動を続ける場合は、
                // 初期値を答えとして返して強制的にループを抜け出して異常終了
                $tm1 = $julian_date_0;
                $tm2 = 0;

                break;
            }
            // @codeCoverageIgnoreEnd
            $counter++;
        }

        // 時刻引数を合成
        $res = $julian_date_0 - ($tm2 + $tm1);
        if ($res > 30) {
            $res -= 30;
        }

        return $res;
    }

    /**
     * グレゴリオ暦→ユリウス日 変換
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour , $min, $sec 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return    float ユリウス日
     */
    public function gregorian2JD($year, $month, $day, $hour, $min, $sec): float
    {
        $julian_date = gregoriantojd($month, $day, $year);
        $julian_date += $hour / self::DAY_TO_HOUR_FLOAT + $min / self::DAY_TO_MINUTE_FLOAT + $sec / self::DAY_TO_SECOND_FLOAT;

        return $julian_date;
    }

    /**
     * ユリウス日⇒グレゴリオ暦　変換
     *
     * @param float $jd ユリウス日
     * @return    array($year, $month, $day, $hour, $min, $sec)  西暦年月日，世界時
     */
    public function jD2Gregorian($jd): array
    {
        $cal = cal_from_jd(floor($jd), CAL_GREGORIAN);

        $time = 86400 * ($jd - floor($jd));
        $hour = floor($time / 3600.0);
        $min = floor(($time - 3600 * $hour) / 60.0);
        $sec = floor($time - 3600 * $hour - 60 * $min);

        return [$cal['year'], $cal['month'], $cal['day'], $hour, $min, $sec];
    }

    /**
     * 太陽の黄経計算（視黄経）
     *
     * @param int $year
     * @param int $month
     * @param float $day
     * @param float $hour
     * @param float $min
     * @param float $sec
     * @return    float 太陽の黄経（視黄経）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function longitudeSun($year, $month, $day, $hour, $min, $sec): float
    {
        $key = __METHOD__ . '-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, function () use ($year, $month, $day, $hour, $min, $sec) {
            $julian_year = $this->gregorian2JY($year, $month, $day, $hour, $min, $sec);

            return $this->jy2LongitudeSun($julian_year);
        });
    }

    /**
     * 2000からの経過年数
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour
     * @param float $min
     * @param float $sec
     * @return float
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function gregorian2JY($year, $month, $day, $hour, $min, $sec): float
    {
        $timestamp = DateTime::factory(
            implode('-', [$year, $month, $day]) . ' ' . implode(':', [$hour, $min, $sec]),
            new DateTimeZone('UTC')
        )->timestamp;

        $diff_time = $timestamp - self::BASE_TIME;

        return ($diff_time + 32400.0) / 31557600.0;
    }

    /**
     * 太陽の黄経計算（視黄経）
     *
     * @param float $julian_year 2000.0からの経過年数
     * @return    float 太陽の黄経（視黄経）
     */
    public function jy2LongitudeSun($julian_year): float
    {
        $terms = [
            [0.0003, 329.7, 44.43],
            [0.0003, 352.5, 1079.97],
            [0.0004, 21.1, 720.02],
            [0.0004, 157.3, 299.30],
            [0.0004, 234.9, 315.56],
            [0.0005, 291.2, 22.81],
            [0.0005, 207.4, 1.50],
            [0.0006, 29.8, 337.18],
            [0.0007, 206.8, 30.35],
            [0.0007, 153.3, 90.38],
            [0.0008, 132.5, 659.29],
            [0.0013, 81.4, 225.18],
            [0.0015, 343.2, 450.37],
            [0.0018, 251.3, 0.20],
            [0.0018, 297.8, 4452.67],
            [0.0020, 247.1, 329.64],
            [0.0048, 234.95, 19.341],
            [0.0200, 355.05, 719.981],
        ];

        $res = $this->sumPeriodicTerms($terms, $julian_year);
        $res += (1.9146 - 0.00005 * $julian_year) * sin(deg2rad($this->normalizeAngle(357.538 + 359.991 * $julian_year)));
        $res += $this->normalizeAngle(280.4603 + 360.00769 * $julian_year);

        return $this->normalizeAngle($res);
    }

    /**
     * 角度の正規化（$angle を 0≦$angle＜360 にする）
     *
     * @param float $angle 角度
     * @return    float 角度（正規化後）
     */
    public function normalizeAngle($angle): float
    {
        return $angle - 360.0 * floor($angle / 360.0);
    }

    /**
     * 月の黄経計算（視黄経）
     *
     * @param int $year グレゴリオ暦
     * @param int $month
     * @param int $day
     * @param float $hour 時
     * @param float $min 分
     * @param float $sec 秒
     * @return    float 月の黄経（視黄経）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function longitudeMoon($year, $month, $day, $hour, $min, $sec): float
    {
        $key = __METHOD__ . '-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, function () use ($year, $month, $day, $hour, $min, $sec) {
            $julian_year = $this->gregorian2JY($year, $month, $day, $hour, $min, $sec);

            return $this->jY2LongitudeMoon($julian_year);
        });
    }

    /**
     * 月の黄経計算（視黄経）
     *
     * @param float $julian_year 2000.0からの経過年数
     * @return    float 月の黄経（視黄経）
     */
    public function jY2LongitudeMoon($julian_year): float
    {
        $tmp = $this->sumPeriodicTerms([
            [0.0006, 54.0, 19.3],
            [0.0006, 71.0, 0.2],
            [0.0020, 55.0, 19.34],
            [0.0040, 119.5, 1.33],
        ], $julian_year);

        $rm_moon = $this->sumPeriodicTerms([
            [0.0003, 280.0, 23221.3],
            [0.0003, 161.0, 40.7],
            [0.0003, 311.0, 5492.0],
            [0.0003, 147.0, 18089.3],
            [0.0003, 66.0, 3494.7],
            [0.0003, 83.0, 3814.0],
            [0.0004, 20.0, 720.0],
            [0.0004, 71.0, 9584.7],
            [0.0004, 278.0, 120.1],
            [0.0004, 313.0, 398.7],
            [0.0005, 332.0, 5091.3],
            [0.0005, 114.0, 17450.7],
            [0.0005, 181.0, 19088.0],
            [0.0005, 247.0, 22582.7],
            [0.0006, 128.0, 1118.7],
            [0.0007, 216.0, 278.6],
            [0.0007, 275.0, 4853.3],
            [0.0007, 140.0, 4052.0],
            [0.0008, 204.0, 7906.7],
            [0.0008, 188.0, 14037.3],
            [0.0009, 218.0, 8586.0],
            [0.0011, 276.5, 19208.02],
            [0.0012, 339.0, 12678.71],
            [0.0016, 242.2, 18569.38],
            [0.0018, 4.1, 4013.29],
            [0.0020, 55.0, 19.34],
            [0.0021, 105.6, 3413.37],
            [0.0021, 175.1, 719.98],
            [0.0021, 87.5, 9903.97],
            [0.0022, 240.6, 8185.36],
            [0.0024, 252.8, 9224.66],
            [0.0024, 211.9, 988.63],
            [0.0026, 107.2, 13797.39],
            [0.0027, 272.5, 9183.99],
            [0.0037, 349.1, 5410.62],
            [0.0039, 111.3, 17810.68],
            [0.0040, 119.5, 1.33],
            [0.0040, 145.6, 18449.32],
            [0.0040, 13.2, 13317.34],
            [0.0048, 235.0, 19.34],
            [0.0050, 295.4, 4812.66],
            [0.0052, 197.2, 319.32],
            [0.0068, 53.2, 9265.33],
            [0.0079, 278.2, 4493.34],
            [0.0085, 201.5, 8266.71],
            [0.0100, 44.89, 14315.966],
            [0.0107, 336.44, 13038.696],
            [0.0110, 231.59, 4892.052],
            [0.0125, 141.51, 14436.029],
            [0.0153, 130.84, 758.698],
            [0.0305, 312.49, 5131.979],
            [0.0348, 117.84, 4452.671],
            [0.0410, 137.43, 4411.998],
            [0.0459, 238.18, 8545.352],
            [0.0533, 10.66, 13677.331],
            [0.0572, 103.21, 3773.363],
            [0.0588, 214.22, 638.635],
            [0.1143, 6.546, 9664.0404],
            [0.1856, 177.525, 359.9905],
            [0.2136, 269.926, 9543.9773],
            [0.6583, 235.700, 8905.3422],
            [1.2740, 100.738, 4133.3536],
        ], $julian_year);
        $rm_moon += 6.2887 * sin(deg2rad($this->normalizeAngle(134.961 + 4771.9886 * $julian_year + $tmp)));

        return $this->normalizeAngle(
            $rm_moon + $this->normalizeAngle(218.3161 + 4812.67881 * $julian_year)
        );
    }

    private function sumPeriodicTerms(array $terms, float $julian_year): float
    {
        $result = 0.0;
        foreach ($terms as [$amplitude, $phase, $speed]) {
            $result += $amplitude * sin(deg2rad($this->normalizeAngle($phase + $speed * $julian_year)));
        }

        return $result;
    }
}
