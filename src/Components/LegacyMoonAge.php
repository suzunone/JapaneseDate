<?php

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use JapaneseDate\Components\Contracts\MoonAgeAlgorithm;
use JapaneseDate\Components\Traits\MoonAgeConvergenceTrait;

/**
 * 従来の近似式（Legacy 太陽・月黄経計算）に基づく月齢計算実装。
 *
 * 太陽と月の視黄経差から朔の時刻を反復的に求め、基準日時との差を
 * 月齢として返します。Legacy アルゴリズムの黄経計算特性に合わせて、
 * 収束計算の1回目の反復で黄経差が負値になった場合に
 * 引き込み範囲へ補正する処理を行います。
 *
 * **責務:**
 * - Legacy 黄経計算結果を用いた月齢の収束計算
 * - 収束計算 1 回目で黄経差が負値の場合の引き込み範囲補正
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
class LegacyMoonAge implements MoonAgeAlgorithm
{
    use MoonAgeConvergenceTrait;

    /**
     * 朔望月（新月から新月までの平均日数）。
     */
    protected const SYNODIC_MONTH = 29.530589;

    /**
     * Unix エポック（1970-01-01 00:00:00 UTC）のユリウス日。
     */
    protected const UNIX_EPOCH_JD = 2440587.5;

    /**
     * 従来の月齢収束式と修正後のLegacy黄経基準を接続する内部座標差（日）。
     *
     * 標準UT JDを使いつつ、従来の収束式が前提とする内部座標を維持する。
     */
    protected const LEGACY_JD_OFFSET = 1.25;

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
     * 収束計算の 1 回目の反復で ΔΛ が負値だった場合は、
     * 引き込み範囲（±40°）に入るよう正規化して補正します。
     * これは Legacy アルゴリズム特有の処理です。
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
        $standardJulianDate = $this->jstToJulianDate($year, $month, $day, $hour, $min, $sec);
        $julian_date_0 = $standardJulianDate + self::LEGACY_JD_OFFSET;

        $tm1 = floor($julian_date_0);
        $tm2 = $julian_date_0 - $tm1;

        // 朔の時刻を計算
        // 誤差が±1 sec以内になったら打ち切る
        $counter = 1;
        $delta_t1 = 0;
        $delta_t2 = 1;

        while (abs($delta_t1 + $delta_t2) > Astronomy::DAYS_PER_SEC) {
            $julian_date = $tm1 + $tm2;
            [$year, $month, $day, $hour, $min, $sec] = $this->astronomy->jD2Gregorian($julian_date);
            $longitude_sun = $this->astronomy->longitudeSun($year, $month, $day, $hour, $min, $sec);
            $longitude_moon = $this->astronomy->longitudeMoon($year, $month, $day, $hour, $min, $sec);

            // ΔΛ ＝Λ moon－Λ sun
            $delta_rm = $longitude_moon - $longitude_sun;

            if ($counter === 1 && $delta_rm < 0) {
                // ループ1回目 で $delta_rm < 0 の場合には引き込み範囲に入るよう補正
                $delta_rm = $this->astronomy->normalizeAngle($delta_rm);
            } elseif ($longitude_sun >= 0 && $longitude_sun <= 20 && $longitude_moon >= 300) {
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
            // 春分特例等で2朔以上前の朔に収束した場合、1朔望月後を起点に直近の朔へ再収束する。
            // 再収束は近傍から始まるため counter=1 固有補正（δΛ < 0 の正規化）を適用しない。
            $approx = ($tm1 + $tm2) + self::SYNODIC_MONTH;
            $tm1 = floor($approx);
            $tm2 = $approx - $tm1;
            $counter = 1;
            $delta_t1 = 0;
            $delta_t2 = 1;
            while (abs($delta_t1 + $delta_t2) > Astronomy::DAYS_PER_SEC) {
                $julian_date = $tm1 + $tm2;
                [$year, $month, $day, $hour, $min, $sec] = $this->astronomy->jD2Gregorian($julian_date);
                $longitude_sun = $this->astronomy->longitudeSun($year, $month, $day, $hour, $min, $sec);
                $longitude_moon = $this->astronomy->longitudeMoon($year, $month, $day, $hour, $min, $sec);
                $delta_rm = $longitude_moon - $longitude_sun;
                if ($longitude_sun >= 0 && $longitude_sun <= 20 && $longitude_moon >= 300) {
                    $delta_rm = $this->astronomy->normalizeAngle($delta_rm);
                    $delta_rm = 360 - $delta_rm;
                } elseif (abs($delta_rm) > 40.0) {
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
            $res = $julian_date_0 - ($tm2 + $tm1);
            if ($res < 0) {
                $res += self::SYNODIC_MONTH;
            }
        }

        return $res;
    }

    /**
     * 日本標準時のグレゴリオ暦日時を標準的な UT ユリウス日に変換する。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時（日本標準時、小数部可）
     * @param float $min 分（小数部可）
     * @param float $sec 秒（小数部可）
     * @return float UT ユリウス日
     * @throws \Exception
     */
    protected function jstToJulianDate($year, $month, $day, $hour, $min, $sec): float
    {
        $jstMidnight = new DateTimeImmutable(
            sprintf('%04d-%02d-%02d 00:00:00', $year, $month, $day),
            new DateTimeZone('Asia/Tokyo')
        );
        $timestamp = (float) $jstMidnight->format('U')
            + $hour * 3600.0
            + $min * 60.0
            + $sec;

        return self::UNIX_EPOCH_JD + $timestamp / Astronomy::DAY_TO_SECOND_FLOAT;
    }
}
