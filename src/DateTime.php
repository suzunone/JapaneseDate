<?php

/**
 * DateTime.php
 *
 * 日本の暦（国民の祝日・元号・六曜・二十四節気・旧暦）に完全対応した、
 * {@link \Carbon\Carbon} 継承の可変（ミュータブル）日時クラスです。
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
 * @since       1.0.0
 */

namespace JapaneseDate;

use Carbon\Carbon;
use Exception;
use JapaneseDate\Components\JapaneseDate;
use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\Components\MiscSeasonalNode;
use JapaneseDate\Components\SeasonalFestival;
use JapaneseDate\Components\SexagenaryCycle;
use JapaneseDate\Exceptions\NativeDateTimeException;
use JapaneseDate\Traits\DateTimeImport;

/**
 * 日本の暦（国民の祝日・元号・六曜・二十四節気・旧暦）に完全対応した可変（ミュータブル）日時クラス。
 *
 * 日時操作ライブラリ {@link \Carbon\Carbon} を継承しており、Carbon および PHP 標準
 * {@link \DateTime} が持つすべてのメソッド・プロパティをそのまま利用できます。
 * 加えて、日本のビジネス実務や伝統的な暦の計算に必要な機能を透過的に追加しています。
 *
 * **主な拡張機能:**
 *
 * 1. **国民の祝日・休日判定**
 *    - 昭和23年（1948年）の祝日法施行以降の全祝日に対応。
 *    - 振替休日・国民の休日・特殊な一回限りの祝日（皇室の儀式・オリンピック等）を自動計算。
 *    - `$date->holiday` → 祝日定数（int）、`$date->holidayText` → 祝日名（string）
 *    - `$date->is_holiday` → 祝日であれば true
 *
 * 2. **元号（和暦）変換**
 *    - 明治（1868〜）・大正・昭和・平成・令和（2019〜）に対応。
 *    - `$date->eraName` → 元号定数（int）、`$date->eraNameText` → 「令和」など（string）
 *    - `$date->eraYear` → 元号年（例: 令和8年なら 8）
 *
 * 3. **六曜の算出**
 *    - 旧暦（太陰太陽暦）に基づく大安・仏滅・先勝・友引・先負・赤口の判定。
 *    - `$date->sixWeekday` → 六曜定数（int）、`$date->sixWeekdayText` → 「大安」など
 *
 * 4. **二十四節気**
 *    - 天文学的計算（太陽黄経15度ごと）に基づく立春・夏至・秋分・冬至など全24節気の判定。
 *    - `$date->solarTerm` → 節気定数または false、`$date->solarTermText` → 節気名
 *    - 各節気の日付取得: `$date->nextSyunbun`（次の春分）など
 *
 * 5. **旧暦・月相**
 *    - `$date->lunarMonth` → 旧暦月（int）、`$date->lunarDay` → 旧暦日（int）
 *    - `$date->moonPhase` → 月相定数（int）、`$date->moonPhaseText` → 「新月」など
 *
 * 6. **干支（かんし）**
 *    - 十二支: `$date->orientalZodiac` → 定数、`$date->orientalZodiacText` → 「午」など
 *    - 十干: `$date->heavenlyStem` → 定数、`$date->heavenlyStemText` → 「丙」など
 *
 * **イミュータブル版が必要な場合は {@see \JapaneseDate\DateTimeImmutable} を使用してください。**
 *
 * **使用例:**
 * ```php
 * use JapaneseDate\DateTime;
 *
 * $date = DateTime::parse('2026-05-03');
 * echo $date->holidayText;      // 憲法記念日
 * echo $date->eraNameText;      // 令和
 * echo $date->eraYear;          // 8
 * echo $date->sixWeekdayText;   // 大安・先勝 etc.
 * echo $date->solarTermText;    // 節気名（節気の日以外は空文字列）
 *
 * // 次の祝日に移動する
 * $nextHoliday = DateTime::now()->nextHoliday();
 * echo $nextHoliday->format('Y-m-d') . ' ' . $nextHoliday->holidayText;
 * ```
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
 * @since       1.0.0
 */
class DateTime extends Carbon implements DateTimeInterface
{
    use DateTimeImport;

    /**
     * 祝日定数: 非祝日（祝日でない通常の日）。
     *
     * `holiday` プロパティがこの値を返す場合、当日は祝日・休日ではありません。
     * `holidayText` は空文字列 `''` を返します。
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
     * 祝日定数:天皇の即位の日
     *
     * @var int
     */
    public const EMPERORS_THRONE_DAY = 23;

    /**
     * 祝日定数:スポーツの日
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
     * 二回目の東京オリンピックの年(リスケ)
     *
     * 特別祝日
     *
     * @var int
     */
    public const SECOND_TIME_TOKYO_OLYMPIC_RESCHEDULE_YEAR = 2021;

    /**
     * 特定月定数:春分の日
     *
     * @var int
     */
    public const VERNAL_EQUINOX_DAY_MONTH = 3;

    /**
     * 特定月定数:秋分の日
     *
     * @var int
     */
    public const AUTUMNAL_EQUINOX_DAY_MONTH = 9;

    /**
     * 曜日定数:日
     *
     * @var int
     */
    public const SUNDAY = 0;

    /**
     * 曜日定数:月
     *
     * @var int
     */
    public const MONDAY = 1;

    /**
     * 曜日定数:火
     *
     * @var int
     */
    public const TUESDAY = 2;

    /**
     * 曜日定数:水
     *
     * @var int
     */
    public const WEDNESDAY = 3;

    /**
     * 曜日定数:木
     *
     * @var int
     */
    public const THURSDAY = 4;

    /**
     * 曜日定数:金
     *
     * @var int
     */
    public const FRIDAY = 5;

    /**
     * 曜日定数:土
     *
     * @var int
     */
    public const SATURDAY = 6;

    /**
     * 六曜定数:大安
     *
     * @var int
     */
    public const SIX_WEEKDAY_TAIAN = 0;

    /**
     * 六曜定数:赤口
     *
     * @var int
     */
    public const SIX_WEEKDAY_SYAKKOU = 1;

    /**
     * 六曜定数:先勝
     *
     * @var int
     */
    public const SIX_WEEKDAY_SENSYOU = 2;

    /**
     * 六曜定数:友引
     *
     * @var int
     */
    public const SIX_WEEKDAY_TOMOBIKI = 3;

    /**
     * 六曜定数:先負
     *
     * @var int
     */
    public const SIX_WEEKDAY_SENBU = 4;

    /**
     * 六曜定数:仏滅
     *
     * @var int
     */
    public const SIX_WEEKDAY_BUTSUMETSU = 5;

    /**
     * 月相定数:新月
     *
     * @var int
     */
    public const MOON_PHASE_SHINGETSU = 0;

    /**
     * 月相定数:三日月
     *
     * @var int
     */
    public const MOON_PHASE_MIKAZUKI = 1;

    /**
     * 月相定数:上弦
     *
     * @var int
     */
    public const MOON_PHASE_JOUGEN = 2;

    /**
     * 月相定数:十三夜
     *
     * @var int
     */
    public const MOON_PHASE_JUUSANYA = 3;

    /**
     * 月相定数:満月
     *
     * @var int
     */
    public const MOON_PHASE_MANGETSU = 4;

    /**
     * 月相定数:十六夜
     *
     * @var int
     */
    public const MOON_PHASE_IZAYOI = 5;

    /**
     * 月相定数:下弦
     *
     * @var int
     */
    public const MOON_PHASE_KAGEN = 6;

    /**
     * 月相定数:有明
     *
     * @var int
     */
    public const MOON_PHASE_ARIAKE = 7;

    /**
     * 元号定数: 明治（1868年1月25日〜1912年7月29日）。
     *
     * `eraName` プロパティが返す値です。
     * `eraNameText` は `'明治'` を返します。
     *
     * @var int
     */
    public const ERA_MEIJI = 1000;

    /**
     * 元号定数: 大正（1912年7月30日〜1926年12月24日）。
     *
     * `eraName` プロパティが返す値です。
     * `eraNameText` は `'大正'` を返します。
     *
     * @var int
     */
    public const ERA_TAISHO = 1001;

    /**
     * 元号定数: 昭和（1926年12月25日〜1989年1月7日）。
     *
     * `eraName` プロパティが返す値です。
     * `eraNameText` は `'昭和'` を返します。
     *
     * @var int
     */
    public const ERA_SHOWA = 1002;

    /**
     * 元号定数: 平成（1989年1月8日〜2019年4月30日）。
     *
     * `eraName` プロパティが返す値です。
     * `eraNameText` は `'平成'` を返します。
     *
     * @var int
     */
    public const ERA_HEISEI = 1003;

    /**
     * 元号定数: 令和（旧称 ERA_HEISEI_NEXT）の非推奨エイリアス。
     *
     * {@see ERA_REIWA} と同じ値です。新規コードでは {@see ERA_REIWA} を使用してください。
     *
     * @var int
     * @deprecated {@see ERA_REIWA} を使用してください。
     */
    public const ERA_HEISEI_NEXT = 1004;

    /**
     * 元号定数: 令和（2019年5月1日〜）。
     *
     * `eraName` プロパティが返す値です。
     * `eraNameText` は `'令和'` を返します。
     *
     * @var int
     */
    public const ERA_REIWA = 1004;

    /**
     * 24節気定数:春分
     *
     * @var int
     */
    public const SOLAR_TERM_SYUNBUN = 0;

    /**
     * 24節気定数:清明
     *
     * @var int
     */
    public const SOLAR_TERM_SEIMEI = 1;

    /**
     * 24節気定数:穀雨
     *
     * @var int
     */
    public const SOLAR_TERM_KOKUU = 2;

    /**
     * 24節気定数:立夏
     *
     * @var int
     */
    public const SOLAR_TERM_RIKKA = 3;

    /**
     * 24節気定数:小満
     *
     * @var int
     */
    public const SOLAR_TERM_SYOUMAN = 4;

    /**
     * 24節気定数:芒種
     *
     * @var int
     */
    public const SOLAR_TERM_BOUSYU = 5;

    /**
     * 24節気定数:夏至
     *
     * @var int
     */
    public const SOLAR_TERM_GESHI = 6;

    /**
     * 24節気定数:小暑
     *
     * @var int
     */
    public const SOLAR_TERM_SYOUSYO = 7;

    /**
     * 24節気定数:大暑
     *
     * @var int
     */
    public const SOLAR_TERM_TAISYO = 8;

    /**
     * 24節気定数:立秋
     *
     * @var int
     */
    public const SOLAR_TERM_RISSYUU = 9;

    /**
     * 24節気定数:処暑
     *
     * @var int
     */
    public const SOLAR_TERM_SYOSYO = 10;

    /**
     * 24節気定数:白露
     *
     * @var int
     */
    public const SOLAR_TERM_HAKURO = 11;

    /**
     * 24節気定数:秋分
     *
     * @var int
     */
    public const SOLAR_TERM_SYUUBUN = 12;

    /**
     * 24節気定数:寒露
     *
     * @var int
     */
    public const SOLAR_TERM_KANRO = 13;

    /**
     * 24節気定数:霜降
     *
     * @var int
     */
    public const SOLAR_TERM_SOUKOU = 14;

    /**
     * 24節気定数:立冬
     *
     * @var int
     */
    public const SOLAR_TERM_RITTOU = 15;

    /**
     * 24節気定数:小雪
     *
     * @var int
     */
    public const SOLAR_TERM_SYOUSETSU = 16;

    /**
     * 24節気定数:大雪
     *
     * @var int
     */
    public const SOLAR_TERM_TAISETSU = 17;

    /**
     * 24節気定数:冬至
     *
     * @var int
     */
    public const SOLAR_TERM_TOUJI = 18;

    /**
     * 24節気定数:小寒
     *
     * @var int
     */
    public const SOLAR_TERM_SYOUKAN = 19;

    /**
     * 24節気定数:大寒
     *
     * @var int
     */
    public const SOLAR_TERM_DAIKAN = 20;

    /**
     * 24節気定数:立春
     *
     * @var int
     */
    public const SOLAR_TERM_RISSYUN = 21;

    /**
     * 24節気定数:雨水
     *
     * @var int
     */
    public const SOLAR_TERM_USUI = 22;

    /**
     * 24節気定数:啓蟄
     *
     * @var int
     */
    public const SOLAR_TERM_KEICHITSU = 23;

    /**
     * 十二支定数:亥
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_I = 0;

    /**
     * 十二支定数:子
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_NE = 1;

    /**
     * 十二支定数:丑
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_USHI = 2;

    /**
     * 十二支定数:寅
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_TORA = 3;

    /**
     * 十二支定数:卯
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_U = 4;

    /**
     * 十二支定数:辰
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_TATSU = 5;

    /**
     * 十二支定数:巳
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_MI = 6;

    /**
     * 十二支定数:午
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_UMA = 7;

    /**
     * 十二支定数:未
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_HITSUJI = 8;

    /**
     * 十二支定数:申
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_SARU = 9;

    /**
     * 十二支定数:酉
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_TORI = 10;

    /**
     * 十二支定数:戌
     *
     * @var int
     */
    public const ORIENTAL_ZODIAC_INU = 11;

    /**
     * 十干定数:甲 (きのえ)
     *
     * @var int
     */
    public const HEAVENLY_STEM_KINOE = 0;

    /**
     * 十干定数:乙 (きのと)
     *
     * @var int
     */
    public const HEAVENLY_STEM_KINOTO = 1;

    /**
     * 十干定数:丙 (ひのえ)
     *
     * @var int
     */
    public const HEAVENLY_STEM_HINOE = 2;

    /**
     * 十干定数:丁 (ひのと)
     *
     * @var int
     */
    public const HEAVENLY_STEM_HINOTO = 3;

    /**
     * 十干定数:戊 (つちのえ)
     *
     * @var int
     */
    public const HEAVENLY_STEM_TSUCHINOE = 4;

    /**
     * 十干定数:己 (つちのと)
     *
     * @var int
     */
    public const HEAVENLY_STEM_TSUCHINOTO = 5;

    /**
     * 十干定数:庚 (かのえ)
     *
     * @var int
     */
    public const HEAVENLY_STEM_KANOE = 6;

    /**
     * 十干定数:辛 (かのと)
     *
     * @var int
     */
    public const HEAVENLY_STEM_KANOTO = 7;

    /**
     * 十干定数:壬 (みずのえ)
     *
     * @var int
     */
    public const HEAVENLY_STEM_MIZUNOE = 8;

    /**
     * 十干定数:癸 (みずのと)
     *
     * @var int
     */
    public const HEAVENLY_STEM_MIZUNOTO = 9;

    /**
     * 雑節定数: 雑節に該当しない通常の日。
     *
     * `miscSeasonalNode` プロパティがこの値を返す場合、当日はいずれの雑節にも該当しません。
     * `miscSeasonalNodeText` は空文字列 `''` を返します。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_NONE = 0;

    /**
     * 雑節定数: 節分（立春の前日）。
     *
     * 現代では立春（2月3〜4日頃）の前日を指します。
     * 豆まきや恵方巻きの風習で知られています。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_SETSUBUN = 1;

    /**
     * 雑節定数: 彼岸（春分・秋分を中日とした前後3日間、計7日）。
     *
     * 春彼岸（春分の前後3日）と秋彼岸（秋分の前後3日）の両方を含みます。
     * 先祖の墓参りをする仏教行事として広く知られています。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_HIGAN = 2;

    /**
     * 雑節定数: 社日（春分・秋分に最も近い戊〈つちのえ〉の日）。
     *
     * 農業の守護神（産土神）を祀る日で、春社日と秋社日の両方を含みます。
     * 同距離の場合は前の日（春分・秋分より前の戊の日）が優先されます。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_SHANICHI = 3;

    /**
     * 雑節定数: 八十八夜（立春から数えて88日目）。
     *
     * 立春を1日目として数えた88日目（立春の87日後）で、
     * 5月1〜2日頃にあたります。茶摘みの目安として知られています。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_HACHIJUHACHIYA = 4;

    /**
     * 雑節定数: 入梅（太陽黄経80°）。
     *
     * 太陽の黄経が80°に達する日で、梅雨入りの目安とされます。
     * 芒種（黄経75°）の数日後にあたり、6月10〜11日頃です。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_NYUBAI = 5;

    /**
     * 雑節定数: 半夏生（太陽黄経100°）。
     *
     * 太陽の黄経が100°に達する日で、夏至（90°）の約10〜11日後にあたります。
     * 7月1〜2日頃で、農作業の区切りとされています。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_HANGESHO = 6;

    /**
     * 雑節定数: 土用（立春・立夏・立秋・立冬の各18日前から節気前日まで）。
     *
     * 1年に4回あります（春土用・夏土用・秋土用・冬土用）。
     * 「土用の丑の日」はうなぎを食べる夏の土用（立秋前）が特に有名です。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_DOYO = 7;

    /**
     * 雑節定数: 二百十日（立春から数えて210日目）。
     *
     * 立春を1日目として数えた210日目（立春の209日後）で、
     * 9月1日頃にあたります。台風の多い時期として農家が警戒する日です。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_NIHYAKUTOKA = 8;

    /**
     * 雑節定数: 二百二十日（立春から数えて220日目）。
     *
     * 立春を1日目として数えた220日目（立春の219日後）で、
     * 9月11日頃にあたります。二百十日に続く台風警戒日です。
     *
     * @var int
     */
    public const MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI = 9;

    /**
     * 五節句定数: 五節句に該当しない通常の日。
     *
     * `solarSeasonalFestival` や `lunarSeasonalFestival` プロパティがこの値を返す場合、
     * 当日はいずれの五節句にも該当しません。
     * 対応する名称プロパティは空文字列 `''` を返します。
     *
     * @var int
     */
    public const SEASONAL_FESTIVAL_NONE = 0;

    /**
     * 五節句定数: 人日の節句（1月7日 / 旧暦1月7日）。
     *
     * 七草の節句とも呼ばれます。七草がゆを食べて一年の無病息災を祈る日です。
     *
     * - 西暦固定日: 1月7日
     * - 旧暦: 旧暦1月7日（毎年異なるグレゴリオ暦日）
     *
     * @var int
     */
    public const SEASONAL_FESTIVAL_JINJITSU = 1;

    /**
     * 五節句定数: 上巳の節句（3月3日 / 旧暦3月3日）。
     *
     * 桃の節句・雛祭りとも呼ばれます。女の子の健やかな成長を祈る節句です。
     *
     * - 西暦固定日: 3月3日
     * - 旧暦: 旧暦3月3日（毎年異なるグレゴリオ暦日）
     *
     * @var int
     */
    public const SEASONAL_FESTIVAL_JOSHI = 2;

    /**
     * 五節句定数: 端午の節句（5月5日 / 旧暦5月5日）。
     *
     * 菖蒲の節句とも呼ばれます。男の子の健やかな成長を祈る節句で、こどもの日でもあります。
     *
     * - 西暦固定日: 5月5日
     * - 旧暦: 旧暦5月5日（毎年異なるグレゴリオ暦日）
     *
     * @var int
     */
    public const SEASONAL_FESTIVAL_TANGO = 3;

    /**
     * 五節句定数: 七夕の節句（7月7日 / 旧暦7月7日）。
     *
     * 笹の節句とも呼ばれます。織姫と彦星の伝説に由来し、短冊に願いを書く習慣があります。
     *
     * - 西暦固定日: 7月7日
     * - 旧暦: 旧暦7月7日（毎年異なるグレゴリオ暦日）
     *
     * @var int
     */
    public const SEASONAL_FESTIVAL_TANABATA = 4;

    /**
     * 五節句定数: 重陽の節句（9月9日 / 旧暦9月9日）。
     *
     * 菊の節句とも呼ばれます。菊の花を愛でながら長寿を祈る節句です。
     * 陽数（奇数）の極数「九」が重なることから「重陽」と呼ばれます。
     *
     * - 西暦固定日: 9月9日
     * - 旧暦: 旧暦9月9日（毎年異なるグレゴリオ暦日）
     *
     * @var int
     */
    public const SEASONAL_FESTIVAL_CHOYO = 5;

    /**
     * DateTime コンストラクタ。
     *
     * 引数の型に柔軟に対応した日時オブジェクトを生成します。
     * Unix タイムスタンプ・既存の DateTimeInterface オブジェクト・日時文字列・null（現在日時）を
     * 渡すことができます。
     *
     * **型別動作:**
     *
     * | 型 | 動作 |
     * |---|---|
     * | `int` / `float` | Unix タイムスタンプとして解釈 |
     * | `DateTimeInterface` | 書式文字列でコピーを生成 |
     * | 日時文字列 | Carbon のコンストラクタに委譲（相対・絶対両方に対応） |
     * | `null` | 現在日時を使用 |
     *
     * 文字列の書式については
     * {@link http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式}
     * を参照してください。
     *
     * **使用例:**
     * ```php
     * $now = new DateTime();                        // 現在日時
     * $specific = new DateTime('2026-05-03');        // 特定日付
     * $tz = new DateTime('now', new \DateTimeZone('Asia/Tokyo'));
     * ```
     *
     * `new DateTime()` よりも {@see factory()} を使用すると、
     * Unix タイムスタンプや DateTimeInterface オブジェクトも直接渡せて便利です。
     *
     * @param int|float|string|\DateTimeInterface|null $date_time
     *   生成する日時。日時文字列・Unix タイムスタンプ・DateTimeInterface・null のいずれかを渡せます。
     * @param \DateTimeZone|null $time_zone
     *   タイムゾーン。省略時は PHP のデフォルトタイムゾーンを使用します。
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     *   日時文字列の解析に失敗した場合にスローされます。
     */
    public function __construct($date_time = null, $time_zone = null)
    {
        try {
            parent::__construct($date_time, $time_zone);
        } catch (Exception $exception) {
            throw new NativeDateTimeException('Throwing native DateTime class construct exception.', $exception->getCode(), $exception);
        }

        $this->JapaneseDate = JapaneseDate::factory();
        $this->LunarCalendar = LunarCalendar::factory();
        $this->SexagenaryCycle = SexagenaryCycle::factory();
        $this->MiscSeasonalNode = MiscSeasonalNode::factory();
        $this->SeasonalFestival = SeasonalFestival::factory();
    }
}
