# DatePeriod

**Namespace:** `JapaneseDate`

class **DatePeriod** extends [CarbonPeriod](../Carbon/CarbonPeriod.md)

日本暦に対応した期間イテレータクラス。

CarbonPeriod を継承し、以下の日本固有の機能を追加しています。
フィルタメソッドはすべてメソッドチェーンで接続でき、
`foreach` ループで直接利用可能なイテレータを返します。

**国民の祝日・休日フィルタ**
- 期間内の祝日・休日のみを抽出 (`onlyHolidays()`)
- 期間内の祝日・休日を除外（営業日候補のみ）(`withoutHolidays()`)
- 土日のみを除外 (`withoutWeekends()`)
- 土日と祝日を除外した平日のみ (`onlyWeekdays()`)

**五十日（ごとおび）フィルタ**
- 日本の商習慣における決済日（5・10・15・20・25・月末）かつ営業日のみを抽出 (`onlyGotobi()`)

**六曜フィルタ**
- 指定した六曜（大安・友引など）のみを抽出 (`onlySixWeekday()`)
- 指定した六曜を除外 (`withoutSixWeekday()`)

**雑節・節気フィルタ**
- 土用期間内の日付のみを抽出 (`onlyDoyo()`)
- 彼岸期間内の日付のみを抽出 (`onlyHigan()`)

**二十四節気区切りのイテレータ生成**
- 節気の切り替わりをステップとするイテレータを生成 (`eachSolarTerm()`)

**旧暦月ごとのイテレータ生成**
- 旧暦の朔日（新月）をステップとするイテレータを生成 (`eachLunarMonth()`)

**元号関連**
- 元号ごとに期間を分割 (`splitByEra()`)
- 和暦年度（4月〜翌3月）ごとのイテレータを生成 (`eachJapaneseFiscalYear()`)

【使用例: 2026年度の祝日のみを取得する】
```php
use JapaneseDate\DatePeriod;
use JapaneseDate\DateTime;

$period = DatePeriod::create('2026-04-01', '1 day', '2027-03-31')
    ->onlyHolidays();

foreach ($period as $date) {
    echo $date->format('Y-m-d') . ' ' . $date->holidayText . PHP_EOL;
}
```

【使用例: 2026年度の大安のみを取得する】
```php
$period = DatePeriod::create('2026-04-01', '1 day', '2027-03-31')
    ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN);
```

【使用例: 2026年の節気区切りでイテレートする】
```php
$period = DatePeriod::eachSolarTerm(
    DateTime::parse('2026-01-01'),
    DateTime::parse('2026-12-31')
);
foreach ($period as $date) {
    echo $date->format('Y-m-d') . ' ' . $date->solarTermText . PHP_EOL;
}
```

## Traits

- [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md)
- LocalFactory
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
| public | `EXCLUDE_END_DATE` | Exclude end date from iteration. |
| public | `IMMUTABLE` | Yield CarbonImmutable instances. |
| public | `NEXT_MAX_ATTEMPTS` | Number of maximum attempts before giving up on finding next valid date. |
| public | `END_MAX_ATTEMPTS` | Number of maximum attempts before giving up on finding end date. |
| protected | `DEFAULT_DATE_CLASS` | Default date class of iteration items. |
| protected | `ERA_START_DATES` | 元号の開始日（西暦）のマッピング。 |
| protected | `ERA_END_DATES` | 元号の終了日（次の元号の前日）のマッピング。 |

## Methods

| Return | Method | Description |
|---|---|---|
| Generator | [CarbonPeriod::getIterator](../Carbon/CarbonPeriod.md#getiterator) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ |  |
| CarbonPeriod\|null | [CarbonPeriod::make](../Carbon/CarbonPeriod.md#make) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Make a CarbonPeriod instance from given variable if possible. |
| CarbonPeriod | [CarbonPeriod::instance](../Carbon/CarbonPeriod.md#instance) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create a new instance from a DatePeriod or CarbonPeriod object. |
| CarbonPeriod | [CarbonPeriod::create](../Carbon/CarbonPeriod.md#create) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create a new instance. |
| CarbonPeriod | [CarbonPeriod::createFromArray](../Carbon/CarbonPeriod.md#createfromarray) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create a new instance from an array of parameters. |
| CarbonPeriod | [CarbonPeriod::createFromIso](../Carbon/CarbonPeriod.md#createfromiso) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create CarbonPeriod from ISO 8601 string. |
| CarbonPeriod | [CarbonPeriod::createFromISO8601String](../Carbon/CarbonPeriod.md#createfromiso8601string) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ |  |
| void | [CarbonPeriod::macro](../Carbon/CarbonPeriod.md#macro) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Register a custom macro. |
| void | [CarbonPeriod::mixin](../Carbon/CarbonPeriod.md#mixin) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Register macros from a mixin object. |
| bool | [CarbonPeriod::hasMacro](../Carbon/CarbonPeriod.md#hasmacro) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Check if macro is registered. |
| CarbonPeriod | [CarbonPeriod::copy](../Carbon/CarbonPeriod.md#copy) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get a copy of the instance. |
| bool\|CarbonInterface\|CarbonInterval\|int\|null | [CarbonPeriod::get](../Carbon/CarbonPeriod.md#get) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get a property allowing both `DatePeriod` snakeCase and camelCase names. |
| CarbonPeriod | [CarbonPeriod::clone](../Carbon/CarbonPeriod.md#clone) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ |  |
| CarbonPeriod | [CarbonPeriod::setDateClass](../Carbon/CarbonPeriod.md#setdateclass) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Set the iteration item class. |
| string | [CarbonPeriod::getDateClass](../Carbon/CarbonPeriod.md#getdateclass) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Returns iteration item date class. |
| CarbonPeriod | [CarbonPeriod::setDateInterval](../Carbon/CarbonPeriod.md#setdateinterval) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Change the period date interval. |
| CarbonPeriod | [CarbonPeriod::resetDateInterval](../Carbon/CarbonPeriod.md#resetdateinterval) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Reset the date interval to the default value. |
| CarbonPeriod | [CarbonPeriod::invertDateInterval](../Carbon/CarbonPeriod.md#invertdateinterval) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Invert the period date interval. |
| CarbonPeriod | [CarbonPeriod::setDates](../Carbon/CarbonPeriod.md#setdates) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Set start and end date. |
| CarbonPeriod | [CarbonPeriod::setOptions](../Carbon/CarbonPeriod.md#setoptions) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Change the period options. |
| int | [CarbonPeriod::getOptions](../Carbon/CarbonPeriod.md#getoptions) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get the period options. |
| CarbonPeriod | [CarbonPeriod::toggleOptions](../Carbon/CarbonPeriod.md#toggleoptions) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Toggle given options on or off. |
| CarbonPeriod | [CarbonPeriod::excludeStartDate](../Carbon/CarbonPeriod.md#excludestartdate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Toggle EXCLUDE_START_DATE option. |
| CarbonPeriod | [CarbonPeriod::excludeEndDate](../Carbon/CarbonPeriod.md#excludeenddate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Toggle EXCLUDE_END_DATE option. |
| CarbonInterval | [CarbonPeriod::getDateInterval](../Carbon/CarbonPeriod.md#getdateinterval) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get the underlying date interval. |
| CarbonInterface | [CarbonPeriod::getStartDate](../Carbon/CarbonPeriod.md#getstartdate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get start date of the period. |
| CarbonInterface\|null | [CarbonPeriod::getEndDate](../Carbon/CarbonPeriod.md#getenddate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get end date of the period. |
| int\|float\|null | [CarbonPeriod::getRecurrences](../Carbon/CarbonPeriod.md#getrecurrences) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get number of recurrences. |
| bool | [CarbonPeriod::isStartExcluded](../Carbon/CarbonPeriod.md#isstartexcluded) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Returns true if the start date should be excluded. |
| bool | [CarbonPeriod::isEndExcluded](../Carbon/CarbonPeriod.md#isendexcluded) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Returns true if the end date should be excluded. |
| bool | [CarbonPeriod::isStartIncluded](../Carbon/CarbonPeriod.md#isstartincluded) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Returns true if the start date should be included. |
| bool | [CarbonPeriod::isEndIncluded](../Carbon/CarbonPeriod.md#isendincluded) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Returns true if the end date should be included. |
| CarbonInterface | [CarbonPeriod::getIncludedStartDate](../Carbon/CarbonPeriod.md#getincludedstartdate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return the start if it's included by option, else return the start + 1 period interval. |
| CarbonInterface | [CarbonPeriod::getIncludedEndDate](../Carbon/CarbonPeriod.md#getincludedenddate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return the end if it's included by option, else return the end - 1 period interval. |
| CarbonPeriod | [CarbonPeriod::addFilter](../Carbon/CarbonPeriod.md#addfilter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Add a filter to the stack. |
| CarbonPeriod | [CarbonPeriod::prependFilter](../Carbon/CarbonPeriod.md#prependfilter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Prepend a filter to the stack. |
| CarbonPeriod | [CarbonPeriod::removeFilter](../Carbon/CarbonPeriod.md#removefilter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Remove a filter by instance or name. |
| bool | [CarbonPeriod::hasFilter](../Carbon/CarbonPeriod.md#hasfilter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return whether given instance or name is in the filter stack. |
| array | [CarbonPeriod::getFilters](../Carbon/CarbonPeriod.md#getfilters) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Get filters stack. |
| CarbonPeriod | [CarbonPeriod::setFilters](../Carbon/CarbonPeriod.md#setfilters) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Set filters stack. |
| CarbonPeriod | [CarbonPeriod::resetFilters](../Carbon/CarbonPeriod.md#resetfilters) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Reset filters stack. |
| CarbonPeriod | [CarbonPeriod::setRecurrences](../Carbon/CarbonPeriod.md#setrecurrences) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Add a recurrences filter (set maximum number of recurrences). |
| CarbonPeriod | [CarbonPeriod::setStartDate](../Carbon/CarbonPeriod.md#setstartdate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Change the period start date. |
| CarbonPeriod | [CarbonPeriod::setEndDate](../Carbon/CarbonPeriod.md#setenddate) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Change the period end date. |
| bool | [CarbonPeriod::valid](../Carbon/CarbonPeriod.md#valid) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Check if the current position is valid. |
| int\|null | [CarbonPeriod::key](../Carbon/CarbonPeriod.md#key) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return the current key. |
| CarbonInterface\|null | [CarbonPeriod::current](../Carbon/CarbonPeriod.md#current) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return the current date. |
| void | [CarbonPeriod::next](../Carbon/CarbonPeriod.md#next) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Move forward to the next date. |
| void | [CarbonPeriod::rewind](../Carbon/CarbonPeriod.md#rewind) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Rewind to the start date. |
| bool | [CarbonPeriod::skip](../Carbon/CarbonPeriod.md#skip) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Skip iterations and returns iteration state (false if ended, true if still valid). |
| string | [CarbonPeriod::toIso8601String](../Carbon/CarbonPeriod.md#toiso8601string) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Format the date period as ISO 8601. |
| string | [CarbonPeriod::toString](../Carbon/CarbonPeriod.md#tostring) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Convert the date period into a string. |
| string | [CarbonPeriod::spec](../Carbon/CarbonPeriod.md#spec) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Format the date period as ISO 8601. |
| object | [CarbonPeriod::cast](../Carbon/CarbonPeriod.md#cast) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Cast the current instance into the given class. |
| DatePeriod | [CarbonPeriod::toDatePeriod](../Carbon/CarbonPeriod.md#todateperiod) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return native DatePeriod PHP object matching the current instance. |
| bool | [CarbonPeriod::isUnfilteredAndEndLess](../Carbon/CarbonPeriod.md#isunfilteredandendless) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return `true` if the period has no custom filter and is guaranteed to be endless. |
| array | [CarbonPeriod::toArray](../Carbon/CarbonPeriod.md#toarray) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Convert the date period into an array without changing current iteration state. |
| int | [CarbonPeriod::count](../Carbon/CarbonPeriod.md#count) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Count dates in the date period. |
| CarbonInterface\|null | [CarbonPeriod::first](../Carbon/CarbonPeriod.md#first) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return the first date in the date period. |
| CarbonInterface\|null | [CarbonPeriod::last](../Carbon/CarbonPeriod.md#last) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return the last date in the date period. |
| CarbonPeriod | [CarbonPeriod::setTimezone](../Carbon/CarbonPeriod.md#settimezone) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Set the instance's timezone from a string or object and apply it to start/end. |
| CarbonPeriod | [CarbonPeriod::shiftTimezone](../Carbon/CarbonPeriod.md#shifttimezone) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Set the instance's timezone from a string or object and add/subtract the offset difference to start/end. |
| CarbonInterface | [CarbonPeriod::calculateEnd](../Carbon/CarbonPeriod.md#calculateend) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Returns the end is set, else calculated from start and recurrences. |
| bool | [CarbonPeriod::overlaps](../Carbon/CarbonPeriod.md#overlaps) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Returns true if the current period overlaps the given one (if 1 parameter passed)
or the period between 2 dates (if 2 parameters passed). |
| void | [CarbonPeriod::forEach](../Carbon/CarbonPeriod.md#foreach) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Execute a given function on each date of the period. |
| Generator | [CarbonPeriod::map](../Carbon/CarbonPeriod.md#map) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Execute a given function on each date of the period and yield the result of this function. |
| bool | [CarbonPeriod::eq](../Carbon/CarbonPeriod.md#eq) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the instance is equal to another. |
| bool | [CarbonPeriod::equalTo](../Carbon/CarbonPeriod.md#equalto) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the instance is equal to another. |
| bool | [CarbonPeriod::ne](../Carbon/CarbonPeriod.md#ne) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the instance is not equal to another. |
| bool | [CarbonPeriod::notEqualTo](../Carbon/CarbonPeriod.md#notequalto) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the instance is not equal to another. |
| bool | [CarbonPeriod::startsBefore](../Carbon/CarbonPeriod.md#startsbefore) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the start date is before another given date. |
| bool | [CarbonPeriod::startsBeforeOrAt](../Carbon/CarbonPeriod.md#startsbeforeorat) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the start date is before or the same as a given date. |
| bool | [CarbonPeriod::startsAfter](../Carbon/CarbonPeriod.md#startsafter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the start date is after another given date. |
| bool | [CarbonPeriod::startsAfterOrAt](../Carbon/CarbonPeriod.md#startsafterorat) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the start date is after or the same as a given date. |
| bool | [CarbonPeriod::startsAt](../Carbon/CarbonPeriod.md#startsat) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the start date is the same as a given date. |
| bool | [CarbonPeriod::endsBefore](../Carbon/CarbonPeriod.md#endsbefore) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the end date is before another given date. |
| bool | [CarbonPeriod::endsBeforeOrAt](../Carbon/CarbonPeriod.md#endsbeforeorat) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the end date is before or the same as a given date. |
| bool | [CarbonPeriod::endsAfter](../Carbon/CarbonPeriod.md#endsafter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the end date is after another given date. |
| bool | [CarbonPeriod::endsAfterOrAt](../Carbon/CarbonPeriod.md#endsafterorat) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the end date is after or the same as a given date. |
| bool | [CarbonPeriod::endsAt](../Carbon/CarbonPeriod.md#endsat) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Determines if the end date is the same as a given date. |
| bool | [CarbonPeriod::isStarted](../Carbon/CarbonPeriod.md#isstarted) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return true if start date is now or later. |
| bool | [CarbonPeriod::isEnded](../Carbon/CarbonPeriod.md#isended) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return true if end date is now or later. |
| bool | [CarbonPeriod::isInProgress](../Carbon/CarbonPeriod.md#isinprogress) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return true if now is between start date (included) and end date (excluded). |
| CarbonPeriod | [CarbonPeriod::roundUnit](../Carbon/CarbonPeriod.md#roundunit) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance at the given unit with given precision if specified and the given function. |
| CarbonPeriod | [CarbonPeriod::floorUnit](../Carbon/CarbonPeriod.md#floorunit) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance at the given unit with given precision if specified. |
| CarbonPeriod | [CarbonPeriod::ceilUnit](../Carbon/CarbonPeriod.md#ceilunit) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance at the given unit with given precision if specified. |
| CarbonPeriod | [CarbonPeriod::round](../Carbon/CarbonPeriod.md#round) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance second with given precision if specified (else period interval is used). |
| CarbonPeriod | [CarbonPeriod::floor](../Carbon/CarbonPeriod.md#floor) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance second with given precision if specified (else period interval is used). |
| CarbonPeriod | [CarbonPeriod::ceil](../Carbon/CarbonPeriod.md#ceil) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance second with given precision if specified (else period interval is used). |
| array | [CarbonPeriod::jsonSerialize](../Carbon/CarbonPeriod.md#jsonserialize) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Specify data which should be serialized to JSON. |
| bool | [CarbonPeriod::contains](../Carbon/CarbonPeriod.md#contains) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return true if the given date is between start and end. |
| bool | [CarbonPeriod::follows](../Carbon/CarbonPeriod.md#follows) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return true if the current period follows a given other period (with no overlap). |
| bool | [CarbonPeriod::isFollowedBy](../Carbon/CarbonPeriod.md#isfollowedby) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return true if the given other period follows the current one (with no overlap). |
| bool | [CarbonPeriod::isConsecutiveWith](../Carbon/CarbonPeriod.md#isconsecutivewith) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Return true if the given period either follows or is followed by the current one. |
| CarbonInterface | [CarbonPeriod::start](../Carbon/CarbonPeriod.md#start) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying start date or modify the start date if called on an instance. |
| static | [CarbonPeriod::since](../Carbon/CarbonPeriod.md#since) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::sinceNow](../Carbon/CarbonPeriod.md#sincenow) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with start date set to now or set the start date to now if called on an instance. |
| CarbonInterface | [CarbonPeriod::end](../Carbon/CarbonPeriod.md#end) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying end date or modify the end date if called on an instance. |
| static | [CarbonPeriod::until](../Carbon/CarbonPeriod.md#until) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::untilNow](../Carbon/CarbonPeriod.md#untilnow) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with end date set to now or set the end date to now if called on an instance. |
| static | [CarbonPeriod::dates](../Carbon/CarbonPeriod.md#dates) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with start and end dates or modify the start and end dates if called on an instance. |
| static | [CarbonPeriod::between](../Carbon/CarbonPeriod.md#between) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with start and end dates or modify the start and end dates if called on an instance. |
| static | [CarbonPeriod::recurrences](../Carbon/CarbonPeriod.md#recurrences) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with maximum number of recurrences or modify the number of recurrences if called on an instance. |
| static | [CarbonPeriod::times](../Carbon/CarbonPeriod.md#times) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static|int|null | [CarbonPeriod::options](../Carbon/CarbonPeriod.md#options) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with options or modify the options if called on an instance. |
| static | [CarbonPeriod::toggle](../Carbon/CarbonPeriod.md#toggle) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with options toggled on or off, or toggle options if called on an instance. |
| static | [CarbonPeriod::filter](../Carbon/CarbonPeriod.md#filter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with filter added to the stack or append a filter if called on an instance. |
| static | [CarbonPeriod::push](../Carbon/CarbonPeriod.md#push) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::prepend](../Carbon/CarbonPeriod.md#prepend) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with filter prepended to the stack or prepend a filter if called on an instance. |
| static|array | [CarbonPeriod::filters](../Carbon/CarbonPeriod.md#filters) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with filters stack or replace the whole filters stack if called on an instance. |
| CarbonInterval | [CarbonPeriod::interval](../Carbon/CarbonPeriod.md#interval) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with given date interval or modify the interval if called on an instance. |
| static | [CarbonPeriod::each](../Carbon/CarbonPeriod.md#each) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with given date interval or modify the interval if called on an instance. |
| static | [CarbonPeriod::every](../Carbon/CarbonPeriod.md#every) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with given date interval or modify the interval if called on an instance. |
| static | [CarbonPeriod::step](../Carbon/CarbonPeriod.md#step) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with given date interval or modify the interval if called on an instance. |
| static | [CarbonPeriod::stepBy](../Carbon/CarbonPeriod.md#stepby) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with given date interval or modify the interval if called on an instance. |
| static | [CarbonPeriod::invert](../Carbon/CarbonPeriod.md#invert) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance with inverted date interval or invert the interval if called on an instance. |
| static | [CarbonPeriod::years](../Carbon/CarbonPeriod.md#years) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of years for date interval or replace the interval by the given a number of years if called on an instance. |
| static | [CarbonPeriod::year](../Carbon/CarbonPeriod.md#year) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::months](../Carbon/CarbonPeriod.md#months) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of months for date interval or replace the interval by the given a number of months if called on an instance. |
| static | [CarbonPeriod::month](../Carbon/CarbonPeriod.md#month) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::weeks](../Carbon/CarbonPeriod.md#weeks) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of weeks for date interval or replace the interval by the given a number of weeks if called on an instance. |
| static | [CarbonPeriod::week](../Carbon/CarbonPeriod.md#week) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::days](../Carbon/CarbonPeriod.md#days) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of days for date interval or replace the interval by the given a number of days if called on an instance. |
| static | [CarbonPeriod::dayz](../Carbon/CarbonPeriod.md#dayz) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::day](../Carbon/CarbonPeriod.md#day) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::hours](../Carbon/CarbonPeriod.md#hours) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of hours for date interval or replace the interval by the given a number of hours if called on an instance. |
| static | [CarbonPeriod::hour](../Carbon/CarbonPeriod.md#hour) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::minutes](../Carbon/CarbonPeriod.md#minutes) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of minutes for date interval or replace the interval by the given a number of minutes if called on an instance. |
| static | [CarbonPeriod::minute](../Carbon/CarbonPeriod.md#minute) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::seconds](../Carbon/CarbonPeriod.md#seconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of seconds for date interval or replace the interval by the given a number of seconds if called on an instance. |
| static | [CarbonPeriod::second](../Carbon/CarbonPeriod.md#second) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::milliseconds](../Carbon/CarbonPeriod.md#milliseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of milliseconds for date interval or replace the interval by the given a number of milliseconds if called on an instance. |
| static | [CarbonPeriod::millisecond](../Carbon/CarbonPeriod.md#millisecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| static | [CarbonPeriod::microseconds](../Carbon/CarbonPeriod.md#microseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Create instance specifying a number of microseconds for date interval or replace the interval by the given a number of microseconds if called on an instance. |
| static | [CarbonPeriod::microsecond](../Carbon/CarbonPeriod.md#microsecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | . |
| $this | [CarbonPeriod::roundYear](../Carbon/CarbonPeriod.md#roundyear) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance year with given precision using the given function. |
| $this | [CarbonPeriod::roundYears](../Carbon/CarbonPeriod.md#roundyears) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance year with given precision using the given function. |
| $this | [CarbonPeriod::floorYear](../Carbon/CarbonPeriod.md#flooryear) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance year with given precision. |
| $this | [CarbonPeriod::floorYears](../Carbon/CarbonPeriod.md#flooryears) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance year with given precision. |
| $this | [CarbonPeriod::ceilYear](../Carbon/CarbonPeriod.md#ceilyear) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance year with given precision. |
| $this | [CarbonPeriod::ceilYears](../Carbon/CarbonPeriod.md#ceilyears) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance year with given precision. |
| $this | [CarbonPeriod::roundMonth](../Carbon/CarbonPeriod.md#roundmonth) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance month with given precision using the given function. |
| $this | [CarbonPeriod::roundMonths](../Carbon/CarbonPeriod.md#roundmonths) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance month with given precision using the given function. |
| $this | [CarbonPeriod::floorMonth](../Carbon/CarbonPeriod.md#floormonth) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance month with given precision. |
| $this | [CarbonPeriod::floorMonths](../Carbon/CarbonPeriod.md#floormonths) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance month with given precision. |
| $this | [CarbonPeriod::ceilMonth](../Carbon/CarbonPeriod.md#ceilmonth) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance month with given precision. |
| $this | [CarbonPeriod::ceilMonths](../Carbon/CarbonPeriod.md#ceilmonths) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance month with given precision. |
| $this | [CarbonPeriod::roundWeek](../Carbon/CarbonPeriod.md#roundweek) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonPeriod::roundWeeks](../Carbon/CarbonPeriod.md#roundweeks) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonPeriod::floorWeek](../Carbon/CarbonPeriod.md#floorweek) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonPeriod::floorWeeks](../Carbon/CarbonPeriod.md#floorweeks) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonPeriod::ceilWeek](../Carbon/CarbonPeriod.md#ceilweek) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonPeriod::ceilWeeks](../Carbon/CarbonPeriod.md#ceilweeks) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonPeriod::roundDay](../Carbon/CarbonPeriod.md#roundday) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonPeriod::roundDays](../Carbon/CarbonPeriod.md#rounddays) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonPeriod::floorDay](../Carbon/CarbonPeriod.md#floorday) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonPeriod::floorDays](../Carbon/CarbonPeriod.md#floordays) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonPeriod::ceilDay](../Carbon/CarbonPeriod.md#ceilday) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonPeriod::ceilDays](../Carbon/CarbonPeriod.md#ceildays) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonPeriod::roundHour](../Carbon/CarbonPeriod.md#roundhour) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [CarbonPeriod::roundHours](../Carbon/CarbonPeriod.md#roundhours) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [CarbonPeriod::floorHour](../Carbon/CarbonPeriod.md#floorhour) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance hour with given precision. |
| $this | [CarbonPeriod::floorHours](../Carbon/CarbonPeriod.md#floorhours) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance hour with given precision. |
| $this | [CarbonPeriod::ceilHour](../Carbon/CarbonPeriod.md#ceilhour) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance hour with given precision. |
| $this | [CarbonPeriod::ceilHours](../Carbon/CarbonPeriod.md#ceilhours) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance hour with given precision. |
| $this | [CarbonPeriod::roundMinute](../Carbon/CarbonPeriod.md#roundminute) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [CarbonPeriod::roundMinutes](../Carbon/CarbonPeriod.md#roundminutes) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [CarbonPeriod::floorMinute](../Carbon/CarbonPeriod.md#floorminute) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance minute with given precision. |
| $this | [CarbonPeriod::floorMinutes](../Carbon/CarbonPeriod.md#floorminutes) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance minute with given precision. |
| $this | [CarbonPeriod::ceilMinute](../Carbon/CarbonPeriod.md#ceilminute) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance minute with given precision. |
| $this | [CarbonPeriod::ceilMinutes](../Carbon/CarbonPeriod.md#ceilminutes) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance minute with given precision. |
| $this | [CarbonPeriod::roundSecond](../Carbon/CarbonPeriod.md#roundsecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance second with given precision using the given function. |
| $this | [CarbonPeriod::roundSeconds](../Carbon/CarbonPeriod.md#roundseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance second with given precision using the given function. |
| $this | [CarbonPeriod::floorSecond](../Carbon/CarbonPeriod.md#floorsecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance second with given precision. |
| $this | [CarbonPeriod::floorSeconds](../Carbon/CarbonPeriod.md#floorseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance second with given precision. |
| $this | [CarbonPeriod::ceilSecond](../Carbon/CarbonPeriod.md#ceilsecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance second with given precision. |
| $this | [CarbonPeriod::ceilSeconds](../Carbon/CarbonPeriod.md#ceilseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance second with given precision. |
| $this | [CarbonPeriod::roundMillennium](../Carbon/CarbonPeriod.md#roundmillennium) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [CarbonPeriod::roundMillennia](../Carbon/CarbonPeriod.md#roundmillennia) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [CarbonPeriod::floorMillennium](../Carbon/CarbonPeriod.md#floormillennium) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance millennium with given precision. |
| $this | [CarbonPeriod::floorMillennia](../Carbon/CarbonPeriod.md#floormillennia) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance millennium with given precision. |
| $this | [CarbonPeriod::ceilMillennium](../Carbon/CarbonPeriod.md#ceilmillennium) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance millennium with given precision. |
| $this | [CarbonPeriod::ceilMillennia](../Carbon/CarbonPeriod.md#ceilmillennia) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance millennium with given precision. |
| $this | [CarbonPeriod::roundCentury](../Carbon/CarbonPeriod.md#roundcentury) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance century with given precision using the given function. |
| $this | [CarbonPeriod::roundCenturies](../Carbon/CarbonPeriod.md#roundcenturies) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance century with given precision using the given function. |
| $this | [CarbonPeriod::floorCentury](../Carbon/CarbonPeriod.md#floorcentury) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance century with given precision. |
| $this | [CarbonPeriod::floorCenturies](../Carbon/CarbonPeriod.md#floorcenturies) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance century with given precision. |
| $this | [CarbonPeriod::ceilCentury](../Carbon/CarbonPeriod.md#ceilcentury) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance century with given precision. |
| $this | [CarbonPeriod::ceilCenturies](../Carbon/CarbonPeriod.md#ceilcenturies) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance century with given precision. |
| $this | [CarbonPeriod::roundDecade](../Carbon/CarbonPeriod.md#rounddecade) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [CarbonPeriod::roundDecades](../Carbon/CarbonPeriod.md#rounddecades) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [CarbonPeriod::floorDecade](../Carbon/CarbonPeriod.md#floordecade) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance decade with given precision. |
| $this | [CarbonPeriod::floorDecades](../Carbon/CarbonPeriod.md#floordecades) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance decade with given precision. |
| $this | [CarbonPeriod::ceilDecade](../Carbon/CarbonPeriod.md#ceildecade) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance decade with given precision. |
| $this | [CarbonPeriod::ceilDecades](../Carbon/CarbonPeriod.md#ceildecades) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance decade with given precision. |
| $this | [CarbonPeriod::roundQuarter](../Carbon/CarbonPeriod.md#roundquarter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [CarbonPeriod::roundQuarters](../Carbon/CarbonPeriod.md#roundquarters) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [CarbonPeriod::floorQuarter](../Carbon/CarbonPeriod.md#floorquarter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance quarter with given precision. |
| $this | [CarbonPeriod::floorQuarters](../Carbon/CarbonPeriod.md#floorquarters) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance quarter with given precision. |
| $this | [CarbonPeriod::ceilQuarter](../Carbon/CarbonPeriod.md#ceilquarter) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance quarter with given precision. |
| $this | [CarbonPeriod::ceilQuarters](../Carbon/CarbonPeriod.md#ceilquarters) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance quarter with given precision. |
| $this | [CarbonPeriod::roundMillisecond](../Carbon/CarbonPeriod.md#roundmillisecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [CarbonPeriod::roundMilliseconds](../Carbon/CarbonPeriod.md#roundmilliseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [CarbonPeriod::floorMillisecond](../Carbon/CarbonPeriod.md#floormillisecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [CarbonPeriod::floorMilliseconds](../Carbon/CarbonPeriod.md#floormilliseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [CarbonPeriod::ceilMillisecond](../Carbon/CarbonPeriod.md#ceilmillisecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [CarbonPeriod::ceilMilliseconds](../Carbon/CarbonPeriod.md#ceilmilliseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [CarbonPeriod::roundMicrosecond](../Carbon/CarbonPeriod.md#roundmicrosecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [CarbonPeriod::roundMicroseconds](../Carbon/CarbonPeriod.md#roundmicroseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [CarbonPeriod::floorMicrosecond](../Carbon/CarbonPeriod.md#floormicrosecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [CarbonPeriod::floorMicroseconds](../Carbon/CarbonPeriod.md#floormicroseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [CarbonPeriod::ceilMicrosecond](../Carbon/CarbonPeriod.md#ceilmicrosecond) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance microsecond with given precision. |
| $this | [CarbonPeriod::ceilMicroseconds](../Carbon/CarbonPeriod.md#ceilmicroseconds) _(from [CarbonPeriod](../Carbon/CarbonPeriod.md))_ | Ceil the current instance microsecond with given precision. |
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
| DatePeriod | [onlyHolidays()](#onlyholidays) | 期間内の日本の祝日・休日（振替休日・国民の休日を含む）のみを
抽出するフィルタを追加します。 |
| DatePeriod | [withoutHolidays()](#withoutholidays) | 期間内の日本の祝日・休日（振替休日・国民の休日を含む）を除外する
フィルタを追加します。 |
| DatePeriod | [withoutWeekends()](#withoutweekends) | 期間内の土曜・日曜を除外するフィルタを追加します。 |
| DatePeriod | [onlyWeekdays()](#onlyweekdays) | 期間内の土曜・日曜・祝日・休日をすべて除外し、
純粋な平日（月〜金かつ非祝日）のみを抽出するフィルタを追加します。 |
| DatePeriod | [onlyGotobi()](#onlygotobi) | 期間内の五十日（ごとおび）かつ銀行営業日の日付のみを抽出するフィルタを追加します。 |
| DatePeriod | [onlySixWeekday()](#onlysixweekday) | 期間内の指定した六曜の日のみを抽出するフィルタを追加します。 |
| DatePeriod | [withoutSixWeekday()](#withoutsixweekday) | 期間内の指定した六曜の日を除外するフィルタを追加します。 |
| DatePeriod | [onlyDoyo()](#onlydoyo) | 期間内の土用（各季節の前の約18日間）に含まれる日付のみを抽出するフィルタを追加します。 |
| DatePeriod | [onlyHigan()](#onlyhigan) | 期間内の彼岸（春分・秋分を中日とした各7日間）に含まれる日付のみを抽出するフィルタを追加します。 |
| DatePeriod | [eachSolarTerm()](#eachsolarterm) | 開始日から終了日までを二十四節気の切り替わりをステップとする
{DatePeriod} を生成して返します。 |
| DatePeriod | [eachLunarMonth()](#eachlunarmonth) | 開始日から指定した月数分の旧暦月（朔日〜晦日）を 1 ステップとする
{DatePeriod} を生成して返します。 |
| array | [splitByEra()](#splitbyera) | 期間（DatePeriod）を元号の切り替わりタイミングで複数のサブ期間に分割します。 |
| DatePeriod | [eachJapaneseFiscalYear()](#eachjapanesefiscalyear) | 和暦年度（4月1日〜翌3月31日）を 1 ステップとする {DatePeriod} を生成します。 |
| DatePeriod | [onlyBusinessDays()](#onlybusinessdays) | 期間内の営業日のみを含む新しい DatePeriod を返します。 |
| DatePeriod | [withoutBusinessDays()](#withoutbusinessdays) | 期間内から営業日を除いた（休業日のみの）新しい DatePeriod を返します。 |

---

## Method Details

### onlyHolidays

```php
public DatePeriod onlyHolidays()
```

期間内の日本の祝日・休日（振替休日・国民の休日を含む）のみを
抽出するフィルタを追加します。

{[\JapaneseDate\DateTime::is_holiday}](../JapaneseDate/DateTime.html) が true の日だけをイテレートできるようになります。

【使用例】
```php
$holidays = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->onlyHolidays();

foreach ($holidays as $date) {
    echo $date->format('Y-m-d') . ' ' . $date->holidayText . PHP_EOL;
}
```

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 祝日のみを抽出するフィルタを追加した {\JapaneseDate\DatePeriod}
---

### withoutHolidays

```php
public DatePeriod withoutHolidays()
```

期間内の日本の祝日・休日（振替休日・国民の休日を含む）を除外する
フィルタを追加します。

祝日でない日のみをイテレートできるようになります。
土日を一緒に除外したい場合は {\JapaneseDate\withoutWeekends()} または
{\JapaneseDate\onlyWeekdays()} と組み合わせてください。

【使用例】
```php
// 祝日を除外した全日をイテレートする
$period = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
    ->withoutHolidays();
```

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 祝日を除外するフィルタを追加した {\JapaneseDate\DatePeriod}
---

### withoutWeekends

```php
public DatePeriod withoutWeekends()
```

期間内の土曜・日曜を除外するフィルタを追加します。

祝日は除外しません。祝日も除外したい場合は {\JapaneseDate\onlyWeekdays()} を使用してください。

【使用例】
```php
$weekdayPeriod = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
    ->withoutWeekends();
```

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 土日を除外するフィルタを追加した {\JapaneseDate\DatePeriod}
---

### onlyWeekdays

```php
public DatePeriod onlyWeekdays()
```

期間内の土曜・日曜・祝日・休日をすべて除外し、
純粋な平日（月〜金かつ非祝日）のみを抽出するフィルタを追加します。

「営業日候補」として使用する場合に便利です。

【使用例】
```php
$businessDays = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
    ->onlyWeekdays();

echo count(iterator_to_array($businessDays)) . '営業日';
```

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 土日・祝日を除外するフィルタを追加した {\JapaneseDate\DatePeriod}
---

### onlyGotobi

```php
public DatePeriod onlyGotobi($adjust = &#039;none&#039;)
```

期間内の五十日（ごとおび）かつ銀行営業日の日付のみを抽出するフィルタを追加します。

「五十日」とは日本の商習慣における決済日で、月の 5・10・15・20・25 日と月末日を指します。
土日祝に当たる場合の調整方法を $adjust パラメータで指定できます。

- `'none'`  : 調整なし（土日祝の五十日はそのまま除外）
- `'prev'`  : 前倒し（土日祝の場合は直前の営業日に移動）
- `'next'`  : 後倒し（土日祝の場合は翌営業日に移動）

【使用例】
```php
// 2026年の五十日（調整なし）を取得する
$gotobiDates = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->onlyGotobi('none');

// 土日祝の場合は前日に前倒しして取得する
$gotobiDates = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->onlyGotobi('prev');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$adjust` | `&#039;none&#039;` | 土日祝の調整方法（'none', 'prev', 'next'） |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 五十日フィルタを追加した {\JapaneseDate\DatePeriod}
---

### onlySixWeekday

```php
public DatePeriod onlySixWeekday(...$sixWeekdays)
```

期間内の指定した六曜の日のみを抽出するフィルタを追加します。

複数の六曜を指定することで、いずれかに該当する日をすべて抽出できます。

【使用例】
```php
// 大安のみを取得する（ブライダル、地鎮祭などのスケジュール調整に）
$taian = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN);

// 大安・友引のみを取得する
$lucky = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->onlySixWeekday(DateTime::SIX_WEEKDAY_TAIAN, DateTime::SIX_WEEKDAY_TOMOBIKI);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | ...`$sixWeekdays` | —  | 抽出する六曜定数（{[\JapaneseDate\DateTime::SIX_WEEKDAY_TAIAN}](../JapaneseDate/DateTime.html) など） |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 六曜フィルタを追加した {\JapaneseDate\DatePeriod}
---

### withoutSixWeekday

```php
public DatePeriod withoutSixWeekday(...$sixWeekdays)
```

期間内の指定した六曜の日を除外するフィルタを追加します。

複数の六曜を指定することで、いずれかに該当する日をすべて除外できます。

【使用例】
```php
// 仏滅を除外する
$period = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->withoutSixWeekday(DateTime::SIX_WEEKDAY_BUTSUMETSU);

// 仏滅・赤口を除外する
$period = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->withoutSixWeekday(DateTime::SIX_WEEKDAY_BUTSUMETSU, DateTime::SIX_WEEKDAY_SYAKKOU);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | ...`$sixWeekdays` | —  | 除外する六曜定数（{[\JapaneseDate\DateTime::SIX_WEEKDAY_BUTSUMETSU}](../JapaneseDate/DateTime.html) など） |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 六曜除外フィルタを追加した {\JapaneseDate\DatePeriod}
---

### onlyDoyo

```php
public DatePeriod onlyDoyo()
```

期間内の土用（各季節の前の約18日間）に含まれる日付のみを抽出するフィルタを追加します。

「土用」とは立春・立夏・立秋・立冬のそれぞれ18日前から節気当日の前日までの期間です。
1年間に4回の土用があります。

「土用の丑の日」や「土用干し」などの伝統的な期間の判定に使用します。

【使用例】
```php
// 2026年の土用期間の日付を取得する
$doyoDays = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->onlyDoyo();

foreach ($doyoDays as $date) {
    echo $date->format('Y-m-d') . PHP_EOL;
}
```

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 土用フィルタを追加した {\JapaneseDate\DatePeriod}
---

### onlyHigan

```php
public DatePeriod onlyHigan()
```

期間内の彼岸（春分・秋分を中日とした各7日間）に含まれる日付のみを抽出するフィルタを追加します。

「彼岸」は春分の日（春彼岸）と秋分の日（秋彼岸）をそれぞれ中日として、
前後3日間を含む計7日間の期間です。

【使用例】
```php
// 2026年の彼岸期間の日付を取得する
$higanDays = DatePeriod::create('2026-01-01', '1 day', '2026-12-31')
    ->onlyHigan();
```

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 彼岸フィルタを追加した {\JapaneseDate\DatePeriod}
---

### eachSolarTerm

```php
static public DatePeriod eachSolarTerm($start, $end)
```

開始日から終了日までを二十四節気の切り替わりをステップとする
{DatePeriod} を生成して返します。

各ステップは固定の日数ではなく、天文学的計算に基づく正確な節気の切り替わり日
（14日〜16日の可変幅）となります。

開始日が節気日でない場合は、直後の最初の節気日から順次イテレートします。

【使用例】
```php
// 2026年の節気区切りでイテレートする（立春→雨水→啓蟄…）
$period = DatePeriod::eachSolarTerm(
    DateTime::parse('2026-01-01'),
    DateTime::parse('2026-12-31')
);

foreach ($period as $date) {
    echo $date->format('Y-m-d') . ' ' . $date->solarTermText . PHP_EOL;
}
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$start` | —  | イテレート開始の基準日 |
| [DateTime](../JapaneseDate/DateTime.md) | `$end` | —  | イテレート終了日（この日を含む） |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 節気区切りの {\JapaneseDate\DatePeriod}
**Throws:**

- [SolarTermException](../JapaneseDate/Exceptions/SolarTermException.md)
- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### eachLunarMonth

```php
static public DatePeriod eachLunarMonth($start, $months)
```

開始日から指定した月数分の旧暦月（朔日〜晦日）を 1 ステップとする
{DatePeriod} を生成して返します。

各ステップは旧暦の朔日（新月）の日付です。
旧正月・旧お盆・十五夜などの伝統行事の期間走査に使用します。

【使用例】
```php
// 2026年1月から6ヶ月分の旧暦月の朔日を取得する
$period = DatePeriod::eachLunarMonth(DateTime::parse('2026-01-01'), 6);

foreach ($period as $date) {
    $jd = DateTime::factory($date);
    echo $date->format('Y-m-d') . ' 旧暦' . $jd->lunarYear . '年'
         . $jd->lunarMonth . '月朔日' . PHP_EOL;
}
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$start` | —  | イテレート開始日（この日を含む旧暦月の朔日から開始） |
| int | `$months` | —  | イテレートする旧暦月数 |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 旧暦月朔日区切りの {\JapaneseDate\DatePeriod}
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### splitByEra

```php
public array splitByEra()
```

期間（DatePeriod）を元号の切り替わりタイミングで複数のサブ期間に分割します。

例えば 1988年〜1990年の期間を渡した場合、
「昭和63年1月1日〜昭和64年1月7日」と「平成元年1月8日〜平成2年12月31日」の
2つの DatePeriod の配列を返します。

各 DatePeriod のキーは元号定数（{[\JapaneseDate\DateTime::ERA_MEIJI}](../JapaneseDate/DateTime.html) など）です。

【使用例】
```php
$fullPeriod = DatePeriod::create('1988-01-01', '1 day', '1990-12-31');
$split = $fullPeriod->splitByEra();

foreach ($split as $eraKey => $subPeriod) {
    $eraName = DateTime::parse($subPeriod->getStartDate()->format('Y-m-d'))->eraNameText;
    echo $eraName . ': ';
    echo $subPeriod->getStartDate()->format('Y-m-d') . ' 〜 ';
    echo $subPeriod->getEndDate()->format('Y-m-d') . PHP_EOL;
}
```

**Returns:** array — 元号定数をキーとした {\JapaneseDate\DatePeriod} の配列
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### eachJapaneseFiscalYear

```php
static public DatePeriod eachJapaneseFiscalYear($startFiscalYear, $endFiscalYear)
```

和暦年度（4月1日〜翌3月31日）を 1 ステップとする {DatePeriod} を生成します。

日本の官公庁・企業で使用される「令和X年度」「平成Y年度」などの
和暦年度を基準にした年度の開始日（4月1日）を順次返します。

【使用例】
```php
// 令和5年度〜令和8年度（2023〜2026年度）の年度開始日を取得する
$period = DatePeriod::eachJapaneseFiscalYear(2023, 2026);

foreach ($period as $date) {
    $jd = DateTime::factory($date);
    echo $jd->eraNameText . $jd->eraYear . '年度 ('
        . $date->format('Y/m/d') . '〜' . ($date->year + 1) . '/03/31)' . PHP_EOL;
}
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$startFiscalYear` | —  | 開始年度の西暦年（その年の4月1日〜翌3月31日） |
| int | `$endFiscalYear` | —  | 終了年度の西暦年（この年度を含む） |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 和暦年度開始日区切りの {\JapaneseDate\DatePeriod}
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### onlyBusinessDays

```php
public DatePeriod onlyBusinessDays($config = null)
```

期間内の営業日のみを含む新しい DatePeriod を返します。

営業日の判定にはインスタンス個別設定（またはグローバル/デフォルト設定）を使用します。
メソッドチェーンで他のフィルタと組み合わせることができます。

**使用例:**
```php
$period = DatePeriod::create('2026-04-01', '1 day', '2026-04-30')
    ->onlyBusinessDays();
foreach ($period as $date) {
    echo $date->format('Y-m-d') . PHP_EOL;
}
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateBusiness](../JapaneseDate/DateBusiness.md)\|null | `$config` | `null` | 判定に使用する設定（省略時はインスタンス/グローバル設定） |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 営業日のみに絞り込まれた新しい DatePeriod インスタンス
---

### withoutBusinessDays

```php
public DatePeriod withoutBusinessDays($config = null)
```

期間内から営業日を除いた（休業日のみの）新しい DatePeriod を返します。

メソッドチェーンで他のフィルタと組み合わせることができます。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateBusiness](../JapaneseDate/DateBusiness.md)\|null | `$config` | `null` | 判定に使用する設定（省略時はインスタンス/グローバル設定） |

**Returns:** [DatePeriod](../JapaneseDate/DatePeriod.md) — 休業日のみに絞り込まれた新しい DatePeriod インスタンス
---

