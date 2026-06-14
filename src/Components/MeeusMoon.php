<?php

/*
 * Lunar position coefficient tables (47.A / 47.B) adopted from:
 *   soniakeys/meeus commit c7f0dba (v3.0.0, 2018-03-04)
 *   v3/moonposition/moonposition.go
 *   https://github.com/soniakeys/meeus
 *
 * Copyright (c) 2013 Sonia Keys
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * Coefficient values originate from Jean Meeus, "Astronomical Algorithms, 2nd ed."
 * (1998), Tables 47.A (pp.339-340) and 47.B (p.341). Direct cross-check against
 * the original publication is replaced by the SHA-256 hash assertion, the Meeus
 * Example 47.a regression test, and shared project fixtures (user decision).
 */

namespace JapaneseDate\Components;

use InvalidArgumentException;
use JapaneseDate\Components\Contracts\MoonAlgorithm;

/**
 * Jean Meeus『Astronomical Algorithms, 2nd ed.』Chapter 47 の周期項を使う月位置計算。
 *
 * Legacy・ELP2000 に並ぶ第3の月位置計算アルゴリズムとして提供します。
 * 入力は JST（固定 UTC+09:00）で受け取り、内部で UT→TT 変換を行います。
 * PHP DateTime/Carbon に依存しないため紀元前年・年0 も処理できます。
 *
 * **入力時刻系:** JST 入力（ELP2000 と統一）。固定 UTC+09:00（PHP の Asia/Tokyo LMT は使わない）。
 *
 * **時刻計算:** PHP DateTime/Carbon を使わず、Meeus Chapter 7 の
 * グレゴリオ暦↔JD 公式で直接計算する。
 *
 * **紀元前年:** 天文学的年番号方式（年0 = 紀元前1年、年-1 = 紀元前2年）。
 *
 * **ΔT:** NASA Espenak-Meeus 多項式。月の永年加速度補正項 c は
 * コンストラクタの `$applyNasaCCorrection` で制御する。
 *
 * **章動:** Meeus Chapter 22 の簡略 4 項版（精度 ±0.5" 程度）。
 *
 * **月位置比較・特性評価範囲:** 1620〜2150年。精度保証範囲ではない。
 *
 * **NASA ΔT 多項式の対象年代:** -1999〜+3000年。対象年代外でも外側区分式を
 * 外挿するベストエフォート計算を行い、年代だけを理由に拒否しない。
 *
 * // SHA-256 ハッシュは PHP で次の式で再現できる:
 * //   hash('sha256', json_encode(self::TABLE_47A, JSON_THROW_ON_ERROR))
 * // 採用元: soniakeys/meeus commit c7f0dba, v3/moonposition/moonposition.go
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
class MeeusMoon implements MoonAlgorithm
{
    /**
     * @var bool
     */
    private $applyNasaCCorrection = true;
    /**
     * Meeus AA2 Chapter 47 Table 47.A (pp.339-340) の周期項配列。
     * 各行: [D, M, M', F, Σl, Σr]。月の黄経・距離の振幅係数（Σl は 10^-6 度、Σr は km/1000 単位）。
     * 60 行。soniakeys/meeus c7f0dba からの転記。
     *
     * 公開理由: 後方互換のため public const として API 公開する。Codex レビューから
     * 繰り返し「テスト容易性のために private が望ましい」と指摘されているが、本プロジェクト
     * 規約と後方互換性維持のため public を選択する。
     *
     * @var array<int, array{int,int,int,int,int,int}>
     */
    public const TABLE_47A = [
        [0, 0, 1, 0, 6288774, -20905355],
        [2, 0, -1, 0, 1274027, -3699111],
        [2, 0, 0, 0, 658314, -2955968],
        [0, 0, 2, 0, 213618, -569925],
        [0, 1, 0, 0, -185116, 48888],
        [0, 0, 0, 2, -114332, -3149],
        [2, 0, -2, 0, 58793, 246158],
        [2, -1, -1, 0, 57066, -152138],
        [2, 0, 1, 0, 53322, -170733],
        [2, -1, 0, 0, 45758, -204586],
        [0, 1, -1, 0, -40923, -129620],
        [1, 0, 0, 0, -34720, 108743],
        [0, 1, 1, 0, -30383, 104755],
        [2, 0, 0, -2, 15327, 10321],
        [0, 0, 1, 2, -12528, 0],
        [0, 0, 1, -2, 10980, 79661],
        [4, 0, -1, 0, 10675, -34782],
        [0, 0, 3, 0, 10034, -23210],
        [4, 0, -2, 0, 8548, -21636],
        [2, 1, -1, 0, -7888, 24208],
        [2, 1, 0, 0, -6766, 30824],
        [1, 0, -1, 0, -5163, -8379],
        [1, 1, 0, 0, 4987, -16675],
        [2, -1, 1, 0, 4036, -12831],
        [2, 0, 2, 0, 3994, -10445],
        [4, 0, 0, 0, 3861, -11650],
        [2, 0, -3, 0, 3665, 14403],
        [0, 1, -2, 0, -2689, -7003],
        [2, 0, -1, 2, -2602, 0],
        [2, -1, -2, 0, 2390, 10056],
        [1, 0, 1, 0, -2348, 6322],
        [2, -2, 0, 0, 2236, -9884],
        [0, 1, 2, 0, -2120, 5751],
        [0, 2, 0, 0, -2069, 0],
        [2, -2, -1, 0, 2048, -4950],
        [2, 0, 1, -2, -1773, 4130],
        [2, 0, 0, 2, -1595, 0],
        [4, -1, -1, 0, 1215, -3958],
        [0, 0, 2, 2, -1110, 0],
        [3, 0, -1, 0, -892, 3258],
        [2, 1, 1, 0, -810, 2616],
        [4, -1, -2, 0, 759, -1897],
        [0, 2, -1, 0, -713, -2117],
        [2, 2, -1, 0, -700, 2354],
        [2, 1, -2, 0, 691, 0],
        [2, -1, 0, -2, 596, 0],
        [4, 0, 1, 0, 549, -1423],
        [0, 0, 4, 0, 537, -1117],
        [4, -1, 0, 0, 520, -1571],
        [1, 0, -2, 0, -487, -1739],
        [2, 1, 0, -2, -399, 0],
        [0, 0, 2, -2, -381, -4421],
        [1, 1, 1, 0, 351, 0],
        [3, 0, -2, 0, -340, 0],
        [4, 0, -3, 0, 330, 0],
        [2, -1, 2, 0, 327, 0],
        [0, 2, 1, 0, -323, 1165],
        [1, 1, -1, 0, 299, 0],
        [2, 0, 3, 0, 294, 0],
        [2, 0, -1, -2, 0, 8752],
    ];

    /**
     * Meeus AA2 Chapter 47 Table 47.B (p.341) の周期項配列。
     * 各行: [D, M, M', F, Σb]。月の黄緯の振幅係数（10^-6 度単位）。
     * 60 行。
     *
     * 公開理由: TABLE_47A と同じく後方互換のため public const とする。
     *
     * @var array<int, array{int,int,int,int,int}>
     */
    public const TABLE_47B = [
        [0, 0, 0, 1, 5128122],
        [0, 0, 1, 1, 280602],
        [0, 0, 1, -1, 277693],
        [2, 0, 0, -1, 173237],
        [2, 0, -1, 1, 55413],
        [2, 0, -1, -1, 46271],
        [2, 0, 0, 1, 32573],
        [0, 0, 2, 1, 17198],
        [2, 0, 1, -1, 9266],
        [0, 0, 2, -1, 8822],
        [2, -1, 0, -1, 8216],
        [2, 0, -2, -1, 4324],
        [2, 0, 1, 1, 4200],
        [2, 1, 0, -1, -3359],
        [2, -1, -1, 1, 2463],
        [2, -1, 0, 1, 2211],
        [2, -1, -1, -1, 2065],
        [0, 1, -1, -1, -1870],
        [4, 0, -1, -1, 1828],
        [0, 1, 0, 1, -1794],
        [0, 0, 0, 3, -1749],
        [0, 1, -1, 1, -1565],
        [1, 0, 0, 1, -1491],
        [0, 1, 1, 1, -1475],
        [0, 1, 1, -1, -1410],
        [0, 1, 0, -1, -1344],
        [1, 0, 0, -1, -1335],
        [0, 0, 3, 1, 1107],
        [4, 0, 0, -1, 1021],
        [4, 0, -1, 1, 833],
        [0, 0, 1, -3, 777],
        [4, 0, -2, 1, 671],
        [2, 0, 0, -3, 607],
        [2, 0, 2, -1, 596],
        [2, -1, 1, -1, 491],
        [2, 0, -2, 1, -451],
        [0, 0, 3, -1, 439],
        [2, 0, 2, 1, 422],
        [2, 0, -3, -1, 421],
        [2, 1, -1, 1, -366],
        [2, 1, 0, 1, -351],
        [4, 0, 0, 1, 331],
        [2, -1, 1, 1, 315],
        [2, -2, 0, -1, 302],
        [0, 0, 1, 3, -283],
        [2, 1, 1, -1, -229],
        [1, 1, 0, -1, 223],
        [1, 1, 0, 1, 223],
        [0, 1, -2, -1, -220],
        [2, 1, -1, -1, -220],
        [1, 0, 1, 1, -185],
        [2, -1, -2, -1, 181],
        [0, 1, 2, 1, -177],
        [4, 0, -2, -1, 176],
        [4, -1, -1, -1, 166],
        [1, 0, 1, -1, -164],
        [4, 0, 1, -1, 132],
        [1, 0, -1, -1, -119],
        [4, -1, 0, -1, 115],
        [2, -2, 0, 1, 107],
    ];

    /**
     * IEEE-754 double で正確に表現できる最大連続整数（2^53）。
     * (float)PHP_INT_MAX は double で正確に表現できず int キャスト時にオーバーフローしうるため、
     * 保守的にこの値を境界として使う。
     */
    private const SAFE_INT_BOUND = 9007199254740992.0;

    /**
     * MeeusMoon コンストラクタ。
     *
     * @param bool $applyNasaCCorrection NASA の月の永年加速度補正項 c を ΔT に加算するか。
     *                                    true（既定）は Chapter 47 への c 適用が未検証の実験モード。
     *                                    これは Five Millennium Canon の改良 ELP-2000/82 用に
     *                                    導出された c 補正であり、Chapter 47 への適用妥当性は
     *                                    確認されていない。Canon 互換または一般的な精度向上を
     *                                    保証するものではない。
     *                                    false は NASA 多項式のみを使用する Chapter 47 標準モード。
     */
    public function __construct(bool $applyNasaCCorrection = true)
    {
        /**
         * @readonly
         */
        $this->applyNasaCCorrection = $applyNasaCCorrection;
    }

    /**
     * アルゴリズム識別子を返す。
     *
     * @return string `applyNasaCCorrection`=true なら 'meeus47'、false なら 'meeus47_no_c'
     */
    public function moonAlgorithmName(): string
    {
        return $this->applyNasaCCorrection ? 'meeus47' : 'meeus47_no_c';
    }

    /**
     * 先発グレゴリオ暦（天文学的年番号）→ ユリウス日（0h UT 起点）。
     * Meeus AA2 Chapter 7, formula 7.1。MeeusMoonAge と共用するため public static。
     *
     * 天文学的年番号方式: 年0 = 紀元前1年、年-1 = 紀元前2年。
     *
     * @param int $year 年（天文学的年番号）
     * @param int $month 月（1〜12）
     * @param int $day 日（1〜該当月日数）
     * @return float ユリウス日（0h UT 起点）
     * @throws InvalidArgumentException 実在しない日付、または極端値で float→int キャストの分解能損失が発生する場合
     */
    public static function gregorianToJd($year, $month, $day): float
    {
        if ($year < -1000000000 || $year > 1000000000) {
            throw new InvalidArgumentException('Year out of supported range');
        }
        if ($month < 1 || $month > 12) {
            throw new InvalidArgumentException('Invalid month');
        }
        $daysInMonth = self::daysInGregorianMonth($year, $month);
        if ($day < 1 || $day > $daysInMonth) {
            throw new InvalidArgumentException('Invalid day');
        }

        $y = $year;
        $m = $month;
        if ($m <= 2) {
            $y--;
            $m += 12;
        }
        $a = self::safeFloorToInt($y / 100.0);
        $b = 2 - $a + self::safeFloorToInt($a / 4.0);

        $term1 = 365.25 * ($y + 4716);
        $term2 = 30.6001 * ($m + 1);
        $jd = (float) (self::safeFloorToInt($term1) + self::safeFloorToInt($term2) + $day + $b) - 1524.5;

        /** @noinspection NotOptimalIfConditionsInspection */
        if (!is_finite($jd) || ($jd + 1.0 / 86400.0) <= $jd) {
            throw new InvalidArgumentException('JD beyond 1-second resolution');
        }

        return $jd;
    }

    /**
     * ユリウス日 → 先発グレゴリオ暦 [year, month, day]。Meeus AA2 Chapter 7, formula 7.7。
     *
     * @param float $jd ユリウス日
     * @return array{0:int,1:int,2:int} [year, month, day]
     * @throws InvalidArgumentException JD が非有限、または極端値で int オーバーフローする場合
     */
    public static function jdToGregorianYmd($jd): array
    {
        /** @noinspection NotOptimalIfConditionsInspection */
        if (!is_finite($jd) || ($jd + 1.0 / 86400.0) <= $jd) {
            throw new InvalidArgumentException('JD non-finite or beyond 1-second resolution');
        }
        $z = self::safeFloorToInt($jd + 0.5);
        $alpha = self::safeFloorToInt(($z - 1867216.25) / 36524.25);
        $a = $z + 1 + $alpha - self::safeFloorToInt($alpha / 4.0);
        $b = $a + 1524;
        $c = self::safeFloorToInt(($b - 122.1) / 365.25);
        $d = self::safeFloorToInt(365.25 * $c);
        $e = self::safeFloorToInt(($b - $d) / 30.6001);
        $day = $b - $d - self::safeFloorToInt(30.6001 * $e);
        $month = $e < 14 ? $e - 1 : $e - 13;
        $year = $month > 2 ? $c - 4716 : $c - 4715;

        return [$year, $month, $day];
    }

    /**
     * グレゴリオ暦（JST）から月の視黄経を返す（MoonAlgorithm 実装）。
     *
     * JST は固定 UTC+09:00 として扱う（PHP の Asia/Tokyo LMT を使わない）。
     * Meeus Chapter 7 のグレゴリオ暦↔JD 公式で時刻変換を行い、PHP DateTime に
     * 依存しないため紀元前年・年0 も処理できる。
     *
     * 入力年は天文学的年番号方式（年0 = 紀元前1年、年-1 = 紀元前2年）。
     * 全小数部（hour/min/sec）を秒へ換算して JST→UT 変換、その後 ΔT で TT 変換。
     *
     * 月位置の比較・特性評価範囲: 1620〜2150年（独立暦との差を評価。精度保証範囲ではない）。
     * NASA ΔT 多項式の対象年代: -1999〜+3000年。**対象年代外でも年代だけを理由に拒否しない**
     * （外側区分式の外挿による精度保証外のベストエフォート計算）。
     *
     * @param int $year JST グレゴリオ暦の年（天文学的年番号）
     * @param int $month JST グレゴリオ暦の月（1〜12）
     * @param int $day JST グレゴリオ暦の日（1〜該当月日数）
     * @param float $hour JST の時（小数許容、範囲外は秒オフセットとして加算される）
     * @param float $min JST の分（小数許容、同上）
     * @param float $sec JST の秒（小数許容、同上）
     * @return float 月の視黄経（度、[0, 360)）
     * @throws InvalidArgumentException hour/min/sec が NAN/INF、month/day が実在しない日付、
     *                                    または UT JD/TT JD が非有限値・1秒分解能損失となる場合
     */
    public function longitudeMoon($year, $month, $day, $hour, $min, $sec): float
    {
        if (!is_finite($hour) || !is_finite($min) || !is_finite($sec)) {
            throw new InvalidArgumentException('Hour/min/sec must be finite numbers.');
        }

        $jdJstMidnight = self::gregorianToJd($year, $month, $day);

        // JST → UT は -9 時間（固定）
        $offsetSec = $hour * 3600.0 + $min * 60.0 + $sec - 9.0 * 3600.0;
        $utJd = $jdJstMidnight + $offsetSec / 86400.0;
        /** @noinspection NotOptimalIfConditionsInspection */
        if (!is_finite($utJd) || ($utJd + 1.0 / 86400.0) <= $utJd) {
            throw new InvalidArgumentException('UT JD non-finite or beyond 1-second resolution');
        }

        [$utcYear, $utcMonth,] = self::jdToGregorianYmd($utJd);
        $deltaTSec = $this->approximateDeltaTSeconds($utcYear, $utcMonth);
        $ttJd = $utJd + $deltaTSec / 86400.0;
        /** @noinspection NotOptimalIfConditionsInspection */
        if (!is_finite($ttJd) || ($ttJd + 1.0 / 86400.0) <= $ttJd) {
            throw new InvalidArgumentException('TT JD non-finite or beyond 1-second resolution');
        }

        return $this->calculateFromJde($ttJd)['apparentLongitude'];
    }

    /**
     * 力学時ユリウス日（JD TT）から月位置を計算する直接 API。
     *
     * @param float $jde 力学時ユリウス日（JD TT）。NAN/INF 以外。
     * @return array{apparentLongitude: float, latitude: float, distanceKm: float}
     *   - apparentLongitude: 月の地心視黄経（度、[0, 360)）。黄道章動 Δψ 補正済み。
     *   - latitude:          月の地心黄道緯度（度）。Σb から求めた値。章動補正なし。
     *   - distanceKm:        月の地心距離（km）。
     * @throws InvalidArgumentException $jde が NAN/無限大、または出力のいずれかが非有限となる場合
     */
    public function calculateFromJde($jde): array
    {
        if (!is_finite($jde)) {
            throw new InvalidArgumentException('JDE must be a finite number.');
        }

        $t = ($jde - 2451545.0) / 36525.0;
        $geom = $this->computeGeometricPosition($t);
        $deltaPsi = $this->deltaPsiDeg($t, $geom['lon']);
        $apparentLongitude = $this->normalizeAngle360($geom['lon'] + $deltaPsi);

        if (!is_finite($apparentLongitude) || !is_finite($geom['lat']) || !is_finite($geom['dist'])) {
            throw new InvalidArgumentException('Computed moon position contains non-finite value.');
        }

        return [
            'apparentLongitude' => $apparentLongitude,
            'latitude' => $geom['lat'],
            'distanceKm' => $geom['dist'],
        ];
    }

    /**
     * 安全な floor → int キャスト共通ヘルパー。
     *
     * (float)PHP_INT_MAX は double で正確に表現できず約 9.22e+18 に丸められる。
     * この値より僅かに大きい値が int キャスト時に PHP_INT_MIN へオーバーフローしうる。
     * これを避けるため、IEEE-754 double で正確に表現できる最大連続整数 2^53 を境界として使う。
     *
     * @throws InvalidArgumentException
     */
    private static function safeFloorToInt(float $v): int
    {
        /** @noinspection NotOptimalIfConditionsInspection */
        if (!is_finite($v) || $v < -self::SAFE_INT_BOUND || $v > self::SAFE_INT_BOUND) {
            throw new InvalidArgumentException('Value out of safely representable int range');
        }

        return (int) floor($v);
    }

    /**
     * うるう年判定（先発グレゴリオ暦、天文学的年番号）。
     */
    private static function isLeapYear(int $year): bool
    {
        if ($year % 400 === 0) {
            return true;
        }
        if ($year % 100 === 0) {
            return false;
        }

        return $year % 4 === 0;
    }

    /**
     * 月の日数を返す（先発グレゴリオ暦）。
     */
    private static function daysInGregorianMonth(int $year, int $month): int
    {
        switch ($month) {
            case 1:
            case 3:
            case 5:
            case 7:
            case 8:
            case 10:
            case 12:
                return 31;
            case 4:
            case 6:
            case 9:
            case 11:
                return 30;
            case 2:
                return self::isLeapYear($year) ? 29 : 28;
            default:
                throw new InvalidArgumentException('Invalid month');
        }
    }

    /**
     * Chapter 47 の基本角を計算する。
     *
     * @param float $t ユリウス世紀数（J2000.0 起点）
     * @return array{lprime: float, d: float, m: float, mp: float, f: float, a1: float, a2: float, a3: float, e: float}
     */
    private function computeAngles(float $t): array
    {
        $t2 = $t * $t;
        $t3 = $t2 * $t;
        $t4 = $t3 * $t;

        // 式 47.1〜47.5
        $lprime = 218.3164477 + 481267.88123421 * $t - 0.0015786 * $t2 + $t3 / 538841.0 - $t4 / 65194000.0;
        $d = 297.8501921 + 445267.1114034 * $t - 0.0018819 * $t2 + $t3 / 545868.0 - $t4 / 113065000.0;
        $m = 357.5291092 + 35999.0502909 * $t - 0.0001536 * $t2 + $t3 / 24490000.0;
        $mp = 134.9633964 + 477198.8675055 * $t + 0.0087414 * $t2 + $t3 / 69699.0 - $t4 / 14712000.0;
        $f = 93.2720950 + 483202.0175233 * $t - 0.0036539 * $t2 - $t3 / 3526000.0 + $t4 / 863310000.0;

        $a1 = 119.75 + 131.849 * $t;
        $a2 = 53.09 + 479264.290 * $t;
        $a3 = 313.45 + 481266.484 * $t;

        // 式 47.6
        $e = 1.0 - 0.002516 * $t - 0.0000074 * $t2;

        return [
            'lprime' => $this->normalizeAngle360($lprime),
            'd' => $this->normalizeAngle360($d),
            'm' => $this->normalizeAngle360($m),
            'mp' => $this->normalizeAngle360($mp),
            'f' => $this->normalizeAngle360($f),
            'a1' => $this->normalizeAngle360($a1),
            'a2' => $this->normalizeAngle360($a2),
            'a3' => $this->normalizeAngle360($a3),
            'e' => $e,
        ];
    }

    /**
     * TABLE_47A / TABLE_47B を走査して Σl, Σr, Σb を計算する。
     *
     * @param array{lprime: float, d: float, m: float, mp: float, f: float, a1: float, a2: float, a3: float, e: float} $angles
     * @return array{sigmaL: float, sigmaR: float, sigmaB: float}
     */
    private function sumPeriodicTerms(array $angles): array
    {
        $calcArg = static function (float $dCoeff, float $mCoeff, float $mpCoeff, float $fCoeff) use ($angles): float {
            return deg2rad($dCoeff * $angles['d'] + $mCoeff * $angles['m'] + $mpCoeff * $angles['mp'] + $fCoeff * $angles['f']);
        };

        $sigmaL = 0.0;
        $sigmaR = 0.0;
        $sigmaB = 0.0;

        foreach (self::TABLE_47A as $row) {
            [$dCoeff, $mCoeff, $mpCoeff, $fCoeff, $lCoeff, $rCoeff] = $row;
            $arg = $calcArg($dCoeff, $mCoeff, $mpCoeff, $fCoeff);
            $factor = $this->eccentricityFactor($angles['e'], $mCoeff);
            $sigmaL += $lCoeff * $factor * sin($arg);
            $sigmaR += $rCoeff * $factor * cos($arg);
        }

        foreach (self::TABLE_47B as $row) {
            [$dCoeff, $mCoeff, $mpCoeff, $fCoeff, $bCoeff] = $row;
            $arg = $calcArg($dCoeff, $mCoeff, $mpCoeff, $fCoeff);
            $factor = $this->eccentricityFactor($angles['e'], $mCoeff);
            $sigmaB += $bCoeff * $factor * sin($arg);
        }

        // 追加補正項（Meeus p.342）
        $a1Rad = deg2rad($angles['a1']);
        $a2Rad = deg2rad($angles['a2']);
        $a3Rad = deg2rad($angles['a3']);
        $lRad = deg2rad($angles['lprime']);
        $fRad = deg2rad($angles['f']);
        $mpRad = deg2rad($angles['mp']);

        $sigmaL += 3958.0 * sin($a1Rad) + 1962.0 * sin($lRad - $fRad) + 318.0 * sin($a2Rad);
        $sigmaB += -2235.0 * sin($lRad)
            + 382.0 * sin($a3Rad)
            + 175.0 * sin($a1Rad - $fRad)
            + 175.0 * sin($a1Rad + $fRad)
            + 127.0 * sin($lRad - $mpRad)
            - 115.0 * sin($lRad + $mpRad);

        return ['sigmaL' => $sigmaL, 'sigmaR' => $sigmaR, 'sigmaB' => $sigmaB];
    }

    /**
     * 地心月位置（黄経・黄緯・距離）を計算する。
     *
     * @param float $t ユリウス世紀数
     * @return array{lon: float, lat: float, dist: float}
     */
    private function computeGeometricPosition(float $t): array
    {
        $angles = $this->computeAngles($t);
        $sums = $this->sumPeriodicTerms($angles);

        $longitude = $angles['lprime'] + $sums['sigmaL'] / 1000000.0;
        $latitude = $sums['sigmaB'] / 1000000.0;
        $distance = 385000.56 + $sums['sigmaR'] / 1000.0;

        return [
            'lon' => $this->normalizeAngle360($longitude),
            'lat' => $latitude,
            'dist' => $distance,
        ];
    }

    /**
     * 離心率補正係数を返す。
     *
     * @param float $e 地球軌道離心率
     * @param int $mCoeff M の係数（絶対値が 1 なら E、2 なら E²）
     */
    private function eccentricityFactor(float $e, int $mCoeff): float
    {
        switch (abs($mCoeff)) {
            case 1:
                return $e;
            case 2:
                return $e * $e;
            default:
                return 1.0;
        }
    }

    /**
     * 黄道章動 Δψ を度単位で返す（Meeus Chapter 22 簡略 4 項版）。
     *
     * Chapter 22 完全 63 項版ではなく簡略 4 項版。式全体の近似誤差は ±0.5"（J2000 前後 200 年）。
     * 範囲外では精度が劣化する。
     *
     * @param float $t ユリウス世紀数
     * @param float $lprimeDeg 月の平均黄経（度）
     */
    private function deltaPsiDeg(float $t, float $lprimeDeg): float
    {
        $lSun = 280.4664567 + 36000.76983 * $t;
        $omega = 125.04452 - 1934.136261 * $t;
        $deltaPsiArcsec = -17.20 * sin(deg2rad($omega))
            - 1.32 * sin(deg2rad(2.0 * $lSun))
            - 0.23 * sin(deg2rad(2.0 * $lprimeDeg))
            + 0.21 * sin(deg2rad(2.0 * $omega));

        return $deltaPsiArcsec / 3600.0;
    }

    /**
     * 角度を [0, 360) に正規化する。
     */
    private function normalizeAngle360(float $angle): float
    {
        $mod = fmod($angle, 360.0);

        return $mod < 0.0 ? $mod + 360.0 : $mod;
    }

    /**
     * NASA Espenak-Meeus 多項式（c 補正なし）で ΔT（秒）を計算する。
     *
     * NASA の説明どおり小数年 y = year + (month - 0.5) / 12 を使用する（月中近似）。
     * NASA 多項式の対象年代は -1999〜+3000年。期間全体の精度保証ではない。
     * 対象年代外も外側区分式を外挿するベストエフォート計算で、精度を保証しない。
     *
     * @param float $y 小数年
     */
    private function deltaTPolynomialForDecimalYear(float $y): float
    {
        if ($y < -500.0) {
            $u = ($y - 1820.0) / 100.0;

            return -20.0 + 32.0 * $u * $u;
        }

        if ($y < 500.0) {
            $u = $y / 100.0;

            return 10583.6
                - 1014.41 * $u
                + 33.78311 * $u ** 2
                - 5.952053 * $u ** 3
                - 0.1798452 * $u ** 4
                + 0.022174192 * $u ** 5
                + 0.0090316521 * $u ** 6;
        }

        if ($y < 1600.0) {
            $u = ($y - 1000.0) / 100.0;

            return 1574.2
                - 556.01 * $u
                + 71.23472 * $u ** 2
                + 0.319781 * $u ** 3
                - 0.8503463 * $u ** 4
                - 0.005050998 * $u ** 5
                + 0.0083572073 * $u ** 6;
        }

        if ($y < 1700.0) {
            $t = $y - 1600.0;

            return 120.0 - 0.9808 * $t - 0.01532 * $t ** 2 + $t ** 3 / 7129.0;
        }

        if ($y < 1800.0) {
            $t = $y - 1700.0;

            return 8.83
                + 0.1603 * $t
                - 0.0059285 * $t ** 2
                + 0.00013336 * $t ** 3
                - $t ** 4 / 1174000.0;
        }

        if ($y < 1860.0) {
            $t = $y - 1800.0;

            return 13.72
                - 0.332447 * $t
                + 0.0068612 * $t ** 2
                + 0.0041116 * $t ** 3
                - 0.00037436 * $t ** 4
                + 0.0000121272 * $t ** 5
                - 0.0000001699 * $t ** 6
                + 0.000000000875 * $t ** 7;
        }

        if ($y < 1900.0) {
            $t = $y - 1860.0;

            return 7.62
                + 0.5737 * $t
                - 0.251754 * $t ** 2
                + 0.01680668 * $t ** 3
                - 0.0004473624 * $t ** 4
                + $t ** 5 / 233174.0;
        }

        if ($y < 1920.0) {
            $t = $y - 1900.0;

            return -2.79
                + 1.494119 * $t
                - 0.0598939 * $t ** 2
                + 0.0061966 * $t ** 3
                - 0.000197 * $t ** 4;
        }

        if ($y < 1941.0) {
            $t = $y - 1920.0;

            return 21.20 + 0.84493 * $t - 0.076100 * $t ** 2 + 0.0020936 * $t ** 3;
        }

        if ($y < 1961.0) {
            $t = $y - 1950.0;

            return 29.07 + 0.407 * $t - $t ** 2 / 233.0 + $t ** 3 / 2547.0;
        }

        if ($y < 1986.0) {
            $t = $y - 1975.0;

            return 45.45 + 1.067 * $t - $t ** 2 / 260.0 - $t ** 3 / 718.0;
        }

        if ($y < 2005.0) {
            $t = $y - 2000.0;

            return 63.86
                + 0.3345 * $t
                - 0.060374 * $t ** 2
                + 0.0017275 * $t ** 3
                + 0.000651814 * $t ** 4
                + 0.00002373599 * $t ** 5;
        }

        if ($y < 2050.0) {
            $t = $y - 2000.0;

            return 62.92 + 0.32217 * $t + 0.005589 * $t ** 2;
        }

        if ($y < 2150.0) {
            return -20.0 + 32.0 * (($y - 1820.0) / 100.0) ** 2 - 0.5628 * (2150.0 - $y);
        }

        // 2150年以降（外挿）
        $u = ($y - 1820.0) / 100.0;

        return -20.0 + 32.0 * $u * $u;
    }

    /**
     * NASA c 補正を含む ΔT（秒）を計算する。
     *
     * `MOON_MEEUS47` は NASA c 補正を Meeus Chapter 47 と組み合わせる実験モード。
     * Five Millennium Canon の改良 ELP-2000/82 用に導出された c 補正であり、
     * Chapter 47 への適用妥当性は確認されていない。Canon 互換または一般的な
     * 精度向上を保証するものではない。
     *
     * NASA の説明どおり 1955〜2005年は c=0、それ以外で式を適用する。
     *
     * @param float $y 小数年
     */
    private function deltaTForDecimalYear(float $y): float
    {
        $poly = $this->deltaTPolynomialForDecimalYear($y);

        if (!$this->applyNasaCCorrection) {
            return $poly;
        }

        // NASA の説明どおり 1955 ≤ y ≤ 2005 では c=0
        if ($y >= 1955.0 && $y <= 2005.0) {
            return $poly;
        }

        $c = -0.000012932 * ($y - 1955.0) ** 2;

        return $poly + $c;
    }

    /**
     * UTC 年月から ΔT（秒）を計算する。
     *
     * ΔT は月中近似（UTC 年月から y = year + (month - 0.5) / 12 で小数年を作る）。
     *
     * @param int $year UTC 年
     * @param int $month UTC 月（1〜12）
     */
    public function approximateDeltaTSeconds($year, $month): float
    {
        $y = $year + ($month - 0.5) / 12.0;

        return $this->deltaTForDecimalYear($y);
    }
}
