# DateTimeImmutable

**Namespace:** `JapaneseDate`

class **DateTimeImmutable** extends [CarbonImmutable](../Carbon/CarbonImmutable.md) implements [DateTimeInterface](../JapaneseDate/DateTimeInterface.md)

日本の暦（祝日・元号・六曜・二十四節気）に完全対応したDateTimeImmutable拡張クラス。

日時操作ライブラリである [\Carbon\CarbonImmutable](../Carbon/CarbonImmutable.html) をベースに、
日本のビジネスシーンや伝統的な暦（和暦）の計算に必要となる判定・取得機能をシームレスに統合しています。

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

【不変性（Immutability）】
本クラスはイミュータブルオブジェクトです。日時の加算・減算や変更を行うメソッドを呼び出した場合、
自身の状態を変更せず、常に新しい変更済みのインスタンスを返します。

本クラスは [\Carbon\CarbonImmutable](../Carbon/CarbonImmutable.html) のすべてのメソッド・プロパティを継承しているため、
既存のインスタンスと同様のメソッドチェーンがそのまま利用可能です。

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
| public | string | `$localeDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the day of week in current locale |
| public | string | `$shortLocaleDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated day of week in current locale |
| public | string | `$localeMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the month in current locale |
| public | string | `$shortLocaleMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated month in current locale |
| public | int | `$year` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$yearIso` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$month` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$day` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$hour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$minute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$second` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$micro` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$microsecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$dayOfWeekIso` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 (for Monday) through 7 (for Sunday) |
| public | int\|float\|string | `$timestamp` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | seconds since the Unix Epoch |
| public | string | `$englishDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the day of week in English |
| public | string | `$shortEnglishDayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated day of week in English |
| public | string | `$englishMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the month in English |
| public | string | `$shortEnglishMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the abbreviated month in English |
| public | int | `$milliseconds` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$millisecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$milli` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| public | int | `$week` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 53 |
| public | int | `$isoWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 53 |
| public | int | `$weekYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | year according to week format |
| public | int | `$isoWeekYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | year according to ISO week format |
| public | int | `$age` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | does a diffInYears() with default parameters |
| public | int | `$offset` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the timezone offset in seconds from UTC |
| public | int | `$offsetMinutes` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the timezone offset in minutes from UTC |
| public | int | `$offsetHours` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the timezone offset in hours from UTC |
| public | CarbonTimeZone | `$timezone` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the current timezone |
| public | CarbonTimeZone | `$tz` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | alias of $timezone |
| public | int | `$centuryOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the century starting from the beginning of the current millennium |
| public | int | `$dayOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current century |
| public | int | `$dayOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current decade |
| public | int | `$dayOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current millennium |
| public | int | `$dayOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current month |
| public | int | `$dayOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the day starting from the beginning of the current quarter |
| public | int | `$dayOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 0 (for Sunday) through 6 (for Saturday) |
| public | int | `$dayOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 366 |
| public | int | `$decadeOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the decade starting from the beginning of the current century |
| public | int | `$decadeOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the decade starting from the beginning of the current millennium |
| public | int | `$hourOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current century |
| public | int | `$hourOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current day |
| public | int | `$hourOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current decade |
| public | int | `$hourOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current millennium |
| public | int | `$hourOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current month |
| public | int | `$hourOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current quarter |
| public | int | `$hourOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current week |
| public | int | `$hourOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the hour starting from the beginning of the current year |
| public | int | `$microsecondOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current century |
| public | int | `$microsecondOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current day |
| public | int | `$microsecondOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current decade |
| public | int | `$microsecondOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current hour |
| public | int | `$microsecondOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current millennium |
| public | int | `$microsecondOfMillisecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current millisecond |
| public | int | `$microsecondOfMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current minute |
| public | int | `$microsecondOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current month |
| public | int | `$microsecondOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current quarter |
| public | int | `$microsecondOfSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current second |
| public | int | `$microsecondOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current week |
| public | int | `$microsecondOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the microsecond starting from the beginning of the current year |
| public | int | `$millisecondOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current century |
| public | int | `$millisecondOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current day |
| public | int | `$millisecondOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current decade |
| public | int | `$millisecondOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current hour |
| public | int | `$millisecondOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current millennium |
| public | int | `$millisecondOfMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current minute |
| public | int | `$millisecondOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current month |
| public | int | `$millisecondOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current quarter |
| public | int | `$millisecondOfSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current second |
| public | int | `$millisecondOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current week |
| public | int | `$millisecondOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the millisecond starting from the beginning of the current year |
| public | int | `$minuteOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current century |
| public | int | `$minuteOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current day |
| public | int | `$minuteOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current decade |
| public | int | `$minuteOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current hour |
| public | int | `$minuteOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current millennium |
| public | int | `$minuteOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current month |
| public | int | `$minuteOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current quarter |
| public | int | `$minuteOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current week |
| public | int | `$minuteOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the minute starting from the beginning of the current year |
| public | int | `$monthOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current century |
| public | int | `$monthOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current decade |
| public | int | `$monthOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current millennium |
| public | int | `$monthOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current quarter |
| public | int | `$monthOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the month starting from the beginning of the current year |
| public | int | `$quarterOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current century |
| public | int | `$quarterOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current decade |
| public | int | `$quarterOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current millennium |
| public | int | `$quarterOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the quarter starting from the beginning of the current year |
| public | int | `$secondOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current century |
| public | int | `$secondOfDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current day |
| public | int | `$secondOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current decade |
| public | int | `$secondOfHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current hour |
| public | int | `$secondOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current millennium |
| public | int | `$secondOfMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current minute |
| public | int | `$secondOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current month |
| public | int | `$secondOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current quarter |
| public | int | `$secondOfWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current week |
| public | int | `$secondOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the second starting from the beginning of the current year |
| public | int | `$weekOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current century |
| public | int | `$weekOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current decade |
| public | int | `$weekOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current millennium |
| public | int | `$weekOfMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 5 |
| public | int | `$weekOfQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the week starting from the beginning of the current quarter |
| public | int | `$weekOfYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | ISO-8601 week number of year, weeks starting on Monday |
| public | int | `$yearOfCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the year starting from the beginning of the current century |
| public | int | `$yearOfDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the year starting from the beginning of the current decade |
| public | int | `$yearOfMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The value of the year starting from the beginning of the current millennium |
| public _(read-only)_ | string | `$latinMeridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | "am"/"pm" (Ante meridiem or Post meridiem latin lowercase mark) |
| public _(read-only)_ | string | `$latinUpperMeridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | "AM"/"PM" (Ante meridiem or Post meridiem latin uppercase mark) |
| public _(read-only)_ | string | `$timezoneAbbreviatedName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the current timezone abbreviated name |
| public _(read-only)_ | string | `$tzAbbrName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | alias of $timezoneAbbreviatedName |
| public _(read-only)_ | string | `$dayName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | long name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortDayName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$minDayName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | very short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$monthName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | long name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortMonthName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | short name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$meridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | lowercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | string | `$upperMeridiem` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | uppercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | int | `$noZeroHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | current hour from 1 to 24 |
| public _(read-only)_ | int | `$isoWeeksInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$weekNumberInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 1 through 5 |
| public _(read-only)_ | int | `$firstWeekDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$lastWeekDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 0 through 6 |
| public _(read-only)_ | int | `$quarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the quarter of this instance, 1 - 4 |
| public _(read-only)_ | int | `$decade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the decade of this instance |
| public _(read-only)_ | int | `$century` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the century of this instance |
| public _(read-only)_ | int | `$millennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the millennium of this instance |
| public _(read-only)_ | bool | `$dst` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | daylight savings time indicator, true if DST, false otherwise |
| public _(read-only)_ | bool | `$local` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | checks if the timezone is local, true if local, false otherwise |
| public _(read-only)_ | bool | `$utc` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | checks if the timezone is UTC, true if UTC, false otherwise |
| public _(read-only)_ | string | `$timezoneName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | the current timezone name |
| public _(read-only)_ | string | `$tzName` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | alias of $timezoneName |
| public _(read-only)_ | string | `$locale` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | locale of the current instance |
| public _(read-only)_ | int | `$centuriesInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of centuries contained in the current millennium |
| public _(read-only)_ | int | `$daysInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current century |
| public _(read-only)_ | int | `$daysInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current decade |
| public _(read-only)_ | int | `$daysInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current millennium |
| public _(read-only)_ | int | `$daysInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | number of days in the given month |
| public _(read-only)_ | int | `$daysInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current quarter |
| public _(read-only)_ | int | `$daysInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of days contained in the current week |
| public _(read-only)_ | int | `$daysInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 365 or 366 |
| public _(read-only)_ | int | `$decadesInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of decades contained in the current century |
| public _(read-only)_ | int | `$decadesInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of decades contained in the current millennium |
| public _(read-only)_ | int | `$hoursInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current century |
| public _(read-only)_ | int | `$hoursInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current day |
| public _(read-only)_ | int | `$hoursInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current decade |
| public _(read-only)_ | int | `$hoursInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current millennium |
| public _(read-only)_ | int | `$hoursInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current month |
| public _(read-only)_ | int | `$hoursInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current quarter |
| public _(read-only)_ | int | `$hoursInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current week |
| public _(read-only)_ | int | `$hoursInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of hours contained in the current year |
| public _(read-only)_ | int | `$microsecondsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current century |
| public _(read-only)_ | int | `$microsecondsInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current day |
| public _(read-only)_ | int | `$microsecondsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current decade |
| public _(read-only)_ | int | `$microsecondsInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current hour |
| public _(read-only)_ | int | `$microsecondsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current millennium |
| public _(read-only)_ | int | `$microsecondsInMillisecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current millisecond |
| public _(read-only)_ | int | `$microsecondsInMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current minute |
| public _(read-only)_ | int | `$microsecondsInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current month |
| public _(read-only)_ | int | `$microsecondsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current quarter |
| public _(read-only)_ | int | `$microsecondsInSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current second |
| public _(read-only)_ | int | `$microsecondsInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current week |
| public _(read-only)_ | int | `$microsecondsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of microseconds contained in the current year |
| public _(read-only)_ | int | `$millisecondsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current century |
| public _(read-only)_ | int | `$millisecondsInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current day |
| public _(read-only)_ | int | `$millisecondsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current decade |
| public _(read-only)_ | int | `$millisecondsInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current hour |
| public _(read-only)_ | int | `$millisecondsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current millennium |
| public _(read-only)_ | int | `$millisecondsInMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current minute |
| public _(read-only)_ | int | `$millisecondsInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current month |
| public _(read-only)_ | int | `$millisecondsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current quarter |
| public _(read-only)_ | int | `$millisecondsInSecond` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current second |
| public _(read-only)_ | int | `$millisecondsInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current week |
| public _(read-only)_ | int | `$millisecondsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of milliseconds contained in the current year |
| public _(read-only)_ | int | `$minutesInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current century |
| public _(read-only)_ | int | `$minutesInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current day |
| public _(read-only)_ | int | `$minutesInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current decade |
| public _(read-only)_ | int | `$minutesInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current hour |
| public _(read-only)_ | int | `$minutesInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current millennium |
| public _(read-only)_ | int | `$minutesInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current month |
| public _(read-only)_ | int | `$minutesInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current quarter |
| public _(read-only)_ | int | `$minutesInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current week |
| public _(read-only)_ | int | `$minutesInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of minutes contained in the current year |
| public _(read-only)_ | int | `$monthsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current century |
| public _(read-only)_ | int | `$monthsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current decade |
| public _(read-only)_ | int | `$monthsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current millennium |
| public _(read-only)_ | int | `$monthsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current quarter |
| public _(read-only)_ | int | `$monthsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of months contained in the current year |
| public _(read-only)_ | int | `$quartersInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current century |
| public _(read-only)_ | int | `$quartersInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current decade |
| public _(read-only)_ | int | `$quartersInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current millennium |
| public _(read-only)_ | int | `$quartersInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of quarters contained in the current year |
| public _(read-only)_ | int | `$secondsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current century |
| public _(read-only)_ | int | `$secondsInDay` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current day |
| public _(read-only)_ | int | `$secondsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current decade |
| public _(read-only)_ | int | `$secondsInHour` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current hour |
| public _(read-only)_ | int | `$secondsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current millennium |
| public _(read-only)_ | int | `$secondsInMinute` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current minute |
| public _(read-only)_ | int | `$secondsInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current month |
| public _(read-only)_ | int | `$secondsInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current quarter |
| public _(read-only)_ | int | `$secondsInWeek` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current week |
| public _(read-only)_ | int | `$secondsInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of seconds contained in the current year |
| public _(read-only)_ | int | `$weeksInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current century |
| public _(read-only)_ | int | `$weeksInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current decade |
| public _(read-only)_ | int | `$weeksInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current millennium |
| public _(read-only)_ | int | `$weeksInMonth` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current month |
| public _(read-only)_ | int | `$weeksInQuarter` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of weeks contained in the current quarter |
| public _(read-only)_ | int | `$weeksInYear` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | 51 through 53 |
| public _(read-only)_ | int | `$yearsInCentury` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of years contained in the current century |
| public _(read-only)_ | int | `$yearsInDecade` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of years contained in the current decade |
| public _(read-only)_ | int | `$yearsInMillennium` _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | The number of years contained in the current millennium |
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
| CarbonImmutable | [startOfTime()](#startoftime) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Create a very old date representing start of time. |
| CarbonImmutable | [endOfTime()](#endoftime) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Create a very far date representing end of time. |
| bool | [isUtc()](#isutc) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| bool | [isLocal()](#islocal) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Check if the current instance has non-UTC timezone. |
| bool | [isValid()](#isvalid) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Check if the current instance is a valid date. |
| bool | [isDST()](#isdst) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Check if the current instance is in a daylight saving time. |
| bool | [isSunday()](#issunday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is sunday. |
| bool | [isMonday()](#ismonday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is monday. |
| bool | [isTuesday()](#istuesday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is tuesday. |
| bool | [isWednesday()](#iswednesday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is wednesday. |
| bool | [isThursday()](#isthursday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is thursday. |
| bool | [isFriday()](#isfriday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is friday. |
| bool | [isSaturday()](#issaturday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance day is saturday. |
| bool | [isSameYear()](#issameyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentYear()](#iscurrentyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same year as the current moment. |
| bool | [isNextYear()](#isnextyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same year as the current moment next year. |
| bool | [isLastYear()](#islastyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same year as the current moment last year. |
| bool | [isCurrentMonth()](#iscurrentmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same month as the current moment. |
| bool | [isNextMonth()](#isnextmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same month as the current moment next month. |
| bool | [isLastMonth()](#islastmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same month as the current moment last month. |
| bool | [isSameWeek()](#issameweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentWeek()](#iscurrentweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same week as the current moment. |
| bool | [isNextWeek()](#isnextweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same week as the current moment next week. |
| bool | [isLastWeek()](#islastweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same week as the current moment last week. |
| bool | [isSameDay()](#issameday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentDay()](#iscurrentday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same day as the current moment. |
| bool | [isNextDay()](#isnextday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same day as the current moment next day. |
| bool | [isLastDay()](#islastday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same day as the current moment last day. |
| bool | [isSameHour()](#issamehour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentHour()](#iscurrenthour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same hour as the current moment. |
| bool | [isNextHour()](#isnexthour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same hour as the current moment next hour. |
| bool | [isLastHour()](#islasthour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same hour as the current moment last hour. |
| bool | [isSameMinute()](#issameminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentMinute()](#iscurrentminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same minute as the current moment. |
| bool | [isNextMinute()](#isnextminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same minute as the current moment next minute. |
| bool | [isLastMinute()](#islastminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same minute as the current moment last minute. |
| bool | [isSameSecond()](#issamesecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentSecond()](#iscurrentsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same second as the current moment. |
| bool | [isNextSecond()](#isnextsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same second as the current moment next second. |
| bool | [isLastSecond()](#islastsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same second as the current moment last second. |
| bool | [isSameMilli()](#issamemilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentMilli()](#iscurrentmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [isNextMilli()](#isnextmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [isLastMilli()](#islastmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [isSameMillisecond()](#issamemillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentMillisecond()](#iscurrentmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment. |
| bool | [isNextMillisecond()](#isnextmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment next millisecond. |
| bool | [isLastMillisecond()](#islastmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millisecond as the current moment last millisecond. |
| bool | [isSameMicro()](#issamemicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentMicro()](#iscurrentmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [isNextMicro()](#isnextmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [isLastMicro()](#islastmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [isSameMicrosecond()](#issamemicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentMicrosecond()](#iscurrentmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment. |
| bool | [isNextMicrosecond()](#isnextmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [isLastMicrosecond()](#islastmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [isSameDecade()](#issamedecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentDecade()](#iscurrentdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same decade as the current moment. |
| bool | [isNextDecade()](#isnextdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same decade as the current moment next decade. |
| bool | [isLastDecade()](#islastdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same decade as the current moment last decade. |
| bool | [isSameCentury()](#issamecentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentCentury()](#iscurrentcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same century as the current moment. |
| bool | [isNextCentury()](#isnextcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same century as the current moment next century. |
| bool | [isLastCentury()](#islastcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same century as the current moment last century. |
| bool | [isSameMillennium()](#issamemillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| bool | [isCurrentMillennium()](#iscurrentmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millennium as the current moment. |
| bool | [isNextMillennium()](#isnextmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millennium as the current moment next millennium. |
| bool | [isLastMillennium()](#islastmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same millennium as the current moment last millennium. |
| bool | [isCurrentQuarter()](#iscurrentquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same quarter as the current moment. |
| bool | [isNextQuarter()](#isnextquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same quarter as the current moment next quarter. |
| bool | [isLastQuarter()](#islastquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Checks if the instance is in the same quarter as the current moment last quarter. |
| CarbonImmutable | [years()](#years) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [year()](#year) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [setYears()](#setyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [setYear()](#setyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance year to the given value. |
| CarbonImmutable | [months()](#months) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [month()](#month) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [setMonths()](#setmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [setMonth()](#setmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance month to the given value. |
| CarbonImmutable | [days()](#days) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [day()](#day) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [setDays()](#setdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [setDay()](#setday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance day to the given value. |
| CarbonImmutable | [hours()](#hours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [hour()](#hour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [setHours()](#sethours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [setHour()](#sethour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance hour to the given value. |
| CarbonImmutable | [minutes()](#minutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [minute()](#minute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [setMinutes()](#setminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [setMinute()](#setminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance minute to the given value. |
| CarbonImmutable | [seconds()](#seconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [second()](#second) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [setSeconds()](#setseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [setSecond()](#setsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance second to the given value. |
| CarbonImmutable | [millis()](#millis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [milli()](#milli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMillis()](#setmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMilli()](#setmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [milliseconds()](#milliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [millisecond()](#millisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMilliseconds()](#setmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMillisecond()](#setmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance millisecond to the given value. |
| CarbonImmutable | [micros()](#micros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [micro()](#micro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [setMicros()](#setmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [setMicro()](#setmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [microseconds()](#microseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [microsecond()](#microsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [setMicroseconds()](#setmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| self | [setMicrosecond()](#setmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Set current instance microsecond to the given value. |
| CarbonImmutable | [addYears()](#addyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addYear()](#addyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subYears()](#subyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subYear()](#subyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addYearsWithOverflow()](#addyearswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addYearWithOverflow()](#addyearwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subYearsWithOverflow()](#subyearswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subYearWithOverflow()](#subyearwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addYearsWithoutOverflow()](#addyearswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearWithoutOverflow()](#addyearwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearsWithoutOverflow()](#subyearswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearWithoutOverflow()](#subyearwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearsWithNoOverflow()](#addyearswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearWithNoOverflow()](#addyearwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearsWithNoOverflow()](#subyearswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearWithNoOverflow()](#subyearwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearsNoOverflow()](#addyearsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearNoOverflow()](#addyearnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearsNoOverflow()](#subyearsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearNoOverflow()](#subyearnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonths()](#addmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMonth()](#addmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMonths()](#submonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMonth()](#submonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMonthsWithOverflow()](#addmonthswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addMonthWithOverflow()](#addmonthwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subMonthsWithOverflow()](#submonthswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subMonthWithOverflow()](#submonthwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addMonthsWithoutOverflow()](#addmonthswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthWithoutOverflow()](#addmonthwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthsWithoutOverflow()](#submonthswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthWithoutOverflow()](#submonthwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthsWithNoOverflow()](#addmonthswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthWithNoOverflow()](#addmonthwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthsWithNoOverflow()](#submonthswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthWithNoOverflow()](#submonthwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthsNoOverflow()](#addmonthsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthNoOverflow()](#addmonthnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthsNoOverflow()](#submonthsnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthNoOverflow()](#submonthnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addDays()](#adddays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addDay()](#addday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subDays()](#subdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subDay()](#subday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addHours()](#addhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addHour()](#addhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subHours()](#subhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subHour()](#subhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMinutes()](#addminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMinute()](#addminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMinutes()](#subminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMinute()](#subminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addSeconds()](#addseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addSecond()](#addsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subSeconds()](#subseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subSecond()](#subsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMillis()](#addmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMilli()](#addmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMillis()](#submillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMilli()](#submilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMilliseconds()](#addmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMillisecond()](#addmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMilliseconds()](#submilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMillisecond()](#submillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMicros()](#addmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMicro()](#addmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMicros()](#submicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMicro()](#submicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMicroseconds()](#addmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMicrosecond()](#addmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMicroseconds()](#submicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMicrosecond()](#submicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMillennia()](#addmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMillennium()](#addmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMillennia()](#submillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subMillennium()](#submillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addMillenniaWithOverflow()](#addmillenniawithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addMillenniumWithOverflow()](#addmillenniumwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subMillenniaWithOverflow()](#submillenniawithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subMillenniumWithOverflow()](#submillenniumwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addMillenniaWithoutOverflow()](#addmillenniawithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniumWithoutOverflow()](#addmillenniumwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniaWithoutOverflow()](#submillenniawithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniumWithoutOverflow()](#submillenniumwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniaWithNoOverflow()](#addmillenniawithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniumWithNoOverflow()](#addmillenniumwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniaWithNoOverflow()](#submillenniawithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniumWithNoOverflow()](#submillenniumwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniaNoOverflow()](#addmillennianooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniumNoOverflow()](#addmillenniumnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniaNoOverflow()](#submillennianooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniumNoOverflow()](#submillenniumnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturies()](#addcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addCentury()](#addcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subCenturies()](#subcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subCentury()](#subcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addCenturiesWithOverflow()](#addcenturieswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addCenturyWithOverflow()](#addcenturywithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subCenturiesWithOverflow()](#subcenturieswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subCenturyWithOverflow()](#subcenturywithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addCenturiesWithoutOverflow()](#addcenturieswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturyWithoutOverflow()](#addcenturywithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturiesWithoutOverflow()](#subcenturieswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturyWithoutOverflow()](#subcenturywithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturiesWithNoOverflow()](#addcenturieswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturyWithNoOverflow()](#addcenturywithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturiesWithNoOverflow()](#subcenturieswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturyWithNoOverflow()](#subcenturywithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturiesNoOverflow()](#addcenturiesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturyNoOverflow()](#addcenturynooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturiesNoOverflow()](#subcenturiesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturyNoOverflow()](#subcenturynooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecades()](#adddecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addDecade()](#adddecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subDecades()](#subdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subDecade()](#subdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addDecadesWithOverflow()](#adddecadeswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addDecadeWithOverflow()](#adddecadewithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subDecadesWithOverflow()](#subdecadeswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subDecadeWithOverflow()](#subdecadewithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addDecadesWithoutOverflow()](#adddecadeswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadeWithoutOverflow()](#adddecadewithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadesWithoutOverflow()](#subdecadeswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadeWithoutOverflow()](#subdecadewithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadesWithNoOverflow()](#adddecadeswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadeWithNoOverflow()](#adddecadewithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadesWithNoOverflow()](#subdecadeswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadeWithNoOverflow()](#subdecadewithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadesNoOverflow()](#adddecadesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadeNoOverflow()](#adddecadenooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadesNoOverflow()](#subdecadesnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadeNoOverflow()](#subdecadenooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarters()](#addquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addQuarter()](#addquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subQuarters()](#subquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subQuarter()](#subquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addQuartersWithOverflow()](#addquarterswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addQuarterWithOverflow()](#addquarterwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subQuartersWithOverflow()](#subquarterswithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [subQuarterWithOverflow()](#subquarterwithoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly allowed. |
| CarbonImmutable | [addQuartersWithoutOverflow()](#addquarterswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarterWithoutOverflow()](#addquarterwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuartersWithoutOverflow()](#subquarterswithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuarterWithoutOverflow()](#subquarterwithoutoverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuartersWithNoOverflow()](#addquarterswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarterWithNoOverflow()](#addquarterwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuartersWithNoOverflow()](#subquarterswithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuarterWithNoOverflow()](#subquarterwithnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuartersNoOverflow()](#addquartersnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarterNoOverflow()](#addquarternooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuartersNoOverflow()](#subquartersnooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuarterNoOverflow()](#subquarternooverflow) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | with overflow explicitly forbidden. |
| CarbonImmutable | [addWeeks()](#addweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addWeek()](#addweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subWeeks()](#subweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subWeek()](#subweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addWeekdays()](#addweekdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addWeekday()](#addweekday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subWeekdays()](#subweekdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subWeekday()](#subweekday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMicros()](#addutcmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMicro()](#addutcmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMicros()](#subutcmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMicro()](#subutcmicro) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [microsUntil()](#microsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [diffInUTCMicros()](#diffinutcmicros) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| CarbonImmutable | [addUTCMicroseconds()](#addutcmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMicrosecond()](#addutcmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMicroseconds()](#subutcmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMicrosecond()](#subutcmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [microsecondsUntil()](#microsecondsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each microsecond or every X microseconds if a factor is given. |
| float | [diffInUTCMicroseconds()](#diffinutcmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of microseconds. |
| CarbonImmutable | [addUTCMillis()](#addutcmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMilli()](#addutcmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMillis()](#subutcmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMilli()](#subutcmilli) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [millisUntil()](#millisuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [diffInUTCMillis()](#diffinutcmillis) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| CarbonImmutable | [addUTCMilliseconds()](#addutcmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMillisecond()](#addutcmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMilliseconds()](#subutcmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMillisecond()](#subutcmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [millisecondsUntil()](#millisecondsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each millisecond or every X milliseconds if a factor is given. |
| float | [diffInUTCMilliseconds()](#diffinutcmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of milliseconds. |
| CarbonImmutable | [addUTCSeconds()](#addutcseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCSecond()](#addutcsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCSeconds()](#subutcseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCSecond()](#subutcsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [secondsUntil()](#secondsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each second or every X seconds if a factor is given. |
| float | [diffInUTCSeconds()](#diffinutcseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of seconds. |
| CarbonImmutable | [addUTCMinutes()](#addutcminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMinute()](#addutcminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMinutes()](#subutcminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMinute()](#subutcminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [minutesUntil()](#minutesuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each minute or every X minutes if a factor is given. |
| float | [diffInUTCMinutes()](#diffinutcminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of minutes. |
| CarbonImmutable | [addUTCHours()](#addutchours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCHour()](#addutchour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCHours()](#subutchours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCHour()](#subutchour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [hoursUntil()](#hoursuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each hour or every X hours if a factor is given. |
| float | [diffInUTCHours()](#diffinutchours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of hours. |
| CarbonImmutable | [addUTCDays()](#addutcdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCDay()](#addutcday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCDays()](#subutcdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCDay()](#subutcday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [daysUntil()](#daysuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each day or every X days if a factor is given. |
| float | [diffInUTCDays()](#diffinutcdays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of days. |
| CarbonImmutable | [addUTCWeeks()](#addutcweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCWeek()](#addutcweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCWeeks()](#subutcweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCWeek()](#subutcweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [weeksUntil()](#weeksuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each week or every X weeks if a factor is given. |
| float | [diffInUTCWeeks()](#diffinutcweeks) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of weeks. |
| CarbonImmutable | [addUTCMonths()](#addutcmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMonth()](#addutcmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMonths()](#subutcmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMonth()](#subutcmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [monthsUntil()](#monthsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each month or every X months if a factor is given. |
| float | [diffInUTCMonths()](#diffinutcmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of months. |
| CarbonImmutable | [addUTCQuarters()](#addutcquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCQuarter()](#addutcquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCQuarters()](#subutcquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCQuarter()](#subutcquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [quartersUntil()](#quartersuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each quarter or every X quarters if a factor is given. |
| float | [diffInUTCQuarters()](#diffinutcquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of quarters. |
| CarbonImmutable | [addUTCYears()](#addutcyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCYear()](#addutcyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCYears()](#subutcyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCYear()](#subutcyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [yearsUntil()](#yearsuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each year or every X years if a factor is given. |
| float | [diffInUTCYears()](#diffinutcyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of years. |
| CarbonImmutable | [addUTCDecades()](#addutcdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCDecade()](#addutcdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCDecades()](#subutcdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCDecade()](#subutcdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [decadesUntil()](#decadesuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each decade or every X decades if a factor is given. |
| float | [diffInUTCDecades()](#diffinutcdecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of decades. |
| CarbonImmutable | [addUTCCenturies()](#addutccenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCCentury()](#addutccentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCCenturies()](#subutccenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCCentury()](#subutccentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [centuriesUntil()](#centuriesuntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each century or every X centuries if a factor is given. |
| float | [diffInUTCCenturies()](#diffinutccenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of centuries. |
| CarbonImmutable | [addUTCMillennia()](#addutcmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [addUTCMillennium()](#addutcmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMillennia()](#subutcmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonImmutable | [subUTCMillennium()](#subutcmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | . |
| CarbonPeriod | [millenniaUntil()](#millenniauntil) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | for each millennium or every X millennia if a factor is given. |
| float | [diffInUTCMillennia()](#diffinutcmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Convert current and given date in UTC timezone and return a floating number of millennia. |
| CarbonImmutable | [roundYear()](#roundyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance year with given precision using the given function. |
| CarbonImmutable | [roundYears()](#roundyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance year with given precision using the given function. |
| CarbonImmutable | [floorYear()](#flooryear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance year with given precision. |
| CarbonImmutable | [floorYears()](#flooryears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance year with given precision. |
| CarbonImmutable | [ceilYear()](#ceilyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance year with given precision. |
| CarbonImmutable | [ceilYears()](#ceilyears) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance year with given precision. |
| CarbonImmutable | [roundMonth()](#roundmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance month with given precision using the given function. |
| CarbonImmutable | [roundMonths()](#roundmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance month with given precision using the given function. |
| CarbonImmutable | [floorMonth()](#floormonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance month with given precision. |
| CarbonImmutable | [floorMonths()](#floormonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance month with given precision. |
| CarbonImmutable | [ceilMonth()](#ceilmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance month with given precision. |
| CarbonImmutable | [ceilMonths()](#ceilmonths) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance month with given precision. |
| CarbonImmutable | [roundDay()](#roundday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance day with given precision using the given function. |
| CarbonImmutable | [roundDays()](#rounddays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance day with given precision using the given function. |
| CarbonImmutable | [floorDay()](#floorday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance day with given precision. |
| CarbonImmutable | [floorDays()](#floordays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance day with given precision. |
| CarbonImmutable | [ceilDay()](#ceilday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance day with given precision. |
| CarbonImmutable | [ceilDays()](#ceildays) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance day with given precision. |
| CarbonImmutable | [roundHour()](#roundhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance hour with given precision using the given function. |
| CarbonImmutable | [roundHours()](#roundhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance hour with given precision using the given function. |
| CarbonImmutable | [floorHour()](#floorhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance hour with given precision. |
| CarbonImmutable | [floorHours()](#floorhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance hour with given precision. |
| CarbonImmutable | [ceilHour()](#ceilhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance hour with given precision. |
| CarbonImmutable | [ceilHours()](#ceilhours) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance hour with given precision. |
| CarbonImmutable | [roundMinute()](#roundminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance minute with given precision using the given function. |
| CarbonImmutable | [roundMinutes()](#roundminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance minute with given precision using the given function. |
| CarbonImmutable | [floorMinute()](#floorminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance minute with given precision. |
| CarbonImmutable | [floorMinutes()](#floorminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance minute with given precision. |
| CarbonImmutable | [ceilMinute()](#ceilminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance minute with given precision. |
| CarbonImmutable | [ceilMinutes()](#ceilminutes) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance minute with given precision. |
| CarbonImmutable | [roundSecond()](#roundsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance second with given precision using the given function. |
| CarbonImmutable | [roundSeconds()](#roundseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance second with given precision using the given function. |
| CarbonImmutable | [floorSecond()](#floorsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance second with given precision. |
| CarbonImmutable | [floorSeconds()](#floorseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance second with given precision. |
| CarbonImmutable | [ceilSecond()](#ceilsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance second with given precision. |
| CarbonImmutable | [ceilSeconds()](#ceilseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance second with given precision. |
| CarbonImmutable | [roundMillennium()](#roundmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millennium with given precision using the given function. |
| CarbonImmutable | [roundMillennia()](#roundmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millennium with given precision using the given function. |
| CarbonImmutable | [floorMillennium()](#floormillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millennium with given precision. |
| CarbonImmutable | [floorMillennia()](#floormillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millennium with given precision. |
| CarbonImmutable | [ceilMillennium()](#ceilmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millennium with given precision. |
| CarbonImmutable | [ceilMillennia()](#ceilmillennia) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millennium with given precision. |
| CarbonImmutable | [roundCentury()](#roundcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance century with given precision using the given function. |
| CarbonImmutable | [roundCenturies()](#roundcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance century with given precision using the given function. |
| CarbonImmutable | [floorCentury()](#floorcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance century with given precision. |
| CarbonImmutable | [floorCenturies()](#floorcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance century with given precision. |
| CarbonImmutable | [ceilCentury()](#ceilcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance century with given precision. |
| CarbonImmutable | [ceilCenturies()](#ceilcenturies) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance century with given precision. |
| CarbonImmutable | [roundDecade()](#rounddecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance decade with given precision using the given function. |
| CarbonImmutable | [roundDecades()](#rounddecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance decade with given precision using the given function. |
| CarbonImmutable | [floorDecade()](#floordecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance decade with given precision. |
| CarbonImmutable | [floorDecades()](#floordecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance decade with given precision. |
| CarbonImmutable | [ceilDecade()](#ceildecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance decade with given precision. |
| CarbonImmutable | [ceilDecades()](#ceildecades) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance decade with given precision. |
| CarbonImmutable | [roundQuarter()](#roundquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance quarter with given precision using the given function. |
| CarbonImmutable | [roundQuarters()](#roundquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance quarter with given precision using the given function. |
| CarbonImmutable | [floorQuarter()](#floorquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance quarter with given precision. |
| CarbonImmutable | [floorQuarters()](#floorquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance quarter with given precision. |
| CarbonImmutable | [ceilQuarter()](#ceilquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance quarter with given precision. |
| CarbonImmutable | [ceilQuarters()](#ceilquarters) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance quarter with given precision. |
| CarbonImmutable | [roundMillisecond()](#roundmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millisecond with given precision using the given function. |
| CarbonImmutable | [roundMilliseconds()](#roundmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance millisecond with given precision using the given function. |
| CarbonImmutable | [floorMillisecond()](#floormillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millisecond with given precision. |
| CarbonImmutable | [floorMilliseconds()](#floormilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance millisecond with given precision. |
| CarbonImmutable | [ceilMillisecond()](#ceilmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millisecond with given precision. |
| CarbonImmutable | [ceilMilliseconds()](#ceilmilliseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance millisecond with given precision. |
| CarbonImmutable | [roundMicrosecond()](#roundmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance microsecond with given precision using the given function. |
| CarbonImmutable | [roundMicroseconds()](#roundmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Round the current instance microsecond with given precision using the given function. |
| CarbonImmutable | [floorMicrosecond()](#floormicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance microsecond with given precision. |
| CarbonImmutable | [floorMicroseconds()](#floormicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Truncate the current instance microsecond with given precision. |
| CarbonImmutable | [ceilMicrosecond()](#ceilmicrosecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance microsecond with given precision. |
| CarbonImmutable | [ceilMicroseconds()](#ceilmicroseconds) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Ceil the current instance microsecond with given precision. |
| string | [shortAbsoluteDiffForHumans()](#shortabsolutediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [longAbsoluteDiffForHumans()](#longabsolutediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [shortRelativeDiffForHumans()](#shortrelativediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [longRelativeDiffForHumans()](#longrelativediffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [shortRelativeToNowDiffForHumans()](#shortrelativetonowdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [longRelativeToNowDiffForHumans()](#longrelativetonowdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [shortRelativeToOtherDiffForHumans()](#shortrelativetootherdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| string | [longRelativeToOtherDiffForHumans()](#longrelativetootherdiffforhumans) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ |  |
| int | [centuriesInMillennium()](#centuriesinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of centuries contained in the current millennium |
| int|static | [centuryOfMillennium()](#centuryofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the century starting from the beginning of the current millennium when called with no parameters, change the current century when called with an integer value |
| int|static | [dayOfCentury()](#dayofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current century when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfDecade()](#dayofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current decade when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfMillennium()](#dayofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current millennium when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfMonth()](#dayofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current month when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfQuarter()](#dayofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current quarter when called with no parameters, change the current day when called with an integer value |
| int|static | [dayOfWeek()](#dayofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the day starting from the beginning of the current week when called with no parameters, change the current day when called with an integer value |
| int | [daysInCentury()](#daysincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current century |
| int | [daysInDecade()](#daysindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current decade |
| int | [daysInMillennium()](#daysinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current millennium |
| int | [daysInMonth()](#daysinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current month |
| int | [daysInQuarter()](#daysinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current quarter |
| int | [daysInWeek()](#daysinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current week |
| int | [daysInYear()](#daysinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of days contained in the current year |
| int|static | [decadeOfCentury()](#decadeofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the decade starting from the beginning of the current century when called with no parameters, change the current decade when called with an integer value |
| int|static | [decadeOfMillennium()](#decadeofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the decade starting from the beginning of the current millennium when called with no parameters, change the current decade when called with an integer value |
| int | [decadesInCentury()](#decadesincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of decades contained in the current century |
| int | [decadesInMillennium()](#decadesinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of decades contained in the current millennium |
| int|static | [hourOfCentury()](#hourofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current century when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfDay()](#hourofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current day when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfDecade()](#hourofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current decade when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfMillennium()](#hourofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current millennium when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfMonth()](#hourofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current month when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfQuarter()](#hourofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current quarter when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfWeek()](#hourofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current week when called with no parameters, change the current hour when called with an integer value |
| int|static | [hourOfYear()](#hourofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the hour starting from the beginning of the current year when called with no parameters, change the current hour when called with an integer value |
| int | [hoursInCentury()](#hoursincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current century |
| int | [hoursInDay()](#hoursinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current day |
| int | [hoursInDecade()](#hoursindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current decade |
| int | [hoursInMillennium()](#hoursinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current millennium |
| int | [hoursInMonth()](#hoursinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current month |
| int | [hoursInQuarter()](#hoursinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current quarter |
| int | [hoursInWeek()](#hoursinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current week |
| int | [hoursInYear()](#hoursinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of hours contained in the current year |
| int|static | [microsecondOfCentury()](#microsecondofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current century when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfDay()](#microsecondofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current day when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfDecade()](#microsecondofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current decade when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfHour()](#microsecondofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current hour when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMillennium()](#microsecondofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current millennium when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMillisecond()](#microsecondofmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current millisecond when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMinute()](#microsecondofminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current minute when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfMonth()](#microsecondofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current month when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfQuarter()](#microsecondofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current quarter when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfSecond()](#microsecondofsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current second when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfWeek()](#microsecondofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current week when called with no parameters, change the current microsecond when called with an integer value |
| int|static | [microsecondOfYear()](#microsecondofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the microsecond starting from the beginning of the current year when called with no parameters, change the current microsecond when called with an integer value |
| int | [microsecondsInCentury()](#microsecondsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current century |
| int | [microsecondsInDay()](#microsecondsinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current day |
| int | [microsecondsInDecade()](#microsecondsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current decade |
| int | [microsecondsInHour()](#microsecondsinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current hour |
| int | [microsecondsInMillennium()](#microsecondsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current millennium |
| int | [microsecondsInMillisecond()](#microsecondsinmillisecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current millisecond |
| int | [microsecondsInMinute()](#microsecondsinminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current minute |
| int | [microsecondsInMonth()](#microsecondsinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current month |
| int | [microsecondsInQuarter()](#microsecondsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current quarter |
| int | [microsecondsInSecond()](#microsecondsinsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current second |
| int | [microsecondsInWeek()](#microsecondsinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current week |
| int | [microsecondsInYear()](#microsecondsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of microseconds contained in the current year |
| int|static | [millisecondOfCentury()](#millisecondofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current century when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfDay()](#millisecondofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current day when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfDecade()](#millisecondofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current decade when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfHour()](#millisecondofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current hour when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfMillennium()](#millisecondofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current millennium when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfMinute()](#millisecondofminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current minute when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfMonth()](#millisecondofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current month when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfQuarter()](#millisecondofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current quarter when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfSecond()](#millisecondofsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current second when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfWeek()](#millisecondofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current week when called with no parameters, change the current millisecond when called with an integer value |
| int|static | [millisecondOfYear()](#millisecondofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the millisecond starting from the beginning of the current year when called with no parameters, change the current millisecond when called with an integer value |
| int | [millisecondsInCentury()](#millisecondsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current century |
| int | [millisecondsInDay()](#millisecondsinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current day |
| int | [millisecondsInDecade()](#millisecondsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current decade |
| int | [millisecondsInHour()](#millisecondsinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current hour |
| int | [millisecondsInMillennium()](#millisecondsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current millennium |
| int | [millisecondsInMinute()](#millisecondsinminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current minute |
| int | [millisecondsInMonth()](#millisecondsinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current month |
| int | [millisecondsInQuarter()](#millisecondsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current quarter |
| int | [millisecondsInSecond()](#millisecondsinsecond) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current second |
| int | [millisecondsInWeek()](#millisecondsinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current week |
| int | [millisecondsInYear()](#millisecondsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of milliseconds contained in the current year |
| int|static | [minuteOfCentury()](#minuteofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current century when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfDay()](#minuteofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current day when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfDecade()](#minuteofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current decade when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfHour()](#minuteofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current hour when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfMillennium()](#minuteofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current millennium when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfMonth()](#minuteofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current month when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfQuarter()](#minuteofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current quarter when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfWeek()](#minuteofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current week when called with no parameters, change the current minute when called with an integer value |
| int|static | [minuteOfYear()](#minuteofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the minute starting from the beginning of the current year when called with no parameters, change the current minute when called with an integer value |
| int | [minutesInCentury()](#minutesincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current century |
| int | [minutesInDay()](#minutesinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current day |
| int | [minutesInDecade()](#minutesindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current decade |
| int | [minutesInHour()](#minutesinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current hour |
| int | [minutesInMillennium()](#minutesinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current millennium |
| int | [minutesInMonth()](#minutesinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current month |
| int | [minutesInQuarter()](#minutesinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current quarter |
| int | [minutesInWeek()](#minutesinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current week |
| int | [minutesInYear()](#minutesinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of minutes contained in the current year |
| int|static | [monthOfCentury()](#monthofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current century when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfDecade()](#monthofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current decade when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfMillennium()](#monthofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current millennium when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfQuarter()](#monthofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current quarter when called with no parameters, change the current month when called with an integer value |
| int|static | [monthOfYear()](#monthofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the month starting from the beginning of the current year when called with no parameters, change the current month when called with an integer value |
| int | [monthsInCentury()](#monthsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current century |
| int | [monthsInDecade()](#monthsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current decade |
| int | [monthsInMillennium()](#monthsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current millennium |
| int | [monthsInQuarter()](#monthsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current quarter |
| int | [monthsInYear()](#monthsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of months contained in the current year |
| int|static | [quarterOfCentury()](#quarterofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current century when called with no parameters, change the current quarter when called with an integer value |
| int|static | [quarterOfDecade()](#quarterofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current decade when called with no parameters, change the current quarter when called with an integer value |
| int|static | [quarterOfMillennium()](#quarterofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current millennium when called with no parameters, change the current quarter when called with an integer value |
| int|static | [quarterOfYear()](#quarterofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the quarter starting from the beginning of the current year when called with no parameters, change the current quarter when called with an integer value |
| int | [quartersInCentury()](#quartersincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current century |
| int | [quartersInDecade()](#quartersindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current decade |
| int | [quartersInMillennium()](#quartersinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current millennium |
| int | [quartersInYear()](#quartersinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of quarters contained in the current year |
| int|static | [secondOfCentury()](#secondofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current century when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfDay()](#secondofday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current day when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfDecade()](#secondofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current decade when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfHour()](#secondofhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current hour when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfMillennium()](#secondofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current millennium when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfMinute()](#secondofminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current minute when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfMonth()](#secondofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current month when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfQuarter()](#secondofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current quarter when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfWeek()](#secondofweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current week when called with no parameters, change the current second when called with an integer value |
| int|static | [secondOfYear()](#secondofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the second starting from the beginning of the current year when called with no parameters, change the current second when called with an integer value |
| int | [secondsInCentury()](#secondsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current century |
| int | [secondsInDay()](#secondsinday) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current day |
| int | [secondsInDecade()](#secondsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current decade |
| int | [secondsInHour()](#secondsinhour) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current hour |
| int | [secondsInMillennium()](#secondsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current millennium |
| int | [secondsInMinute()](#secondsinminute) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current minute |
| int | [secondsInMonth()](#secondsinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current month |
| int | [secondsInQuarter()](#secondsinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current quarter |
| int | [secondsInWeek()](#secondsinweek) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current week |
| int | [secondsInYear()](#secondsinyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of seconds contained in the current year |
| int|static | [weekOfCentury()](#weekofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current century when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfDecade()](#weekofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current decade when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfMillennium()](#weekofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current millennium when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfMonth()](#weekofmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current month when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfQuarter()](#weekofquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current quarter when called with no parameters, change the current week when called with an integer value |
| int|static | [weekOfYear()](#weekofyear) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the week starting from the beginning of the current year when called with no parameters, change the current week when called with an integer value |
| int | [weeksInCentury()](#weeksincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current century |
| int | [weeksInDecade()](#weeksindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current decade |
| int | [weeksInMillennium()](#weeksinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current millennium |
| int | [weeksInMonth()](#weeksinmonth) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current month |
| int | [weeksInQuarter()](#weeksinquarter) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of weeks contained in the current quarter |
| int|static | [yearOfCentury()](#yearofcentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the year starting from the beginning of the current century when called with no parameters, change the current year when called with an integer value |
| int|static | [yearOfDecade()](#yearofdecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the year starting from the beginning of the current decade when called with no parameters, change the current year when called with an integer value |
| int|static | [yearOfMillennium()](#yearofmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the value of the year starting from the beginning of the current millennium when called with no parameters, change the current year when called with an integer value |
| int | [yearsInCentury()](#yearsincentury) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of years contained in the current century |
| int | [yearsInDecade()](#yearsindecade) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of years contained in the current decade |
| int | [yearsInMillennium()](#yearsinmillennium) _(from [CarbonImmutable](../Carbon/CarbonImmutable.md))_ | Return the number of years contained in the current millennium

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

### startOfTime

```php
static public CarbonImmutable startOfTime()
```

Create a very old date representing start of time.

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### endOfTime

```php
static public CarbonImmutable endOfTime()
```

Create a very far date representing end of time.

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable years($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### year

```php
public CarbonImmutable year($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setYears

```php
public CarbonImmutable setYears($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setYear

```php
public CarbonImmutable setYear($value)
```

Set current instance year to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### months

```php
public CarbonImmutable months($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### month

```php
public CarbonImmutable month($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMonths

```php
public CarbonImmutable setMonths($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMonth

```php
public CarbonImmutable setMonth($value)
```

Set current instance month to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Month|int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### days

```php
public CarbonImmutable days($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### day

```php
public CarbonImmutable day($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setDays

```php
public CarbonImmutable setDays($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setDay

```php
public CarbonImmutable setDay($value)
```

Set current instance day to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### hours

```php
public CarbonImmutable hours($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### hour

```php
public CarbonImmutable hour($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setHours

```php
public CarbonImmutable setHours($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setHour

```php
public CarbonImmutable setHour($value)
```

Set current instance hour to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### minutes

```php
public CarbonImmutable minutes($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### minute

```php
public CarbonImmutable minute($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMinutes

```php
public CarbonImmutable setMinutes($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMinute

```php
public CarbonImmutable setMinute($value)
```

Set current instance minute to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### seconds

```php
public CarbonImmutable seconds($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### second

```php
public CarbonImmutable second($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setSeconds

```php
public CarbonImmutable setSeconds($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setSecond

```php
public CarbonImmutable setSecond($value)
```

Set current instance second to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### millis

```php
public CarbonImmutable millis($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### milli

```php
public CarbonImmutable milli($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMillis

```php
public CarbonImmutable setMillis($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMilli

```php
public CarbonImmutable setMilli($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### milliseconds

```php
public CarbonImmutable milliseconds($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### millisecond

```php
public CarbonImmutable millisecond($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMilliseconds

```php
public CarbonImmutable setMilliseconds($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMillisecond

```php
public CarbonImmutable setMillisecond($value)
```

Set current instance millisecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### micros

```php
public CarbonImmutable micros($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### micro

```php
public CarbonImmutable micro($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMicros

```php
public CarbonImmutable setMicros($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMicro

```php
public CarbonImmutable setMicro($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### microseconds

```php
public CarbonImmutable microseconds($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### microsecond

```php
public CarbonImmutable microsecond($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### setMicroseconds

```php
public CarbonImmutable setMicroseconds($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYear

```php
public CarbonImmutable addYear($dd one year to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYears

```php
public CarbonImmutable subYears($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYear

```php
public CarbonImmutable subYear($ub one year to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearsWithOverflow

```php
public CarbonImmutable addYearsWithOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearWithOverflow

```php
public CarbonImmutable addYearWithOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearsWithOverflow

```php
public CarbonImmutable subYearsWithOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearWithOverflow

```php
public CarbonImmutable subYearWithOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearsWithoutOverflow

```php
public CarbonImmutable addYearsWithoutOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearWithoutOverflow

```php
public CarbonImmutable addYearWithoutOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearsWithoutOverflow

```php
public CarbonImmutable subYearsWithoutOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearWithoutOverflow

```php
public CarbonImmutable subYearWithoutOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearsWithNoOverflow

```php
public CarbonImmutable addYearsWithNoOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearWithNoOverflow

```php
public CarbonImmutable addYearWithNoOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearsWithNoOverflow

```php
public CarbonImmutable subYearsWithNoOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearWithNoOverflow

```php
public CarbonImmutable subYearWithNoOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearsNoOverflow

```php
public CarbonImmutable addYearsNoOverflow($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYearNoOverflow

```php
public CarbonImmutable addYearNoOverflow($dd one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearsNoOverflow

```php
public CarbonImmutable subYearsNoOverflow($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subYearNoOverflow

```php
public CarbonImmutable subYearNoOverflow($ub one year to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonths

```php
public CarbonImmutable addMonths($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonth

```php
public CarbonImmutable addMonth($dd one month to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonths

```php
public CarbonImmutable subMonths($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonth

```php
public CarbonImmutable subMonth($ub one month to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthsWithOverflow

```php
public CarbonImmutable addMonthsWithOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthWithOverflow

```php
public CarbonImmutable addMonthWithOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthsWithOverflow

```php
public CarbonImmutable subMonthsWithOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthWithOverflow

```php
public CarbonImmutable subMonthWithOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthsWithoutOverflow

```php
public CarbonImmutable addMonthsWithoutOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthWithoutOverflow

```php
public CarbonImmutable addMonthWithoutOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthsWithoutOverflow

```php
public CarbonImmutable subMonthsWithoutOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthWithoutOverflow

```php
public CarbonImmutable subMonthWithoutOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthsWithNoOverflow

```php
public CarbonImmutable addMonthsWithNoOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthWithNoOverflow

```php
public CarbonImmutable addMonthWithNoOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthsWithNoOverflow

```php
public CarbonImmutable subMonthsWithNoOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthWithNoOverflow

```php
public CarbonImmutable subMonthWithNoOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthsNoOverflow

```php
public CarbonImmutable addMonthsNoOverflow($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMonthNoOverflow

```php
public CarbonImmutable addMonthNoOverflow($dd one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthsNoOverflow

```php
public CarbonImmutable subMonthsNoOverflow($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMonthNoOverflow

```php
public CarbonImmutable subMonthNoOverflow($ub one month to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDays

```php
public CarbonImmutable addDays($value = &#039;1&#039;) Add days (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDay

```php
public CarbonImmutable addDay($dd one day to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one day to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDays

```php
public CarbonImmutable subDays($value = &#039;1&#039;) Sub days (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDay

```php
public CarbonImmutable subDay($ub one day to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one day to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addHours

```php
public CarbonImmutable addHours($value = &#039;1&#039;) Add hours (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addHour

```php
public CarbonImmutable addHour($dd one hour to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one hour to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subHours

```php
public CarbonImmutable subHours($value = &#039;1&#039;) Sub hours (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subHour

```php
public CarbonImmutable subHour($ub one hour to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one hour to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMinutes

```php
public CarbonImmutable addMinutes($value = &#039;1&#039;) Add minutes (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMinute

```php
public CarbonImmutable addMinute($dd one minute to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one minute to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMinutes

```php
public CarbonImmutable subMinutes($value = &#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMinute

```php
public CarbonImmutable subMinute($ub one minute to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one minute to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addSeconds

```php
public CarbonImmutable addSeconds($value = &#039;1&#039;) Add seconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addSecond

```php
public CarbonImmutable addSecond($dd one second to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one second to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subSeconds

```php
public CarbonImmutable subSeconds($value = &#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subSecond

```php
public CarbonImmutable subSecond($ub one second to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one second to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillis

```php
public CarbonImmutable addMillis($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMilli

```php
public CarbonImmutable addMilli($dd one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillis

```php
public CarbonImmutable subMillis($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMilli

```php
public CarbonImmutable subMilli($ub one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMilliseconds

```php
public CarbonImmutable addMilliseconds($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillisecond

```php
public CarbonImmutable addMillisecond($dd one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMilliseconds

```php
public CarbonImmutable subMilliseconds($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillisecond

```php
public CarbonImmutable subMillisecond($ub one millisecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMicros

```php
public CarbonImmutable addMicros($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMicro

```php
public CarbonImmutable addMicro($dd one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMicros

```php
public CarbonImmutable subMicros($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMicro

```php
public CarbonImmutable subMicro($ub one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMicroseconds

```php
public CarbonImmutable addMicroseconds($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMicrosecond

```php
public CarbonImmutable addMicrosecond($dd one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMicroseconds

```php
public CarbonImmutable subMicroseconds($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMicrosecond

```php
public CarbonImmutable subMicrosecond($ub one microsecond to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillennia

```php
public CarbonImmutable addMillennia($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillennium

```php
public CarbonImmutable addMillennium($dd one millennium to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillennia

```php
public CarbonImmutable subMillennia($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillennium

```php
public CarbonImmutable subMillennium($ub one millennium to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniaWithOverflow

```php
public CarbonImmutable addMillenniaWithOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniumWithOverflow

```php
public CarbonImmutable addMillenniumWithOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniaWithOverflow

```php
public CarbonImmutable subMillenniaWithOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniumWithOverflow

```php
public CarbonImmutable subMillenniumWithOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniaWithoutOverflow

```php
public CarbonImmutable addMillenniaWithoutOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniumWithoutOverflow

```php
public CarbonImmutable addMillenniumWithoutOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniaWithoutOverflow

```php
public CarbonImmutable subMillenniaWithoutOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniumWithoutOverflow

```php
public CarbonImmutable subMillenniumWithoutOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniaWithNoOverflow

```php
public CarbonImmutable addMillenniaWithNoOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniumWithNoOverflow

```php
public CarbonImmutable addMillenniumWithNoOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniaWithNoOverflow

```php
public CarbonImmutable subMillenniaWithNoOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniumWithNoOverflow

```php
public CarbonImmutable subMillenniumWithNoOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniaNoOverflow

```php
public CarbonImmutable addMillenniaNoOverflow($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addMillenniumNoOverflow

```php
public CarbonImmutable addMillenniumNoOverflow($dd one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniaNoOverflow

```php
public CarbonImmutable subMillenniaNoOverflow($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subMillenniumNoOverflow

```php
public CarbonImmutable subMillenniumNoOverflow($ub one millennium to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturies

```php
public CarbonImmutable addCenturies($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCentury

```php
public CarbonImmutable addCentury($dd one century to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturies

```php
public CarbonImmutable subCenturies($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCentury

```php
public CarbonImmutable subCentury($ub one century to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturiesWithOverflow

```php
public CarbonImmutable addCenturiesWithOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturyWithOverflow

```php
public CarbonImmutable addCenturyWithOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturiesWithOverflow

```php
public CarbonImmutable subCenturiesWithOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturyWithOverflow

```php
public CarbonImmutable subCenturyWithOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturiesWithoutOverflow

```php
public CarbonImmutable addCenturiesWithoutOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturyWithoutOverflow

```php
public CarbonImmutable addCenturyWithoutOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturiesWithoutOverflow

```php
public CarbonImmutable subCenturiesWithoutOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturyWithoutOverflow

```php
public CarbonImmutable subCenturyWithoutOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturiesWithNoOverflow

```php
public CarbonImmutable addCenturiesWithNoOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturyWithNoOverflow

```php
public CarbonImmutable addCenturyWithNoOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturiesWithNoOverflow

```php
public CarbonImmutable subCenturiesWithNoOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturyWithNoOverflow

```php
public CarbonImmutable subCenturyWithNoOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturiesNoOverflow

```php
public CarbonImmutable addCenturiesNoOverflow($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addCenturyNoOverflow

```php
public CarbonImmutable addCenturyNoOverflow($dd one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturiesNoOverflow

```php
public CarbonImmutable subCenturiesNoOverflow($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subCenturyNoOverflow

```php
public CarbonImmutable subCenturyNoOverflow($ub one century to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecades

```php
public CarbonImmutable addDecades($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecade

```php
public CarbonImmutable addDecade($dd one decade to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecades

```php
public CarbonImmutable subDecades($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecade

```php
public CarbonImmutable subDecade($ub one decade to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadesWithOverflow

```php
public CarbonImmutable addDecadesWithOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadeWithOverflow

```php
public CarbonImmutable addDecadeWithOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadesWithOverflow

```php
public CarbonImmutable subDecadesWithOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadeWithOverflow

```php
public CarbonImmutable subDecadeWithOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadesWithoutOverflow

```php
public CarbonImmutable addDecadesWithoutOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadeWithoutOverflow

```php
public CarbonImmutable addDecadeWithoutOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadesWithoutOverflow

```php
public CarbonImmutable subDecadesWithoutOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadeWithoutOverflow

```php
public CarbonImmutable subDecadeWithoutOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadesWithNoOverflow

```php
public CarbonImmutable addDecadesWithNoOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadeWithNoOverflow

```php
public CarbonImmutable addDecadeWithNoOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadesWithNoOverflow

```php
public CarbonImmutable subDecadesWithNoOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadeWithNoOverflow

```php
public CarbonImmutable subDecadeWithNoOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadesNoOverflow

```php
public CarbonImmutable addDecadesNoOverflow($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addDecadeNoOverflow

```php
public CarbonImmutable addDecadeNoOverflow($dd one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadesNoOverflow

```php
public CarbonImmutable subDecadesNoOverflow($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subDecadeNoOverflow

```php
public CarbonImmutable subDecadeNoOverflow($ub one decade to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuarters

```php
public CarbonImmutable addQuarters($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuarter

```php
public CarbonImmutable addQuarter($dd one quarter to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuarters

```php
public CarbonImmutable subQuarters($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuarter

```php
public CarbonImmutable subQuarter($ub one quarter to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuartersWithOverflow

```php
public CarbonImmutable addQuartersWithOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuarterWithOverflow

```php
public CarbonImmutable addQuarterWithOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuartersWithOverflow

```php
public CarbonImmutable subQuartersWithOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuarterWithOverflow

```php
public CarbonImmutable subQuarterWithOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly allowed.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuartersWithoutOverflow

```php
public CarbonImmutable addQuartersWithoutOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuarterWithoutOverflow

```php
public CarbonImmutable addQuarterWithoutOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuartersWithoutOverflow

```php
public CarbonImmutable subQuartersWithoutOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuarterWithoutOverflow

```php
public CarbonImmutable subQuarterWithoutOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuartersWithNoOverflow

```php
public CarbonImmutable addQuartersWithNoOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuarterWithNoOverflow

```php
public CarbonImmutable addQuarterWithNoOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuartersWithNoOverflow

```php
public CarbonImmutable subQuartersWithNoOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuarterWithNoOverflow

```php
public CarbonImmutable subQuarterWithNoOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuartersNoOverflow

```php
public CarbonImmutable addQuartersNoOverflow($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addQuarterNoOverflow

```php
public CarbonImmutable addQuarterNoOverflow($dd one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuartersNoOverflow

```php
public CarbonImmutable subQuartersNoOverflow($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subQuarterNoOverflow

```php
public CarbonImmutable subQuarterNoOverflow($ub one quarter to the instance (using date interval)
```

with overflow explicitly forbidden.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addWeeks

```php
public CarbonImmutable addWeeks($value = &#039;1&#039;) Add weeks (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addWeek

```php
public CarbonImmutable addWeek($dd one week to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one week to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subWeeks

```php
public CarbonImmutable subWeeks($value = &#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subWeek

```php
public CarbonImmutable subWeek($ub one week to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one week to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addWeekdays

```php
public CarbonImmutable addWeekdays($value = &#039;1&#039;) Add weekdays (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add weekdays (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addWeekday

```php
public CarbonImmutable addWeekday($dd one weekday to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one weekday to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subWeekdays

```php
public CarbonImmutable subWeekdays($value = &#039;1&#039;) Sub weekdays (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub weekdays (the $value count passed in) to the instance (using date interval` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subWeekday

```php
public CarbonImmutable subWeekday($ub one weekday to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one weekday to the instance (using date interval` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMicros

```php
public CarbonImmutable addUTCMicros($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMicro

```php
public CarbonImmutable addUTCMicro($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMicros

```php
public CarbonImmutable subUTCMicros($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMicro

```php
public CarbonImmutable subUTCMicro($ub one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCMicroseconds($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMicrosecond

```php
public CarbonImmutable addUTCMicrosecond($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMicroseconds

```php
public CarbonImmutable subUTCMicroseconds($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMicrosecond

```php
public CarbonImmutable subUTCMicrosecond($ub one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one microsecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCMillis($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMilli

```php
public CarbonImmutable addUTCMilli($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMillis

```php
public CarbonImmutable subUTCMillis($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMilli

```php
public CarbonImmutable subUTCMilli($ub one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCMilliseconds($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMillisecond

```php
public CarbonImmutable addUTCMillisecond($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMilliseconds

```php
public CarbonImmutable subUTCMilliseconds($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMillisecond

```php
public CarbonImmutable subUTCMillisecond($ub one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millisecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCSeconds($value = &#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCSecond

```php
public CarbonImmutable addUTCSecond($dd one second to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one second to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCSeconds

```php
public CarbonImmutable subUTCSeconds($value = &#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCSecond

```php
public CarbonImmutable subUTCSecond($ub one second to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one second to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCMinutes($value = &#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMinute

```php
public CarbonImmutable addUTCMinute($dd one minute to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one minute to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMinutes

```php
public CarbonImmutable subUTCMinutes($value = &#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMinute

```php
public CarbonImmutable subUTCMinute($ub one minute to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one minute to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCHours($value = &#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCHour

```php
public CarbonImmutable addUTCHour($dd one hour to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one hour to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCHours

```php
public CarbonImmutable subUTCHours($value = &#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCHour

```php
public CarbonImmutable subUTCHour($ub one hour to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one hour to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCDays($value = &#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCDay

```php
public CarbonImmutable addUTCDay($dd one day to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one day to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCDays

```php
public CarbonImmutable subUTCDays($value = &#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCDay

```php
public CarbonImmutable subUTCDay($ub one day to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one day to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCWeeks($value = &#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCWeek

```php
public CarbonImmutable addUTCWeek($dd one week to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one week to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCWeeks

```php
public CarbonImmutable subUTCWeeks($value = &#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCWeek

```php
public CarbonImmutable subUTCWeek($ub one week to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one week to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCMonths($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMonth

```php
public CarbonImmutable addUTCMonth($dd one month to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMonths

```php
public CarbonImmutable subUTCMonths($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMonth

```php
public CarbonImmutable subUTCMonth($ub one month to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one month to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCQuarters($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCQuarter

```php
public CarbonImmutable addUTCQuarter($dd one quarter to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCQuarters

```php
public CarbonImmutable subUTCQuarters($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCQuarter

```php
public CarbonImmutable subUTCQuarter($ub one quarter to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one quarter to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCYear

```php
public CarbonImmutable addUTCYear($dd one year to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCYears

```php
public CarbonImmutable subUTCYears($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCYear

```php
public CarbonImmutable subUTCYear($ub one year to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one year to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCDecades($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCDecade

```php
public CarbonImmutable addUTCDecade($dd one decade to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCDecades

```php
public CarbonImmutable subUTCDecades($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCDecade

```php
public CarbonImmutable subUTCDecade($ub one decade to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one decade to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCCenturies($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCCentury

```php
public CarbonImmutable addUTCCentury($dd one century to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCCenturies

```php
public CarbonImmutable subUTCCenturies($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCCentury

```php
public CarbonImmutable subUTCCentury($ub one century to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one century to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable addUTCMillennia($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addUTCMillennium

```php
public CarbonImmutable addUTCMillennium($dd one millennium to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMillennia

```php
public CarbonImmutable subUTCMillennia($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subUTCMillennium

```php
public CarbonImmutable subUTCMillennium($ub one millennium to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$ub one millennium to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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
public CarbonImmutable roundYear($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance year with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundYears

```php
public CarbonImmutable roundYears($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance year with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorYear

```php
public CarbonImmutable floorYear($precision = &#039;1&#039;)
```

Truncate the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorYears

```php
public CarbonImmutable floorYears($precision = &#039;1&#039;)
```

Truncate the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilYear

```php
public CarbonImmutable ceilYear($precision = &#039;1&#039;)
```

Ceil the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilYears

```php
public CarbonImmutable ceilYears($precision = &#039;1&#039;)
```

Ceil the current instance year with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMonth

```php
public CarbonImmutable roundMonth($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance month with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMonths

```php
public CarbonImmutable roundMonths($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance month with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMonth

```php
public CarbonImmutable floorMonth($precision = &#039;1&#039;)
```

Truncate the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMonths

```php
public CarbonImmutable floorMonths($precision = &#039;1&#039;)
```

Truncate the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMonth

```php
public CarbonImmutable ceilMonth($precision = &#039;1&#039;)
```

Ceil the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMonths

```php
public CarbonImmutable ceilMonths($precision = &#039;1&#039;)
```

Ceil the current instance month with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundDay

```php
public CarbonImmutable roundDay($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance day with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundDays

```php
public CarbonImmutable roundDays($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance day with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorDay

```php
public CarbonImmutable floorDay($precision = &#039;1&#039;)
```

Truncate the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorDays

```php
public CarbonImmutable floorDays($precision = &#039;1&#039;)
```

Truncate the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilDay

```php
public CarbonImmutable ceilDay($precision = &#039;1&#039;)
```

Ceil the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilDays

```php
public CarbonImmutable ceilDays($precision = &#039;1&#039;)
```

Ceil the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundHour

```php
public CarbonImmutable roundHour($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance hour with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundHours

```php
public CarbonImmutable roundHours($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance hour with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorHour

```php
public CarbonImmutable floorHour($precision = &#039;1&#039;)
```

Truncate the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorHours

```php
public CarbonImmutable floorHours($precision = &#039;1&#039;)
```

Truncate the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilHour

```php
public CarbonImmutable ceilHour($precision = &#039;1&#039;)
```

Ceil the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilHours

```php
public CarbonImmutable ceilHours($precision = &#039;1&#039;)
```

Ceil the current instance hour with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMinute

```php
public CarbonImmutable roundMinute($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance minute with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMinutes

```php
public CarbonImmutable roundMinutes($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance minute with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMinute

```php
public CarbonImmutable floorMinute($precision = &#039;1&#039;)
```

Truncate the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMinutes

```php
public CarbonImmutable floorMinutes($precision = &#039;1&#039;)
```

Truncate the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMinute

```php
public CarbonImmutable ceilMinute($precision = &#039;1&#039;)
```

Ceil the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMinutes

```php
public CarbonImmutable ceilMinutes($precision = &#039;1&#039;)
```

Ceil the current instance minute with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundSecond

```php
public CarbonImmutable roundSecond($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance second with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundSeconds

```php
public CarbonImmutable roundSeconds($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance second with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorSecond

```php
public CarbonImmutable floorSecond($precision = &#039;1&#039;)
```

Truncate the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorSeconds

```php
public CarbonImmutable floorSeconds($precision = &#039;1&#039;)
```

Truncate the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilSecond

```php
public CarbonImmutable ceilSecond($precision = &#039;1&#039;)
```

Ceil the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilSeconds

```php
public CarbonImmutable ceilSeconds($precision = &#039;1&#039;)
```

Ceil the current instance second with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMillennium

```php
public CarbonImmutable roundMillennium($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millennium with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMillennia

```php
public CarbonImmutable roundMillennia($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millennium with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMillennium

```php
public CarbonImmutable floorMillennium($precision = &#039;1&#039;)
```

Truncate the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMillennia

```php
public CarbonImmutable floorMillennia($precision = &#039;1&#039;)
```

Truncate the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMillennium

```php
public CarbonImmutable ceilMillennium($precision = &#039;1&#039;)
```

Ceil the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMillennia

```php
public CarbonImmutable ceilMillennia($precision = &#039;1&#039;)
```

Ceil the current instance millennium with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundCentury

```php
public CarbonImmutable roundCentury($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance century with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundCenturies

```php
public CarbonImmutable roundCenturies($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance century with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorCentury

```php
public CarbonImmutable floorCentury($precision = &#039;1&#039;)
```

Truncate the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorCenturies

```php
public CarbonImmutable floorCenturies($precision = &#039;1&#039;)
```

Truncate the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilCentury

```php
public CarbonImmutable ceilCentury($precision = &#039;1&#039;)
```

Ceil the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilCenturies

```php
public CarbonImmutable ceilCenturies($precision = &#039;1&#039;)
```

Ceil the current instance century with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundDecade

```php
public CarbonImmutable roundDecade($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance decade with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundDecades

```php
public CarbonImmutable roundDecades($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance decade with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorDecade

```php
public CarbonImmutable floorDecade($precision = &#039;1&#039;)
```

Truncate the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorDecades

```php
public CarbonImmutable floorDecades($precision = &#039;1&#039;)
```

Truncate the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilDecade

```php
public CarbonImmutable ceilDecade($precision = &#039;1&#039;)
```

Ceil the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilDecades

```php
public CarbonImmutable ceilDecades($precision = &#039;1&#039;)
```

Ceil the current instance decade with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundQuarter

```php
public CarbonImmutable roundQuarter($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance quarter with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundQuarters

```php
public CarbonImmutable roundQuarters($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance quarter with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorQuarter

```php
public CarbonImmutable floorQuarter($precision = &#039;1&#039;)
```

Truncate the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorQuarters

```php
public CarbonImmutable floorQuarters($precision = &#039;1&#039;)
```

Truncate the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilQuarter

```php
public CarbonImmutable ceilQuarter($precision = &#039;1&#039;)
```

Ceil the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilQuarters

```php
public CarbonImmutable ceilQuarters($precision = &#039;1&#039;)
```

Ceil the current instance quarter with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMillisecond

```php
public CarbonImmutable roundMillisecond($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millisecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMilliseconds

```php
public CarbonImmutable roundMilliseconds($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance millisecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMillisecond

```php
public CarbonImmutable floorMillisecond($precision = &#039;1&#039;)
```

Truncate the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMilliseconds

```php
public CarbonImmutable floorMilliseconds($precision = &#039;1&#039;)
```

Truncate the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMillisecond

```php
public CarbonImmutable ceilMillisecond($precision = &#039;1&#039;)
```

Ceil the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMilliseconds

```php
public CarbonImmutable ceilMilliseconds($precision = &#039;1&#039;)
```

Ceil the current instance millisecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMicrosecond

```php
public CarbonImmutable roundMicrosecond($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance microsecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### roundMicroseconds

```php
public CarbonImmutable roundMicroseconds($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance microsecond with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMicrosecond

```php
public CarbonImmutable floorMicrosecond($precision = &#039;1&#039;)
```

Truncate the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### floorMicroseconds

```php
public CarbonImmutable floorMicroseconds($precision = &#039;1&#039;)
```

Truncate the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMicrosecond

```php
public CarbonImmutable ceilMicrosecond($precision = &#039;1&#039;)
```

Ceil the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### ceilMicroseconds

```php
public CarbonImmutable ceilMicroseconds($precision = &#039;1&#039;)
```

Ceil the current instance microsecond with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
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

