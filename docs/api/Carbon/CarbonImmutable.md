# CarbonImmutable

**Namespace:** `Carbon`

class **CarbonImmutable** extends [DateTimeImmutable](https://www.php.net/class.datetimeimmutable) implements CarbonInterface

A simple API extension for DateTimeImmutable.

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
| CarbonImmutable | [startOfTime()](#startoftime) | Create a very old date representing start of time. |
| CarbonImmutable | [endOfTime()](#endoftime) | Create a very far date representing end of time. |
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
| CarbonImmutable | [years()](#years) | Set current instance year to the given value. |
| CarbonImmutable | [year()](#year) | Set current instance year to the given value. |
| CarbonImmutable | [setYears()](#setyears) | Set current instance year to the given value. |
| CarbonImmutable | [setYear()](#setyear) | Set current instance year to the given value. |
| CarbonImmutable | [months()](#months) | Set current instance month to the given value. |
| CarbonImmutable | [month()](#month) | Set current instance month to the given value. |
| CarbonImmutable | [setMonths()](#setmonths) | Set current instance month to the given value. |
| CarbonImmutable | [setMonth()](#setmonth) | Set current instance month to the given value. |
| CarbonImmutable | [days()](#days) | Set current instance day to the given value. |
| CarbonImmutable | [day()](#day) | Set current instance day to the given value. |
| CarbonImmutable | [setDays()](#setdays) | Set current instance day to the given value. |
| CarbonImmutable | [setDay()](#setday) | Set current instance day to the given value. |
| CarbonImmutable | [hours()](#hours) | Set current instance hour to the given value. |
| CarbonImmutable | [hour()](#hour) | Set current instance hour to the given value. |
| CarbonImmutable | [setHours()](#sethours) | Set current instance hour to the given value. |
| CarbonImmutable | [setHour()](#sethour) | Set current instance hour to the given value. |
| CarbonImmutable | [minutes()](#minutes) | Set current instance minute to the given value. |
| CarbonImmutable | [minute()](#minute) | Set current instance minute to the given value. |
| CarbonImmutable | [setMinutes()](#setminutes) | Set current instance minute to the given value. |
| CarbonImmutable | [setMinute()](#setminute) | Set current instance minute to the given value. |
| CarbonImmutable | [seconds()](#seconds) | Set current instance second to the given value. |
| CarbonImmutable | [second()](#second) | Set current instance second to the given value. |
| CarbonImmutable | [setSeconds()](#setseconds) | Set current instance second to the given value. |
| CarbonImmutable | [setSecond()](#setsecond) | Set current instance second to the given value. |
| CarbonImmutable | [millis()](#millis) | Set current instance millisecond to the given value. |
| CarbonImmutable | [milli()](#milli) | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMillis()](#setmillis) | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMilli()](#setmilli) | Set current instance millisecond to the given value. |
| CarbonImmutable | [milliseconds()](#milliseconds) | Set current instance millisecond to the given value. |
| CarbonImmutable | [millisecond()](#millisecond) | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMilliseconds()](#setmilliseconds) | Set current instance millisecond to the given value. |
| CarbonImmutable | [setMillisecond()](#setmillisecond) | Set current instance millisecond to the given value. |
| CarbonImmutable | [micros()](#micros) | Set current instance microsecond to the given value. |
| CarbonImmutable | [micro()](#micro) | Set current instance microsecond to the given value. |
| CarbonImmutable | [setMicros()](#setmicros) | Set current instance microsecond to the given value. |
| CarbonImmutable | [setMicro()](#setmicro) | Set current instance microsecond to the given value. |
| CarbonImmutable | [microseconds()](#microseconds) | Set current instance microsecond to the given value. |
| CarbonImmutable | [microsecond()](#microsecond) | Set current instance microsecond to the given value. |
| CarbonImmutable | [setMicroseconds()](#setmicroseconds) | Set current instance microsecond to the given value. |
| CarbonImmutable | [setMicrosecond()](#setmicrosecond) | Set current instance microsecond to the given value. |
| CarbonImmutable | [addYears()](#addyears) | . |
| CarbonImmutable | [addYear()](#addyear) | . |
| CarbonImmutable | [subYears()](#subyears) | . |
| CarbonImmutable | [subYear()](#subyear) | . |
| CarbonImmutable | [addYearsWithOverflow()](#addyearswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addYearWithOverflow()](#addyearwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subYearsWithOverflow()](#subyearswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subYearWithOverflow()](#subyearwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addYearsWithoutOverflow()](#addyearswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearWithoutOverflow()](#addyearwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearsWithoutOverflow()](#subyearswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearWithoutOverflow()](#subyearwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearsWithNoOverflow()](#addyearswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearWithNoOverflow()](#addyearwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearsWithNoOverflow()](#subyearswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearWithNoOverflow()](#subyearwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearsNoOverflow()](#addyearsnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addYearNoOverflow()](#addyearnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearsNoOverflow()](#subyearsnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subYearNoOverflow()](#subyearnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonths()](#addmonths) | . |
| CarbonImmutable | [addMonth()](#addmonth) | . |
| CarbonImmutable | [subMonths()](#submonths) | . |
| CarbonImmutable | [subMonth()](#submonth) | . |
| CarbonImmutable | [addMonthsWithOverflow()](#addmonthswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addMonthWithOverflow()](#addmonthwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subMonthsWithOverflow()](#submonthswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subMonthWithOverflow()](#submonthwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addMonthsWithoutOverflow()](#addmonthswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthWithoutOverflow()](#addmonthwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthsWithoutOverflow()](#submonthswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthWithoutOverflow()](#submonthwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthsWithNoOverflow()](#addmonthswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthWithNoOverflow()](#addmonthwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthsWithNoOverflow()](#submonthswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthWithNoOverflow()](#submonthwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthsNoOverflow()](#addmonthsnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMonthNoOverflow()](#addmonthnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthsNoOverflow()](#submonthsnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMonthNoOverflow()](#submonthnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addDays()](#adddays) | . |
| CarbonImmutable | [addDay()](#addday) | . |
| CarbonImmutable | [subDays()](#subdays) | . |
| CarbonImmutable | [subDay()](#subday) | . |
| CarbonImmutable | [addHours()](#addhours) | . |
| CarbonImmutable | [addHour()](#addhour) | . |
| CarbonImmutable | [subHours()](#subhours) | . |
| CarbonImmutable | [subHour()](#subhour) | . |
| CarbonImmutable | [addMinutes()](#addminutes) | . |
| CarbonImmutable | [addMinute()](#addminute) | . |
| CarbonImmutable | [subMinutes()](#subminutes) | . |
| CarbonImmutable | [subMinute()](#subminute) | . |
| CarbonImmutable | [addSeconds()](#addseconds) | . |
| CarbonImmutable | [addSecond()](#addsecond) | . |
| CarbonImmutable | [subSeconds()](#subseconds) | . |
| CarbonImmutable | [subSecond()](#subsecond) | . |
| CarbonImmutable | [addMillis()](#addmillis) | . |
| CarbonImmutable | [addMilli()](#addmilli) | . |
| CarbonImmutable | [subMillis()](#submillis) | . |
| CarbonImmutable | [subMilli()](#submilli) | . |
| CarbonImmutable | [addMilliseconds()](#addmilliseconds) | . |
| CarbonImmutable | [addMillisecond()](#addmillisecond) | . |
| CarbonImmutable | [subMilliseconds()](#submilliseconds) | . |
| CarbonImmutable | [subMillisecond()](#submillisecond) | . |
| CarbonImmutable | [addMicros()](#addmicros) | . |
| CarbonImmutable | [addMicro()](#addmicro) | . |
| CarbonImmutable | [subMicros()](#submicros) | . |
| CarbonImmutable | [subMicro()](#submicro) | . |
| CarbonImmutable | [addMicroseconds()](#addmicroseconds) | . |
| CarbonImmutable | [addMicrosecond()](#addmicrosecond) | . |
| CarbonImmutable | [subMicroseconds()](#submicroseconds) | . |
| CarbonImmutable | [subMicrosecond()](#submicrosecond) | . |
| CarbonImmutable | [addMillennia()](#addmillennia) | . |
| CarbonImmutable | [addMillennium()](#addmillennium) | . |
| CarbonImmutable | [subMillennia()](#submillennia) | . |
| CarbonImmutable | [subMillennium()](#submillennium) | . |
| CarbonImmutable | [addMillenniaWithOverflow()](#addmillenniawithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addMillenniumWithOverflow()](#addmillenniumwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subMillenniaWithOverflow()](#submillenniawithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subMillenniumWithOverflow()](#submillenniumwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addMillenniaWithoutOverflow()](#addmillenniawithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniumWithoutOverflow()](#addmillenniumwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniaWithoutOverflow()](#submillenniawithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniumWithoutOverflow()](#submillenniumwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniaWithNoOverflow()](#addmillenniawithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniumWithNoOverflow()](#addmillenniumwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniaWithNoOverflow()](#submillenniawithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniumWithNoOverflow()](#submillenniumwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniaNoOverflow()](#addmillennianooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addMillenniumNoOverflow()](#addmillenniumnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniaNoOverflow()](#submillennianooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subMillenniumNoOverflow()](#submillenniumnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturies()](#addcenturies) | . |
| CarbonImmutable | [addCentury()](#addcentury) | . |
| CarbonImmutable | [subCenturies()](#subcenturies) | . |
| CarbonImmutable | [subCentury()](#subcentury) | . |
| CarbonImmutable | [addCenturiesWithOverflow()](#addcenturieswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addCenturyWithOverflow()](#addcenturywithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subCenturiesWithOverflow()](#subcenturieswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subCenturyWithOverflow()](#subcenturywithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addCenturiesWithoutOverflow()](#addcenturieswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturyWithoutOverflow()](#addcenturywithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturiesWithoutOverflow()](#subcenturieswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturyWithoutOverflow()](#subcenturywithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturiesWithNoOverflow()](#addcenturieswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturyWithNoOverflow()](#addcenturywithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturiesWithNoOverflow()](#subcenturieswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturyWithNoOverflow()](#subcenturywithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturiesNoOverflow()](#addcenturiesnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addCenturyNoOverflow()](#addcenturynooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturiesNoOverflow()](#subcenturiesnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subCenturyNoOverflow()](#subcenturynooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecades()](#adddecades) | . |
| CarbonImmutable | [addDecade()](#adddecade) | . |
| CarbonImmutable | [subDecades()](#subdecades) | . |
| CarbonImmutable | [subDecade()](#subdecade) | . |
| CarbonImmutable | [addDecadesWithOverflow()](#adddecadeswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addDecadeWithOverflow()](#adddecadewithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subDecadesWithOverflow()](#subdecadeswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subDecadeWithOverflow()](#subdecadewithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addDecadesWithoutOverflow()](#adddecadeswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadeWithoutOverflow()](#adddecadewithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadesWithoutOverflow()](#subdecadeswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadeWithoutOverflow()](#subdecadewithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadesWithNoOverflow()](#adddecadeswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadeWithNoOverflow()](#adddecadewithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadesWithNoOverflow()](#subdecadeswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadeWithNoOverflow()](#subdecadewithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadesNoOverflow()](#adddecadesnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addDecadeNoOverflow()](#adddecadenooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadesNoOverflow()](#subdecadesnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subDecadeNoOverflow()](#subdecadenooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarters()](#addquarters) | . |
| CarbonImmutable | [addQuarter()](#addquarter) | . |
| CarbonImmutable | [subQuarters()](#subquarters) | . |
| CarbonImmutable | [subQuarter()](#subquarter) | . |
| CarbonImmutable | [addQuartersWithOverflow()](#addquarterswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addQuarterWithOverflow()](#addquarterwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subQuartersWithOverflow()](#subquarterswithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [subQuarterWithOverflow()](#subquarterwithoverflow) | with overflow explicitly allowed. |
| CarbonImmutable | [addQuartersWithoutOverflow()](#addquarterswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarterWithoutOverflow()](#addquarterwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuartersWithoutOverflow()](#subquarterswithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuarterWithoutOverflow()](#subquarterwithoutoverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuartersWithNoOverflow()](#addquarterswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarterWithNoOverflow()](#addquarterwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuartersWithNoOverflow()](#subquarterswithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuarterWithNoOverflow()](#subquarterwithnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuartersNoOverflow()](#addquartersnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addQuarterNoOverflow()](#addquarternooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuartersNoOverflow()](#subquartersnooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [subQuarterNoOverflow()](#subquarternooverflow) | with overflow explicitly forbidden. |
| CarbonImmutable | [addWeeks()](#addweeks) | . |
| CarbonImmutable | [addWeek()](#addweek) | . |
| CarbonImmutable | [subWeeks()](#subweeks) | . |
| CarbonImmutable | [subWeek()](#subweek) | . |
| CarbonImmutable | [addWeekdays()](#addweekdays) | . |
| CarbonImmutable | [addWeekday()](#addweekday) | . |
| CarbonImmutable | [subWeekdays()](#subweekdays) | . |
| CarbonImmutable | [subWeekday()](#subweekday) | . |
| CarbonImmutable | [addRealMicros()](#addrealmicros) | . |
| CarbonImmutable | [addRealMicro()](#addrealmicro) | . |
| CarbonImmutable | [subRealMicros()](#subrealmicros) | . |
| CarbonImmutable | [subRealMicro()](#subrealmicro) | . |
| CarbonPeriod | [microsUntil()](#microsuntil) | for each microsecond or every X microseconds if a factor is given. |
| CarbonImmutable | [addRealMicroseconds()](#addrealmicroseconds) | . |
| CarbonImmutable | [addRealMicrosecond()](#addrealmicrosecond) | . |
| CarbonImmutable | [subRealMicroseconds()](#subrealmicroseconds) | . |
| CarbonImmutable | [subRealMicrosecond()](#subrealmicrosecond) | . |
| CarbonPeriod | [microsecondsUntil()](#microsecondsuntil) | for each microsecond or every X microseconds if a factor is given. |
| CarbonImmutable | [addRealMillis()](#addrealmillis) | . |
| CarbonImmutable | [addRealMilli()](#addrealmilli) | . |
| CarbonImmutable | [subRealMillis()](#subrealmillis) | . |
| CarbonImmutable | [subRealMilli()](#subrealmilli) | . |
| CarbonPeriod | [millisUntil()](#millisuntil) | for each millisecond or every X milliseconds if a factor is given. |
| CarbonImmutable | [addRealMilliseconds()](#addrealmilliseconds) | . |
| CarbonImmutable | [addRealMillisecond()](#addrealmillisecond) | . |
| CarbonImmutable | [subRealMilliseconds()](#subrealmilliseconds) | . |
| CarbonImmutable | [subRealMillisecond()](#subrealmillisecond) | . |
| CarbonPeriod | [millisecondsUntil()](#millisecondsuntil) | for each millisecond or every X milliseconds if a factor is given. |
| CarbonImmutable | [addRealSeconds()](#addrealseconds) | . |
| CarbonImmutable | [addRealSecond()](#addrealsecond) | . |
| CarbonImmutable | [subRealSeconds()](#subrealseconds) | . |
| CarbonImmutable | [subRealSecond()](#subrealsecond) | . |
| CarbonPeriod | [secondsUntil()](#secondsuntil) | for each second or every X seconds if a factor is given. |
| CarbonImmutable | [addRealMinutes()](#addrealminutes) | . |
| CarbonImmutable | [addRealMinute()](#addrealminute) | . |
| CarbonImmutable | [subRealMinutes()](#subrealminutes) | . |
| CarbonImmutable | [subRealMinute()](#subrealminute) | . |
| CarbonPeriod | [minutesUntil()](#minutesuntil) | for each minute or every X minutes if a factor is given. |
| CarbonImmutable | [addRealHours()](#addrealhours) | . |
| CarbonImmutable | [addRealHour()](#addrealhour) | . |
| CarbonImmutable | [subRealHours()](#subrealhours) | . |
| CarbonImmutable | [subRealHour()](#subrealhour) | . |
| CarbonPeriod | [hoursUntil()](#hoursuntil) | for each hour or every X hours if a factor is given. |
| CarbonImmutable | [addRealDays()](#addrealdays) | . |
| CarbonImmutable | [addRealDay()](#addrealday) | . |
| CarbonImmutable | [subRealDays()](#subrealdays) | . |
| CarbonImmutable | [subRealDay()](#subrealday) | . |
| CarbonPeriod | [daysUntil()](#daysuntil) | for each day or every X days if a factor is given. |
| CarbonImmutable | [addRealWeeks()](#addrealweeks) | . |
| CarbonImmutable | [addRealWeek()](#addrealweek) | . |
| CarbonImmutable | [subRealWeeks()](#subrealweeks) | . |
| CarbonImmutable | [subRealWeek()](#subrealweek) | . |
| CarbonPeriod | [weeksUntil()](#weeksuntil) | for each week or every X weeks if a factor is given. |
| CarbonImmutable | [addRealMonths()](#addrealmonths) | . |
| CarbonImmutable | [addRealMonth()](#addrealmonth) | . |
| CarbonImmutable | [subRealMonths()](#subrealmonths) | . |
| CarbonImmutable | [subRealMonth()](#subrealmonth) | . |
| CarbonPeriod | [monthsUntil()](#monthsuntil) | for each month or every X months if a factor is given. |
| CarbonImmutable | [addRealQuarters()](#addrealquarters) | . |
| CarbonImmutable | [addRealQuarter()](#addrealquarter) | . |
| CarbonImmutable | [subRealQuarters()](#subrealquarters) | . |
| CarbonImmutable | [subRealQuarter()](#subrealquarter) | . |
| CarbonPeriod | [quartersUntil()](#quartersuntil) | for each quarter or every X quarters if a factor is given. |
| CarbonImmutable | [addRealYears()](#addrealyears) | . |
| CarbonImmutable | [addRealYear()](#addrealyear) | . |
| CarbonImmutable | [subRealYears()](#subrealyears) | . |
| CarbonImmutable | [subRealYear()](#subrealyear) | . |
| CarbonPeriod | [yearsUntil()](#yearsuntil) | for each year or every X years if a factor is given. |
| CarbonImmutable | [addRealDecades()](#addrealdecades) | . |
| CarbonImmutable | [addRealDecade()](#addrealdecade) | . |
| CarbonImmutable | [subRealDecades()](#subrealdecades) | . |
| CarbonImmutable | [subRealDecade()](#subrealdecade) | . |
| CarbonPeriod | [decadesUntil()](#decadesuntil) | for each decade or every X decades if a factor is given. |
| CarbonImmutable | [addRealCenturies()](#addrealcenturies) | . |
| CarbonImmutable | [addRealCentury()](#addrealcentury) | . |
| CarbonImmutable | [subRealCenturies()](#subrealcenturies) | . |
| CarbonImmutable | [subRealCentury()](#subrealcentury) | . |
| CarbonPeriod | [centuriesUntil()](#centuriesuntil) | for each century or every X centuries if a factor is given. |
| CarbonImmutable | [addRealMillennia()](#addrealmillennia) | . |
| CarbonImmutable | [addRealMillennium()](#addrealmillennium) | . |
| CarbonImmutable | [subRealMillennia()](#subrealmillennia) | . |
| CarbonImmutable | [subRealMillennium()](#subrealmillennium) | . |
| CarbonPeriod | [millenniaUntil()](#millenniauntil) | for each millennium or every X millennia if a factor is given. |
| CarbonImmutable | [roundYear()](#roundyear) | Round the current instance year with given precision using the given function. |
| CarbonImmutable | [roundYears()](#roundyears) | Round the current instance year with given precision using the given function. |
| CarbonImmutable | [floorYear()](#flooryear) | Truncate the current instance year with given precision. |
| CarbonImmutable | [floorYears()](#flooryears) | Truncate the current instance year with given precision. |
| CarbonImmutable | [ceilYear()](#ceilyear) | Ceil the current instance year with given precision. |
| CarbonImmutable | [ceilYears()](#ceilyears) | Ceil the current instance year with given precision. |
| CarbonImmutable | [roundMonth()](#roundmonth) | Round the current instance month with given precision using the given function. |
| CarbonImmutable | [roundMonths()](#roundmonths) | Round the current instance month with given precision using the given function. |
| CarbonImmutable | [floorMonth()](#floormonth) | Truncate the current instance month with given precision. |
| CarbonImmutable | [floorMonths()](#floormonths) | Truncate the current instance month with given precision. |
| CarbonImmutable | [ceilMonth()](#ceilmonth) | Ceil the current instance month with given precision. |
| CarbonImmutable | [ceilMonths()](#ceilmonths) | Ceil the current instance month with given precision. |
| CarbonImmutable | [roundDay()](#roundday) | Round the current instance day with given precision using the given function. |
| CarbonImmutable | [roundDays()](#rounddays) | Round the current instance day with given precision using the given function. |
| CarbonImmutable | [floorDay()](#floorday) | Truncate the current instance day with given precision. |
| CarbonImmutable | [floorDays()](#floordays) | Truncate the current instance day with given precision. |
| CarbonImmutable | [ceilDay()](#ceilday) | Ceil the current instance day with given precision. |
| CarbonImmutable | [ceilDays()](#ceildays) | Ceil the current instance day with given precision. |
| CarbonImmutable | [roundHour()](#roundhour) | Round the current instance hour with given precision using the given function. |
| CarbonImmutable | [roundHours()](#roundhours) | Round the current instance hour with given precision using the given function. |
| CarbonImmutable | [floorHour()](#floorhour) | Truncate the current instance hour with given precision. |
| CarbonImmutable | [floorHours()](#floorhours) | Truncate the current instance hour with given precision. |
| CarbonImmutable | [ceilHour()](#ceilhour) | Ceil the current instance hour with given precision. |
| CarbonImmutable | [ceilHours()](#ceilhours) | Ceil the current instance hour with given precision. |
| CarbonImmutable | [roundMinute()](#roundminute) | Round the current instance minute with given precision using the given function. |
| CarbonImmutable | [roundMinutes()](#roundminutes) | Round the current instance minute with given precision using the given function. |
| CarbonImmutable | [floorMinute()](#floorminute) | Truncate the current instance minute with given precision. |
| CarbonImmutable | [floorMinutes()](#floorminutes) | Truncate the current instance minute with given precision. |
| CarbonImmutable | [ceilMinute()](#ceilminute) | Ceil the current instance minute with given precision. |
| CarbonImmutable | [ceilMinutes()](#ceilminutes) | Ceil the current instance minute with given precision. |
| CarbonImmutable | [roundSecond()](#roundsecond) | Round the current instance second with given precision using the given function. |
| CarbonImmutable | [roundSeconds()](#roundseconds) | Round the current instance second with given precision using the given function. |
| CarbonImmutable | [floorSecond()](#floorsecond) | Truncate the current instance second with given precision. |
| CarbonImmutable | [floorSeconds()](#floorseconds) | Truncate the current instance second with given precision. |
| CarbonImmutable | [ceilSecond()](#ceilsecond) | Ceil the current instance second with given precision. |
| CarbonImmutable | [ceilSeconds()](#ceilseconds) | Ceil the current instance second with given precision. |
| CarbonImmutable | [roundMillennium()](#roundmillennium) | Round the current instance millennium with given precision using the given function. |
| CarbonImmutable | [roundMillennia()](#roundmillennia) | Round the current instance millennium with given precision using the given function. |
| CarbonImmutable | [floorMillennium()](#floormillennium) | Truncate the current instance millennium with given precision. |
| CarbonImmutable | [floorMillennia()](#floormillennia) | Truncate the current instance millennium with given precision. |
| CarbonImmutable | [ceilMillennium()](#ceilmillennium) | Ceil the current instance millennium with given precision. |
| CarbonImmutable | [ceilMillennia()](#ceilmillennia) | Ceil the current instance millennium with given precision. |
| CarbonImmutable | [roundCentury()](#roundcentury) | Round the current instance century with given precision using the given function. |
| CarbonImmutable | [roundCenturies()](#roundcenturies) | Round the current instance century with given precision using the given function. |
| CarbonImmutable | [floorCentury()](#floorcentury) | Truncate the current instance century with given precision. |
| CarbonImmutable | [floorCenturies()](#floorcenturies) | Truncate the current instance century with given precision. |
| CarbonImmutable | [ceilCentury()](#ceilcentury) | Ceil the current instance century with given precision. |
| CarbonImmutable | [ceilCenturies()](#ceilcenturies) | Ceil the current instance century with given precision. |
| CarbonImmutable | [roundDecade()](#rounddecade) | Round the current instance decade with given precision using the given function. |
| CarbonImmutable | [roundDecades()](#rounddecades) | Round the current instance decade with given precision using the given function. |
| CarbonImmutable | [floorDecade()](#floordecade) | Truncate the current instance decade with given precision. |
| CarbonImmutable | [floorDecades()](#floordecades) | Truncate the current instance decade with given precision. |
| CarbonImmutable | [ceilDecade()](#ceildecade) | Ceil the current instance decade with given precision. |
| CarbonImmutable | [ceilDecades()](#ceildecades) | Ceil the current instance decade with given precision. |
| CarbonImmutable | [roundQuarter()](#roundquarter) | Round the current instance quarter with given precision using the given function. |
| CarbonImmutable | [roundQuarters()](#roundquarters) | Round the current instance quarter with given precision using the given function. |
| CarbonImmutable | [floorQuarter()](#floorquarter) | Truncate the current instance quarter with given precision. |
| CarbonImmutable | [floorQuarters()](#floorquarters) | Truncate the current instance quarter with given precision. |
| CarbonImmutable | [ceilQuarter()](#ceilquarter) | Ceil the current instance quarter with given precision. |
| CarbonImmutable | [ceilQuarters()](#ceilquarters) | Ceil the current instance quarter with given precision. |
| CarbonImmutable | [roundMillisecond()](#roundmillisecond) | Round the current instance millisecond with given precision using the given function. |
| CarbonImmutable | [roundMilliseconds()](#roundmilliseconds) | Round the current instance millisecond with given precision using the given function. |
| CarbonImmutable | [floorMillisecond()](#floormillisecond) | Truncate the current instance millisecond with given precision. |
| CarbonImmutable | [floorMilliseconds()](#floormilliseconds) | Truncate the current instance millisecond with given precision. |
| CarbonImmutable | [ceilMillisecond()](#ceilmillisecond) | Ceil the current instance millisecond with given precision. |
| CarbonImmutable | [ceilMilliseconds()](#ceilmilliseconds) | Ceil the current instance millisecond with given precision. |
| CarbonImmutable | [roundMicrosecond()](#roundmicrosecond) | Round the current instance microsecond with given precision using the given function. |
| CarbonImmutable | [roundMicroseconds()](#roundmicroseconds) | Round the current instance microsecond with given precision using the given function. |
| CarbonImmutable | [floorMicrosecond()](#floormicrosecond) | Truncate the current instance microsecond with given precision. |
| CarbonImmutable | [floorMicroseconds()](#floormicroseconds) | Truncate the current instance microsecond with given precision. |
| CarbonImmutable | [ceilMicrosecond()](#ceilmicrosecond) | Ceil the current instance microsecond with given precision. |
| CarbonImmutable | [ceilMicroseconds()](#ceilmicroseconds) | Ceil the current instance microsecond with given precision. |
| string | [shortAbsoluteDiffForHumans()](#shortabsolutediffforhumans) |  |
| string | [longAbsoluteDiffForHumans()](#longabsolutediffforhumans) |  |
| string | [shortRelativeDiffForHumans()](#shortrelativediffforhumans) |  |
| string | [longRelativeDiffForHumans()](#longrelativediffforhumans) |  |
| string | [shortRelativeToNowDiffForHumans()](#shortrelativetonowdiffforhumans) |  |
| string | [longRelativeToNowDiffForHumans()](#longrelativetonowdiffforhumans) |  |
| string | [shortRelativeToOtherDiffForHumans()](#shortrelativetootherdiffforhumans) |  |
| string | [longRelativeToOtherDiffForHumans()](#longrelativetootherdiffforhumans) |  |
| static|false | [createFromFormat()](#createfromformat) | Parse a string into a new CarbonImmutable object according to the specified format. |
| static | [__set_state()](#__set_state) | https://php.net/manual/en/datetime.set-state.php

</autodoc> |

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
| int | `$value` | —  |  |

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
| int | `$value` | —  |  |

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
| int | `$value` | —  |  |

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
| int | `$value` | —  |  |

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
public CarbonImmutable setMicrosecond($value)
```

Set current instance microsecond to the given value.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addYears

```php
public CarbonImmutable addYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Add weekdays (the $value count passed in) to the instance (using date interval` |  |

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
| int | `$value` | `&#039;1&#039;) Sub weekdays (the $value count passed in) to the instance (using date interval` |  |

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

### addRealMicros

```php
public CarbonImmutable addRealMicros($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealMicro

```php
public CarbonImmutable addRealMicro($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMicros

```php
public CarbonImmutable subRealMicros($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMicro

```php
public CarbonImmutable subRealMicro($ub one microsecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealMicroseconds

```php
public CarbonImmutable addRealMicroseconds($value = &#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealMicrosecond

```php
public CarbonImmutable addRealMicrosecond($dd one microsecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one microsecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMicroseconds

```php
public CarbonImmutable subRealMicroseconds($value = &#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub microseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMicrosecond

```php
public CarbonImmutable subRealMicrosecond($ub one microsecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealMillis

```php
public CarbonImmutable addRealMillis($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealMilli

```php
public CarbonImmutable addRealMilli($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMillis

```php
public CarbonImmutable subRealMillis($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMilli

```php
public CarbonImmutable subRealMilli($ub one millisecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealMilliseconds

```php
public CarbonImmutable addRealMilliseconds($value = &#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealMillisecond

```php
public CarbonImmutable addRealMillisecond($dd one millisecond to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millisecond to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMilliseconds

```php
public CarbonImmutable subRealMilliseconds($value = &#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub milliseconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMillisecond

```php
public CarbonImmutable subRealMillisecond($ub one millisecond to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealSeconds

```php
public CarbonImmutable addRealSeconds($value = &#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealSecond

```php
public CarbonImmutable addRealSecond($dd one second to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one second to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealSeconds

```php
public CarbonImmutable subRealSeconds($value = &#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub seconds (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealSecond

```php
public CarbonImmutable subRealSecond($ub one second to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealMinutes

```php
public CarbonImmutable addRealMinutes($value = &#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealMinute

```php
public CarbonImmutable addRealMinute($dd one minute to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one minute to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMinutes

```php
public CarbonImmutable subRealMinutes($value = &#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub minutes (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMinute

```php
public CarbonImmutable subRealMinute($ub one minute to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealHours

```php
public CarbonImmutable addRealHours($value = &#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealHour

```php
public CarbonImmutable addRealHour($dd one hour to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one hour to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealHours

```php
public CarbonImmutable subRealHours($value = &#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub hours (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealHour

```php
public CarbonImmutable subRealHour($ub one hour to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealDays

```php
public CarbonImmutable addRealDays($value = &#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealDay

```php
public CarbonImmutable addRealDay($dd one day to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one day to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealDays

```php
public CarbonImmutable subRealDays($value = &#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub days (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealDay

```php
public CarbonImmutable subRealDay($ub one day to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealWeeks

```php
public CarbonImmutable addRealWeeks($value = &#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealWeek

```php
public CarbonImmutable addRealWeek($dd one week to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one week to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealWeeks

```php
public CarbonImmutable subRealWeeks($value = &#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub weeks (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealWeek

```php
public CarbonImmutable subRealWeek($ub one week to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealMonths

```php
public CarbonImmutable addRealMonths($value = &#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealMonth

```php
public CarbonImmutable addRealMonth($dd one month to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one month to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMonths

```php
public CarbonImmutable subRealMonths($value = &#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub months (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMonth

```php
public CarbonImmutable subRealMonth($ub one month to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealQuarters

```php
public CarbonImmutable addRealQuarters($value = &#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealQuarter

```php
public CarbonImmutable addRealQuarter($dd one quarter to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one quarter to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealQuarters

```php
public CarbonImmutable subRealQuarters($value = &#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub quarters (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealQuarter

```php
public CarbonImmutable subRealQuarter($ub one quarter to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealYears

```php
public CarbonImmutable addRealYears($value = &#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealYear

```php
public CarbonImmutable addRealYear($dd one year to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one year to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealYears

```php
public CarbonImmutable subRealYears($value = &#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub years (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealYear

```php
public CarbonImmutable subRealYear($ub one year to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealDecades

```php
public CarbonImmutable addRealDecades($value = &#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealDecade

```php
public CarbonImmutable addRealDecade($dd one decade to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one decade to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealDecades

```php
public CarbonImmutable subRealDecades($value = &#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub decades (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealDecade

```php
public CarbonImmutable subRealDecade($ub one decade to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealCenturies

```php
public CarbonImmutable addRealCenturies($value = &#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealCentury

```php
public CarbonImmutable addRealCentury($dd one century to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one century to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealCenturies

```php
public CarbonImmutable subRealCenturies($value = &#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub centuries (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealCentury

```php
public CarbonImmutable subRealCentury($ub one century to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### addRealMillennia

```php
public CarbonImmutable addRealMillennia($value = &#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Add millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### addRealMillennium

```php
public CarbonImmutable addRealMillennium($dd one millennium to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| ) | `$dd one millennium to the instance (using timestamp` | —  |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMillennia

```php
public CarbonImmutable subRealMillennia($value = &#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp)
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$value` | `&#039;1&#039;) Sub millennia (the $value count passed in) to the instance (using timestamp` |  |

**Returns:** [CarbonImmutable](../Carbon/CarbonImmutable.md)
---

### subRealMillennium

```php
public CarbonImmutable subRealMillennium($ub one millennium to the instance (using timestamp)
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
| int | `$factor` | `&#039;1&#039;) Return an iterable period from current date to given end (string` |  |
| [DateTime](https://www.php.net/class.datetime) | `$r Carbon instance` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
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

### createFromFormat

```php
static public static|false createFromFormat($format, $time, $timezone = &#039;null&#039;)
```

Parse a string into a new CarbonImmutable object according to the specified format.

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

