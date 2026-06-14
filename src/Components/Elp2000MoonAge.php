<?php

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use JapaneseDate\Components\Contracts\MoonAgeAlgorithm;
use JapaneseDate\Components\Traits\MoonAgeConvergenceTrait;

/**
 * ELP2000-82B 高精度月黄経計算に基づく月齢計算実装。
 *
 * 太陽と月の視黄経差から朔の時刻を反復的に求め、基準日時との差を
 * 月齢として返します。ELP2000 アルゴリズムの黄経計算特性に合わせて、
 * 計算結果が負値になった場合に朔望月分を加算して
 * 0 以上の月齢に補正する処理を行います。
 *
 * **責務:**
 * - ELP2000 黄経計算結果を用いた月齢の収束計算
 * - 計算結果が負値の場合の朔望月加算による補正
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-07
 */
class Elp2000MoonAge implements MoonAgeAlgorithm
{
    use MoonAgeConvergenceTrait;

    /**
     * 朔望月（新月から新月までの平均日数）。
     */
    private const SYNODIC_MONTH = 29.530589;

    /**
     * 既知の新月時刻（TDB ユリウス日、2000-01-06 18:14 UTC 付近）。
     *
     * 収束計算の初期値をこの基準点と平均朔望月から推定し、対象日時の
     * 直近の新月に近い値から始めることで反復回数を削減します。
     */
    private const REFERENCE_NEW_MOON_JD = 2451550.1;

    /**
     * 太陽・月の黄経計算および暦変換に使用する Astronomy インスタンス。
     */
    private Astronomy $astronomy;

    /**
     * @param Astronomy $astronomy 黄経計算・暦変換に使用する Astronomy インスタンス
     */
    public function __construct(Astronomy $astronomy)
    {
        $this->astronomy = $astronomy;
    }

    /**
     * 月齢を計算して返す。
     *
     * 太陽と月の視黄経差（ΔΛ）を使い、朔の時刻を反復的に補正しながら
     * 求め、基準日時との差を月齢として返します。
     *
     * 収束計算後の結果が負値だった場合は、朔望月（約29.530589日）を
     * 加算して 0 以上の月齢に補正します。これは ELP2000 アルゴリズム
     * 特有の処理です。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時（日本標準時）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月齢（0以上30未満の浮動小数点数）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \Exception
     * @throws \Exception
     */
    public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        $jst = new DateTimeImmutable(
            sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, (int) $hour, (int) $min, (int) $sec),
            new DateTimeZone('Asia/Tokyo')
        );
        $julian_date_0 = (int) $jst->format('U') / Astronomy::DAY_TO_SECOND_FLOAT
            + 2440587.5
            + (($sec - (int) $sec) / Astronomy::DAY_TO_SECOND_FLOAT);

        // 既知の新月を基準に、対象日時に最も近い新月のおおよその時刻を推定し、
        // そこから収束計算を始めることで ELP2000 の評価回数（反復回数）を抑える。
        // 収束条件・反復内の補正ロジックは変更しないため、最終的に収束する朔の
        // 時刻（および月齢）は従来の初期値（対象日時そのもの）から始めた場合と
        // 変わらない想定です。
        $cycles = round(($julian_date_0 - self::REFERENCE_NEW_MOON_JD) / self::SYNODIC_MONTH);
        $approxNewMoon = self::REFERENCE_NEW_MOON_JD + $cycles * self::SYNODIC_MONTH;

        $tm1 = floor($approxNewMoon);
        $tm2 = $approxNewMoon - $tm1;

        // 朔の時刻を計算
        // 誤差が±1 sec以内になったら打ち切る
        $counter = 1;
        $delta_t1 = 0;
        $delta_t2 = 1;

        while (($delta_t1 + abs($delta_t2)) > Astronomy::DAYS_PER_SEC) {
            $julian_date = $tm1 + $tm2;
            $timestamp = (int) floor(($julian_date - 2440587.5) * Astronomy::DAY_TO_SECOND_FLOAT);
            $fractionalSecond = ($julian_date - 2440587.5) * Astronomy::DAY_TO_SECOND_FLOAT - $timestamp;
            $jst = (new DateTimeImmutable("@$timestamp"))->setTimezone(new DateTimeZone('Asia/Tokyo'));
            $year = (int) $jst->format('Y');
            $month = (int) $jst->format('n');
            $day = (int) $jst->format('j');
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $hour = (int) $jst->format('G');
            /** @noinspection CallableParameterUseCaseInTypeContextInspection */
            $min = (int) $jst->format('i');
            $sec = (int) $jst->format('s') + $fractionalSecond;
            $longitude_sun = $this->astronomy->longitudeSun($year, $month, $day, $hour, $min, $sec);
            $longitude_moon = $this->astronomy->longitudeMoon($year, $month, $day, $hour, $min, $sec);

            // ΔΛ ＝Λ moon－Λ sun
            $delta_rm = $longitude_moon - $longitude_sun;

            if ($longitude_sun >= 0 && $longitude_sun <= 20 && $longitude_moon >= 300) {
                // 春分の近くで朔がある場合 ( 0 ≦Λ sun≦ 20 ) で、月の黄経Λ moon≧300 の
                // 場合には、ΔΛ ＝ 360 － ΔΛ  と計算して補正
                $delta_rm = $this->astronomy->normalizeAngle($delta_rm);
                $delta_rm = 360 - $delta_rm;
            } elseif (abs($delta_rm) > 40.0) {
                // ΔΛ の引き込み範囲 ( ±40°) を逸脱した場合には補正
                $delta_rm = $this->astronomy->normalizeAngle($delta_rm);
            }

            [$tm1, $tm2, $delta_t1, $delta_t2, $shouldBreak] = $this->applyConvergenceStep(
                $delta_rm,
                self::SYNODIC_MONTH,
                $tm1,
                $tm2,
                $julian_date_0,
                $counter
            );
            // @codeCoverageIgnoreStart
            if ($shouldBreak) {
                break;
            }
            // @codeCoverageIgnoreEnd
            $counter++;
        }

        // 時刻引数を合成
        $res = $julian_date_0 - ($tm2 + $tm1);
        if ($res < 0) {
            $res += self::SYNODIC_MONTH;
        }
        if ($res > 30) {
            $res -= 30;
        }

        return $res;
    }
}
