# CarbonInterval

**Namespace:** `Carbon`

class **CarbonInterval** extends [DateInterval](https://www.php.net/class.dateinterval) implements CarbonConverterInterface, UnitValue

A simple API extension for DateInterval.

The implementation provides helpers to handle weeks but only days are saved.
Weeks are calculated based on the total days of the current instance.

## Traits

- LocalFactory
- IntervalRounding
- IntervalStep
- MagicParameter
- Mixin
- Options
- ToStringFormat

## Constants

| Modifier | Name | Description |
|---|---|---|
| public | `NO_LIMIT` | Unlimited parts for forHumans() method. |
| public | `POSITIVE` |  |
| public | `NEGATIVE` |  |
| public | `PERIOD_PREFIX` | Interval spec period designators |
| public | `PERIOD_YEARS` |  |
| public | `PERIOD_MONTHS` |  |
| public | `PERIOD_DAYS` |  |
| public | `PERIOD_TIME_PREFIX` |  |
| public | `PERIOD_HOURS` |  |
| public | `PERIOD_MINUTES` |  |
| public | `PERIOD_SECONDS` |  |
| public | `SPECIAL_TRANSLATIONS` |  |

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public | int | `$years` | Year component of the current interval. (For P2Y6M, the value will be 2) |
| public | int | `$months` | Month component of the current interval. (For P1Y6M10D, the value will be 6) |
| public | int | `$weeks` | Week component of the current interval calculated from the days. (For P1Y6M17D, the value will be 2) |
| public | int | `$dayz` | Day component of the current interval (weeks * 7 + days). (For P6M17DT20H, the value will be 17) |
| public | int | `$hours` | Hour component of the current interval. (For P7DT20H5M, the value will be 20) |
| public | int | `$minutes` | Minute component of the current interval. (For PT20H5M30S, the value will be 5) |
| public | int | `$seconds` | Second component of the current interval. (CarbonInterval::minutes(2)->seconds(34)->microseconds(567_890)->seconds = 34) |
| public | int | `$milliseconds` | Milliseconds component of the current interval. (CarbonInterval::seconds(34)->microseconds(567_890)->milliseconds = 567) |
| public | int | `$microseconds` | Microseconds component of the current interval. (CarbonInterval::seconds(34)->microseconds(567_890)->microseconds = 567_890) |
| public | int | `$microExcludeMilli` | Remaining microseconds without the milliseconds. |
| public | int | `$dayzExcludeWeeks` | Total days remaining in the final week of the current instance (days % 7). |
| public | int | `$daysExcludeWeeks` | alias of dayzExcludeWeeks |
| public _(read-only)_ | float | `$totalYears` | Number of years equivalent to the interval. (For P1Y6M, the value will be 1.5) |
| public _(read-only)_ | float | `$totalMonths` | Number of months equivalent to the interval. (For P1Y6M10D, the value will be ~12.357) |
| public _(read-only)_ | float | `$totalWeeks` | Number of weeks equivalent to the interval. (For P6M17DT20H, the value will be ~26.548) |
| public _(read-only)_ | float | `$totalDays` | Number of days equivalent to the interval. (For P17DT20H, the value will be ~17.833) |
| public _(read-only)_ | float | `$totalDayz` | Alias for totalDays. |
| public _(read-only)_ | float | `$totalHours` | Number of hours equivalent to the interval. (For P1DT20H5M, the value will be ~44.083) |
| public _(read-only)_ | float | `$totalMinutes` | Number of minutes equivalent to the interval. (For PT20H5M30S, the value will be 1205.5) |
| public _(read-only)_ | float | `$totalSeconds` | Number of seconds equivalent to the interval. (CarbonInterval::minutes(2)->seconds(34)->microseconds(567_890)->totalSeconds = 154.567_890) |
| public _(read-only)_ | float | `$totalMilliseconds` | Number of milliseconds equivalent to the interval. (CarbonInterval::seconds(34)->microseconds(567_890)->totalMilliseconds = 34567.890) |
| public _(read-only)_ | float | `$totalMicroseconds` | Number of microseconds equivalent to the interval. (CarbonInterval::seconds(34)->microseconds(567_890)->totalMicroseconds = 34567890) |
| public _(read-only)_ | string | `$locale` | locale of the current instance |

## Methods

| Return | Method | Description |
|---|---|---|
| CarbonInterval | [setTimezone()](#settimezone) | Set the instance&#039;s timezone from a string or object. |
| CarbonInterval | [shiftTimezone()](#shifttimezone) | Set the instance&#039;s timezone from a string or object and add/subtract the offset difference. |
| array | [getCascadeFactors()](#getcascadefactors) | Mapping of units and factors for cascading. |
|  | [setCascadeFactors()](#setcascadefactors) | Set default cascading factors for -&gt;cascade() method. |
| void | [enableFloatSetters()](#enablefloatsetters) | This option allow you to opt-in for the Carbon 3 behavior where float values will no longer be cast to integer (so truncated). |
| int\|float\|null | [getFactor()](#getfactor) | Returns the factor for a given source-to-target couple. |
| int\|float\|null | [getFactorWithDefault()](#getfactorwithdefault) | Returns the factor for a given source-to-target couple if set, else try to find the appropriate constant as the factor, such as Carbon::DAYS_PER_WEEK. |
| int\|float | [getDaysPerWeek()](#getdaysperweek) | Returns current config for days per week. |
| int\|float | [getHoursPerDay()](#gethoursperday) | Returns current config for hours per day. |
| int\|float | [getMinutesPerHour()](#getminutesperhour) | Returns current config for minutes per hour. |
| int\|float | [getSecondsPerMinute()](#getsecondsperminute) | Returns current config for seconds per minute. |
| int\|float | [getMillisecondsPerSecond()](#getmillisecondspersecond) | Returns current config for microseconds per second. |
| int\|float | [getMicrosecondsPerMillisecond()](#getmicrosecondspermillisecond) | Returns current config for microseconds per second. |
| CarbonInterval | [create()](#create) | Create a new CarbonInterval instance from specific values. |
| CarbonInterval | [createFromFormat()](#createfromformat) | Parse a string into a new CarbonInterval object according to the specified format. |
| array\|int\|string\|DateInterval\|mixed\|null | [original()](#original) | Return the original source used to create the current interval. |
| CarbonInterface\|null | [start()](#start) | Return the start date if interval was created from a difference between 2 dates. |
| CarbonInterface\|null | [end()](#end) | Return the end date if interval was created from a difference between 2 dates. |
| CarbonInterval | [optimize()](#optimize) | Get rid of the original input, start date and end date that may be kept in memory. |
| CarbonInterval | [copy()](#copy) | Get a copy of the instance. |
| CarbonInterval | [clone()](#clone) | Get a copy of the instance. |
| CarbonInterval | [fromString()](#fromstring) | Creates a CarbonInterval from string. |
| CarbonInterval | [parseFromLocale()](#parsefromlocale) | Creates a CarbonInterval from string using a different locale. |
| CarbonInterval | [diff()](#diff) | Create an interval from the difference between 2 dates. |
| CarbonInterval | [abs()](#abs) | Invert the interval if it&#039;s inverted. |
| CarbonInterval | [absolute()](#absolute) |  |
| mixed | [cast()](#cast) | Cast the current instance into the given class. |
| CarbonInterval | [instance()](#instance) | Create a CarbonInterval instance from a DateInterval one.  Can not instance DateInterval objects created from DateTime::diff() as you can&#039;t externally set the $days field. |
| CarbonInterval\|null | [make()](#make) | Make a CarbonInterval instance from given variable if possible. |
| CarbonInterval | [createFromDateString()](#createfromdatestring) | Sets up a DateInterval from the relative parts of the string. |
| int\|float\|string\|null | [get()](#get) | Get a part of the CarbonInterval object. |
| CarbonInterval | [set()](#set) | Set a part of the CarbonInterval object. |
| CarbonInterval | [weeksAndDays()](#weeksanddays) | Allow setting of weeks and days to be cumulative. |
| bool | [isEmpty()](#isempty) | Returns true if the interval is empty for each unit. |
| void | [macro()](#macro) | Register a custom macro. |
| void | [mixin()](#mixin) | Register macros from a mixin object. |
| bool | [hasMacro()](#hasmacro) | Check if macro is registered. |
| array | [toArray()](#toarray) | Returns interval values as an array where key are the unit names and values the counts. |
| array | [getNonZeroValues()](#getnonzerovalues) | Returns interval non-zero values as an array where key are the unit names and values the counts. |
| array | [getValuesSequence()](#getvaluessequence) | Returns interval values as an array where key are the unit names and values the counts from the biggest non-zero one the the smallest non-zero one. |
| string | [forHumans()](#forhumans) | Get the current interval in a human readable format in the current locale. |
| string | [format()](#format) |  |
| DateInterval | [toDateInterval()](#todateinterval) | Return native DateInterval PHP object matching the current instance. |
| CarbonPeriod | [toPeriod()](#toperiod) | Convert the interval to a CarbonPeriod. |
| CarbonPeriod | [stepBy()](#stepby) | Decompose the current interval into |
| CarbonInterval | [invert()](#invert) | Invert the interval. |
| CarbonInterval | [add()](#add) | Add the passed interval to the current instance. |
| CarbonInterval | [sub()](#sub) | Subtract the passed interval to the current instance. |
| CarbonInterval | [subtract()](#subtract) | Subtract the passed interval to the current instance. |
| CarbonInterval | [plus()](#plus) | Add given parameters to the current interval. |
| CarbonInterval | [minus()](#minus) | Add given parameters to the current interval. |
| CarbonInterval | [times()](#times) | Multiply current instance given number of times. times() is naive, it multiplies each unit (so day can be greater than 31, hour can be greater than 23, etc.) and the result is rounded separately for each unit. |
| CarbonInterval | [shares()](#shares) | Divide current instance by a given divider. shares() is naive, it divides each unit separately and the result is rounded for each unit. So 5 hours and 20 minutes shared by 3 becomes 2 hours and 7 minutes. |
| CarbonInterval | [multiply()](#multiply) | Multiply and cascade current instance by a given factor. |
| CarbonInterval | [divide()](#divide) | Divide and cascade current instance by a given divider. |
| string | [getDateIntervalSpec()](#getdateintervalspec) | Get the interval_spec string of a date interval. |
| string | [spec()](#spec) | Get the interval_spec string. |
| int | [compareDateIntervals()](#comparedateintervals) | Comparing 2 date intervals. |
| int | [compare()](#compare) | Comparing with passed interval. |
| CarbonInterval | [cascade()](#cascade) | Convert overflowed values into bigger units. |
| bool | [hasNegativeValues()](#hasnegativevalues) |  |
| bool | [hasPositiveValues()](#haspositivevalues) |  |
| float | [total()](#total) | Get amount of given unit equivalent to the interval. |
| bool | [eq()](#eq) | Determines if the instance is equal to another |
| bool | [equalTo()](#equalto) | Determines if the instance is equal to another |
| bool | [ne()](#ne) | Determines if the instance is not equal to another |
| bool | [notEqualTo()](#notequalto) | Determines if the instance is not equal to another |
| bool | [gt()](#gt) | Determines if the instance is greater (longer) than another |
| bool | [greaterThan()](#greaterthan) | Determines if the instance is greater (longer) than another |
| bool | [gte()](#gte) | Determines if the instance is greater (longer) than or equal to another |
| bool | [greaterThanOrEqualTo()](#greaterthanorequalto) | Determines if the instance is greater (longer) than or equal to another |
| bool | [lt()](#lt) | Determines if the instance is less (shorter) than another |
| bool | [lessThan()](#lessthan) | Determines if the instance is less (shorter) than another |
| bool | [lte()](#lte) | Determines if the instance is less (shorter) than or equal to another |
| bool | [lessThanOrEqualTo()](#lessthanorequalto) | Determines if the instance is less (shorter) than or equal to another |
| bool | [between()](#between) | Determines if the instance is between two others. |
| bool | [betweenIncluded()](#betweenincluded) | Determines if the instance is between two others, bounds excluded. |
| bool | [betweenExcluded()](#betweenexcluded) | Determines if the instance is between two others, bounds excluded. |
| bool | [isBetween()](#isbetween) | Determines if the instance is between two others |
| CarbonInterval | [roundUnit()](#roundunit) | Round the current instance at the given unit with given precision if specified and the given function. |
| CarbonInterval | [floorUnit()](#floorunit) | Truncate the current instance at the given unit with given precision if specified. |
| CarbonInterval | [ceilUnit()](#ceilunit) | Ceil the current instance at the given unit with given precision if specified. |
| CarbonInterval | [round()](#round) | Round the current instance second with given precision if specified. |
| CarbonInterval | [floor()](#floor) | Round the current instance second with given precision if specified. |
| CarbonInterval | [ceil()](#ceil) | Ceil the current instance second with given precision if specified. |
| CarbonInterval | [years()](#years) | Create instance specifying a number of years or modify the number of years if called on an instance. |
| CarbonInterval | [year()](#year) |  |
| CarbonInterval | [months()](#months) | Create instance specifying a number of months or modify the number of months if called on an instance. |
| CarbonInterval | [month()](#month) |  |
| CarbonInterval | [weeks()](#weeks) | Create instance specifying a number of weeks or modify the number of weeks if called on an instance. |
| CarbonInterval | [week()](#week) |  |
| CarbonInterval | [days()](#days) | Create instance specifying a number of days or modify the number of days if called on an instance. |
| CarbonInterval | [dayz()](#dayz) |  |
| CarbonInterval | [daysExcludeWeeks()](#daysexcludeweeks) | if called on an instance. |
| CarbonInterval | [dayzExcludeWeeks()](#dayzexcludeweeks) |  |
| CarbonInterval | [day()](#day) |  |
| CarbonInterval | [hours()](#hours) | Create instance specifying a number of hours or modify the number of hours if called on an instance. |
| CarbonInterval | [hour()](#hour) |  |
| CarbonInterval | [minutes()](#minutes) | Create instance specifying a number of minutes or modify the number of minutes if called on an instance. |
| CarbonInterval | [minute()](#minute) |  |
| CarbonInterval | [seconds()](#seconds) | Create instance specifying a number of seconds or modify the number of seconds if called on an instance. |
| CarbonInterval | [second()](#second) |  |
| CarbonInterval | [milliseconds()](#milliseconds) | Create instance specifying a number of milliseconds or modify the number of milliseconds if called on an instance. |
| CarbonInterval | [millisecond()](#millisecond) |  |
| CarbonInterval | [microseconds()](#microseconds) | Create instance specifying a number of microseconds or modify the number of microseconds if called on an instance. |
| CarbonInterval | [microsecond()](#microsecond) |  |
| $this | [addYears()](#addyears) | Add given number of years to the current interval |
| $this | [subYears()](#subyears) | Subtract given number of years to the current interval |
| $this | [addMonths()](#addmonths) | Add given number of months to the current interval |
| $this | [subMonths()](#submonths) | Subtract given number of months to the current interval |
| $this | [addWeeks()](#addweeks) | Add given number of weeks to the current interval |
| $this | [subWeeks()](#subweeks) | Subtract given number of weeks to the current interval |
| $this | [addDays()](#adddays) | Add given number of days to the current interval |
| $this | [subDays()](#subdays) | Subtract given number of days to the current interval |
| $this | [addHours()](#addhours) | Add given number of hours to the current interval |
| $this | [subHours()](#subhours) | Subtract given number of hours to the current interval |
| $this | [addMinutes()](#addminutes) | Add given number of minutes to the current interval |
| $this | [subMinutes()](#subminutes) | Subtract given number of minutes to the current interval |
| $this | [addSeconds()](#addseconds) | Add given number of seconds to the current interval |
| $this | [subSeconds()](#subseconds) | Subtract given number of seconds to the current interval |
| $this | [addMilliseconds()](#addmilliseconds) | Add given number of milliseconds to the current interval |
| $this | [subMilliseconds()](#submilliseconds) | Subtract given number of milliseconds to the current interval |
| $this | [addMicroseconds()](#addmicroseconds) | Add given number of microseconds to the current interval |
| $this | [subMicroseconds()](#submicroseconds) | Subtract given number of microseconds to the current interval |
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
| $this | [roundWeek()](#roundweek) | Round the current instance day with given precision using the given function. |
| $this | [roundWeeks()](#roundweeks) | Round the current instance day with given precision using the given function. |
| $this | [floorWeek()](#floorweek) | Truncate the current instance day with given precision. |
| $this | [floorWeeks()](#floorweeks) | Truncate the current instance day with given precision. |
| $this | [ceilWeek()](#ceilweek) | Ceil the current instance day with given precision. |
| $this | [ceilWeeks()](#ceilweeks) | Ceil the current instance day with given precision. |
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

---

## Method Details

### setTimezone

```php
public CarbonInterval setTimezone($timezone)
```

Set the instance's timezone from a string or object.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeZone](https://www.php.net/class.datetimezone)\|string\|int | `$timezone` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### shiftTimezone

```php
public CarbonInterval shiftTimezone($timezone)
```

Set the instance's timezone from a string or object and add/subtract the offset difference.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeZone](https://www.php.net/class.datetimezone)\|string\|int | `$timezone` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### getCascadeFactors

```php
static public array getCascadeFactors()
```

Mapping of units and factors for cascading.

Should only be modified by changing the factors or referenced constants.

**Returns:** array
---

### setCascadeFactors

```php
static public  setCascadeFactors($cascadeFactors)
```

Set default cascading factors for ->cascade() method.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| array | `$cascadeFactors` | —  |  |

---

### enableFloatSetters

```php
static public void enableFloatSetters($floatSettersEnabled = true)
```

This option allow you to opt-in for the Carbon 3 behavior where float
values will no longer be cast to integer (so truncated).

⚠️ This settings will be applied globally, which mean your whole application
code including the third-party dependencies that also may use Carbon will
adopt the new behavior.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$floatSettersEnabled` | `true` |  |

**Returns:** void
---

### getFactor

```php
static public int\|float\|null getFactor($source, $target)
```

Returns the factor for a given source-to-target couple.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$source` | —  |  |
| string | `$target` | —  |  |

**Returns:** int\|float\|null
---

### getFactorWithDefault

```php
static public int\|float\|null getFactorWithDefault($source, $target)
```

Returns the factor for a given source-to-target couple if set,
else try to find the appropriate constant as the factor, such as Carbon::DAYS_PER_WEEK.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$source` | —  |  |
| string | `$target` | —  |  |

**Returns:** int\|float\|null
---

### getDaysPerWeek

```php
static public int\|float getDaysPerWeek()
```

Returns current config for days per week.

**Returns:** int\|float
---

### getHoursPerDay

```php
static public int\|float getHoursPerDay()
```

Returns current config for hours per day.

**Returns:** int\|float
---

### getMinutesPerHour

```php
static public int\|float getMinutesPerHour()
```

Returns current config for minutes per hour.

**Returns:** int\|float
---

### getSecondsPerMinute

```php
static public int\|float getSecondsPerMinute()
```

Returns current config for seconds per minute.

**Returns:** int\|float
---

### getMillisecondsPerSecond

```php
static public int\|float getMillisecondsPerSecond()
```

Returns current config for microseconds per second.

**Returns:** int\|float
---

### getMicrosecondsPerMillisecond

```php
static public int\|float getMicrosecondsPerMillisecond()
```

Returns current config for microseconds per second.

**Returns:** int\|float
---

### create

```php
static public CarbonInterval create($years = null, $months = null, $weeks = null, $days = null, $hours = null, $minutes = null, $seconds = null, $microseconds = null)
```

Create a new CarbonInterval instance from specific values.

This is an alias for the constructor that allows better fluent
syntax as it allows you to do CarbonInterval::create(1)->fn() rather than
(new CarbonInterval(1))->fn().

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$years` | `null` |  |
| int | `$months` | `null` |  |
| int | `$weeks` | `null` |  |
| int | `$days` | `null` |  |
| int | `$hours` | `null` |  |
| int | `$minutes` | `null` |  |
| int | `$seconds` | `null` |  |
| int | `$microseconds` | `null` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### createFromFormat

```php
static public CarbonInterval createFromFormat($format, $interval)
```

Parse a string into a new CarbonInterval object according to the specified format.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$format` | —  | Format of the $interval input string |
| string\|null | `$interval` | —  | Input string to convert into an interval |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- ParseErrorException
---

### original

```php
public array\|int\|string\|DateInterval\|mixed\|null original()
```

Return the original source used to create the current interval.

**Returns:** array\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed\|null
---

### start

```php
public CarbonInterface\|null start()
```

Return the start date if interval was created from a difference between 2 dates.

**Returns:** CarbonInterface\|null
---

### end

```php
public CarbonInterface\|null end()
```

Return the end date if interval was created from a difference between 2 dates.

**Returns:** CarbonInterface\|null
---

### optimize

```php
public CarbonInterval optimize()
```

Get rid of the original input, start date and end date that may be kept in memory.

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### copy

```php
public CarbonInterval copy()
```

Get a copy of the instance.

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### clone

```php
public CarbonInterval clone()
```

Get a copy of the instance.

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### fromString

```php
static public CarbonInterval fromString($intervalDefinition)
```

Creates a CarbonInterval from string.

Format:

Suffix | Unit    | Example | DateInterval expression
-------|---------|---------|------------------------
y      | years   |   1y    | P1Y
mo     | months  |   3mo   | P3M
w      | weeks   |   2w    | P2W
d      | days    |  28d    | P28D
h      | hours   |   4h    | PT4H
m      | minutes |  12m    | PT12M
s      | seconds |  59s    | PT59S

e. g. `1w 3d 4h 32m 23s` is converted to 10 days 4 hours 32 minutes and 23 seconds.

Special cases:
 - An empty string will return a zero interval
 - Fractions are allowed for weeks, days, hours and minutes and will be converted
   and rounded to the next smaller value (caution: 0.5w = 4d)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$intervalDefinition` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- InvalidIntervalException
---

### parseFromLocale

```php
static public CarbonInterval parseFromLocale($interval, $locale = null)
```

Creates a CarbonInterval from string using a different locale.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$interval` | —  | interval string in the given language (may also contain English). |
| string\|null | `$locale` | `null` | if locale is null or not specified, current global locale will be used instead. |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### diff

```php
static public CarbonInterval diff($start, $end = null, $absolute = false, $skip = [])
```

Create an interval from the difference between 2 dates.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [Carbon](../Carbon/Carbon.md)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|mixed | `$start` | —  |  |
| [Carbon](../Carbon/Carbon.md)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|mixed | `$end` | `null` |  |
| bool | `$absolute` | `false` |  |
| array | `$skip` | `[]` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### abs

```php
public CarbonInterval abs($absolute = false)
```

Invert the interval if it's inverted.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$absolute` | `false` | do nothing if set to false |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### absolute

```php
public CarbonInterval absolute($absolute = true)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$absolute` | `true` | do nothing if set to false |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### cast

```php
public mixed cast($className)
```

Cast the current instance into the given class.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$className` | —  |  |

**Returns:** mixed
---

### instance

```php
static public CarbonInterval instance($interval, $skip = [], $skipCopy = false)
```

Create a CarbonInterval instance from a DateInterval one.  Can not instance
DateInterval objects created from DateTime::diff() as you can't externally
set the $days field.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateInterval](https://www.php.net/class.dateinterval) | `$interval` | —  |  |
| array | `$skip` | `[]` |  |
| bool | `$skipCopy` | `false` | set to true to return the passed object
(without copying it) if it's already of the
current class |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### make

```php
static public CarbonInterval\|null make($interval, $unit = null, $skipCopy = false)
```

Make a CarbonInterval instance from given variable if possible.

Always return a new instance. Parse only strings and only these likely to be intervals (skip dates
and recurrences). Throw an exception for invalid format, but otherwise return null.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed\|int\|[DateInterval](https://www.php.net/class.dateinterval)\|string\|[Closure](https://www.php.net/class.closure)\|Unit\|null | `$interval` | —  | interval or number of the given $unit |
| Unit\|string\|null | `$unit` | `null` | if specified, $interval must be an integer |
| bool | `$skipCopy` | `false` | set to true to return the passed object
(without copying it) if it's already of the
current class |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)\|null
---

### createFromDateString

```php
static public CarbonInterval createFromDateString($datetime)
```

Sets up a DateInterval from the relative parts of the string.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$datetime` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### get

```php
public int\|float\|string\|null get($name)
```

Get a part of the CarbonInterval object.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Unit\|string | `$name` | —  |  |

**Returns:** int\|float\|string\|null
---

### set

```php
public CarbonInterval set($name, $value = null)
```

Set a part of the CarbonInterval object.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| Unit\|string\|array | `$name` | —  |  |
| int | `$value` | `null` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- UnknownSetterException
---

### weeksAndDays

```php
public CarbonInterval weeksAndDays($weeks, $days)
```

Allow setting of weeks and days to be cumulative.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weeks` | —  | Number of weeks to set |
| int | `$days` | —  | Number of days to set |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### isEmpty

```php
public bool isEmpty()
```

Returns true if the interval is empty for each unit.

**Returns:** bool
---

### macro

```php
static public void macro($name, $macro)
```

Register a custom macro.

Pass null macro to remove it.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$name` | —  |  |
| callable\|null | `$macro` | —  |  |

**Returns:** void
---

### mixin

```php
static public void mixin($mixin)
```

Register macros from a mixin object.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| object\|string | `$mixin` | —  |  |

**Returns:** void
**Throws:**

- [ReflectionException](https://www.php.net/class.reflectionexception)
---

### hasMacro

```php
static public bool hasMacro($name)
```

Check if macro is registered.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$name` | —  |  |

**Returns:** bool
---

### toArray

```php
public array toArray()
```

Returns interval values as an array where key are the unit names and values the counts.

**Returns:** array
---

### getNonZeroValues

```php
public array getNonZeroValues()
```

Returns interval non-zero values as an array where key are the unit names and values the counts.

**Returns:** array
---

### getValuesSequence

```php
public array getValuesSequence()
```

Returns interval values as an array where key are the unit names and values the counts
from the biggest non-zero one the the smallest non-zero one.

**Returns:** array
---

### forHumans

```php
public string forHumans($syntax = null, $short = false, $parts = self::NO_LIMIT, $options = null)
```

Get the current interval in a human readable format in the current locale.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|array | `$syntax` | `null` | if array passed, parameters will be extracted from it, the array may contain:
⦿ 'syntax' entry (see below)
⦿ 'short' entry (see below)
⦿ 'parts' entry (see below)
⦿ 'options' entry (see below)
⦿ 'skip' entry, list of units to skip (array of strings or a single string,
` it can be the unit name (singular or plural) or its shortcut
` (y, m, w, d, h, min, s, ms, µs).
⦿ 'aUnit' entry, prefer "an hour" over "1 hour" if true
⦿ 'altNumbers' entry, use alternative numbers if available
` (from the current language if true is passed, from the given language(s)
` if array or string is passed)
⦿ 'join' entry determines how to join multiple parts of the string
`  - if $join is a string, it's used as a joiner glue
`  - if $join is a callable/closure, it get the list of string and should return a string
`  - if $join is an array, the first item will be the default glue, and the second item
`    will be used instead of the glue for the last item
`  - if $join is true, it will be guessed from the locale ('list' translation file entry)
`  - if $join is missing, a space will be used as glue
⦿ 'minimumUnit' entry determines the smallest unit of time to display can be long or
`  short form of the units, e.g. 'hour' or 'h' (default value: s)
⦿ 'locale' language in which the diff should be output (has no effect if 'translator' key is set)
⦿ 'translator' a custom translator to use to translator the output.
if int passed, it adds modifiers:
Possible values:
- CarbonInterface::DIFF_ABSOLUTE          no modifiers
- CarbonInterface::DIFF_RELATIVE_TO_NOW   add ago/from now modifier
- CarbonInterface::DIFF_RELATIVE_TO_OTHER add before/after modifier
Default value: CarbonInterface::DIFF_ABSOLUTE |
| bool | `$short` | `false` | displays short format of time units |
| int | `$parts` | `self::NO_LIMIT` | maximum number of parts to display (default value: -1: no limits) |
| int | `$options` | `null` | human diff options |

**Returns:** string
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### format

```php
public string format($format)
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$format` | —  |  |

**Returns:** string
---

### toDateInterval

```php
public DateInterval toDateInterval()
```

Return native DateInterval PHP object matching the current instance.

**Returns:** [DateInterval](https://www.php.net/class.dateinterval)
---

### toPeriod

```php
public CarbonPeriod toPeriod(...$params)
```

Convert the interval to a CarbonPeriod.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface)\|string\|int | ...`$params` | —  | Start date, [end date or recurrences] and optional settings. |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### stepBy

```php
public CarbonPeriod stepBy($interval, $unit = null)
```

Decompose the current interval into

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed\|int\|[DateInterval](https://www.php.net/class.dateinterval)\|string\|[Closure](https://www.php.net/class.closure)\|Unit\|null | `$interval` | —  | interval or number of the given $unit |
| Unit\|string\|null | `$unit` | `null` | if specified, $interval must be an integer |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### invert

```php
public CarbonInterval invert($inverted = null)
```

Invert the interval.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool\|int | `$inverted` | `null` | if a parameter is passed, the passed value cast as 1 or 0 is used
as the new value of the ->invert property. |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### add

```php
public CarbonInterval add($unit, $value = 1)
```

Add the passed interval to the current instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateInterval](https://www.php.net/class.dateinterval) | `$unit` | —  |  |
| int\|float | `$value` | `1` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### sub

```php
public CarbonInterval sub($unit, $value = 1)
```

Subtract the passed interval to the current instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateInterval](https://www.php.net/class.dateinterval) | `$unit` | —  |  |
| int\|float | `$value` | `1` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### subtract

```php
public CarbonInterval subtract($unit, $value = 1)
```

Subtract the passed interval to the current instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateInterval](https://www.php.net/class.dateinterval) | `$unit` | —  |  |
| int\|float | `$value` | `1` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### plus

```php
public CarbonInterval plus($years = 0, $months = 0, $weeks = 0, $days = 0, $hours = 0, $minutes = 0, $seconds = 0, $microseconds = 0)
```

Add given parameters to the current interval.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$years` | `0` |  |
| int | `$months` | `0` |  |
| int\|float | `$weeks` | `0` |  |
| int\|float | `$days` | `0` |  |
| int\|float | `$hours` | `0` |  |
| int\|float | `$minutes` | `0` |  |
| int\|float | `$seconds` | `0` |  |
| int\|float | `$microseconds` | `0` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### minus

```php
public CarbonInterval minus($years = 0, $months = 0, $weeks = 0, $days = 0, $hours = 0, $minutes = 0, $seconds = 0, $microseconds = 0)
```

Add given parameters to the current interval.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$years` | `0` |  |
| int | `$months` | `0` |  |
| int\|float | `$weeks` | `0` |  |
| int\|float | `$days` | `0` |  |
| int\|float | `$hours` | `0` |  |
| int\|float | `$minutes` | `0` |  |
| int\|float | `$seconds` | `0` |  |
| int\|float | `$microseconds` | `0` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### times

```php
public CarbonInterval times($factor)
```

Multiply current instance given number of times. times() is naive, it multiplies each unit
(so day can be greater than 31, hour can be greater than 23, etc.) and the result is rounded
separately for each unit.

Use times() when you want a fast and approximated calculation that does not cascade units.

For a precise and cascaded calculation,

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int | `$factor` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**See also:**

- multiply()
---

### shares

```php
public CarbonInterval shares($divider)
```

Divide current instance by a given divider. shares() is naive, it divides each unit separately
and the result is rounded for each unit. So 5 hours and 20 minutes shared by 3 becomes 2 hours
and 7 minutes.

Use shares() when you want a fast and approximated calculation that does not cascade units.

For a precise and cascaded calculation,

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int | `$divider` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**See also:**

- divide()
---

### multiply

```php
public CarbonInterval multiply($factor)
```

Multiply and cascade current instance by a given factor.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int | `$factor` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### divide

```php
public CarbonInterval divide($divider)
```

Divide and cascade current instance by a given divider.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int | `$divider` | —  |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### getDateIntervalSpec

```php
static public string getDateIntervalSpec($interval, $microseconds = false, $skip = [])
```

Get the interval_spec string of a date interval.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateInterval](https://www.php.net/class.dateinterval) | `$interval` | —  |  |
| bool | `$microseconds` | `false` |  |
| array | `$skip` | `[]` |  |

**Returns:** string
---

### spec

```php
public string spec($microseconds = false)
```

Get the interval_spec string.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$microseconds` | `false` |  |

**Returns:** string
---

### compareDateIntervals

```php
static public int compareDateIntervals($first, $second)
```

Comparing 2 date intervals.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateInterval](https://www.php.net/class.dateinterval) | `$first` | —  |  |
| [DateInterval](https://www.php.net/class.dateinterval) | `$second` | —  |  |

**Returns:** int — 0, 1 or -1
---

### compare

```php
public int compare($interval)
```

Comparing with passed interval.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateInterval](https://www.php.net/class.dateinterval) | `$interval` | —  |  |

**Returns:** int — 0, 1 or -1
---

### cascade

```php
public CarbonInterval cascade()
```

Convert overflowed values into bigger units.

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### hasNegativeValues

```php
public bool hasNegativeValues()
```

**Returns:** bool
---

### hasPositiveValues

```php
public bool hasPositiveValues()
```

**Returns:** bool
---

### total

```php
public float total($unit)
```

Get amount of given unit equivalent to the interval.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$unit` | —  |  |

**Returns:** float
**Throws:**

- UnitNotConfiguredException
---

### eq

```php
public bool eq($interval)
```

Determines if the instance is equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
**See also:**

- equalTo()
---

### equalTo

```php
public bool equalTo($interval)
```

Determines if the instance is equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
---

### ne

```php
public bool ne($interval)
```

Determines if the instance is not equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
**See also:**

- notEqualTo()
---

### notEqualTo

```php
public bool notEqualTo($interval)
```

Determines if the instance is not equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
---

### gt

```php
public bool gt($interval)
```

Determines if the instance is greater (longer) than another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
**See also:**

- greaterThan()
---

### greaterThan

```php
public bool greaterThan($interval)
```

Determines if the instance is greater (longer) than another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
---

### gte

```php
public bool gte($interval)
```

Determines if the instance is greater (longer) than or equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
**See also:**

- greaterThanOrEqualTo()
---

### greaterThanOrEqualTo

```php
public bool greaterThanOrEqualTo($interval)
```

Determines if the instance is greater (longer) than or equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
---

### lt

```php
public bool lt($interval)
```

Determines if the instance is less (shorter) than another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
**See also:**

- lessThan()
---

### lessThan

```php
public bool lessThan($interval)
```

Determines if the instance is less (shorter) than another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
---

### lte

```php
public bool lte($interval)
```

Determines if the instance is less (shorter) than or equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
**See also:**

- lessThanOrEqualTo()
---

### lessThanOrEqualTo

```php
public bool lessThanOrEqualTo($interval)
```

Determines if the instance is less (shorter) than or equal to another

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval` | —  |  |

**Returns:** bool
---

### between

```php
public bool between($interval1, $interval2, $equal = true)
```

Determines if the instance is between two others.

The third argument allow you to specify if bounds are included or not (true by default)
but for when you including/excluding bounds may produce different results in your application,
we recommend to use the explicit methods ->betweenIncluded() or ->betweenExcluded() instead.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval1` | —  |  |
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval2` | —  |  |
| bool | `$equal` | `true` | Indicates if an equal to comparison should be done |

**Returns:** bool
---

### betweenIncluded

```php
public bool betweenIncluded($interval1, $interval2)
```

Determines if the instance is between two others, bounds excluded.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval1` | —  |  |
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval2` | —  |  |

**Returns:** bool
---

### betweenExcluded

```php
public bool betweenExcluded($interval1, $interval2)
```

Determines if the instance is between two others, bounds excluded.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval1` | —  |  |
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval2` | —  |  |

**Returns:** bool
---

### isBetween

```php
public bool isBetween($interval1, $interval2, $equal = true)
```

Determines if the instance is between two others

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval1` | —  |  |
| [CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|mixed | `$interval2` | —  |  |
| bool | `$equal` | `true` | Indicates if an equal to comparison should be done |

**Returns:** bool
---

### roundUnit

```php
public CarbonInterval roundUnit($unit, $precision = 1, $function = &#039;round&#039;)
```

Round the current instance at the given unit with given precision if specified and the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$unit` | —  |  |
| [DateInterval](https://www.php.net/class.dateinterval)\|string\|int\|float | `$precision` | `1` |  |
| string | `$function` | `&#039;round&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### floorUnit

```php
public CarbonInterval floorUnit($unit, $precision = 1)
```

Truncate the current instance at the given unit with given precision if specified.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$unit` | —  |  |
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `1` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### ceilUnit

```php
public CarbonInterval ceilUnit($unit, $precision = 1)
```

Ceil the current instance at the given unit with given precision if specified.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$unit` | —  |  |
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `1` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### round

```php
public CarbonInterval round($precision = 1, $function = &#039;round&#039;)
```

Round the current instance second with given precision if specified.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `1` |  |
| string | `$function` | `&#039;round&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### floor

```php
public CarbonInterval floor($precision = 1)
```

Round the current instance second with given precision if specified.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateInterval](https://www.php.net/class.dateinterval)\|string\|float\|int | `$precision` | `1` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### ceil

```php
public CarbonInterval ceil($precision = 1)
```

Ceil the current instance second with given precision if specified.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateInterval](https://www.php.net/class.dateinterval)\|string\|float\|int | `$precision` | `1` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### years

```php
static public CarbonInterval years($years = &#039;1&#039;)
```

Create instance specifying a number of years or modify the number of years if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$years` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### year

```php
static public CarbonInterval year($years = &#039;1&#039;) Alias for years()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$years` | `&#039;1&#039;) Alias for years(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### months

```php
static public CarbonInterval months($months = &#039;1&#039;)
```

Create instance specifying a number of months or modify the number of months if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$months` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### month

```php
static public CarbonInterval month($months = &#039;1&#039;) Alias for months()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$months` | `&#039;1&#039;) Alias for months(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### weeks

```php
static public CarbonInterval weeks($weeks = &#039;1&#039;)
```

Create instance specifying a number of weeks or modify the number of weeks if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$weeks` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### week

```php
static public CarbonInterval week($weeks = &#039;1&#039;) Alias for weeks()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$weeks` | `&#039;1&#039;) Alias for weeks(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### days

```php
static public CarbonInterval days($days = &#039;1&#039;)
```

Create instance specifying a number of days or modify the number of days if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### dayz

```php
static public CarbonInterval dayz($days = &#039;1&#039;) Alias for days()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;) Alias for days(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### daysExcludeWeeks

```php
static public CarbonInterval daysExcludeWeeks($days = &#039;1&#039;) Create instance specifying a number of days or modify the number of days (keeping the current number of weeks)
```

if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;) Create instance specifying a number of days or modify the number of days (keeping the current number of weeks` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### dayzExcludeWeeks

```php
static public CarbonInterval dayzExcludeWeeks($days = &#039;1&#039;) Alias for daysExcludeWeeks()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;) Alias for daysExcludeWeeks(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### day

```php
static public CarbonInterval day($days = &#039;1&#039;) Alias for days()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;) Alias for days(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### hours

```php
static public CarbonInterval hours($hours = &#039;1&#039;)
```

Create instance specifying a number of hours or modify the number of hours if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$hours` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### hour

```php
static public CarbonInterval hour($hours = &#039;1&#039;) Alias for hours()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$hours` | `&#039;1&#039;) Alias for hours(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### minutes

```php
static public CarbonInterval minutes($minutes = &#039;1&#039;)
```

Create instance specifying a number of minutes or modify the number of minutes if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$minutes` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### minute

```php
static public CarbonInterval minute($minutes = &#039;1&#039;) Alias for minutes()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$minutes` | `&#039;1&#039;) Alias for minutes(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### seconds

```php
static public CarbonInterval seconds($seconds = &#039;1&#039;)
```

Create instance specifying a number of seconds or modify the number of seconds if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$seconds` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### second

```php
static public CarbonInterval second($seconds = &#039;1&#039;) Alias for seconds()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$seconds` | `&#039;1&#039;) Alias for seconds(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### milliseconds

```php
static public CarbonInterval milliseconds($milliseconds = &#039;1&#039;)
```

Create instance specifying a number of milliseconds or modify the number of milliseconds if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$milliseconds` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### millisecond

```php
static public CarbonInterval millisecond($milliseconds = &#039;1&#039;) Alias for milliseconds()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$milliseconds` | `&#039;1&#039;) Alias for milliseconds(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### microseconds

```php
static public CarbonInterval microseconds($microseconds = &#039;1&#039;)
```

Create instance specifying a number of microseconds or modify the number of microseconds if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$microseconds` | `&#039;1&#039;` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### microsecond

```php
static public CarbonInterval microsecond($microseconds = &#039;1&#039;) Alias for microseconds()
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$microseconds` | `&#039;1&#039;) Alias for microseconds(` |  |

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### addYears

```php
public $this addYears($years)
```

Add given number of years to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$years` | —  |  |

**Returns:** $this
---

### subYears

```php
public $this subYears($years)
```

Subtract given number of years to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$years` | —  |  |

**Returns:** $this
---

### addMonths

```php
public $this addMonths($months)
```

Add given number of months to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$months` | —  |  |

**Returns:** $this
---

### subMonths

```php
public $this subMonths($months)
```

Subtract given number of months to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$months` | —  |  |

**Returns:** $this
---

### addWeeks

```php
public $this addWeeks($weeks)
```

Add given number of weeks to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$weeks` | —  |  |

**Returns:** $this
---

### subWeeks

```php
public $this subWeeks($weeks)
```

Subtract given number of weeks to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$weeks` | —  |  |

**Returns:** $this
---

### addDays

```php
public $this addDays($days)
```

Add given number of days to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$days` | —  |  |

**Returns:** $this
---

### subDays

```php
public $this subDays($days)
```

Subtract given number of days to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$days` | —  |  |

**Returns:** $this
---

### addHours

```php
public $this addHours($hours)
```

Add given number of hours to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$hours` | —  |  |

**Returns:** $this
---

### subHours

```php
public $this subHours($hours)
```

Subtract given number of hours to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$hours` | —  |  |

**Returns:** $this
---

### addMinutes

```php
public $this addMinutes($minutes)
```

Add given number of minutes to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$minutes` | —  |  |

**Returns:** $this
---

### subMinutes

```php
public $this subMinutes($minutes)
```

Subtract given number of minutes to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$minutes` | —  |  |

**Returns:** $this
---

### addSeconds

```php
public $this addSeconds($seconds)
```

Add given number of seconds to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$seconds` | —  |  |

**Returns:** $this
---

### subSeconds

```php
public $this subSeconds($seconds)
```

Subtract given number of seconds to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$seconds` | —  |  |

**Returns:** $this
---

### addMilliseconds

```php
public $this addMilliseconds($milliseconds)
```

Add given number of milliseconds to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$milliseconds` | —  |  |

**Returns:** $this
---

### subMilliseconds

```php
public $this subMilliseconds($milliseconds)
```

Subtract given number of milliseconds to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$milliseconds` | —  |  |

**Returns:** $this
---

### addMicroseconds

```php
public $this addMicroseconds($microseconds)
```

Add given number of microseconds to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$microseconds` | —  |  |

**Returns:** $this
---

### subMicroseconds

```php
public $this subMicroseconds($microseconds)
```

Subtract given number of microseconds to the current interval

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$microseconds` | —  |  |

**Returns:** $this
---

### roundYear

```php
public $this roundYear($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance year with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### roundWeek

```php
public $this roundWeek($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance day with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### roundWeeks

```php
public $this roundWeeks($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance day with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$precision` | `&#039;1&#039;` |  |
| string | `$function` | `&#039;&quot;round&quot;&#039;` |  |

**Returns:** $this
---

### floorWeek

```php
public $this floorWeek($precision = &#039;1&#039;)
```

Truncate the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### floorWeeks

```php
public $this floorWeeks($precision = &#039;1&#039;)
```

Truncate the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilWeek

```php
public $this ceilWeek($precision = &#039;1&#039;)
```

Ceil the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

### ceilWeeks

```php
public $this ceilWeeks($precision = &#039;1&#039;)
```

Ceil the current instance day with given precision.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |
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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

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
| int|float | `$precision` | `&#039;1&#039;` |  |

**Returns:** $this
---

