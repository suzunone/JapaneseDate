# DateTimeImmutable

**Namespace:** `JapaneseDate`

class **DateTimeImmutable** extends CarbonImmutable implements [DateTimeInterface](../JapaneseDate/DateTimeInterface.md)

日本の暦対応のDateTimeImmutableオブジェクト拡張

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
| public _(read-only)_ | int|bool | `$solar_term` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
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
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の春分の日の日時を取得する。値は、 春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$seimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の清明の日の日時を取得する。値は、 清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_seimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_seimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$kokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の穀雨の日の日時を取得する。値は、 穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_kokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_kokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立夏の日の日時を取得する。値は、 立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小満の日の日時を取得する。値は、 小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$bousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の芒種の日の日時を取得する。値は、 芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_bousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_bousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$geshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の夏至の日の日時を取得する。値は、 夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_geshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_geshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小暑の日の日時を取得する。値は、 小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$taisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の大暑の日の日時を取得する。値は、 大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_taisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。o |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_taisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立秋の日の日時を取得する。値は、 立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の処暑の日の日時を取得する。値は、 処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$hakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の白露の日の日時を取得する。値は、 白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_hakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_hakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の秋分の日の日時を取得する。値は、 秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$kanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の寒露の日の日時を取得する。値は、 寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_kanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_kanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$soukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の霜降の日の日時を取得する。値は、 霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_soukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_soukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立冬の日の日時を取得する。値は、 立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小雪の日の日時を取得する。値は、 小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$taisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の大雪の日の日時を取得する。値は、 大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_taisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_taisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$touji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の冬至の日の日時を取得する。値は、 冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_touji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_touji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$syoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の小寒の日の日時を取得する。値は、 小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_syoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_syoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$daikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の大寒の日の日時を取得する。値は、 大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_daikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_daikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$rissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の立春の日の日時を取得する。値は、 立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_rissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_rissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$usui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の雨水の日の日時を取得する。値は、 雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_usui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_usui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$keichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | その年の啓蟄の日の日時を取得する。値は、 啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$next_keichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$before_keichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。 |
| public _(read-only)_ | int|bool | `$solarTerm` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 24節気を取得する。値は、 1 から 24 までの整数、または 24節気でない場合は false になります。 |
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
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の春分の日の日時を取得する。値は、 次の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は翌年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyunbun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の春分の日の日時を取得する。値は、 前の春分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が春分の日の場合は前年の春分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSeimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の清明の日の日時を取得する。値は、 次の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は翌年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSeimei` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の清明の日の日時を取得する。値は、 前の清明の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が清明の日の場合は前年の清明の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextKokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の穀雨の日の日時を取得する。値は、 次の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は翌年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeKokuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の穀雨の日の日時を取得する。値は、 前の穀雨の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が穀雨の日の場合は前年の穀雨の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立夏の日の日時を取得する。値は、 次の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は翌年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRikka` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立夏の日の日時を取得する。値は、 前の立夏の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立夏の日の場合は前年の立夏の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小満の日の日時を取得する。値は、 次の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は翌年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyouman` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小満の日の日時を取得する。値は、 前の小満の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小満の日の場合は前年の小満の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextBousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の芒種の日の日時を取得する。値は、 次の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は翌年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeBousyu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の芒種の日の日時を取得する。値は、 前の芒種の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が芒種の日の場合は前年の芒種の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextGeshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の夏至の日の日時を取得する。値は、 次の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は翌年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeGeshi` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の夏至の日の日時を取得する。値は、 前の夏至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が夏至の日の場合は前年の夏至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小暑の日の日時を取得する。値は、 次の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は翌年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyousyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小暑の日の日時を取得する。値は、 前の小暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小暑の日の場合は前年の小暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextTaisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大暑の日の日時を取得する。値は、 次の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は翌年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeTaisyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大暑の日の日時を取得する。値は、 前の大暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大暑の日の場合は前年の大暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立秋の日の日時を取得する。値は、 次の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は翌年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRissyuu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立秋の日の日時を取得する。値は、 前の立秋の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立秋の日の場合は前年の立秋の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の処暑の日の日時を取得する。値は、 次の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は翌年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyosyo` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の処暑の日の日時を取得する。値は、 前の処暑の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が処暑の日の場合は前年の処暑の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextHakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の白露の日の日時を取得する。値は、 次の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は翌年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeHakuro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の白露の日の日時を取得する。値は、 前の白露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が白露の日の場合は前年の白露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の秋分の日の日時を取得する。値は、 次の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は翌年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyuubun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の秋分の日の日時を取得する。値は、 前の秋分の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が秋分の日の場合は前年の秋分の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextKanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の寒露の日の日時を取得する。値は、 次の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は翌年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeKanro` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の寒露の日の日時を取得する。値は、 前の寒露の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が寒露の日の場合は前年の寒露の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSoukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の霜降の日の日時を取得する。値は、 次の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は翌年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSoukou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の霜降の日の日時を取得する。値は、 前の霜降の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が霜降の日の場合は前年の霜降の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立冬の日の日時を取得する。値は、 次の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は翌年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRittou` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立冬の日の日時を取得する。値は、 前の立冬の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立冬の日の場合は前年の立冬の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小雪の日の日時を取得する。値は、 次の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は翌年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyousetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小雪の日の日時を取得する。値は、 前の小雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小雪の日の場合は前年の小雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextTaisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大雪の日の日時を取得する。値は、 次の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は翌年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeTaisetsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大雪の日の日時を取得する。値は、 前の大雪の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大雪の日の場合は前年の大雪の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextTouji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の冬至の日の日時を取得する。値は、 次の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は翌年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeTouji` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の冬至の日の日時を取得する。値は、 前の冬至の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が冬至の日の場合は前年の冬至の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextSyoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の小寒の日の日時を取得する。値は、 次の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は翌年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeSyoukan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の小寒の日の日時を取得する。値は、 前の小寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が小寒の日の場合は前年の小寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextDaikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の大寒の日の日時を取得する。値は、 次の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は翌年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeDaikan` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の大寒の日の日時を取得する。値は、 前の大寒の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が大寒の日の場合は前年の大寒の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextRissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の立春の日の日時を取得する。値は、 次の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は翌年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeRissyun` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の立春の日の日時を取得する。値は、 前の立春の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が立春の日の場合は前年の立春の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextUsui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の雨水の日の日時を取得する。値は、 次の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は翌年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeUsui` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の雨水の日の日時を取得する。値は、 前の雨水の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が雨水の日の場合は前年の雨水の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$nextKeichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 次の啓蟄の日の日時を取得する。値は、 次の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は翌年の啓蟄の日が返されます。 |
| public _(read-only)_ | [DateTime](../JapaneseDate/DateTime.md)|[DateTimeImmutable](../JapaneseDate/DateTimeImmutable.md) | `$beforeKeichitsu` _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | 前の啓蟄の日の日時を取得する。値は、 前の啓蟄の日の日時を表す DateTime オブジェクト、またはimmutableの場合は DateTimeImmutable オブジェクトが返されます。当日が啓蟄の日の場合は前年の啓蟄の日が返されます。 |

## Methods

| Return | Method | Description |
|---|---|---|
| Factory | [factory()](#factory) _(from [Factory](../JapaneseDate/Traits/Factory.md))_ | DateTimeオブジェクトの生成 |
| void | [setCacheMode()](#setcachemode) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | キャッシュモードを指定する |
| void | [setCacheFilePath()](#setcachefilepath) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | キャッシュファイル保存ディレクトリをセットします |
| void | [setCacheClosure()](#setcacheclosure) _(from [CacheSetting](../JapaneseDate/Traits/CacheSetting.md))_ | 独自キャッシュロジックのセット |
| Modifier | [nextHoliday()](#nextholiday) _(from [Modifier](../JapaneseDate/Traits/Modifier.md))_ | 次の祝日にする |
| Modifier | [nextSixWeek()](#nextsixweek) _(from [Modifier](../JapaneseDate/Traits/Modifier.md))_ | 指定された次の六曜にする |
| array | [getCalendar()](#getcalendar) _(from [Getter](../JapaneseDate/Traits/Getter.md))_ | サポートされるカレンダーに変換する |

---

## Method Details

### factory

```php
static public Factory factory($date_time = null, $time_zone = null)
```

DateTimeオブジェクトの生成

日付/時刻 文字列の書式については http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式 を参考にしてください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float|string|[DateTimeInterface](https://www.php.net/class.datetimeinterface)|null | `$date_time` | `null` | 日付/時刻 文字列。DateTimeオブジェクト |
| [DateTimeZone](https://www.php.net/class.datetimezone)|null | `$time_zone` | `null` | DateTimeZone オブジェクトか、時差の時間、タイムゾーンテキスト(omit 予定) |

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

