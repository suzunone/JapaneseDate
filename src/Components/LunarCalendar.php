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
 * @since       Class available since Release 1.0.0
 */

namespace JapaneseDate\Components;

use DateTimeZone;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\LunarDate;

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
 * @since       Class available since Release 1.0.0
 */
class LunarCalendar
{
    use OneTimeCacheTrait;

    /**
     * 逐次近似計算収束判定値
     *
     * @deprecated
     * @var float
     */
    public const CONVERGE = 0.00005;

    /**
     * 2000/1/2 のユリウス日
     *
     * @deprecated
     * @var float
     */
    public const BASE_JD_2000 = 2451546.0;

    /**
     * 時差  (12-9)/24
     *
     * @deprecated
     * @var float
     */
    public const JD_2000_TIME_DIFFERENCE = 0.125;

    /**
     * 大気差
     *
     * @deprecated
     * @var float
     */
    public const ASTRO_REFRACT = 0.585556;

    public const DAY_TO_HOUR_FLOAT = 24.0;
    public const DAY_TO_MINUTE_FLOAT = 1440.0;
    public const DAY_TO_SECOND_FLOAT = 86400.0;

    /**
     * 9/24
     */
    public const JD_TIME_ZONE_ADJUSTMENT = 0.375;

    /**
     *  1.0 / 86400.0;
     */
    public const DAYS_PER_SEC = 0.00001157407;

    /**
     * $base_time = DateTime::factory(
     * '2000-01-02 12:00:00',
     * new DateTimeZone('UTC')
     * )->timestamp;
     */
    public const BASE_TIME = 946814400;

    /**
     * 朔の一覧
     *
     * @var array
     */
    protected $lunar_calendar;

    /**
     * キャッシュ
     *
     * @var array
     */
    protected $cache = [
        'longitudeMoon' => [],
        'longitudeSun'  => [],
    ];

    public function __construct()
    {
    }

    /**
     * @return static
     */
    public static function factory(): LunarCalendar
    {
        static $instance;

        if (!$instance) {
            $instance = new static();
        }

        return $instance;
    }

    /**
     * @param \JapaneseDate\DateTime $DateTime
     * @return \JapaneseDate\Elements\LunarDate
     * @throws \JapaneseDate\Exceptions\ErrorException
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function getLunarDate(DateTime $DateTime): LunarDate
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
     * @param int $year  西暦年
     * @param int $month 月
     * @param int $day   日
     * @return    array [旧暦年, 平月／閏月 flag .... 平月:0 閏月:1, 旧暦月, 旧暦日]
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getLunarCalendarArray(int $year, int $month, int $day): array
    {
        $lunar_calendar = $this->getLunarCalendar($year);

        $julian_date = $this->gregorian2JD($year, $month, $day, 0, 0, 0);

        $items = [];
        foreach ($lunar_calendar as $index => $lunar) {
            if (!isset($lunar_calendar[$index + 1])) {
                // @codeCoverageIgnoreStart
                continue;
                // @codeCoverageIgnoreEnd
            }
            if ($julian_date >= $lunar['jd'] && $julian_date < $lunar_calendar[$index + 1]['jd']) {
                $day = $julian_date - $lunar['jd'] + 1.0;
                $items = [
                    LunarDate::YEAR_KEY               => $lunar['lunar_year'],
                    LunarDate::IS_LEAP_MONTH_FLAG_KEY => $lunar['lunar_month_leap'],
                    LunarDate::MONTH_KEY              => $lunar['lunar_month'],
                    LunarDate::DAY_KEY                => $day,
                ];
                break;
            }
        }

        return $items;
    }

    /**
     * @param int $year
     * @return array
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
        $find_year = $year - 1;
        $counter = 0;
        $find_day = 10;
        $find_month = 11;
        while ($find_year <= $year || $find_month <= 2) {
            $days_in_month = $this->getDaysInMonth($find_year, $find_month);
            while ($find_day <= $days_in_month) {
                $age1 = $this->moonAge($find_year, $find_month, $find_day, 0, 0, 0);
                $age2 = $this->moonAge($find_year, $find_month, $find_day, 23, 59, 59);
                if ($age2 <= $age1) {
                    $lunar_calendar[$counter]['year'] = $find_year;
                    $lunar_calendar[$counter]['month'] = $find_month;
                    $lunar_calendar[$counter]['day'] = $find_day;
                    $lunar_calendar[$counter]['age'] = $age1;
                    $lunar_calendar[$counter]['jd'] = $this->gregorian2JD($find_year, $find_month, $find_day, 0, 0, 0);
                    // $lunar_calendar[$counter]['gregorian'] = $this->jD2Gregorian($lunar_calendar[$counter]['jd']);
                    $counter++;
                    // 実行時間短縮のため20日ほどすすめる
                    $find_day += 20;
                }
                $find_day++;
            }
            $find_month++;
            $find_day -= $days_in_month;
            $find_day = max($find_day, 1);

            if ($find_month > 12) {
                $find_year++;
                $find_month = 1;
            }
        }

        // 中気を求める
        $sun_calendar = [];
        $find_year = $year - 1;
        $counter = 0;
        $find_day = 1;
        $find_month = 11;
        while ($find_year <= $year || $find_month <= 2) {
            $days_in_month = $this->getDaysInMonth($find_year, $find_month);
            while ($find_day <= $days_in_month) {
                $longitude_sun_1 = $this->longitudeSun($find_year, $find_month, $find_day, 0, 0, 0);
                $longitude_sun_2 = $this->longitudeSun($find_year, $find_month, $find_day, 24, 0, 0);
                $tmp_ls_1 = floor($longitude_sun_1 / 15.0);
                $tml_ls_2 = floor($longitude_sun_2 / 15.0);

                if ($tml_ls_2 === $tmp_ls_1 || ($tml_ls_2 % 2 !== 0)) {
                    $find_day++;
                    continue;
                }

                $sun_calendar[$counter]['jd'] = $this->gregorian2JD($find_year, $find_month, $find_day, 0, 0, 0);
                $lunar_month = floor($tml_ls_2 / 2) + 2;
                if ($lunar_month > 12) {
                    $lunar_month -= 12;
                }
                $sun_calendar[$counter]['lunar_month'] = $lunar_month;
                $sun_calendar[$counter]['year'] = $find_year;
                $counter++;

                // 実行時間短縮のため、20日ほどすすめる
                $find_day += 20;

                $find_day++;
            }

            $find_month++;
            $find_day -= $days_in_month;
            $find_day = max($find_day, 1);
            if ($find_month > 12) {
                $find_year++;
                $find_month = 1;
            }
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
     * 指定した月の日数を返す
     *
     * @param int $year  西暦年
     * @param int $month 月
     * @return    int 日数／FALSE:引数の異常
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function getDaysInMonth(int $year, int $month): int
    {
        return DateTime::factory(
            mktime(0, 0, 0, $month, 1, $year)
        )->format('t');
    }

    /**
     * 月齢を求める（視黄経）
     *
     * @param int $year   , $month, $day  グレゴリオ暦による年月日
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
        $julian_date_0 = $this->gregorian2JD($year, $month, $day, $hour, $min, $sec) + self::JD_TIME_ZONE_ADJUSTMENT;

        $tm1 = floor($julian_date_0);
        $tm2 = $julian_date_0 - $tm1;

        // 朔の時刻を計算
        // 誤差が±1 sec以内になったら打ち切る
        $counter = 1;
        $delta_t1 = 0;
        $delta_t2 = 1;

        while (($delta_t1 + abs($delta_t2)) > self::DAYS_PER_SEC) {
            $julian_date = $tm1 + $tm2;
            [$year, $month, $day, $hour, $min, $sec] = $this->jD2Gregorian($julian_date);
            $longitude_sun = $this->longitudeSun($year, $month, $day, $hour, $min, $sec);
            $longitude_moon = $this->longitudeMoon($year, $month, $day, $hour, $min, $sec);

            // ΔΛ ＝Λ moon－Λ sun
            $delta_rm = $longitude_moon - $longitude_sun;

            if ($counter === 1 && $delta_rm < 0) {
                // ループ1回目 で $delta_rm < 0 の場合には引き込み範囲に入るよう補正
                $delta_rm = $this->normalizeAngle($delta_rm);
            } elseif ($longitude_sun >= 0 && $longitude_sun <= 20 && $longitude_moon >= 300) {
                // 春分の近くで朔がある場合 ( 0 ≦Λ sun≦ 20 ) で、月の黄経Λ moon≧300 の
                // 場合には、ΔΛ ＝ 360 － ΔΛ  と計算して補正
                $delta_rm = $this->normalizeAngle($delta_rm);
                $delta_rm = 360 - $delta_rm;
            } elseif (abs($delta_rm) > 40.0) {
                // ΔΛ の引き込み範囲 ( ±40°) を逸脱した場合には補正
                $delta_rm = $this->normalizeAngle($delta_rm);
            }

            // 時刻引数の補正値 Δt
            $delta_t2 = $delta_rm * 29.530589 / 360.0;
            $delta_t1 = floor($delta_t2);
            $delta_t2 -= $delta_t1;

            // 時刻引数の補正
            $tm1 -= $delta_t1;
            $tm2 -= $delta_t2;
            if ($tm2 < 0) {
                $tm2++;
                $tm1--;
            }

            // @codeCoverageIgnoreStart
            if ($counter === 15 && abs($delta_t1 + $delta_t2) > self::DAYS_PER_SEC) {
                // ループ回数が15回になったら、初期値を-26
                $tm1 = floor($julian_date_0 - 26);
                $tm2 = 0;
            } elseif ($counter > 30 && abs($delta_t1 + $delta_t2) > self::DAYS_PER_SEC) {
                // 初期値を補正したにも関わらず振動を続ける場合は、
                // 初期値を答えとして返して強制的にループを抜け出して異常終了
                $tm1 = $julian_date_0;
                $tm2 = 0;
                break;
            }
            // @codeCoverageIgnoreEnd
            $counter++;
        }

        // 時刻引数を合成
        $res = $julian_date_0 - ($tm2 + $tm1);
        if ($res > 30) {
            $res -= 30;
        }

        return $res;
    }

    /**
     * グレゴリオ暦→ユリウス日 変換
     *
     * @param int $year   グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour , $min, $sec 時分秒（世界時）
     * @param float $min
     * @param float $sec
     * @return    float ユリウス日
     */
    protected function gregorian2JD(int $year, int $month, int $day, float $hour, float $min, float $sec): float
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
    protected function jD2Gregorian(float $jd): array
    {
        $cal = cal_from_jd($jd, CAL_GREGORIAN);

        $time = 86400 * ($jd - floor($jd));
        $hour = floor($time / 3600.0);
        $min = floor(($time - 3600 * $hour) / 60.0);
        $sec = floor($time - 3600 * $hour - 60 * $min);

        return [$cal['year'], $cal['month'], $cal['day'], $hour, $min, $sec];
    }

    /**
     * 太陽の黄経計算（視黄経）
     *
     * @param int $year
     * @param int $month
     * @param float $day
     * @param float $hour
     * @param float $min
     * @param float $sec
     * @return    float 太陽の黄経（視黄経）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function longitudeSun(int $year, int $month, float $day, float $hour, float $min, float $sec): float
    {
        $key = __METHOD__ . '-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, function () use ($year, $month, $day, $hour, $min, $sec) {
            $julian_year = $this->gregorian2JY($year, $month, $day, $hour, $min, $sec);

            return $this->jy2LongitudeSun($julian_year);
        });
    }

    /**
     * 2000からの経過年数
     *
     * @param int $year グレゴリオ暦による年月日
     * @param int $month
     * @param int $day
     * @param float $hour
     * @param float $min
     * @param int $sec
     * @return float
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function gregorian2JY(int $year, int $month, int $day, float $hour, float $min, int $sec): float
    {
        $timestamp = DateTime::factory(
            implode('-', [$year, $month, $day]) . ' ' . implode(':', [$hour, $min, $sec]),
            new DateTimeZone('UTC')
        )->timestamp;

        $diff_time = $timestamp - self::BASE_TIME;

        // return ($diff_time + 32400.0) / 86400.25 / 365.25;
        return ($diff_time + 32400.0) / 31557691.3125;
    }

    /**
     * 太陽の黄経計算（視黄経）
     *
     * @param float $julian_year 2000.0からの経過年数
     * @return    float 太陽の黄経（視黄経）
     */
    protected function jy2LongitudeSun(float $julian_year): float
    {
        $res = 0.0003 * sin(deg2rad($this->normalizeAngle(329.7 + 44.43 * $julian_year)));
        $res += 0.0003 * sin(deg2rad($this->normalizeAngle(352.5 + 1079.97 * $julian_year)));
        $res += 0.0004 * sin(deg2rad($this->normalizeAngle(21.1 + 720.02 * $julian_year)));
        $res += 0.0004 * sin(deg2rad($this->normalizeAngle(157.3 + 299.30 * $julian_year)));
        $res += 0.0004 * sin(deg2rad($this->normalizeAngle(234.9 + 315.56 * $julian_year)));
        $res += 0.0005 * sin(deg2rad($this->normalizeAngle(291.2 + 22.81 * $julian_year)));
        $res += 0.0005 * sin(deg2rad($this->normalizeAngle(207.4 + 1.50 * $julian_year)));
        $res += 0.0006 * sin(deg2rad($this->normalizeAngle(29.8 + 337.18 * $julian_year)));
        $res += 0.0007 * sin(deg2rad($this->normalizeAngle(206.8 + 30.35 * $julian_year)));
        $res += 0.0007 * sin(deg2rad($this->normalizeAngle(153.3 + 90.38 * $julian_year)));
        $res += 0.0008 * sin(deg2rad($this->normalizeAngle(132.5 + 659.29 * $julian_year)));
        $res += 0.0013 * sin(deg2rad($this->normalizeAngle(81.4 + 225.18 * $julian_year)));
        $res += 0.0015 * sin(deg2rad($this->normalizeAngle(343.2 + 450.37 * $julian_year)));
        $res += 0.0018 * sin(deg2rad($this->normalizeAngle(251.3 + 0.20 * $julian_year)));
        $res += 0.0018 * sin(deg2rad($this->normalizeAngle(297.8 + 4452.67 * $julian_year)));
        $res += 0.0020 * sin(deg2rad($this->normalizeAngle(247.1 + 329.64 * $julian_year)));
        $res += 0.0048 * sin(deg2rad($this->normalizeAngle(234.95 + 19.341 * $julian_year)));
        $res += 0.0200 * sin(deg2rad($this->normalizeAngle(355.05 + 719.981 * $julian_year)));
        $res += (1.9146 - 0.00005 * $julian_year) * sin(deg2rad($this->normalizeAngle(357.538 + 359.991 * $julian_year)));
        $res += $this->normalizeAngle(280.4603 + 360.00769 * $julian_year);

        return $this->normalizeAngle($res);
    }

    /**
     * 角度の正規化（$angle を 0≦$angle＜360 にする）
     *
     * @param float $angle 角度
     * @return    float 角度（正規化後）
     */
    protected function normalizeAngle(float $angle): float
    {
        if ($angle < 0) {
            // マイナスなら、逆から正規化
            $angle1 = $angle * -1;
            $angle1 -= 360 * floor($angle1 / 360);

            return 360 - $angle1;
        }
        if ($angle <= 360) {
            // 基準値以内なら何もしない
            return $angle;
        }

        // 基準以上なら、正規化
        return $angle - 360 * floor($angle / 360);
    }

    /**
     * 月の黄経計算（視黄経）
     *
     * @param int $year   グレゴリオ暦
     * @param int $month
     * @param int $day
     * @param float $hour 時
     * @param float $min  分
     * @param float $sec  秒
     * @return    float 月の黄経（視黄経）
     * @throws \JapaneseDate\Exceptions\Exception
     */
    protected function longitudeMoon(int $year, int $month, int $day, float $hour, float $min, float $sec): float
    {
        $key = __METHOD__ . '-' . $year . '-' . $month . '-' . $day . '-' . $hour . '-' . $min . '-' . $sec;

        return $this->oneTimeCache($key, function () use ($year, $month, $day, $hour, $min, $sec) {
            $julian_year = $this->gregorian2JY($year, $month, $day, $hour, $min, $sec);

            return $this->jY2LongitudeMoon($julian_year);
        });
    }

    /**
     * 月の黄経計算（視黄経）
     *
     * @param float $julian_year 2000.0からの経過年数
     * @return    float 月の黄経（視黄経）
     */
    protected function jY2LongitudeMoon(float $julian_year): float
    {
        $tmp = 0.0006 * sin(deg2rad($this->normalizeAngle(54.0 + 19.3 * $julian_year)));
        $tmp += 0.0006 * sin(deg2rad($this->normalizeAngle(71.0 + 0.2 * $julian_year)));
        $tmp += 0.0020 * sin(deg2rad($this->normalizeAngle(55.0 + 19.34 * $julian_year)));
        $tmp += 0.0040 * sin(deg2rad($this->normalizeAngle(119.5 + 1.33 * $julian_year)));
        $rm_moon = 0.0003 * sin(deg2rad($this->normalizeAngle(280.0 + 23221.3 * $julian_year)));
        $rm_moon += 0.0003 * sin(deg2rad($this->normalizeAngle(161.0 + 40.7 * $julian_year)));
        $rm_moon += 0.0003 * sin(deg2rad($this->normalizeAngle(311.0 + 5492.0 * $julian_year)));
        $rm_moon += 0.0003 * sin(deg2rad($this->normalizeAngle(147.0 + 18089.3 * $julian_year)));
        $rm_moon += 0.0003 * sin(deg2rad($this->normalizeAngle(66.0 + 3494.7 * $julian_year)));
        $rm_moon += 0.0003 * sin(deg2rad($this->normalizeAngle(83.0 + 3814.0 * $julian_year)));
        $rm_moon += 0.0004 * sin(deg2rad($this->normalizeAngle(20.0 + 720.0 * $julian_year)));
        $rm_moon += 0.0004 * sin(deg2rad($this->normalizeAngle(71.0 + 9584.7 * $julian_year)));
        $rm_moon += 0.0004 * sin(deg2rad($this->normalizeAngle(278.0 + 120.1 * $julian_year)));
        $rm_moon += 0.0004 * sin(deg2rad($this->normalizeAngle(313.0 + 398.7 * $julian_year)));
        $rm_moon += 0.0005 * sin(deg2rad($this->normalizeAngle(332.0 + 5091.3 * $julian_year)));
        $rm_moon += 0.0005 * sin(deg2rad($this->normalizeAngle(114.0 + 17450.7 * $julian_year)));
        $rm_moon += 0.0005 * sin(deg2rad($this->normalizeAngle(181.0 + 19088.0 * $julian_year)));
        $rm_moon += 0.0005 * sin(deg2rad($this->normalizeAngle(247.0 + 22582.7 * $julian_year)));
        $rm_moon += 0.0006 * sin(deg2rad($this->normalizeAngle(128.0 + 1118.7 * $julian_year)));
        $rm_moon += 0.0007 * sin(deg2rad($this->normalizeAngle(216.0 + 278.6 * $julian_year)));
        $rm_moon += 0.0007 * sin(deg2rad($this->normalizeAngle(275.0 + 4853.3 * $julian_year)));
        $rm_moon += 0.0007 * sin(deg2rad($this->normalizeAngle(140.0 + 4052.0 * $julian_year)));
        $rm_moon += 0.0008 * sin(deg2rad($this->normalizeAngle(204.0 + 7906.7 * $julian_year)));
        $rm_moon += 0.0008 * sin(deg2rad($this->normalizeAngle(188.0 + 14037.3 * $julian_year)));
        $rm_moon += 0.0009 * sin(deg2rad($this->normalizeAngle(218.0 + 8586.0 * $julian_year)));
        $rm_moon += 0.0011 * sin(deg2rad($this->normalizeAngle(276.5 + 19208.02 * $julian_year)));
        $rm_moon += 0.0012 * sin(deg2rad($this->normalizeAngle(339.0 + 12678.71 * $julian_year)));
        $rm_moon += 0.0016 * sin(deg2rad($this->normalizeAngle(242.2 + 18569.38 * $julian_year)));
        $rm_moon += 0.0018 * sin(deg2rad($this->normalizeAngle(4.1 + 4013.29 * $julian_year)));
        $rm_moon += 0.0020 * sin(deg2rad($this->normalizeAngle(55.0 + 19.34 * $julian_year)));
        $rm_moon += 0.0021 * sin(deg2rad($this->normalizeAngle(105.6 + 3413.37 * $julian_year)));
        $rm_moon += 0.0021 * sin(deg2rad($this->normalizeAngle(175.1 + 719.98 * $julian_year)));
        $rm_moon += 0.0021 * sin(deg2rad($this->normalizeAngle(87.5 + 9903.97 * $julian_year)));
        $rm_moon += 0.0022 * sin(deg2rad($this->normalizeAngle(240.6 + 8185.36 * $julian_year)));
        $rm_moon += 0.0024 * sin(deg2rad($this->normalizeAngle(252.8 + 9224.66 * $julian_year)));
        $rm_moon += 0.0024 * sin(deg2rad($this->normalizeAngle(211.9 + 988.63 * $julian_year)));
        $rm_moon += 0.0026 * sin(deg2rad($this->normalizeAngle(107.2 + 13797.39 * $julian_year)));
        $rm_moon += 0.0027 * sin(deg2rad($this->normalizeAngle(272.5 + 9183.99 * $julian_year)));
        $rm_moon += 0.0037 * sin(deg2rad($this->normalizeAngle(349.1 + 5410.62 * $julian_year)));
        $rm_moon += 0.0039 * sin(deg2rad($this->normalizeAngle(111.3 + 17810.68 * $julian_year)));
        $rm_moon += 0.0040 * sin(deg2rad($this->normalizeAngle(119.5 + 1.33 * $julian_year)));
        $rm_moon += 0.0040 * sin(deg2rad($this->normalizeAngle(145.6 + 18449.32 * $julian_year)));
        $rm_moon += 0.0040 * sin(deg2rad($this->normalizeAngle(13.2 + 13317.34 * $julian_year)));
        $rm_moon += 0.0048 * sin(deg2rad($this->normalizeAngle(235.0 + 19.34 * $julian_year)));
        $rm_moon += 0.0050 * sin(deg2rad($this->normalizeAngle(295.4 + 4812.66 * $julian_year)));
        $rm_moon += 0.0052 * sin(deg2rad($this->normalizeAngle(197.2 + 319.32 * $julian_year)));
        $rm_moon += 0.0068 * sin(deg2rad($this->normalizeAngle(53.2 + 9265.33 * $julian_year)));
        $rm_moon += 0.0079 * sin(deg2rad($this->normalizeAngle(278.2 + 4493.34 * $julian_year)));
        $rm_moon += 0.0085 * sin(deg2rad($this->normalizeAngle(201.5 + 8266.71 * $julian_year)));
        $rm_moon += 0.0100 * sin(deg2rad($this->normalizeAngle(44.89 + 14315.966 * $julian_year)));
        $rm_moon += 0.0107 * sin(deg2rad($this->normalizeAngle(336.44 + 13038.696 * $julian_year)));
        $rm_moon += 0.0110 * sin(deg2rad($this->normalizeAngle(231.59 + 4892.052 * $julian_year)));
        $rm_moon += 0.0125 * sin(deg2rad($this->normalizeAngle(141.51 + 14436.029 * $julian_year)));
        $rm_moon += 0.0153 * sin(deg2rad($this->normalizeAngle(130.84 + 758.698 * $julian_year)));
        $rm_moon += 0.0305 * sin(deg2rad($this->normalizeAngle(312.49 + 5131.979 * $julian_year)));
        $rm_moon += 0.0348 * sin(deg2rad($this->normalizeAngle(117.84 + 4452.671 * $julian_year)));
        $rm_moon += 0.0410 * sin(deg2rad($this->normalizeAngle(137.43 + 4411.998 * $julian_year)));
        $rm_moon += 0.0459 * sin(deg2rad($this->normalizeAngle(238.18 + 8545.352 * $julian_year)));
        $rm_moon += 0.0533 * sin(deg2rad($this->normalizeAngle(10.66 + 13677.331 * $julian_year)));
        $rm_moon += 0.0572 * sin(deg2rad($this->normalizeAngle(103.21 + 3773.363 * $julian_year)));
        $rm_moon += 0.0588 * sin(deg2rad($this->normalizeAngle(214.22 + 638.635 * $julian_year)));
        $rm_moon += 0.1143 * sin(deg2rad($this->normalizeAngle(6.546 + 9664.0404 * $julian_year)));
        $rm_moon += 0.1856 * sin(deg2rad($this->normalizeAngle(177.525 + 359.9905 * $julian_year)));
        $rm_moon += 0.2136 * sin(deg2rad($this->normalizeAngle(269.926 + 9543.9773 * $julian_year)));
        $rm_moon += 0.6583 * sin(deg2rad($this->normalizeAngle(235.700 + 8905.3422 * $julian_year)));
        $rm_moon += 1.2740 * sin(deg2rad($this->normalizeAngle(100.738 + 4133.3536 * $julian_year)));
        $rm_moon += 6.2887 * sin(deg2rad($this->normalizeAngle(134.961 + 4771.9886 * $julian_year + $tmp)));

        return $rm_moon + $this->normalizeAngle(218.3161 + 4812.67881 * $julian_year);
    }

    /**
     * その日が二十四節気かどうか
     *
     * @param int $year , $month, $day  グレゴリオ暦による年月日
     * @param $month
     * @param $day
     * @return    int|bool
     * @throws \JapaneseDate\Exceptions\Exception
     */
    public function findSolarTerm(int $year, $month, $day)
    {
        /**
         * @var array $solar_term
         */
        $solar_term = JapaneseDate::SOLAR_TERM;

        // 太陽黄経
        $longitude_sun_1 = $this->longitudeSun($year, $month, $day, 0, 0, 0);
        $longitude_sun_2 = $this->longitudeSun($year, $month, $day, 24, 0, 0);

        $tmp_1 = (int) floor($longitude_sun_1 / 15);
        $tmp_2 = (int) floor($longitude_sun_2 / 15);

        return ($tmp_1 !== $tmp_2 && isset($solar_term[$tmp_2])) ? $tmp_2 : false;
    }
}
