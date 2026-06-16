<?php /** @noinspection PhpComposerExtensionStubsInspection */

namespace JapaneseDate\Components;

use DateTimeImmutable;
use DateTimeZone;
use InvalidArgumentException;
use JapaneseDate\Components\Contracts\MoonAlgorithm;
use JapaneseDate\Components\Traits\DeltaTTrait;
use JapaneseDate\Components\Traits\ELP2000Sub;

/**
 * ELP2000-82B による月位置計算コンポーネント。
 *
 * 移植元:
 * - elp2000-82b.js (Greg Miller, celestialprogramming.com, public domain)
 * - JavaScript class: ELP2000_82b
 *
 * 入力は TDB のユリウス日、出力は J2000 平均動的黄道・慣性分点における
 * 地心月位置 [x, y, z] km を返します。
 * 公開 precise API は数値文字列を返しますが、38,000 項規模の級数評価と三角関数は
 * PHP の float で行います。BCMath は時刻引数や多項式の入力整形に使います。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 *
 * @phpstan-type Decimal numeric-string
 * @phpstan-type Vector3 array{0: Decimal, 1: Decimal, 2: Decimal}
 */
class ELP2000 implements MoonAlgorithm
{
    use DeltaTTrait;
    use ELP2000Sub;

    protected const BC_J2000 = '2451545.0';
    protected const BC_JULIAN_DAYS_PER_CENTURY = '36525.0';

    /**
     * BCMath 計算時の小数桁数です。
     * @var int
     */
    protected $scale;

    /**
     * @param int $scale
     */
    public function __construct(int $scale = 30)
    {
        if ($scale < 0) {
            throw new InvalidArgumentException('BCMath scale must be greater than or equal to 0.');
        }

        $this->scale = $scale;
    }

    /**
     * BCMath 計算時の小数桁数を変更します。
     *
     * テストからのみ使用。
     * @noinspection PhpUnused
     * @param int $scale 小数桁数
     * @return $this
     */
    public function setScale($scale): self
    {
        if ($scale < 0) {
            throw new InvalidArgumentException('BCMath scale must be greater than or equal to 0.');
        }

        $this->scale = $scale;

        return $this;
    }

    /**
     * BCMath 計算時の小数桁数を返します。
     *
     * テストからのみ使用。
     * @noinspection PhpUnused
     * @return int 小数桁数
     */
    public function scale(): int
    {
        return $this->scale;
    }

    /**
     * このアルゴリズムの月計算識別子を返す。
     *
     * @noinspection PhpUnused
     * @return string 常に 'elp2000'
     */
    public function moonAlgorithmName(): string
    {
        return 'elp2000';
    }

    /**
     * ELP2000-82B を使用して月の視黄経を計算して返す。
     *
     * 入力は日本標準時のグレゴリオ暦年月日時分秒です。
     * 内部で UT ユリウス日へ変換し、ΔT による TT 近似補正を加えた上で
     * ELP2000 の TDB 入力として扱います。
     * TDB と TT の周期差はミリ秒程度なので、暦用途では無視します。
     *
     * @param int $year グレゴリオ暦の年
     * @param int $month グレゴリオ暦の月
     * @param int $day グレゴリオ暦の日
     * @param float $hour 時（日本標準時）
     * @param float $min 分
     * @param float $sec 秒
     * @return float 月の視黄経（度、0〜360）
     * @throws \Exception
     */
    public function longitudeMoon($year, $month, $day, $hour, $min, $sec): float
    {
        $utc = new DateTimeImmutable(
            sprintf('%04d-%02d-%02d %02d:%02d:%02d', $year, $month, $day, (int)$hour, (int)$min, (int)$sec),
            new DateTimeZone('UTC')
        );

        $timestamp = (int)$utc->format('U');
        $utJd = $timestamp / 86400.0
            + 2440587.5
            + (($sec - (int)$sec) / 86400.0)
            - 0.375; // JD_TIME_ZONE_ADJUSTMENT (9/24)
        $tdbJd = $utJd + $this->approximateDeltaTSeconds($year, $month) / 86400.0;

        return (float)$this->preciseLongitude(sprintf('%.10F', $tdbJd));
    }

    /**
     * 月の地心黄経（度）を数値文字列で取得します。
     *
     * 黄道フレームは ELP2000 平均黄道で、章動補正は適用しません。
     * 朔望判定で太陽黄経と比較する場合は、太陽側も同じ平均黄道系へ揃えるのが理想です。
     * 現状の {@see Vsop87Astronomy::longitudeSun()} は高精度な比較対象ですが、見かけ黄経の
     * 光行差・章動補正が含まれる点に注意してください。
     * J2000 慣性フレームの座標が必要な場合は {@see getPrecisePosition()} を使用します。
     *
     * @param int|float|string $julianDate TDB のユリウス日
     * @return numeric-string 月の地心黄経（度、0〜360）
     */
    public function preciseLongitude($julianDate): string
    {
        $jd = $this->decimal($julianDate);
        $t = $this->julianCenturiesFromJ2000($jd);

        $lonArcsec = $this->computeLongitudeSeries($t);

        $lon = $this->eclipticLonRadFromSeries($lonArcsec, (float)$t);
        $lonDeg = fmod($lon * 180.0 / M_PI, 360.0);
        if ($lonDeg < 0.0) {
            $lonDeg += 360.0;
        }

        return (string)$lonDeg;
    }

    /**
     * int/float/string を BCMath 用数値文字列に変換します。
     *
     * 非数値は受け付けません。科学記法は BCMath が扱える通常表記へ正規化します。
     *
     * @param int|float|string $value
     * @return numeric-string
     */
    protected function decimal($value): string
    {
        if (is_int($value)) {
            return (string)$value;
        }

        if (is_float($value)) {
            if (!is_finite($value)) {
                throw new InvalidArgumentException('ELP2000 numeric value must be finite.');
            }

            return $this->bcNormalize(sprintf('%.40F', $value));
        }

        return $this->bcNormalize($value);
    }

    /**
     * 科学記法を含む数値文字列を BCMath が受け付ける形式に変換します。
     *
     * @param string $value
     * @return numeric-string
     */
    protected function bcNormalize($value): string
    {
        $value = trim($value);

        if (!is_numeric($value)) {
            throw new InvalidArgumentException('ELP2000 numeric value must be numeric: ' . $value);
        }

        if (strpos($value, 'e') !== false || strpos($value, 'E') !== false) {
            return sprintf('%.40F', (float)$value);
        }

        return $value;
    }

    /**
     * J2000.0 からのユリウス世紀を求めます。
     *
     * @param string $julianDate TDB のユリウス日
     * @return numeric-string J2000.0 起算のユリウス世紀
     */
    protected function julianCenturiesFromJ2000($julianDate): string
    {
        return bcdiv(
            bcsub($julianDate, self::BC_J2000, $this->scale),
            self::BC_JULIAN_DAYS_PER_CENTURY,
            $this->scale
        );
    }

    /**
     * 全級数（main problem + tides + planetary）を合算します。
     *
     * 返り値は ELP2000 内部単位: lon/lat は角秒 (arcsec), r は正規化距離。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return array{0: float, 1: float, 2: float} [lon_arcsec, lat_arcsec, r_normalized]
     */
    protected function computeSeries($t): array
    {
        return [
            $this->computeLongitudeSeries($t),
            $this->computeLatitudeSeries($t),
            $this->computeDistanceSeries($t),
        ];
    }

    /**
     * 級数評価に使う引数群を float へ変換して取得します。
     *
     * lon/lat/r 各級数の計算で共通して使用する D, l', l, F（および
     * その一次近似・惑星平均黄経 p1...p8）を float に変換してまとめて返します。
     * BCMath での引数算出は sin() の呼び出し回数に比べてコストが小さいため、
     * computeLongitudeSeries / computeLatitudeSeries / computeDistanceSeries の
     * それぞれで個別に呼び出しても問題ありません。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return array{0: float, 1: float, 2: float, 3: float, 4: float, 5: float, 6: float, 7: float, 8: float, 9: float, 10: float, 11: float, 12: float, 13: float, 14: float, 15: float, 16: float} [ft, fd, flp, fl, ff, fpd, fplp, fpl, fpf, fp1, fp2, fp3, fp4, fp5, fp6, fp7, fp8]
     */
    protected function seriesArgumentsAsFloats($t): array
    {
        $args = $this->lunarArguments($t);
        $linArgs = $this->linearLunarArguments($t);
        $planArgs = $this->planetaryArguments($t);

        return [
            (float)$t,
            (float)$args['d'],
            (float)$args['lp'],
            (float)$args['l'],
            (float)$args['f'],
            (float)$linArgs['d'],
            (float)$linArgs['lp'],
            (float)$linArgs['l'],
            (float)$linArgs['f'],
            (float)$planArgs['p1'],
            (float)$planArgs['p2'],
            (float)$planArgs['p3'],
            (float)$planArgs['p4'],
            (float)$planArgs['p5'],
            (float)$planArgs['p6'],
            (float)$planArgs['p7'],
            (float)$planArgs['p8'],
        ];
    }

    /**
     * 黄経級数（main problem + tides + planetary）のみを合算します。
     *
     * 黄緯・距離の級数は評価しないため、{@see preciseLongitude} のように
     * 黄経のみを必要とする呼び出しでは {@see computeSeries} より高速です。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return float lon_arcsec（ELP2000 内部単位、角秒）
     */
    protected function computeLongitudeSeries($t): float
    {
        [$ft, $fd, $flp, $fl, $ff, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8]
            = $this->seriesArgumentsAsFloats($t);

        $lon = 0.0;

        $lon += $this->mainProblemLonFloat($fd, $flp, $fl, $ff);

        $lon += $this->tidesLon3Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lon += $this->tidesLon6Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lon += $this->tidesLon21Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lon += $this->tidesLon24Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lon += $this->tidesLon27Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lon += $this->tidesLon30Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lon += $this->tidesLon33Float($ft, $fpd, $fplp, $fpl, $fpf);

        $lon += $this->planetaryLon9Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $lon += $this->planetaryLon12Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $lon += $this->planetaryLon15Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $lon += $this->planetaryLon18Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);

        return $lon;
    }

    /**
     * 黄緯級数（main problem + tides + planetary）のみを合算します。
     *
     * 黄経・距離の級数は評価しないため、{@see preciseLatitude} のように
     * 黄緯のみを必要とする呼び出しでは {@see computeSeries} より高速です。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return float lat_arcsec（ELP2000 内部単位、角秒）
     */
    protected function computeLatitudeSeries($t): float
    {
        [$ft, $fd, $flp, $fl, $ff, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8]
            = $this->seriesArgumentsAsFloats($t);

        $lat = 0.0;

        $lat += $this->mainProblemLatFloat($fd, $flp, $fl, $ff);

        $lat += $this->tidesLat4Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lat += $this->tidesLat7Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lat += $this->tidesLat25Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lat += $this->tidesLat22Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lat += $this->tidesLat28Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lat += $this->tidesLat31Float($ft, $fpd, $fplp, $fpl, $fpf);
        $lat += $this->tidesLat34Float($ft, $fpd, $fplp, $fpl, $fpf);

        $lat += $this->planetaryLat10Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $lat += $this->planetaryLat13Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $lat += $this->planetaryLat16Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $lat += $this->planetaryLat19Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);

        return $lat;
    }

    /**
     * 距離級数（main problem + tides + planetary）のみを合算します。
     *
     * 黄経・黄緯の級数は評価しないため、{@see preciseDistance} のように
     * 距離のみを必要とする呼び出しでは {@see computeSeries} より高速です。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return float r_normalized（ELP2000 内部単位、正規化距離）
     */
    protected function computeDistanceSeries($t): float
    {
        [$ft, $fd, $flp, $fl, $ff, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8]
            = $this->seriesArgumentsAsFloats($t);

        $r = 0.0;

        $r += $this->mainProblemRFloat($fd, $flp, $fl, $ff);

        $r += $this->tidesR5Float($ft, $fpd, $fplp, $fpl, $fpf);
        $r += $this->tidesR8Float($ft, $fpd, $fplp, $fpl, $fpf);
        $r += $this->tidesR23Float($ft, $fpd, $fplp, $fpl, $fpf);
        $r += $this->tidesR26Float($ft, $fpd, $fplp, $fpl, $fpf);
        $r += $this->tidesR29Float($ft, $fpd, $fplp, $fpl, $fpf);
        $r += $this->tidesR32Float($ft, $fpd, $fplp, $fpl, $fpf);
        $r += $this->tidesR35Float($ft, $fpd, $fplp, $fpl, $fpf);

        $r += $this->planetaryR11Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $r += $this->planetaryR14Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $r += $this->planetaryR17Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);
        $r += $this->planetaryR20Float($ft, $fpd, $fplp, $fpl, $fpf, $fp1, $fp2, $fp3, $fp4, $fp5, $fp6, $fp7, $fp8);

        return $r;
    }

    /**
     * 月の基本引数 D, l', l, F を求めます（高次多項式）。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return array{d: numeric-string, lp: numeric-string, l: numeric-string, f: numeric-string}
     */
    protected function lunarArguments($t): array
    {
        $d = $this->polynomial([
            '-1.5436467606527627e-10', '3.1973462269173895e-8',
            '-0.00002844935162118868', '7771.377146811758', '5.198466741027443',
        ], $t);

        $lp = $this->polynomial([
            '7.272205216643039e-13', '7.126761112310179e-10',
            '-0.000002680534842854624', '628.301955168488', '-0.04312518020812495',
        ], $t);

        $l = $this->polynomial([
            '-1.1863390776750345e-9', '2.504111144298864e-7',
            '0.00015702775761561094', '8328.691426955555', '2.3555558982657994',
        ], $t);

        $f = $this->polynomial([
            '2.021673050226763e-11', '-4.949947684128362e-9',
            '-0.0000593921000043237', '8433.466158130539', '1.627905233371468',
        ], $t);

        return ['d' => $d, 'lp' => $lp, 'l' => $l, 'f' => $f];
    }

    /**
     * Horner 法で多項式を評価します。
     *
     * 係数は高次から低次へ並べます。
     * 例: a4*t^4 + a3*t^3 + a2*t^2 + a1*t + a0 は ['a4','a3','a2','a1','a0'] と渡す。
     * BCMath は科学記法を受け付けないため係数は事前に正規化されます。
     *
     * @param list<numeric-string> $coefficients 高次から低次へ並べた係数
     * @param string $t
     * @return numeric-string
     */
    protected function polynomial($coefficients, $t): string
    {
        $result = $this->bcNormalize($coefficients[0]);

        for ($i = 1, $n = count($coefficients); $i < $n; $i++) {
            $result = bcadd(bcmul($result, $t, $this->scale), $this->bcNormalize($coefficients[$i]), $this->scale);
        }

        return $result;
    }

    /**
     * 摂動用の一次近似月引数を求めます。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return array{d: numeric-string, lp: numeric-string, l: numeric-string, f: numeric-string}
     */
    protected function linearLunarArguments($t): array
    {
        return [
            'd' => $this->add('5.198466741027443', $this->mul('7771.377146811758', $t)),
            'lp' => $this->add('-0.04312518020812495', $this->mul('628.301955168488', $t)),
            'l' => $this->add('2.3555558982657994', $this->mul('8328.691426955555', $t)),
            'f' => $this->add('1.627905233371468', $this->mul('8433.466158130539', $t)),
        ];
    }

    /**
     * BCMath による加算を行います。
     *
     * @param string $left
     * @param string $right
     * @return numeric-string
     */
    protected function add($left, $right): string
    {
        return bcadd($this->bcNormalize($left), $this->bcNormalize($right), $this->scale);
    }

    /**
     * BCMath による乗算を行います。
     *
     * @param string $left
     * @param string $right
     * @return numeric-string
     */
    protected function mul($left, $right): string
    {
        return bcmul($this->bcNormalize($left), $this->bcNormalize($right), $this->scale);
    }

    /**
     * 惑星平均黄経 p1...p8 を求めます。
     *
     * @param string $t J2000.0 起算のユリウス世紀
     * @return array{p1: numeric-string, p2: numeric-string, p3: numeric-string, p4: numeric-string, p5: numeric-string, p6: numeric-string, p7: numeric-string, p8: numeric-string}
     */
    protected function planetaryArguments($t): array
    {
        return [
            'p1' => $this->add('4.4026088424029615', $this->mul('2608.7903141574106', $t)),
            'p2' => $this->add('3.1761466969075944', $this->mul('1021.3285546211089', $t)),
            'p3' => $this->add('1.753470343150658', $this->mul('628.3075849621554', $t)),
            'p4' => $this->add('6.203480913399945', $this->mul('334.06124314922965', $t)),
            'p5' => $this->add('0.5995464973886735', $this->mul('52.96909650947205', $t)),
            'p6' => $this->add('0.8740167565184808', $this->mul('21.329909543800007', $t)),
            'p7' => $this->add('5.481293871604991', $this->mul('7.4781598567143535', $t)),
            'p8' => $this->add('5.311886286783467', $this->mul('3.813303563758456', $t)),
        ];
    }


    /**
     * ELP2000 の lon_arcsec を黄道面の黄経 (rad) に変換します。
     *
     * ELP2000 の級数で使われている月平均黄経の係数に合わせて、
     * 日付の平均黄道面における月黄経を返します。longitudeSun() との比較に使用します。
     *
     * @param float $lonArcsec ELP2000 出力の黄経（角秒）
     * @param float $t J2000.0 起算のユリウス世紀
     * @return float 黄道面黄経（rad）
     */
    protected function eclipticLonRadFromSeries($lonArcsec, $t): float
    {
        $rad = 648000.0 / M_PI;
        $ft2 = $t * $t;
        $ft3 = $ft2 * $t;
        $ft4 = $ft3 * $t;

        return $lonArcsec / $rad
            + 3.810344430588308
            + 8399.709113522267 * $t
            - 0.000028547283984772807 * $ft2
            + 3.201709550047375e-8 * $ft3
            - 1.5363745554361197e-10 * $ft4;
    }

    /**
     * 月の地心直交座標を取得します（float 版）。
     *
     * テストからのみ使用。
     * @noinspection PhpUnused
     * @param int|float|string $julianDate TDB のユリウス日
     * @return array{0: float, 1: float, 2: float} [x, y, z] km
     */
    public function getPosition($julianDate): array
    {
        $pos = $this->getPrecisePosition($julianDate);

        return [(float)$pos[0], (float)$pos[1], (float)$pos[2]];
    }

    /**
     * 月の地心直交座標を数値文字列で取得します。
     *
     * 返却型は BCMath と扱いやすい numeric-string ですが、級数評価は float で行います。
     *
     * @param int|float|string $julianDate TDB のユリウス日
     * @return array{0: numeric-string, 1: numeric-string, 2: numeric-string} [x, y, z] km
     */
    public function getPrecisePosition($julianDate): array
    {
        $jd = $this->decimal($julianDate);
        $t = $this->julianCenturiesFromJ2000($jd);

        [$lon, $lat, $r] = $this->computeSeries($t);

        $pos = [(string)$lon, (string)$lat, (string)$r];

        return $this->convertToInertialEclipticOfJ2000($pos, $t);
    }

    /**
     * ELP2000 の lon/lat/r を J2000 慣性黄道直交座標へ変換します。
     *
     * 移植元 JS: ELP2000_82b.convertToInertialEclipticOfJ2000(r, t)
     *
     * @param array{0: numeric-string, 1: numeric-string, 2: numeric-string} $position [lon_arcsec, lat_arcsec, r_normalized]
     * @param string $t J2000.0 起算のユリウス世紀
     * @return array{0: numeric-string, 1: numeric-string, 2: numeric-string} [x, y, z] km
     */
    protected function convertToInertialEclipticOfJ2000($position, $t): array
    {
        $rad = 648000.0 / M_PI;
        $a0 = 384747.9806448954;
        $ath = 384747.9806743165;
        $ft = (float)$t;
        $ft2 = $ft * $ft;
        $ft3 = $ft2 * $ft;
        $ft4 = $ft3 * $ft;

        $lonRad = (float)$position[0] / $rad
            + 3.810344430588308
            + 8399.684731773914 * $ft
            - 0.000028547283984772807 * $ft2
            + 3.201709550047375e-8 * $ft3
            - 1.5363745554361197e-10 * $ft4;

        $latRad = (float)$position[1] / $rad;
        $rKm = (float)$position[2] * $a0 / $ath;

        $x1 = $rKm * cos($latRad);
        $x2 = $x1 * sin($lonRad);
        $x1 *= cos($lonRad);
        $x3 = $rKm * sin($latRad);

        $pw = (1.0180391e-5 + 4.7020439e-7 * $ft - 5.417367e-10 * $ft2 - 2.507948e-12 * $ft3 + 4.63486e-15 * $ft4) * $ft;
        $qw = (-1.13469002e-4 + 1.2372674e-7 * $ft + 1.265417e-9 * $ft2 - 1.371808e-12 * $ft3 - 3.20334e-15 * $ft4) * $ft;

        $ra = 2.0 * sqrt(1.0 - $pw * $pw - $qw * $qw);
        $pwqw = 2.0 * $pw * $qw;
        $pw2 = 1.0 - 2.0 * $pw * $pw;
        $qw2 = 1.0 - 2.0 * $qw * $qw;
        $pw *= $ra;
        $qw *= $ra;

        $rx = $pw2 * $x1 + $pwqw * $x2 + $pw * $x3;
        $ry = $pwqw * $x1 + $qw2 * $x2 - $qw * $x3;
        $rz = -$pw * $x1 + $qw * $x2 + ($pw2 + $qw2 - 1.0) * $x3;

        return [(string)$rx, (string)$ry, (string)$rz];
    }

    /**
     * 月の地心黄経（度）を取得します。
     *
     * テストからのみ使用。
     * @noinspection PhpUnused
     * @param int|float|string $julianDate TDB のユリウス日
     * @return float 月の地心黄経（度）
     */
    public function longitude($julianDate): float
    {
        return (float)$this->preciseLongitude($julianDate);
    }

    /**
     * 月の地心黄緯（度）を取得します。
     *
     * テストからのみ使用。
     * @noinspection PhpUnused
     * @param int|float|string $julianDate TDB のユリウス日
     * @return float 月の地心黄緯（度）
     */
    public function latitude($julianDate): float
    {
        return (float)$this->preciseLatitude($julianDate);
    }

    /**
     * 月の地心黄緯（度）を BCMath 数値文字列で取得します。
     *
     * @param int|float|string $julianDate TDB のユリウス日
     * @return numeric-string 月の地心黄緯（度）
     */
    public function preciseLatitude($julianDate): string
    {
        $jd = $this->decimal($julianDate);
        $t = $this->julianCenturiesFromJ2000($jd);

        $latArcsec = $this->computeLatitudeSeries($t);

        $latRad = $latArcsec / (648000.0 / M_PI);

        return (string)($latRad * 180.0 / M_PI);
    }

    /**
     * 月までの地心距離（km）を取得します。
     *
     * テストからのみ使用。
     * @noinspection PhpUnused
     * @param int|float|string $julianDate TDB のユリウス日
     * @return float 月までの距離（km）
     */
    public function distance($julianDate): float
    {
        return (float)$this->preciseDistance($julianDate);
    }

    /**
     * 月までの地心距離（km）を BCMath 数値文字列で取得します。
     *
     * @param int|float|string $julianDate TDB のユリウス日
     * @return numeric-string 月までの距離（km）
     */
    public function preciseDistance($julianDate): string
    {
        $jd = $this->decimal($julianDate);
        $t = $this->julianCenturiesFromJ2000($jd);

        $rNorm = $this->computeDistanceSeries($t);

        $a0 = 384747.9806448954;
        $ath = 384747.9806743165;

        return (string)($rNorm * $a0 / $ath);
    }
}
