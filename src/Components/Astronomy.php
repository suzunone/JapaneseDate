<?php

namespace JapaneseDate\Components;

use DateTimeZone;
use InvalidArgumentException;
use JapaneseDate\Components\Contracts\MoonAlgorithm;
use JapaneseDate\Components\Contracts\SunAlgorithm;
use JapaneseDate\Components\Traits\OneTimeCacheTrait;
use JapaneseDate\DateTime;

/**
 * 暦計算で使用する太陽黄経・月齢・ユリウス日変換を提供する天文計算コンポーネント。
 *
 * 旧暦、二十四節気、月齢などの計算に必要な天文値を求めます。
 * 既定では太陽・月とも従来実装（`legacy`）を使用し、必要に応じて
 * 太陽計算を {@see Vsop87Astronomy}、月計算を
 * {@see ELP2000} へ切り替えられます。
 *
 * **提供する主な計算:**
 * - グレゴリオ暦とユリウス日の相互変換
 * - 太陽の視黄経および二十四節気境界の判定
 * - 月齢計算に必要な太陽・月の黄経差
 * - 計算結果の一時キャッシュ
 *
 * アルゴリズムの切り替えは {@see useSolarAlgorithm()} / {@see useMoonAlgorithm()} で行います。
 * {@see factory()} は現在の選択状態に対応したインスタンスを返します。
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
class Astronomy
{
    use OneTimeCacheTrait;

    public const SOLAR_LEGACY = 'legacy';

    public const SOLAR_VSOP87 = 'vsop87';

    public const MOON_LEGACY = 'legacy';

    public const MOON_ELP2000 = 'elp2000';

    /**
     * Meeus AA2 Chapter 47 アルゴリズム識別子（NASA c 補正あり、既定）。
     *
     * NASA の月の永年加速度補正項 c = -0.000012932*(y-1955)² を ΔT に加算する。
     * **これは Five Millennium Canon の改良 ELP-2000/82 用に導出された c 補正であり、
     * Meeus Chapter 47 への適用妥当性は確認されていない実験モード**。
     * Canon 互換または一般的な精度向上を保証するものではない。
     *
     * Legacy 太陽との組合せ精度: 月相判定精度は太陽側の誤差（最大 ±1°）に制限される。
     * VSOP87 太陽を推奨。
     */
    public const MOON_MEEUS47 = 'meeus47';

    /**
     * Meeus AA2 Chapter 47 アルゴリズム識別子（NASA c 補正なし、Chapter 47 標準モード）。
     * NASA 多項式のみ ΔT に使用。
     *
     * Legacy 太陽との組合せ精度: 月相判定精度は太陽側の誤差（最大 ±1°）に制限される。
     * VSOP87 太陽を推奨。
     */
    public const MOON_MEEUS47_NO_C = 'meeus47_no_c';

    public const DAY_TO_HOUR_FLOAT = 24.0;

    public const DAY_TO_MINUTE_FLOAT = 1440.0;

    public const DAY_TO_SECOND_FLOAT = 86400.0;

    /**
     * 1.0 / 86400.0;
     * @var float
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
     * @var string 太陽アルゴリズム
     */
    protected static string $solarAlgorithm = self::SOLAR_LEGACY;

    /**
     * @var string 月アルゴリズム
     */
    protected static string $moonAlgorithm = self::MOON_LEGACY;

    /**
     * @var string 日付境界計算に使用する太陽アルゴリズム
     */
    protected static string $boundarySolarAlgorithm = self::SOLAR_VSOP87;

    /**
     * @var string 日付境界計算に使用する月アルゴリズム
     */
    protected static string $boundaryMoonAlgorithm = self::MOON_MEEUS47;

    /**
     * @var array<string, self>
     */
    protected static array $instances = [];

    /**
     * 注入された太陽黄経計算アルゴリズム実装。
     */
    protected SunAlgorithm $sunAlgorithmImpl;

    /**
     * 注入された月黄経計算アルゴリズム実装。
     */
    protected MoonAlgorithm $moonAlgorithmImpl;

    /**
     * 朔探索ループ専用の縮約 ELP2000 実装。
     * moonAlgorithmImpl が厳密に ELP2000 クラスの場合のみ遅延生成される。
     */
    protected ?ELP2000Reduced $reducedMoonImpl = null;

    /**
     * 太陽・月の計算実装を注入して初期化する。
     *
     * 引数を省略した場合は `LegacyAstronomy` を使用する。
     * 両方省略すると同一の `LegacyAstronomy` インスタンスを共有する。
     *
     * @param SunAlgorithm|null $sunAlgorithm 太陽黄経計算実装（null の場合は Legacy）
     * @param MoonAlgorithm|null $moonAlgorithm 月黄経計算実装（null の場合は Legacy）
     */
    public function __construct(
        ?SunAlgorithm $sunAlgorithm = null,
        ?MoonAlgorithm $moonAlgorithm = null,
    ) {
        if ($sunAlgorithm === null && $moonAlgorithm === null) {
            $legacy = new LegacyAstronomy();
            $this->sunAlgorithmImpl = $legacy;
            $this->moonAlgorithmImpl = $legacy;
        } else {
            $this->sunAlgorithmImpl = $sunAlgorithm ?? new LegacyAstronomy();
            $this->moonAlgorithmImpl = $moonAlgorithm ?? new LegacyAstronomy();
        }
    }

    /**
     * 太陽黄経計算で使用するアルゴリズムを設定する。
     *
     * @param string $algorithm 太陽アルゴリズム
     * @return void
     * @throws InvalidArgumentException 未対応の太陽アルゴリズムが指定された場合
     */
    public static function useSolarAlgorithm(string $algorithm): void
    {
        if (!in_array($algorithm, [self::SOLAR_LEGACY, self::SOLAR_VSOP87], true)) {
            throw new InvalidArgumentException('Unsupported solar algorithm: ' . $algorithm);
        }

        self::$solarAlgorithm = $algorithm;
    }

    /**
     * 現在の太陽黄経計算アルゴリズムを返す。
     *
     * @return string 太陽アルゴリズム
     */
    public static function solarAlgorithm(): string
    {
        return self::$solarAlgorithm;
    }

    /**
     * 月黄経計算で使用するアルゴリズムを設定する。
     *
     * @param string $algorithm 月アルゴリズム
     * @return void
     * @throws InvalidArgumentException 未対応の月アルゴリズムが指定された場合
     */
    public static function useMoonAlgorithm(string $algorithm): void
    {
        if (!in_array($algorithm, [self::MOON_LEGACY, self::MOON_ELP2000, self::MOON_MEEUS47, self::MOON_MEEUS47_NO_C], true)) {
            throw new InvalidArgumentException('Unsupported moon algorithm: ' . $algorithm);
        }

        self::$moonAlgorithm = $algorithm;
    }

    /**
     * 現在の月黄経計算アルゴリズムを返す。
     *
     * @return string 月アルゴリズム
     */
    public static function moonAlgorithm(): string
    {
        return self::$moonAlgorithm;
    }

    /**
     * 日付境界計算で使用する太陽黄経アルゴリズムを設定する。
     *
     * @param string $algorithm 太陽アルゴリズム
     * @return void
     * @throws InvalidArgumentException 未対応の太陽アルゴリズムが指定された場合
     */
    public static function useBoundarySolarAlgorithm(string $algorithm): void
    {
        if (!in_array($algorithm, [self::SOLAR_LEGACY, self::SOLAR_VSOP87], true)) {
            throw new InvalidArgumentException('Unsupported solar algorithm: ' . $algorithm);
        }

        self::$boundarySolarAlgorithm = $algorithm;
    }

    /**
     * 現在の日付境界計算用太陽黄経アルゴリズムを返す。
     *
     * @return string 太陽アルゴリズム
     */
    public static function boundarySolarAlgorithm(): string
    {
        return self::$boundarySolarAlgorithm;
    }

    /**
     * 日付境界計算で使用する月黄経アルゴリズムを設定する。
     *
     * @param string $algorithm 月アルゴリズム
     * @return void
     * @throws InvalidArgumentException 未対応の月アルゴリズムが指定された場合
     */
    public static function useBoundaryMoonAlgorithm(string $algorithm): void
    {
        if (!in_array($algorithm, [self::MOON_LEGACY, self::MOON_ELP2000, self::MOON_MEEUS47, self::MOON_MEEUS47_NO_C], true)) {
            throw new InvalidArgumentException('Unsupported moon algorithm: ' . $algorithm);
        }

        self::$boundaryMoonAlgorithm = $algorithm;
    }

    /**
     * 現在の日付境界計算用月黄経アルゴリズムを返す。
     *
     * @return string 月アルゴリズム
     */
    public static function boundaryMoonAlgorithm(): string
    {
        return self::$boundaryMoonAlgorithm;
    }

    /**
     * 注入された太陽・月アルゴリズムの組み合わせ名を返す。
     *
     * @return string アルゴリズム組み合わせ名（例: "vsop87:elp2000"）
     */
    public function algorithmName(): string
    {
        return $this->sunAlgorithmName() . ':' . $this->moonAlgorithmName();
    }

    /**
     * 注入された太陽計算アルゴリズムの識別子を返す。
     *
     * @return string 太陽アルゴリズム識別子
     */
    public function sunAlgorithmName(): string
    {
        return $this->sunAlgorithmImpl->sunAlgorithmName();
    }

    /**
     * 注入された月計算アルゴリズムの識別子を返す。
     *
     * @return string 月アルゴリズム識別子
     */
    public function moonAlgorithmName(): string
    {
        return $this->moonAlgorithmImpl->moonAlgorithmName();
    }

    /**
     * 月相を求める（8分類）
     *
     * 位相角 (Λ_moon - Λ_sun) を 45° 刻みで 8 分類する。
     *   0: 新月, 1: 三日月, 2: 上弦, 3: 十三夜,
     *   4: 満月, 5: 十六夜, 6: 下弦, 7: 有明
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour 時（世界時）
     * @param float $min 分
     * @param float $sec 秒
     * @return int 月相 (0〜7)
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function moonPhase(int $year, int $month, int $day, float $hour, float $min, float $sec): int
    {
        $phase_angle = $this->moonPhaseAngle($year, $month, $day, $hour, $min, $sec);

        return (int) (($phase_angle + 22.5) / 45.0) % 8;
    }

    /**
     * 月の位相角を求める（太陽と月の視黄経差）
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour 時（世界時）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月の位相角（0°=新月, 90°=上弦, 180°=満月, 270°=下弦）
     * @throws \JapaneseDate\Exceptions\Exception|\DateInvalidTimeZoneException
     * @throws \Exception
     */
    public function moonPhaseAngle(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        $longitude_moon = $this->longitudeMoon($year, $month, $day, $hour, $min, $sec);
        $longitude_sun = $this->longitudeSun($year, $month, $day, $hour, $min, $sec);

        return $this->normalizeAngle($longitude_moon - $longitude_sun);
    }

    /**
     * 高速版月位相角計算（朔探索ループ専用）。
     *
     * 月黄経に {@see longitudeMoonFast()} を使用することで計算を高速化する。
     * 縮約版が適用されるのは注入された月実装が厳密に {@see ELP2000} の場合のみ。
     * それ以外のアルゴリズムは {@see longitudeMoon()} へフォールバックするため、
     * このメソッドはいずれのアルゴリズムに対しても安全に呼び出せる。
     *
     * **朔探索ループの符号反転検出および粗い二分探索専用。最終出力への使用は禁止。**
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時（日本標準時）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月の位相角近似値（0°=新月, 90°=上弦, 180°=満月, 270°=下弦）
     * @throws \Exception
     */
    public function moonPhaseAngleFast(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        $longitude_moon = $this->longitudeMoonFast($year, $month, $day, $hour, $min, $sec);
        $longitude_sun = $this->longitudeSun($year, $month, $day, $hour, $min, $sec);

        return $this->normalizeAngle($longitude_moon - $longitude_sun);
    }

    /**
     * 月の黄経計算（視黄経）
     *
     * 注入された `MoonAlgorithm` 実装に委譲し、結果をキャッシュします。
     *
     * @param int $year グレゴリオ暦
     * @param int $month
     * @param int $day
     * @param float $hour 時
     * @param float $min 分
     * @param float $sec 秒
     * @return    float 月の黄経（視黄経）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \Exception
     */
    public function longitudeMoon(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        $key = __METHOD__ . '-' . $this->moonAlgorithmName() . '-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, fn () => $this->moonAlgorithmImpl->longitudeMoon($year, $month, $day, $hour, $min, $sec));
    }

    /**
     * 朔探索ループ専用の高速月黄経近似計算。
     *
     * 注入された月実装のクラスが厳密に ELP2000（サブクラス不可）の場合は、
     * 縮約黄経級数（|c| >= 1e-4 の項のみ、20,560 項中 4,755 項）で評価した近似値を返す。
     * それ以外（Legacy / Meeus / ELP2000 サブクラス）は {@see longitudeMoon()} に委譲する。
     *
     * oneTimeCache のキーに 'elp2000_reduced' を含めることで
     * フル精度キャッシュとの衝突を防ぐ。
     *
     * **このメソッドは朔探索収束ループ内専用。最終出力への使用は禁止。**
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時（日本標準時）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月の黄経近似値（度、0〜360）
     * @throws \Exception
     */
    public function longitudeMoonFast(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        // instanceof ではなく get_class() で厳密一致させる。
        // ELP2000 サブクラスは級数を上書きしている可能性があり、
        // ELP2000Reduced（縮約版）との互換性が保証できないため。
        if (get_class($this->moonAlgorithmImpl) !== ELP2000::class) {
            return $this->longitudeMoon($year, $month, $day, $hour, $min, $sec);
        }
        if ($this->reducedMoonImpl === null) {
            $this->reducedMoonImpl = new ELP2000Reduced();
        }
        $key = __METHOD__ . '-elp2000_reduced-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, fn () => $this->reducedMoonImpl->longitudeMoon($year, $month, $day, $hour, $min, $sec));
    }

    /**
     * 太陽の黄経計算（視黄経）
     *
     * 注入された `SunAlgorithm` 実装に委譲し、結果をキャッシュします。
     *
     * @param int $year
     * @param int $month
     * @param float $day
     * @param float $hour
     * @param float $min
     * @param float $sec
     * @return    float 太陽の黄経（視黄経）
     * @throws \Exception
     */
    public function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
    {
        $key = __METHOD__ . '-' . $this->sunAlgorithmName() . '-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, fn () => $this->sunAlgorithmImpl->longitudeSun($year, $month, $day, $hour, $min, $sec));
    }

    /**
     * 角度の正規化（$angle を 0≦$angle＜360 にする）
     *
     * @param float $angle 角度
     * @return    float 角度（正規化後）
     */
    public function normalizeAngle(float $angle): float
    {
        return $angle - 360.0 * floor($angle / 360.0);
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
    public function gregorian2JD(int $year, int $month, int $day, float $hour, float $min, float $sec): float
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
    public function jD2Gregorian(float $jd): array
    {
        $cal = cal_from_jd(floor($jd), CAL_GREGORIAN);

        $time = 86400 * ($jd - floor($jd));
        $hour = floor($time / 3600.0);
        $min = floor(($time - 3600 * $hour) / 60.0);
        $sec = floor($time - 3600 * $hour - 60 * $min);

        return [$cal['year'], $cal['month'], $cal['day'], $hour, $min, $sec];
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
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function gregorian2JY(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        $timestamp = DateTime::factory(
            implode('-', [$year, $month, $day]) . ' ' . implode(':', [$hour, $min, $sec]),
            new DateTimeZone('UTC')
        )->timestamp;

        $diff_time = $timestamp - self::BASE_TIME;

        return ($diff_time + 32400.0) / 31557600.0;
    }

    /**
     * @return static
     */
    public static function factory(): self
    {
        return self::buildInstanceByAlgorithms(self::$solarAlgorithm, self::$moonAlgorithm);
    }

    /**
     * 日付境界計算用アルゴリズム設定でインスタンスを返す。
     *
     * グローバル状態を変更せずに境界アルゴリズムのインスタンスを取得します。
     * {@see factory()} と同じ `$instances` キャッシュを共有するため、
     * 通常アルゴリズムと境界アルゴリズムが同一組み合わせの場合は同じインスタンスを返します。
     *
     * @return static
     */
    public static function factoryForBoundary(): self
    {
        return self::buildInstanceByAlgorithms(self::$boundarySolarAlgorithm, self::$boundaryMoonAlgorithm);
    }

    /**
     * 指定したアルゴリズムの組み合わせでインスタンスを生成してキャッシュに格納し返す。
     *
     * @param string $solarAlgorithm 太陽黄経計算アルゴリズム識別子
     * @param string $moonAlgorithm 月黄経計算アルゴリズム識別子
     * @return static
     */
    protected static function buildInstanceByAlgorithms(string $solarAlgorithm, string $moonAlgorithm): self
    {
        $key = $solarAlgorithm . ':' . $moonAlgorithm;

        if (!isset(self::$instances[$key])) {
            $sunImpl = match ($solarAlgorithm) {
                self::SOLAR_VSOP87 => new Vsop87Astronomy(),
                default => null,
            };
            // ELP2000が大きすぎて認識されないので
            $moonImpl = match ($moonAlgorithm) {
                self::MOON_ELP2000 => new ELP2000(),
                self::MOON_MEEUS47 => new MeeusMoon(applyNasaCCorrection: true),
                self::MOON_MEEUS47_NO_C => new MeeusMoon(applyNasaCCorrection: false),
                default => null,
            };
            self::$instances[$key] = new self($sunImpl, $moonImpl);
        }

        return self::$instances[$key];
    }
}
