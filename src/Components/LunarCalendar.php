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
use JapaneseDate\Components\Traits\OneTimeCacheTrait;
use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Elements\LunarDate;
use JapaneseDate\Exceptions\ErrorException;

/**
 * Class LunarCalendar
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
     * 朔の一覧
     *
     * @var array
     */
    protected array $lunar_calendar;


    protected Astronomy $astronomy;

    public function __construct(?Astronomy $astronomy = null)
    {
        $this->astronomy = $astronomy ?? Astronomy::factory();
    }

    protected function astronomy(): Astronomy
    {
        return $this->astronomy;
    }

    /**
     * @return static
     */
    public static function factory(): self
    {
        static $instance;

        if (!$instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $DateTime
     * @return \JapaneseDate\Elements\LunarDate
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
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
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
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
                    LunarDate::YEAR_KEY               => $lunar['lunar_year'],
                    LunarDate::IS_LEAP_MONTH_FLAG_KEY => $lunar['lunar_month_leap'],
                    LunarDate::MONTH_KEY              => $lunar['lunar_month'],
                    LunarDate::DAY_KEY                => $lunar_day,
                ];

                break;
            }
        }

        return $items;
    }

    /**
     * @param int $year
     * @return array
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getLunarCalendar(int $year): array
    {
        if (isset($this->lunar_calendar[$year])) {
            return $this->lunar_calendar[$year];
        }

        $this->lunar_calendar[$year] = Cache::forever(
            __METHOD__ . ':' . $year,
            function () use ($year) {
                return $this->makeLunarCalendar($year);
            }
        );

        return $this->lunar_calendar[$year];
    }

    /**
     * グレゴオリオ暦＝旧暦テーブル 作成
     *
     * @param int $year 西暦年
     * @return array 朔のテーブル
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
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

        $moon = new Moon();
        $end_timestamp = $EndDate->timestamp;
        while ($end_timestamp > $Date->timestamp) {
            $age1 = $this->moonAge($Date->year, $Date->month, $Date->day, 0, 0, 0);
            $age2 = $this->moonAge($Date->year, $Date->month, $Date->day, 23, 59, 59);

            if ($age2 > $age1) {
                $Date = $Date->addDay();

                continue;
            }

            // 月齢がギリギリの場合、新月時間でキャリブレーションする
            if ($Date->year >= 1900 && $age1 > 20 && $age2 < 0.17) {
                $Date = $moon->moonPhase($Date->subDays(2), 0.0);
                $age1 = $this->moonAge($Date->year, $Date->month, $Date->day, 0, 0, 0);
                $age2 = $this->moonAge($Date->year, $Date->month, $Date->day, 23, 59, 59);
            } elseif ($Date->year < 1900 && $age1 > 20 && $age2 < 0.1) {
                $Date = $Date->addDay();
                $age1 = $this->moonAge($Date->year, $Date->month, $Date->day, 0, 0, 0);
                $age2 = $this->moonAge($Date->year, $Date->month, $Date->day, 23, 59, 59);
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

        // 中気を求める
        $sun_calendar = [];
        $counter = 0;
        $Date = Carbon::create($year - 1, 11, 10);
        $EndDate = Carbon::create($year + 1, 3);

        $end_timestamp = $EndDate->timestamp;
        while ($end_timestamp > $Date->timestamp) {
            $longitude_sun_1 = $this->astronomy()->longitudeSun($Date->year, $Date->month, $Date->day, 0, 0, 0);
            $longitude_sun_2 = $this->astronomy()->longitudeSun($Date->year, $Date->month, $Date->day, 24, 0, 0);
            $tmp_ls_1 = floor($longitude_sun_1 / 15.0);
            $tml_ls_2 = floor($longitude_sun_2 / 15.0);

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

            // 実行時間短縮のため、21日ほどすすめる
            $Date->addDays(21);
        }

        // 旧暦月と、閏月のフラグを追加
        $lunar_calendar_count = count($lunar_calendar);
        for ($iterator_1 = 0; $iterator_1 < $lunar_calendar_count - 1; $iterator_1++) {
            foreach ($sun_calendar as $sun_item) {
                if (!($lunar_calendar[$iterator_1]['jd'] <= $sun_item['jd'] && $lunar_calendar[$iterator_1 + 1]['jd'] > $sun_item['jd'])) {
                    continue;
                }
                $lunar_calendar[$iterator_1]['lunar_month'] = $sun_item['lunar_month'];
                $lunar_calendar[$iterator_1]['lunar_month_leap'] = false;

                $lunar_calendar[$iterator_1 + 1]['lunar_month'] = $sun_item['lunar_month'];
                $lunar_calendar[$iterator_1 + 1]['lunar_month_leap'] = true;

                $lunar_calendar[$iterator_1]['lunar_year'] = $year;
                $lunar_calendar[$iterator_1 + 1]['lunar_year'] = $year;

                if ($iterator_1 < $lunar_calendar[$iterator_1]['lunar_month']) {
                    $lunar_calendar[$iterator_1]['lunar_year']--;
                    $lunar_calendar[$iterator_1 + 1]['lunar_year']--;
                }

                break;
            }
        }

        array_pop($lunar_calendar);

        return $lunar_calendar;
    }

    /**
     * 月齢を求める（視黄経）
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour , $min, $sec 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return    float 月齢（視黄経）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function moonAge(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        return $this->astronomy()->moonAge($year, $month, $day, $hour, $min, $sec);
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
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function moonPhaseAngle(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        return $this->astronomy()->moonPhaseAngle($year, $month, $day, $hour, $min, $sec);
    }

    /**
     * 月相を求める（8分類: 0=新月〜7=有明）
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return int 月相 (0〜7)
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function moonPhase(int $year, int $month, int $day, float $hour, float $min, float $sec): int
    {
        return $this->astronomy()->moonPhase($year, $month, $day, $hour, $min, $sec);
    }

    /**
     * その日が二十四節気かどうか
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @return    int|bool
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function findSolarTerm(int $year, int $month, int $day): bool|int
    {
        return (new SolarTerm($this->astronomy()))->findSolarTerm($year, $month, $day);
    }
}
