# DateTime

**Namespace:** `JapaneseDate`

class **DateTime** extends [Carbon](../Carbon/Carbon.md) implements [DateTimeInterface](../JapaneseDate/DateTimeInterface.md)

日本の暦（祝日・元号・六曜・二十四節気）に完全対応したDateTime拡張クラス。

日時操作ライブラリである [\Carbon\Carbon](../Carbon/Carbon.html) をベースに、
* 日本のビジネスシーンや伝統的な暦の計算に必要となる判定・取得機能をシームレスに統合しています。

【主な機能一覧】
1. 国民の祝日判定:
- 昭和23年（1948年）の祝日法施行以降から最新の祝日（スポーツの日等）に対応。
- 振替休日、国民の休日、特定の年にのみ発生する特殊な祝日・慶弔行事（皇室の儀式等）の自動計算。
2. 元号（和暦）変換:
- 明治・大正・昭和・平成・令和の各元号への双方向変換および元号年の算出。
3. 六曜の算出:
- 旧暦（太陰太陽暦）ベースの計算による、大安・仏滅・友引などの六曜判定。
4. 二十四節気:
- 天文学的計算（太陽黄経）に基づく、立春・夏至・秋分・冬至など二十四節気の判定。

本クラスは [\Carbon\Carbon](../Carbon/Carbon.html) のすべてのメソッド・プロパティを継承しているため、
既存のインスタンスと同様のメソッドチェーンがそのまま利用可能です。

【主な機能一覧】
1. 国民の祝日判定:
- 昭和23年（1948年）の祝日法施行以降から最新の祝日（スポーツの日等）に対応。
- 振替休日、国民の休日、特定の年にのみ発生する特殊な祝日・慶弔行事（皇室の儀式等）の自動計算。
2. 元号（和暦）変換:
- 明治・大正・昭和・平成・令和の各元号への双方向変換および元号年の算出。
3. 六曜の算出:
- 旧暦（太陰太陽暦）ベースの計算による、大安・仏滅・友引などの六曜判定。
4. 二十四節気:
- 天文学的計算（太陽黄経）に基づく、立春・夏至・秋分・冬至など二十四節気の判定。

本クラスは Carbon のすべてのメソッド・プロパティを継承しているため、既存の Carbon インスタンスと
同様のメソッドチェーン（例: `$date->addDays(5)->isHoliday()` など）がそのまま利用可能です。

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
- Date

## Constants

| Modifier | Name | Description |
|---|---|---|
| public | `NO_HOLIDAY` | 祝日定数:非祝日 |
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
| public | `ERA_MEIJI` | 元号定数:元号 (明治) |
| public | `ERA_TAISHO` | 元号定数:元号 (対象) |
| public | `ERA_SHOWA` | 元号定数:元号 (昭和) |
| public | `ERA_HEISEI` | 元号定数:元号 (平成) |
| public _(deprecated)_ | `ERA_HEISEI_NEXT` | 元号定数:元号 (平成の次) |
| public | `ERA_REIWA` | 元号定数:元号 (令和) |
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

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public | string | `$localeDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the day of week in current locale |
| public | string | `$shortLocaleDayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated day of week in current locale |
| public | string | `$localeMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the month in current locale |
| public | string | `$shortLocaleMonth` _(from [Carbon](../Carbon/Carbon.md))_ | the abbreviated month in current locale |
| public | int | `$year` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$yearIso` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$month` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$day` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$hour` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$minute` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$second` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$micro` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$microsecond` _(from [Carbon](../Carbon/Carbon.md))_ |  |
| public | int | `$dayOfWeekIso` _(from [Carbon](../Carbon/Carbon.md))_ | 1 (for Monday) through 7 (for Sunday) |
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
| public | int | `$age` _(from [Carbon](../Carbon/Carbon.md))_ | does a diffInYears() with default parameters |
| public | int | `$offset` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in seconds from UTC |
| public | int | `$offsetMinutes` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in minutes from UTC |
| public | int | `$offsetHours` _(from [Carbon](../Carbon/Carbon.md))_ | the timezone offset in hours from UTC |
| public | CarbonTimeZone | `$timezone` _(from [Carbon](../Carbon/Carbon.md))_ | the current timezone |
| public | CarbonTimeZone | `$tz` _(from [Carbon](../Carbon/Carbon.md))_ | alias of $timezone |
| public | int | `$centuryOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the century starting from the beginning of the current millennium |
| public | int | `$dayOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current century |
| public | int | `$dayOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current decade |
| public | int | `$dayOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current millennium |
| public | int | `$dayOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current month |
| public | int | `$dayOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the day starting from the beginning of the current quarter |
| public | int | `$dayOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | 0 (for Sunday) through 6 (for Saturday) |
| public | int | `$dayOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 366 |
| public | int | `$decadeOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the decade starting from the beginning of the current century |
| public | int | `$decadeOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the decade starting from the beginning of the current millennium |
| public | int | `$hourOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current century |
| public | int | `$hourOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current day |
| public | int | `$hourOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current decade |
| public | int | `$hourOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current millennium |
| public | int | `$hourOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current month |
| public | int | `$hourOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current quarter |
| public | int | `$hourOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current week |
| public | int | `$hourOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the hour starting from the beginning of the current year |
| public | int | `$microsecondOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current century |
| public | int | `$microsecondOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current day |
| public | int | `$microsecondOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current decade |
| public | int | `$microsecondOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current hour |
| public | int | `$microsecondOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current millennium |
| public | int | `$microsecondOfMillisecond` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current millisecond |
| public | int | `$microsecondOfMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current minute |
| public | int | `$microsecondOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current month |
| public | int | `$microsecondOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current quarter |
| public | int | `$microsecondOfSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current second |
| public | int | `$microsecondOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current week |
| public | int | `$microsecondOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the microsecond starting from the beginning of the current year |
| public | int | `$millisecondOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current century |
| public | int | `$millisecondOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current day |
| public | int | `$millisecondOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current decade |
| public | int | `$millisecondOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current hour |
| public | int | `$millisecondOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current millennium |
| public | int | `$millisecondOfMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current minute |
| public | int | `$millisecondOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current month |
| public | int | `$millisecondOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current quarter |
| public | int | `$millisecondOfSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current second |
| public | int | `$millisecondOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current week |
| public | int | `$millisecondOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the millisecond starting from the beginning of the current year |
| public | int | `$minuteOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current century |
| public | int | `$minuteOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current day |
| public | int | `$minuteOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current decade |
| public | int | `$minuteOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current hour |
| public | int | `$minuteOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current millennium |
| public | int | `$minuteOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current month |
| public | int | `$minuteOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current quarter |
| public | int | `$minuteOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current week |
| public | int | `$minuteOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the minute starting from the beginning of the current year |
| public | int | `$monthOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current century |
| public | int | `$monthOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current decade |
| public | int | `$monthOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current millennium |
| public | int | `$monthOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current quarter |
| public | int | `$monthOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the month starting from the beginning of the current year |
| public | int | `$quarterOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current century |
| public | int | `$quarterOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current decade |
| public | int | `$quarterOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current millennium |
| public | int | `$quarterOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the quarter starting from the beginning of the current year |
| public | int | `$secondOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current century |
| public | int | `$secondOfDay` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current day |
| public | int | `$secondOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current decade |
| public | int | `$secondOfHour` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current hour |
| public | int | `$secondOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current millennium |
| public | int | `$secondOfMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current minute |
| public | int | `$secondOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current month |
| public | int | `$secondOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current quarter |
| public | int | `$secondOfWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current week |
| public | int | `$secondOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the second starting from the beginning of the current year |
| public | int | `$weekOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current century |
| public | int | `$weekOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current decade |
| public | int | `$weekOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current millennium |
| public | int | `$weekOfMonth` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 5 |
| public | int | `$weekOfQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the week starting from the beginning of the current quarter |
| public | int | `$weekOfYear` _(from [Carbon](../Carbon/Carbon.md))_ | ISO-8601 week number of year, weeks starting on Monday |
| public | int | `$yearOfCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the year starting from the beginning of the current century |
| public | int | `$yearOfDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the year starting from the beginning of the current decade |
| public | int | `$yearOfMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The value of the year starting from the beginning of the current millennium |
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
| public _(read-only)_ | int | `$isoWeeksInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$weekNumberInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | 1 through 5 |
| public _(read-only)_ | int | `$firstWeekDay` _(from [Carbon](../Carbon/Carbon.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$lastWeekDay` _(from [Carbon](../Carbon/Carbon.md))_ | 0 through 6 |
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
| public _(read-only)_ | int | `$centuriesInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of centuries contained in the current millennium |
| public _(read-only)_ | int | `$daysInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current century |
| public _(read-only)_ | int | `$daysInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current decade |
| public _(read-only)_ | int | `$daysInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current millennium |
| public _(read-only)_ | int | `$daysInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | number of days in the given month |
| public _(read-only)_ | int | `$daysInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current quarter |
| public _(read-only)_ | int | `$daysInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of days contained in the current week |
| public _(read-only)_ | int | `$daysInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 365 or 366 |
| public _(read-only)_ | int | `$decadesInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of decades contained in the current century |
| public _(read-only)_ | int | `$decadesInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of decades contained in the current millennium |
| public _(read-only)_ | int | `$hoursInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current century |
| public _(read-only)_ | int | `$hoursInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current day |
| public _(read-only)_ | int | `$hoursInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current decade |
| public _(read-only)_ | int | `$hoursInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current millennium |
| public _(read-only)_ | int | `$hoursInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current month |
| public _(read-only)_ | int | `$hoursInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current quarter |
| public _(read-only)_ | int | `$hoursInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current week |
| public _(read-only)_ | int | `$hoursInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of hours contained in the current year |
| public _(read-only)_ | int | `$microsecondsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current century |
| public _(read-only)_ | int | `$microsecondsInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current day |
| public _(read-only)_ | int | `$microsecondsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current decade |
| public _(read-only)_ | int | `$microsecondsInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current hour |
| public _(read-only)_ | int | `$microsecondsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current millennium |
| public _(read-only)_ | int | `$microsecondsInMillisecond` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current millisecond |
| public _(read-only)_ | int | `$microsecondsInMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current minute |
| public _(read-only)_ | int | `$microsecondsInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current month |
| public _(read-only)_ | int | `$microsecondsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current quarter |
| public _(read-only)_ | int | `$microsecondsInSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current second |
| public _(read-only)_ | int | `$microsecondsInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current week |
| public _(read-only)_ | int | `$microsecondsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of microseconds contained in the current year |
| public _(read-only)_ | int | `$millisecondsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current century |
| public _(read-only)_ | int | `$millisecondsInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current day |
| public _(read-only)_ | int | `$millisecondsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current decade |
| public _(read-only)_ | int | `$millisecondsInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current hour |
| public _(read-only)_ | int | `$millisecondsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current millennium |
| public _(read-only)_ | int | `$millisecondsInMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current minute |
| public _(read-only)_ | int | `$millisecondsInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current month |
| public _(read-only)_ | int | `$millisecondsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current quarter |
| public _(read-only)_ | int | `$millisecondsInSecond` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current second |
| public _(read-only)_ | int | `$millisecondsInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current week |
| public _(read-only)_ | int | `$millisecondsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of milliseconds contained in the current year |
| public _(read-only)_ | int | `$minutesInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current century |
| public _(read-only)_ | int | `$minutesInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current day |
| public _(read-only)_ | int | `$minutesInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current decade |
| public _(read-only)_ | int | `$minutesInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current hour |
| public _(read-only)_ | int | `$minutesInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current millennium |
| public _(read-only)_ | int | `$minutesInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current month |
| public _(read-only)_ | int | `$minutesInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current quarter |
| public _(read-only)_ | int | `$minutesInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current week |
| public _(read-only)_ | int | `$minutesInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of minutes contained in the current year |
| public _(read-only)_ | int | `$monthsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current century |
| public _(read-only)_ | int | `$monthsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current decade |
| public _(read-only)_ | int | `$monthsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current millennium |
| public _(read-only)_ | int | `$monthsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current quarter |
| public _(read-only)_ | int | `$monthsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of months contained in the current year |
| public _(read-only)_ | int | `$quartersInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current century |
| public _(read-only)_ | int | `$quartersInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current decade |
| public _(read-only)_ | int | `$quartersInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current millennium |
| public _(read-only)_ | int | `$quartersInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of quarters contained in the current year |
| public _(read-only)_ | int | `$secondsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current century |
| public _(read-only)_ | int | `$secondsInDay` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current day |
| public _(read-only)_ | int | `$secondsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current decade |
| public _(read-only)_ | int | `$secondsInHour` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current hour |
| public _(read-only)_ | int | `$secondsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current millennium |
| public _(read-only)_ | int | `$secondsInMinute` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current minute |
| public _(read-only)_ | int | `$secondsInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current month |
| public _(read-only)_ | int | `$secondsInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current quarter |
| public _(read-only)_ | int | `$secondsInWeek` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current week |
| public _(read-only)_ | int | `$secondsInYear` _(from [Carbon](../Carbon/Carbon.md))_ | The number of seconds contained in the current year |
| public _(read-only)_ | int | `$weeksInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current century |
| public _(read-only)_ | int | `$weeksInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current decade |
| public _(read-only)_ | int | `$weeksInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current millennium |
| public _(read-only)_ | int | `$weeksInMonth` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current month |
| public _(read-only)_ | int | `$weeksInQuarter` _(from [Carbon](../Carbon/Carbon.md))_ | The number of weeks contained in the current quarter |
| public _(read-only)_ | int | `$weeksInYear` _(from [Carbon](../Carbon/Carbon.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$yearsInCentury` _(from [Carbon](../Carbon/Carbon.md))_ | The number of years contained in the current century |
| public _(read-only)_ | int | `$yearsInDecade` _(from [Carbon](../Carbon/Carbon.md))_ | The number of years contained in the current decade |
| public _(read-only)_ | int | `$yearsInMillennium` _(from [Carbon](../Carbon/Carbon.md))_ | The number of years contained in the current millennium |
| public _(read-only)_ | int\|bool | `$solar_term` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
| public _(read-only)_ | string | `$solar_term_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$is_solar_term` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$era_name_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$era_name` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | int | `$era_year` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | string | `$oriental_zodiac_text` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$oriental_zodiac` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。 |
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
| public _(read-only)_ | int\|bool | `$solarTerm` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
| public _(read-only)_ | string | `$solarTermText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気の名前を取得する。値は、 24節気の名前を表す文字列、または 24節気でない場合は空文字列になります。 |
| public _(read-only)_ | bool | `$isSolarTerm` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が24節気の一つであるかどうかを示すブール値。値は、 24節気である場合は true、そうでない場合は false になります。 |
| public _(read-only)_ | string | `$eraNameText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の名前を取得する。値は、 元号の名前を表す文字列、または 元号でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$eraName` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号を整数で取得する。値は、 元号を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | int | `$eraYear` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する元号の年を整数で取得する。値は、 元号の年を表す整数、または 元号でない場合は 0 になります。 |
| public _(read-only)_ | string | `$orientalZodiacText` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支の名前を取得する。値は、 十二支の名前を表す文字列、または 十二支でない場合は空文字列になります。 |
| public _(read-only)_ | int | `$orientalZodiac` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その日が属する十二支を整数で取得する。値は、 十二支を表す整数、または 十二支でない場合は 0 になります。 |
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
| bool | [isMutable()](#ismutable) _(from [Carbon](../Carbon/Carbon.md))_ | Returns true if the current class/instance is mutable. |
| bool | [isUtc()](#isutc) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| bool | [isLocal()](#islocal) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance has non-UTC timezone. |
| bool | [isValid()](#isvalid) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance is a valid date. |
| bool | [isDST()](#isdst) _(from [Carbon](../Carbon/Carbon.md))_ | Check if the current instance is in a daylight saving time. |
| bool | [isSunday()](#issunday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is sunday. |
| bool | [isMonday()](#ismonday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is monday. |
| bool | [isTuesday()](#istuesday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is tuesday. |
| bool | [isWednesday()](#iswednesday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is wednesday. |
| bool | [isThursday()](#isthursday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is thursday. |
| bool | [isFriday()](#isfriday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is friday. |
| bool | [isSaturday()](#issaturday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance day is saturday. |
| bool | [isSameYear()](#issameyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentYear()](#iscurrentyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment. |
| bool | [isNextYear()](#isnextyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment next year. |
| bool | [isLastYear()](#islastyear) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same year as the current moment last year. |
| bool | [isCurrentMonth()](#iscurrentmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment. |
| bool | [isNextMonth()](#isnextmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment next month. |
| bool | [isLastMonth()](#islastmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same month as the current moment last month. |
| bool | [isSameWeek()](#issameweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentWeek()](#iscurrentweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment. |
| bool | [isNextWeek()](#isnextweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment next week. |
| bool | [isLastWeek()](#islastweek) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same week as the current moment last week. |
| bool | [isSameDay()](#issameday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentDay()](#iscurrentday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment. |
| bool | [isNextDay()](#isnextday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment next day. |
| bool | [isLastDay()](#islastday) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same day as the current moment last day. |
| bool | [isSameHour()](#issamehour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentHour()](#iscurrenthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment. |
| bool | [isNextHour()](#isnexthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment next hour. |
| bool | [isLastHour()](#islasthour) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same hour as the current moment last hour. |
| bool | [isSameMinute()](#issameminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentMinute()](#iscurrentminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment. |
| bool | [isNextMinute()](#isnextminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment next minute. |
| bool | [isLastMinute()](#islastminute) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same minute as the current moment last minute. |
| bool | [isSameSecond()](#issamesecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentSecond()](#iscurrentsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment. |
| bool | [isNextSecond()](#isnextsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment next second. |
| bool | [isLastSecond()](#islastsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same second as the current moment last second. |
| bool | [isSameMilli()](#issamemilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentMilli()](#iscurrentmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [isNextMilli()](#isnextmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [isLastMilli()](#islastmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [isSameMillisecond()](#issamemillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentMillisecond()](#iscurrentmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [isNextMillisecond()](#isnextmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [isLastMillisecond()](#islastmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [isSameMicro()](#issamemicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentMicro()](#iscurrentmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [isNextMicro()](#isnextmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [isLastMicro()](#islastmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [isSameMicrosecond()](#issamemicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentMicrosecond()](#iscurrentmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [isNextMicrosecond()](#isnextmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [isLastMicrosecond()](#islastmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [isSameDecade()](#issamedecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentDecade()](#iscurrentdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment. |
| bool | [isNextDecade()](#isnextdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment next decade. |
| bool | [isLastDecade()](#islastdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same decade as the current moment last decade. |
| bool | [isSameCentury()](#issamecentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentCentury()](#iscurrentcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment. |
| bool | [isNextCentury()](#isnextcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment next century. |
| bool | [isLastCentury()](#islastcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same century as the current moment last century. |
| bool | [isSameMillennium()](#issamemillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| bool | [isCurrentMillennium()](#iscurrentmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment. |
| bool | [isNextMillennium()](#isnextmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment next millennium. |
| bool | [isLastMillennium()](#islastmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same millennium as the current moment last millennium. |
| bool | [isCurrentQuarter()](#iscurrentquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment. |
| bool | [isNextQuarter()](#isnextquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment next quarter. |
| bool | [isLastQuarter()](#islastquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Checks if the instance is in the same quarter as the current moment last quarter. |
| $this | [years()](#years) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [year()](#year) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [setYears()](#setyears) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [setYear()](#setyear) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance year to the given value. |
| $this | [months()](#months) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [month()](#month) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [setMonths()](#setmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [setMonth()](#setmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance month to the given value. |
| $this | [days()](#days) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [day()](#day) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [setDays()](#setdays) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [setDay()](#setday) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance day to the given value. |
| $this | [hours()](#hours) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [hour()](#hour) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [setHours()](#sethours) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [setHour()](#sethour) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance hour to the given value. |
| $this | [minutes()](#minutes) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [minute()](#minute) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [setMinutes()](#setminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [setMinute()](#setminute) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance minute to the given value. |
| $this | [seconds()](#seconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [second()](#second) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [setSeconds()](#setseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [setSecond()](#setsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance second to the given value. |
| $this | [millis()](#millis) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [milli()](#milli) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [setMillis()](#setmillis) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [setMilli()](#setmilli) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [milliseconds()](#milliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [millisecond()](#millisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [setMilliseconds()](#setmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [setMillisecond()](#setmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance millisecond to the given value. |
| $this | [micros()](#micros) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [micro()](#micro) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [setMicros()](#setmicros) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [setMicro()](#setmicro) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [microseconds()](#microseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [microsecond()](#microsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [setMicroseconds()](#setmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| self | [setMicrosecond()](#setmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Set current instance microsecond to the given value. |
| $this | [addYears()](#addyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addYear()](#addyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subYears()](#subyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subYear()](#subyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addYearsWithOverflow()](#addyearswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addYearWithOverflow()](#addyearwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subYearsWithOverflow()](#subyearswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subYearWithOverflow()](#subyearwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addYearsWithoutOverflow()](#addyearswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addYearWithoutOverflow()](#addyearwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subYearsWithoutOverflow()](#subyearswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subYearWithoutOverflow()](#subyearwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addYearsWithNoOverflow()](#addyearswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addYearWithNoOverflow()](#addyearwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subYearsWithNoOverflow()](#subyearswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subYearWithNoOverflow()](#subyearwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addYearsNoOverflow()](#addyearsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addYearNoOverflow()](#addyearnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subYearsNoOverflow()](#subyearsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subYearNoOverflow()](#subyearnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMonths()](#addmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMonth()](#addmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMonths()](#submonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMonth()](#submonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMonthsWithOverflow()](#addmonthswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addMonthWithOverflow()](#addmonthwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subMonthsWithOverflow()](#submonthswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subMonthWithOverflow()](#submonthwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addMonthsWithoutOverflow()](#addmonthswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMonthWithoutOverflow()](#addmonthwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMonthsWithoutOverflow()](#submonthswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMonthWithoutOverflow()](#submonthwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMonthsWithNoOverflow()](#addmonthswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMonthWithNoOverflow()](#addmonthwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMonthsWithNoOverflow()](#submonthswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMonthWithNoOverflow()](#submonthwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMonthsNoOverflow()](#addmonthsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMonthNoOverflow()](#addmonthnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMonthsNoOverflow()](#submonthsnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMonthNoOverflow()](#submonthnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addDays()](#adddays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addDay()](#addday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subDays()](#subdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subDay()](#subday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addHours()](#addhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addHour()](#addhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subHours()](#subhours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subHour()](#subhour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMinutes()](#addminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMinute()](#addminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMinutes()](#subminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMinute()](#subminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addSeconds()](#addseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addSecond()](#addsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subSeconds()](#subseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subSecond()](#subsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMillis()](#addmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMilli()](#addmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMillis()](#submillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMilli()](#submilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMilliseconds()](#addmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMillisecond()](#addmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMilliseconds()](#submilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMillisecond()](#submillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMicros()](#addmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMicro()](#addmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMicros()](#submicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMicro()](#submicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMicroseconds()](#addmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMicrosecond()](#addmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMicroseconds()](#submicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMicrosecond()](#submicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMillennia()](#addmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMillennium()](#addmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMillennia()](#submillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subMillennium()](#submillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addMillenniaWithOverflow()](#addmillenniawithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addMillenniumWithOverflow()](#addmillenniumwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subMillenniaWithOverflow()](#submillenniawithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subMillenniumWithOverflow()](#submillenniumwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addMillenniaWithoutOverflow()](#addmillenniawithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMillenniumWithoutOverflow()](#addmillenniumwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMillenniaWithoutOverflow()](#submillenniawithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMillenniumWithoutOverflow()](#submillenniumwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMillenniaWithNoOverflow()](#addmillenniawithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMillenniumWithNoOverflow()](#addmillenniumwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMillenniaWithNoOverflow()](#submillenniawithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMillenniumWithNoOverflow()](#submillenniumwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMillenniaNoOverflow()](#addmillennianooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addMillenniumNoOverflow()](#addmillenniumnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMillenniaNoOverflow()](#submillennianooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subMillenniumNoOverflow()](#submillenniumnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addCenturies()](#addcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addCentury()](#addcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subCenturies()](#subcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subCentury()](#subcentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addCenturiesWithOverflow()](#addcenturieswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addCenturyWithOverflow()](#addcenturywithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subCenturiesWithOverflow()](#subcenturieswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subCenturyWithOverflow()](#subcenturywithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addCenturiesWithoutOverflow()](#addcenturieswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addCenturyWithoutOverflow()](#addcenturywithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subCenturiesWithoutOverflow()](#subcenturieswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subCenturyWithoutOverflow()](#subcenturywithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addCenturiesWithNoOverflow()](#addcenturieswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addCenturyWithNoOverflow()](#addcenturywithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subCenturiesWithNoOverflow()](#subcenturieswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subCenturyWithNoOverflow()](#subcenturywithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addCenturiesNoOverflow()](#addcenturiesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addCenturyNoOverflow()](#addcenturynooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subCenturiesNoOverflow()](#subcenturiesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subCenturyNoOverflow()](#subcenturynooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addDecades()](#adddecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addDecade()](#adddecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subDecades()](#subdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subDecade()](#subdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addDecadesWithOverflow()](#adddecadeswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addDecadeWithOverflow()](#adddecadewithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subDecadesWithOverflow()](#subdecadeswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subDecadeWithOverflow()](#subdecadewithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addDecadesWithoutOverflow()](#adddecadeswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addDecadeWithoutOverflow()](#adddecadewithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subDecadesWithoutOverflow()](#subdecadeswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subDecadeWithoutOverflow()](#subdecadewithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addDecadesWithNoOverflow()](#adddecadeswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addDecadeWithNoOverflow()](#adddecadewithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subDecadesWithNoOverflow()](#subdecadeswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subDecadeWithNoOverflow()](#subdecadewithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addDecadesNoOverflow()](#adddecadesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addDecadeNoOverflow()](#adddecadenooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subDecadesNoOverflow()](#subdecadesnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subDecadeNoOverflow()](#subdecadenooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addQuarters()](#addquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addQuarter()](#addquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subQuarters()](#subquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subQuarter()](#subquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addQuartersWithOverflow()](#addquarterswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addQuarterWithOverflow()](#addquarterwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subQuartersWithOverflow()](#subquarterswithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [subQuarterWithOverflow()](#subquarterwithoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly allowed. |
| $this | [addQuartersWithoutOverflow()](#addquarterswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addQuarterWithoutOverflow()](#addquarterwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subQuartersWithoutOverflow()](#subquarterswithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subQuarterWithoutOverflow()](#subquarterwithoutoverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addQuartersWithNoOverflow()](#addquarterswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addQuarterWithNoOverflow()](#addquarterwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subQuartersWithNoOverflow()](#subquarterswithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subQuarterWithNoOverflow()](#subquarterwithnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addQuartersNoOverflow()](#addquartersnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addQuarterNoOverflow()](#addquarternooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subQuartersNoOverflow()](#subquartersnooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [subQuarterNoOverflow()](#subquarternooverflow) _(from [Carbon](../Carbon/Carbon.md))_ | with overflow explicitly forbidden. |
| $this | [addWeeks()](#addweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addWeek()](#addweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subWeeks()](#subweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subWeek()](#subweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addWeekdays()](#addweekdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addWeekday()](#addweekday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subWeekdays()](#subweekdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subWeekday()](#subweekday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMicros()](#addutcmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMicro()](#addutcmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMicros()](#subutcmicros) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMicro()](#subutcmicro) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [microsUntil()](#microsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [diffInUTCMicros()](#diffinutcmicros) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| $this | [addUTCMicroseconds()](#addutcmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMicrosecond()](#addutcmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMicroseconds()](#subutcmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMicrosecond()](#subutcmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [microsecondsUntil()](#microsecondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [diffInUTCMicroseconds()](#diffinutcmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| $this | [addUTCMillis()](#addutcmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMilli()](#addutcmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMillis()](#subutcmillis) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMilli()](#subutcmilli) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [millisUntil()](#millisuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [diffInUTCMillis()](#diffinutcmillis) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| $this | [addUTCMilliseconds()](#addutcmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMillisecond()](#addutcmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMilliseconds()](#subutcmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMillisecond()](#subutcmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [millisecondsUntil()](#millisecondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [diffInUTCMilliseconds()](#diffinutcmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| $this | [addUTCSeconds()](#addutcseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCSecond()](#addutcsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCSeconds()](#subutcseconds) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCSecond()](#subutcsecond) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [secondsUntil()](#secondsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each second or every X seconds if a factor is given. |
| float | [diffInUTCSeconds()](#diffinutcseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of seconds. |
| $this | [addUTCMinutes()](#addutcminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMinute()](#addutcminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMinutes()](#subutcminutes) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMinute()](#subutcminute) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [minutesUntil()](#minutesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each minute or every X minutes if a factor is given. |
| float | [diffInUTCMinutes()](#diffinutcminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of minutes. |
| $this | [addUTCHours()](#addutchours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCHour()](#addutchour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCHours()](#subutchours) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCHour()](#subutchour) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [hoursUntil()](#hoursuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each hour or every X hours if a factor is given. |
| float | [diffInUTCHours()](#diffinutchours) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of hours. |
| $this | [addUTCDays()](#addutcdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCDay()](#addutcday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCDays()](#subutcdays) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCDay()](#subutcday) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [daysUntil()](#daysuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each day or every X days if a factor is given. |
| float | [diffInUTCDays()](#diffinutcdays) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of days. |
| $this | [addUTCWeeks()](#addutcweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCWeek()](#addutcweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCWeeks()](#subutcweeks) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCWeek()](#subutcweek) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [weeksUntil()](#weeksuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each week or every X weeks if a factor is given. |
| float | [diffInUTCWeeks()](#diffinutcweeks) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of weeks. |
| $this | [addUTCMonths()](#addutcmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMonth()](#addutcmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMonths()](#subutcmonths) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMonth()](#subutcmonth) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [monthsUntil()](#monthsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each month or every X months if a factor is given. |
| float | [diffInUTCMonths()](#diffinutcmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of months. |
| $this | [addUTCQuarters()](#addutcquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCQuarter()](#addutcquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCQuarters()](#subutcquarters) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCQuarter()](#subutcquarter) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [quartersUntil()](#quartersuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each quarter or every X quarters if a factor is given. |
| float | [diffInUTCQuarters()](#diffinutcquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of quarters. |
| $this | [addUTCYears()](#addutcyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCYear()](#addutcyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCYears()](#subutcyears) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCYear()](#subutcyear) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [yearsUntil()](#yearsuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each year or every X years if a factor is given. |
| float | [diffInUTCYears()](#diffinutcyears) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of years. |
| $this | [addUTCDecades()](#addutcdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCDecade()](#addutcdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCDecades()](#subutcdecades) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCDecade()](#subutcdecade) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [decadesUntil()](#decadesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each decade or every X decades if a factor is given. |
| float | [diffInUTCDecades()](#diffinutcdecades) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of decades. |
| $this | [addUTCCenturies()](#addutccenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCCentury()](#addutccentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCCenturies()](#subutccenturies) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCCentury()](#subutccentury) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [centuriesUntil()](#centuriesuntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each century or every X centuries if a factor is given. |
| float | [diffInUTCCenturies()](#diffinutccenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of centuries. |
| $this | [addUTCMillennia()](#addutcmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [addUTCMillennium()](#addutcmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMillennia()](#subutcmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| $this | [subUTCMillennium()](#subutcmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | . |
| CarbonPeriod | [millenniaUntil()](#millenniauntil) _(from [Carbon](../Carbon/Carbon.md))_ | for each millennium or every X millennia if a factor is given. |
| float | [diffInUTCMillennia()](#diffinutcmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Convert current and given date in UTC timezone and return a floating number of millennia. |
| $this | [roundYear()](#roundyear) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance year with given precision using the given function. |
| $this | [roundYears()](#roundyears) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance year with given precision using the given function. |
| $this | [floorYear()](#flooryear) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance year with given precision. |
| $this | [floorYears()](#flooryears) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance year with given precision. |
| $this | [ceilYear()](#ceilyear) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance year with given precision. |
| $this | [ceilYears()](#ceilyears) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance year with given precision. |
| $this | [roundMonth()](#roundmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance month with given precision using the given function. |
| $this | [roundMonths()](#roundmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance month with given precision using the given function. |
| $this | [floorMonth()](#floormonth) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance month with given precision. |
| $this | [floorMonths()](#floormonths) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance month with given precision. |
| $this | [ceilMonth()](#ceilmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance month with given precision. |
| $this | [ceilMonths()](#ceilmonths) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance month with given precision. |
| $this | [roundDay()](#roundday) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance day with given precision using the given function. |
| $this | [roundDays()](#rounddays) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance day with given precision using the given function. |
| $this | [floorDay()](#floorday) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance day with given precision. |
| $this | [floorDays()](#floordays) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance day with given precision. |
| $this | [ceilDay()](#ceilday) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance day with given precision. |
| $this | [ceilDays()](#ceildays) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance day with given precision. |
| $this | [roundHour()](#roundhour) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [roundHours()](#roundhours) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [floorHour()](#floorhour) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance hour with given precision. |
| $this | [floorHours()](#floorhours) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance hour with given precision. |
| $this | [ceilHour()](#ceilhour) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance hour with given precision. |
| $this | [ceilHours()](#ceilhours) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance hour with given precision. |
| $this | [roundMinute()](#roundminute) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [roundMinutes()](#roundminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [floorMinute()](#floorminute) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance minute with given precision. |
| $this | [floorMinutes()](#floorminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance minute with given precision. |
| $this | [ceilMinute()](#ceilminute) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance minute with given precision. |
| $this | [ceilMinutes()](#ceilminutes) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance minute with given precision. |
| $this | [roundSecond()](#roundsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance second with given precision using the given function. |
| $this | [roundSeconds()](#roundseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance second with given precision using the given function. |
| $this | [floorSecond()](#floorsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance second with given precision. |
| $this | [floorSeconds()](#floorseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance second with given precision. |
| $this | [ceilSecond()](#ceilsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance second with given precision. |
| $this | [ceilSeconds()](#ceilseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance second with given precision. |
| $this | [roundMillennium()](#roundmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [roundMillennia()](#roundmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [floorMillennium()](#floormillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millennium with given precision. |
| $this | [floorMillennia()](#floormillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millennium with given precision. |
| $this | [ceilMillennium()](#ceilmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millennium with given precision. |
| $this | [ceilMillennia()](#ceilmillennia) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millennium with given precision. |
| $this | [roundCentury()](#roundcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance century with given precision using the given function. |
| $this | [roundCenturies()](#roundcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance century with given precision using the given function. |
| $this | [floorCentury()](#floorcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance century with given precision. |
| $this | [floorCenturies()](#floorcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance century with given precision. |
| $this | [ceilCentury()](#ceilcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance century with given precision. |
| $this | [ceilCenturies()](#ceilcenturies) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance century with given precision. |
| $this | [roundDecade()](#rounddecade) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [roundDecades()](#rounddecades) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [floorDecade()](#floordecade) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance decade with given precision. |
| $this | [floorDecades()](#floordecades) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance decade with given precision. |
| $this | [ceilDecade()](#ceildecade) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance decade with given precision. |
| $this | [ceilDecades()](#ceildecades) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance decade with given precision. |
| $this | [roundQuarter()](#roundquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [roundQuarters()](#roundquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [floorQuarter()](#floorquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance quarter with given precision. |
| $this | [floorQuarters()](#floorquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance quarter with given precision. |
| $this | [ceilQuarter()](#ceilquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance quarter with given precision. |
| $this | [ceilQuarters()](#ceilquarters) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance quarter with given precision. |
| $this | [roundMillisecond()](#roundmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [roundMilliseconds()](#roundmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [floorMillisecond()](#floormillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [floorMilliseconds()](#floormilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [ceilMillisecond()](#ceilmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [ceilMilliseconds()](#ceilmilliseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [roundMicrosecond()](#roundmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [roundMicroseconds()](#roundmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [floorMicrosecond()](#floormicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [floorMicroseconds()](#floormicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [ceilMicrosecond()](#ceilmicrosecond) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance microsecond with given precision. |
| $this | [ceilMicroseconds()](#ceilmicroseconds) _(from [Carbon](../Carbon/Carbon.md))_ | Ceil the current instance microsecond with given precision. |
| string | [shortAbsoluteDiffForHumans()](#shortabsolutediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [longAbsoluteDiffForHumans()](#longabsolutediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [shortRelativeDiffForHumans()](#shortrelativediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [longRelativeDiffForHumans()](#longrelativediffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [shortRelativeToNowDiffForHumans()](#shortrelativetonowdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [longRelativeToNowDiffForHumans()](#longrelativetonowdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [shortRelativeToOtherDiffForHumans()](#shortrelativetootherdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| string | [longRelativeToOtherDiffForHumans()](#longrelativetootherdiffforhumans) _(from [Carbon](../Carbon/Carbon.md))_ |  |
| int | [centuriesInMillennium()](#centuriesinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of centuries contained in the current millennium |
| int|static | [centuryOfMillennium()](#centuryofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the century starting from the beginning of the current millennium when called with no parameters, change the current century when called with an integer value |
| int|static | [dayOfCentury()](#dayofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current century when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfDecade()](#dayofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current decade when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfMillennium()](#dayofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current millennium when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfMonth()](#dayofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current month when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfQuarter()](#dayofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current quarter when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfWeek()](#dayofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the day starting from the beginning of the current week when called with no parameters, change the current day when called with an integer value |
| int | [daysInCentury()](#daysincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current century |
| int | [daysInDecade()](#daysindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current decade |
| int | [daysInMillennium()](#daysinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current millennium |
| int | [daysInMonth()](#daysinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current month |
| int | [daysInQuarter()](#daysinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current quarter |
| int | [daysInWeek()](#daysinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current week |
| int | [daysInYear()](#daysinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of days contained in the current year |
| int|static | [decadeOfCentury()](#decadeofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the decade starting from the beginning of the current century when called with no parameters, change the current decade when called with an integer value |
| int|static | [decadeOfMillennium()](#decadeofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the decade starting from the beginning of the current millennium when called with no parameters, change the current decade when called with an integer value |
| int | [decadesInCentury()](#decadesincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of decades contained in the current century |
| int | [decadesInMillennium()](#decadesinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of decades contained in the current millennium |
| int|static | [hourOfCentury()](#hourofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current century when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfDay()](#hourofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current day when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfDecade()](#hourofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current decade when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfMillennium()](#hourofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current millennium when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfMonth()](#hourofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current month when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfQuarter()](#hourofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current quarter when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfWeek()](#hourofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current week when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfYear()](#hourofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the hour starting from the beginning of the current year when called with no parameters, change the current hour when called with an integer value |
| int | [hoursInCentury()](#hoursincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current century |
| int | [hoursInDay()](#hoursinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current day |
| int | [hoursInDecade()](#hoursindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current decade |
| int | [hoursInMillennium()](#hoursinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current millennium |
| int | [hoursInMonth()](#hoursinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current month |
| int | [hoursInQuarter()](#hoursinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current quarter |
| int | [hoursInWeek()](#hoursinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current week |
| int | [hoursInYear()](#hoursinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of hours contained in the current year |
| int|static | [microsecondOfCentury()](#microsecondofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current century when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfDay()](#microsecondofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current day when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfDecade()](#microsecondofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current decade when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfHour()](#microsecondofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current hour when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMillennium()](#microsecondofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current millennium when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMillisecond()](#microsecondofmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current millisecond when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMinute()](#microsecondofminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current minute when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMonth()](#microsecondofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current month when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfQuarter()](#microsecondofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current quarter when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfSecond()](#microsecondofsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current second when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfWeek()](#microsecondofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current week when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfYear()](#microsecondofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the microsecond starting from the beginning of the current year when called with no parameters, change the current microsecond when called with an integer value |
| int | [microsecondsInCentury()](#microsecondsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current century |
| int | [microsecondsInDay()](#microsecondsinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current day |
| int | [microsecondsInDecade()](#microsecondsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current decade |
| int | [microsecondsInHour()](#microsecondsinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current hour |
| int | [microsecondsInMillennium()](#microsecondsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current millennium |
| int | [microsecondsInMillisecond()](#microsecondsinmillisecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current millisecond |
| int | [microsecondsInMinute()](#microsecondsinminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current minute |
| int | [microsecondsInMonth()](#microsecondsinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current month |
| int | [microsecondsInQuarter()](#microsecondsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current quarter |
| int | [microsecondsInSecond()](#microsecondsinsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current second |
| int | [microsecondsInWeek()](#microsecondsinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current week |
| int | [microsecondsInYear()](#microsecondsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of microseconds contained in the current year |
| int|static | [millisecondOfCentury()](#millisecondofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current century when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfDay()](#millisecondofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current day when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfDecade()](#millisecondofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current decade when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfHour()](#millisecondofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current hour when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfMillennium()](#millisecondofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current millennium when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfMinute()](#millisecondofminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current minute when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfMonth()](#millisecondofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current month when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfQuarter()](#millisecondofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current quarter when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfSecond()](#millisecondofsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current second when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfWeek()](#millisecondofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current week when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfYear()](#millisecondofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the millisecond starting from the beginning of the current year when called with no parameters, change the current millisecond when called with an integer value |
| int | [millisecondsInCentury()](#millisecondsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current century |
| int | [millisecondsInDay()](#millisecondsinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current day |
| int | [millisecondsInDecade()](#millisecondsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current decade |
| int | [millisecondsInHour()](#millisecondsinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current hour |
| int | [millisecondsInMillennium()](#millisecondsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current millennium |
| int | [millisecondsInMinute()](#millisecondsinminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current minute |
| int | [millisecondsInMonth()](#millisecondsinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current month |
| int | [millisecondsInQuarter()](#millisecondsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current quarter |
| int | [millisecondsInSecond()](#millisecondsinsecond) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current second |
| int | [millisecondsInWeek()](#millisecondsinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current week |
| int | [millisecondsInYear()](#millisecondsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of milliseconds contained in the current year |
| int|static | [minuteOfCentury()](#minuteofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current century when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfDay()](#minuteofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current day when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfDecade()](#minuteofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current decade when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfHour()](#minuteofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current hour when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfMillennium()](#minuteofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current millennium when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfMonth()](#minuteofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current month when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfQuarter()](#minuteofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current quarter when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfWeek()](#minuteofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current week when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfYear()](#minuteofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the minute starting from the beginning of the current year when called with no parameters, change the current minute when called with an integer value |
| int | [minutesInCentury()](#minutesincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current century |
| int | [minutesInDay()](#minutesinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current day |
| int | [minutesInDecade()](#minutesindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current decade |
| int | [minutesInHour()](#minutesinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current hour |
| int | [minutesInMillennium()](#minutesinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current millennium |
| int | [minutesInMonth()](#minutesinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current month |
| int | [minutesInQuarter()](#minutesinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current quarter |
| int | [minutesInWeek()](#minutesinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current week |
| int | [minutesInYear()](#minutesinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of minutes contained in the current year |
| int|static | [monthOfCentury()](#monthofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current century when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfDecade()](#monthofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current decade when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfMillennium()](#monthofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current millennium when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfQuarter()](#monthofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current quarter when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfYear()](#monthofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the month starting from the beginning of the current year when called with no parameters, change the current month when called with an integer value |
| int | [monthsInCentury()](#monthsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current century |
| int | [monthsInDecade()](#monthsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current decade |
| int | [monthsInMillennium()](#monthsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current millennium |
| int | [monthsInQuarter()](#monthsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current quarter |
| int | [monthsInYear()](#monthsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of months contained in the current year |
| int|static | [quarterOfCentury()](#quarterofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current century when called with no parameters, change the current quarter when called with an integer value |
| int|static | [quarterOfDecade()](#quarterofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current decade when called with no parameters, change the current quarter when called with an integer value |
| int|static | [quarterOfMillennium()](#quarterofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current millennium when called with no parameters, change the current quarter when called with an integer value |
| int|static | [quarterOfYear()](#quarterofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the quarter starting from the beginning of the current year when called with no parameters, change the current quarter when called with an integer value |
| int | [quartersInCentury()](#quartersincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current century |
| int | [quartersInDecade()](#quartersindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current decade |
| int | [quartersInMillennium()](#quartersinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current millennium |
| int | [quartersInYear()](#quartersinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of quarters contained in the current year |
| int|static | [secondOfCentury()](#secondofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current century when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfDay()](#secondofday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current day when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfDecade()](#secondofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current decade when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfHour()](#secondofhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current hour when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfMillennium()](#secondofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current millennium when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfMinute()](#secondofminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current minute when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfMonth()](#secondofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current month when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfQuarter()](#secondofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current quarter when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfWeek()](#secondofweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current week when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfYear()](#secondofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the second starting from the beginning of the current year when called with no parameters, change the current second when called with an integer value |
| int | [secondsInCentury()](#secondsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current century |
| int | [secondsInDay()](#secondsinday) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current day |
| int | [secondsInDecade()](#secondsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current decade |
| int | [secondsInHour()](#secondsinhour) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current hour |
| int | [secondsInMillennium()](#secondsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current millennium |
| int | [secondsInMinute()](#secondsinminute) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current minute |
| int | [secondsInMonth()](#secondsinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current month |
| int | [secondsInQuarter()](#secondsinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current quarter |
| int | [secondsInWeek()](#secondsinweek) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current week |
| int | [secondsInYear()](#secondsinyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of seconds contained in the current year |
| int|static | [weekOfCentury()](#weekofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current century when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfDecade()](#weekofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current decade when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfMillennium()](#weekofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current millennium when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfMonth()](#weekofmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current month when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfQuarter()](#weekofquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current quarter when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfYear()](#weekofyear) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the week starting from the beginning of the current year when called with no parameters, change the current week when called with an integer value |
| int | [weeksInCentury()](#weeksincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current century |
| int | [weeksInDecade()](#weeksindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current decade |
| int | [weeksInMillennium()](#weeksinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current millennium |
| int | [weeksInMonth()](#weeksinmonth) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current month |
| int | [weeksInQuarter()](#weeksinquarter) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of weeks contained in the current quarter |
| int|static | [yearOfCentury()](#yearofcentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the year starting from the beginning of the current century when called with no parameters, change the current year when called with an integer value |
| int|static | [yearOfDecade()](#yearofdecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the year starting from the beginning of the current decade when called with no parameters, change the current year when called with an integer value |
| int|static | [yearOfMillennium()](#yearofmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the value of the year starting from the beginning of the current millennium when called with no parameters, change the current year when called with an integer value |
| int | [yearsInCentury()](#yearsincentury) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of years contained in the current century |
| int | [yearsInDecade()](#yearsindecade) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of years contained in the current decade |
| int | [yearsInMillennium()](#yearsinmillennium) _(from [Carbon](../Carbon/Carbon.md))_ | Return the number of years contained in the current millennium

</autodoc> |
| Factory | [factory()](#factory) _(from [Factory](../JapaneseDate/Traits/Factory.md))_ | DateTimeオブジェクトの生成 |
| void | [setCacheMode()](#setcachemode) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | キャッシュモードを指定する |
| void | [setCacheFilePath()](#setcachefilepath) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | キャッシュファイル保存ディレクトリをセットします |
| void | [setCacheClosure()](#setcacheclosure) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | 独自キャッシュロジックのセット |
| Modifier | [nextHoliday()](#nextholiday) _(from [Modifier](../JapaneseDate/Traits/Modifier.md))_ | 次の祝日にする |
| Modifier | [nextSixWeek()](#nextsixweek) _(from [Modifier](../JapaneseDate/Traits/Modifier.md))_ | 指定された次の六曜にする |
| array | [getCalendar()](#getcalendar) _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | サポートされるカレンダーに変換する |

---

## Method Details

### isMutable

```php
static public bool isMutable()
```

Returns true if the current class/instance is mutable.

**Returns:** bool
---

### isUtc

```php
public bool isUtc($heck if the current instance has UTC timezone. (Both isUtc and isUTC cases are valid.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$heck if the current instance has UTC timezone. (Both isUtc and isUTC cases are valid.` | —  |  |

**Returns:** bool
---

### isLocal

```php
public bool isLocal()
```

Check if the current instance has non-UTC timezone.

**Returns:** bool
---

### isValid

```php
public bool isValid()
```

Check if the current instance is a valid date.

**Returns:** bool
---

### isDST

```php
public bool isDST()
```

Check if the current instance is in a daylight saving time.

**Returns:** bool
---

### isSunday

```php
public bool isSunday()
```

Checks if the instance day is sunday.

**Returns:** bool
---

### isMonday

```php
public bool isMonday()
```

Checks if the instance day is monday.

**Returns:** bool
---

### isTuesday

```php
public bool isTuesday()
```

Checks if the instance day is tuesday.

**Returns:** bool
---

### isWednesday

```php
public bool isWednesday()
```

Checks if the instance day is wednesday.

**Returns:** bool
---

### isThursday

```php
public bool isThursday()
```

Checks if the instance day is thursday.

**Returns:** bool
---

### isFriday

```php
public bool isFriday()
```

Checks if the instance day is friday.

**Returns:** bool
---

### isSaturday

```php
public bool isSaturday()
```

Checks if the instance day is saturday.

**Returns:** bool
---

### isSameYear

```php
public bool isSameYear($date) Checks if the given date is in the same year as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same year as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentYear

```php
public bool isCurrentYear()
```

Checks if the instance is in the same year as the current moment.

**Returns:** bool
---

### isNextYear

```php
public bool isNextYear()
```

Checks if the instance is in the same year as the current moment next year.

**Returns:** bool
---

### isLastYear

```php
public bool isLastYear()
```

Checks if the instance is in the same year as the current moment last year.

**Returns:** bool
---

### isCurrentMonth

```php
public bool isCurrentMonth()
```

Checks if the instance is in the same month as the current moment.

**Returns:** bool
---

### isNextMonth

```php
public bool isNextMonth()
```

Checks if the instance is in the same month as the current moment next month.

**Returns:** bool
---

### isLastMonth

```php
public bool isLastMonth()
```

Checks if the instance is in the same month as the current moment last month.

**Returns:** bool
---

### isSameWeek

```php
public bool isSameWeek($date) Checks if the given date is in the same week as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same week as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentWeek

```php
public bool isCurrentWeek()
```

Checks if the instance is in the same week as the current moment.

**Returns:** bool
---

### isNextWeek

```php
public bool isNextWeek()
```

Checks if the instance is in the same week as the current moment next week.

**Returns:** bool
---

### isLastWeek

```php
public bool isLastWeek()
```

Checks if the instance is in the same week as the current moment last week.

**Returns:** bool
---

### isSameDay

```php
public bool isSameDay($date) Checks if the given date is in the same day as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same day as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentDay

```php
public bool isCurrentDay()
```

Checks if the instance is in the same day as the current moment.

**Returns:** bool
---

### isNextDay

```php
public bool isNextDay()
```

Checks if the instance is in the same day as the current moment next day.

**Returns:** bool
---

### isLastDay

```php
public bool isLastDay()
```

Checks if the instance is in the same day as the current moment last day.

**Returns:** bool
---

### isSameHour

```php
public bool isSameHour($date) Checks if the given date is in the same hour as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same hour as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentHour

```php
public bool isCurrentHour()
```

Checks if the instance is in the same hour as the current moment.

**Returns:** bool
---

### isNextHour

```php
public bool isNextHour()
```

Checks if the instance is in the same hour as the current moment next hour.

**Returns:** bool
---

### isLastHour

```php
public bool isLastHour()
```

Checks if the instance is in the same hour as the current moment last hour.

**Returns:** bool
---

### isSameMinute

```php
public bool isSameMinute($date) Checks if the given date is in the same minute as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same minute as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentMinute

```php
public bool isCurrentMinute()
```

Checks if the instance is in the same minute as the current moment.

**Returns:** bool
---

### isNextMinute

```php
public bool isNextMinute()
```

Checks if the instance is in the same minute as the current moment next minute.

**Returns:** bool
---

### isLastMinute

```php
public bool isLastMinute()
```

Checks if the instance is in the same minute as the current moment last minute.

**Returns:** bool
---

### isSameSecond

```php
public bool isSameSecond($date) Checks if the given date is in the same second as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same second as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentSecond

```php
public bool isCurrentSecond()
```

Checks if the instance is in the same second as the current moment.

**Returns:** bool
---

### isNextSecond

```php
public bool isNextSecond()
```

Checks if the instance is in the same second as the current moment next second.

**Returns:** bool
---

### isLastSecond

```php
public bool isLastSecond()
```

Checks if the instance is in the same second as the current moment last second.

**Returns:** bool
---

### isSameMilli

```php
public bool isSameMilli($date) Checks if the given date is in the same millisecond as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same millisecond as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentMilli

```php
public bool isCurrentMilli()
```

Checks if the instance is in the same millisecond as the current moment.

**Returns:** bool
---

### isNextMilli

```php
public bool isNextMilli()
```

Checks if the instance is in the same millisecond as the current moment next millisecond.

**Returns:** bool
---

### isLastMilli

```php
public bool isLastMilli()
```

Checks if the instance is in the same millisecond as the current moment last millisecond.

**Returns:** bool
---

### isSameMillisecond

```php
public bool isSameMillisecond($date) Checks if the given date is in the same millisecond as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same millisecond as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentMillisecond

```php
public bool isCurrentMillisecond()
```

Checks if the instance is in the same millisecond as the current moment.

**Returns:** bool
---

### isNextMillisecond

```php
public bool isNextMillisecond()
```

Checks if the instance is in the same millisecond as the current moment next millisecond.

**Returns:** bool
---

### isLastMillisecond

```php
public bool isLastMillisecond()
```

Checks if the instance is in the same millisecond as the current moment last millisecond.

**Returns:** bool
---

### isSameMicro

```php
public bool isSameMicro($date) Checks if the given date is in the same microsecond as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same microsecond as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentMicro

```php
public bool isCurrentMicro()
```

Checks if the instance is in the same microsecond as the current moment.

**Returns:** bool
---

### isNextMicro

```php
public bool isNextMicro()
```

Checks if the instance is in the same microsecond as the current moment next microsecond.

**Returns:** bool
---

### isLastMicro

```php
public bool isLastMicro()
```

Checks if the instance is in the same microsecond as the current moment last microsecond.

**Returns:** bool
---

### isSameMicrosecond

```php
public bool isSameMicrosecond($date) Checks if the given date is in the same microsecond as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same microsecond as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentMicrosecond

```php
public bool isCurrentMicrosecond()
```

Checks if the instance is in the same microsecond as the current moment.

**Returns:** bool
---

### isNextMicrosecond

```php
public bool isNextMicrosecond()
```

Checks if the instance is in the same microsecond as the current moment next microsecond.

**Returns:** bool
---

### isLastMicrosecond

```php
public bool isLastMicrosecond()
```

Checks if the instance is in the same microsecond as the current moment last microsecond.

**Returns:** bool
---

### isSameDecade

```php
public bool isSameDecade($date) Checks if the given date is in the same decade as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same decade as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentDecade

```php
public bool isCurrentDecade()
```

Checks if the instance is in the same decade as the current moment.

**Returns:** bool
---

### isNextDecade

```php
public bool isNextDecade()
```

Checks if the instance is in the same decade as the current moment next decade.

**Returns:** bool
---

### isLastDecade

```php
public bool isLastDecade()
```

Checks if the instance is in the same decade as the current moment last decade.

**Returns:** bool
---

### isSameCentury

```php
public bool isSameCentury($date) Checks if the given date is in the same century as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same century as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentCentury

```php
public bool isCurrentCentury()
```

Checks if the instance is in the same century as the current moment.

**Returns:** bool
---

### isNextCentury

```php
public bool isNextCentury()
```

Checks if the instance is in the same century as the current moment next century.

**Returns:** bool
---

### isLastCentury

```php
public bool isLastCentury()
```

Checks if the instance is in the same century as the current moment last century.

**Returns:** bool
---

### isSameMillennium

```php
public bool isSameMillennium($date) Checks if the given date is in the same millennium as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string | `$date) Checks if the given date is in the same millennium as the instance. If null passed` | —  |  |
| compare | `$o now (with the same timezone` | —  |  |

**Returns:** bool
---

### isCurrentMillennium

```php
public bool isCurrentMillennium()
```

Checks if the instance is in the same millennium as the current moment.

**Returns:** bool
---

### isNextMillennium

```php
public bool isNextMillennium()
```

Checks if the instance is in the same millennium as the current moment next millennium.

**Returns:** bool
---

### isLastMillennium

```php
public bool isLastMillennium()
```

Checks if the instance is in the same millennium as the current moment last millennium.

**Returns:** bool
---

### isCurrentQuarter

```php
public bool isCurrentQuarter()
```

Checks if the instance is in the same quarter as the current moment.

**Returns:** bool
---

### isNextQuarter

```php
public bool isNextQuarter()
```

Checks if the instance is in the same quarter as the current moment next quarter.

**Returns:** bool
---

### isLastQuarter

```php
public bool isLastQuarter()
```

Checks if the instance is in the same quarter as the current moment last quarter.

**Returns:** bool
---

### years

```php
public $this years($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### year

```php
public $this year($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setYears

```php
public $this setYears($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setYear

```php
public $this setYear($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### months

```php
public $this months($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** $this
---

### month

```php
public $this month($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** $this
---

### setMonths

```php
public $this setMonths($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** $this
---

### setMonth

```php
public $this setMonth($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** $this
---

### days

```php
public $this days($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### day

```php
public $this day($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setDays

```php
public $this setDays($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setDay

```php
public $this setDay($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### hours

```php
public $this hours($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### hour

```php
public $this hour($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setHours

```php
public $this setHours($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setHour

```php
public $this setHour($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### minutes

```php
public $this minutes($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### minute

```php
public $this minute($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMinutes

```php
public $this setMinutes($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMinute

```php
public $this setMinute($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### seconds

```php
public $this seconds($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### second

```php
public $this second($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setSeconds

```php
public $this setSeconds($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setSecond

```php
public $this setSecond($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### millis

```php
public $this millis($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### milli

```php
public $this milli($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMillis

```php
public $this setMillis($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMilli

```php
public $this setMilli($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### milliseconds

```php
public $this milliseconds($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### millisecond

```php
public $this millisecond($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMilliseconds

```php
public $this setMilliseconds($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMillisecond

```php
public $this setMillisecond($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### micros

```php
public $this micros($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### micro

```php
public $this micro($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMicros

```php
public $this setMicros($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMicro

```php
public $this setMicro($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### microseconds

```php
public $this microseconds($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### microsecond

```php
public $this microsecond($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMicroseconds

```php
public $this setMicroseconds($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### setMicrosecond

```php
public self setMicrosecond($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** self
---

### addYears

```php
public $this addYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addYear

```php
public $this addYear($dd one year to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subYears

```php
public $this subYears($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subYear

```php
public $this subYear($ub one year to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addYearsWithOverflow

```php
public $this addYearsWithOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addYearWithOverflow

```php
public $this addYearWithOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subYearsWithOverflow

```php
public $this subYearsWithOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subYearWithOverflow

```php
public $this subYearWithOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addYearsWithoutOverflow

```php
public $this addYearsWithoutOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addYearWithoutOverflow

```php
public $this addYearWithoutOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subYearsWithoutOverflow

```php
public $this subYearsWithoutOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subYearWithoutOverflow

```php
public $this subYearWithoutOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addYearsWithNoOverflow

```php
public $this addYearsWithNoOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addYearWithNoOverflow

```php
public $this addYearWithNoOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subYearsWithNoOverflow

```php
public $this subYearsWithNoOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subYearWithNoOverflow

```php
public $this subYearWithNoOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addYearsNoOverflow

```php
public $this addYearsNoOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addYearNoOverflow

```php
public $this addYearNoOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subYearsNoOverflow

```php
public $this subYearsNoOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subYearNoOverflow

```php
public $this subYearNoOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMonths

```php
public $this addMonths($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMonth

```php
public $this addMonth($dd one month to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMonths

```php
public $this subMonths($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMonth

```php
public $this subMonth($ub one month to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMonthsWithOverflow

```php
public $this addMonthsWithOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMonthWithOverflow

```php
public $this addMonthWithOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMonthsWithOverflow

```php
public $this subMonthsWithOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMonthWithOverflow

```php
public $this subMonthWithOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMonthsWithoutOverflow

```php
public $this addMonthsWithoutOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMonthWithoutOverflow

```php
public $this addMonthWithoutOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMonthsWithoutOverflow

```php
public $this subMonthsWithoutOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMonthWithoutOverflow

```php
public $this subMonthWithoutOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMonthsWithNoOverflow

```php
public $this addMonthsWithNoOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMonthWithNoOverflow

```php
public $this addMonthWithNoOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMonthsWithNoOverflow

```php
public $this subMonthsWithNoOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMonthWithNoOverflow

```php
public $this subMonthWithNoOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMonthsNoOverflow

```php
public $this addMonthsNoOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMonthNoOverflow

```php
public $this addMonthNoOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMonthsNoOverflow

```php
public $this subMonthsNoOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMonthNoOverflow

```php
public $this subMonthNoOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addDays

```php
public $this addDays($value = &#039;1&#039;) Add days (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addDay

```php
public $this addDay($dd one day to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one day to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subDays

```php
public $this subDays($value = &#039;1&#039;) Sub days (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subDay

```php
public $this subDay($ub one day to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one day to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addHours

```php
public $this addHours($value = &#039;1&#039;) Add hours (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addHour

```php
public $this addHour($dd one hour to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one hour to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subHours

```php
public $this subHours($value = &#039;1&#039;) Sub hours (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subHour

```php
public $this subHour($ub one hour to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one hour to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMinutes

```php
public $this addMinutes($value = &#039;1&#039;) Add minutes (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMinute

```php
public $this addMinute($dd one minute to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one minute to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMinutes

```php
public $this subMinutes($value = &#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMinute

```php
public $this subMinute($ub one minute to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one minute to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addSeconds

```php
public $this addSeconds($value = &#039;1&#039;) Add seconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addSecond

```php
public $this addSecond($dd one second to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one second to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subSeconds

```php
public $this subSeconds($value = &#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subSecond

```php
public $this subSecond($ub one second to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one second to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMillis

```php
public $this addMillis($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMilli

```php
public $this addMilli($dd one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMillis

```php
public $this subMillis($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMilli

```php
public $this subMilli($ub one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMilliseconds

```php
public $this addMilliseconds($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMillisecond

```php
public $this addMillisecond($dd one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMilliseconds

```php
public $this subMilliseconds($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMillisecond

```php
public $this subMillisecond($ub one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMicros

```php
public $this addMicros($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMicro

```php
public $this addMicro($dd one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMicros

```php
public $this subMicros($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMicro

```php
public $this subMicro($ub one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMicroseconds

```php
public $this addMicroseconds($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMicrosecond

```php
public $this addMicrosecond($dd one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMicroseconds

```php
public $this subMicroseconds($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMicrosecond

```php
public $this subMicrosecond($ub one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMillennia

```php
public $this addMillennia($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMillennium

```php
public $this addMillennium($dd one millennium to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMillennia

```php
public $this subMillennia($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMillennium

```php
public $this subMillennium($ub one millennium to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMillenniaWithOverflow

```php
public $this addMillenniaWithOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMillenniumWithOverflow

```php
public $this addMillenniumWithOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMillenniaWithOverflow

```php
public $this subMillenniaWithOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMillenniumWithOverflow

```php
public $this subMillenniumWithOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMillenniaWithoutOverflow

```php
public $this addMillenniaWithoutOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMillenniumWithoutOverflow

```php
public $this addMillenniumWithoutOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMillenniaWithoutOverflow

```php
public $this subMillenniaWithoutOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMillenniumWithoutOverflow

```php
public $this subMillenniumWithoutOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMillenniaWithNoOverflow

```php
public $this addMillenniaWithNoOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMillenniumWithNoOverflow

```php
public $this addMillenniumWithNoOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMillenniaWithNoOverflow

```php
public $this subMillenniaWithNoOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMillenniumWithNoOverflow

```php
public $this subMillenniumWithNoOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addMillenniaNoOverflow

```php
public $this addMillenniaNoOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addMillenniumNoOverflow

```php
public $this addMillenniumNoOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subMillenniaNoOverflow

```php
public $this subMillenniaNoOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subMillenniumNoOverflow

```php
public $this subMillenniumNoOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addCenturies

```php
public $this addCenturies($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addCentury

```php
public $this addCentury($dd one century to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subCenturies

```php
public $this subCenturies($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subCentury

```php
public $this subCentury($ub one century to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addCenturiesWithOverflow

```php
public $this addCenturiesWithOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addCenturyWithOverflow

```php
public $this addCenturyWithOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subCenturiesWithOverflow

```php
public $this subCenturiesWithOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subCenturyWithOverflow

```php
public $this subCenturyWithOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addCenturiesWithoutOverflow

```php
public $this addCenturiesWithoutOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addCenturyWithoutOverflow

```php
public $this addCenturyWithoutOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subCenturiesWithoutOverflow

```php
public $this subCenturiesWithoutOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subCenturyWithoutOverflow

```php
public $this subCenturyWithoutOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addCenturiesWithNoOverflow

```php
public $this addCenturiesWithNoOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addCenturyWithNoOverflow

```php
public $this addCenturyWithNoOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subCenturiesWithNoOverflow

```php
public $this subCenturiesWithNoOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subCenturyWithNoOverflow

```php
public $this subCenturyWithNoOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addCenturiesNoOverflow

```php
public $this addCenturiesNoOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addCenturyNoOverflow

```php
public $this addCenturyNoOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subCenturiesNoOverflow

```php
public $this subCenturiesNoOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subCenturyNoOverflow

```php
public $this subCenturyNoOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addDecades

```php
public $this addDecades($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addDecade

```php
public $this addDecade($dd one decade to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subDecades

```php
public $this subDecades($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subDecade

```php
public $this subDecade($ub one decade to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addDecadesWithOverflow

```php
public $this addDecadesWithOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addDecadeWithOverflow

```php
public $this addDecadeWithOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subDecadesWithOverflow

```php
public $this subDecadesWithOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subDecadeWithOverflow

```php
public $this subDecadeWithOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addDecadesWithoutOverflow

```php
public $this addDecadesWithoutOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addDecadeWithoutOverflow

```php
public $this addDecadeWithoutOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subDecadesWithoutOverflow

```php
public $this subDecadesWithoutOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subDecadeWithoutOverflow

```php
public $this subDecadeWithoutOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addDecadesWithNoOverflow

```php
public $this addDecadesWithNoOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addDecadeWithNoOverflow

```php
public $this addDecadeWithNoOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subDecadesWithNoOverflow

```php
public $this subDecadesWithNoOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subDecadeWithNoOverflow

```php
public $this subDecadeWithNoOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addDecadesNoOverflow

```php
public $this addDecadesNoOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addDecadeNoOverflow

```php
public $this addDecadeNoOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subDecadesNoOverflow

```php
public $this subDecadesNoOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subDecadeNoOverflow

```php
public $this subDecadeNoOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addQuarters

```php
public $this addQuarters($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addQuarter

```php
public $this addQuarter($dd one quarter to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subQuarters

```php
public $this subQuarters($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subQuarter

```php
public $this subQuarter($ub one quarter to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addQuartersWithOverflow

```php
public $this addQuartersWithOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addQuarterWithOverflow

```php
public $this addQuarterWithOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subQuartersWithOverflow

```php
public $this subQuartersWithOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subQuarterWithOverflow

```php
public $this subQuarterWithOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addQuartersWithoutOverflow

```php
public $this addQuartersWithoutOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addQuarterWithoutOverflow

```php
public $this addQuarterWithoutOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subQuartersWithoutOverflow

```php
public $this subQuartersWithoutOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subQuarterWithoutOverflow

```php
public $this subQuarterWithoutOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addQuartersWithNoOverflow

```php
public $this addQuartersWithNoOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addQuarterWithNoOverflow

```php
public $this addQuarterWithNoOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subQuartersWithNoOverflow

```php
public $this subQuartersWithNoOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subQuarterWithNoOverflow

```php
public $this subQuarterWithNoOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addQuartersNoOverflow

```php
public $this addQuartersNoOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addQuarterNoOverflow

```php
public $this addQuarterNoOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subQuartersNoOverflow

```php
public $this subQuartersNoOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subQuarterNoOverflow

```php
public $this subQuarterNoOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addWeeks

```php
public $this addWeeks($value = &#039;1&#039;) Add weeks (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addWeek

```php
public $this addWeek($dd one week to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one week to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subWeeks

```php
public $this subWeeks($value = &#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subWeek

```php
public $this subWeek($ub one week to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one week to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addWeekdays

```php
public $this addWeekdays($value = &#039;1&#039;) Add weekdays (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add weekdays (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### addWeekday

```php
public $this addWeekday($dd one weekday to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one weekday to the instance (using date interval` | —  |  |

**Returns:** $this
---

### subWeekdays

```php
public $this subWeekdays($value = &#039;1&#039;) Sub weekdays (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub weekdays (the $value count passed in) to the instance (using date interval` |  |

**Returns:** $this
---

### subWeekday

```php
public $this subWeekday($ub one weekday to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one weekday to the instance (using date interval` | —  |  |

**Returns:** $this
---

### addUTCMicros

```php
public $this addUTCMicros($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCMicro

```php
public $this addUTCMicro($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCMicros

```php
public $this subUTCMicros($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCMicro

```php
public $this subUTCMicro($ub one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### microsUntil

```php
public CarbonPeriod microsUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each microsecond or every X microseconds if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCMicros

```php
public float diffInUTCMicros($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of microseconds.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCMicroseconds

```php
public $this addUTCMicroseconds($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCMicrosecond

```php
public $this addUTCMicrosecond($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCMicroseconds

```php
public $this subUTCMicroseconds($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCMicrosecond

```php
public $this subUTCMicrosecond($ub one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### microsecondsUntil

```php
public CarbonPeriod microsecondsUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each microsecond or every X microseconds if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCMicroseconds

```php
public float diffInUTCMicroseconds($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of microseconds.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCMillis

```php
public $this addUTCMillis($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCMilli

```php
public $this addUTCMilli($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCMillis

```php
public $this subUTCMillis($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCMilli

```php
public $this subUTCMilli($ub one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### millisUntil

```php
public CarbonPeriod millisUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each millisecond or every X milliseconds if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCMillis

```php
public float diffInUTCMillis($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of milliseconds.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCMilliseconds

```php
public $this addUTCMilliseconds($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCMillisecond

```php
public $this addUTCMillisecond($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCMilliseconds

```php
public $this subUTCMilliseconds($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCMillisecond

```php
public $this subUTCMillisecond($ub one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### millisecondsUntil

```php
public CarbonPeriod millisecondsUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each millisecond or every X milliseconds if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCMilliseconds

```php
public float diffInUTCMilliseconds($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of milliseconds.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCSeconds

```php
public $this addUTCSeconds($value = &#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCSecond

```php
public $this addUTCSecond($dd one second to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one second to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCSeconds

```php
public $this subUTCSeconds($value = &#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCSecond

```php
public $this subUTCSecond($ub one second to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one second to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### secondsUntil

```php
public CarbonPeriod secondsUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each second or every X seconds if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCSeconds

```php
public float diffInUTCSeconds($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of seconds.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCMinutes

```php
public $this addUTCMinutes($value = &#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCMinute

```php
public $this addUTCMinute($dd one minute to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one minute to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCMinutes

```php
public $this subUTCMinutes($value = &#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCMinute

```php
public $this subUTCMinute($ub one minute to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one minute to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### minutesUntil

```php
public CarbonPeriod minutesUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each minute or every X minutes if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCMinutes

```php
public float diffInUTCMinutes($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of minutes.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCHours

```php
public $this addUTCHours($value = &#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCHour

```php
public $this addUTCHour($dd one hour to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one hour to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCHours

```php
public $this subUTCHours($value = &#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCHour

```php
public $this subUTCHour($ub one hour to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one hour to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### hoursUntil

```php
public CarbonPeriod hoursUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each hour or every X hours if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCHours

```php
public float diffInUTCHours($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of hours.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCDays

```php
public $this addUTCDays($value = &#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCDay

```php
public $this addUTCDay($dd one day to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one day to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCDays

```php
public $this subUTCDays($value = &#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCDay

```php
public $this subUTCDay($ub one day to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one day to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### daysUntil

```php
public CarbonPeriod daysUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each day or every X days if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCDays

```php
public float diffInUTCDays($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of days.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCWeeks

```php
public $this addUTCWeeks($value = &#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCWeek

```php
public $this addUTCWeek($dd one week to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one week to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCWeeks

```php
public $this subUTCWeeks($value = &#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCWeek

```php
public $this subUTCWeek($ub one week to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one week to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### weeksUntil

```php
public CarbonPeriod weeksUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each week or every X weeks if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCWeeks

```php
public float diffInUTCWeeks($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of weeks.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCMonths

```php
public $this addUTCMonths($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCMonth

```php
public $this addUTCMonth($dd one month to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCMonths

```php
public $this subUTCMonths($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCMonth

```php
public $this subUTCMonth($ub one month to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### monthsUntil

```php
public CarbonPeriod monthsUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each month or every X months if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCMonths

```php
public float diffInUTCMonths($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of months.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCQuarters

```php
public $this addUTCQuarters($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCQuarter

```php
public $this addUTCQuarter($dd one quarter to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCQuarters

```php
public $this subUTCQuarters($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCQuarter

```php
public $this subUTCQuarter($ub one quarter to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### quartersUntil

```php
public CarbonPeriod quartersUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each quarter or every X quarters if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCQuarters

```php
public float diffInUTCQuarters($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of quarters.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCYears

```php
public $this addUTCYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCYear

```php
public $this addUTCYear($dd one year to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCYears

```php
public $this subUTCYears($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCYear

```php
public $this subUTCYear($ub one year to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### yearsUntil

```php
public CarbonPeriod yearsUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each year or every X years if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCYears

```php
public float diffInUTCYears($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of years.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCDecades

```php
public $this addUTCDecades($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCDecade

```php
public $this addUTCDecade($dd one decade to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCDecades

```php
public $this subUTCDecades($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCDecade

```php
public $this subUTCDecade($ub one decade to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### decadesUntil

```php
public CarbonPeriod decadesUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each decade or every X decades if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCDecades

```php
public float diffInUTCDecades($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of decades.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCCenturies

```php
public $this addUTCCenturies($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCCentury

```php
public $this addUTCCentury($dd one century to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCCenturies

```php
public $this subUTCCenturies($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCCentury

```php
public $this subUTCCentury($ub one century to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### centuriesUntil

```php
public CarbonPeriod centuriesUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each century or every X centuries if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCCenturies

```php
public float diffInUTCCenturies($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of centuries.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### addUTCMillennia

```php
public $this addUTCMillennia($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addUTCMillennium

```php
public $this addUTCMillennium($dd one millennium to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subUTCMillennia

```php
public $this subUTCMillennia($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subUTCMillennium

```php
public $this subUTCMillennium($ub one millennium to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### millenniaUntil

```php
public CarbonPeriod millenniaUntil($endDate = &#039;null&#039;, $factor = &#039;1&#039;) Return an iterable period from current date to given end (string, $r Carbon instance)
```

for each millennium or every X millennia if a factor is given.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$endDate` | `&#039;null&#039;` |  |
| int|float | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### diffInUTCMillennia

```php
public float diffInUTCMillennia($date, $absolute = &#039;false&#039;)
```

Convert current and given date in UTC timezone and return a floating number of millennia.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | —  |  |
| bool | `$absolute` | `&#039;false&#039;` |  |

**Returns:** float
---

### roundYear

```php
public $this roundYear($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance year with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundYears

```php
public $this roundYears($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance year with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorYear

```php
public $this floorYear($precision = &#039;1&#039;)
```

Truncate the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorYears

```php
public $this floorYears($precision = &#039;1&#039;)
```

Truncate the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilYear

```php
public $this ceilYear($precision = &#039;1&#039;)
```

Ceil the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilYears

```php
public $this ceilYears($precision = &#039;1&#039;)
```

Ceil the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundMonth

```php
public $this roundMonth($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance month with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundMonths

```php
public $this roundMonths($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance month with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorMonth

```php
public $this floorMonth($precision = &#039;1&#039;)
```

Truncate the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorMonths

```php
public $this floorMonths($precision = &#039;1&#039;)
```

Truncate the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMonth

```php
public $this ceilMonth($precision = &#039;1&#039;)
```

Ceil the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMonths

```php
public $this ceilMonths($precision = &#039;1&#039;)
```

Ceil the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundDay

```php
public $this roundDay($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance day with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundDays

```php
public $this roundDays($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance day with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorDay

```php
public $this floorDay($precision = &#039;1&#039;)
```

Truncate the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorDays

```php
public $this floorDays($precision = &#039;1&#039;)
```

Truncate the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilDay

```php
public $this ceilDay($precision = &#039;1&#039;)
```

Ceil the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilDays

```php
public $this ceilDays($precision = &#039;1&#039;)
```

Ceil the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundHour

```php
public $this roundHour($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance hour with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundHours

```php
public $this roundHours($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance hour with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorHour

```php
public $this floorHour($precision = &#039;1&#039;)
```

Truncate the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorHours

```php
public $this floorHours($precision = &#039;1&#039;)
```

Truncate the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilHour

```php
public $this ceilHour($precision = &#039;1&#039;)
```

Ceil the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilHours

```php
public $this ceilHours($precision = &#039;1&#039;)
```

Ceil the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundMinute

```php
public $this roundMinute($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance minute with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundMinutes

```php
public $this roundMinutes($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance minute with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorMinute

```php
public $this floorMinute($precision = &#039;1&#039;)
```

Truncate the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorMinutes

```php
public $this floorMinutes($precision = &#039;1&#039;)
```

Truncate the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMinute

```php
public $this ceilMinute($precision = &#039;1&#039;)
```

Ceil the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMinutes

```php
public $this ceilMinutes($precision = &#039;1&#039;)
```

Ceil the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundSecond

```php
public $this roundSecond($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance second with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundSeconds

```php
public $this roundSeconds($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance second with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorSecond

```php
public $this floorSecond($precision = &#039;1&#039;)
```

Truncate the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorSeconds

```php
public $this floorSeconds($precision = &#039;1&#039;)
```

Truncate the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilSecond

```php
public $this ceilSecond($precision = &#039;1&#039;)
```

Ceil the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilSeconds

```php
public $this ceilSeconds($precision = &#039;1&#039;)
```

Ceil the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundMillennium

```php
public $this roundMillennium($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millennium with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundMillennia

```php
public $this roundMillennia($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millennium with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorMillennium

```php
public $this floorMillennium($precision = &#039;1&#039;)
```

Truncate the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorMillennia

```php
public $this floorMillennia($precision = &#039;1&#039;)
```

Truncate the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMillennium

```php
public $this ceilMillennium($precision = &#039;1&#039;)
```

Ceil the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMillennia

```php
public $this ceilMillennia($precision = &#039;1&#039;)
```

Ceil the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundCentury

```php
public $this roundCentury($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance century with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundCenturies

```php
public $this roundCenturies($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance century with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorCentury

```php
public $this floorCentury($precision = &#039;1&#039;)
```

Truncate the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorCenturies

```php
public $this floorCenturies($precision = &#039;1&#039;)
```

Truncate the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilCentury

```php
public $this ceilCentury($precision = &#039;1&#039;)
```

Ceil the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilCenturies

```php
public $this ceilCenturies($precision = &#039;1&#039;)
```

Ceil the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundDecade

```php
public $this roundDecade($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance decade with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundDecades

```php
public $this roundDecades($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance decade with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorDecade

```php
public $this floorDecade($precision = &#039;1&#039;)
```

Truncate the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorDecades

```php
public $this floorDecades($precision = &#039;1&#039;)
```

Truncate the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilDecade

```php
public $this ceilDecade($precision = &#039;1&#039;)
```

Ceil the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilDecades

```php
public $this ceilDecades($precision = &#039;1&#039;)
```

Ceil the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundQuarter

```php
public $this roundQuarter($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance quarter with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundQuarters

```php
public $this roundQuarters($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance quarter with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorQuarter

```php
public $this floorQuarter($precision = &#039;1&#039;)
```

Truncate the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorQuarters

```php
public $this floorQuarters($precision = &#039;1&#039;)
```

Truncate the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilQuarter

```php
public $this ceilQuarter($precision = &#039;1&#039;)
```

Ceil the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilQuarters

```php
public $this ceilQuarters($precision = &#039;1&#039;)
```

Ceil the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundMillisecond

```php
public $this roundMillisecond($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millisecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundMilliseconds

```php
public $this roundMilliseconds($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millisecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorMillisecond

```php
public $this floorMillisecond($precision = &#039;1&#039;)
```

Truncate the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorMilliseconds

```php
public $this floorMilliseconds($precision = &#039;1&#039;)
```

Truncate the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMillisecond

```php
public $this ceilMillisecond($precision = &#039;1&#039;)
```

Ceil the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMilliseconds

```php
public $this ceilMilliseconds($precision = &#039;1&#039;)
```

Ceil the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundMicrosecond

```php
public $this roundMicrosecond($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance microsecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundMicroseconds

```php
public $this roundMicroseconds($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance microsecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorMicrosecond

```php
public $this floorMicrosecond($precision = &#039;1&#039;)
```

Truncate the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorMicroseconds

```php
public $this floorMicroseconds($precision = &#039;1&#039;)
```

Truncate the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMicrosecond

```php
public $this ceilMicrosecond($precision = &#039;1&#039;)
```

Ceil the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilMicroseconds

```php
public $this ceilMicroseconds($precision = &#039;1&#039;)
```

Ceil the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### shortAbsoluteDiffForHumans

```php
public string shortAbsoluteDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (short format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (short format` |  |
| &#039;Absolute&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### longAbsoluteDiffForHumans

```php
public string longAbsoluteDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (long format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (long format` |  |
| &#039;Absolute&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### shortRelativeDiffForHumans

```php
public string shortRelativeDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (short format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (short format` |  |
| &#039;Relative&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### longRelativeDiffForHumans

```php
public string longRelativeDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (long format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (long format` |  |
| &#039;Relative&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### shortRelativeToNowDiffForHumans

```php
public string shortRelativeToNowDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (short format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (short format` |  |
| &#039;RelativeToNow&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### longRelativeToNowDiffForHumans

```php
public string longRelativeToNowDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (long format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (long format` |  |
| &#039;RelativeToNow&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### shortRelativeToOtherDiffForHumans

```php
public string shortRelativeToOtherDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (short format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (short format` |  |
| &#039;RelativeToOther&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### longRelativeToOtherDiffForHumans

```php
public string longRelativeToOtherDiffForHumans($other = &#039;null&#039;, $parts = &#039;1&#039;) Get the difference (long format, $ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$other` | `&#039;null&#039;` |  |
| int | `$parts` | `&#039;1&#039;) Get the difference (long format` |  |
| &#039;RelativeToOther&#039; | `$ode) in a human readable format in the current locale. ($other and $parts parameters can be swapped.` | —  |  |

**Returns:** string
---

### centuriesInMillennium

```php
public int centuriesInMillennium()
```

Return the number of centuries contained in the current millennium

**Returns:** int
---

### centuryOfMillennium

```php
public int|static centuryOfMillennium($century = &#039;null&#039;)
```

Return the value of the century starting from the beginning of the current millennium when called with no parameters, change the current century when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$century` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### dayOfCentury

```php
public int|static dayOfCentury($day = &#039;null&#039;)
```

Return the value of the day starting from the beginning of the current century when called with no parameters, change the current day when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$day` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### dayOfDecade

```php
public int|static dayOfDecade($day = &#039;null&#039;)
```

Return the value of the day starting from the beginning of the current decade when called with no parameters, change the current day when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$day` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### dayOfMillennium

```php
public int|static dayOfMillennium($day = &#039;null&#039;)
```

Return the value of the day starting from the beginning of the current millennium when called with no parameters, change the current day when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$day` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### dayOfMonth

```php
public int|static dayOfMonth($day = &#039;null&#039;)
```

Return the value of the day starting from the beginning of the current month when called with no parameters, change the current day when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$day` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### dayOfQuarter

```php
public int|static dayOfQuarter($day = &#039;null&#039;)
```

Return the value of the day starting from the beginning of the current quarter when called with no parameters, change the current day when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$day` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### dayOfWeek

```php
public int|static dayOfWeek($day = &#039;null&#039;)
```

Return the value of the day starting from the beginning of the current week when called with no parameters, change the current day when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$day` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### daysInCentury

```php
public int daysInCentury()
```

Return the number of days contained in the current century

**Returns:** int
---

### daysInDecade

```php
public int daysInDecade()
```

Return the number of days contained in the current decade

**Returns:** int
---

### daysInMillennium

```php
public int daysInMillennium()
```

Return the number of days contained in the current millennium

**Returns:** int
---

### daysInMonth

```php
public int daysInMonth()
```

Return the number of days contained in the current month

**Returns:** int
---

### daysInQuarter

```php
public int daysInQuarter()
```

Return the number of days contained in the current quarter

**Returns:** int
---

### daysInWeek

```php
public int daysInWeek()
```

Return the number of days contained in the current week

**Returns:** int
---

### daysInYear

```php
public int daysInYear()
```

Return the number of days contained in the current year

**Returns:** int
---

### decadeOfCentury

```php
public int|static decadeOfCentury($decade = &#039;null&#039;)
```

Return the value of the decade starting from the beginning of the current century when called with no parameters, change the current decade when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$decade` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### decadeOfMillennium

```php
public int|static decadeOfMillennium($decade = &#039;null&#039;)
```

Return the value of the decade starting from the beginning of the current millennium when called with no parameters, change the current decade when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$decade` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### decadesInCentury

```php
public int decadesInCentury()
```

Return the number of decades contained in the current century

**Returns:** int
---

### decadesInMillennium

```php
public int decadesInMillennium()
```

Return the number of decades contained in the current millennium

**Returns:** int
---

### hourOfCentury

```php
public int|static hourOfCentury($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current century when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hourOfDay

```php
public int|static hourOfDay($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current day when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hourOfDecade

```php
public int|static hourOfDecade($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current decade when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hourOfMillennium

```php
public int|static hourOfMillennium($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current millennium when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hourOfMonth

```php
public int|static hourOfMonth($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current month when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hourOfQuarter

```php
public int|static hourOfQuarter($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current quarter when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hourOfWeek

```php
public int|static hourOfWeek($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current week when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hourOfYear

```php
public int|static hourOfYear($hour = &#039;null&#039;)
```

Return the value of the hour starting from the beginning of the current year when called with no parameters, change the current hour when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$hour` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### hoursInCentury

```php
public int hoursInCentury()
```

Return the number of hours contained in the current century

**Returns:** int
---

### hoursInDay

```php
public int hoursInDay()
```

Return the number of hours contained in the current day

**Returns:** int
---

### hoursInDecade

```php
public int hoursInDecade()
```

Return the number of hours contained in the current decade

**Returns:** int
---

### hoursInMillennium

```php
public int hoursInMillennium()
```

Return the number of hours contained in the current millennium

**Returns:** int
---

### hoursInMonth

```php
public int hoursInMonth()
```

Return the number of hours contained in the current month

**Returns:** int
---

### hoursInQuarter

```php
public int hoursInQuarter()
```

Return the number of hours contained in the current quarter

**Returns:** int
---

### hoursInWeek

```php
public int hoursInWeek()
```

Return the number of hours contained in the current week

**Returns:** int
---

### hoursInYear

```php
public int hoursInYear()
```

Return the number of hours contained in the current year

**Returns:** int
---

### microsecondOfCentury

```php
public int|static microsecondOfCentury($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current century when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfDay

```php
public int|static microsecondOfDay($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current day when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfDecade

```php
public int|static microsecondOfDecade($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current decade when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfHour

```php
public int|static microsecondOfHour($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current hour when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfMillennium

```php
public int|static microsecondOfMillennium($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current millennium when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfMillisecond

```php
public int|static microsecondOfMillisecond($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current millisecond when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfMinute

```php
public int|static microsecondOfMinute($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current minute when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfMonth

```php
public int|static microsecondOfMonth($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current month when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfQuarter

```php
public int|static microsecondOfQuarter($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current quarter when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfSecond

```php
public int|static microsecondOfSecond($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current second when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfWeek

```php
public int|static microsecondOfWeek($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current week when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondOfYear

```php
public int|static microsecondOfYear($microsecond = &#039;null&#039;)
```

Return the value of the microsecond starting from the beginning of the current year when called with no parameters, change the current microsecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$microsecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### microsecondsInCentury

```php
public int microsecondsInCentury()
```

Return the number of microseconds contained in the current century

**Returns:** int
---

### microsecondsInDay

```php
public int microsecondsInDay()
```

Return the number of microseconds contained in the current day

**Returns:** int
---

### microsecondsInDecade

```php
public int microsecondsInDecade()
```

Return the number of microseconds contained in the current decade

**Returns:** int
---

### microsecondsInHour

```php
public int microsecondsInHour()
```

Return the number of microseconds contained in the current hour

**Returns:** int
---

### microsecondsInMillennium

```php
public int microsecondsInMillennium()
```

Return the number of microseconds contained in the current millennium

**Returns:** int
---

### microsecondsInMillisecond

```php
public int microsecondsInMillisecond()
```

Return the number of microseconds contained in the current millisecond

**Returns:** int
---

### microsecondsInMinute

```php
public int microsecondsInMinute()
```

Return the number of microseconds contained in the current minute

**Returns:** int
---

### microsecondsInMonth

```php
public int microsecondsInMonth()
```

Return the number of microseconds contained in the current month

**Returns:** int
---

### microsecondsInQuarter

```php
public int microsecondsInQuarter()
```

Return the number of microseconds contained in the current quarter

**Returns:** int
---

### microsecondsInSecond

```php
public int microsecondsInSecond()
```

Return the number of microseconds contained in the current second

**Returns:** int
---

### microsecondsInWeek

```php
public int microsecondsInWeek()
```

Return the number of microseconds contained in the current week

**Returns:** int
---

### microsecondsInYear

```php
public int microsecondsInYear()
```

Return the number of microseconds contained in the current year

**Returns:** int
---

### millisecondOfCentury

```php
public int|static millisecondOfCentury($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current century when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfDay

```php
public int|static millisecondOfDay($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current day when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfDecade

```php
public int|static millisecondOfDecade($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current decade when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfHour

```php
public int|static millisecondOfHour($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current hour when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfMillennium

```php
public int|static millisecondOfMillennium($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current millennium when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfMinute

```php
public int|static millisecondOfMinute($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current minute when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfMonth

```php
public int|static millisecondOfMonth($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current month when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfQuarter

```php
public int|static millisecondOfQuarter($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current quarter when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfSecond

```php
public int|static millisecondOfSecond($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current second when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfWeek

```php
public int|static millisecondOfWeek($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current week when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondOfYear

```php
public int|static millisecondOfYear($millisecond = &#039;null&#039;)
```

Return the value of the millisecond starting from the beginning of the current year when called with no parameters, change the current millisecond when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$millisecond` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### millisecondsInCentury

```php
public int millisecondsInCentury()
```

Return the number of milliseconds contained in the current century

**Returns:** int
---

### millisecondsInDay

```php
public int millisecondsInDay()
```

Return the number of milliseconds contained in the current day

**Returns:** int
---

### millisecondsInDecade

```php
public int millisecondsInDecade()
```

Return the number of milliseconds contained in the current decade

**Returns:** int
---

### millisecondsInHour

```php
public int millisecondsInHour()
```

Return the number of milliseconds contained in the current hour

**Returns:** int
---

### millisecondsInMillennium

```php
public int millisecondsInMillennium()
```

Return the number of milliseconds contained in the current millennium

**Returns:** int
---

### millisecondsInMinute

```php
public int millisecondsInMinute()
```

Return the number of milliseconds contained in the current minute

**Returns:** int
---

### millisecondsInMonth

```php
public int millisecondsInMonth()
```

Return the number of milliseconds contained in the current month

**Returns:** int
---

### millisecondsInQuarter

```php
public int millisecondsInQuarter()
```

Return the number of milliseconds contained in the current quarter

**Returns:** int
---

### millisecondsInSecond

```php
public int millisecondsInSecond()
```

Return the number of milliseconds contained in the current second

**Returns:** int
---

### millisecondsInWeek

```php
public int millisecondsInWeek()
```

Return the number of milliseconds contained in the current week

**Returns:** int
---

### millisecondsInYear

```php
public int millisecondsInYear()
```

Return the number of milliseconds contained in the current year

**Returns:** int
---

### minuteOfCentury

```php
public int|static minuteOfCentury($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current century when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfDay

```php
public int|static minuteOfDay($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current day when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfDecade

```php
public int|static minuteOfDecade($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current decade when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfHour

```php
public int|static minuteOfHour($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current hour when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfMillennium

```php
public int|static minuteOfMillennium($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current millennium when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfMonth

```php
public int|static minuteOfMonth($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current month when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfQuarter

```php
public int|static minuteOfQuarter($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current quarter when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfWeek

```php
public int|static minuteOfWeek($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current week when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minuteOfYear

```php
public int|static minuteOfYear($minute = &#039;null&#039;)
```

Return the value of the minute starting from the beginning of the current year when called with no parameters, change the current minute when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$minute` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### minutesInCentury

```php
public int minutesInCentury()
```

Return the number of minutes contained in the current century

**Returns:** int
---

### minutesInDay

```php
public int minutesInDay()
```

Return the number of minutes contained in the current day

**Returns:** int
---

### minutesInDecade

```php
public int minutesInDecade()
```

Return the number of minutes contained in the current decade

**Returns:** int
---

### minutesInHour

```php
public int minutesInHour()
```

Return the number of minutes contained in the current hour

**Returns:** int
---

### minutesInMillennium

```php
public int minutesInMillennium()
```

Return the number of minutes contained in the current millennium

**Returns:** int
---

### minutesInMonth

```php
public int minutesInMonth()
```

Return the number of minutes contained in the current month

**Returns:** int
---

### minutesInQuarter

```php
public int minutesInQuarter()
```

Return the number of minutes contained in the current quarter

**Returns:** int
---

### minutesInWeek

```php
public int minutesInWeek()
```

Return the number of minutes contained in the current week

**Returns:** int
---

### minutesInYear

```php
public int minutesInYear()
```

Return the number of minutes contained in the current year

**Returns:** int
---

### monthOfCentury

```php
public int|static monthOfCentury($month = &#039;null&#039;)
```

Return the value of the month starting from the beginning of the current century when called with no parameters, change the current month when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$month` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### monthOfDecade

```php
public int|static monthOfDecade($month = &#039;null&#039;)
```

Return the value of the month starting from the beginning of the current decade when called with no parameters, change the current month when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$month` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### monthOfMillennium

```php
public int|static monthOfMillennium($month = &#039;null&#039;)
```

Return the value of the month starting from the beginning of the current millennium when called with no parameters, change the current month when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$month` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### monthOfQuarter

```php
public int|static monthOfQuarter($month = &#039;null&#039;)
```

Return the value of the month starting from the beginning of the current quarter when called with no parameters, change the current month when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$month` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### monthOfYear

```php
public int|static monthOfYear($month = &#039;null&#039;)
```

Return the value of the month starting from the beginning of the current year when called with no parameters, change the current month when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$month` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### monthsInCentury

```php
public int monthsInCentury()
```

Return the number of months contained in the current century

**Returns:** int
---

### monthsInDecade

```php
public int monthsInDecade()
```

Return the number of months contained in the current decade

**Returns:** int
---

### monthsInMillennium

```php
public int monthsInMillennium()
```

Return the number of months contained in the current millennium

**Returns:** int
---

### monthsInQuarter

```php
public int monthsInQuarter()
```

Return the number of months contained in the current quarter

**Returns:** int
---

### monthsInYear

```php
public int monthsInYear()
```

Return the number of months contained in the current year

**Returns:** int
---

### quarterOfCentury

```php
public int|static quarterOfCentury($quarter = &#039;null&#039;)
```

Return the value of the quarter starting from the beginning of the current century when called with no parameters, change the current quarter when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$quarter` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### quarterOfDecade

```php
public int|static quarterOfDecade($quarter = &#039;null&#039;)
```

Return the value of the quarter starting from the beginning of the current decade when called with no parameters, change the current quarter when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$quarter` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### quarterOfMillennium

```php
public int|static quarterOfMillennium($quarter = &#039;null&#039;)
```

Return the value of the quarter starting from the beginning of the current millennium when called with no parameters, change the current quarter when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$quarter` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### quarterOfYear

```php
public int|static quarterOfYear($quarter = &#039;null&#039;)
```

Return the value of the quarter starting from the beginning of the current year when called with no parameters, change the current quarter when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$quarter` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### quartersInCentury

```php
public int quartersInCentury()
```

Return the number of quarters contained in the current century

**Returns:** int
---

### quartersInDecade

```php
public int quartersInDecade()
```

Return the number of quarters contained in the current decade

**Returns:** int
---

### quartersInMillennium

```php
public int quartersInMillennium()
```

Return the number of quarters contained in the current millennium

**Returns:** int
---

### quartersInYear

```php
public int quartersInYear()
```

Return the number of quarters contained in the current year

**Returns:** int
---

### secondOfCentury

```php
public int|static secondOfCentury($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current century when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfDay

```php
public int|static secondOfDay($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current day when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfDecade

```php
public int|static secondOfDecade($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current decade when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfHour

```php
public int|static secondOfHour($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current hour when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfMillennium

```php
public int|static secondOfMillennium($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current millennium when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfMinute

```php
public int|static secondOfMinute($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current minute when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfMonth

```php
public int|static secondOfMonth($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current month when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfQuarter

```php
public int|static secondOfQuarter($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current quarter when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfWeek

```php
public int|static secondOfWeek($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current week when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondOfYear

```php
public int|static secondOfYear($second = &#039;null&#039;)
```

Return the value of the second starting from the beginning of the current year when called with no parameters, change the current second when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$second` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### secondsInCentury

```php
public int secondsInCentury()
```

Return the number of seconds contained in the current century

**Returns:** int
---

### secondsInDay

```php
public int secondsInDay()
```

Return the number of seconds contained in the current day

**Returns:** int
---

### secondsInDecade

```php
public int secondsInDecade()
```

Return the number of seconds contained in the current decade

**Returns:** int
---

### secondsInHour

```php
public int secondsInHour()
```

Return the number of seconds contained in the current hour

**Returns:** int
---

### secondsInMillennium

```php
public int secondsInMillennium()
```

Return the number of seconds contained in the current millennium

**Returns:** int
---

### secondsInMinute

```php
public int secondsInMinute()
```

Return the number of seconds contained in the current minute

**Returns:** int
---

### secondsInMonth

```php
public int secondsInMonth()
```

Return the number of seconds contained in the current month

**Returns:** int
---

### secondsInQuarter

```php
public int secondsInQuarter()
```

Return the number of seconds contained in the current quarter

**Returns:** int
---

### secondsInWeek

```php
public int secondsInWeek()
```

Return the number of seconds contained in the current week

**Returns:** int
---

### secondsInYear

```php
public int secondsInYear()
```

Return the number of seconds contained in the current year

**Returns:** int
---

### weekOfCentury

```php
public int|static weekOfCentury($week = &#039;null&#039;)
```

Return the value of the week starting from the beginning of the current century when called with no parameters, change the current week when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$week` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### weekOfDecade

```php
public int|static weekOfDecade($week = &#039;null&#039;)
```

Return the value of the week starting from the beginning of the current decade when called with no parameters, change the current week when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$week` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### weekOfMillennium

```php
public int|static weekOfMillennium($week = &#039;null&#039;)
```

Return the value of the week starting from the beginning of the current millennium when called with no parameters, change the current week when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$week` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### weekOfMonth

```php
public int|static weekOfMonth($week = &#039;null&#039;)
```

Return the value of the week starting from the beginning of the current month when called with no parameters, change the current week when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$week` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### weekOfQuarter

```php
public int|static weekOfQuarter($week = &#039;null&#039;)
```

Return the value of the week starting from the beginning of the current quarter when called with no parameters, change the current week when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$week` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### weekOfYear

```php
public int|static weekOfYear($week = &#039;null&#039;)
```

Return the value of the week starting from the beginning of the current year when called with no parameters, change the current week when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$week` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### weeksInCentury

```php
public int weeksInCentury()
```

Return the number of weeks contained in the current century

**Returns:** int
---

### weeksInDecade

```php
public int weeksInDecade()
```

Return the number of weeks contained in the current decade

**Returns:** int
---

### weeksInMillennium

```php
public int weeksInMillennium()
```

Return the number of weeks contained in the current millennium

**Returns:** int
---

### weeksInMonth

```php
public int weeksInMonth()
```

Return the number of weeks contained in the current month

**Returns:** int
---

### weeksInQuarter

```php
public int weeksInQuarter()
```

Return the number of weeks contained in the current quarter

**Returns:** int
---

### yearOfCentury

```php
public int|static yearOfCentury($year = &#039;null&#039;)
```

Return the value of the year starting from the beginning of the current century when called with no parameters, change the current year when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$year` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### yearOfDecade

```php
public int|static yearOfDecade($year = &#039;null&#039;)
```

Return the value of the year starting from the beginning of the current decade when called with no parameters, change the current year when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$year` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### yearOfMillennium

```php
public int|static yearOfMillennium($year = &#039;null&#039;)
```

Return the value of the year starting from the beginning of the current millennium when called with no parameters, change the current year when called with an integer value

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ?int | `$year` | `&#039;null&#039;` |  |

**Returns:** int|static
---

### yearsInCentury

```php
public int yearsInCentury()
```

Return the number of years contained in the current century

**Returns:** int
---

### yearsInDecade

```php
public int yearsInDecade()
```

Return the number of years contained in the current decade

**Returns:** int
---

### yearsInMillennium

```php
public int yearsInMillennium()
```

Return the number of years contained in the current millennium

</autodoc>

**Returns:** int
---

### factory

```php
static public Factory factory($date_time = null, $time_zone = null)
```

DateTimeオブジェクトの生成

日付/時刻 文字列の書式については http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式 を参考にしてください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date_time` | `null` | 日付/時刻 文字列。DateTimeオブジェクト |
| [DateTimeZone](https://www.php.net/class.datetimezone)\|null | `$time_zone` | `null` | DateTimeZone オブジェクトか、時差の時間、タイムゾーンテキスト(omit 予定) |

**Returns:** [Factory](../JapaneseDate/Traits/Factory.md)
**Throws:**

- NativeDateTimeException
---

### setCacheMode

```php
static public void setCacheMode($mode)
```

キャッシュモードを指定する

指定するキャッシュモードは、{\JapaneseDate\CacheMode}参照。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$mode` | —  | キャッシュモード |

**Returns:** void
**See also:**

- CacheMode::MODE_AUTO — 自動でキャッシュモードを選択
- CacheMode::MODE_APC — APCを使用したキャッシュ
- CacheMode::MODE_FILE — ファイルを使用したキャッシュ
- CacheMode::MODE_ORIGINAL — 独自キャッシュ
- CacheMode::MODE_NONE — キャッシュなし
---

### setCacheFilePath

```php
static public void setCacheFilePath($cache_file_path)
```

キャッシュファイル保存ディレクトリをセットします

キャッシュモードがファイル{[\JapaneseDate\CacheMode::MODE_FILE}の時に使用する、キャッシュファイル保存ディレクトリをセットします。](../JapaneseDate/CacheMode.html)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$cache_file_path` | —  | キャッシュファイルを保存するディレクトリ |

**Returns:** void
---

### setCacheClosure

```php
static public void setCacheClosure($function)
```

独自キャッシュロジックのセット

キャッシュモードが独自キャッシュ{[\JapaneseDate\CacheMode::MODE_ORIGINAL}の時に使用する、クロージャをセットします。

セットされるクロージャは、

mixed](../JapaneseDate/CacheMode.html) ClosureFunction(string $key, Closure $function)

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **string** | キャッシュ単位の一意なキー。このキーにマッチしたキャッシュデータが有る場合は、キャッシュされたデータをreturnしてください。 |
| `$function` | **\Closure** | キャッシュされたデータが取得できない場合に実行するクロージャです。実行すれば、キャッシュするべきデータが返されます。 |

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [Closure](https://www.php.net/class.closure) | `$function` | —  | 独自キャッシュのロジックが含まれたクロージャ |

**Returns:** void
---

### nextHoliday

```php
public Modifier nextHoliday()
```

次の祝日にする

**Returns:** [Modifier](../JapaneseDate/Traits/Modifier.md)
---

### nextSixWeek

```php
public Modifier nextSixWeek($week_day)
```

指定された次の六曜にする

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$week_day` | —  |  |

**Returns:** [Modifier](../JapaneseDate/Traits/Modifier.md)
---

### getCalendar

```php
public array getCalendar($calendar = CAL_GREGORIAN)
```

サポートされるカレンダーに変換する

サポートされる $calendar の値は、 CAL_GREGORIAN、 CAL_JULIAN、 CAL_JEWISH および CAL_FRENCH です。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$calendar` | `CAL_GREGORIAN` | サポートされるカレンダー |

**Returns:** array — カレンダーの情報を含む配列を返します。この配列には、 年、月、日、週、曜日名、月名、"月/日/年" 形式の文字列 などが含まれます。
---

