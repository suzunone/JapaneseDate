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
    protected const SYNODIC_MONTH = 29.530589;

    /**
     * UNIX エポック（1970-01-01 00:00:00 UTC）のユリウス日。
     */
    protected const UNIX_EPOCH_JD = 2440587.5;

    /**
     * 既知の新月時刻（TDB ユリウス日、2000-01-06 18:14 UTC 付近）。
     *
     * 収束計算の初期値をこの基準点と平均朔望月から推定し、対象日時の
     * 直近の新月に近い値から始めることで反復回数を削減します。
     */
    protected const REFERENCE_NEW_MOON_JD = 2451550.1;

    /**
     * 太陽・月の黄経計算および暦変換に使用する Astronomy インスタンス。
     * @var \JapaneseDate\Components\Astronomy
     */
    protected $astronomy;

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
     */
    public function moonAge($year, $month, $day, $hour, $min, $sec): float
    {
        $jst = new DateTimeImmutable(
            sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, (int) $hour, (int) $min, (int) $sec),
            new DateTimeZone('Asia/Tokyo')
        );
        $julian_date_0 = (int) $jst->format('U') / Astronomy::DAY_TO_SECOND_FLOAT
            + self::UNIX_EPOCH_JD
            + (($sec - (int) $sec) / Astronomy::DAY_TO_SECOND_FLOAT);

        // 既知の新月を基準に、対象日時に最も近い新月のおおよその時刻を推定し、
        // そこから収束計算を始めることで ELP2000 の評価回数（反復回数）を抑える。
        $cycles = round(($julian_date_0 - self::REFERENCE_NEW_MOON_JD) / self::SYNODIC_MONTH);
        $approxNewMoon = self::REFERENCE_NEW_MOON_JD + $cycles * self::SYNODIC_MONTH;

        // 朔の時刻を収束計算する
        $newMoonJd = $this->findNewMoonJd($approxNewMoon, $julian_date_0);

        // round() により approxNewMoon が次の朔を指した場合、直前の朔へ再収束する
        if ($newMoonJd > $julian_date_0) {
            $newMoonJd = $this->findNewMoonJd($newMoonJd - self::SYNODIC_MONTH, $julian_date_0);
        }

        // 時刻引数を合成
        $res = $julian_date_0 - $newMoonJd;
        if ($res < 0) {
            $res += self::SYNODIC_MONTH;
        }
        if ($res > 30) {
            $res -= self::SYNODIC_MONTH;
        }

        return $res;
    }

    /**
     * ユリウス日を JST の年月日時分秒に分解する。
     *
     * @param float $julianDate ユリウス日
     * @return array{0: int, 1: int, 2: int, 3: int, 4: int, 5: float} [year, month, day, hour, min, sec]
     */
    protected function jdToJstComponents($julianDate): array
    {
        $timestamp = (int) floor(($julianDate - self::UNIX_EPOCH_JD) * Astronomy::DAY_TO_SECOND_FLOAT);
        $fractionalSecond = ($julianDate - self::UNIX_EPOCH_JD) * Astronomy::DAY_TO_SECOND_FLOAT - $timestamp;
        $jst = (new DateTimeImmutable("@$timestamp"))->setTimezone(new DateTimeZone('Asia/Tokyo'));

        return [
            (int) $jst->format('Y'),
            (int) $jst->format('n'),
            (int) $jst->format('j'),
            (int) $jst->format('G'),
            (int) $jst->format('i'),
            (int) $jst->format('s') + $fractionalSecond,
        ];
    }

    /**
     * 与えられた近似ユリウス日を起点として朔の時刻を収束計算し、朔のユリウス日を返す。
     *
     * @param float $approxJd 収束計算の開始点（おおよその朔のユリウス日）
     * @param float $julianDate0 計算基準のユリウス日（15回・30回の安全弁リセット基準）
     * @return float 収束後の朔のユリウス日
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \Exception
     */
    protected function findNewMoonJd($approxJd, $julianDate0): float
    {
        $tm1 = floor($approxJd);
        $tm2 = $approxJd - $tm1;
        $counter = 1;
        $delta_t1 = 0;
        $delta_t2 = 1;

        while (abs($delta_t1 + $delta_t2) > Astronomy::DAYS_PER_SEC) {
            [$year, $month, $day, $hour, $min, $sec] = $this->jdToJstComponents($tm1 + $tm2);
            $longitude_sun = $this->astronomy->longitudeSun($year, $month, $day, $hour, $min, $sec);
            $longitude_moon = $this->astronomy->longitudeMoonFast($year, $month, $day, $hour, $min, $sec);

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
                $julianDate0,
                $counter
            );
            // @codeCoverageIgnoreStart
            if ($shouldBreak) {
                break;
            }
            // @codeCoverageIgnoreEnd
            $counter++;
        }

        // フル精度スナップ: 縮約収束後に ELP2000 フル級数で詰める（最大5回）。
        // 縮約誤差（ΔΛ_full - ΔΛ_reduced、最大数秒相当）を解消し、
        // フル精度のみで収束した場合と同じ朔 JD へ揃える。
        // applyConvergenceStep は使わず（カウンタ安全弁の誤作動防止）、ステップを直接計算する。
        $snapDeltaT1 = 1;
        $snapDeltaT2 = 0;
        $snapMaxIter = 5;
        while (abs($snapDeltaT1 + $snapDeltaT2) > Astronomy::DAYS_PER_SEC && $snapMaxIter-- > 0) {
            [$snapYear, $snapMonth, $snapDay, $snapHour, $snapMin, $snapSec] = $this->jdToJstComponents($tm1 + $tm2);

            $lonSun  = $this->astronomy->longitudeSun($snapYear, $snapMonth, $snapDay, $snapHour, $snapMin, $snapSec);
            $lonMoon = $this->astronomy->longitudeMoon($snapYear, $snapMonth, $snapDay, $snapHour, $snapMin, $snapSec);

            $deltaRm = $lonMoon - $lonSun;
            if ($lonSun >= 0 && $lonSun <= 20 && $lonMoon >= 300) {
                $deltaRm = $this->astronomy->normalizeAngle($deltaRm);
                $deltaRm = 360 - $deltaRm;
            } elseif (abs($deltaRm) > 40.0) {
                $deltaRm = $this->astronomy->normalizeAngle($deltaRm);
            }

            $snapDeltaT2 = $deltaRm * self::SYNODIC_MONTH / 360.0;
            $snapDeltaT1 = floor($snapDeltaT2);
            $snapDeltaT2 -= $snapDeltaT1;
            $tm1 -= $snapDeltaT1;
            $tm2 -= $snapDeltaT2;
            if ($tm2 < 0) {
                $tm2++;
                $tm1--;
            }
        }

        return $tm1 + $tm2;
    }
}
