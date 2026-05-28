# Carbon

**Namespace:** `Carbon`

class **Carbon** extends [DateTime](https://www.php.net/class.datetime) implements CarbonInterface

A simple API extension for DateTime.

## Traits

- Date

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public | int | `$year` |  |
| public | int | `$yearIso` |  |
| public | int | `$month` |  |
| public | int | `$day` |  |
| public | int | `$hour` |  |
| public | int | `$minute` |  |
| public | int | `$second` |  |
| public | int | `$micro` |  |
| public | int | `$microsecond` |  |
| public | int\|float\|string | `$timestamp` | seconds since the Unix Epoch |
| public | string | `$englishDayOfWeek` | the day of week in English |
| public | string | `$shortEnglishDayOfWeek` | the abbreviated day of week in English |
| public | string | `$englishMonth` | the month in English |
| public | string | `$shortEnglishMonth` | the abbreviated month in English |
| public | int | `$milliseconds` |  |
| public | int | `$millisecond` |  |
| public | int | `$milli` |  |
| public | int | `$week` | 1 through 53 |
| public | int | `$isoWeek` | 1 through 53 |
| public | int | `$weekYear` | year according to week format |
| public | int | `$isoWeekYear` | year according to ISO week format |
| public | int | `$dayOfYear` | 1 through 366 |
| public | int | `$age` | does a diffInYears() with default parameters |
| public | int | `$offset` | the timezone offset in seconds from UTC |
| public | int | `$offsetMinutes` | the timezone offset in minutes from UTC |
| public | int | `$offsetHours` | the timezone offset in hours from UTC |
| public | CarbonTimeZone | `$timezone` | the current timezone |
| public | CarbonTimeZone | `$tz` | alias of $timezone |
| public _(read-only)_ | int | `$dayOfWeek` | 0 (for Sunday) through 6 (for Saturday) |
| public _(read-only)_ | int | `$dayOfWeekIso` | 1 (for Monday) through 7 (for Sunday) |
| public _(read-only)_ | int | `$weekOfYear` | ISO-8601 week number of year, weeks starting on Monday |
| public _(read-only)_ | int | `$daysInMonth` | number of days in the given month |
| public _(read-only)_ | string | `$latinMeridiem` | "am"/"pm" (Ante meridiem or Post meridiem latin lowercase mark) |
| public _(read-only)_ | string | `$latinUpperMeridiem` | "AM"/"PM" (Ante meridiem or Post meridiem latin uppercase mark) |
| public _(read-only)_ | string | `$timezoneAbbreviatedName` | the current timezone abbreviated name |
| public _(read-only)_ | string | `$tzAbbrName` | alias of $timezoneAbbreviatedName |
| public _(read-only)_ | string | `$dayName` | long name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortDayName` | short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$minDayName` | very short name of weekday translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$monthName` | long name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$shortMonthName` | short name of month translated according to Carbon locale, in english if no translation available for current language |
| public _(read-only)_ | string | `$meridiem` | lowercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | string | `$upperMeridiem` | uppercase meridiem mark translated according to Carbon locale, in latin if no translation available for current language |
| public _(read-only)_ | int | `$noZeroHour` | current hour from 1 to 24 |
| public _(read-only)_ | int | `$weeksInYear` | 51 through 53 |
| public _(read-only)_ | int | `$isoWeeksInYear` | 51 through 53 |
| public _(read-only)_ | int | `$weekOfMonth` | 1 through 5 |
| public _(read-only)_ | int | `$weekNumberInMonth` | 1 through 5 |
| public _(read-only)_ | int | `$firstWeekDay` | 0 through 6 |
| public _(read-only)_ | int | `$lastWeekDay` | 0 through 6 |
| public _(read-only)_ | int | `$daysInYear` | 365 or 366 |
| public _(read-only)_ | int | `$quarter` | the quarter of this instance, 1 - 4 |
| public _(read-only)_ | int | `$decade` | the decade of this instance |
| public _(read-only)_ | int | `$century` | the century of this instance |
| public _(read-only)_ | int | `$millennium` | the millennium of this instance |
| public _(read-only)_ | bool | `$dst` | daylight savings time indicator, true if DST, false otherwise |
| public _(read-only)_ | bool | `$local` | checks if the timezone is local, true if local, false otherwise |
| public _(read-only)_ | bool | `$utc` | checks if the timezone is UTC, true if UTC, false otherwise |
| public _(read-only)_ | string | `$timezoneName` | the current timezone name |
| public _(read-only)_ | string | `$tzName` | alias of $timezoneName |
| public _(read-only)_ | string | `$locale` | locale of the current instance |

## Methods

| Return | Method | Description |
|---|---|---|
| bool | [isMutable()](#ismutable) | Returns true if the current class/instance is mutable. |
| bool | [isUtc()](#isutc) |  |
| bool | [isLocal()](#islocal) | Check if the current instance has non-UTC timezone. |
| bool | [isValid()](#isvalid) | Check if the current instance is a valid date. |
| bool | [isDST()](#isdst) | Check if the current instance is in a daylight saving time. |
| bool | [isSunday()](#issunday) | Checks if the instance day is sunday. |
| bool | [isMonday()](#ismonday) | Checks if the instance day is monday. |
| bool | [isTuesday()](#istuesday) | Checks if the instance day is tuesday. |
| bool | [isWednesday()](#iswednesday) | Checks if the instance day is wednesday. |
| bool | [isThursday()](#isthursday) | Checks if the instance day is thursday. |
| bool | [isFriday()](#isfriday) | Checks if the instance day is friday. |
| bool | [isSaturday()](#issaturday) | Checks if the instance day is saturday. |
| bool | [isSameYear()](#issameyear) | . |
| bool | [isCurrentYear()](#iscurrentyear) | Checks if the instance is in the same year as the current moment. |
| bool | [isNextYear()](#isnextyear) | Checks if the instance is in the same year as the current moment next year. |
| bool | [isLastYear()](#islastyear) | Checks if the instance is in the same year as the current moment last year. |
| bool | [isSameWeek()](#issameweek) | . |
| bool | [isCurrentWeek()](#iscurrentweek) | Checks if the instance is in the same week as the current moment. |
| bool | [isNextWeek()](#isnextweek) | Checks if the instance is in the same week as the current moment next week. |
| bool | [isLastWeek()](#islastweek) | Checks if the instance is in the same week as the current moment last week. |
| bool | [isSameDay()](#issameday) | . |
| bool | [isCurrentDay()](#iscurrentday) | Checks if the instance is in the same day as the current moment. |
| bool | [isNextDay()](#isnextday) | Checks if the instance is in the same day as the current moment next day. |
| bool | [isLastDay()](#islastday) | Checks if the instance is in the same day as the current moment last day. |
| bool | [isSameHour()](#issamehour) | . |
| bool | [isCurrentHour()](#iscurrenthour) | Checks if the instance is in the same hour as the current moment. |
| bool | [isNextHour()](#isnexthour) | Checks if the instance is in the same hour as the current moment next hour. |
| bool | [isLastHour()](#islasthour) | Checks if the instance is in the same hour as the current moment last hour. |
| bool | [isSameMinute()](#issameminute) | . |
| bool | [isCurrentMinute()](#iscurrentminute) | Checks if the instance is in the same minute as the current moment. |
| bool | [isNextMinute()](#isnextminute) | Checks if the instance is in the same minute as the current moment next minute. |
| bool | [isLastMinute()](#islastminute) | Checks if the instance is in the same minute as the current moment last minute. |
| bool | [isSameSecond()](#issamesecond) | . |
| bool | [isCurrentSecond()](#iscurrentsecond) | Checks if the instance is in the same second as the current moment. |
| bool | [isNextSecond()](#isnextsecond) | Checks if the instance is in the same second as the current moment next second. |
| bool | [isLastSecond()](#islastsecond) | Checks if the instance is in the same second as the current moment last second. |
| bool | [isSameMicro()](#issamemicro) | . |
| bool | [isCurrentMicro()](#iscurrentmicro) | Checks if the instance is in the same microsecond as the current moment. |
| bool | [isNextMicro()](#isnextmicro) | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [isLastMicro()](#islastmicro) | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [isSameMicrosecond()](#issamemicrosecond) | . |
| bool | [isCurrentMicrosecond()](#iscurrentmicrosecond) | Checks if the instance is in the same microsecond as the current moment. |
| bool | [isNextMicrosecond()](#isnextmicrosecond) | Checks if the instance is in the same microsecond as the current moment next microsecond. |
| bool | [isLastMicrosecond()](#islastmicrosecond) | Checks if the instance is in the same microsecond as the current moment last microsecond. |
| bool | [isCurrentMonth()](#iscurrentmonth) | Checks if the instance is in the same month as the current moment. |
| bool | [isNextMonth()](#isnextmonth) | Checks if the instance is in the same month as the current moment next month. |
| bool | [isLastMonth()](#islastmonth) | Checks if the instance is in the same month as the current moment last month. |
| bool | [isCurrentQuarter()](#iscurrentquarter) | Checks if the instance is in the same quarter as the current moment. |
| bool | [isNextQuarter()](#isnextquarter) | Checks if the instance is in the same quarter as the current moment next quarter. |
| bool | [isLastQuarter()](#islastquarter) | Checks if the instance is in the same quarter as the current moment last quarter. |
| bool | [isSameDecade()](#issamedecade) | . |
| bool | [isCurrentDecade()](#iscurrentdecade) | Checks if the instance is in the same decade as the current moment. |
| bool | [isNextDecade()](#isnextdecade) | Checks if the instance is in the same decade as the current moment next decade. |
| bool | [isLastDecade()](#islastdecade) | Checks if the instance is in the same decade as the current moment last decade. |
| bool | [isSameCentury()](#issamecentury) | . |
| bool | [isCurrentCentury()](#iscurrentcentury) | Checks if the instance is in the same century as the current moment. |
| bool | [isNextCentury()](#isnextcentury) | Checks if the instance is in the same century as the current moment next century. |
| bool | [isLastCentury()](#islastcentury) | Checks if the instance is in the same century as the current moment last century. |
| bool | [isSameMillennium()](#issamemillennium) | . |
| bool | [isCurrentMillennium()](#iscurrentmillennium) | Checks if the instance is in the same millennium as the current moment. |
| bool | [isNextMillennium()](#isnextmillennium) | Checks if the instance is in the same millennium as the current moment next millennium. |
| bool | [isLastMillennium()](#islastmillennium) | Checks if the instance is in the same millennium as the current moment last millennium. |
| $this | [years()](#years) | Set current instance year to the given value. |
| $this | [year()](#year) | Set current instance year to the given value. |
| $this | [setYears()](#setyears) | Set current instance year to the given value. |
| $this | [setYear()](#setyear) | Set current instance year to the given value. |
| $this | [months()](#months) | Set current instance month to the given value. |
| $this | [month()](#month) | Set current instance month to the given value. |
| $this | [setMonths()](#setmonths) | Set current instance month to the given value. |
| $this | [setMonth()](#setmonth) | Set current instance month to the given value. |
| $this | [days()](#days) | Set current instance day to the given value. |
| $this | [day()](#day) | Set current instance day to the given value. |
| $this | [setDays()](#setdays) | Set current instance day to the given value. |
| $this | [setDay()](#setday) | Set current instance day to the given value. |
| $this | [hours()](#hours) | Set current instance hour to the given value. |
| $this | [hour()](#hour) | Set current instance hour to the given value. |
| $this | [setHours()](#sethours) | Set current instance hour to the given value. |
| $this | [setHour()](#sethour) | Set current instance hour to the given value. |
| $this | [minutes()](#minutes) | Set current instance minute to the given value. |
| $this | [minute()](#minute) | Set current instance minute to the given value. |
| $this | [setMinutes()](#setminutes) | Set current instance minute to the given value. |
| $this | [setMinute()](#setminute) | Set current instance minute to the given value. |
| $this | [seconds()](#seconds) | Set current instance second to the given value. |
| $this | [second()](#second) | Set current instance second to the given value. |
| $this | [setSeconds()](#setseconds) | Set current instance second to the given value. |
| $this | [setSecond()](#setsecond) | Set current instance second to the given value. |
| $this | [millis()](#millis) | Set current instance millisecond to the given value. |
| $this | [milli()](#milli) | Set current instance millisecond to the given value. |
| $this | [setMillis()](#setmillis) | Set current instance millisecond to the given value. |
| $this | [setMilli()](#setmilli) | Set current instance millisecond to the given value. |
| $this | [milliseconds()](#milliseconds) | Set current instance millisecond to the given value. |
| $this | [millisecond()](#millisecond) | Set current instance millisecond to the given value. |
| $this | [setMilliseconds()](#setmilliseconds) | Set current instance millisecond to the given value. |
| $this | [setMillisecond()](#setmillisecond) | Set current instance millisecond to the given value. |
| $this | [micros()](#micros) | Set current instance microsecond to the given value. |
| $this | [micro()](#micro) | Set current instance microsecond to the given value. |
| $this | [setMicros()](#setmicros) | Set current instance microsecond to the given value. |
| $this | [setMicro()](#setmicro) | Set current instance microsecond to the given value. |
| $this | [microseconds()](#microseconds) | Set current instance microsecond to the given value. |
| $this | [microsecond()](#microsecond) | Set current instance microsecond to the given value. |
| $this | [setMicroseconds()](#setmicroseconds) | Set current instance microsecond to the given value. |
| $this | [setMicrosecond()](#setmicrosecond) | Set current instance microsecond to the given value. |
| $this | [addYears()](#addyears) | . |
| $this | [addYear()](#addyear) | . |
| $this | [subYears()](#subyears) | . |
| $this | [subYear()](#subyear) | . |
| $this | [addYearsWithOverflow()](#addyearswithoverflow) | with overflow explicitly allowed. |
| $this | [addYearWithOverflow()](#addyearwithoverflow) | with overflow explicitly allowed. |
| $this | [subYearsWithOverflow()](#subyearswithoverflow) | with overflow explicitly allowed. |
| $this | [subYearWithOverflow()](#subyearwithoverflow) | with overflow explicitly allowed. |
| $this | [addYearsWithoutOverflow()](#addyearswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addYearWithoutOverflow()](#addyearwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subYearsWithoutOverflow()](#subyearswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subYearWithoutOverflow()](#subyearwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addYearsWithNoOverflow()](#addyearswithnooverflow) | with overflow explicitly forbidden. |
| $this | [addYearWithNoOverflow()](#addyearwithnooverflow) | with overflow explicitly forbidden. |
| $this | [subYearsWithNoOverflow()](#subyearswithnooverflow) | with overflow explicitly forbidden. |
| $this | [subYearWithNoOverflow()](#subyearwithnooverflow) | with overflow explicitly forbidden. |
| $this | [addYearsNoOverflow()](#addyearsnooverflow) | with overflow explicitly forbidden. |
| $this | [addYearNoOverflow()](#addyearnooverflow) | with overflow explicitly forbidden. |
| $this | [subYearsNoOverflow()](#subyearsnooverflow) | with overflow explicitly forbidden. |
| $this | [subYearNoOverflow()](#subyearnooverflow) | with overflow explicitly forbidden. |
| $this | [addMonths()](#addmonths) | . |
| $this | [addMonth()](#addmonth) | . |
| $this | [subMonths()](#submonths) | . |
| $this | [subMonth()](#submonth) | . |
| $this | [addMonthsWithOverflow()](#addmonthswithoverflow) | with overflow explicitly allowed. |
| $this | [addMonthWithOverflow()](#addmonthwithoverflow) | with overflow explicitly allowed. |
| $this | [subMonthsWithOverflow()](#submonthswithoverflow) | with overflow explicitly allowed. |
| $this | [subMonthWithOverflow()](#submonthwithoverflow) | with overflow explicitly allowed. |
| $this | [addMonthsWithoutOverflow()](#addmonthswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addMonthWithoutOverflow()](#addmonthwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subMonthsWithoutOverflow()](#submonthswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subMonthWithoutOverflow()](#submonthwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addMonthsWithNoOverflow()](#addmonthswithnooverflow) | with overflow explicitly forbidden. |
| $this | [addMonthWithNoOverflow()](#addmonthwithnooverflow) | with overflow explicitly forbidden. |
| $this | [subMonthsWithNoOverflow()](#submonthswithnooverflow) | with overflow explicitly forbidden. |
| $this | [subMonthWithNoOverflow()](#submonthwithnooverflow) | with overflow explicitly forbidden. |
| $this | [addMonthsNoOverflow()](#addmonthsnooverflow) | with overflow explicitly forbidden. |
| $this | [addMonthNoOverflow()](#addmonthnooverflow) | with overflow explicitly forbidden. |
| $this | [subMonthsNoOverflow()](#submonthsnooverflow) | with overflow explicitly forbidden. |
| $this | [subMonthNoOverflow()](#submonthnooverflow) | with overflow explicitly forbidden. |
| $this | [addDays()](#adddays) | . |
| $this | [addDay()](#addday) | . |
| $this | [subDays()](#subdays) | . |
| $this | [subDay()](#subday) | . |
| $this | [addHours()](#addhours) | . |
| $this | [addHour()](#addhour) | . |
| $this | [subHours()](#subhours) | . |
| $this | [subHour()](#subhour) | . |
| $this | [addMinutes()](#addminutes) | . |
| $this | [addMinute()](#addminute) | . |
| $this | [subMinutes()](#subminutes) | . |
| $this | [subMinute()](#subminute) | . |
| $this | [addSeconds()](#addseconds) | . |
| $this | [addSecond()](#addsecond) | . |
| $this | [subSeconds()](#subseconds) | . |
| $this | [subSecond()](#subsecond) | . |
| $this | [addMillis()](#addmillis) | . |
| $this | [addMilli()](#addmilli) | . |
| $this | [subMillis()](#submillis) | . |
| $this | [subMilli()](#submilli) | . |
| $this | [addMilliseconds()](#addmilliseconds) | . |
| $this | [addMillisecond()](#addmillisecond) | . |
| $this | [subMilliseconds()](#submilliseconds) | . |
| $this | [subMillisecond()](#submillisecond) | . |
| $this | [addMicros()](#addmicros) | . |
| $this | [addMicro()](#addmicro) | . |
| $this | [subMicros()](#submicros) | . |
| $this | [subMicro()](#submicro) | . |
| $this | [addMicroseconds()](#addmicroseconds) | . |
| $this | [addMicrosecond()](#addmicrosecond) | . |
| $this | [subMicroseconds()](#submicroseconds) | . |
| $this | [subMicrosecond()](#submicrosecond) | . |
| $this | [addMillennia()](#addmillennia) | . |
| $this | [addMillennium()](#addmillennium) | . |
| $this | [subMillennia()](#submillennia) | . |
| $this | [subMillennium()](#submillennium) | . |
| $this | [addMillenniaWithOverflow()](#addmillenniawithoverflow) | with overflow explicitly allowed. |
| $this | [addMillenniumWithOverflow()](#addmillenniumwithoverflow) | with overflow explicitly allowed. |
| $this | [subMillenniaWithOverflow()](#submillenniawithoverflow) | with overflow explicitly allowed. |
| $this | [subMillenniumWithOverflow()](#submillenniumwithoverflow) | with overflow explicitly allowed. |
| $this | [addMillenniaWithoutOverflow()](#addmillenniawithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addMillenniumWithoutOverflow()](#addmillenniumwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subMillenniaWithoutOverflow()](#submillenniawithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subMillenniumWithoutOverflow()](#submillenniumwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addMillenniaWithNoOverflow()](#addmillenniawithnooverflow) | with overflow explicitly forbidden. |
| $this | [addMillenniumWithNoOverflow()](#addmillenniumwithnooverflow) | with overflow explicitly forbidden. |
| $this | [subMillenniaWithNoOverflow()](#submillenniawithnooverflow) | with overflow explicitly forbidden. |
| $this | [subMillenniumWithNoOverflow()](#submillenniumwithnooverflow) | with overflow explicitly forbidden. |
| $this | [addMillenniaNoOverflow()](#addmillennianooverflow) | with overflow explicitly forbidden. |
| $this | [addMillenniumNoOverflow()](#addmillenniumnooverflow) | with overflow explicitly forbidden. |
| $this | [subMillenniaNoOverflow()](#submillennianooverflow) | with overflow explicitly forbidden. |
| $this | [subMillenniumNoOverflow()](#submillenniumnooverflow) | with overflow explicitly forbidden. |
| $this | [addCenturies()](#addcenturies) | . |
| $this | [addCentury()](#addcentury) | . |
| $this | [subCenturies()](#subcenturies) | . |
| $this | [subCentury()](#subcentury) | . |
| $this | [addCenturiesWithOverflow()](#addcenturieswithoverflow) | with overflow explicitly allowed. |
| $this | [addCenturyWithOverflow()](#addcenturywithoverflow) | with overflow explicitly allowed. |
| $this | [subCenturiesWithOverflow()](#subcenturieswithoverflow) | with overflow explicitly allowed. |
| $this | [subCenturyWithOverflow()](#subcenturywithoverflow) | with overflow explicitly allowed. |
| $this | [addCenturiesWithoutOverflow()](#addcenturieswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addCenturyWithoutOverflow()](#addcenturywithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subCenturiesWithoutOverflow()](#subcenturieswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subCenturyWithoutOverflow()](#subcenturywithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addCenturiesWithNoOverflow()](#addcenturieswithnooverflow) | with overflow explicitly forbidden. |
| $this | [addCenturyWithNoOverflow()](#addcenturywithnooverflow) | with overflow explicitly forbidden. |
| $this | [subCenturiesWithNoOverflow()](#subcenturieswithnooverflow) | with overflow explicitly forbidden. |
| $this | [subCenturyWithNoOverflow()](#subcenturywithnooverflow) | with overflow explicitly forbidden. |
| $this | [addCenturiesNoOverflow()](#addcenturiesnooverflow) | with overflow explicitly forbidden. |
| $this | [addCenturyNoOverflow()](#addcenturynooverflow) | with overflow explicitly forbidden. |
| $this | [subCenturiesNoOverflow()](#subcenturiesnooverflow) | with overflow explicitly forbidden. |
| $this | [subCenturyNoOverflow()](#subcenturynooverflow) | with overflow explicitly forbidden. |
| $this | [addDecades()](#adddecades) | . |
| $this | [addDecade()](#adddecade) | . |
| $this | [subDecades()](#subdecades) | . |
| $this | [subDecade()](#subdecade) | . |
| $this | [addDecadesWithOverflow()](#adddecadeswithoverflow) | with overflow explicitly allowed. |
| $this | [addDecadeWithOverflow()](#adddecadewithoverflow) | with overflow explicitly allowed. |
| $this | [subDecadesWithOverflow()](#subdecadeswithoverflow) | with overflow explicitly allowed. |
| $this | [subDecadeWithOverflow()](#subdecadewithoverflow) | with overflow explicitly allowed. |
| $this | [addDecadesWithoutOverflow()](#adddecadeswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addDecadeWithoutOverflow()](#adddecadewithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subDecadesWithoutOverflow()](#subdecadeswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subDecadeWithoutOverflow()](#subdecadewithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addDecadesWithNoOverflow()](#adddecadeswithnooverflow) | with overflow explicitly forbidden. |
| $this | [addDecadeWithNoOverflow()](#adddecadewithnooverflow) | with overflow explicitly forbidden. |
| $this | [subDecadesWithNoOverflow()](#subdecadeswithnooverflow) | with overflow explicitly forbidden. |
| $this | [subDecadeWithNoOverflow()](#subdecadewithnooverflow) | with overflow explicitly forbidden. |
| $this | [addDecadesNoOverflow()](#adddecadesnooverflow) | with overflow explicitly forbidden. |
| $this | [addDecadeNoOverflow()](#adddecadenooverflow) | with overflow explicitly forbidden. |
| $this | [subDecadesNoOverflow()](#subdecadesnooverflow) | with overflow explicitly forbidden. |
| $this | [subDecadeNoOverflow()](#subdecadenooverflow) | with overflow explicitly forbidden. |
| $this | [addQuarters()](#addquarters) | . |
| $this | [addQuarter()](#addquarter) | . |
| $this | [subQuarters()](#subquarters) | . |
| $this | [subQuarter()](#subquarter) | . |
| $this | [addQuartersWithOverflow()](#addquarterswithoverflow) | with overflow explicitly allowed. |
| $this | [addQuarterWithOverflow()](#addquarterwithoverflow) | with overflow explicitly allowed. |
| $this | [subQuartersWithOverflow()](#subquarterswithoverflow) | with overflow explicitly allowed. |
| $this | [subQuarterWithOverflow()](#subquarterwithoverflow) | with overflow explicitly allowed. |
| $this | [addQuartersWithoutOverflow()](#addquarterswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addQuarterWithoutOverflow()](#addquarterwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subQuartersWithoutOverflow()](#subquarterswithoutoverflow) | with overflow explicitly forbidden. |
| $this | [subQuarterWithoutOverflow()](#subquarterwithoutoverflow) | with overflow explicitly forbidden. |
| $this | [addQuartersWithNoOverflow()](#addquarterswithnooverflow) | with overflow explicitly forbidden. |
| $this | [addQuarterWithNoOverflow()](#addquarterwithnooverflow) | with overflow explicitly forbidden. |
| $this | [subQuartersWithNoOverflow()](#subquarterswithnooverflow) | with overflow explicitly forbidden. |
| $this | [subQuarterWithNoOverflow()](#subquarterwithnooverflow) | with overflow explicitly forbidden. |
| $this | [addQuartersNoOverflow()](#addquartersnooverflow) | with overflow explicitly forbidden. |
| $this | [addQuarterNoOverflow()](#addquarternooverflow) | with overflow explicitly forbidden. |
| $this | [subQuartersNoOverflow()](#subquartersnooverflow) | with overflow explicitly forbidden. |
| $this | [subQuarterNoOverflow()](#subquarternooverflow) | with overflow explicitly forbidden. |
| $this | [addWeeks()](#addweeks) | . |
| $this | [addWeek()](#addweek) | . |
| $this | [subWeeks()](#subweeks) | . |
| $this | [subWeek()](#subweek) | . |
| $this | [addWeekdays()](#addweekdays) | . |
| $this | [addWeekday()](#addweekday) | . |
| $this | [subWeekdays()](#subweekdays) | . |
| $this | [subWeekday()](#subweekday) | . |
| $this | [addRealMicros()](#addrealmicros) | . |
| $this | [addRealMicro()](#addrealmicro) | . |
| $this | [subRealMicros()](#subrealmicros) | . |
| $this | [subRealMicro()](#subrealmicro) | . |
| CarbonPeriod | [microsUntil()](#microsuntil) | for each microsecond or every X microseconds if a factor is given. |
| $this | [addRealMicroseconds()](#addrealmicroseconds) | . |
| $this | [addRealMicrosecond()](#addrealmicrosecond) | . |
| $this | [subRealMicroseconds()](#subrealmicroseconds) | . |
| $this | [subRealMicrosecond()](#subrealmicrosecond) | . |
| CarbonPeriod | [microsecondsUntil()](#microsecondsuntil) | for each microsecond or every X microseconds if a factor is given. |
| $this | [addRealMillis()](#addrealmillis) | . |
| $this | [addRealMilli()](#addrealmilli) | . |
| $this | [subRealMillis()](#subrealmillis) | . |
| $this | [subRealMilli()](#subrealmilli) | . |
| CarbonPeriod | [millisUntil()](#millisuntil) | for each millisecond or every X milliseconds if a factor is given. |
| $this | [addRealMilliseconds()](#addrealmilliseconds) | . |
| $this | [addRealMillisecond()](#addrealmillisecond) | . |
| $this | [subRealMilliseconds()](#subrealmilliseconds) | . |
| $this | [subRealMillisecond()](#subrealmillisecond) | . |
| CarbonPeriod | [millisecondsUntil()](#millisecondsuntil) | for each millisecond or every X milliseconds if a factor is given. |
| $this | [addRealSeconds()](#addrealseconds) | . |
| $this | [addRealSecond()](#addrealsecond) | . |
| $this | [subRealSeconds()](#subrealseconds) | . |
| $this | [subRealSecond()](#subrealsecond) | . |
| CarbonPeriod | [secondsUntil()](#secondsuntil) | for each second or every X seconds if a factor is given. |
| $this | [addRealMinutes()](#addrealminutes) | . |
| $this | [addRealMinute()](#addrealminute) | . |
| $this | [subRealMinutes()](#subrealminutes) | . |
| $this | [subRealMinute()](#subrealminute) | . |
| CarbonPeriod | [minutesUntil()](#minutesuntil) | for each minute or every X minutes if a factor is given. |
| $this | [addRealHours()](#addrealhours) | . |
| $this | [addRealHour()](#addrealhour) | . |
| $this | [subRealHours()](#subrealhours) | . |
| $this | [subRealHour()](#subrealhour) | . |
| CarbonPeriod | [hoursUntil()](#hoursuntil) | for each hour or every X hours if a factor is given. |
| $this | [addRealDays()](#addrealdays) | . |
| $this | [addRealDay()](#addrealday) | . |
| $this | [subRealDays()](#subrealdays) | . |
| $this | [subRealDay()](#subrealday) | . |
| CarbonPeriod | [daysUntil()](#daysuntil) | for each day or every X days if a factor is given. |
| $this | [addRealWeeks()](#addrealweeks) | . |
| $this | [addRealWeek()](#addrealweek) | . |
| $this | [subRealWeeks()](#subrealweeks) | . |
| $this | [subRealWeek()](#subrealweek) | . |
| CarbonPeriod | [weeksUntil()](#weeksuntil) | for each week or every X weeks if a factor is given. |
| $this | [addRealMonths()](#addrealmonths) | . |
| $this | [addRealMonth()](#addrealmonth) | . |
| $this | [subRealMonths()](#subrealmonths) | . |
| $this | [subRealMonth()](#subrealmonth) | . |
| CarbonPeriod | [monthsUntil()](#monthsuntil) | for each month or every X months if a factor is given. |
| $this | [addRealQuarters()](#addrealquarters) | . |
| $this | [addRealQuarter()](#addrealquarter) | . |
| $this | [subRealQuarters()](#subrealquarters) | . |
| $this | [subRealQuarter()](#subrealquarter) | . |
| CarbonPeriod | [quartersUntil()](#quartersuntil) | for each quarter or every X quarters if a factor is given. |
| $this | [addRealYears()](#addrealyears) | . |
| $this | [addRealYear()](#addrealyear) | . |
| $this | [subRealYears()](#subrealyears) | . |
| $this | [subRealYear()](#subrealyear) | . |
| CarbonPeriod | [yearsUntil()](#yearsuntil) | for each year or every X years if a factor is given. |
| $this | [addRealDecades()](#addrealdecades) | . |
| $this | [addRealDecade()](#addrealdecade) | . |
| $this | [subRealDecades()](#subrealdecades) | . |
| $this | [subRealDecade()](#subrealdecade) | . |
| CarbonPeriod | [decadesUntil()](#decadesuntil) | for each decade or every X decades if a factor is given. |
| $this | [addRealCenturies()](#addrealcenturies) | . |
| $this | [addRealCentury()](#addrealcentury) | . |
| $this | [subRealCenturies()](#subrealcenturies) | . |
| $this | [subRealCentury()](#subrealcentury) | . |
| CarbonPeriod | [centuriesUntil()](#centuriesuntil) | for each century or every X centuries if a factor is given. |
| $this | [addRealMillennia()](#addrealmillennia) | . |
| $this | [addRealMillennium()](#addrealmillennium) | . |
| $this | [subRealMillennia()](#subrealmillennia) | . |
| $this | [subRealMillennium()](#subrealmillennium) | . |
| CarbonPeriod | [millenniaUntil()](#millenniauntil) | for each millennium or every X millennia if a factor is given. |
| $this | [roundYear()](#roundyear) | Round the current instance year with given precision using the given function. |
| $this | [roundYears()](#roundyears) | Round the current instance year with given precision using the given function. |
| $this | [floorYear()](#flooryear) | Truncate the current instance year with given precision. |
| $this | [floorYears()](#flooryears) | Truncate the current instance year with given precision. |
| $this | [ceilYear()](#ceilyear) | Ceil the current instance year with given precision. |
| $this | [ceilYears()](#ceilyears) | Ceil the current instance year with given precision. |
| $this | [roundMonth()](#roundmonth) | Round the current instance month with given precision using the given function. |
| $this | [roundMonths()](#roundmonths) | Round the current instance month with given precision using the given function. |
| $this | [floorMonth()](#floormonth) | Truncate the current instance month with given precision. |
| $this | [floorMonths()](#floormonths) | Truncate the current instance month with given precision. |
| $this | [ceilMonth()](#ceilmonth) | Ceil the current instance month with given precision. |
| $this | [ceilMonths()](#ceilmonths) | Ceil the current instance month with given precision. |
| $this | [roundDay()](#roundday) | Round the current instance day with given precision using the given function. |
| $this | [roundDays()](#rounddays) | Round the current instance day with given precision using the given function. |
| $this | [floorDay()](#floorday) | Truncate the current instance day with given precision. |
| $this | [floorDays()](#floordays) | Truncate the current instance day with given precision. |
| $this | [ceilDay()](#ceilday) | Ceil the current instance day with given precision. |
| $this | [ceilDays()](#ceildays) | Ceil the current instance day with given precision. |
| $this | [roundHour()](#roundhour) | Round the current instance hour with given precision using the given function. |
| $this | [roundHours()](#roundhours) | Round the current instance hour with given precision using the given function. |
| $this | [floorHour()](#floorhour) | Truncate the current instance hour with given precision. |
| $this | [floorHours()](#floorhours) | Truncate the current instance hour with given precision. |
| $this | [ceilHour()](#ceilhour) | Ceil the current instance hour with given precision. |
| $this | [ceilHours()](#ceilhours) | Ceil the current instance hour with given precision. |
| $this | [roundMinute()](#roundminute) | Round the current instance minute with given precision using the given function. |
| $this | [roundMinutes()](#roundminutes) | Round the current instance minute with given precision using the given function. |
| $this | [floorMinute()](#floorminute) | Truncate the current instance minute with given precision. |
| $this | [floorMinutes()](#floorminutes) | Truncate the current instance minute with given precision. |
| $this | [ceilMinute()](#ceilminute) | Ceil the current instance minute with given precision. |
| $this | [ceilMinutes()](#ceilminutes) | Ceil the current instance minute with given precision. |
| $this | [roundSecond()](#roundsecond) | Round the current instance second with given precision using the given function. |
| $this | [roundSeconds()](#roundseconds) | Round the current instance second with given precision using the given function. |
| $this | [floorSecond()](#floorsecond) | Truncate the current instance second with given precision. |
| $this | [floorSeconds()](#floorseconds) | Truncate the current instance second with given precision. |
| $this | [ceilSecond()](#ceilsecond) | Ceil the current instance second with given precision. |
| $this | [ceilSeconds()](#ceilseconds) | Ceil the current instance second with given precision. |
| $this | [roundMillennium()](#roundmillennium) | Round the current instance millennium with given precision using the given function. |
| $this | [roundMillennia()](#roundmillennia) | Round the current instance millennium with given precision using the given function. |
| $this | [floorMillennium()](#floormillennium) | Truncate the current instance millennium with given precision. |
| $this | [floorMillennia()](#floormillennia) | Truncate the current instance millennium with given precision. |
| $this | [ceilMillennium()](#ceilmillennium) | Ceil the current instance millennium with given precision. |
| $this | [ceilMillennia()](#ceilmillennia) | Ceil the current instance millennium with given precision. |
| $this | [roundCentury()](#roundcentury) | Round the current instance century with given precision using the given function. |
| $this | [roundCenturies()](#roundcenturies) | Round the current instance century with given precision using the given function. |
| $this | [floorCentury()](#floorcentury) | Truncate the current instance century with given precision. |
| $this | [floorCenturies()](#floorcenturies) | Truncate the current instance century with given precision. |
| $this | [ceilCentury()](#ceilcentury) | Ceil the current instance century with given precision. |
| $this | [ceilCenturies()](#ceilcenturies) | Ceil the current instance century with given precision. |
| $this | [roundDecade()](#rounddecade) | Round the current instance decade with given precision using the given function. |
| $this | [roundDecades()](#rounddecades) | Round the current instance decade with given precision using the given function. |
| $this | [floorDecade()](#floordecade) | Truncate the current instance decade with given precision. |
| $this | [floorDecades()](#floordecades) | Truncate the current instance decade with given precision. |
| $this | [ceilDecade()](#ceildecade) | Ceil the current instance decade with given precision. |
| $this | [ceilDecades()](#ceildecades) | Ceil the current instance decade with given precision. |
| $this | [roundQuarter()](#roundquarter) | Round the current instance quarter with given precision using the given function. |
| $this | [roundQuarters()](#roundquarters) | Round the current instance quarter with given precision using the given function. |
| $this | [floorQuarter()](#floorquarter) | Truncate the current instance quarter with given precision. |
| $this | [floorQuarters()](#floorquarters) | Truncate the current instance quarter with given precision. |
| $this | [ceilQuarter()](#ceilquarter) | Ceil the current instance quarter with given precision. |
| $this | [ceilQuarters()](#ceilquarters) | Ceil the current instance quarter with given precision. |
| $this | [roundMillisecond()](#roundmillisecond) | Round the current instance millisecond with given precision using the given function. |
| $this | [roundMilliseconds()](#roundmilliseconds) | Round the current instance millisecond with given precision using the given function. |
| $this | [floorMillisecond()](#floormillisecond) | Truncate the current instance millisecond with given precision. |
| $this | [floorMilliseconds()](#floormilliseconds) | Truncate the current instance millisecond with given precision. |
| $this | [ceilMillisecond()](#ceilmillisecond) | Ceil the current instance millisecond with given precision. |
| $this | [ceilMilliseconds()](#ceilmilliseconds) | Ceil the current instance millisecond with given precision. |
| $this | [roundMicrosecond()](#roundmicrosecond) | Round the current instance microsecond with given precision using the given function. |
| $this | [roundMicroseconds()](#roundmicroseconds) | Round the current instance microsecond with given precision using the given function. |
| $this | [floorMicrosecond()](#floormicrosecond) | Truncate the current instance microsecond with given precision. |
| $this | [floorMicroseconds()](#floormicroseconds) | Truncate the current instance microsecond with given precision. |
| $this | [ceilMicrosecond()](#ceilmicrosecond) | Ceil the current instance microsecond with given precision. |
| $this | [ceilMicroseconds()](#ceilmicroseconds) | Ceil the current instance microsecond with given precision. |
| string | [shortAbsoluteDiffForHumans()](#shortabsolutediffforhumans) |  |
| string | [longAbsoluteDiffForHumans()](#longabsolutediffforhumans) |  |
| string | [shortRelativeDiffForHumans()](#shortrelativediffforhumans) |  |
| string | [longRelativeDiffForHumans()](#longrelativediffforhumans) |  |
| string | [shortRelativeToNowDiffForHumans()](#shortrelativetonowdiffforhumans) |  |
| string | [longRelativeToNowDiffForHumans()](#longrelativetonowdiffforhumans) |  |
| string | [shortRelativeToOtherDiffForHumans()](#shortrelativetootherdiffforhumans) |  |
| string | [longRelativeToOtherDiffForHumans()](#longrelativetootherdiffforhumans) |  |
| static|false | [createFromFormat()](#createfromformat) | Parse a string into a new Carbon object according to the specified format. |
| static | [__set_state()](#__set_state) | https://php.net/manual/en/datetime.set-state.php

</autodoc> |

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
public bool isSameYear($date = &#039;null&#039;) Checks if the given date is in the same year as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same year as the instance. If null passed` |  |
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

### isSameWeek

```php
public bool isSameWeek($date = &#039;null&#039;) Checks if the given date is in the same week as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same week as the instance. If null passed` |  |
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
public bool isSameDay($date = &#039;null&#039;) Checks if the given date is in the same day as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same day as the instance. If null passed` |  |
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
public bool isSameHour($date = &#039;null&#039;) Checks if the given date is in the same hour as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same hour as the instance. If null passed` |  |
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
public bool isSameMinute($date = &#039;null&#039;) Checks if the given date is in the same minute as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same minute as the instance. If null passed` |  |
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
public bool isSameSecond($date = &#039;null&#039;) Checks if the given date is in the same second as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same second as the instance. If null passed` |  |
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

### isSameMicro

```php
public bool isSameMicro($date = &#039;null&#039;) Checks if the given date is in the same microsecond as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same microsecond as the instance. If null passed` |  |
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
public bool isSameMicrosecond($date = &#039;null&#039;) Checks if the given date is in the same microsecond as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same microsecond as the instance. If null passed` |  |
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

### isSameDecade

```php
public bool isSameDecade($date = &#039;null&#039;) Checks if the given date is in the same decade as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same decade as the instance. If null passed` |  |
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
public bool isSameCentury($date = &#039;null&#039;) Checks if the given date is in the same century as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same century as the instance. If null passed` |  |
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
public bool isSameMillennium($date = &#039;null&#039;) Checks if the given date is in the same millennium as the instance. If null passed, $o now (with the same timezone)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| DateTimeInterface|string|null | `$date` | `&#039;null&#039;) Checks if the given date is in the same millennium as the instance. If null passed` |  |
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
| int | `$value` | —  |  |

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
| int | `$value` | —  |  |

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
| int | `$value` | —  |  |

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
| int | `$value` | —  |  |

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
public $this setMicrosecond($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** $this
---

### addYears

```php
public $this addYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add weekdays (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub weekdays (the $value count passed in) to the instance (using date interval` |  |

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

### addRealMicros

```php
public $this addRealMicros($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealMicro

```php
public $this addRealMicro($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealMicros

```php
public $this subRealMicros($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealMicro

```php
public $this subRealMicro($ub one microsecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealMicroseconds

```php
public $this addRealMicroseconds($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealMicrosecond

```php
public $this addRealMicrosecond($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealMicroseconds

```php
public $this subRealMicroseconds($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealMicrosecond

```php
public $this subRealMicrosecond($ub one microsecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealMillis

```php
public $this addRealMillis($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealMilli

```php
public $this addRealMilli($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealMillis

```php
public $this subRealMillis($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealMilli

```php
public $this subRealMilli($ub one millisecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealMilliseconds

```php
public $this addRealMilliseconds($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealMillisecond

```php
public $this addRealMillisecond($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealMilliseconds

```php
public $this subRealMilliseconds($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealMillisecond

```php
public $this subRealMillisecond($ub one millisecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealSeconds

```php
public $this addRealSeconds($value = &#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealSecond

```php
public $this addRealSecond($dd one second to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one second to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealSeconds

```php
public $this subRealSeconds($value = &#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealSecond

```php
public $this subRealSecond($ub one second to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealMinutes

```php
public $this addRealMinutes($value = &#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealMinute

```php
public $this addRealMinute($dd one minute to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one minute to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealMinutes

```php
public $this subRealMinutes($value = &#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealMinute

```php
public $this subRealMinute($ub one minute to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealHours

```php
public $this addRealHours($value = &#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealHour

```php
public $this addRealHour($dd one hour to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one hour to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealHours

```php
public $this subRealHours($value = &#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealHour

```php
public $this subRealHour($ub one hour to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealDays

```php
public $this addRealDays($value = &#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealDay

```php
public $this addRealDay($dd one day to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one day to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealDays

```php
public $this subRealDays($value = &#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealDay

```php
public $this subRealDay($ub one day to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealWeeks

```php
public $this addRealWeeks($value = &#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealWeek

```php
public $this addRealWeek($dd one week to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one week to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealWeeks

```php
public $this subRealWeeks($value = &#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealWeek

```php
public $this subRealWeek($ub one week to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealMonths

```php
public $this addRealMonths($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealMonth

```php
public $this addRealMonth($dd one month to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealMonths

```php
public $this subRealMonths($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealMonth

```php
public $this subRealMonth($ub one month to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealQuarters

```php
public $this addRealQuarters($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealQuarter

```php
public $this addRealQuarter($dd one quarter to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealQuarters

```php
public $this subRealQuarters($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealQuarter

```php
public $this subRealQuarter($ub one quarter to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealYears

```php
public $this addRealYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealYear

```php
public $this addRealYear($dd one year to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealYears

```php
public $this subRealYears($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealYear

```php
public $this subRealYear($ub one year to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealDecades

```php
public $this addRealDecades($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealDecade

```php
public $this addRealDecade($dd one decade to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealDecades

```php
public $this subRealDecades($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealDecade

```php
public $this subRealDecade($ub one decade to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealCenturies

```php
public $this addRealCenturies($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealCentury

```php
public $this addRealCentury($dd one century to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealCenturies

```php
public $this subRealCenturies($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealCentury

```php
public $this subRealCentury($ub one century to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
---

### addRealMillennia

```php
public $this addRealMillennia($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### addRealMillennium

```php
public $this addRealMillennium($dd one millennium to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using timestamp` | —  |  |

**Returns:** $this
---

### subRealMillennia

```php
public $this subRealMillennia($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** $this
---

### subRealMillennium

```php
public $this subRealMillennium($ub one millennium to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** CarbonPeriod
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

### createFromFormat

```php
static public static|false createFromFormat($format, $time, $timezone = &#039;null&#039;)
```

Parse a string into a new Carbon object according to the specified format.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$format` | —  |  |
| string | `$time` | —  |  |
| DateTimeZone|string|false|null | `$timezone` | `&#039;null&#039;` |  |

**Returns:** static|false
---

### __set_state

```php
static public static __set_state($array)
```

https://php.net/manual/en/datetime.set-state.php

</autodoc>

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| array | `$array` | —  |  |

**Returns:** static
---

