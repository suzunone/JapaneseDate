# CarbonPeriod

**Namespace:** `Carbon`

class **CarbonPeriod** implements [Iterator](https://www.php.net/class.iterator), [Countable](https://www.php.net/class.countable), [JsonSerializable](https://www.php.net/class.jsonserializable)

Substitution of DatePeriod with some modifications and many more features.

## Traits

- IntervalRounding
- Mixin
- Options
- ToStringFormat

## Constants

| Modifier | Name | Description |
|---|---|---|
| public | `RECURRENCES_FILTER` | Built-in filter for limit by recurrences. |
| public | `END_DATE_FILTER` | Built-in filter for limit to an end. |
| public | `END_ITERATION` | Special value which can be returned by filters to end iteration. Also a filter. |
| public | `EXCLUDE_START_DATE` | Exclude start date from iteration. |
| public | `EXCLUDE_END_DATE` | Exclude end date from iteration. |
| public | `IMMUTABLE` | Yield CarbonImmutable instances. |
| public | `NEXT_MAX_ATTEMPTS` | Number of maximum attempts before giving up on finding next valid date. |
| public | `END_MAX_ATTEMPTS` | Number of maximum attempts before giving up on finding end date. |
| protected | `DEFAULT_DATE_CLASS` | Default date class of iteration items. |

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public _(read-only)_ | int\|float | `$recurrences` | number of recurrences (if end not set). |
| public _(read-only)_ | bool | `$include_start_date` | rather the start date is included in the iteration. |
| public _(read-only)_ | bool | `$include_end_date` | rather the end date is included in the iteration (if recurrences not set). |
| public _(read-only)_ | CarbonInterface | `$start` | Period start date. |
| public _(read-only)_ | CarbonInterface | `$current` | Current date from the iteration. |
| public _(read-only)_ | CarbonInterface | `$end` | Period end date. |
| public _(read-only)_ | [CarbonInterval](../Carbon/CarbonInterval.md) | `$interval` | Underlying date interval instance. Always present, one day by default. |

## Methods

| Return | Method | Description |
|---|---|---|
| CarbonPeriod\|null | [make()](#make) | Make a CarbonPeriod instance from given variable if possible. |
| CarbonPeriod | [instance()](#instance) | Create a new instance from a DatePeriod or CarbonPeriod object. |
| CarbonPeriod | [create()](#create) | Create a new instance. |
| CarbonPeriod | [createFromArray()](#createfromarray) | Create a new instance from an array of parameters. |
| CarbonPeriod | [createFromIso()](#createfromiso) | Create CarbonPeriod from ISO 8601 string. |
| void | [macro()](#macro) | Register a custom macro. |
| void | [mixin()](#mixin) | Register macros from a mixin object. |
| bool | [hasMacro()](#hasmacro) | Check if macro is registered. |
| CarbonPeriod | [copy()](#copy) | Get a copy of the instance. |
| bool\|CarbonInterface\|CarbonInterval\|int\|null | [get()](#get) | Get a property allowing both `DatePeriod` snakeCase and camelCase names. |
| CarbonPeriod | [clone()](#clone) |  |
| CarbonPeriod | [setDateClass()](#setdateclass) | Set the iteration item class. |
| string | [getDateClass()](#getdateclass) | Returns iteration item date class. |
| CarbonPeriod | [setDateInterval()](#setdateinterval) | Change the period date interval. |
| CarbonPeriod | [invertDateInterval()](#invertdateinterval) | Invert the period date interval. |
| CarbonPeriod | [setDates()](#setdates) | Set start and end date. |
| CarbonPeriod | [setOptions()](#setoptions) | Change the period options. |
| int | [getOptions()](#getoptions) | Get the period options. |
| CarbonPeriod | [toggleOptions()](#toggleoptions) | Toggle given options on or off. |
| CarbonPeriod | [excludeStartDate()](#excludestartdate) | Toggle EXCLUDE_START_DATE option. |
| CarbonPeriod | [excludeEndDate()](#excludeenddate) | Toggle EXCLUDE_END_DATE option. |
| CarbonInterval | [getDateInterval()](#getdateinterval) | Get the underlying date interval. |
| CarbonInterface | [getStartDate()](#getstartdate) | Get start date of the period. |
| CarbonInterface\|null | [getEndDate()](#getenddate) | Get end date of the period. |
| int\|float\|null | [getRecurrences()](#getrecurrences) | Get number of recurrences. |
| bool | [isStartExcluded()](#isstartexcluded) | Returns true if the start date should be excluded. |
| bool | [isEndExcluded()](#isendexcluded) | Returns true if the end date should be excluded. |
| bool | [isStartIncluded()](#isstartincluded) | Returns true if the start date should be included. |
| bool | [isEndIncluded()](#isendincluded) | Returns true if the end date should be included. |
| CarbonInterface | [getIncludedStartDate()](#getincludedstartdate) | Return the start if it&#039;s included by option, else return the start + 1 period interval. |
| CarbonInterface | [getIncludedEndDate()](#getincludedenddate) | Return the end if it&#039;s included by option, else return the end - 1 period interval. |
| CarbonPeriod | [addFilter()](#addfilter) | Add a filter to the stack. |
| CarbonPeriod | [prependFilter()](#prependfilter) | Prepend a filter to the stack. |
| CarbonPeriod | [removeFilter()](#removefilter) | Remove a filter by instance or name. |
| bool | [hasFilter()](#hasfilter) | Return whether given instance or name is in the filter stack. |
| array | [getFilters()](#getfilters) | Get filters stack. |
| CarbonPeriod | [setFilters()](#setfilters) | Set filters stack. |
| CarbonPeriod | [resetFilters()](#resetfilters) | Reset filters stack. |
| CarbonPeriod | [setRecurrences()](#setrecurrences) | Add a recurrences filter (set maximum number of recurrences). |
| CarbonPeriod | [setStartDate()](#setstartdate) | Change the period start date. |
| CarbonPeriod | [setEndDate()](#setenddate) | Change the period end date. |
| bool | [valid()](#valid) | Check if the current position is valid. |
| int\|null | [key()](#key) | Return the current key. |
| CarbonInterface\|null | [current()](#current) | Return the current date. |
| void | [next()](#next) | Move forward to the next date. |
| void | [rewind()](#rewind) | Rewind to the start date. |
| bool | [skip()](#skip) | Skip iterations and returns iteration state (false if ended, true if still valid). |
| string | [toIso8601String()](#toiso8601string) | Format the date period as ISO 8601. |
| string | [toString()](#tostring) | Convert the date period into a string. |
| string | [spec()](#spec) | Format the date period as ISO 8601. |
| DatePeriod | [cast()](#cast) | Cast the current instance into the given class. |
| DatePeriod | [toDatePeriod()](#todateperiod) | Return native DatePeriod PHP object matching the current instance. |
| bool | [isUnfilteredAndEndLess()](#isunfilteredandendless) | Return `true` if the period has no custom filter and is guaranteed to be endless. |
| CarbonInterface[] | [toArray()](#toarray) | Convert the date period into an array without changing current iteration state. |
| int | [count()](#count) | Count dates in the date period. |
| CarbonInterface\|null | [first()](#first) | Return the first date in the date period. |
| CarbonInterface\|null | [last()](#last) | Return the last date in the date period. |
| CarbonPeriod | [setTimezone()](#settimezone) | Set the instance&#039;s timezone from a string or object and apply it to start/end. |
| CarbonPeriod | [shiftTimezone()](#shifttimezone) | Set the instance&#039;s timezone from a string or object and add/subtract the offset difference to start/end. |
| CarbonInterface | [calculateEnd()](#calculateend) | Returns the end is set, else calculated from start an recurrences. |
| bool | [overlaps()](#overlaps) | Returns true if the current period overlaps the given one (if 1 parameter passed) or the period between 2 dates (if 2 parameters passed). |
|  | [forEach()](#foreach) | Execute a given function on each date of the period. |
| Generator | [map()](#map) | Execute a given function on each date of the period and yield the result of this function. |
| bool | [eq()](#eq) | Determines if the instance is equal to another. |
| bool | [equalTo()](#equalto) | Determines if the instance is equal to another. |
| bool | [ne()](#ne) | Determines if the instance is not equal to another. |
| bool | [notEqualTo()](#notequalto) | Determines if the instance is not equal to another. |
| bool | [startsBefore()](#startsbefore) | Determines if the start date is before an other given date. |
| bool | [startsBeforeOrAt()](#startsbeforeorat) | Determines if the start date is before or the same as a given date. |
| bool | [startsAfter()](#startsafter) | Determines if the start date is after an other given date. |
| bool | [startsAfterOrAt()](#startsafterorat) | Determines if the start date is after or the same as a given date. |
| bool | [startsAt()](#startsat) | Determines if the start date is the same as a given date. |
| bool | [endsBefore()](#endsbefore) | Determines if the end date is before an other given date. |
| bool | [endsBeforeOrAt()](#endsbeforeorat) | Determines if the end date is before or the same as a given date. |
| bool | [endsAfter()](#endsafter) | Determines if the end date is after an other given date. |
| bool | [endsAfterOrAt()](#endsafterorat) | Determines if the end date is after or the same as a given date. |
| bool | [endsAt()](#endsat) | Determines if the end date is the same as a given date. |
| bool | [isStarted()](#isstarted) | Return true if start date is now or later. |
| bool | [isEnded()](#isended) | Return true if end date is now or later. |
| bool | [isInProgress()](#isinprogress) | Return true if now is between start date (included) and end date (excluded). |
| CarbonPeriod | [roundUnit()](#roundunit) | Round the current instance at the given unit with given precision if specified and the given function. |
| CarbonPeriod | [floorUnit()](#floorunit) | Truncate the current instance at the given unit with given precision if specified. |
| CarbonPeriod | [ceilUnit()](#ceilunit) | Ceil the current instance at the given unit with given precision if specified. |
| CarbonPeriod | [round()](#round) | Round the current instance second with given precision if specified (else period interval is used). |
| CarbonPeriod | [floor()](#floor) | Round the current instance second with given precision if specified (else period interval is used). |
| CarbonPeriod | [ceil()](#ceil) | Ceil the current instance second with given precision if specified (else period interval is used). |
| CarbonInterface[] | [jsonSerialize()](#jsonserialize) | Specify data which should be serialized to JSON. |
| bool | [contains()](#contains) | Return true if the given date is between start and end. |
| bool | [follows()](#follows) | Return true if the current period follows a given other period (with no overlap). |
| bool | [isFollowedBy()](#isfollowedby) | Return true if the given other period follows the current one (with no overlap). |
| bool | [isConsecutiveWith()](#isconsecutivewith) | Return true if the given period either follows or is followed by the current one. |
| static | [start()](#start) | Create instance specifying start date or modify the start date if called on an instance. |
| static | [since()](#since) | . |
| static | [sinceNow()](#sincenow) | Create instance with start date set to now or set the start date to now if called on an instance. |
| static | [end()](#end) | Create instance specifying end date or modify the end date if called on an instance. |
| static | [until()](#until) | . |
| static | [untilNow()](#untilnow) | Create instance with end date set to now or set the end date to now if called on an instance. |
| static | [dates()](#dates) | Create instance with start and end dates or modify the start and end dates if called on an instance. |
| static | [between()](#between) | Create instance with start and end dates or modify the start and end dates if called on an instance. |
| static | [recurrences()](#recurrences) | Create instance with maximum number of recurrences or modify the number of recurrences if called on an instance. |
| static | [times()](#times) | . |
| static | [options()](#options) | Create instance with options or modify the options if called on an instance. |
| static | [toggle()](#toggle) | Create instance with options toggled on or off, or toggle options if called on an instance. |
| static | [filter()](#filter) | Create instance with filter added to the stack or append a filter if called on an instance. |
| static | [push()](#push) | . |
| static | [prepend()](#prepend) | Create instance with filter prepended to the stack or prepend a filter if called on an instance. |
| static | [filters()](#filters) | Create instance with filters stack or replace the whole filters stack if called on an instance. |
| static | [interval()](#interval) | Create instance with given date interval or modify the interval if called on an instance. |
| static | [each()](#each) | Create instance with given date interval or modify the interval if called on an instance. |
| static | [every()](#every) | Create instance with given date interval or modify the interval if called on an instance. |
| static | [step()](#step) | Create instance with given date interval or modify the interval if called on an instance. |
| static | [stepBy()](#stepby) | Create instance with given date interval or modify the interval if called on an instance. |
| static | [invert()](#invert) | Create instance with inverted date interval or invert the interval if called on an instance. |
| static | [years()](#years) | Create instance specifying a number of years for date interval or replace the interval by the given a number of years if called on an instance. |
| static | [year()](#year) | . |
| static | [months()](#months) | Create instance specifying a number of months for date interval or replace the interval by the given a number of months if called on an instance. |
| static | [month()](#month) | . |
| static | [weeks()](#weeks) | Create instance specifying a number of weeks for date interval or replace the interval by the given a number of weeks if called on an instance. |
| static | [week()](#week) | . |
| static | [days()](#days) | Create instance specifying a number of days for date interval or replace the interval by the given a number of days if called on an instance. |
| static | [dayz()](#dayz) | . |
| static | [day()](#day) | . |
| static | [hours()](#hours) | Create instance specifying a number of hours for date interval or replace the interval by the given a number of hours if called on an instance. |
| static | [hour()](#hour) | . |
| static | [minutes()](#minutes) | Create instance specifying a number of minutes for date interval or replace the interval by the given a number of minutes if called on an instance. |
| static | [minute()](#minute) | . |
| static | [seconds()](#seconds) | Create instance specifying a number of seconds for date interval or replace the interval by the given a number of seconds if called on an instance. |
| static | [second()](#second) | . |
| static | [milliseconds()](#milliseconds) | Create instance specifying a number of milliseconds for date interval or replace the interval by the given a number of milliseconds if called on an instance. |
| static | [millisecond()](#millisecond) | . |
| static | [microseconds()](#microseconds) | Create instance specifying a number of microseconds for date interval or replace the interval by the given a number of microseconds if called on an instance. |
| static | [microsecond()](#microsecond) | . |
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

### make

```php
static public CarbonPeriod\|null make($var)
```

Make a CarbonPeriod instance from given variable if possible.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$var` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)\|null
---

### instance

```php
static public CarbonPeriod instance($period)
```

Create a new instance from a DatePeriod or CarbonPeriod object.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonPeriod](../Carbon/CarbonPeriod.md)\|[DatePeriod](https://www.php.net/class.dateperiod) | `$period` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### create

```php
static public CarbonPeriod create(...$params)
```

Create a new instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
|  | ...`$params` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### createFromArray

```php
static public CarbonPeriod createFromArray($params)
```

Create a new instance from an array of parameters.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| array | `$params` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### createFromIso

```php
static public CarbonPeriod createFromIso($iso, $options = null)
```

Create CarbonPeriod from ISO 8601 string.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$iso` | —  |  |
| int\|null | `$options` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### macro

```php
static public void macro($name, $macro)
```

Register a custom macro.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$name` | —  |  |
| object\|callable | `$macro` | —  |  |

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

### copy

```php
public CarbonPeriod copy()
```

Get a copy of the instance.

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### get

```php
public bool\|CarbonInterface\|CarbonInterval\|int\|null get($name)
```

Get a property allowing both `DatePeriod` snakeCase and camelCase names.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$name` | —  |  |

**Returns:** bool\|CarbonInterface\|[CarbonInterval](../Carbon/CarbonInterval.md)\|int\|null
---

### clone

```php
public CarbonPeriod clone()
```

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### setDateClass

```php
public CarbonPeriod setDateClass($dateClass)
```

Set the iteration item class.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$dateClass` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### getDateClass

```php
public string getDateClass()
```

Returns iteration item date class.

**Returns:** string
---

### setDateInterval

```php
public CarbonPeriod setDateInterval($interval)
```

Change the period date interval.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateInterval](https://www.php.net/class.dateinterval)\|string | `$interval` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
**Throws:**

- InvalidIntervalException
---

### invertDateInterval

```php
public CarbonPeriod invertDateInterval()
```

Invert the period date interval.

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### setDates

```php
public CarbonPeriod setDates($start, $end)
```

Set start and end date.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](https://www.php.net/class.datetime)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|string | `$start` | —  |  |
| [DateTime](https://www.php.net/class.datetime)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|string\|null | `$end` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### setOptions

```php
public CarbonPeriod setOptions($options)
```

Change the period options.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|null | `$options` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
**Throws:**

- [InvalidArgumentException](https://www.php.net/class.invalidargumentexception)
---

### getOptions

```php
public int getOptions()
```

Get the period options.

**Returns:** int
---

### toggleOptions

```php
public CarbonPeriod toggleOptions($options, $state = null)
```

Toggle given options on or off.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$options` | —  |  |
| bool\|null | `$state` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
**Throws:**

- [InvalidArgumentException](https://www.php.net/class.invalidargumentexception)
---

### excludeStartDate

```php
public CarbonPeriod excludeStartDate($state = true)
```

Toggle EXCLUDE_START_DATE option.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$state` | `true` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### excludeEndDate

```php
public CarbonPeriod excludeEndDate($state = true)
```

Toggle EXCLUDE_END_DATE option.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$state` | `true` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### getDateInterval

```php
public CarbonInterval getDateInterval()
```

Get the underlying date interval.

**Returns:** [CarbonInterval](../Carbon/CarbonInterval.md)
---

### getStartDate

```php
public CarbonInterface getStartDate($rounding = null)
```

Get start date of the period.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|null | `$rounding` | `null` | Optional rounding 'floor', 'ceil', 'round' using the period interval. |

**Returns:** CarbonInterface
---

### getEndDate

```php
public CarbonInterface\|null getEndDate($rounding = null)
```

Get end date of the period.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|null | `$rounding` | `null` | Optional rounding 'floor', 'ceil', 'round' using the period interval. |

**Returns:** CarbonInterface\|null
---

### getRecurrences

```php
public int\|float\|null getRecurrences()
```

Get number of recurrences.

**Returns:** int\|float\|null
---

### isStartExcluded

```php
public bool isStartExcluded()
```

Returns true if the start date should be excluded.

**Returns:** bool
---

### isEndExcluded

```php
public bool isEndExcluded()
```

Returns true if the end date should be excluded.

**Returns:** bool
---

### isStartIncluded

```php
public bool isStartIncluded()
```

Returns true if the start date should be included.

**Returns:** bool
---

### isEndIncluded

```php
public bool isEndIncluded()
```

Returns true if the end date should be included.

**Returns:** bool
---

### getIncludedStartDate

```php
public CarbonInterface getIncludedStartDate()
```

Return the start if it's included by option, else return the start + 1 period interval.

**Returns:** CarbonInterface
---

### getIncludedEndDate

```php
public CarbonInterface getIncludedEndDate()
```

Return the end if it's included by option, else return the end - 1 period interval.

Warning: if the period has no fixed end, this method will iterate the period to calculate it.

**Returns:** CarbonInterface
---

### addFilter

```php
public CarbonPeriod addFilter($callback, $name = null)
```

Add a filter to the stack.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$callback` | —  |  |
| string | `$name` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### prependFilter

```php
public CarbonPeriod prependFilter($callback, $name = null)
```

Prepend a filter to the stack.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$callback` | —  |  |
| string | `$name` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### removeFilter

```php
public CarbonPeriod removeFilter($filter)
```

Remove a filter by instance or name.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable\|string | `$filter` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### hasFilter

```php
public bool hasFilter($filter)
```

Return whether given instance or name is in the filter stack.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable\|string | `$filter` | —  |  |

**Returns:** bool
---

### getFilters

```php
public array getFilters()
```

Get filters stack.

**Returns:** array
---

### setFilters

```php
public CarbonPeriod setFilters($filters)
```

Set filters stack.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| array | `$filters` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### resetFilters

```php
public CarbonPeriod resetFilters()
```

Reset filters stack.

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### setRecurrences

```php
public CarbonPeriod setRecurrences($recurrences)
```

Add a recurrences filter (set maximum number of recurrences).

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|null | `$recurrences` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
**Throws:**

- [InvalidArgumentException](https://www.php.net/class.invalidargumentexception)
---

### setStartDate

```php
public CarbonPeriod setStartDate($date, $inclusive = null)
```

Change the period start date.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](https://www.php.net/class.datetime)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|string | `$date` | —  |  |
| bool\|null | `$inclusive` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
**Throws:**

- InvalidPeriodDateException
---

### setEndDate

```php
public CarbonPeriod setEndDate($date, $inclusive = null)
```

Change the period end date.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](https://www.php.net/class.datetime)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|string\|null | `$date` | —  |  |
| bool\|null | `$inclusive` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
**Throws:**

- [InvalidArgumentException](https://www.php.net/class.invalidargumentexception)
---

### valid

```php
public bool valid()
```

Check if the current position is valid.

**Returns:** bool
---

### key

```php
public int\|null key()
```

Return the current key.

**Returns:** int\|null
---

### current

```php
public CarbonInterface\|null current()
```

Return the current date.

**Returns:** CarbonInterface\|null
---

### next

```php
public void next()
```

Move forward to the next date.

**Returns:** void
**Throws:**

- [RuntimeException](https://www.php.net/class.runtimeexception)
---

### rewind

```php
public void rewind()
```

Rewind to the start date.

Iterating over a date in the UTC timezone avoids bug during backward DST change.

**Returns:** void
**Throws:**

- [RuntimeException](https://www.php.net/class.runtimeexception)
**See also:**

- [https://bugs.php.net/bug.php?id=72255](https://bugs.php.net/bug.php?id=72255)
- [https://bugs.php.net/bug.php?id=74274](https://bugs.php.net/bug.php?id=74274)
- [https://wiki.php.net/rfc/datetime_and_daylight_saving_time](https://wiki.php.net/rfc/datetime_and_daylight_saving_time)
---

### skip

```php
public bool skip($count = 1)
```

Skip iterations and returns iteration state (false if ended, true if still valid).

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$count` | `1` | steps number to skip (1 by default) |

**Returns:** bool
---

### toIso8601String

```php
public string toIso8601String()
```

Format the date period as ISO 8601.

**Returns:** string
---

### toString

```php
public string toString()
```

Convert the date period into a string.

**Returns:** string
---

### spec

```php
public string spec()
```

Format the date period as ISO 8601.

**Returns:** string
---

### cast

```php
public DatePeriod cast($className)
```

Cast the current instance into the given class.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$className` | —  | The $className::instance() method will be called to cast the current object. |

**Returns:** [DatePeriod](https://www.php.net/class.dateperiod)
---

### toDatePeriod

```php
public DatePeriod toDatePeriod()
```

Return native DatePeriod PHP object matching the current instance.

**Returns:** [DatePeriod](https://www.php.net/class.dateperiod)
---

### isUnfilteredAndEndLess

```php
public bool isUnfilteredAndEndLess()
```

Return `true` if the period has no custom filter and is guaranteed to be endless.

Note that we can't check if a period is endless as soon as it has custom filters
because filters can emit `CarbonPeriod::END_ITERATION` to stop the iteration in
a way we can't predict without actually iterating the period.

**Returns:** bool
---

### toArray

```php
public CarbonInterface[] toArray()
```

Convert the date period into an array without changing current iteration state.

**Returns:** CarbonInterface[]
---

### count

```php
public int count()
```

Count dates in the date period.

**Returns:** int
---

### first

```php
public CarbonInterface\|null first()
```

Return the first date in the date period.

**Returns:** CarbonInterface\|null
---

### last

```php
public CarbonInterface\|null last()
```

Return the last date in the date period.

**Returns:** CarbonInterface\|null
---

### setTimezone

```php
public CarbonPeriod setTimezone($timezone)
```

Set the instance's timezone from a string or object and apply it to start/end.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeZone](https://www.php.net/class.datetimezone)\|string | `$timezone` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### shiftTimezone

```php
public CarbonPeriod shiftTimezone($timezone)
```

Set the instance's timezone from a string or object and add/subtract the offset difference to start/end.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeZone](https://www.php.net/class.datetimezone)\|string | `$timezone` | —  |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### calculateEnd

```php
public CarbonInterface calculateEnd($rounding = null)
```

Returns the end is set, else calculated from start an recurrences.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|null | `$rounding` | `null` | Optional rounding 'floor', 'ceil', 'round' using the period interval. |

**Returns:** CarbonInterface
---

### overlaps

```php
public bool overlaps($rangeOrRangeStart, $rangeEnd = null)
```

Returns true if the current period overlaps the given one (if 1 parameter passed)
or the period between 2 dates (if 2 parameters passed).

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonPeriod](../Carbon/CarbonPeriod.md)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|[Carbon](../Carbon/Carbon.md)\|[CarbonImmutable](../Carbon/CarbonImmutable.md)\|string | `$rangeOrRangeStart` | —  |  |
| [DateTimeInterface](https://www.php.net/class.datetimeinterface)\|[Carbon](../Carbon/Carbon.md)\|[CarbonImmutable](../Carbon/CarbonImmutable.md)\|string\|null | `$rangeEnd` | `null` |  |

**Returns:** bool
---

### forEach

```php
public  forEach($callback)
```

Execute a given function on each date of the period.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$callback` | —  |  |

---

### map

```php
public Generator map($callback)
```

Execute a given function on each date of the period and yield the result of this function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$callback` | —  |  |

**Returns:** [Generator](https://www.php.net/class.generator)
---

### eq

```php
public bool eq($period)
```

Determines if the instance is equal to another.

Warning: if options differ, instances will never be equal.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$period` | —  |  |

**Returns:** bool
**See also:**

- equalTo()
---

### equalTo

```php
public bool equalTo($period)
```

Determines if the instance is equal to another.

Warning: if options differ, instances will never be equal.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$period` | —  |  |

**Returns:** bool
---

### ne

```php
public bool ne($period)
```

Determines if the instance is not equal to another.

Warning: if options differ, instances will never be equal.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$period` | —  |  |

**Returns:** bool
**See also:**

- notEqualTo()
---

### notEqualTo

```php
public bool notEqualTo($period)
```

Determines if the instance is not equal to another.

Warning: if options differ, instances will never be equal.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$period` | —  |  |

**Returns:** bool
---

### startsBefore

```php
public bool startsBefore($date = null)
```

Determines if the start date is before an other given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### startsBeforeOrAt

```php
public bool startsBeforeOrAt($date = null)
```

Determines if the start date is before or the same as a given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### startsAfter

```php
public bool startsAfter($date = null)
```

Determines if the start date is after an other given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### startsAfterOrAt

```php
public bool startsAfterOrAt($date = null)
```

Determines if the start date is after or the same as a given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### startsAt

```php
public bool startsAt($date = null)
```

Determines if the start date is the same as a given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### endsBefore

```php
public bool endsBefore($date = null)
```

Determines if the end date is before an other given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### endsBeforeOrAt

```php
public bool endsBeforeOrAt($date = null)
```

Determines if the end date is before or the same as a given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### endsAfter

```php
public bool endsAfter($date = null)
```

Determines if the end date is after an other given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### endsAfterOrAt

```php
public bool endsAfterOrAt($date = null)
```

Determines if the end date is after or the same as a given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### endsAt

```php
public bool endsAt($date = null)
```

Determines if the end date is the same as a given date.

(Rather start/end are included by options is ignored.)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `null` |  |

**Returns:** bool
---

### isStarted

```php
public bool isStarted()
```

Return true if start date is now or later.

(Rather start/end are included by options is ignored.)

**Returns:** bool
---

### isEnded

```php
public bool isEnded()
```

Return true if end date is now or later.

(Rather start/end are included by options is ignored.)

**Returns:** bool
---

### isInProgress

```php
public bool isInProgress()
```

Return true if now is between start date (included) and end date (excluded).

(Rather start/end are included by options is ignored.)

**Returns:** bool
---

### roundUnit

```php
public CarbonPeriod roundUnit($unit, $precision = 1, $function = &#039;round&#039;)
```

Round the current instance at the given unit with given precision if specified and the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$unit` | —  |  |
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `1` |  |
| string | `$function` | `&#039;round&#039;` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### floorUnit

```php
public CarbonPeriod floorUnit($unit, $precision = 1)
```

Truncate the current instance at the given unit with given precision if specified.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$unit` | —  |  |
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `1` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### ceilUnit

```php
public CarbonPeriod ceilUnit($unit, $precision = 1)
```

Ceil the current instance at the given unit with given precision if specified.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$unit` | —  |  |
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `1` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### round

```php
public CarbonPeriod round($precision = null, $function = &#039;round&#039;)
```

Round the current instance second with given precision if specified (else period interval is used).

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `null` |  |
| string | `$function` | `&#039;round&#039;` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### floor

```php
public CarbonPeriod floor($precision = null)
```

Round the current instance second with given precision if specified (else period interval is used).

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### ceil

```php
public CarbonPeriod ceil($precision = null)
```

Ceil the current instance second with given precision if specified (else period interval is used).

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float\|int\|string\|[DateInterval](https://www.php.net/class.dateinterval)\|null | `$precision` | `null` |  |

**Returns:** [CarbonPeriod](../Carbon/CarbonPeriod.md)
---

### jsonSerialize

```php
public CarbonInterface[] jsonSerialize()
```

Specify data which should be serialized to JSON.

**Returns:** CarbonInterface[]
---

### contains

```php
public bool contains($date = null)
```

Return true if the given date is between start and end.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [Carbon](../Carbon/Carbon.md)\|[CarbonPeriod](../Carbon/CarbonPeriod.md)\|[CarbonInterval](../Carbon/CarbonInterval.md)\|[DateInterval](https://www.php.net/class.dateinterval)\|[DatePeriod](https://www.php.net/class.dateperiod)\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|string\|null | `$date` | `null` |  |

**Returns:** bool
---

### follows

```php
public bool follows($period, ...$arguments)
```

Return true if the current period follows a given other period (with no overlap).

For instance, [2019-08-01 -> 2019-08-12] follows [2019-07-29 -> 2019-07-31]
Note than in this example, follows() would be false if 2019-08-01 or 2019-07-31 was excluded by options.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonPeriod](../Carbon/CarbonPeriod.md)\|[DatePeriod](https://www.php.net/class.dateperiod)\|string | `$period` | —  |  |
|  | ...`$arguments` | —  |  |

**Returns:** bool
---

### isFollowedBy

```php
public bool isFollowedBy($period, ...$arguments)
```

Return true if the given other period follows the current one (with no overlap).

For instance, [2019-07-29 -> 2019-07-31] is followed by [2019-08-01 -> 2019-08-12]
Note than in this example, isFollowedBy() would be false if 2019-08-01 or 2019-07-31 was excluded by options.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonPeriod](../Carbon/CarbonPeriod.md)\|[DatePeriod](https://www.php.net/class.dateperiod)\|string | `$period` | —  |  |
|  | ...`$arguments` | —  |  |

**Returns:** bool
---

### isConsecutiveWith

```php
public bool isConsecutiveWith($period, ...$arguments)
```

Return true if the given period either follows or is followed by the current one.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [CarbonPeriod](../Carbon/CarbonPeriod.md)\|[DatePeriod](https://www.php.net/class.dateperiod)\|string | `$period` | —  |  |
|  | ...`$arguments` | —  |  |

**Returns:** bool
**See also:**

- follows()
- isFollowedBy()
---

### start

```php
static public static start($date, $inclusive = &#039;null&#039;)
```

Create instance specifying start date or modify the start date if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | —  |  |
| mixed | `$inclusive` | `&#039;null&#039;` |  |

**Returns:** static
---

### since

```php
static public static since($date, $inclusive = &#039;null&#039;) Alias for start()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | —  |  |
| mixed | `$inclusive` | `&#039;null&#039;) Alias for start(` |  |

**Returns:** static
---

### sinceNow

```php
static public static sinceNow($inclusive = &#039;null&#039;)
```

Create instance with start date set to now or set the start date to now if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$inclusive` | `&#039;null&#039;` |  |

**Returns:** static
---

### end

```php
static public static end($date = &#039;null&#039;, $inclusive = &#039;null&#039;)
```

Create instance specifying end date or modify the end date if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `&#039;null&#039;` |  |
| mixed | `$inclusive` | `&#039;null&#039;` |  |

**Returns:** static
---

### until

```php
static public static until($date = &#039;null&#039;, $inclusive = &#039;null&#039;) Alias for end()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$date` | `&#039;null&#039;` |  |
| mixed | `$inclusive` | `&#039;null&#039;) Alias for end(` |  |

**Returns:** static
---

### untilNow

```php
static public static untilNow($inclusive = &#039;null&#039;)
```

Create instance with end date set to now or set the end date to now if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$inclusive` | `&#039;null&#039;` |  |

**Returns:** static
---

### dates

```php
static public static dates($start, $end = &#039;null&#039;)
```

Create instance with start and end dates or modify the start and end dates if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$start` | —  |  |
| mixed | `$end` | `&#039;null&#039;` |  |

**Returns:** static
---

### between

```php
static public static between($start, $end = &#039;null&#039;)
```

Create instance with start and end dates or modify the start and end dates if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$start` | —  |  |
| mixed | `$end` | `&#039;null&#039;` |  |

**Returns:** static
---

### recurrences

```php
static public static recurrences($recurrences = &#039;null&#039;)
```

Create instance with maximum number of recurrences or modify the number of recurrences if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$recurrences` | `&#039;null&#039;` |  |

**Returns:** static
---

### times

```php
static public static times($recurrences = &#039;null&#039;) Alias for recurrences()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$recurrences` | `&#039;null&#039;) Alias for recurrences(` |  |

**Returns:** static
---

### options

```php
static public static options($options = &#039;null&#039;)
```

Create instance with options or modify the options if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$options` | `&#039;null&#039;` |  |

**Returns:** static
---

### toggle

```php
static public static toggle($options, $state = &#039;null&#039;)
```

Create instance with options toggled on or off, or toggle options if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$options` | —  |  |
| mixed | `$state` | `&#039;null&#039;` |  |

**Returns:** static
---

### filter

```php
static public static filter($callback, $name = &#039;null&#039;)
```

Create instance with filter added to the stack or append a filter if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$callback` | —  |  |
| mixed | `$name` | `&#039;null&#039;` |  |

**Returns:** static
---

### push

```php
static public static push($callback, $name = &#039;null&#039;) Alias for filter()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$callback` | —  |  |
| mixed | `$name` | `&#039;null&#039;) Alias for filter(` |  |

**Returns:** static
---

### prepend

```php
static public static prepend($callback, $name = &#039;null&#039;)
```

Create instance with filter prepended to the stack or prepend a filter if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$callback` | —  |  |
| mixed | `$name` | `&#039;null&#039;` |  |

**Returns:** static
---

### filters

```php
static public static filters($filters = &#039;[]&#039;)
```

Create instance with filters stack or replace the whole filters stack if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| array | `$filters` | `&#039;[]&#039;` |  |

**Returns:** static
---

### interval

```php
static public static interval($interval)
```

Create instance with given date interval or modify the interval if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$interval` | —  |  |

**Returns:** static
---

### each

```php
static public static each($interval)
```

Create instance with given date interval or modify the interval if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$interval` | —  |  |

**Returns:** static
---

### every

```php
static public static every($interval)
```

Create instance with given date interval or modify the interval if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$interval` | —  |  |

**Returns:** static
---

### step

```php
static public static step($interval)
```

Create instance with given date interval or modify the interval if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$interval` | —  |  |

**Returns:** static
---

### stepBy

```php
static public static stepBy($interval)
```

Create instance with given date interval or modify the interval if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$interval` | —  |  |

**Returns:** static
---

### invert

```php
static public static invert()
```

Create instance with inverted date interval or invert the interval if called on an instance.

**Returns:** static
---

### years

```php
static public static years($years = &#039;1&#039;)
```

Create instance specifying a number of years for date interval or replace the interval by the given a number of years if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$years` | `&#039;1&#039;` |  |

**Returns:** static
---

### year

```php
static public static year($years = &#039;1&#039;) Alias for years()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$years` | `&#039;1&#039;) Alias for years(` |  |

**Returns:** static
---

### months

```php
static public static months($months = &#039;1&#039;)
```

Create instance specifying a number of months for date interval or replace the interval by the given a number of months if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$months` | `&#039;1&#039;` |  |

**Returns:** static
---

### month

```php
static public static month($months = &#039;1&#039;) Alias for months()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$months` | `&#039;1&#039;) Alias for months(` |  |

**Returns:** static
---

### weeks

```php
static public static weeks($weeks = &#039;1&#039;)
```

Create instance specifying a number of weeks for date interval or replace the interval by the given a number of weeks if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$weeks` | `&#039;1&#039;` |  |

**Returns:** static
---

### week

```php
static public static week($weeks = &#039;1&#039;) Alias for weeks()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$weeks` | `&#039;1&#039;) Alias for weeks(` |  |

**Returns:** static
---

### days

```php
static public static days($days = &#039;1&#039;)
```

Create instance specifying a number of days for date interval or replace the interval by the given a number of days if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;` |  |

**Returns:** static
---

### dayz

```php
static public static dayz($days = &#039;1&#039;) Alias for days()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;) Alias for days(` |  |

**Returns:** static
---

### day

```php
static public static day($days = &#039;1&#039;) Alias for days()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$days` | `&#039;1&#039;) Alias for days(` |  |

**Returns:** static
---

### hours

```php
static public static hours($hours = &#039;1&#039;)
```

Create instance specifying a number of hours for date interval or replace the interval by the given a number of hours if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$hours` | `&#039;1&#039;` |  |

**Returns:** static
---

### hour

```php
static public static hour($hours = &#039;1&#039;) Alias for hours()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$hours` | `&#039;1&#039;) Alias for hours(` |  |

**Returns:** static
---

### minutes

```php
static public static minutes($minutes = &#039;1&#039;)
```

Create instance specifying a number of minutes for date interval or replace the interval by the given a number of minutes if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$minutes` | `&#039;1&#039;` |  |

**Returns:** static
---

### minute

```php
static public static minute($minutes = &#039;1&#039;) Alias for minutes()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$minutes` | `&#039;1&#039;) Alias for minutes(` |  |

**Returns:** static
---

### seconds

```php
static public static seconds($seconds = &#039;1&#039;)
```

Create instance specifying a number of seconds for date interval or replace the interval by the given a number of seconds if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$seconds` | `&#039;1&#039;` |  |

**Returns:** static
---

### second

```php
static public static second($seconds = &#039;1&#039;) Alias for seconds()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$seconds` | `&#039;1&#039;) Alias for seconds(` |  |

**Returns:** static
---

### milliseconds

```php
static public static milliseconds($milliseconds = &#039;1&#039;)
```

Create instance specifying a number of milliseconds for date interval or replace the interval by the given a number of milliseconds if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$milliseconds` | `&#039;1&#039;` |  |

**Returns:** static
---

### millisecond

```php
static public static millisecond($milliseconds = &#039;1&#039;) Alias for milliseconds()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$milliseconds` | `&#039;1&#039;) Alias for milliseconds(` |  |

**Returns:** static
---

### microseconds

```php
static public static microseconds($microseconds = &#039;1&#039;)
```

Create instance specifying a number of microseconds for date interval or replace the interval by the given a number of microseconds if called on an instance.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$microseconds` | `&#039;1&#039;` |  |

**Returns:** static
---

### microsecond

```php
static public static microsecond($microseconds = &#039;1&#039;) Alias for microseconds()
```

.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| mixed | `$microseconds` | `&#039;1&#039;) Alias for microseconds(` |  |

**Returns:** static
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

### roundWeek

```php
public $this roundWeek($precision = &#039;1&#039;, $function = &#039;&quot;round&quot;&#039;)
```

Round the current instance day with given precision using the given function.

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| float | `$precision` | `&#039;1&#039;` |  |
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
| float | `$precision` | `&#039;1&#039;` |  |
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
| float | `$precision` | `&#039;1&#039;` |  |

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
| float | `$precision` | `&#039;1&#039;` |  |

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
| float | `$precision` | `&#039;1&#039;` |  |

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

