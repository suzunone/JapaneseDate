<?php

/**
 * 月の位相計算
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate\Components;

use Carbon\Carbon;
use DateTime;

/**
 * Class Moon
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 6.3.0
 */
class Moon
{
    /**
     * 新月から新月の平均期間
     * @var float synmonth
     */
    protected float $synmonth = 29.53058868;

    /**
     * 与えられた基準日の平均新月時刻を計算する。
     *
     * この関数の引数$kは、事前に計算された朔望月指数であり、次のように与えられる：
     * $k = (年 - 1900) * 12.3685
     * ここで、yearは年号と端数年号で表されます。
     *
     * @param float $date
     * @param float $k
     * @return float
     */
    protected function meanPhase(float $date, float $k): float
    {
        // Time in Julian centuries from 1900 January 0.5
        $jt = ($date - 2415020.0) / 36525;
        $t2 = $jt * $jt;
        $t3 = $t2 * $jt;

        return 2415020.75933 + $this->synmonth * $k
            + 0.0001178 * $t2
            - 0.000000155 * $t3
            + 0.00033 * sin(deg2rad(166.56 + 132.87 * $jt - 0.009173 * $t2));
    }

    /**
     * 新月の平均位相から補正された位相時間を取得する
     *
     * @param float $k
     * @param float $phase
     * @return float|null
     */
    protected function truePhase(float $k, float $phase): ?float
    {
        // Add phase to new moon time
        $k += $phase;
        // Time in Julian centuries from 1900 January 0.5
        $t = $k / 1236.85;

        // 2乗
        $t2 = $t * $t;
        // 3乗
        $t3 = $t2 * $t;

        // 平均位相時間
        $pt = 2415020.75933
            + $this->synmonth * $k
            + 0.0001178 * $t2
            - 0.000000155 * $t3
            + 0.00033 * sin(deg2rad(166.56 + 132.87 * $t - 0.009173 * $t2));

        // Sun's mean anomaly
        $m = 359.2242 + 29.10535608 * $k - 0.0000333 * $t2 - 0.00000347 * $t3;
        // Moon's mean anomaly
        $mprime = 306.0253 + 385.81691806 * $k + 0.0107306 * $t2 + 0.00001236 * $t3;
        // Moon's argument of latitude
        $f = 21.2964 + 390.67050646 * $k - 0.0016528 * $t2 - 0.00000239 * $t3;

        if ($phase < 0.01 || abs($phase - 0.5) < 0.01) {
            // Corrections for New and Full Moon
            $pt += (0.1734 - 0.000393 * $t) * sin(deg2rad($m))
                + 0.0021 * sin(deg2rad(2 * $m))
                - 0.4068 * sin(deg2rad($mprime))
                + 0.0161 * sin(deg2rad(2 * $mprime))
                - 0.0004 * sin(deg2rad(3 * $mprime))
                + 0.0104 * sin(deg2rad(2 * $f))
                - 0.0051 * sin(deg2rad($m + $mprime))
                - 0.0074 * sin(deg2rad($m - $mprime))
                + 0.0004 * sin(deg2rad(2 * $f + $m))
                - 0.0004 * sin(deg2rad(2 * $f - $m))
                - 0.0006 * sin(deg2rad(2 * $f + $mprime))
                + 0.0010 * sin(deg2rad(2 * $f - $mprime))
                + 0.0005 * sin(deg2rad($m + 2 * $mprime));
        } elseif (abs($phase - 0.25) < 0.01 || abs($phase - 0.75) < 0.01) {
            $pt += (0.1721 - 0.0004 * $t) * sin(deg2rad($m))
                + 0.0021 * sin(deg2rad(2 * $m))
                - 0.6280 * sin(deg2rad($mprime))
                + 0.0089 * sin(deg2rad(2 * $mprime))
                - 0.0004 * sin(deg2rad(3 * $mprime))
                + 0.0079 * sin(deg2rad(2 * $f))
                - 0.0119 * sin(deg2rad($m + $mprime))
                - 0.0047 * sin(deg2rad($m - $mprime))
                + 0.0003 * sin(deg2rad(2 * $f + $m))
                - 0.0004 * sin(deg2rad(2 * $f - $m))
                - 0.0006 * sin(deg2rad(2 * $f + $mprime))
                + 0.0021 * sin(deg2rad(2 * $f - $mprime))
                + 0.0003 * sin(deg2rad($m + 2 * $mprime))
                + 0.0004 * sin(deg2rad($m - 2 * $mprime))
                - 0.0003 * sin(deg2rad(2 * $m + $mprime));

            // First and last quarter corrections
            if ($phase < 0.5) {
                $pt += 0.0028 - 0.0004 * cos(deg2rad($m)) + 0.0003 * cos(deg2rad($mprime));
            } else {
                $pt += -0.0028 + 0.0004 * cos(deg2rad($m)) - 0.0003 * cos(deg2rad($mprime));
            }
        } else {
            return null;
        }

        return $this->julian2Uts($pt) + 32400 - 60;
    }

    /**
     * 現在の日付を囲む月の満ち欠けの時刻を検索します。5つの位相が検出され、開始時刻と現在の月齢と重なる新月で終了します。
     *
     * @param \DateTime $date
     * @param float $phase 探す位相
     * @param bool $is_next
     * @return \Carbon\Carbon
     */
    public function moonPhase(DateTime $date, float $phase, bool $is_next = false): Carbon
    {
        $timestamp = $date->getTimestamp();
        $julian = $this->uts2Julian($timestamp);

        $check_span = 31;
        $adate = $julian - $check_span;
        $atimestamp = $timestamp - 86400 * $check_span;

        $yy = (int) gmdate('Y', $atimestamp);
        $mm = (int) gmdate('n', $atimestamp);

        $k1 = floor(($yy + (($mm - 1) * (1 / 12)) - 1900) * 12.3685);

        $adate = $nt1 = $this->meanphase($adate, $k1);

        while (true) {
            $adate += $this->synmonth;
            $k2 = $k1 + 1;
            $nt2 = $this->meanphase($adate, $k2);

            // If nt2 is close to sdate, then mean phase isn't good enough, we have to be more accurate
            if (abs($nt2 - $julian) < 0.75) {
                $nt2 = $this->truephase($k2, 0.0);
            }

            if ($nt1 <= $julian && $nt2 > $julian) {
                break;
            }

            $nt1 = $nt2;
            $k1 = $k2;
        }

        return new Carbon($this->truePhase($is_next ? $k1 : $k2, $phase));
    }

    /**
     * UnixTimeStamp to Julian
     *
     * @param int $timestamp
     * @return float
     */
    protected function uts2Julian(int $timestamp): float
    {
        return $timestamp / 86400 + 2440587.5;
    }

    /**
     * Julian to UnixTimeStamp
     *
     * @param float $julian
     * @return float
     */
    protected function julian2Uts(float $julian): float
    {
        return ($julian - 2440587.5) * 86400;
    }
}
