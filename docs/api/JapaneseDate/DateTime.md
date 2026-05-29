# DateTime

**Namespace:** `JapaneseDate`

class **DateTime** extends [Carbon](../Carbon/Carbon.md) implements [DateTimeInterface](../JapaneseDate/DateTimeInterface.md)

日本の暦（国民の祝日・元号・六曜・二十四節気・旧暦）に完全対応した可変（ミュータブル）日時クラス。

日時操作ライブラリ [\Carbon\Carbon](../Carbon/Carbon.html) を継承しており、Carbon および PHP 標準
[DateTime](https://www.php.net/DateTime) が持つすべてのメソッド・プロパティをそのまま利用できます。
加えて、日本のビジネス実務や伝統的な暦の計算に必要な機能を透過的に追加しています。

**主な拡張機能:**

1. **国民の祝日・休日判定**
   - 昭和23年（1948年）の祝日法施行以降の全祝日に対応。
   - 振替休日・国民の休日・特殊な一回限りの祝日（皇室の儀式・オリンピック等）を自動計算。
   - `$date->holiday` → 祝日定数（int）、`$date->holidayText` → 祝日名（string）
   - `$date->is_holiday` → 祝日であれば true

2. **元号（和暦）変換**
   - 明治（1868〜）・大正・昭和・平成・令和（2019〜）に対応。
   - `$date->eraName` → 元号定数（int）、`$date->eraNameText` → 「令和」など（string）
   - `$date->eraYear` → 元号年（例: 令和8年なら 8）

3. **六曜の算出**
   - 旧暦（太陰太陽暦）に基づく大安・仏滅・先勝・友引・先負・赤口の判定。
   - `$date->sixWeekday` → 六曜定数（int）、`$date->sixWeekdayText` → 「大安」など

4. **二十四節気**
   - 天文学的計算（太陽黄経15度ごと）に基づく立春・夏至・秋分・冬至など全24節気の判定。
   - `$date->solarTerm` → 節気定数または false、`$date->solarTermText` → 節気名
   - 各節気の日付取得: `$date->nextSyunbun`（次の春分）など

5. **旧暦・月相**
   - `$date->lunarMonth` → 旧暦月（int）、`$date->lunarDay` → 旧暦日（int）
   - `$date->moonPhase` → 月相定数（int）、`$date->moonPhaseText` → 「新月」など

6. **干支（かんし）**
   - 十二支: `$date->orientalZodiac` → 定数、`$date->orientalZodiacText` → 「午」など
   - 十干: `$date->heavenlyStem` → 定数、`$date->heavenlyStemText` → 「丙」など

**イミュータブル版が必要な場合は {\JapaneseDate\DateTimeImmutable} を使用してください。**

**使用例:**
```php
use JapaneseDate\DateTime;

$date = DateTime::parse('2026-05-03');
echo $date->holidayText;      // 憲法記念日
echo $date->eraNameText;      // 令和
echo $date->eraYear;          // 8
echo $date->sixWeekdayText;   // 大安・先勝 etc.
echo $date->solarTermText;    // 節気名（節気の日以外は空文字列）

// 次の祝日に移動する
$nextHoliday = DateTime::now()->nextHoliday();
echo $nextHoliday->format('Y-m-d') . ' ' . $nextHoliday->holidayText;
```

## Traits

- [DateTimeImport](../JapaneseDate/Traits/DateTimeImport.md)
- [Component](../JapaneseDate/Traits/Component.md)
- [Factory](../JapaneseDate/Traits/Factory.md)
- [CacheSetting](../JapaneseDate/Traits/CacheSetting.md)
- [Lunar](../JapaneseDate/Traits/Lunar.md)
- [Modern](../JapaneseDate/Traits/Modern.md)
- [Modifier](../JapaneseDate/Traits/Modifier.md)
- [FindSolarTerm](../JapaneseDate/Traits/FindSolarTerm.md)
- [Getter](../JapaneseDate/Traits/Getter.md)
- [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md)
- [Business](../JapaneseDate/Traits/Business.md)
- Date

## Constants

| Modifier | Name | Description |
|---|---|---|
| public | `NO_HOLIDAY` | 祝日定数: 非祝日（祝日でない通常の日）。 |
| public | `NEW_YEAR_S_DAY` | 祝日定数:元旦 |
| public | `COMING_OF_AGE_DAY` | 祝日定数:成人の日 |
| public | `NATIONAL_FOUNDATION_DAY` | 祝日定数:建国記念の日 |
| public | `THE_SHOWA_EMPEROR_DIED` | 祝日定数:昭和天皇の大喪の礼 |
| public | `VERNAL_EQUINOX_DAY` | 祝日定数:春分の日 |
| public | `DAY_OF_SHOWA` | 祝日定数:昭和の日 |
| public | `GREENERY_DAY` | 祝日定数:みどりの日 |
| public | `THE_EMPEROR_S_BIRTHDAY` | 祝日定数:天皇誕生日 |
| public | `CROWN_PRINCE_HIROHITO_WEDDING` | 祝日定数:皇太子明仁親王の結婚の儀 |
| public | `CONSTITUTION_DAY` | 祝日定数:憲法記念日 |
| public | `NATIONAL_HOLIDAY` | 祝日定数:国民の休日 |
| public | `CHILDREN_S_DAY` | 祝日定数:こどもの日 |
| public | `COMPENSATING_HOLIDAY` | 祝日定数:振替休日 |
| public | `CROWN_PRINCE_NARUHITO_WEDDING` | 祝日定数:皇太子徳仁親王の結婚の儀 |
| public | `MARINE_DAY` | 祝日定数:海の日 |
| public | `AUTUMNAL_EQUINOX_DAY` | 祝日定数:秋分の日 |
| public | `RESPECT_FOR_SENIOR_CITIZENS_DAY` | 祝日定数:敬老の日 |
| public | `LEGACY_SPORTS_DAY` | 祝日定数:体育の日 |
| public | `CULTURE_DAY` | 祝日定数:文化の日 |
| public | `LABOR_THANKSGIVING_DAY` | 祝日定数:勤労感謝の日 |
| public | `REGNAL_DAY` | 祝日定数:即位礼正殿の儀 |
| public | `MOUNTAIN_DAY` | 祝日定数:山の日 |
| public | `EMPERORS_THRONE_DAY` | 祝日定数:天皇の即位の日 |
| public | `SPORTS_DAY` | 祝日定数:スポーツの日 |
| public | `HOLIDAY_START_YEAR` | 祝日法制定年 |
| public | `SECOND_TIME_TOKYO_OLYMPIC_YEAR` | 二回目の東京オリンピックの年 |
| public | `SECOND_TIME_TOKYO_OLYMPIC_RESCHEDULE_YEAR` | 二回目の東京オリンピックの年(リスケ) |
| public | `VERNAL_EQUINOX_DAY_MONTH` | 特定月定数:春分の日 |
| public | `AUTUMNAL_EQUINOX_DAY_MONTH` | 特定月定数:秋分の日 |
| public | `SUNDAY` | 曜日定数:日 |
| public | `MONDAY` | 曜日定数:月 |
| public | `TUESDAY` | 曜日定数:火 |
| public | `WEDNESDAY` | 曜日定数:水 |
| public | `THURSDAY` | 曜日定数:木 |
| public | `FRIDAY` | 曜日定数:金 |
| public | `SATURDAY` | 曜日定数:土 |
| public | `SIX_WEEKDAY_TAIAN` | 六曜定数:大安 |
| public | `SIX_WEEKDAY_SYAKKOU` | 六曜定数:赤口 |
| public | `SIX_WEEKDAY_SENSYOU` | 六曜定数:先勝 |
| public | `SIX_WEEKDAY_TOMOBIKI` | 六曜定数:友引 |
| public | `SIX_WEEKDAY_SENBU` | 六曜定数:先負 |
| public | `SIX_WEEKDAY_BUTSUMETSU` | 六曜定数:仏滅 |
| public | `MOON_PHASE_SHINGETSU` | 月相定数:新月 |
| public | `MOON_PHASE_MIKAZUKI` | 月相定数:三日月 |
| public | `MOON_PHASE_JOUGEN` | 月相定数:上弦 |
| public | `MOON_PHASE_JUUSANYA` | 月相定数:十三夜 |
| public | `MOON_PHASE_MANGETSU` | 月相定数:満月 |
| public | `MOON_PHASE_IZAYOI` | 月相定数:十六夜 |
| public | `MOON_PHASE_KAGEN` | 月相定数:下弦 |
| public | `MOON_PHASE_ARIAKE` | 月相定数:有明 |
| public | `ERA_MEIJI` | 元号定数: 明治（1868年1月25日〜1912年7月29日）。 |
| public | `ERA_TAISHO` | 元号定数: 大正（1912年7月30日〜1926年12月24日）。 |
| public | `ERA_SHOWA` | 元号定数: 昭和（1926年12月25日〜1989年1月7日）。 |
| public | `ERA_HEISEI` | 元号定数: 平成（1989年1月8日〜2019年4月30日）。 |
| public _(deprecated)_ | `ERA_HEISEI_NEXT` | 元号定数: 令和（旧称 ERA_HEISEI_NEXT）の非推奨エイリアス。 |
| public | `ERA_REIWA` | 元号定数: 令和（2019年5月1日〜）。 |
| public | `SOLAR_TERM_SYUNBUN` | 24節気定数:春分 |
| public | `SOLAR_TERM_SEIMEI` | 24節気定数:清明 |
| public | `SOLAR_TERM_KOKUU` | 24節気定数:穀雨 |
| public | `SOLAR_TERM_RIKKA` | 24節気定数:立夏 |
| public | `SOLAR_TERM_SYOUMAN` | 24節気定数:小満 |
| public | `SOLAR_TERM_BOUSYU` | 24節気定数:芒種 |
| public | `SOLAR_TERM_GESHI` | 24節気定数:夏至 |
| public | `SOLAR_TERM_SYOUSYO` | 24節気定数:小暑 |
| public | `SOLAR_TERM_TAISYO` | 24節気定数:大暑 |
| public | `SOLAR_TERM_RISSYUU` | 24節気定数:立秋 |
| public | `SOLAR_TERM_SYOSYO` | 24節気定数:処暑 |
| public | `SOLAR_TERM_HAKURO` | 24節気定数:白露 |
| public | `SOLAR_TERM_SYUUBUN` | 24節気定数:秋分 |
| public | `SOLAR_TERM_KANRO` | 24節気定数:寒露 |
| public | `SOLAR_TERM_SOUKOU` | 24節気定数:霜降 |
| public | `SOLAR_TERM_RITTOU` | 24節気定数:立冬 |
| public | `SOLAR_TERM_SYOUSETSU` | 24節気定数:小雪 |
| public | `SOLAR_TERM_TAISETSU` | 24節気定数:大雪 |
| public | `SOLAR_TERM_TOUJI` | 24節気定数:冬至 |
| public | `SOLAR_TERM_SYOUKAN` | 24節気定数:小寒 |
| public | `SOLAR_TERM_DAIKAN` | 24節気定数:大寒 |
| public | `SOLAR_TERM_RISSYUN` | 24節気定数:立春 |
| public | `SOLAR_TERM_USUI` | 24節気定数:雨水 |
| public | `SOLAR_TERM_KEICHITSU` | 24節気定数:啓蟄 |
| public | `ORIENTAL_ZODIAC_I` | 十二支定数:亥 |
| public | `ORIENTAL_ZODIAC_NE` | 十二支定数:子 |
| public | `ORIENTAL_ZODIAC_USHI` | 十二支定数:丑 |
| public | `ORIENTAL_ZODIAC_TORA` | 十二支定数:寅 |
| public | `ORIENTAL_ZODIAC_U` | 十二支定数:卯 |
| public | `ORIENTAL_ZODIAC_TATSU` | 十二支定数:辰 |
| public | `ORIENTAL_ZODIAC_MI` | 十二支定数:巳 |
| public | `ORIENTAL_ZODIAC_UMA` | 十二支定数:午 |
| public | `ORIENTAL_ZODIAC_HITSUJI` | 十二支定数:未 |
| public | `ORIENTAL_ZODIAC_SARU` | 十二支定数:申 |
| public | `ORIENTAL_ZODIAC_TORI` | 十二支定数:酉 |
| public | `ORIENTAL_ZODIAC_INU` | 十二支定数:戌 |
| public | `HEAVENLY_STEM_KINOE` | 十干定数:甲 (きのえ) |
| public | `HEAVENLY_STEM_KINOTO` | 十干定数:乙 (きのと) |
| public | `HEAVENLY_STEM_HINOE` | 十干定数:丙 (ひのえ) |
| public | `HEAVENLY_STEM_HINOTO` | 十干定数:丁 (ひのと) |
| public | `HEAVENLY_STEM_TSUCHINOE` | 十干定数:戊 (つちのえ) |
| public | `HEAVENLY_STEM_TSUCHINOTO` | 十干定数:己 (つちのと) |
| public | `HEAVENLY_STEM_KANOE` | 十干定数:庚 (かのえ) |
| public | `HEAVENLY_STEM_KANOTO` | 十干定数:辛 (かのと) |
| public | `HEAVENLY_STEM_MIZUNOE` | 十干定数:壬 (みずのえ) |
| public | `HEAVENLY_STEM_MIZUNOTO` | 十干定数:癸 (みずのと) |
| public | `MISC_SEASONAL_NODE_NONE` | 雑節定数: 雑節に該当しない通常の日。 |
| public | `MISC_SEASONAL_NODE_SETSUBUN` | 雑節定数: 節分（立春の前日）。 |
| public | `MISC_SEASONAL_NODE_HIGAN` | 雑節定数: 彼岸（春分・秋分を中日とした前後3日間、計7日）。 |
| public | `MISC_SEASONAL_NODE_SHANICHI` | 雑節定数: 社日（春分・秋分に最も近い戊〈つちのえ〉の日）。 |
| public | `MISC_SEASONAL_NODE_HACHIJUHACHIYA` | 雑節定数: 八十八夜（立春から数えて88日目）。 |
| public | `MISC_SEASONAL_NODE_NYUBAI` | 雑節定数: 入梅（太陽黄経80°）。 |
| public | `MISC_SEASONAL_NODE_HANGESHO` | 雑節定数: 半夏生（太陽黄経100°）。 |
| public | `MISC_SEASONAL_NODE_DOYO` | 雑節定数: 土用（立春・立夏・立秋・立冬の各18日前から節気前日まで）。 |
| public | `MISC_SEASONAL_NODE_NIHYAKUTOKA` | 雑節定数: 二百十日（立春から数えて210日目）。 |
| public | `MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI` | 雑節定数: 二百二十日（立春から数えて220日目）。 |
| public | `SEASONAL_FESTIVAL_NONE` | 五節句定数: 五節句に該当しない通常の日。 |
| public | `SEASONAL_FESTIVAL_JINJITSU` | 五節句定数: 人日の節句（1月7日 / 旧暦1月7日）。 |
| public | `SEASONAL_FESTIVAL_JOSHI` | 五節句定数: 上巳の節句（3月3日 / 旧暦3月3日）。 |
| public | `SEASONAL_FESTIVAL_TANGO` | 五節句定数: 端午の節句（5月5日 / 旧暦5月5日）。 |
| public | `SEASONAL_FESTIVAL_TANABATA` | 五節句定数: 七夕の節句（7月7日 / 旧暦7月7日）。 |
| public | `SEASONAL_FESTIVAL_CHOYO` | 五節句定数: 重陽の節句（9月9日 / 旧暦9月9日）。 |

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public | int | `$year` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$yearIso` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$month` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$day` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$hour` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$minute` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$second` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$micro` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$microsecond` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int\|float\|string | `$timestamp` _(from [Carbon](../Carbon/Carbon.md))_ | seconds since the Unix Epoch |
| public | string | `$englishDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the day of week in English |
| public | string | `$shortEnglishDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated day of week in English |
| public | string | `$englishMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the month in English |
| public | string | `$shortEnglishMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated month in English |
| public | int | `$milliseconds` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$millisecond` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$milli` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$week` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 53 |
| public | int | `$isoWeek` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 53 |
| public | int | `$weekYear` _(from [Carbon](../Carbon/Carbon.md))_ | year according to week format |
| public | int | `$isoWeekYear` _(from [Carbon](../Carbon/Carbon.md))_ | year according to ISO week format |
| public | int | `$dayOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 366 |
| public | int | `$age` _(from [Carbon](../Carbon/Carbon.md))_ | does a diffInYears() with default parameters |
| public | int | `$offset` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in seconds from UTC |
| public | int | `$offsetMinutes` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in minutes from UTC |
| public | int | `$offsetHours` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in hours from UTC |
| public | CarbonTimeZone | `$timezone` _(from [Carbon](../Carbon/Carbon.md))_ | the current timezone |
| public | CarbonTimeZone | `$tz` _(from [Carbon](../Carbon/Carbon.md))_ | alias of $timezone |
| public _(read-only)_ | int | `$dayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | 0 (for Sunday) through 6 (for Saturday) |
| public _(read-only)_ | int | `$dayOfWeekIso` _(from [Carbon](../Carbon/Carbon.md))_ | 1 (for Monday) through 7 (for Sunday) |
| public _(read-only)_ | int | `$weekOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | ISO-8601 week number of year, weeks starting on Monday |
| public _(read-only)_ | int | `$daysInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | number of days in the given month |
| public _(read-only)_ | string | `$latinMeridiem` _(from [Carbon](../Carbon/Carbon.md))_ | "am"/"pm" (Ante meridiem or Post meridiem latin lowercase mark) |
| public _(read-only)_ | string | `$latinUpperMeridiem` _(from [Carbon](../Carbon/Carbon.md))_ | "AM"/"PM" (Ante meridiem or Post meridiem latin uppercase mark) |
| public _(read-only)_ | string | `$timezoneAbbreviatedName` _(from [Carbon](../Carbon/Carbon.md))_ | the current timezone abbreviated name |
| public _(read-only)_ | string | `$tzAbbrName` _(from [Carbon](../Carbon/Carbon.md))_ | alias of $timezoneAbbreviatedName |
| public _(read-only)_ | string | `$dayName` _(from [Carbon](../Carbon/Carbon.md))_ | long name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortDayName` _(from [Carbon](../Carbon/Carbon.md))_ | short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$minDayName` _(from [Carbon](../Carbon/Carbon.md))_ | very short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$monthName` _(from [Carbon](../Carbon/Carbon.md))_ | long name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortMonthName` _(from [Carbon](../Carbon/Carbon.md))_ | short name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$meridiem` _(from [Carbon](../Carbon/Carbon.md))_ | lowercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | string | `$upperMeridiem` _(from [Carbon](../Carbon/Carbon.md))_ | uppercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | int | `$noZeroHour` _(from [Carbon](../Carbon/Carbon.md))_ | current hour from 1 to 24 |
| public _(read-only)_ | int | `$weeksInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$isoWeeksInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$weekOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 5 |
| public _(read-only)_ | int | `$weekNumberInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 5 |
| public _(read-only)_ | int | `$firstWeekDay` _(from [Carbon](../Carbon/Carbon.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$lastWeekDay` _(from [Carbon](../Carbon/Carbon.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$daysInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 365 or 366 |
| public _(read-only)_ | int | `$quarter` _(from [Carbon](../Carbon/Carbon.md))_ | the quarter of this instance, 1 - 4 |
| public _(read-only)_ | int | `$decade` _(from [Carbon](../Carbon/Carbon.md))_ | the decade of this instance |
| public _(read-only)_ | int | `$century` _(from [Carbon](../Carbon/Carbon.md))_ | the century of this instance |
| public _(read-only)_ | int | `$millennium` _(from [Carbon](../Carbon/Carbon.md))_ | the millennium of this instance |
| public _(read-only)_ | bool | `$dst` _(from [Carbon](../Carbon/Carbon.md))_ | daylight savings time indicator, true if DST, false otherwise |
| public _(read-only)_ | bool | `$local` _(from [Carbon](../Carbon/Carbon.md))_ | checks if the timezone is local, true if local, false otherwise |
| public _(read-only)_ | bool | `$utc` _(from [Carbon](../Carbon/Carbon.md))_ | checks if the timezone is UTC, true if UTC, false otherwise |
| public _(read-only)_ | string | `$timezoneName` _(from [Carbon](../Carbon/Carbon.md))_ | the current timezone name |
| public _(read-only)_ | string | `$tzName` _(from [Carbon](../Carbon/Carbon.md))_ | alias of $timezoneName |
| public _(read-only)_ | string | `$locale` _(from [Carbon](../Carbon/Carbon.md))_ | locale of the current instance |
| public _(read-only)_ | int | `$solar_seasonal_festival` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 西暦の月日から五節句IDを取得する（スネークケース）。五節句定数（0〜5）を返す。節句でない場合は 0。 |
| public _(read-only)_ | string | `$solar_seasonal_festival_name` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 西暦の月日から五節句の式名を取得する（スネークケース）。式名または空文字列。 |
| public _(read-only)_ | string | `$solar_seasonal_festival_alias` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 西暦の月日から五節句の別名を取得する（スネークケース）。別名または空文字列。 |
| public _(read-only)_ | int | `$lunar_seasonal_festival` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 旧暦の月日から五節句IDを取得する（スネークケース）。五節句定数（0〜5）を返す。節句でない場合は 0。 |
| public _(read-only)_ | string | `$lunar_seasonal_festival_name` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 旧暦の月日から五節句の式名を取得する（スネークケース）。式名または空文字列。 |
| public _(read-only)_ | string | `$lunar_seasonal_festival_alias` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 旧暦の月日から五節句の別名を取得する（スネークケース）。別名または空文字列。 |
| public _(read-only)_ | int | `$misc_seasonal_node` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 雑節を取得する（スネークケース）。雑節定数（0〜9）を返す。雑節でない場合は 0。 |
| public _(read-only)_ | string | `$misc_seasonal_node_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 雑節の日本語名を取得する（スネークケース）。雑節名または空文字列。 |
| public _(read-only)_ | int\|bool | `$solar_term` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
| public _(read-only)_ | string | `$solar_term_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$is_solar_term` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$era_name_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$era_name` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | int | `$era_year` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | string | `$oriental_zodiac_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$oriental_zodiac` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。 |
| public _(read-only)_ | string | `$heavenly_stem_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十干の名前を取得する。値は、 十干の名前を表す文字列です。 |
| public _(read-only)_ | int | `$heavenly_stem` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十干を整数で取得する。値は、 十干を表す整数 (0〜9) です。 |
| public _(read-only)_ | string | `$six_weekday_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する六曜の名前を取得する。値は、 六曜の名前を表す文字列、または 六曜でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$six_weekday` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する六曜を整数で取得する。値は、 六曜を表す整数、または 六曜でない場合は 0 になります。 |
| public _(read-only)_ | int | `$weekday_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する曜日の名前を取得する。値は、 曜日の名前を表す文字列、または 曜日でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$month_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する月の名前を取得する。値は、 月の名前を表す文字列、または 月でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$holiday_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が祝日である場合、祝日の名前を取得する。値は、 祝日の名前を表す文字列、または 祝日でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$holiday` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が祝日である場合、祝日の番号を取得する。値は、 祝日の番号を表す整数、または 祝日でない場合は 0 になります。 |
| public _(read-only)_ | bool | `$is_holiday` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が祝日であるかどうかを示すブール値。値は、 祝日である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$lunar_month_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の月の名前を取得する。値は、 陰暦の月の名前を表す文字列、または 陰暦の月でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$lunar_month` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の月を整数で取得する。値は、 陰暦の月を表す整数、または 陰暦の月でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunar_year` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の年を整数で取得する。値は、 陰暦の年を表す整数、または 陰暦の年でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunar_day` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の日を整数で取得する。値は、 陰暦の日を表す整数、または 陰暦の日でない場合は 0 になります。 |
| public _(read-only)_ | bool | `$is_leap_month` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が閏月であるかどうかを示すブール値。値は、 閏月である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | float | `$moon_age` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月齢を取得する。値は、 月齢を表す浮動小数点数、または 不明な場合は false になります。 |
| public _(read-only)_ | float | `$moon_phase_angle` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月の位相角を取得する。値は 0°(新月)〜359.9° の浮動小数点数です。 |
| public _(read-only)_ | int | `$moon_phase` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月相を取得する。値は 0(新月)〜7(有明) の整数です。 |
| public _(read-only)_ | string | `$moon_phase_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月相名を日本語で取得する。値は「新月」「三日月」「上弦」「十三夜」「満月」「十六夜」「下弦」「有明」のいずれかです。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の春分の日の日時を取得する。値は、 春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$seimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の清明の日の日時を取得する。値は、 清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_seimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_seimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$kokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の穀雨の日の日時を取得する。値は、 穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_kokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_kokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立夏の日の日時を取得する。値は、 立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小満の日の日時を取得する。値は、 小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$bousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の芒種の日の日時を取得する。値は、 芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_bousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_bousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$geshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の夏至の日の日時を取得する。値は、 夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_geshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_geshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小暑の日の日時を取得する。値は、 小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$taisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の大暑の日の日時を取得する。値は、 大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_taisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。o |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_taisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立秋の日の日時を取得する。値は、 立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の処暑の日の日時を取得する。値は、 処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$hakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の白露の日の日時を取得する。値は、 白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_hakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_hakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の秋分の日の日時を取得する。値は、 秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$kanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の寒露の日の日時を取得する。値は、 寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_kanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_kanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$soukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の霜降の日の日時を取得する。値は、 霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_soukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_soukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立冬の日の日時を取得する。値は、 立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小雪の日の日時を取得する。値は、 小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$taisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の大雪の日の日時を取得する。値は、 大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_taisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_taisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$touji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の冬至の日の日時を取得する。値は、 冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_touji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_touji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小寒の日の日時を取得する。値は、 小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$daikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の大寒の日の日時を取得する。値は、 大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。_syoukan |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_daikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_daikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立春の日の日時を取得する。値は、 立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$usui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の雨水の日の日時を取得する。値は、 雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_usui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_usui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$keichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の啓蟄の日の日時を取得する。値は、 啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_keichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_keichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。 |
| public _(read-only)_ | int | `$solarSeasonalFestival` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 西暦の月日から五節句IDを取得する。値は {[\JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（0）〜{@see](../JapaneseDate/DateTime.html) \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}（5）のいずれかです。節句でない場合は 0 を返します。 |
| public _(read-only)_ | string | `$solarSeasonalFestivalName` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 西暦の月日から五節句の式名を取得する。「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれか、または節句でない場合は空文字列を返します。 |
| public _(read-only)_ | string | `$solarSeasonalFestivalAlias` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 西暦の月日から五節句の別名を取得する。「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれか、または節句でない場合は空文字列を返します。 |
| public _(read-only)_ | int | `$lunarSeasonalFestival` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 旧暦の月日から五節句IDを取得する。値は {[\JapaneseDate\DateTime::SEASONAL_FESTIVAL_NONE}（0）〜{@see](../JapaneseDate/DateTime.html) \JapaneseDate\DateTime::SEASONAL_FESTIVAL_CHOYO}（5）のいずれかです。節句でない場合は 0 を返します。 |
| public _(read-only)_ | string | `$lunarSeasonalFestivalName` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 旧暦の月日から五節句の式名を取得する。「人日の節句」「上巳の節句」「端午の節句」「七夕の節句」「重陽の節句」のいずれか、または節句でない場合は空文字列を返します。 |
| public _(read-only)_ | string | `$lunarSeasonalFestivalAlias` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 旧暦の月日から五節句の別名を取得する。「七草の節句」「桃の節句」「菖蒲の節句」「笹の節句」「菊の節句」のいずれか、または節句でない場合は空文字列を返します。 |
| public _(read-only)_ | int | `$miscSeasonalNode` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が該当する雑節の定数を取得する。値は {[\JapaneseDate\DateTime::MISC_SEASONAL_NODE_NONE}（0）〜{@see](../JapaneseDate/DateTime.html) \JapaneseDate\DateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI}（9）のいずれかです。雑節でない場合は 0 を返します。 |
| public _(read-only)_ | string | `$miscSeasonalNodeText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が該当する雑節の日本語名を取得する。「節分」「彼岸」「社日」「八十八夜」「入梅」「半夏生」「土用」「二百十日」「二百二十日」のいずれか、または雑節でない場合は空文字列を返します。 |
| public _(read-only)_ | int\|bool | `$solarTerm` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
| public _(read-only)_ | string | `$solarTermText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$isSolarTerm` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$eraNameText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$eraName` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | int | `$eraYear` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | string | `$orientalZodiacText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$orientalZodiac` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。 |
| public _(read-only)_ | string | `$heavenlyStemText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十干の名前を取得する。値は、 十干の名前を表す文字列です。 |
| public _(read-only)_ | int | `$heavenlyStem` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十干を整数で取得する。値は、 十干を表す整数 (0〜9) です。 |
| public _(read-only)_ | string | `$sixWeekdayText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する六曜の名前を取得する。値は、 六曜の名前を表す文字列、または 六曜でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$sixWeekday` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する六曜を整数で取得する。値は、 六曜を表す整数、または 六曜でない場合は 0 になります。 |
| public _(read-only)_ | int | `$weekdayText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する曜日の名前を取得する。値は、 曜日の名前を表す文字列、または 曜日でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$monthText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する月の名前を取得する。値は、 月の名前を表す文字列、または 月でない場合は空文字列になります。 |
| public _(read-only)_ | string | `$holidayText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が祝日である場合、祝日の名前を取得する。値は、 祝日の名前を表す文字列、または 祝日でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$isHoliday` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が祝日であるかどうかを示すブール値。値は、 祝日である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$lunarMonthText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の月の名前を取得する。値は、 陰暦の月の名前を表す文字列、または 陰暦の月でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$lunarMonth` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の月を整数で取得する。値は、 陰暦の月を表す整数、または 陰暦の月でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunarYear` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の年を整数で取得する。値は、 陰暦の年を表す整数、または 陰暦の年でない場合は 0 になります。 |
| public _(read-only)_ | int | `$lunarDay` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する陰暦の日を整数で取得する。値は、 陰暦の日を表す整数、または 陰暦の日でない場合は 0 になります。 |
| public _(read-only)_ | bool | `$isLeapMonth` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が閏月であるかどうかを示すブール値。値は、 閏月である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | float | `$moonAge` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月齢を取得する。値は、 月齢を表す浮動小数点数、または 不明な場合は false になります。 |
| public _(read-only)_ | float | `$moonPhaseAngle` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月の位相角を取得する。値は 0°(新月)〜359.9° の浮動小数点数です。 |
| public _(read-only)_ | int | `$moonPhase` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月相を取得する。値は 0(新月)〜7(有明) の整数です。 |
| public _(read-only)_ | string | `$moonPhaseText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日における月相名を日本語で取得する。値は「新月」「三日月」「上弦」「十三夜」「満月」「十六夜」「下弦」「有明」のいずれかです。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSeimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSeimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextKokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeKokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextBousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeBousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextGeshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeGeshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextTaisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeTaisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextHakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeHakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextKanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeKanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSoukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSoukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextTaisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeTaisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextTouji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeTouji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextDaikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeDaikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextUsui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeUsui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextKeichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeKeichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。 |

## Methods

| Return | Method | Description |
|---|---|---|
| bool | [Carbon::isMutable](../Carbon/Carbon.md#ismutable) _(from [Carbon](../Carbon/Carbon.md))_ | Returns true if the current class/instance is mutable. |
| bool | [Carbon::isUtc](../Carbon/Carbon.md#isutc) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| bool | [Carbon::isLocal](../Carbon/Carbon.md#islocal) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance has non-UTC timezone. |
| bool | [Carbon::isValid](../Carbon/Carbon.md#isvalid) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance is a valid date. |
| bool | [Carbon::isDST](../Carbon/Carbon.md#isdst) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance is in a daylight saving time. |
| bool | [Carbon::isSunday](../Carbon/Carbon.md#issunday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is sunday. |
| bool | [Carbon::isMonday](../Carbon/Carbon.md#ismonday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is monday. |
| bool | [Carbon::isTuesday](../Carbon/Carbon.md#istuesday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is tuesday. |
| bool | [Carbon::isWednesday](../Carbon/Carbon.md#iswednesday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is wednesday. |
| bool | [Carbon::isThursday](../Carbon/Carbon.md#isthursday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is thursday. |
| bool | [Carbon::isFriday](../Carbon/Carbon.md#isfriday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is friday. |
| bool | [Carbon::isSaturday](../Carbon/Carbon.md#issaturday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is saturday. |
| bool | [Carbon::isSameYear](../Carbon/Carbon.md#issameyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentYear](../Carbon/Carbon.md#iscurrentyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment. |
| bool | [Carbon::isNextYear](../Carbon/Carbon.md#isnextyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment next year. |
| bool | [Carbon::isLastYear](../Carbon/Carbon.md#islastyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment last year. |
| bool | [Carbon::isSameWeek](../Carbon/Carbon.md#issameweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentWeek](../Carbon/Carbon.md#iscurrentweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment. |
| bool | [Carbon::isNextWeek](../Carbon/Carbon.md#isnextweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment next week. |
| bool | [Carbon::isLastWeek](../Carbon/Carbon.md#islastweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment last week. |
| bool | [Carbon::isSameDay](../Carbon/Carbon.md#issameday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentDay](../Carbon/Carbon.md#iscurrentday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment. |
| bool | [Carbon::isNextDay](../Carbon/Carbon.md#isnextday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment next day. |
| bool | [Carbon::isLastDay](../Carbon/Carbon.md#islastday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment last day. |
| bool | [Carbon::isSameHour](../Carbon/Carbon.md#issamehour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentHour](../Carbon/Carbon.md#iscurrenthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment. |
| bool | [Carbon::isNextHour](../Carbon/Carbon.md#isnexthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment next hour. |
| bool | [Carbon::isLastHour](../Carbon/Carbon.md#islasthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment last hour. |
| bool | [Carbon::isSameMinute](../Carbon/Carbon.md#issameminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMinute](../Carbon/Carbon.md#iscurrentminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment. |
| bool | [Carbon::isNextMinute](../Carbon/Carbon.md#isnextminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment next minute. |
| bool | [Carbon::isLastMinute](../Carbon/Carbon.md#islastminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment last minute. |
| bool | [Carbon::isSameSecond](../Carbon/Carbon.md#issamesecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentSecond](../Carbon/Carbon.md#iscurrentsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment. |
| bool | [Carbon::isNextSecond](../Carbon/Carbon.md#isnextsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment next second. |
| bool | [Carbon::isLastSecond](../Carbon/Carbon.md#islastsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment last second. |
| bool | [Carbon::isSameMicro](../Carbon/Carbon.md#issamemicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMicro](../Carbon/Carbon.md#iscurrentmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [Carbon::isNextMicro](../Carbon/Carbon.md#isnextmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [Carbon::isLastMicro](../Carbon/Carbon.md#islastmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [Carbon::isSameMicrosecond](../Carbon/Carbon.md#issamemicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMicrosecond](../Carbon/Carbon.md#iscurrentmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [Carbon::isNextMicrosecond](../Carbon/Carbon.md#isnextmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [Carbon::isLastMicrosecond](../Carbon/Carbon.md#islastmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [Carbon::isCurrentMonth](../Carbon/Carbon.md#iscurrentmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment. |
| bool | [Carbon::isNextMonth](../Carbon/Carbon.md#isnextmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment next month. |
| bool | [Carbon::isLastMonth](../Carbon/Carbon.md#islastmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment last month. |
| bool | [Carbon::isCurrentQuarter](../Carbon/Carbon.md#iscurrentquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment. |
| bool | [Carbon::isNextQuarter](../Carbon/Carbon.md#isnextquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment next quarter. |
| bool | [Carbon::isLastQuarter](../Carbon/Carbon.md#islastquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment last quarter. |
| bool | [Carbon::isSameDecade](../Carbon/Carbon.md#issamedecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentDecade](../Carbon/Carbon.md#iscurrentdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment. |
| bool | [Carbon::isNextDecade](../Carbon/Carbon.md#isnextdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment next decade. |
| bool | [Carbon::isLastDecade](../Carbon/Carbon.md#islastdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment last decade. |
| bool | [Carbon::isSameCentury](../Carbon/Carbon.md#issamecentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentCentury](../Carbon/Carbon.md#iscurrentcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment. |
| bool | [Carbon::isNextCentury](../Carbon/Carbon.md#isnextcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment next century. |
| bool | [Carbon::isLastCentury](../Carbon/Carbon.md#islastcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment last century. |
| bool | [Carbon::isSameMillennium](../Carbon/Carbon.md#issamemillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [Carbon::isCurrentMillennium](../Carbon/Carbon.md#iscurrentmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment. |
| bool | [Carbon::isNextMillennium](../Carbon/Carbon.md#isnextmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment next millennium. |
| bool | [Carbon::isLastMillennium](../Carbon/Carbon.md#islastmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment last millennium. |
| $this | [Carbon::years](../Carbon/Carbon.md#years) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::year](../Carbon/Carbon.md#year) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::setYears](../Carbon/Carbon.md#setyears) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::setYear](../Carbon/Carbon.md#setyear) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [Carbon::months](../Carbon/Carbon.md#months) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::month](../Carbon/Carbon.md#month) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::setMonths](../Carbon/Carbon.md#setmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::setMonth](../Carbon/Carbon.md#setmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [Carbon::days](../Carbon/Carbon.md#days) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::day](../Carbon/Carbon.md#day) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::setDays](../Carbon/Carbon.md#setdays) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::setDay](../Carbon/Carbon.md#setday) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [Carbon::hours](../Carbon/Carbon.md#hours) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::hour](../Carbon/Carbon.md#hour) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::setHours](../Carbon/Carbon.md#sethours) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::setHour](../Carbon/Carbon.md#sethour) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [Carbon::minutes](../Carbon/Carbon.md#minutes) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::minute](../Carbon/Carbon.md#minute) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::setMinutes](../Carbon/Carbon.md#setminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::setMinute](../Carbon/Carbon.md#setminute) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [Carbon::seconds](../Carbon/Carbon.md#seconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::second](../Carbon/Carbon.md#second) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::setSeconds](../Carbon/Carbon.md#setseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::setSecond](../Carbon/Carbon.md#setsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [Carbon::millis](../Carbon/Carbon.md#millis) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::milli](../Carbon/Carbon.md#milli) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMillis](../Carbon/Carbon.md#setmillis) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMilli](../Carbon/Carbon.md#setmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::milliseconds](../Carbon/Carbon.md#milliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::millisecond](../Carbon/Carbon.md#millisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMilliseconds](../Carbon/Carbon.md#setmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::setMillisecond](../Carbon/Carbon.md#setmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [Carbon::micros](../Carbon/Carbon.md#micros) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::micro](../Carbon/Carbon.md#micro) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::setMicros](../Carbon/Carbon.md#setmicros) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::setMicro](../Carbon/Carbon.md#setmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::microseconds](../Carbon/Carbon.md#microseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::microsecond](../Carbon/Carbon.md#microsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::setMicroseconds](../Carbon/Carbon.md#setmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::setMicrosecond](../Carbon/Carbon.md#setmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [Carbon::addYears](../Carbon/Carbon.md#addyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addYear](../Carbon/Carbon.md#addyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subYears](../Carbon/Carbon.md#subyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subYear](../Carbon/Carbon.md#subyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addYearsWithOverflow](../Carbon/Carbon.md#addyearswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addYearWithOverflow](../Carbon/Carbon.md#addyearwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subYearsWithOverflow](../Carbon/Carbon.md#subyearswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subYearWithOverflow](../Carbon/Carbon.md#subyearwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addYearsWithoutOverflow](../Carbon/Carbon.md#addyearswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearWithoutOverflow](../Carbon/Carbon.md#addyearwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearsWithoutOverflow](../Carbon/Carbon.md#subyearswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearWithoutOverflow](../Carbon/Carbon.md#subyearwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearsWithNoOverflow](../Carbon/Carbon.md#addyearswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearWithNoOverflow](../Carbon/Carbon.md#addyearwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearsWithNoOverflow](../Carbon/Carbon.md#subyearswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearWithNoOverflow](../Carbon/Carbon.md#subyearwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearsNoOverflow](../Carbon/Carbon.md#addyearsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addYearNoOverflow](../Carbon/Carbon.md#addyearnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearsNoOverflow](../Carbon/Carbon.md#subyearsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subYearNoOverflow](../Carbon/Carbon.md#subyearnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonths](../Carbon/Carbon.md#addmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMonth](../Carbon/Carbon.md#addmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMonths](../Carbon/Carbon.md#submonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMonth](../Carbon/Carbon.md#submonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMonthsWithOverflow](../Carbon/Carbon.md#addmonthswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMonthWithOverflow](../Carbon/Carbon.md#addmonthwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMonthsWithOverflow](../Carbon/Carbon.md#submonthswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMonthWithOverflow](../Carbon/Carbon.md#submonthwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMonthsWithoutOverflow](../Carbon/Carbon.md#addmonthswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthWithoutOverflow](../Carbon/Carbon.md#addmonthwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthsWithoutOverflow](../Carbon/Carbon.md#submonthswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthWithoutOverflow](../Carbon/Carbon.md#submonthwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthsWithNoOverflow](../Carbon/Carbon.md#addmonthswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthWithNoOverflow](../Carbon/Carbon.md#addmonthwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthsWithNoOverflow](../Carbon/Carbon.md#submonthswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthWithNoOverflow](../Carbon/Carbon.md#submonthwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthsNoOverflow](../Carbon/Carbon.md#addmonthsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMonthNoOverflow](../Carbon/Carbon.md#addmonthnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthsNoOverflow](../Carbon/Carbon.md#submonthsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMonthNoOverflow](../Carbon/Carbon.md#submonthnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDays](../Carbon/Carbon.md#adddays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addDay](../Carbon/Carbon.md#addday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDays](../Carbon/Carbon.md#subdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDay](../Carbon/Carbon.md#subday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addHours](../Carbon/Carbon.md#addhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addHour](../Carbon/Carbon.md#addhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subHours](../Carbon/Carbon.md#subhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subHour](../Carbon/Carbon.md#subhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMinutes](../Carbon/Carbon.md#addminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMinute](../Carbon/Carbon.md#addminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMinutes](../Carbon/Carbon.md#subminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMinute](../Carbon/Carbon.md#subminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addSeconds](../Carbon/Carbon.md#addseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addSecond](../Carbon/Carbon.md#addsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subSeconds](../Carbon/Carbon.md#subseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subSecond](../Carbon/Carbon.md#subsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillis](../Carbon/Carbon.md#addmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMilli](../Carbon/Carbon.md#addmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillis](../Carbon/Carbon.md#submillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMilli](../Carbon/Carbon.md#submilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMilliseconds](../Carbon/Carbon.md#addmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillisecond](../Carbon/Carbon.md#addmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMilliseconds](../Carbon/Carbon.md#submilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillisecond](../Carbon/Carbon.md#submillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicros](../Carbon/Carbon.md#addmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicro](../Carbon/Carbon.md#addmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicros](../Carbon/Carbon.md#submicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicro](../Carbon/Carbon.md#submicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicroseconds](../Carbon/Carbon.md#addmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMicrosecond](../Carbon/Carbon.md#addmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicroseconds](../Carbon/Carbon.md#submicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMicrosecond](../Carbon/Carbon.md#submicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillennia](../Carbon/Carbon.md#addmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillennium](../Carbon/Carbon.md#addmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillennia](../Carbon/Carbon.md#submillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subMillennium](../Carbon/Carbon.md#submillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addMillenniaWithOverflow](../Carbon/Carbon.md#addmillenniawithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMillenniumWithOverflow](../Carbon/Carbon.md#addmillenniumwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMillenniaWithOverflow](../Carbon/Carbon.md#submillenniawithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subMillenniumWithOverflow](../Carbon/Carbon.md#submillenniumwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addMillenniaWithoutOverflow](../Carbon/Carbon.md#addmillenniawithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniumWithoutOverflow](../Carbon/Carbon.md#addmillenniumwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniaWithoutOverflow](../Carbon/Carbon.md#submillenniawithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniumWithoutOverflow](../Carbon/Carbon.md#submillenniumwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniaWithNoOverflow](../Carbon/Carbon.md#addmillenniawithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniumWithNoOverflow](../Carbon/Carbon.md#addmillenniumwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniaWithNoOverflow](../Carbon/Carbon.md#submillenniawithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniumWithNoOverflow](../Carbon/Carbon.md#submillenniumwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniaNoOverflow](../Carbon/Carbon.md#addmillennianooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addMillenniumNoOverflow](../Carbon/Carbon.md#addmillenniumnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniaNoOverflow](../Carbon/Carbon.md#submillennianooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subMillenniumNoOverflow](../Carbon/Carbon.md#submillenniumnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturies](../Carbon/Carbon.md#addcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addCentury](../Carbon/Carbon.md#addcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subCenturies](../Carbon/Carbon.md#subcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subCentury](../Carbon/Carbon.md#subcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addCenturiesWithOverflow](../Carbon/Carbon.md#addcenturieswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addCenturyWithOverflow](../Carbon/Carbon.md#addcenturywithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subCenturiesWithOverflow](../Carbon/Carbon.md#subcenturieswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subCenturyWithOverflow](../Carbon/Carbon.md#subcenturywithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addCenturiesWithoutOverflow](../Carbon/Carbon.md#addcenturieswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturyWithoutOverflow](../Carbon/Carbon.md#addcenturywithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturiesWithoutOverflow](../Carbon/Carbon.md#subcenturieswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturyWithoutOverflow](../Carbon/Carbon.md#subcenturywithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturiesWithNoOverflow](../Carbon/Carbon.md#addcenturieswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturyWithNoOverflow](../Carbon/Carbon.md#addcenturywithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturiesWithNoOverflow](../Carbon/Carbon.md#subcenturieswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturyWithNoOverflow](../Carbon/Carbon.md#subcenturywithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturiesNoOverflow](../Carbon/Carbon.md#addcenturiesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addCenturyNoOverflow](../Carbon/Carbon.md#addcenturynooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturiesNoOverflow](../Carbon/Carbon.md#subcenturiesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subCenturyNoOverflow](../Carbon/Carbon.md#subcenturynooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecades](../Carbon/Carbon.md#adddecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addDecade](../Carbon/Carbon.md#adddecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDecades](../Carbon/Carbon.md#subdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subDecade](../Carbon/Carbon.md#subdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addDecadesWithOverflow](../Carbon/Carbon.md#adddecadeswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addDecadeWithOverflow](../Carbon/Carbon.md#adddecadewithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subDecadesWithOverflow](../Carbon/Carbon.md#subdecadeswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subDecadeWithOverflow](../Carbon/Carbon.md#subdecadewithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addDecadesWithoutOverflow](../Carbon/Carbon.md#adddecadeswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadeWithoutOverflow](../Carbon/Carbon.md#adddecadewithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadesWithoutOverflow](../Carbon/Carbon.md#subdecadeswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadeWithoutOverflow](../Carbon/Carbon.md#subdecadewithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadesWithNoOverflow](../Carbon/Carbon.md#adddecadeswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadeWithNoOverflow](../Carbon/Carbon.md#adddecadewithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadesWithNoOverflow](../Carbon/Carbon.md#subdecadeswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadeWithNoOverflow](../Carbon/Carbon.md#subdecadewithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadesNoOverflow](../Carbon/Carbon.md#adddecadesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addDecadeNoOverflow](../Carbon/Carbon.md#adddecadenooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadesNoOverflow](../Carbon/Carbon.md#subdecadesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subDecadeNoOverflow](../Carbon/Carbon.md#subdecadenooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarters](../Carbon/Carbon.md#addquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addQuarter](../Carbon/Carbon.md#addquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subQuarters](../Carbon/Carbon.md#subquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subQuarter](../Carbon/Carbon.md#subquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addQuartersWithOverflow](../Carbon/Carbon.md#addquarterswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addQuarterWithOverflow](../Carbon/Carbon.md#addquarterwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subQuartersWithOverflow](../Carbon/Carbon.md#subquarterswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::subQuarterWithOverflow](../Carbon/Carbon.md#subquarterwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [Carbon::addQuartersWithoutOverflow](../Carbon/Carbon.md#addquarterswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarterWithoutOverflow](../Carbon/Carbon.md#addquarterwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuartersWithoutOverflow](../Carbon/Carbon.md#subquarterswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuarterWithoutOverflow](../Carbon/Carbon.md#subquarterwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuartersWithNoOverflow](../Carbon/Carbon.md#addquarterswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarterWithNoOverflow](../Carbon/Carbon.md#addquarterwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuartersWithNoOverflow](../Carbon/Carbon.md#subquarterswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuarterWithNoOverflow](../Carbon/Carbon.md#subquarterwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuartersNoOverflow](../Carbon/Carbon.md#addquartersnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addQuarterNoOverflow](../Carbon/Carbon.md#addquarternooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuartersNoOverflow](../Carbon/Carbon.md#subquartersnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::subQuarterNoOverflow](../Carbon/Carbon.md#subquarternooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [Carbon::addWeeks](../Carbon/Carbon.md#addweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addWeek](../Carbon/Carbon.md#addweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeeks](../Carbon/Carbon.md#subweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeek](../Carbon/Carbon.md#subweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addWeekdays](../Carbon/Carbon.md#addweekdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addWeekday](../Carbon/Carbon.md#addweekday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeekdays](../Carbon/Carbon.md#subweekdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subWeekday](../Carbon/Carbon.md#subweekday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMicros](../Carbon/Carbon.md#addrealmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMicro](../Carbon/Carbon.md#addrealmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMicros](../Carbon/Carbon.md#subrealmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMicro](../Carbon/Carbon.md#subrealmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::microsUntil](../Carbon/Carbon.md#microsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each microsecond or every X microseconds if a factor is given. |
| $this | [Carbon::addRealMicroseconds](../Carbon/Carbon.md#addrealmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMicrosecond](../Carbon/Carbon.md#addrealmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMicroseconds](../Carbon/Carbon.md#subrealmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMicrosecond](../Carbon/Carbon.md#subrealmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::microsecondsUntil](../Carbon/Carbon.md#microsecondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each microsecond or every X microseconds if a factor is given. |
| $this | [Carbon::addRealMillis](../Carbon/Carbon.md#addrealmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMilli](../Carbon/Carbon.md#addrealmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMillis](../Carbon/Carbon.md#subrealmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMilli](../Carbon/Carbon.md#subrealmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::millisUntil](../Carbon/Carbon.md#millisuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| $this | [Carbon::addRealMilliseconds](../Carbon/Carbon.md#addrealmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMillisecond](../Carbon/Carbon.md#addrealmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMilliseconds](../Carbon/Carbon.md#subrealmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMillisecond](../Carbon/Carbon.md#subrealmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::millisecondsUntil](../Carbon/Carbon.md#millisecondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| $this | [Carbon::addRealSeconds](../Carbon/Carbon.md#addrealseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealSecond](../Carbon/Carbon.md#addrealsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealSeconds](../Carbon/Carbon.md#subrealseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealSecond](../Carbon/Carbon.md#subrealsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::secondsUntil](../Carbon/Carbon.md#secondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each second or every X seconds if a factor is given. |
| $this | [Carbon::addRealMinutes](../Carbon/Carbon.md#addrealminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMinute](../Carbon/Carbon.md#addrealminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMinutes](../Carbon/Carbon.md#subrealminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMinute](../Carbon/Carbon.md#subrealminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::minutesUntil](../Carbon/Carbon.md#minutesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each minute or every X minutes if a factor is given. |
| $this | [Carbon::addRealHours](../Carbon/Carbon.md#addrealhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealHour](../Carbon/Carbon.md#addrealhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealHours](../Carbon/Carbon.md#subrealhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealHour](../Carbon/Carbon.md#subrealhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::hoursUntil](../Carbon/Carbon.md#hoursuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each hour or every X hours if a factor is given. |
| $this | [Carbon::addRealDays](../Carbon/Carbon.md#addrealdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealDay](../Carbon/Carbon.md#addrealday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealDays](../Carbon/Carbon.md#subrealdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealDay](../Carbon/Carbon.md#subrealday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::daysUntil](../Carbon/Carbon.md#daysuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each day or every X days if a factor is given. |
| $this | [Carbon::addRealWeeks](../Carbon/Carbon.md#addrealweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealWeek](../Carbon/Carbon.md#addrealweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealWeeks](../Carbon/Carbon.md#subrealweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealWeek](../Carbon/Carbon.md#subrealweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::weeksUntil](../Carbon/Carbon.md#weeksuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each week or every X weeks if a factor is given. |
| $this | [Carbon::addRealMonths](../Carbon/Carbon.md#addrealmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMonth](../Carbon/Carbon.md#addrealmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMonths](../Carbon/Carbon.md#subrealmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMonth](../Carbon/Carbon.md#subrealmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::monthsUntil](../Carbon/Carbon.md#monthsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each month or every X months if a factor is given. |
| $this | [Carbon::addRealQuarters](../Carbon/Carbon.md#addrealquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealQuarter](../Carbon/Carbon.md#addrealquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealQuarters](../Carbon/Carbon.md#subrealquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealQuarter](../Carbon/Carbon.md#subrealquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::quartersUntil](../Carbon/Carbon.md#quartersuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each quarter or every X quarters if a factor is given. |
| $this | [Carbon::addRealYears](../Carbon/Carbon.md#addrealyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealYear](../Carbon/Carbon.md#addrealyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealYears](../Carbon/Carbon.md#subrealyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealYear](../Carbon/Carbon.md#subrealyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::yearsUntil](../Carbon/Carbon.md#yearsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each year or every X years if a factor is given. |
| $this | [Carbon::addRealDecades](../Carbon/Carbon.md#addrealdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealDecade](../Carbon/Carbon.md#addrealdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealDecades](../Carbon/Carbon.md#subrealdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealDecade](../Carbon/Carbon.md#subrealdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::decadesUntil](../Carbon/Carbon.md#decadesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each decade or every X decades if a factor is given. |
| $this | [Carbon::addRealCenturies](../Carbon/Carbon.md#addrealcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealCentury](../Carbon/Carbon.md#addrealcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealCenturies](../Carbon/Carbon.md#subrealcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealCentury](../Carbon/Carbon.md#subrealcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::centuriesUntil](../Carbon/Carbon.md#centuriesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each century or every X centuries if a factor is given. |
| $this | [Carbon::addRealMillennia](../Carbon/Carbon.md#addrealmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::addRealMillennium](../Carbon/Carbon.md#addrealmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMillennia](../Carbon/Carbon.md#subrealmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [Carbon::subRealMillennium](../Carbon/Carbon.md#subrealmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [Carbon::millenniaUntil](../Carbon/Carbon.md#millenniauntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millennium or every X millennia if a factor is given. |
| $this | [Carbon::roundYear](../Carbon/Carbon.md#roundyear) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance year with given precision using the given function. |
| $this | [Carbon::roundYears](../Carbon/Carbon.md#roundyears) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance year with given precision using the given function. |
| $this | [Carbon::floorYear](../Carbon/Carbon.md#flooryear) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance year with given precision. |
| $this | [Carbon::floorYears](../Carbon/Carbon.md#flooryears) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance year with given precision. |
| $this | [Carbon::ceilYear](../Carbon/Carbon.md#ceilyear) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance year with given precision. |
| $this | [Carbon::ceilYears](../Carbon/Carbon.md#ceilyears) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance year with given precision. |
| $this | [Carbon::roundMonth](../Carbon/Carbon.md#roundmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance month with given precision using the given function. |
| $this | [Carbon::roundMonths](../Carbon/Carbon.md#roundmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance month with given precision using the given function. |
| $this | [Carbon::floorMonth](../Carbon/Carbon.md#floormonth) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance month with given precision. |
| $this | [Carbon::floorMonths](../Carbon/Carbon.md#floormonths) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance month with given precision. |
| $this | [Carbon::ceilMonth](../Carbon/Carbon.md#ceilmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance month with given precision. |
| $this | [Carbon::ceilMonths](../Carbon/Carbon.md#ceilmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance month with given precision. |
| $this | [Carbon::roundDay](../Carbon/Carbon.md#roundday) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance day with given precision using the given function. |
| $this | [Carbon::roundDays](../Carbon/Carbon.md#rounddays) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance day with given precision using the given function. |
| $this | [Carbon::floorDay](../Carbon/Carbon.md#floorday) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance day with given precision. |
| $this | [Carbon::floorDays](../Carbon/Carbon.md#floordays) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance day with given precision. |
| $this | [Carbon::ceilDay](../Carbon/Carbon.md#ceilday) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance day with given precision. |
| $this | [Carbon::ceilDays](../Carbon/Carbon.md#ceildays) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance day with given precision. |
| $this | [Carbon::roundHour](../Carbon/Carbon.md#roundhour) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [Carbon::roundHours](../Carbon/Carbon.md#roundhours) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [Carbon::floorHour](../Carbon/Carbon.md#floorhour) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance hour with given precision. |
| $this | [Carbon::floorHours](../Carbon/Carbon.md#floorhours) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance hour with given precision. |
| $this | [Carbon::ceilHour](../Carbon/Carbon.md#ceilhour) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance hour with given precision. |
| $this | [Carbon::ceilHours](../Carbon/Carbon.md#ceilhours) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance hour with given precision. |
| $this | [Carbon::roundMinute](../Carbon/Carbon.md#roundminute) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [Carbon::roundMinutes](../Carbon/Carbon.md#roundminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [Carbon::floorMinute](../Carbon/Carbon.md#floorminute) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance minute with given precision. |
| $this | [Carbon::floorMinutes](../Carbon/Carbon.md#floorminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance minute with given precision. |
| $this | [Carbon::ceilMinute](../Carbon/Carbon.md#ceilminute) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance minute with given precision. |
| $this | [Carbon::ceilMinutes](../Carbon/Carbon.md#ceilminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance minute with given precision. |
| $this | [Carbon::roundSecond](../Carbon/Carbon.md#roundsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance second with given precision using the given function. |
| $this | [Carbon::roundSeconds](../Carbon/Carbon.md#roundseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance second with given precision using the given function. |
| $this | [Carbon::floorSecond](../Carbon/Carbon.md#floorsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance second with given precision. |
| $this | [Carbon::floorSeconds](../Carbon/Carbon.md#floorseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance second with given precision. |
| $this | [Carbon::ceilSecond](../Carbon/Carbon.md#ceilsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance second with given precision. |
| $this | [Carbon::ceilSeconds](../Carbon/Carbon.md#ceilseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance second with given precision. |
| $this | [Carbon::roundMillennium](../Carbon/Carbon.md#roundmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [Carbon::roundMillennia](../Carbon/Carbon.md#roundmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [Carbon::floorMillennium](../Carbon/Carbon.md#floormillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millennium with given precision. |
| $this | [Carbon::floorMillennia](../Carbon/Carbon.md#floormillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millennium with given precision. |
| $this | [Carbon::ceilMillennium](../Carbon/Carbon.md#ceilmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millennium with given precision. |
| $this | [Carbon::ceilMillennia](../Carbon/Carbon.md#ceilmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millennium with given precision. |
| $this | [Carbon::roundCentury](../Carbon/Carbon.md#roundcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance century with given precision using the given function. |
| $this | [Carbon::roundCenturies](../Carbon/Carbon.md#roundcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance century with given precision using the given function. |
| $this | [Carbon::floorCentury](../Carbon/Carbon.md#floorcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance century with given precision. |
| $this | [Carbon::floorCenturies](../Carbon/Carbon.md#floorcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance century with given precision. |
| $this | [Carbon::ceilCentury](../Carbon/Carbon.md#ceilcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance century with given precision. |
| $this | [Carbon::ceilCenturies](../Carbon/Carbon.md#ceilcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance century with given precision. |
| $this | [Carbon::roundDecade](../Carbon/Carbon.md#rounddecade) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [Carbon::roundDecades](../Carbon/Carbon.md#rounddecades) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [Carbon::floorDecade](../Carbon/Carbon.md#floordecade) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance decade with given precision. |
| $this | [Carbon::floorDecades](../Carbon/Carbon.md#floordecades) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance decade with given precision. |
| $this | [Carbon::ceilDecade](../Carbon/Carbon.md#ceildecade) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance decade with given precision. |
| $this | [Carbon::ceilDecades](../Carbon/Carbon.md#ceildecades) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance decade with given precision. |
| $this | [Carbon::roundQuarter](../Carbon/Carbon.md#roundquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [Carbon::roundQuarters](../Carbon/Carbon.md#roundquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [Carbon::floorQuarter](../Carbon/Carbon.md#floorquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance quarter with given precision. |
| $this | [Carbon::floorQuarters](../Carbon/Carbon.md#floorquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance quarter with given precision. |
| $this | [Carbon::ceilQuarter](../Carbon/Carbon.md#ceilquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance quarter with given precision. |
| $this | [Carbon::ceilQuarters](../Carbon/Carbon.md#ceilquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance quarter with given precision. |
| $this | [Carbon::roundMillisecond](../Carbon/Carbon.md#roundmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [Carbon::roundMilliseconds](../Carbon/Carbon.md#roundmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [Carbon::floorMillisecond](../Carbon/Carbon.md#floormillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [Carbon::floorMilliseconds](../Carbon/Carbon.md#floormilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [Carbon::ceilMillisecond](../Carbon/Carbon.md#ceilmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [Carbon::ceilMilliseconds](../Carbon/Carbon.md#ceilmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [Carbon::roundMicrosecond](../Carbon/Carbon.md#roundmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [Carbon::roundMicroseconds](../Carbon/Carbon.md#roundmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [Carbon::floorMicrosecond](../Carbon/Carbon.md#floormicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [Carbon::floorMicroseconds](../Carbon/Carbon.md#floormicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [Carbon::ceilMicrosecond](../Carbon/Carbon.md#ceilmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance microsecond with given precision. |
| $this | [Carbon::ceilMicroseconds](../Carbon/Carbon.md#ceilmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance microsecond with given precision. |
| string | [Carbon::shortAbsoluteDiffForHumans](../Carbon/Carbon.md#shortabsolutediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longAbsoluteDiffForHumans](../Carbon/Carbon.md#longabsolutediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::shortRelativeDiffForHumans](../Carbon/Carbon.md#shortrelativediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longRelativeDiffForHumans](../Carbon/Carbon.md#longrelativediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::shortRelativeToNowDiffForHumans](../Carbon/Carbon.md#shortrelativetonowdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longRelativeToNowDiffForHumans](../Carbon/Carbon.md#longrelativetonowdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::shortRelativeToOtherDiffForHumans](../Carbon/Carbon.md#shortrelativetootherdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [Carbon::longRelativeToOtherDiffForHumans](../Carbon/Carbon.md#longrelativetootherdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| static|false | [Carbon::createFromFormat](../Carbon/Carbon.md#createfromformat) _(from [Carbon](../Carbon/Carbon.md))_ | Parse a string into a new Carbon object according to the specified format. |
| static | [Carbon::__set_state](../Carbon/Carbon.md#__set_state) _(from [Carbon](../Carbon/Carbon.md))_ | https://php.net/manual/en/datetime.set-state.php

</autodoc> |
| Factory | [Factory::factory](../JapaneseDate/Traits/Factory.md#factory) _(from [Factory](../JapaneseDate/Traits/Factory.md))_ | 多様な型の引数から {\JapaneseDate\DateTime} / {\JapaneseDate\DateTimeImmutable}
インスタンスを生成するユニバーサルファクトリメソッドです。 |
| void | [CacheSetting::setCacheMode](../JapaneseDate/Traits/CacheSetting.md#setcachemode) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | 旧暦・祝日計算に使用するキャッシュモードを設定します。 |
| void | [CacheSetting::setCacheFilePath](../JapaneseDate/Traits/CacheSetting.md#setcachefilepath) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | ファイルキャッシュの保存先ディレクトリを設定します。 |
| void | [CacheSetting::setCacheClosure](../JapaneseDate/Traits/CacheSetting.md#setcacheclosure) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | 独自キャッシュロジックを実装したクロージャを登録します。 |
| Modifier | [Modifier::nextHoliday](../JapaneseDate/Traits/Modifier.md#nextholiday) _(from [Modifier](../JapaneseDate/Traits/Modifier.md))_ | 次の祝日にする |
| Modifier | [Modifier::nextSixWeek](../JapaneseDate/Traits/Modifier.md#nextsixweek) _(from [Modifier](../JapaneseDate/Traits/Modifier.md))_ | 指定された次の六曜にする |
| array | [Getter::getCalendar](../JapaneseDate/Traits/Getter.md#getcalendar) _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | サポートされるカレンダーに変換する |
| DateBusinessCommon | [DateBusinessCommon::setBusinessConfig](../JapaneseDate/Traits/DateBusinessCommon.md#setbusinessconfig) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | インスタンスに個別の営業日設定を適用します。 |
| DateBusiness\|null | [DateBusinessCommon::getBusinessConfig](../JapaneseDate/Traits/DateBusinessCommon.md#getbusinessconfig) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | インスタンスが保持している個別の営業日設定を取得します。 |
| DateBusinessCommon | [DateBusinessCommon::setClosingDay](../JapaneseDate/Traits/DateBusinessCommon.md#setclosingday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 特定の日付を休業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::setOpenDay](../JapaneseDate/Traits/DateBusinessCommon.md#setopenday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 特定の日付を営業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::setClosingWeekdays](../JapaneseDate/Traits/DateBusinessCommon.md#setclosingweekdays) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 休業曜日を一括設定します。 |
| DateBusinessCommon | [DateBusinessCommon::setBypassHoliday](../JapaneseDate/Traits/DateBusinessCommon.md#setbypassholiday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 祝日を休業日として扱うかどうかを設定します。 |
| DateBusinessCommon | [DateBusinessCommon::setOpenNthWeekday](../JapaneseDate/Traits/DateBusinessCommon.md#setopennthweekday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 第XX曜日を営業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::setClosingNthWeekday](../JapaneseDate/Traits/DateBusinessCommon.md#setclosingnthweekday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 第XX曜日を休業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::addOpenFilter](../JapaneseDate/Traits/DateBusinessCommon.md#addopenfilter) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 営業指定フィルタを追加します。 |
| DateBusinessCommon | [DateBusinessCommon::addClosingFilter](../JapaneseDate/Traits/DateBusinessCommon.md#addclosingfilter) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 休業指定フィルタを追加します。 |
| DateBusinessCommon | [DateBusinessCommon::setBusinessMacro](../JapaneseDate/Traits/DateBusinessCommon.md#setbusinessmacro) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 判定ロジックを完全に上書きするマクロを設定します。 |
| bool | [DateBusinessCommon::checkIsBusinessDay](../JapaneseDate/Traits/DateBusinessCommon.md#checkisbusinessday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 指定した日付（または自身が保持する日付）が営業日かどうかを判定します。 |
| string\|null | [DateBusinessCommon::checkGetBusinessDayLabel](../JapaneseDate/Traits/DateBusinessCommon.md#checkgetbusinessdaylabel) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 指定した日付（または自身が保持する日付）の休業ラベルを取得します。 |
| bool | [Business::isBusinessDay](../JapaneseDate/Traits/Business.md#isbusinessday) _(from [Business](../JapaneseDate/Traits/Business.md))_ | このインスタンスの日付が営業日かどうかを判定します。 |
| string\|null | [Business::getBusinessDayLabel](../JapaneseDate/Traits/Business.md#getbusinessdaylabel) _(from [Business](../JapaneseDate/Traits/Business.md))_ | このインスタンスの日付が休業日の場合、そのラベルを返します。 |
| Business | [Business::nextBusinessDay](../JapaneseDate/Traits/Business.md#nextbusinessday) _(from [Business](../JapaneseDate/Traits/Business.md))_ | 次の営業日を取得します。 |
| Business | [Business::previousBusinessDay](../JapaneseDate/Traits/Business.md#previousbusinessday) _(from [Business](../JapaneseDate/Traits/Business.md))_ | 前の営業日を取得します。 |
| Business | [Business::shiftToClosestBusinessDayAfter](../JapaneseDate/Traits/Business.md#shifttoclosestbusinessdayafter) _(from [Business](../JapaneseDate/Traits/Business.md))_ | この日が休業日の場合、翌営業日にシフトしたインスタンスを返します。 |
| Business | [Business::shiftToClosestBusinessDayBefore](../JapaneseDate/Traits/Business.md#shifttoclosestbusinessdaybefore) _(from [Business](../JapaneseDate/Traits/Business.md))_ | この日が休業日の場合、前営業日にシフトしたインスタンスを返します。 |
| Business | [Business::addBusinessDays](../JapaneseDate/Traits/Business.md#addbusinessdays) _(from [Business](../JapaneseDate/Traits/Business.md))_ | 指定した営業日数後の日付を返します。 |
| Business | [Business::subBusinessDays](../JapaneseDate/Traits/Business.md#subbusinessdays) _(from [Business](../JapaneseDate/Traits/Business.md))_ | 指定した営業日数前の日付を返します。 |

---

## Method Details

