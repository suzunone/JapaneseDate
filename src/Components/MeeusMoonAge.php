<?php

namespace JapaneseDate\Components;

use InvalidArgumentException;
use JapaneseDate\Components\Contracts\MoonAgeAlgorithm;
use JapaneseDate\Exceptions\MoonAgeConvergenceException;

/**
 * Meeus AA2 Chapter 47 に基づく月齢計算実装。
 *
 * PHP DateTime/Carbon を使わず、{@see MeeusMoon::gregorianToJd()} /
 * {@see MeeusMoon::jdToGregorianYmd()} を呼んで JST/UT/JD 変換を行う。
 *
 * 収束失敗時は {@see MoonAgeConvergenceException} をスロー。
 * Elp2000MoonAge の「入力時刻を朔として返す」静かなフォールバックは継承しない。
 *
 * **黄経差の収束判定:** 符号付き最短角差 [-180°, 180°) の絶対値と補正量の
 * 絶対値で判定する。春分専用分岐や符号を失う分岐は廃止する。
 *
 * **未来朔への収束:** 月齢が負値（= 未来朔に収束）になった場合は、
 * 平均朔望月で折り返さず、実際の直前朔を再探索する。
 *
 * **反復上限:** 1 回の朔探索で最大 30 回、moonAge() 全体で最大 60 回。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-13
 */
class MeeusMoonAge implements MoonAgeAlgorithm
{
    /**
     * 朔望月（新月から新月までの平均日数）。
     */
    private const SYNODIC_MONTH = 29.530589;

    /**
     * 既知の新月時刻（UT JD、USNO 2000-01-06 18:14 UTC）。
     *
     * 収束計算の初期値をこの基準点と平均朔望月から推定し、対象日時の
     * 直近の新月に近い値から始めることで反復回数を削減する。
     */
    private const REFERENCE_NEW_MOON_JD = 2451550.259722;

    /**
     * 太陽・月の黄経計算に使用する Astronomy インスタンス。
     */
    private Astronomy $astronomy;

    /**
     * @param Astronomy $astronomy 黄経計算に使用する Astronomy インスタンス
     */
    public function __construct(Astronomy $astronomy)
    {
        $this->astronomy = $astronomy;
    }

    /**
     * 月齢を計算して返す。
     *
     * PHP DateTime/Carbon を使わず、MeeusMoon の static 変換メソッドを利用する。
     * 収束失敗時は MoonAgeConvergenceException をスローする（Elp2000MoonAge とは異なる挙動）。
     * 黄経差は符号付き最短角差 [-180°, 180°) の絶対値で収束判定する。
     * 未来朔に収束した場合は直前朔を再探索する（合計最大 60 反復）。
     *
     * @param int $year JST グレゴリオ暦の年
     * @param int $month JST グレゴリオ暦の月
     * @param int $day JST グレゴリオ暦の日
     * @param float $hour JST の時（小数許容）
     * @param float $min JST の分（小数許容）
     * @param float $sec JST の秒（小数許容）
     * @return float 月齢（朔からの経過日数）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException 朔の時刻が 30 反復以内に収束しなかった場合
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        if (!is_finite($hour) || !is_finite($min) || !is_finite($sec)) {
            throw new InvalidArgumentException('Hour/min/sec must be finite numbers.');
        }

        // JST → UT JD（全小数部を秒へ換算、PHP DateTime 非依存）
        $jdMidnight = MeeusMoon::gregorianToJd($year, $month, $day);
        $totalSec = $hour * 3600.0 + $min * 60.0 + $sec;
        $julian_date_0 = $jdMidnight + ($totalSec - 9.0 * 3600.0) / 86400.0;
        /** @noinspection NotOptimalIfConditionsInspection */
        if (!is_finite($julian_date_0) || ($julian_date_0 + 1.0 / 86400.0) <= $julian_date_0) {
            throw new InvalidArgumentException('Input UT JD non-finite or beyond resolution');
        }

        // Elp2000MoonAge と同じ初期値推定: 基準朔と平均朔望月から最寄りの朔を推定
        $cycles = round(($julian_date_0 - self::REFERENCE_NEW_MOON_JD) / self::SYNODIC_MONTH);
        $approxNewMoon = self::REFERENCE_NEW_MOON_JD + $cycles * self::SYNODIC_MONTH;

        // 朔探索（最大 30 反復、収束失敗で例外）
        $newMoonJd = $this->convergeNewMoon($approxNewMoon);

        // 未来朔（月齢が負）の場合は 1 朔望月前から直前朔を再探索（合計最大 60 反復）
        if ($newMoonJd > $julian_date_0) {
            $newMoonJd = $this->convergeNewMoon($newMoonJd - self::SYNODIC_MONTH);
        }

        return $julian_date_0 - $newMoonJd;
    }

    /**
     * 推定朔時刻（UT JD）から実際の朔時刻へ収束させる。
     *
     * 最大 30 反復。収束条件: 補正量の絶対値が 1 秒（1/86400 日）以下。
     * 30 回で収束しなければ MoonAgeConvergenceException をスローする。
     *
     * 1 秒の月相対運動角 = 1 sec / 86400 / SYNODIC_MONTH × 360° ≈ 1.41e-4°
     *
     * @param float $approxJd 推定朔時刻（UT JD）
     * @return float 収束した朔時刻（UT JD）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\MoonAgeConvergenceException 30 反復で収束しなかった場合
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \Exception
     */
    private function convergeNewMoon(float $approxJd): float
    {
        $tm = $approxJd;

        for ($counter = 1; $counter <= 30; $counter++) {
            // UT JD → UTC 年月日時分秒
            [$utcYear, $utcMonth, $utcDay] = MeeusMoon::jdToGregorianYmd($tm);
            $dayFrac = ($tm + 0.5) - floor($tm + 0.5);
            $hourFloat = $dayFrac * 24.0;
            $hourInt = (int)$hourFloat;
            $minFloat = ($hourFloat - $hourInt) * 60.0;
            $minInt = (int)$minFloat;
            $secFloat = ($minFloat - $minInt) * 60.0;

            // UTC → JST（+9時間）
            $jstHour = $hourInt + 9;
            $jstDay = $utcDay;
            $jstMonth = $utcMonth;
            $jstYear = $utcYear;
            if ($jstHour >= 24) {
                $jstHour -= 24;
                // 翌日へ繰り越し（簡易）
                $nextJd = MeeusMoon::gregorianToJd($utcYear, $utcMonth, $utcDay) + 1.0;
                [$jstYear, $jstMonth, $jstDay] = MeeusMoon::jdToGregorianYmd($nextJd);
            }

            $lonSun  = $this->astronomy->longitudeSun($jstYear, $jstMonth, $jstDay, (float)$jstHour, (float)$minInt, $secFloat);
            $lonMoon = $this->astronomy->longitudeMoon($jstYear, $jstMonth, $jstDay, (float)$jstHour, (float)$minInt, $secFloat);

            // 符号付き最短角差 [-180°, 180°)
            $deltaRm = $lonMoon - $lonSun;
            $deltaRm = fmod($deltaRm + 540.0, 360.0) - 180.0;

            // 時刻補正量（日数単位）
            $deltaT = $deltaRm * self::SYNODIC_MONTH / 360.0;
            $tm -= $deltaT;

            // 収束判定: 補正量の絶対値が 1 秒（1/86400 日）以下
            if (abs($deltaT) * 86400.0 <= 1.0) {
                return $tm;
            }
        }

        throw new MoonAgeConvergenceException(
            sprintf('Moon age convergence failed after 30 iterations (approxJd=%.6f)', $approxJd)
        );
    }
}
