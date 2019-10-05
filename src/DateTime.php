<?php

namespace JapaneseDate;

/**
 * 日本の暦対応のDateTimeオブジェクト拡張
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DateTime
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @see         https://carbon.nesbot.com/docs/
 * @since       Class available since Release 1.0.0
 */
use Carbon\Carbon;
use Closure;
use DateTimeInterface;
use DateTimeZone;
use JapaneseDate\Components\Cache;
use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\LunarCalendar;

/**
 * 日本の暦対応のDateTimeオブジェクト拡張
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  DateTime
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @see         https://carbon.nesbot.com/docs/
 * @since       Class available since Release 1.0.0
 * @property  int|bool $solar_term
 * @property  string   $solar_term_text
 * @property bool      $is_solar_term
 * @property string    $era_name_text
 * @property int       $era_name
 * @property int       $era_year
 * @property string    $oriental_zodiac_text
 * @property int       $oriental_zodiac
 * @property string    $six_weekday_text
 * @property int       $six_weekday
 * @property int       $weekday_text
 * @property string    $month_text
 * @property string    $holiday_text
 * @property int       $holiday
 * @property bool      $is_holiday
 * @property string    $lunar_month_text
 * @property int       $lunar_month
 * @property int       $lunar_year
 * @property int       $lunar_day
 * @property bool      $is_leap_month
 * @property  int|bool $solarTerm
 * @property  string   $solarTermText
 * @property bool      $isSolarTerm
 * @property string    $eraNameText
 * @property int       $eraName
 * @property int       $eraYear
 * @property string    $orientalZodiacText
 * @property int       $orientalZodiac
 * @property string    $sixWeekdayText
 * @property int       $sixWeekday
 * @property int       $weekdayText
 * @property string    $monthText
 * @property string    $holidayText
 * @property bool      $isHoliday
 * @property string    $lunarMonthText
 * @property int       $lunarMonth
 * @property int       $lunarYear
 * @property int       $lunarYay
 * @property bool      $isLeapMonth
 */
class DateTime extends Carbon
{
    /**
     * 祝日定数:非祝日
     *
     * @var int
     */
    public const NO_HOLIDAY = 0;
    /**
     * 祝日定数:元旦
     *
     * @var int
     */
    public const NEW_YEAR_S_DAY = 1;
    /**
     * 祝日定数:成人の日
     *
     * @var int
     */
    public const COMING_OF_AGE_DAY = 2;
    /**
     * 祝日定数:建国記念の日
     *
     * @var int
     */
    public const NATIONAL_FOUNDATION_DAY = 3;
    /**
     * 祝日定数:昭和天皇の大喪の礼
     *
     * @var int
     */
    public const THE_SHOWA_EMPEROR_DIED = 4;
    /**
     * 祝日定数:春分の日
     *
     * @var int
     */
    public const VERNAL_EQUINOX_DAY = 5;
    /**
     * 祝日定数:昭和の日
     *
     * @var int
     */
    public const DAY_OF_SHOWA = 6;
    /**
     * 祝日定数:みどりの日
     *
     * @var int
     */
    public const GREENERY_DAY = 7;
    /**
     * 祝日定数:天皇誕生日
     *
     * @var int
     */
    public const THE_EMPEROR_S_BIRTHDAY = 8;
    /**
     * 祝日定数:皇太子明仁親王の結婚の儀
     *
     * @var int
     */
    public const CROWN_PRINCE_HIROHITO_WEDDING = 9;
    /**
     * 祝日定数:憲法記念日
     *
     * @var int
     */
    public const CONSTITUTION_DAY = 10;
    /**
     * 祝日定数:国民の休日
     *
     * @var int
     */
    public const NATIONAL_HOLIDAY = 11;
    /**
     * 祝日定数:こどもの日
     *
     * @var int
     */
    public const CHILDREN_S_DAY = 12;
    /**
     * 祝日定数:振替休日
     *
     * @var int
     */
    public const COMPENSATING_HOLIDAY = 13;
    /**
     * 祝日定数:皇太子徳仁親王の結婚の儀
     *
     * @var int
     */
    public const CROWN_PRINCE_NARUHITO_WEDDING = 14;
    /**
     * 祝日定数:海の日
     *
     * @var int
     */
    public const MARINE_DAY = 15;
    /**
     * 祝日定数:秋分の日
     *
     * @var int
     */
    public const AUTUMNAL_EQUINOX_DAY = 16;
    /**
     * 祝日定数:敬老の日
     *
     * @var int
     */
    public const RESPECT_FOR_SENIOR_CITIZENS_DAY = 17;

    /**
     * 祝日定数:体育の日
     *
     * @var int
     */
    public const LEGACY_SPORTS_DAY = 18;

    /**
     * 祝日定数:文化の日
     *
     * @var int
     */
    public const CULTURE_DAY = 19;

    /**
     * 祝日定数:勤労感謝の日
     *
     * @var int
     */
    public const LABOR_THANKSGIVING_DAY = 20;

    /**
     * 祝日定数:即位礼正殿の儀
     *
     * @var int
     */
    public const REGNAL_DAY = 21;

    /**
     * 祝日定数:山の日
     *
     * @var int
     */
    public const MOUNTAIN_DAY = 22;

    /**
     * 天皇の即位の日
     *
     * @var int
     */
    public const EMPERORS_THRONE_DAY = 23;

    /**
     * スポーツの日
     *
     * @var int
     */
    public const SPORTS_DAY = 24;

    /**
     * 祝日法制定年
     *
     * @var int
     */
    public const HOLIDAY_START_YEAR = 1948;

    /**
     * 二回目の東京オリンピックの年
     *
     * 特別祝日
     *
     * @var int
     */
    public const SECOND_TIME_TOKYO_OLYMPIC_YEAR = 2020;

    /**
     * 特定月定数 春分の日
     *
     * @var int
     */
    public const VERNAL_EQUINOX_DAY_MONTH = 3;

    /**
     * 特定月定数 秋分の日
     *
     * @var int
     */
    public const AUTUMNAL_EQUINOX_DAY_MONTH = 9;

    /**
     * 曜日定数(日)
     *
     * @var int
     */
    public const SUNDAY = 0;

    /**
     * 曜日定数(月)
     *
     * @var int
     */
    public const MONDAY = 1;

    /**
     * 曜日定数(火)
     *
     * @var int
     */
    public const TUESDAY = 2;

    /**
     * 曜日定数(水)
     *
     * @var int
     */
    public const WEDNESDAY = 3;

    /**
     * 曜日定数(木)
     *
     * @var int
     */
    public const THURSDAY = 4;

    /**
     * 曜日定数(金)
     *
     * @var int
     */
    public const FRIDAY = 5;

    /**
     * 曜日定数(土)
     *
     * @var int
     */
    public const SATURDAY = 6;

    /**
     * 元号 (明治)
     *
     * @var int
     */
    public const ERA_MEIJI = 1000;

    /**
     * 元号 (対象)
     *
     * @var int
     */
    public const ERA_TAISHO = 1001;

    /**
     * 元号 (昭和)
     *
     * @var int
     */
    public const ERA_SHOWA = 1002;

    /**
     * 元号 (平成)
     *
     * @var int
     */
    public const ERA_HEISEI = 1003;

    /**
     * 元号 (平成の次)
     *
     * @var int
     * @deprecated
     */
    public const ERA_HEISEI_NEXT = 1004;

    /**
     * 元号 (平成の次)
     *
     * @var int
     */
    public const ERA_REIWA = 1004;

    /**
     * @var \JapaneseDate\Components\JapaneseDate
     */
    private $JapaneseDate;

    /**
     * @var \JapaneseDate\Components\LunarCalendar
     */
    private $LunarCalendar;

    /**
     * @var array
     */
    private $lunar_calendar = [];

    /**
     * DateTime constructor.
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @param string|DateTimeInterface|null $time      日付/時刻 文字列。DateTimeオブジェクト
     * @param DateTimeZone|string|null|int  $time_zone DateTimeZone オブジェクトか、時差の時間、タイムゾーンテキスト(omit 予定)
     * @throws \Exception
     */
    public function __construct($time = null, $time_zone = null)
    {
        parent::__construct($time, $time_zone);

        $this->JapaneseDate  = JapaneseDate::factory();
        $this->LunarCalendar = LunarCalendar::factory();
    }

    /**
     * DateTimeオブジェクトの生成
     *
     * 日付/時刻 文字列の書式については {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式} を参考にしてください。
     *
     * @param string|int|DateTimeInterface|null $date_time 日付オブジェクト OR Unix Time Stamp OR 日付/時刻 文字列
     * @param DateTimeZone|null|string          $time_zone オブジェクトか、時差の時間、タイムゾーンテキスト(omit 予定)
     * @return static
     * @throws \Exception
     */
    public static function factory($date_time = null, $time_zone = null)
    {
        if (is_int($date_time)) {
            return new static(date('Y-m-d H:i:s', $date_time), $time_zone);
        } elseif (ctype_digit($date_time)) {
            $check_time = strtotime($date_time);
            if ($check_time) {
                $date_time = $check_time;
            }

            return new static(date('Y-m-d H:i:s', $date_time), $time_zone);
        } elseif ($date_time instanceof DateTimeInterface) {
            return new static($date_time->format('Y-m-d H:i:s'), $time_zone ?? $date_time->getTimezone());
        }

        return new static($date_time, $time_zone);
    }

    /**
     * キャッシュモードを指定する
     *
     * 指定するキャッシュモードは、{@see \JapaneseDate\CacheMode}参照。
     *
     * @see \JapaneseDate\CacheMode::MODE_NONE キャッシュなし
     * @see \JapaneseDate\CacheMode::MODE_AUTO 自動でキャッシュモードを選択
     * @see \JapaneseDate\CacheMode::MODE_APC APCを使用したキャッシュ
     * @see \JapaneseDate\CacheMode::MODE_FILE ファイルを使用したキャッシュ
     * @see \JapaneseDate\CacheMode::MODE_ORIGINAL 独自キャッシュ
     * @param int $mode キャッシュモード
     */
    public static function setCacheMode(int $mode)
    {
        Cache::setMode($mode);
    }

    /**
     * キャッシュファイル保存ディレクトリをセットします
     *
     * キャッシュモードがファイル{@see \JapaneseDate\CacheMode::MODE_FILE}の時に使用する、キャッシュファイル保存ディレクトリをセットします。
     *
     * @param string $cache_file_path キャッシュファイルを保存するディレクトリ
     */
    public static function setCacheFilePath(string $cache_file_path)
    {
        Cache::setCacheFilePath($cache_file_path);
    }

    /**
     * 独自キャッシュロジックのセット
     *
     * キャッシュモードが独自キャッシュ{@see \JapaneseDate\CacheMode::MODE_ORIGINAL}の時に使用する、クロージャをセットします。
     *
     * セットされるクロージャは、
     *
     * mixed ClosureFunction(string $key, Closure $Cloosure)
     *
     * | Parameter | Type | Description |
     * |-----------|------|-------------|
     * | `$key` | **string** | キャッシュ単位の一意なキー。このキーにマッチしたキャッシュデータが有る場合は、キャッシュされたデータをreturnしてください。 |
     * | `$Cloosure` | **\Closure** | キャッシュされたデータが取得できない場合に実行するクロージャです。実行すれば、キャッシュするべきデータが返されます。 |
     *
     * @param Closure $function 独自キャッシュのロジックが含まれたクロージャ
     */
    public static function setCacheClosure(Closure $function)
    {
        Cache::setCacheClosure($function);
    }

    /**
     * 日本語カレンダー対応したstrftime()
     *
     * {@link http://php.net/manual/ja/function.strftime.php function.strftime strftimeの仕様}
     * に加え、
     *
     * - %J 1～31の日
     * - %e 1～9なら先頭にスペースを付ける、1～31の日
     * - %g 1～9なら先頭にスペースを付ける、1～12の月
     * - %k 六曜番号
     * - %6 六曜
     * - %K 曜日
     * - %l 祝日番号
     * - %L 祝日
     * - %o 干支番号
     * - %O 干支
     * - %E 旧暦年
     * - %G 旧暦の月
     * - %F 年号
     * - %f 年号ID
     *
     * が使用できます。
     *
     * このメソッドは非推奨です。 {@see DateTime::formatLocalized()}を使用してください。
     *
     * @since 1.1
     * @param string $format フォーマット
     * @return string  指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。
     * @throws \ErrorException
     * @deprecated
     */
    public function strftime($format)
    {
        $res_str = $this->strftimeJa($format, '%');

        return strftime($res_str, $this->timestamp);
    }

    /**
     * 日本語カレンダー対応したstrftime()
     *
     * {@link http://php.net/manual/ja/function.strftime.php function.strftime strftimeの仕様}
     * に加え、
     * - %#J %-dへのエイリアス
     * - %#e 1～9なら先頭にスペースを付ける、1～31の日(%eのwin対応版)
     * - %#g 1～9なら先頭にスペースを付ける、1～12の月
     * - %#G 古い名前の月名(睦月、如月)
     * - %#k 六曜番号
     * - %#6 六曜
     * - %#K 曜日
     * - %#l 祝日番号
     * - %#L 祝日
     * - %#o 干支番号
     * - %#O 干支
     * - %#E 旧暦年
     * - %#d 旧暦の日(01,02...)
     * - %#-d 旧暦の日(1,2,3....)
     * - %#j 旧暦の1桁の場合は先頭にスペースをいれた日（ 1, 2, 3）
     * - %#m 旧暦の月(01,02...)
     * - %#-m 旧暦の月(1,2,3....)
     * - %#n 旧暦の1桁の場合は先頭にスペースをいれた月（ 1, 2, 3）
     * - %#b 旧暦の月(睦月,如月...)
     * - %#h %#bへのエイリアス
     * - %#B 旧暦の月で閏月まで表示する 皐月(閏月)
     * - %#u 閏月の場合 閏 と出力させる
     * - %#U 閏月の場合 (閏) と出力させる
     * - %#F 年号
     * - %#f 年号ID
     *
     * が使用できます。
     *
     * @since 1.1
     * @param string $format フォーマット
     * @return string  指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。
     * @throws \ErrorException
     */
    public function formatLocalized($format)
    {
        $format = $this->strftimeJa($format);

        return parent::formatLocalized($format);
    }

    /**
     * CarbonデフォルトのformatLocalizedへのエイリアス
     *
     * @param string $format フォーマット
     * @return string
     */
    public function formatLocalizedSimple($format)
    {
        return parent::formatLocalized($format);
    }

    /**
     * 日本語カレンダー対応したstrftime()の事前メソッド
     *
     * @since 1.1
     * @param string $format フォーマット
     * @param string $delimiter
     * @return string  指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。
     * @throws \ErrorException
     * @throws \Exception
     */
    protected function strftimeJa($format, $delimiter = '%#')
    {
        $res_str      = '';
        $format_array = explode($delimiter, $format);
        foreach ($format_array as $key => $strings) {
            if ($key === 0) {
                $res_str .= $strings;
                continue;
            }
            if ($delimiter !== '%' && mb_substr($format_array[$key - 1], -1, 1) === '%') {
                $re_format = $delimiter . $strings;
                $res_str .= $re_format;
                continue;
            }

            $pattern = mb_substr($strings, 0, 1);

            if ($pattern === '-') {
                $pattern = mb_substr($strings, 0, 2);
            }

            switch ($pattern) {
                case 'o':
                    $re_format = $this->getOrientalZodiac();
                    break;
                case 'O':
                    $re_format = $this->viewOrientalZodiac();
                    break;
                case 'l':
                    $re_format = $this->getHoliday();
                    break;
                case 'L':
                    $re_format = $this->viewHoliday();
                    break;
                case 'K':
                    $re_format = $this->viewWeekday();
                    break;
                case 'k':
                    $re_format = $this->viewSixWeekday();
                    break;
                case '6':
                    $re_format = $this->getSixWeekday();
                    break;
                case 'e':
                    $re_format = $this->format('j');
                    if (strlen($re_format) === 1) {
                        $re_format = ' ' . $re_format;
                    }
                    break;
                case 'g':
                    $re_format = $this->format('n');
                    if (strlen($re_format) === 1) {
                        $re_format = ' ' . $re_format;
                    }
                    break;
                case 'J':
                    $re_format = $this->format('j');
                    break;
                case 'G':
                    $re_format = $this->viewMonth();
                    break;
                case 'F':
                    $re_format = $this->viewEraName();
                    break;
                case 'f':
                    $re_format = $this->getEraName();
                    break;
                case 'E':
                    $re_format = $this->getEraYear();
                    break;
                default:
                    $re_format = false;

                    if ($delimiter !== '%') {
                        switch ($pattern) {
                            case '-d':
                                $re_format = $this->getLunarDay();
                                break;
                            case 'd':
                                $re_format = $this->getLunarDay();
                                if (strlen($re_format) === 1) {
                                    $re_format = '0' . $re_format;
                                }
                                break;
                            case 'j':
                                $re_format = $this->getLunarDay();
                                if (strlen($re_format) === 1) {
                                    $re_format = ' ' . $re_format;
                                }
                                break;
                            case '-m':
                                $re_format = $this->getLunarMonth();
                                break;
                            case 'm':
                                $re_format = $this->getLunarMonth();
                                if (strlen($re_format) === 1) {
                                    $re_format = '0' . $re_format;
                                }
                                break;
                            case 'n':
                                $re_format = $this->getLunarMonth();
                                if (strlen($re_format) === 1) {
                                    $re_format = ' ' . $re_format;
                                }
                                break;
                            case 'b':
                            case 'h':
                                $re_format = $this->viewLunarMonth();
                                break;
                            case'B':
                                $re_format = $this->viewLunarMonth();
                                if ($this->isLeapMonth()) {
                                    $re_format .= '(閏月)';
                                }
                                break;
                            case 'u':
                                $re_format = $this->isLeapMonth() ? '閏' : '';
                                break;
                            case 'U':
                                $re_format = $this->isLeapMonth() ? '(閏)' : '';
                                break;
                        }
                    }

                    if ($re_format === false) {
                        $re_format = $delimiter . $strings;
                        $res_str .= $re_format;
                        continue 2;
                    }
                    break;
            }
            $res_str .= $re_format . mb_substr($strings, strlen($pattern));
        }

        return $res_str;
    }

    /**
     * サポートされるカレンダーに変換する
     *
     * サポートされる calendar の値は、 CAL_GREGORIAN、 CAL_JULIAN、 CAL_JEWISH および CAL_FRENCH です。
     *
     * @access      public
     * @param int $calendar サポートされるカレンダー
     * @return      array カレンダーの情報を含む配列を返します。この配列には、 年、月、日、週、曜日名、月名、"月/日/年" 形式の文字列 などが含まれます。
     */
    public function getCalendar($calendar = CAL_GREGORIAN)
    {
        return cal_from_jd(unixtojd($this->timestamp), $calendar);
    }

    /**
     * MagicMethod:__get()
     *
     * @link https://carbon.nesbot.com/docs/#api-getters
     * @param string $name
     * @return DateTimeZone|int|string
     * @throws \ErrorException
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function __get($name)
    {
        switch ($name) {
            case 'solar_term_text':
            case 'solarTermText':
                return $this->getSolarTerm();
            case 'solar_term':
            case 'solarTerm':
                return $this->getSolarTermKey();
            case 'is_solar_term':
            case 'isSolarTerm':
                return $this->isSolarTerm();
            case 'era_name_text':
            case 'eraNameText':
                return $this->viewEraName();
            case 'era_name':
            case 'eraName':
                return $this->getEraName();
            case 'era_year':
            case 'eraYear':
                return $this->getEraYear();
            case 'oriental_zodiac_text':
            case 'orientalZodiacText':
                return $this->viewOrientalZodiac();
            case 'oriental_zodiac':
            case 'orientalZodiac':
                return $this->getOrientalZodiac();
            case 'six_weekday_text':
            case 'sixWeekdayText':
                return $this->viewSixWeekday();
            case 'six_weekday':
            case 'sixWeekday':
                return $this->getSixWeekday();
            case 'weekday_text':
            case 'weekdayText':
                return $this->viewWeekday();
            case 'month_text':
            case 'monthText':
                return $this->viewMonth();
            case 'holiday_text':
            case 'holidayText':
                return $this->viewHoliday();
            case 'holiday':
                return $this->getHoliday();
            case 'is_holiday':
            case 'isHoliday':
                return $this->getHoliday() !== self::NO_HOLIDAY;
            case 'lunar_month_text':
            case 'lunarMonthText':
                return $this->viewLunarMonth();
            case 'lunar_month':
            case 'lunarMonth':
                return $this->getLunarMonth();
            case 'lunar_year':
            case 'lunarYear':
                return $this->getLunarYear();
            case 'lunar_day':
            case 'lunarDay':
                return $this->getLunarDay();
            case 'is_leap_month':
            case 'isLeapMonth':
                return $this->isLeapMonth();

        }

        return parent::__get($name);
    }

    /**
     * 24節気を取得する
     *
     * @return bool|int
     * @throws \ErrorException
     */
    protected function getSolarTermKey()
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->solar_term;
    }

    /**
     * 24節気を取得する
     *
     * @return string
     * @throws \ErrorException
     */
    protected function getSolarTerm()
    {
        $lunar_calendar = $this->getLunarCalendar();

        if ($lunar_calendar->solar_term === false) {
            return '';
        }

        return JapaneseDate::SOLAR_TERM[$lunar_calendar->solar_term];
    }

    /**
     * 旧暦データ取得
     *
     * @return      \JapaneseDate\Elements\LunarDate
     * @throws \ErrorException
     */
    protected function getLunarCalendar()
    {
        $mdy = $this->month . '-' . $this->day . '-' . $this->year;
        if (!isset($this->lunar_calendar[$mdy])) {
            $this->lunar_calendar[$mdy] = $this->LunarCalendar->getLunarDate(
                $this
            );
        }

        return $this->lunar_calendar[$mdy];
    }

    /**
     * ２４節気かどうか
     *
     * @return      boolean
     * @throws \ErrorException
     */
    protected function isSolarTerm()
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->solar_term !== false;
    }

    /**
     * 日本語フォーマットされた年号を返す
     *
     * @return      string
     * @throws \Exception
     */
    protected function viewEraName()
    {
        $key = $this->getEraName();

        return $this->JapaneseDate->viewEraName($key);
    }

    /**
     * 年号キーを返す
     *
     * @return int
     * @throws \Exception
     */
    protected function getEraName()
    {
        $TaishoStart = new DateTime('1912-07-30 00:00:00', $this->getTimezone());
        $ShowaStart  = new DateTime('1926-12-25 00:00:00', $this->getTimezone());
        $HeiseiStart = new DateTime('1989-01-08 00:00:00', $this->getTimezone());
        $ReiwaStart  = new DateTime('2019-05-01 00:00:00', $this->getTimezone());

        if ($TaishoStart > $this) {
            // 明治
            return self::ERA_MEIJI;
        }

        if ($TaishoStart <= $this && $ShowaStart > $this) {
            // 大正
            return self::ERA_TAISHO;
        }

        if ($ShowaStart <= $this && $HeiseiStart > $this) {
            // 昭和
            return self::ERA_SHOWA;
        }
        if ($HeiseiStart <= $this && $ReiwaStart > $this) {
            // 平成
            return self::ERA_HEISEI;
        }

        // 平成の次
        return self::ERA_REIWA;
    }

    /**
     * 日本語フォーマットされた干支を返す
     *
     * @return      string
     */
    protected function viewOrientalZodiac(): string
    {
        $key = $this->getOrientalZodiac();

        return $this->JapaneseDate->viewOrientalZodiac($key);
    }

    /**
     * 干支キーを返す
     *
     * @return int
     */
    protected function getOrientalZodiac(): int
    {
        $res = ($this->year + 9) % 12;

        return $res;
    }

    /**
     * 日本語フォーマットされた六曜名を返す
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function viewSixWeekday(): string
    {
        $key = $this->getSixWeekday();

        return $this->JapaneseDate->viewSixWeekday($key);
    }

    /**
     * 六曜を数値化して返します
     *
     * @return      int
     * @throws \ErrorException
     */
    protected function getSixWeekday(): int
    {
        $lunar_calendar = $this->getLunarCalendar();

        return ($lunar_calendar->month + $lunar_calendar->day) % 6;
    }

    /**
     * 日本語フォーマットされた曜日名を返す
     *
     * @return      string
     */
    protected function viewWeekday(): string
    {
        $key = $this->dayOfWeek;

        return $this->JapaneseDate->viewWeekday($key);
    }

    /**
     * 日本語フォーマットされた日本月名を返す
     *
     * @return string
     */
    protected function viewMonth(): string
    {
        $key = $this->month;

        return $this->JapaneseDate->viewMonth($key);
    }

    /**
     * 日本語フォーマットされた休日名を返す
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function viewHoliday(): string
    {
        $key = $this->getHoliday();

        return $this->JapaneseDate->viewHoliday($key);
    }

    /**
     * 祝日キーを返す
     *
     * @return      int
     * @throws \ErrorException
     */
    protected function getHoliday(): int
    {
        $holiday_list = $this->JapaneseDate->getHolidayList($this);

        return isset($holiday_list[$this->day]) ? $holiday_list[$this->day] : self::NO_HOLIDAY;
    }

    /**
     * 旧暦(月)
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function viewLunarMonth(): string
    {
        $key = $this->getLunarMonth();

        return $this->JapaneseDate->viewMonth($key);
    }

    /**
     * 旧暦（月）
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function getLunarMonth(): string
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->month;
    }

    /**
     * 旧暦（年）
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function getLunarYear(): string
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->year;
    }

    /**
     * 旧暦（日）
     *
     * @return      string
     * @throws \ErrorException
     */
    protected function getLunarDay(): string
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->day;
    }

    /**
     * 閏月かどうか
     *
     * @return      bool
     * @throws \ErrorException
     */
    protected function isLeapMonth(): bool
    {
        $lunar_calendar = $this->getLunarCalendar();

        return $lunar_calendar->is_leap_month;
    }

    /**
     * 和暦を返す
     *
     * @param null|int $era_key 元号キー
     * @return int
     * @throws \Exception
     */
    protected function getEraYear($era_key = null): int
    {
        $era_calc = [self::ERA_MEIJI => 1868,
            self::ERA_TAISHO         => 1912,
            self::ERA_SHOWA          => 1926,
            self::ERA_HEISEI         => 1989,
            self::ERA_REIWA          => 2019,
        ];

        $era_key = $era_key ?? $this->getEraName();

        return $this->year - $era_calc[$era_key] + 1;
    }
}
