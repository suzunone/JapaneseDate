<?php

/**
 * 月齢・月相を求めるための月位相計算コンポーネント。
 *
 * 朔望月の平均値と補正式を使い、指定された日時に対する月の位相を計算します。
 * 旧暦計算や表示用の月相名を求める処理から利用され、日付に対応する
 * 新月・上弦・満月・下弦などの概略的な状態を導きます。
 *
 * **計算の概要:**
 * - 平均朔望月から基準となる新月時刻を推定
 * - 太陽・月の平均近点角などを用いて真の位相時刻へ補正
 * - 指定日の月齢や月相インデックスを算出
 *
 * このクラスの計算は暦表示に必要な実用精度を目的としており、
 * 高精度な観測用途の天文暦そのものを提供するものではありません。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        2023-05-07
 */

namespace JapaneseDate\Components;

use Carbon\Carbon;
use DateTimeInterface;
use JapaneseDate\Exceptions\ErrorException;
use JapaneseDate\Exceptions\Exception;

/**
 * 月齢と月相インデックスを算出する月計算コンポーネント。
 *
 * 指定された日付・日時をユリウス日へ変換し、平均朔望月と位相補正式から
 * その時点の月齢を求めます。結果は日本語日付表示で使う月相名
 * （新月、三日月、上弦、満月など）を選択するための基礎値になります。
 *
 * **主な処理:**
 * - 基準年から朔望月番号を推定
 * - 新月・上弦・満月・下弦の真の位相時刻を補正計算
 * - 指定日時と直近の新月との差から月齢を算出
 *
 * 日常的な暦表示に必要な実用的な月相計算を目的としており、
 * 観測用の精密な月位置計算とは用途が異なります。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        2023-05-07
 */
class Moon
{
    /**
     * 8 相に対応する位相値の一覧（0.0〜0.875 を 0.125 刻み）。
     *
     * - 0.0   新月
     * - 0.125 三日月
     * - 0.25  上弦
     * - 0.375 十三夜
     * - 0.5   満月
     * - 0.625 十六夜
     * - 0.75  下弦
     * - 0.875 有明
     */
    public const SUPPORTED_PHASES = [0.0, 0.125, 0.25, 0.375, 0.5, 0.625, 0.75, 0.875];

    /**
     * Legacy アルゴリズムが補正式を持つ標準 4 位相。
     */
    protected const STANDARD_PHASES = [0.0, 0.25, 0.5, 0.75];

    /**
     * 月相計算に使用する Astronomy インスタンス。
     * @var \JapaneseDate\Components\Astronomy
     */
    protected $astronomy;

    /**
     * 新月から新月の平均期間
     * @var float synmonth
     */
    protected $synmonth = 29.53058868;

    /**
     * @param Astronomy|null $astronomy 月相計算に使用する Astronomy インスタンス（null の場合は factory() を使用）
     */
    public function __construct(?Astronomy $astronomy = null)
    {
        $this->astronomy = $astronomy ?? Astronomy::factory();
    }

    /**
     * 指定された基準日時に対して、最も近い月相時刻を 8 相のいずれかで探索する。
     *
     * 受け付ける位相は新月から有明までの 8 相（0.125 刻み）で、それぞれ以下に対応する。
     * - 0.0   新月
     * - 0.125 三日月
     * - 0.25  上弦
     * - 0.375 十三夜
     * - 0.5   満月
     * - 0.625 十六夜
     * - 0.75  下弦
     * - 0.875 有明
     *
     * ELP2000 が選択されている場合は天文計算に基づく探索（{@see moonPhaseByAstronomy}）を、
     * それ以外は Meeus の補正式を流用した近似探索（{@see moonPhaseByLegacy}）を行う。
     *
     * @param DateTimeInterface $date 探索の基準日時
     * @param float $phase 探す位相（8 相のいずれか）
     * @param bool $is_next true の場合は基準日時以前、false の場合は以後を探す
     * @return Carbon UTC タイムスタンプの Carbon インスタンス
     * @throws \DateInvalidTimeZoneException
     * @throws Exception
     * @throws \JapaneseDate\Exceptions\ErrorException 8 相以外の位相が指定された場合
     */
    public function moonPhase($date, $phase, $is_next = false): Carbon
    {
        if (!in_array($phase, self::SUPPORTED_PHASES, true)) {
            throw new ErrorException(
                '位相には 0.0、0.125、0.25、0.375、0.5、0.625、0.75、0.875 のいずれかを指定してください。'
            );
        }

        if (in_array(
            $this->astronomy->moonAlgorithmName(),
            [Astronomy::MOON_ELP2000, Astronomy::MOON_MEEUS47, Astronomy::MOON_MEEUS47_NO_C],
            true
        )) {
            return $this->moonPhaseByAstronomy($date, $phase, $is_next);
        }

        return $this->moonPhaseByLegacy($date, $phase, $is_next);
    }

    /**
     * 現在選択されている Astronomy の月黄経アルゴリズムで位相時刻を探索する。
     *
     * 月の太陽相対黄経 (Λ_moon - Λ_sun) と目標角 `phase × 360°` の差分を、
     * 6 時間刻みで前進・後退方向に追跡し、符号反転区間を二分探索で詰める。
     * 8 相（0.125 刻み）すべての位相に対応する。
     *
     * @param DateTimeInterface $date 探索の基準日時
     * @param float $phase 探す位相（8 相のいずれか）
     * @param bool $is_next true の場合は基準日時以前、false の場合は以後を探す
     * @return Carbon
     * @throws \DateInvalidTimeZoneException
     * @throws Exception 探索に失敗し、かつ 8 相以外の位相が指定された場合
     */
    protected function moonPhaseByAstronomy($date, $phase, $is_next): Carbon
    {
        $targetAngle = $this->normalizeAngle($phase * 360.0);
        $direction = $is_next ? -1 : 1;
        $step = 21600;
        $start = $date->getTimestamp();
        $previousTimestamp = $start;
        $previousDelta = $this->phaseDeltaAt($previousTimestamp, $targetAngle);

        for ($i = 1; $i <= 160; $i++) {
            $currentTimestamp = $start + $direction * $step * $i;
            $currentDelta = $this->phaseDeltaAt($currentTimestamp, $targetAngle);

            if ($previousDelta === 0.0) {
                return Carbon::createFromTimestampUTC($previousTimestamp);
            }

            if ($previousDelta * $currentDelta <= 0.0) {
                // 前進探索では neg→pos（昇順）、後退探索では pos→neg（降順）のみを正しい交差とみなす。
                // 逆符号の交差は 180° 反対側（満月時等）の偽検出なのでスキップする。
                $isAscending = $previousDelta < $currentDelta;
                if ($direction === 1 ? $isAscending : !$isAscending) {
                    return Carbon::createFromTimestampUTC(
                        $this->bisectPhaseTimestamp($previousTimestamp, $currentTimestamp, $targetAngle)
                    );
                }
            }

            $previousTimestamp = $currentTimestamp;
            $previousDelta = $currentDelta;
        }

        if (in_array($phase, self::SUPPORTED_PHASES, true)) {
            return $this->moonPhaseByLegacy($date, $phase, $is_next);
        }

        throw new Exception(sprintf(
            '指定された位相 (%.4F) の探索に失敗しました。8 相（0.0, 0.125, 0.25, 0.375, 0.5, 0.625, 0.75, 0.875）のみ対応しています。',
            $phase
        ));
    }

    /**
     * 角度を 0°〜360° に正規化する。
     *
     * @param float $angle
     * @return float
     */
    protected function normalizeAngle($angle): float
    {
        $angle = fmod($angle, 360.0);

        return $angle < 0.0 ? $angle + 360.0 : $angle;
    }

    /**
     * 位相角の目標値との差を -180°〜180° に正規化して返す。
     *
     * @param int $timestamp
     * @param float $targetAngle
     * @return float
     * @throws \DateInvalidTimeZoneException
     * @throws Exception
     */
    protected function phaseDeltaAt($timestamp, $targetAngle): float
    {
        $jst = $timestamp + 32400; // UTC → JST（moonPhaseAngle は JST 入力を期待）
        $year = (int) gmdate('Y', $jst);
        $month = (int) gmdate('n', $jst);
        $day = (int) gmdate('j', $jst);
        $hour = (int) gmdate('G', $jst);
        $min = (int) gmdate('i', $jst);
        $sec = (int) gmdate('s', $jst);
        $angle = $this->astronomy->moonPhaseAngle($year, $month, $day, $hour, $min, $sec);

        return $this->normalizeAngle($angle - $targetAngle + 180.0) - 180.0;
    }

    /**
     * 位相角の符号反転区間を二分探索して位相時刻を求める。
     *
     * @param int $timestamp1
     * @param int $timestamp2
     * @param float $targetAngle
     * @return int
     * @throws \DateInvalidTimeZoneException
     * @throws Exception
     */
    protected function bisectPhaseTimestamp($timestamp1, $timestamp2, $targetAngle): int
    {
        $left = min($timestamp1, $timestamp2);
        $right = max($timestamp1, $timestamp2);
        $leftDelta = $this->phaseDeltaAt($left, $targetAngle);

        while ($right - $left > 1) {
            $middle = intdiv($left + $right, 2);
            $middleDelta = $this->phaseDeltaAt($middle, $targetAngle);

            if ($leftDelta * $middleDelta <= 0.0) {
                $right = $middle;

                continue;
            }

            $left = $middle;
            $leftDelta = $middleDelta;
        }

        return $right;
    }

    /**
     * 従来の朔望月平均位相・補正式で位相時刻を計算する。
     *
     * `moonPhaseByAstronomy()` の探索失敗フォールバックとして、
     * あるいは Legacy アルゴリズムが選択されている場合の直接呼び出し先として使用する。
     * グローバル状態を変更せずに計算する。
     *
     * 中間 4 位相（0.125, 0.375, 0.625, 0.875）は補正式を持たないため、
     * 隣接する標準位相時刻の中点を取って近似する
     * （{@see moonPhaseByLegacyMidpoint}）。
     *
     * @param DateTimeInterface $date 基準日時
     * @param float $phase 探す位相（8 相のいずれか）
     * @param bool $is_next true の場合は基準日時以前、false の場合は以後を探す
     * @return Carbon
     */
    protected function moonPhaseByLegacy($date, $phase, $is_next): Carbon
    {
        if (!in_array($phase, self::STANDARD_PHASES, true)) {
            return $this->moonPhaseByLegacyMidpoint($date, $phase, $is_next);
        }

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
     * 中間 4 位相（三日月・十三夜・十六夜・有明）を、隣接する標準位相時刻の中点で近似する。
     *
     * Legacy の {@see truePhase} は新月・上弦・満月・下弦の 4 位相にしか補正式を持たないため、
     * 中間位相そのものを直接補正計算で求めることはできない。
     * そこで「基準日時に対する近い標準位相」と「その直後の標準位相」の 2 点を
     * Legacy 補正式で求め、UTC タイムスタンプの中点を取ることで近似時刻とする。
     *
     * 朔望月は約 29.5 日のため、隣接する標準位相間の時間差は約 7.4 日であり、
     * 中点近似による誤差は数時間以内に収まる。
     *
     * @param DateTimeInterface $date 基準日時
     * @param float $phase 探す位相（0.125, 0.375, 0.625, 0.875 のいずれか）
     * @param bool $is_next true の場合は基準日時以前、false の場合は以後を探す
     * @return Carbon
     */
    protected function moonPhaseByLegacyMidpoint($date, $phase, $is_next): Carbon
    {
        $lowerPhase = floor($phase * 4) / 4;
        $upperPhase = $lowerPhase + 0.25;
        if ($upperPhase >= 1.0) {
            $upperPhase = 0.0;
        }

        $lowerTime = $this->moonPhaseByLegacy($date, $lowerPhase, $is_next);
        $upperTime = $this->moonPhaseByLegacy($lowerTime, $upperPhase, false);

        $midTimestamp = (int) round(($lowerTime->getTimestamp() + $upperTime->getTimestamp()) / 2);

        return Carbon::createFromTimestampUTC($midTimestamp);
    }

    /**
     * UnixTimeStamp to Julian
     *
     * @param int $timestamp
     * @return float
     */
    protected function uts2Julian($timestamp): float
    {
        return $timestamp / 86400 + 2440587.5;
    }

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
    protected function meanPhase($date, $k): float
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
     * 新月の平均位相から補正された位相時間を取得する。
     *
     * 本メソッドは Meeus 流の補正式（新月・四分月用と上下弦用の 2 種）を実装しており、
     * 標準 4 位相（0.0=新月, 0.25=上弦, 0.5=満月, 0.75=下弦）にのみ補正値を返す。
     * 中間位相（0.125, 0.375, 0.625, 0.875）の時刻は本メソッドではなく
     * {@see moonPhaseByLegacyMidpoint} 側で隣接する標準位相時刻の中点として近似する。
     *
     * @param float $k 朔望月インデックス（基準位相を加算する前の値）
     * @param float $phase 標準 4 位相のいずれか
     * @return float|null 対応する UTC タイムスタンプ。標準 4 位相以外は null
     */
    protected function truePhase($k, $phase): ?float
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

        return $this->julian2Uts($pt);
    }

    /**
     * Julian to UnixTimeStamp
     *
     * @param float $julian
     * @return float
     */
    protected function julian2Uts($julian): float
    {
        return ($julian - 2440587.5) * 86400;
    }
}
