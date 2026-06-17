<?php

/** @noinspection PhpTooManyParametersInspection */

/**
 * 旧暦日付クラス
 *
 * 高野英明氏による「旧暦計算サンプルスクリプト」を参考にしています。<br />
 *
         * @link        (http:// www.vector.co.jp/soft/dos/personal/se016093.html)<br />
 * お手数ですが、再配布ご利用の際は、高野英明氏の「旧暦計算サンプルスクリプト」をDLし、
 * 規定に従ってください。<br />
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */

namespace JapaneseDate\Components;

use Carbon\Carbon;
use DateTimeZone;
use JapaneseDate\Components\Contracts\MoonAgeAlgorithm;
use JapaneseDate\Components\Traits\OneTimeCacheTrait;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Elements\LunarDate;
use JapaneseDate\Exceptions\ErrorException;

/**
 * グレゴリオ暦の日付から旧暦日付と二十四節気情報を算出するコンポーネント。
 *
 * 朔（新月）と中気の情報をもとに、指定日が属する旧暦年・月・日・閏月を求めます。
 * 年別の事前計算データが存在する場合は {@see Config} から取得し、
 * 不足する場合は天文計算コンポーネントを利用して必要な暦データを組み立てます。
 *
 * **算出する主な情報:**
 * - 旧暦年、旧暦月、旧暦日
 * - 平月または閏月の判定
 * - 対象日に該当する二十四節気
 *
 * 天文計算は現在選択されている {@see Astronomy} のアルゴリズムに
 * 依存します。`legacy` と `vsop87` の切り替えに合わせて、ファクトリーも
 * アルゴリズム別のインスタンスを返します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Component
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since        1.0.0
 */
class LunarCalendar
{
    use OneTimeCacheTrait;

    /**
     * 太陽黄経の日進度上限（°/日）。中気境界を飛び越えないジャンプ日数の算出に使用する
     *  1.04くらいまで詰められると思うが、中気の計算はそこまで重い処理ではないため安全側に倒す
     */
    protected const MAX_SUN_DAILY_MOTION = 1.10;

    /** 朔望月の平均周期（日）。朔ループのジャンプ日数見積もりに使用する */
    protected const SYNODIC_MONTH = 29.53;

    /** 朔境界前の安全マージン（日数）。次の朔日を飛び越えないようにこの日数分早めに切り替える */
    protected const SAKU_SKIP_MARGIN_DAYS = 3;

    /**
     * 朔の一覧
     *
     * @var array
     */
    protected array $lunar_calendar;

    protected Astronomy $astronomy;

    /**
     * 月齢計算アルゴリズム（Strategy）。
     *
     * @var MoonAgeAlgorithm
     */
    protected MoonAgeAlgorithm $moonAgeAlgorithm;

    /**
     * @param \JapaneseDate\Components\Astronomy|null $astronomy
     * @param \JapaneseDate\Components\Contracts\MoonAgeAlgorithm|null $moonAgeAlgorithm
     */
    public function __construct(?Astronomy $astronomy = null, ?MoonAgeAlgorithm $moonAgeAlgorithm = null)
    {
        $this->astronomy = $astronomy ?? Astronomy::factory();
        $this->moonAgeAlgorithm = $moonAgeAlgorithm ?? self::defaultMoonAgeAlgorithmFor($this->astronomy);
    }

    /**
     * 注入済み Astronomy の識別子から適切な MoonAgeAlgorithm を選択する。
     *
     * @param Astronomy $astronomy
     * @return MoonAgeAlgorithm
     */
    protected static function defaultMoonAgeAlgorithmFor(Astronomy $astronomy): MoonAgeAlgorithm
    {
        return match ($astronomy->moonAlgorithmName()) {
            Astronomy::MOON_ELP2000 => new Elp2000MoonAge($astronomy),
            Astronomy::MOON_MEEUS47,
            Astronomy::MOON_MEEUS47_NO_C => new MeeusMoonAge($astronomy),
            default => new LegacyMoonAge($astronomy),
        };
    }

    /**
     * @return static
     */
    public static function factory(): self
    {
        static $instances = [];

        $algorithm = Astronomy::solarAlgorithm() . ':' . Astronomy::moonAlgorithm();
        if (!isset($instances[$algorithm])) {
            $instances[$algorithm] = new static();
        }

        return $instances[$algorithm];
    }

    /**
     * @param DateTime|DateTimeImmutable $DateTime
     * @return LunarDate
     * @throws \DateInvalidTimeZoneException
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \JsonException
     */
    public function getLunarDate(DateTime|DateTimeImmutable $DateTime): LunarDate
    {
        return new LunarDate(
            $this->getLunarCalendarArray(
                $DateTime->year,
                $DateTime->month,
                $DateTime->day
            ),
            $this->findSolarTerm(
                $DateTime->year,
                $DateTime->month,
                $DateTime->day
            )
        );
    }

    /**
     * 旧暦を求める
     *
     * @param int $year 西暦年
     * @param int $month 月
     * @param int $day 日
     * @return    array [旧暦年, 平月／閏月 flag .... 平月:0 閏月:1, 旧暦月, 旧暦日]
     * @throws \DateInvalidTimeZoneException
     * @throws ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    protected function getLunarCalendarArray(int $year, int $month, int $day): array
    {
        $lunar_calendar = $this->getLunarCalendar($year);

        $julian_date = $this->astronomy()->gregorian2JD($year, $month, $day, 0, 0, 0);

        $items = [];
        foreach ($lunar_calendar as $index => $lunar) {
            if (!isset($lunar_calendar[$index + 1])) {
                // @codeCoverageIgnoreStart
                continue;
                // @codeCoverageIgnoreEnd
            }
            if ($julian_date >= $lunar['jd'] && $julian_date < $lunar_calendar[$index + 1]['jd']) {
                $lunar_day = $julian_date - $lunar['jd'] + 1.0;
                $items = [
                    LunarDate::YEAR_KEY => $lunar['lunar_year'],
                    LunarDate::IS_LEAP_MONTH_FLAG_KEY => $lunar['lunar_month_leap'],
                    LunarDate::MONTH_KEY => $lunar['lunar_month'],
                    LunarDate::DAY_KEY => $lunar_day,
                ];

                break;
            }
        }

        if ($items === []) {
            throw new ErrorException(sprintf(
                '旧暦日を算出できる朔区間が見つかりませんでした: %04d-%02d-%02d',
                $year,
                $month,
                $day
            ));
        }

        return $items;
    }

    /**
     * @param int $year
     * @return array
     * @throws \DateInvalidTimeZoneException
     * @throws ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    protected function getLunarCalendar(int $year): array
    {
        if (isset($this->lunar_calendar[$year])) {
            return $this->lunar_calendar[$year];
        }

        $this->lunar_calendar[$year] = Cache::forever(
            __METHOD__ . ':' . $this->astronomy()->algorithmName() . ':' . $year,
            function () use ($year) {
                return $this->makeLunarCalendar($year);
            }
        );

        return $this->lunar_calendar[$year];
    }

    /**
     * @return \JapaneseDate\Components\Astronomy
     */
    protected function astronomy(): Astronomy
    {
        return $this->astronomy;
    }

    /**
     * グレゴオリオ暦＝旧暦テーブル 作成
     *
     * @param int $year 西暦年
     * @return array 朔のテーブル
     * @throws \DateInvalidTimeZoneException
     * @throws ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \Exception
     */
    protected function makeLunarCalendar(int $year): array
    {
        $res = Config::getLC($year);
        if (count($res)) {
            return $res;
        }

        // 朔の日を求める
        $lunar_calendar = [];
        $counter = 0;
        $Date = Carbon::create($year - 1, 11, 10);
        $EndDate = Carbon::create($year + 1, 3);
        if (!$Date instanceof Carbon || !$EndDate instanceof Carbon) {
            // @codeCoverageIgnoreStart
            throw new ErrorException('Carbon instance expected');
            // @codeCoverageIgnoreEnd
        }

        $Moon = new Moon($this->astronomy());
        $end_timestamp = $EndDate->timestamp;
        while ($end_timestamp > $Date->timestamp) {
            if (in_array(
                $this->astronomy()->moonAlgorithmName(),
                [Astronomy::MOON_ELP2000, Astronomy::MOON_MEEUS47, Astronomy::MOON_MEEUS47_NO_C],
                true
            )) {
                $Date = $Moon->moonPhase($Date, 0.0)->setTimezone('Asia/Tokyo');
                if ($Date->timestamp >= $end_timestamp) {
                    // @codeCoverageIgnoreStart
                    break;
                    // @codeCoverageIgnoreEnd
                }

                $age1 = $this->moonAge($Date->year, $Date->month, $Date->day, 0, 0, 0);
                $age2 = $this->moonAge($Date->year, $Date->month, $Date->day, 23, 59, 59);
            } else {
                $age1 = $this->moonAge($Date->year, $Date->month, $Date->day, 0, 0, 0);

                // 次の朔まで安全マージン以上の残り日数がある場合は一気にスキップする
                $sakuSkipDays = $this->calcSakuSkipDays($age1);
                if ($sakuSkipDays > 0) {
                    $Date = $Date->addDays($sakuSkipDays);

                    continue;
                }

                $age2 = $this->moonAge($Date->year, $Date->month, $Date->day, 23, 59, 59);

                if ($age2 > $age1) {
                    $Date = $Date->addDay();

                    continue;
                }

                // 月齢がギリギリの場合、新月時間でキャリブレーションする
                // 境界アルゴリズム（デフォルト VSOP87/ELP2000）で新月日を再計算する。
                if ($Date->year >= 1900 && $age1 > 20 && $age2 < 0.17) {
                    $Date = (new Moon(Astronomy::factoryForBoundary()))
                        ->moonPhase($Date->subDays(2), 0.0)
                        ->setTimezone('Asia/Tokyo');

                    $age1 = $this->moonAge($Date->year, $Date->month, $Date->day, 0, 0, 0);
                    $age2 = $this->moonAge($Date->year, $Date->month, $Date->day, 23, 59, 59);
                } elseif ($Date->year < 1900 && $age1 > 20 && $age2 < 0.1) {
                    $Date = $Date->addDay();
                    $age1 = $this->moonAge($Date->year, $Date->month, $Date->day, 0, 0, 0);
                    $age2 = $this->moonAge($Date->year, $Date->month, $Date->day, 23, 59, 59);
                }
            }

            $lunar_calendar[$counter]['year'] = $Date->year;
            $lunar_calendar[$counter]['month'] = $Date->month;
            $lunar_calendar[$counter]['day'] = $Date->day;
            $lunar_calendar[$counter]['age'] = $age1;
            $lunar_calendar[$counter]['age_last'] = $age2;
            $lunar_calendar[$counter]['jd'] = $this->astronomy()->gregorian2JD($Date->year, $Date->month, $Date->day, 0, 0, 0);
            // $lunar_calendar[$counter]['gregorian'] = $this->jD2Gregorian($lunar_calendar[$counter]['jd']);

            // 実行時間短縮のため21日ほどすすめる
            $Date = $Date->addDays(21);
            $counter++;
        }

        // 中気を求める（$end_timestamp は朔ループで計算済みのものを再利用する）
        $sun_calendar = [];
        $counter = 0;
        $Date = Carbon::create($year - 1, 11, 10);
        while ($end_timestamp > $Date->timestamp) {
            $longitude_sun_1 = $this->astronomy()->longitudeSun($Date->year, $Date->month, $Date->day, 0, 0, 0);

            // 次の中気境界（30°の偶数倍）まで安全マージン以上の残り日数がある場合は一気にスキップする
            $chukiSkipDays = $this->calcChukiSkipDays($longitude_sun_1);
            if ($chukiSkipDays > 0) {
                $Date->addDays($chukiSkipDays);

                continue;
            }

            $longitude_sun_2 = $this->astronomy()->longitudeSun($Date->year, $Date->month, $Date->day, 24, 0, 0);
            $tmp_ls_1 = floor($longitude_sun_1 / 15.0);
            $tml_ls_2 = floor($longitude_sun_2 / 15.0);

            // キャリブレーション: 通常と境界のアルゴリズムが異なり、かつ奇数セクター終端付近の場合、
            // 境界アルゴリズムで中気日を確認する。
            // 例: legacy近似式は太陽黄経に最大1°程度の誤差を持ち、30°単位の中気境界直前に
            // 位置するケース（例: 2014年霜降）で検出日が1日遅れることがある。
            if ($Date->year >= 1900
                && $tml_ls_2 === $tmp_ls_1
                && ($tml_ls_2 % 2 !== 0)
                && fmod($longitude_sun_2, 30.0) >= 29.0
                && Astronomy::solarAlgorithm() !== Astronomy::boundarySolarAlgorithm()
            ) {
                $boundary_astro = Astronomy::factoryForBoundary();
                $boundary_lon_0 = $boundary_astro->longitudeSun($Date->year, $Date->month, $Date->day, 0, 0, 0);
                $boundary_lon_24 = $boundary_astro->longitudeSun($Date->year, $Date->month, $Date->day, 24, 0, 0);
                $boundary_t0 = floor($boundary_lon_0 / 15.0);
                $boundary_t24 = floor($boundary_lon_24 / 15.0);
                if ($boundary_t24 !== $boundary_t0 && $boundary_t24 % 2 === 0) {
                    $tml_ls_2 = $boundary_t24;
                }
            }

            if ($tml_ls_2 === $tmp_ls_1 || ($tml_ls_2 % 2 !== 0)) {
                $Date->addDay();

                continue;
            }

            $sun_calendar[$counter]['jd'] = $this->astronomy()->gregorian2JD($Date->year, $Date->month, $Date->day, 0, 0, 0);
            $lunar_month = floor($tml_ls_2 / 2) + 2;
            if ($lunar_month > 12) {
                $lunar_month -= 12;
            }
            $sun_calendar[$counter]['lunar_month'] = $lunar_month;
            $sun_calendar[$counter]['year'] = $Date->year;
            $counter++;

            // 同じ中気日を再判定しないよう21日進める
            $Date->addDays(21);
        }

        // 旧暦月と、閏月のフラグを追加（冬至月アンカー + 無中気法）
        $lunar_calendar_count = count($lunar_calendar);

        // パス1: 各月に含まれる中気の一覧を作成する。
        // 2033年問題のように1朔月へ複数の中気が入る場合があるため、最初の1件で打ち切らない。
        $monthChuki = [];
        for ($i = 0; $i < $lunar_calendar_count - 1; $i++) {
            foreach ($sun_calendar as $sun_item) {
                if ($lunar_calendar[$i]['jd'] <= $sun_item['jd']
                    && $lunar_calendar[$i + 1]['jd'] > $sun_item['jd']) {
                    $monthChuki[$i][] = $sun_item;
                }
            }
        }

        $winterSolsticeMonthIndexes = [];
        $winterSolsticeYears = [];
        foreach ($monthChuki as $i => $chukiItems) {
            foreach ($chukiItems as $chukiItem) {
                if ((int) $chukiItem['lunar_month'] === 11) {
                    $winterSolsticeMonthIndexes[] = $i;
                    $winterSolsticeYears[$i] = $chukiItem['year'];
                    break;
                }
            }
        }

        if (count($winterSolsticeMonthIndexes)) {
            $firstAnchorIndex = $winterSolsticeMonthIndexes[0];
            $currentMonth = 11;
            $currentYear = $winterSolsticeYears[$firstAnchorIndex];
            for ($i = $firstAnchorIndex; $i >= 0; $i--) {
                $lunar_calendar[$i]['lunar_month'] = (float) $currentMonth;
                $lunar_calendar[$i]['lunar_month_leap'] = false;
                $lunar_calendar[$i]['lunar_year'] = $currentYear;

                $currentMonth--;
                if ($currentMonth === 0) {
                    $currentMonth = 12; // @codeCoverageIgnore
                }
                if ($currentMonth === 12) {
                    $currentYear--; // @codeCoverageIgnore
                }
            }

            foreach ($winterSolsticeMonthIndexes as $anchorPosition => $anchorIndex) {
                $currentMonth = 11;
                $currentYear = $winterSolsticeYears[$anchorIndex];
                $lunar_calendar[$anchorIndex]['lunar_month'] = (float) $currentMonth;
                $lunar_calendar[$anchorIndex]['lunar_month_leap'] = false;
                $lunar_calendar[$anchorIndex]['lunar_year'] = $currentYear;

                $nextAnchorIndex = $winterSolsticeMonthIndexes[$anchorPosition + 1] ?? null;
                $endIndex = $nextAnchorIndex ?? $lunar_calendar_count - 1;
                $leapMonthsRemaining = $nextAnchorIndex === null ? 1 : max(0, $nextAnchorIndex - $anchorIndex - 12);

                for ($i = $anchorIndex + 1; $i < $endIndex; $i++) {
                    if ($leapMonthsRemaining > 0 && !isset($monthChuki[$i])) {
                        $lunar_calendar[$i]['lunar_month'] = (float) $currentMonth;
                        $lunar_calendar[$i]['lunar_month_leap'] = true;
                        $lunar_calendar[$i]['lunar_year'] = $currentYear;
                        $leapMonthsRemaining--;

                        continue;
                    }

                    $currentMonth++;
                    if ($currentMonth === 13) {
                        $currentMonth = 1;
                    }
                    if ($currentMonth === 1) {
                        $currentYear++;
                    }

                    $lunar_calendar[$i]['lunar_month'] = (float) $currentMonth;
                    $lunar_calendar[$i]['lunar_month_leap'] = false;
                    $lunar_calendar[$i]['lunar_year'] = $currentYear;
                }
            }
        }

        array_pop($lunar_calendar);

        return $lunar_calendar;
    }

    /**
     * 太陽黄経から次の中気境界（黄経が30°の偶数倍に達する日）まで、
     * 境界を飛び越えずにスキップできる最大日数を計算する。
     *
     * 太陽黄経の日進度上限（{@see self::MAX_SUN_DAILY_MOTION}°/日）を使い、
     * 上限速度で進んだ場合でも交差日の直前までに止まる日数を返す。
     * 戻り値が 0 の場合は呼び出し元で通常の1日刻り判定に移行すること。
     *
     * @param float $longitudeSun 現在の太陽黄経（度、0°〜360°）
     * @return int スキップ可能な日数（0 以上）
     */
    protected function calcChukiSkipDays(float $longitudeSun): int
    {
        $sector15 = (int) floor($longitudeSun / 15.0);
        $nextBoundary = ((int) floor($sector15 / 2) + 1) * 30.0;
        $remaining = $nextBoundary - $longitudeSun;

        // floor を使う: ceil だと境界から1日以内でもスキップしてしまい、
        // キャリブレーション（legacy 黄経ずれを VSOP87 で補正）が動かないため。
        return max(0, (int) floor($remaining / self::MAX_SUN_DAILY_MOTION) - 1);
    }

    /**
     * 月齢から次の朔までの残り日数を概算し、安全マージンを差し引いたスキップ可能な日数を計算する。
     *
     * 朔望月周期（{@see self::SYNODIC_MONTH} 日）から現在の月齢を引いた値が次の朔までの概算日数で、
     * そこから {@see self::SAKU_SKIP_MARGIN_DAYS} 日のマージンを差し引いた分だけジャンプできる。
     * 戻り値が 0 の場合は呼び出し元で通常の moonAge 比較判定に移行すること。
     *
     * @param float $moonAge 当日 0:00:00 の月齢（0 〜 約29.53 の範囲）
     * @return int スキップ可能な日数（0 以上）
     */
    protected function calcSakuSkipDays(float $moonAge): int
    {
        $remaining = self::SYNODIC_MONTH - $moonAge;

        return max(0, (int) floor($remaining) - self::SAKU_SKIP_MARGIN_DAYS);
    }

    /**
     * 月相を求める。
     *
     * 主要な月相点から外れている場合は null を返します。
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return int|null 月相 (0〜7)、主要な月相点以外は null
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function moonPhase(int $year, int $month, int $day, float $hour, float $min, float $sec): ?int
    {
        $phase = $this->astronomy()->moonPhase($year, $month, $day, $hour, $min, $sec);
        $Carbon = Carbon::create($year, $month, $day, (int) $hour, (int) $min, (int) $sec, 'Asia/Tokyo');
        if (!$Carbon instanceof Carbon) {
            // @codeCoverageIgnoreStart
            return null;
            // @codeCoverageIgnoreEnd
        }

        $phase_time = $phase / 8.0;

        $injectedMoonName = $this->astronomy()->moonAlgorithmName();

        $moonAstronomy = in_array($injectedMoonName, [Astronomy::MOON_MEEUS47, Astronomy::MOON_MEEUS47_NO_C], true)
            ? $this->astronomy()          // Meeus 系: 注入済み Astronomy をそのまま使用
            : Astronomy::factoryForBoundary(); // Legacy/ELP2000 系: 境界アルゴリズムで月相を計算
        $Moon = new Moon($moonAstronomy);
        $NextDateTime = $Moon->moonPhase($Carbon, $phase_time);
        $PreviousDateTime = $Moon->moonPhase($Carbon, $phase_time, true);

        $NearestPhaseDateTime = abs($NextDateTime->timestamp - $Carbon->timestamp) < abs($PreviousDateTime->timestamp - $Carbon->timestamp)
            ? $NextDateTime
            : $PreviousDateTime;
        if ($NearestPhaseDateTime->copy()->setTimezone('Asia/Tokyo')->format('Y-m-d') !== $Carbon->format('Y-m-d')) {
            return null;
        }

        return $phase;
    }

    /**
     * 月齢を求める（視黄経）
     *
     * 月齢計算は longitudeSun/longitudeMoon の反復収束を伴う重い処理であり、
     * 同一引数で複数回呼ばれる（朔ループ内・隣接年の重複計算範囲）。
     * OneTimeCacheTrait でメモ化し、同一インスタンス内での重複収束計算を抑制する。
     * 引数が1つでも異なれば別エントリとして計算する（0:00:00 と 23:59:59 は別）。
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour , $min, $sec 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return    float 月齢（視黄経）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     */
    public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        $key = __METHOD__ . ':' . $this->astronomy->algorithmName()
            . ':' . $year . ':' . $month . ':' . $day
            . ':' . $hour . ':' . $min . ':' . $sec;

        return $this->oneTimeCache(
            $key,
            fn () => $this->moonAgeAlgorithm->moonAge($year, $month, $day, $hour, $min, $sec)
        );
    }

    /**
     * その日が二十四節気かどうか
     *
     * legacy 式は約6時間遅れる場合があり、深夜近傍で発生する節気を翌日と判定しうる。
     * legacy 使用時は VSOP87 でクロスチェックし、結果が異なる場合は VSOP87 を優先する。
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @return    int|bool
     * @throws \DateMalformedStringException
     * @throws \JapaneseDate\Exceptions\Exception
     * @throws \Exception
     */
    public function findSolarTerm(int $year, int $month, int $day): bool|int
    {
        $astronomy = $this->astronomy();
        $boundaryAstronomy = Astronomy::factoryForBoundary();

        // 通常アルゴリズムと境界アルゴリズムが同一なら境界比較は不要
        if ($astronomy->sunAlgorithmName() === $boundaryAstronomy->sunAlgorithmName()) {
            return (new SolarTerm($astronomy))->findSolarTerm($year, $month, $day);
        }

        $boundaryResult = (new SolarTerm($boundaryAstronomy))->findSolarTerm($year, $month, $day);

        // 境界アルゴリズムが当日を節気と判定した場合はそれを優先する
        if ($boundaryResult !== false) {
            return $boundaryResult;
        }

        $normalResult = (new SolarTerm($astronomy))->findSolarTerm($year, $month, $day);

        // 通常アルゴリズムが当日を節気と判定しても、境界アルゴリズムが前日を同じ節気と
        // 判定していれば通常アルゴリズムの結果は1日遅れなので false を返す
        if ($normalResult !== false) {
            $yesterday = (new \DateTimeImmutable(
                sprintf('%04d-%02d-%02d 00:00:00', $year, $month, $day),
                new DateTimeZone('Asia/Tokyo')
            ))->modify('-1 day');
            $boundaryYesterday = (new SolarTerm($boundaryAstronomy))->findSolarTerm(
                (int) $yesterday->format('Y'),
                (int) $yesterday->format('m'),
                (int) $yesterday->format('d')
            );
            if ($boundaryYesterday === $normalResult) {
                return false;
            }
        }

        return $normalResult;
    }

    /**
     * 月の位相角を求める（太陽と月の視黄経差、0°〜360°）
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return float 月の位相角（0°=新月, 90°=上弦, 180°=満月, 270°=下弦）
     * @throws \DateInvalidTimeZoneException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function moonPhaseAngle(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        return $this->astronomy()->moonPhaseAngle($year, $month, $day, $hour, $min, $sec);
    }
}
