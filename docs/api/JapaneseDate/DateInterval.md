# DateInterval

**Namespace:** `JapaneseDate`

class **DateInterval** extends [CarbonInterval](../Carbon/CarbonInterval.md)

日本暦に対応した期間（インターバル）クラス。

CarbonInterval を継承し、以下の日本固有の機能を追加しています。

**営業日計算**
- 国民の祝日・休日を正確にスキップした N 営業日後／前の日時算出
- 次の祝日までの残り期間の取得

**六曜**
- 指定した六曜（大安・仏滅など）までの残り期間の取得

**元号（和暦）**
- 指定した元号が継続した期間（何年何ヶ月何日）の算出

**二十四節気**
- 次の節気（または指定節気）までの残り期間の取得
- 節気単位での日時加算・減算
- 保持する日数幅を節気数に換算

**旧暦・月相**
- 朔望月（新月から次の新月）を基準とした旧暦月数への換算

【使用例】
```php
use JapaneseDate\DateInterval;
use JapaneseDate\DateTime;

// 2026-05-01 から 5 営業日後を取得する
$from = DateTime::parse('2026-05-01');
$result = DateInterval::addBusinessDaysToDate($from, 5);
echo $result->format('Y-m-d');

// 次の祝日まで何日あるかを取得する
$interval = DateInterval::untilNextHoliday(DateTime::now());
echo $interval->days;

// 次の大安までの残り期間を取得する
$interval = DateInterval::untilNextSixWeek(DateTime::now(), DateTime::SIX_WEEKDAY_TAIAN);

// 令和の継続期間を取得する
$interval = DateInterval::eraSpan(DateTime::ERA_REIWA);
echo $interval->y . '年';

// 次の春分までの残り期間を取得する
$interval = DateInterval::untilNextSolarTerm(DateTime::now());
```

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
| public | `SYNODIC_MONTH_DAYS` | 朔望月の平均日数（新月から次の新月までの平均日数）。 |
| public | `SOLAR_TERM_AVG_DAYS` | 二十四節気1周期の平均日数（太陽黄経15度分）。 |
| protected | `ERA_START_DATES` | 元号の開始日（西暦）。 |
| protected | `ERA_END_DATES` | 元号の終了日（次の元号の前日）。 |
| protected | `SOLAR_TERM_METHODS` | 二十四節気のメソッド名と定数のマッピング。 |
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
| public | int | `$years` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Year component of the current interval. (For P2Y6M, the value will be 2) |
| public | int | `$months` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Month component of the current interval. (For P1Y6M10D, the value will be 6) |
| public | int | `$weeks` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Week component of the current interval calculated from the days. (For P1Y6M17D, the value will be 2) |
| public | int | `$dayz` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Day component of the current interval (weeks * 7 + days). (For P6M17DT20H, the value will be 17) |
| public | int | `$hours` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Hour component of the current interval. (For P7DT20H5M, the value will be 20) |
| public | int | `$minutes` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Minute component of the current interval. (For PT20H5M30S, the value will be 5) |
| public | int | `$seconds` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Second component of the current interval. (CarbonInterval::minutes(2)->seconds(34)->microseconds(567_890)->seconds = 34) |
| public | int | `$milliseconds` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Milliseconds component of the current interval. (CarbonInterval::seconds(34)->microseconds(567_890)->milliseconds = 567) |
| public | int | `$microseconds` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Microseconds component of the current interval. (CarbonInterval::seconds(34)->microseconds(567_890)->microseconds = 567_890) |
| public | int | `$microExcludeMilli` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Remaining microseconds without the milliseconds. |
| public | int | `$dayzExcludeWeeks` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Total days remaining in the final week of the current instance (days % 7). |
| public | int | `$daysExcludeWeeks` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | alias of dayzExcludeWeeks |
| public _(read-only)_ | float | `$totalYears` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of years equivalent to the interval. (For P1Y6M, the value will be 1.5) |
| public _(read-only)_ | float | `$totalMonths` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of months equivalent to the interval. (For P1Y6M10D, the value will be ~12.357) |
| public _(read-only)_ | float | `$totalWeeks` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of weeks equivalent to the interval. (For P6M17DT20H, the value will be ~26.548) |
| public _(read-only)_ | float | `$totalDays` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of days equivalent to the interval. (For P17DT20H, the value will be ~17.833) |
| public _(read-only)_ | float | `$totalDayz` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Alias for totalDays. |
| public _(read-only)_ | float | `$totalHours` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of hours equivalent to the interval. (For P1DT20H5M, the value will be ~44.083) |
| public _(read-only)_ | float | `$totalMinutes` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of minutes equivalent to the interval. (For PT20H5M30S, the value will be 1205.5) |
| public _(read-only)_ | float | `$totalSeconds` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of seconds equivalent to the interval. (CarbonInterval::minutes(2)->seconds(34)->microseconds(567_890)->totalSeconds = 154.567_890) |
| public _(read-only)_ | float | `$totalMilliseconds` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of milliseconds equivalent to the interval. (CarbonInterval::seconds(34)->microseconds(567_890)->totalMilliseconds = 34567.890) |
| public _(read-only)_ | float | `$totalMicroseconds` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Number of microseconds equivalent to the interval. (CarbonInterval::seconds(34)->microseconds(567_890)->totalMicroseconds = 34567890) |
| public _(read-only)_ | string | `$locale` _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | locale of the current instance |

## Methods

| Return | Method | Description |
|---|---|---|
| DateBusinessCommon | [setBusinessConfig()](#setbusinessconfig) | インスタンスに個別の営業日設定を適用します。 |
| DateBusiness\|null | [getBusinessConfig()](#getbusinessconfig) | インスタンスが保持している個別の営業日設定を取得します。 |
| DateBusinessCommon | [setClosingDay()](#setclosingday) | 特定の日付を休業日として指定します。 |
| DateBusinessCommon | [setOpenDay()](#setopenday) | 特定の日付を営業日として指定します。 |
| DateBusinessCommon | [setClosingWeekdays()](#setclosingweekdays) | 休業曜日を一括設定します。 |
| DateBusinessCommon | [setBypassHoliday()](#setbypassholiday) | 祝日を休業日として扱うかどうかを設定します。 |
| DateBusinessCommon | [setOpenNthWeekday()](#setopennthweekday) | 第XX曜日を営業日として指定します。 |
| DateBusinessCommon | [setClosingNthWeekday()](#setclosingnthweekday) | 第XX曜日を休業日として指定します。 |
| DateBusinessCommon | [addOpenFilter()](#addopenfilter) | 営業指定フィルタを追加します。 |
| DateBusinessCommon | [addClosingFilter()](#addclosingfilter) | 休業指定フィルタを追加します。 |
| DateBusinessCommon | [setBusinessMacro()](#setbusinessmacro) | 判定ロジックを完全に上書きするマクロを設定します。 |
| bool | [checkIsBusinessDay()](#checkisbusinessday) | 指定した日付（または自身が保持する日付）が営業日かどうかを判定します。 |
| string\|null | [checkGetBusinessDayLabel()](#checkgetbusinessdaylabel) | 指定した日付（または自身が保持する日付）の休業ラベルを取得します。 |
| DateTime | [addBusinessDaysToDate()](#addbusinessdaystodate) | 基準日から N 営業日後の {DateTime} オブジェクトを返します。 |
| DateTime | [subBusinessDaysToDate()](#subbusinessdaystodate) | 基準日から N 営業日前の {DateTime} オブジェクトを返します。 |
| bool | [isBusinessDay()](#isbusinessday) | 指定した日時が営業日かどうかを判定します。 |
| DateInterval | [untilNextHoliday()](#untilnextholiday) | 基準日時から次の日本の祝日・休日（振替休日・国民の休日を含む）までの 残り期間を {DateInterval} として返します。 |
| DateInterval | [untilNextSixWeek()](#untilnextsixweek) | 基準日時から指定した六曜が次に到来するまでの残り期間を {DateInterval} として返します。 |
| DateInterval | [eraSpan()](#eraspan) | 指定した元号が継続した期間（開始日から終了日まで）を {DateInterval} として返します。 |
| DateInterval | [untilNextSolarTerm()](#untilnextsolarterm) | 基準日時から次に到来する二十四節気（または指定した節気）までの 残り期間を {DateInterval} として返します。 |
| DateTime | [addSolarTermsToDate()](#addsolartermstodate) | 基準日から N 節気後の {DateTime} を返します。 |
| DateTime | [subSolarTermsToDate()](#subsolartermstodate) | 基準日から N 節気前の {DateTime} を返します。 |
| float | [toSolarTermCount()](#tosolartermcount) | このインターバルの総日数を二十四節気の周期数（約15日を1単位）に換算して返します。 |
| float | [toLunarMonthCount()](#tolunarmonthcount) | このインターバルの総日数を朔望月（新月から次の新月まで、約29.5日）の 数に換算して返します。 |
| DateInterval | [untilNextNewMoon()](#untilnextnewmoon) | 基準日時から次の新月（月相: MOON_PHASE_SHINGETSU）までの 残り期間を {DateInterval} として返します。 |
| DateTime | [addBusinessDaysTo()](#addbusinessdaysto) | 基準日から指定した営業日数後の日付を算出します。 |
| DateTime | [subBusinessDaysFrom()](#subbusinessdaysfrom) | 基準日から指定した営業日数前の日付を算出します。 |
| int | [countBusinessDaysBetween()](#countbusinessdaysbetween) | 2つの日付間の営業日数を計算します。 |
| CarbonInterval | [CarbonInterval::setTimezone](../Carbon/CarbonInterval.md#settimezone) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Set the instance&#039;s timezone from a string or object. |
| CarbonInterval | [CarbonInterval::shiftTimezone](../Carbon/CarbonInterval.md#shifttimezone) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Set the instance&#039;s timezone from a string or object and add/subtract the offset difference. |
| array | [CarbonInterval::getCascadeFactors](../Carbon/CarbonInterval.md#getcascadefactors) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Mapping of units and factors for cascading. |
|  | [CarbonInterval::setCascadeFactors](../Carbon/CarbonInterval.md#setcascadefactors) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Set default cascading factors for -&gt;cascade() method. |
| void | [CarbonInterval::enableFloatSetters](../Carbon/CarbonInterval.md#enablefloatsetters) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | This option allow you to opt-in for the Carbon 3 behavior where float values will no longer be cast to integer (so truncated). |
| int\|float\|null | [CarbonInterval::getFactor](../Carbon/CarbonInterval.md#getfactor) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns the factor for a given source-to-target couple. |
| int\|float\|null | [CarbonInterval::getFactorWithDefault](../Carbon/CarbonInterval.md#getfactorwithdefault) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns the factor for a given source-to-target couple if set, else try to find the appropriate constant as the factor, such as Carbon::DAYS_PER_WEEK. |
| int\|float | [CarbonInterval::getDaysPerWeek](../Carbon/CarbonInterval.md#getdaysperweek) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns current config for days per week. |
| int\|float | [CarbonInterval::getHoursPerDay](../Carbon/CarbonInterval.md#gethoursperday) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns current config for hours per day. |
| int\|float | [CarbonInterval::getMinutesPerHour](../Carbon/CarbonInterval.md#getminutesperhour) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns current config for minutes per hour. |
| int\|float | [CarbonInterval::getSecondsPerMinute](../Carbon/CarbonInterval.md#getsecondsperminute) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns current config for seconds per minute. |
| int\|float | [CarbonInterval::getMillisecondsPerSecond](../Carbon/CarbonInterval.md#getmillisecondspersecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns current config for microseconds per second. |
| int\|float | [CarbonInterval::getMicrosecondsPerMillisecond](../Carbon/CarbonInterval.md#getmicrosecondspermillisecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns current config for microseconds per second. |
| CarbonInterval | [CarbonInterval::create](../Carbon/CarbonInterval.md#create) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create a new CarbonInterval instance from specific values. |
| CarbonInterval | [CarbonInterval::createFromFormat](../Carbon/CarbonInterval.md#createfromformat) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Parse a string into a new CarbonInterval object according to the specified format. |
| array\|int\|string\|DateInterval\|mixed\|null | [CarbonInterval::original](../Carbon/CarbonInterval.md#original) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Return the original source used to create the current interval. |
| CarbonInterface\|null | [CarbonInterval::start](../Carbon/CarbonInterval.md#start) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Return the start date if interval was created from a difference between 2 dates. |
| CarbonInterface\|null | [CarbonInterval::end](../Carbon/CarbonInterval.md#end) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Return the end date if interval was created from a difference between 2 dates. |
| CarbonInterval | [CarbonInterval::optimize](../Carbon/CarbonInterval.md#optimize) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get rid of the original input, start date and end date that may be kept in memory. |
| CarbonInterval | [CarbonInterval::copy](../Carbon/CarbonInterval.md#copy) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get a copy of the instance. |
| CarbonInterval | [CarbonInterval::clone](../Carbon/CarbonInterval.md#clone) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get a copy of the instance. |
| CarbonInterval | [CarbonInterval::fromString](../Carbon/CarbonInterval.md#fromstring) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Creates a CarbonInterval from string. |
| CarbonInterval | [CarbonInterval::parseFromLocale](../Carbon/CarbonInterval.md#parsefromlocale) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Creates a CarbonInterval from string using a different locale. |
| CarbonInterval | [CarbonInterval::diff](../Carbon/CarbonInterval.md#diff) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create an interval from the difference between 2 dates. |
| CarbonInterval | [CarbonInterval::abs](../Carbon/CarbonInterval.md#abs) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Invert the interval if it&#039;s inverted. |
| CarbonInterval | [CarbonInterval::absolute](../Carbon/CarbonInterval.md#absolute) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| mixed | [CarbonInterval::cast](../Carbon/CarbonInterval.md#cast) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Cast the current instance into the given class. |
| CarbonInterval | [CarbonInterval::instance](../Carbon/CarbonInterval.md#instance) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create a CarbonInterval instance from a DateInterval one.  Can not instance DateInterval objects created from DateTime::diff() as you can&#039;t externally set the $days field. |
| CarbonInterval\|null | [CarbonInterval::make](../Carbon/CarbonInterval.md#make) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Make a CarbonInterval instance from given variable if possible. |
| CarbonInterval | [CarbonInterval::createFromDateString](../Carbon/CarbonInterval.md#createfromdatestring) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Sets up a DateInterval from the relative parts of the string. |
| int\|float\|string\|null | [CarbonInterval::get](../Carbon/CarbonInterval.md#get) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get a part of the CarbonInterval object. |
| CarbonInterval | [CarbonInterval::set](../Carbon/CarbonInterval.md#set) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Set a part of the CarbonInterval object. |
| CarbonInterval | [CarbonInterval::weeksAndDays](../Carbon/CarbonInterval.md#weeksanddays) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Allow setting of weeks and days to be cumulative. |
| bool | [CarbonInterval::isEmpty](../Carbon/CarbonInterval.md#isempty) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns true if the interval is empty for each unit. |
| void | [CarbonInterval::macro](../Carbon/CarbonInterval.md#macro) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Register a custom macro. |
| void | [CarbonInterval::mixin](../Carbon/CarbonInterval.md#mixin) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Register macros from a mixin object. |
| bool | [CarbonInterval::hasMacro](../Carbon/CarbonInterval.md#hasmacro) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Check if macro is registered. |
| array | [CarbonInterval::toArray](../Carbon/CarbonInterval.md#toarray) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns interval values as an array where key are the unit names and values the counts. |
| array | [CarbonInterval::getNonZeroValues](../Carbon/CarbonInterval.md#getnonzerovalues) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns interval non-zero values as an array where key are the unit names and values the counts. |
| array | [CarbonInterval::getValuesSequence](../Carbon/CarbonInterval.md#getvaluessequence) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Returns interval values as an array where key are the unit names and values the counts from the biggest non-zero one the the smallest non-zero one. |
| string | [CarbonInterval::forHumans](../Carbon/CarbonInterval.md#forhumans) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get the current interval in a human readable format in the current locale. |
| string | [CarbonInterval::format](../Carbon/CarbonInterval.md#format) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| DateInterval | [CarbonInterval::toDateInterval](../Carbon/CarbonInterval.md#todateinterval) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Return native DateInterval PHP object matching the current instance. |
| CarbonPeriod | [CarbonInterval::toPeriod](../Carbon/CarbonInterval.md#toperiod) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Convert the interval to a CarbonPeriod. |
| CarbonPeriod | [CarbonInterval::stepBy](../Carbon/CarbonInterval.md#stepby) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Decompose the current interval into |
| CarbonInterval | [CarbonInterval::invert](../Carbon/CarbonInterval.md#invert) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Invert the interval. |
| CarbonInterval | [CarbonInterval::add](../Carbon/CarbonInterval.md#add) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add the passed interval to the current instance. |
| CarbonInterval | [CarbonInterval::sub](../Carbon/CarbonInterval.md#sub) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract the passed interval to the current instance. |
| CarbonInterval | [CarbonInterval::subtract](../Carbon/CarbonInterval.md#subtract) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract the passed interval to the current instance. |
| CarbonInterval | [CarbonInterval::plus](../Carbon/CarbonInterval.md#plus) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given parameters to the current interval. |
| CarbonInterval | [CarbonInterval::minus](../Carbon/CarbonInterval.md#minus) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given parameters to the current interval. |
| CarbonInterval | [CarbonInterval::times](../Carbon/CarbonInterval.md#times) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Multiply current instance given number of times. times() is naive, it multiplies each unit (so day can be greater than 31, hour can be greater than 23, etc.) and the result is rounded separately for each unit. |
| CarbonInterval | [CarbonInterval::shares](../Carbon/CarbonInterval.md#shares) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Divide current instance by a given divider. shares() is naive, it divides each unit separately and the result is rounded for each unit. So 5 hours and 20 minutes shared by 3 becomes 2 hours and 7 minutes. |
| CarbonInterval | [CarbonInterval::multiply](../Carbon/CarbonInterval.md#multiply) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Multiply and cascade current instance by a given factor. |
| CarbonInterval | [CarbonInterval::divide](../Carbon/CarbonInterval.md#divide) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Divide and cascade current instance by a given divider. |
| string | [CarbonInterval::getDateIntervalSpec](../Carbon/CarbonInterval.md#getdateintervalspec) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get the interval_spec string of a date interval. |
| string | [CarbonInterval::spec](../Carbon/CarbonInterval.md#spec) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get the interval_spec string. |
| int | [CarbonInterval::compareDateIntervals](../Carbon/CarbonInterval.md#comparedateintervals) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Comparing 2 date intervals. |
| int | [CarbonInterval::compare](../Carbon/CarbonInterval.md#compare) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Comparing with passed interval. |
| CarbonInterval | [CarbonInterval::cascade](../Carbon/CarbonInterval.md#cascade) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Convert overflowed values into bigger units. |
| bool | [CarbonInterval::hasNegativeValues](../Carbon/CarbonInterval.md#hasnegativevalues) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| bool | [CarbonInterval::hasPositiveValues](../Carbon/CarbonInterval.md#haspositivevalues) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| float | [CarbonInterval::total](../Carbon/CarbonInterval.md#total) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Get amount of given unit equivalent to the interval. |
| bool | [CarbonInterval::eq](../Carbon/CarbonInterval.md#eq) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is equal to another |
| bool | [CarbonInterval::equalTo](../Carbon/CarbonInterval.md#equalto) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is equal to another |
| bool | [CarbonInterval::ne](../Carbon/CarbonInterval.md#ne) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is not equal to another |
| bool | [CarbonInterval::notEqualTo](../Carbon/CarbonInterval.md#notequalto) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is not equal to another |
| bool | [CarbonInterval::gt](../Carbon/CarbonInterval.md#gt) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is greater (longer) than another |
| bool | [CarbonInterval::greaterThan](../Carbon/CarbonInterval.md#greaterthan) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is greater (longer) than another |
| bool | [CarbonInterval::gte](../Carbon/CarbonInterval.md#gte) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is greater (longer) than or equal to another |
| bool | [CarbonInterval::greaterThanOrEqualTo](../Carbon/CarbonInterval.md#greaterthanorequalto) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is greater (longer) than or equal to another |
| bool | [CarbonInterval::lt](../Carbon/CarbonInterval.md#lt) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is less (shorter) than another |
| bool | [CarbonInterval::lessThan](../Carbon/CarbonInterval.md#lessthan) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is less (shorter) than another |
| bool | [CarbonInterval::lte](../Carbon/CarbonInterval.md#lte) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is less (shorter) than or equal to another |
| bool | [CarbonInterval::lessThanOrEqualTo](../Carbon/CarbonInterval.md#lessthanorequalto) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is less (shorter) than or equal to another |
| bool | [CarbonInterval::between](../Carbon/CarbonInterval.md#between) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is between two others. |
| bool | [CarbonInterval::betweenIncluded](../Carbon/CarbonInterval.md#betweenincluded) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is between two others, bounds excluded. |
| bool | [CarbonInterval::betweenExcluded](../Carbon/CarbonInterval.md#betweenexcluded) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is between two others, bounds excluded. |
| bool | [CarbonInterval::isBetween](../Carbon/CarbonInterval.md#isbetween) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Determines if the instance is between two others |
| CarbonInterval | [CarbonInterval::roundUnit](../Carbon/CarbonInterval.md#roundunit) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance at the given unit with given precision if specified and the given function. |
| CarbonInterval | [CarbonInterval::floorUnit](../Carbon/CarbonInterval.md#floorunit) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance at the given unit with given precision if specified. |
| CarbonInterval | [CarbonInterval::ceilUnit](../Carbon/CarbonInterval.md#ceilunit) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance at the given unit with given precision if specified. |
| CarbonInterval | [CarbonInterval::round](../Carbon/CarbonInterval.md#round) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance second with given precision if specified. |
| CarbonInterval | [CarbonInterval::floor](../Carbon/CarbonInterval.md#floor) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance second with given precision if specified. |
| CarbonInterval | [CarbonInterval::ceil](../Carbon/CarbonInterval.md#ceil) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance second with given precision if specified. |
| CarbonInterval | [CarbonInterval::years](../Carbon/CarbonInterval.md#years) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of years or modify the number of years if called on an instance. |
| CarbonInterval | [CarbonInterval::year](../Carbon/CarbonInterval.md#year) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::months](../Carbon/CarbonInterval.md#months) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of months or modify the number of months if called on an instance. |
| CarbonInterval | [CarbonInterval::month](../Carbon/CarbonInterval.md#month) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::weeks](../Carbon/CarbonInterval.md#weeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of weeks or modify the number of weeks if called on an instance. |
| CarbonInterval | [CarbonInterval::week](../Carbon/CarbonInterval.md#week) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::days](../Carbon/CarbonInterval.md#days) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of days or modify the number of days if called on an instance. |
| CarbonInterval | [CarbonInterval::dayz](../Carbon/CarbonInterval.md#dayz) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::daysExcludeWeeks](../Carbon/CarbonInterval.md#daysexcludeweeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | if called on an instance. |
| CarbonInterval | [CarbonInterval::dayzExcludeWeeks](../Carbon/CarbonInterval.md#dayzexcludeweeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::day](../Carbon/CarbonInterval.md#day) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::hours](../Carbon/CarbonInterval.md#hours) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of hours or modify the number of hours if called on an instance. |
| CarbonInterval | [CarbonInterval::hour](../Carbon/CarbonInterval.md#hour) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::minutes](../Carbon/CarbonInterval.md#minutes) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of minutes or modify the number of minutes if called on an instance. |
| CarbonInterval | [CarbonInterval::minute](../Carbon/CarbonInterval.md#minute) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::seconds](../Carbon/CarbonInterval.md#seconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of seconds or modify the number of seconds if called on an instance. |
| CarbonInterval | [CarbonInterval::second](../Carbon/CarbonInterval.md#second) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::milliseconds](../Carbon/CarbonInterval.md#milliseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of milliseconds or modify the number of milliseconds if called on an instance. |
| CarbonInterval | [CarbonInterval::millisecond](../Carbon/CarbonInterval.md#millisecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| CarbonInterval | [CarbonInterval::microseconds](../Carbon/CarbonInterval.md#microseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Create instance specifying a number of microseconds or modify the number of microseconds if called on an instance. |
| CarbonInterval | [CarbonInterval::microsecond](../Carbon/CarbonInterval.md#microsecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ |  |
| $this | [CarbonInterval::addYears](../Carbon/CarbonInterval.md#addyears) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of years to the current interval |
| $this | [CarbonInterval::subYears](../Carbon/CarbonInterval.md#subyears) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of years to the current interval |
| $this | [CarbonInterval::addMonths](../Carbon/CarbonInterval.md#addmonths) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of months to the current interval |
| $this | [CarbonInterval::subMonths](../Carbon/CarbonInterval.md#submonths) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of months to the current interval |
| $this | [CarbonInterval::addWeeks](../Carbon/CarbonInterval.md#addweeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of weeks to the current interval |
| $this | [CarbonInterval::subWeeks](../Carbon/CarbonInterval.md#subweeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of weeks to the current interval |
| $this | [CarbonInterval::addDays](../Carbon/CarbonInterval.md#adddays) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of days to the current interval |
| $this | [CarbonInterval::subDays](../Carbon/CarbonInterval.md#subdays) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of days to the current interval |
| $this | [CarbonInterval::addHours](../Carbon/CarbonInterval.md#addhours) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of hours to the current interval |
| $this | [CarbonInterval::subHours](../Carbon/CarbonInterval.md#subhours) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of hours to the current interval |
| $this | [CarbonInterval::addMinutes](../Carbon/CarbonInterval.md#addminutes) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of minutes to the current interval |
| $this | [CarbonInterval::subMinutes](../Carbon/CarbonInterval.md#subminutes) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of minutes to the current interval |
| $this | [CarbonInterval::addSeconds](../Carbon/CarbonInterval.md#addseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of seconds to the current interval |
| $this | [CarbonInterval::subSeconds](../Carbon/CarbonInterval.md#subseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of seconds to the current interval |
| $this | [CarbonInterval::addMilliseconds](../Carbon/CarbonInterval.md#addmilliseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of milliseconds to the current interval |
| $this | [CarbonInterval::subMilliseconds](../Carbon/CarbonInterval.md#submilliseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of milliseconds to the current interval |
| $this | [CarbonInterval::addMicroseconds](../Carbon/CarbonInterval.md#addmicroseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Add given number of microseconds to the current interval |
| $this | [CarbonInterval::subMicroseconds](../Carbon/CarbonInterval.md#submicroseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Subtract given number of microseconds to the current interval |
| $this | [CarbonInterval::roundYear](../Carbon/CarbonInterval.md#roundyear) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance year with given precision using the given function. |
| $this | [CarbonInterval::roundYears](../Carbon/CarbonInterval.md#roundyears) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance year with given precision using the given function. |
| $this | [CarbonInterval::floorYear](../Carbon/CarbonInterval.md#flooryear) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance year with given precision. |
| $this | [CarbonInterval::floorYears](../Carbon/CarbonInterval.md#flooryears) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance year with given precision. |
| $this | [CarbonInterval::ceilYear](../Carbon/CarbonInterval.md#ceilyear) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance year with given precision. |
| $this | [CarbonInterval::ceilYears](../Carbon/CarbonInterval.md#ceilyears) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance year with given precision. |
| $this | [CarbonInterval::roundMonth](../Carbon/CarbonInterval.md#roundmonth) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance month with given precision using the given function. |
| $this | [CarbonInterval::roundMonths](../Carbon/CarbonInterval.md#roundmonths) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance month with given precision using the given function. |
| $this | [CarbonInterval::floorMonth](../Carbon/CarbonInterval.md#floormonth) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance month with given precision. |
| $this | [CarbonInterval::floorMonths](../Carbon/CarbonInterval.md#floormonths) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance month with given precision. |
| $this | [CarbonInterval::ceilMonth](../Carbon/CarbonInterval.md#ceilmonth) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance month with given precision. |
| $this | [CarbonInterval::ceilMonths](../Carbon/CarbonInterval.md#ceilmonths) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance month with given precision. |
| $this | [CarbonInterval::roundWeek](../Carbon/CarbonInterval.md#roundweek) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonInterval::roundWeeks](../Carbon/CarbonInterval.md#roundweeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonInterval::floorWeek](../Carbon/CarbonInterval.md#floorweek) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonInterval::floorWeeks](../Carbon/CarbonInterval.md#floorweeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonInterval::ceilWeek](../Carbon/CarbonInterval.md#ceilweek) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonInterval::ceilWeeks](../Carbon/CarbonInterval.md#ceilweeks) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonInterval::roundDay](../Carbon/CarbonInterval.md#roundday) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonInterval::roundDays](../Carbon/CarbonInterval.md#rounddays) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance day with given precision using the given function. |
| $this | [CarbonInterval::floorDay](../Carbon/CarbonInterval.md#floorday) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonInterval::floorDays](../Carbon/CarbonInterval.md#floordays) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance day with given precision. |
| $this | [CarbonInterval::ceilDay](../Carbon/CarbonInterval.md#ceilday) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonInterval::ceilDays](../Carbon/CarbonInterval.md#ceildays) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance day with given precision. |
| $this | [CarbonInterval::roundHour](../Carbon/CarbonInterval.md#roundhour) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [CarbonInterval::roundHours](../Carbon/CarbonInterval.md#roundhours) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance hour with given precision using the given function. |
| $this | [CarbonInterval::floorHour](../Carbon/CarbonInterval.md#floorhour) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance hour with given precision. |
| $this | [CarbonInterval::floorHours](../Carbon/CarbonInterval.md#floorhours) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance hour with given precision. |
| $this | [CarbonInterval::ceilHour](../Carbon/CarbonInterval.md#ceilhour) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance hour with given precision. |
| $this | [CarbonInterval::ceilHours](../Carbon/CarbonInterval.md#ceilhours) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance hour with given precision. |
| $this | [CarbonInterval::roundMinute](../Carbon/CarbonInterval.md#roundminute) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [CarbonInterval::roundMinutes](../Carbon/CarbonInterval.md#roundminutes) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance minute with given precision using the given function. |
| $this | [CarbonInterval::floorMinute](../Carbon/CarbonInterval.md#floorminute) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance minute with given precision. |
| $this | [CarbonInterval::floorMinutes](../Carbon/CarbonInterval.md#floorminutes) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance minute with given precision. |
| $this | [CarbonInterval::ceilMinute](../Carbon/CarbonInterval.md#ceilminute) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance minute with given precision. |
| $this | [CarbonInterval::ceilMinutes](../Carbon/CarbonInterval.md#ceilminutes) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance minute with given precision. |
| $this | [CarbonInterval::roundSecond](../Carbon/CarbonInterval.md#roundsecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance second with given precision using the given function. |
| $this | [CarbonInterval::roundSeconds](../Carbon/CarbonInterval.md#roundseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance second with given precision using the given function. |
| $this | [CarbonInterval::floorSecond](../Carbon/CarbonInterval.md#floorsecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance second with given precision. |
| $this | [CarbonInterval::floorSeconds](../Carbon/CarbonInterval.md#floorseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance second with given precision. |
| $this | [CarbonInterval::ceilSecond](../Carbon/CarbonInterval.md#ceilsecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance second with given precision. |
| $this | [CarbonInterval::ceilSeconds](../Carbon/CarbonInterval.md#ceilseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance second with given precision. |
| $this | [CarbonInterval::roundMillennium](../Carbon/CarbonInterval.md#roundmillennium) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [CarbonInterval::roundMillennia](../Carbon/CarbonInterval.md#roundmillennia) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance millennium with given precision using the given function. |
| $this | [CarbonInterval::floorMillennium](../Carbon/CarbonInterval.md#floormillennium) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance millennium with given precision. |
| $this | [CarbonInterval::floorMillennia](../Carbon/CarbonInterval.md#floormillennia) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance millennium with given precision. |
| $this | [CarbonInterval::ceilMillennium](../Carbon/CarbonInterval.md#ceilmillennium) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance millennium with given precision. |
| $this | [CarbonInterval::ceilMillennia](../Carbon/CarbonInterval.md#ceilmillennia) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance millennium with given precision. |
| $this | [CarbonInterval::roundCentury](../Carbon/CarbonInterval.md#roundcentury) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance century with given precision using the given function. |
| $this | [CarbonInterval::roundCenturies](../Carbon/CarbonInterval.md#roundcenturies) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance century with given precision using the given function. |
| $this | [CarbonInterval::floorCentury](../Carbon/CarbonInterval.md#floorcentury) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance century with given precision. |
| $this | [CarbonInterval::floorCenturies](../Carbon/CarbonInterval.md#floorcenturies) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance century with given precision. |
| $this | [CarbonInterval::ceilCentury](../Carbon/CarbonInterval.md#ceilcentury) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance century with given precision. |
| $this | [CarbonInterval::ceilCenturies](../Carbon/CarbonInterval.md#ceilcenturies) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance century with given precision. |
| $this | [CarbonInterval::roundDecade](../Carbon/CarbonInterval.md#rounddecade) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [CarbonInterval::roundDecades](../Carbon/CarbonInterval.md#rounddecades) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance decade with given precision using the given function. |
| $this | [CarbonInterval::floorDecade](../Carbon/CarbonInterval.md#floordecade) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance decade with given precision. |
| $this | [CarbonInterval::floorDecades](../Carbon/CarbonInterval.md#floordecades) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance decade with given precision. |
| $this | [CarbonInterval::ceilDecade](../Carbon/CarbonInterval.md#ceildecade) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance decade with given precision. |
| $this | [CarbonInterval::ceilDecades](../Carbon/CarbonInterval.md#ceildecades) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance decade with given precision. |
| $this | [CarbonInterval::roundQuarter](../Carbon/CarbonInterval.md#roundquarter) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [CarbonInterval::roundQuarters](../Carbon/CarbonInterval.md#roundquarters) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance quarter with given precision using the given function. |
| $this | [CarbonInterval::floorQuarter](../Carbon/CarbonInterval.md#floorquarter) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance quarter with given precision. |
| $this | [CarbonInterval::floorQuarters](../Carbon/CarbonInterval.md#floorquarters) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance quarter with given precision. |
| $this | [CarbonInterval::ceilQuarter](../Carbon/CarbonInterval.md#ceilquarter) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance quarter with given precision. |
| $this | [CarbonInterval::ceilQuarters](../Carbon/CarbonInterval.md#ceilquarters) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance quarter with given precision. |
| $this | [CarbonInterval::roundMillisecond](../Carbon/CarbonInterval.md#roundmillisecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [CarbonInterval::roundMilliseconds](../Carbon/CarbonInterval.md#roundmilliseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance millisecond with given precision using the given function. |
| $this | [CarbonInterval::floorMillisecond](../Carbon/CarbonInterval.md#floormillisecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [CarbonInterval::floorMilliseconds](../Carbon/CarbonInterval.md#floormilliseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance millisecond with given precision. |
| $this | [CarbonInterval::ceilMillisecond](../Carbon/CarbonInterval.md#ceilmillisecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [CarbonInterval::ceilMilliseconds](../Carbon/CarbonInterval.md#ceilmilliseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance millisecond with given precision. |
| $this | [CarbonInterval::roundMicrosecond](../Carbon/CarbonInterval.md#roundmicrosecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [CarbonInterval::roundMicroseconds](../Carbon/CarbonInterval.md#roundmicroseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Round the current instance microsecond with given precision using the given function. |
| $this | [CarbonInterval::floorMicrosecond](../Carbon/CarbonInterval.md#floormicrosecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [CarbonInterval::floorMicroseconds](../Carbon/CarbonInterval.md#floormicroseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Truncate the current instance microsecond with given precision. |
| $this | [CarbonInterval::ceilMicrosecond](../Carbon/CarbonInterval.md#ceilmicrosecond) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance microsecond with given precision. |
| $this | [CarbonInterval::ceilMicroseconds](../Carbon/CarbonInterval.md#ceilmicroseconds) _(from [CarbonInterval](../Carbon/CarbonInterval.md))_ | Ceil the current instance microsecond with given precision. |

---

## Method Details

### setBusinessConfig

```php
public DateBusinessCommon setBusinessConfig($config)
```

インスタンスに個別の営業日設定を適用します。

設定後、このインスタンスのすべての営業日判定にこの設定が使用されます。
`null` を渡すとインスタンス個別設定を解除し、グローバル/デフォルト設定に戻ります。

**使用例:**
```php
$dt->setBusinessConfig(
    (new DateBusiness())->setClosingWeekdays([0, 6])->setBypassHoliday(true)
);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateBusiness](../JapaneseDate/DateBusiness.md)\|null | `$config` | —  | インスタンスに適用する設定オブジェクト、または null（解除） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### getBusinessConfig

```php
public DateBusiness\|null getBusinessConfig()
```

インスタンスが保持している個別の営業日設定を取得します。

個別設定を持っていない場合は `null` を返します。
判定に実際に使用される設定（グローバル/デフォルト含む解決済み設定）は
BusinessCalendar::resolveConfig() で取得できます。

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md)\|null — インスタンス個別設定、または null
---

### setClosingDay

```php
public DateBusinessCommon setClosingDay($date, $label = null)
```

特定の日付を休業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setClosingDay('2026-08-15', '夏期休暇');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 休業日として指定する日付 |
| string\|null | `$label` | `null` | 休業理由のラベル（例: '夏期休暇'） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### setOpenDay

```php
public DateBusinessCommon setOpenDay($date)
```

特定の日付を営業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setOpenDay('2026-12-30'); // 特別営業日
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 営業日として指定する日付 |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### setClosingWeekdays

```php
public DateBusinessCommon setClosingWeekdays($weekdays)
```

休業曜日を一括設定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setClosingWeekdays([0, 6]); // 日・土を休業に
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| array | `$weekdays` | —  | 休業曜日の配列（例: [0, 6] で日・土） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setBypassHoliday

```php
public DateBusinessCommon setBypassHoliday($bypass)
```

祝日を休業日として扱うかどうかを設定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$bypass` | —  | true の場合、祝日を休業日とする |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setOpenNthWeekday

```php
public DateBusinessCommon setOpenNthWeekday($weekday, $nth)
```

第XX曜日を営業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setOpenNthWeekday(6, 2); // 第2土曜日は営業
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setClosingNthWeekday

```php
public DateBusinessCommon setClosingNthWeekday($weekday, $nth, $label = null)
```

第XX曜日を休業日として指定します。

インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setClosingNthWeekday(3, 3, '定休日'); // 第3水曜日は休業
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |
| string\|null | `$label` | `null` | 休業ラベル |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### addOpenFilter

```php
public DateBusinessCommon addOpenFilter($filter)
```

営業指定フィルタを追加します。

フィルタが `true` を返した場合にその日を営業日として扱います。
インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('d') === '10');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$filter` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### addClosingFilter

```php
public DateBusinessCommon addClosingFilter($filter, $label = null)
```

休業指定フィルタを追加します。

フィルタが `true` を返した場合にその日を休業日として扱います。
インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->addClosingFilter(
    fn(\DateTimeInterface $d) => $d->format('md') === '1231',
    '大晦日休業'
);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$filter` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック |
| string\|null | `$label` | `null` | 休業理由のラベル |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### setBusinessMacro

```php
public DateBusinessCommon setBusinessMacro($macro)
```

判定ロジックを完全に上書きするマクロを設定します。

マクロは他のすべての設定より優先されます。
`null` を渡すとマクロを解除します。
インスタンスに個別設定がない場合は自動的に現在の有効設定を複製して設定します。

**使用例:**
```php
$dt->setBusinessMacro(fn(\DateTimeInterface $d) => in_array((int)$d->format('N'), [1,2,3,4]));
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable\|null | `$macro` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック、または null |

**Returns:** DateBusinessCommon — メソッドチェーン用に自身を返します
---

### checkIsBusinessDay

```php
public bool checkIsBusinessDay($date = null)
```

指定した日付（または自身が保持する日付）が営業日かどうかを判定します。

このメソッドはTraitを適用したクラスが `DateTimeInterface` を実装している場合に
自身の日付を使って判定します。`$date` を省略した場合は自身を対象とします。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date` | `null` | 判定する日付（省略時は自身） |

**Returns:** bool — 営業日であれば true
---

### checkGetBusinessDayLabel

```php
public string\|null checkGetBusinessDayLabel($date = null)
```

指定した日付（または自身が保持する日付）の休業ラベルを取得します。

営業日の場合は `null` を返します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date` | `null` | 判定する日付（省略時は自身） |

**Returns:** string\|null — 休業ラベル、または null
---

### addBusinessDaysToDate

```php
static public DateTime addBusinessDaysToDate($from, $n)
```

基準日から N 営業日後の {DateTime} オブジェクトを返します。

「営業日」とは、土曜・日曜・日本の国民の祝日・休日（振替休日・国民の休日を含む）を
除いたすべての日を指します。
計算はループにより 1 日ずつ進め、非営業日をスキップします。

【使用例】
```php
// 2026-05-01 から 3 営業日後を取得する
$from = DateTime::parse('2026-05-01');
$result = DateInterval::addBusinessDaysToDate($from, 3);
echo $result->format('Y-m-d');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | 起算日 |
| int | `$n` | —  | 加算する営業日数（1 以上の整数） |

**Returns:** [DateTime](../JapaneseDate/DateTime.md) — N 営業日後の日付
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### subBusinessDaysToDate

```php
static public DateTime subBusinessDaysToDate($from, $n)
```

基準日から N 営業日前の {DateTime} オブジェクトを返します。

「営業日」とは、土曜・日曜・日本の国民の祝日・休日（振替休日・国民の休日を含む）を
除いたすべての日を指します。
計算はループにより 1 日ずつ遡り、非営業日をスキップします。

【使用例】
```php
// 2026-05-08 から 3 営業日前を取得する
$from = DateTime::parse('2026-05-08');
$result = DateInterval::subBusinessDaysToDate($from, 3);
echo $result->format('Y-m-d');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | 起算日 |
| int | `$n` | —  | 減算する営業日数（1 以上の整数） |

**Returns:** [DateTime](../JapaneseDate/DateTime.md) — N 営業日前の日付
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### isBusinessDay

```php
static public bool isBusinessDay($date)
```

指定した日時が営業日かどうかを判定します。

土曜（dayOfWeek === 6）、日曜（dayOfWeek === 0）、および国民の祝日・休日は
非営業日とみなします。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$date` | —  | 判定対象の日付 |

**Returns:** bool — 営業日であれば true、非営業日であれば false
---

### untilNextHoliday

```php
static public DateInterval untilNextHoliday($from)
```

基準日時から次の日本の祝日・休日（振替休日・国民の休日を含む）までの
残り期間を {DateInterval} として返します。

「次の祝日」とは {[\JapaneseDate\DateTime::nextHoliday()}](../JapaneseDate/DateTime.html) が返す日の翌日 00:00:00 を
基準とした差分です。

【使用例】
```php
$interval = DateInterval::untilNextHoliday(DateTime::now());
echo $interval->days . '日後';
echo $interval->h . '時間後';
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | カウントダウン基準日時 |

**Returns:** [DateInterval](../JapaneseDate/DateInterval.md) — 次の祝日（当日 00:00:00）までの {\JapaneseDate\DateInterval}
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### untilNextSixWeek

```php
static public DateInterval untilNextSixWeek($from, $sixWeekday)
```

基準日時から指定した六曜が次に到来するまでの残り期間を
{DateInterval} として返します。

基準日が既に指定した六曜である場合、次の同じ六曜（6日後）までの期間を返します。

【使用例】
```php
// 次の大安までの残り期間を取得する
$interval = DateInterval::untilNextSixWeek(DateTime::now(), DateTime::SIX_WEEKDAY_TAIAN);
echo $interval->days . '日後が大安です';

// 次の仏滅までの残り期間を取得する
$interval = DateInterval::untilNextSixWeek(DateTime::now(), DateTime::SIX_WEEKDAY_BUTSUMETSU);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | カウントダウン基準日時 |
| int | `$sixWeekday` | —  | 目的の六曜（{[\JapaneseDate\DateTime::SIX_WEEKDAY_TAIAN}](../JapaneseDate/DateTime.html) など） |

**Returns:** [DateInterval](../JapaneseDate/DateInterval.md) — 指定六曜の翌到来日（当日 00:00:00）までの {\JapaneseDate\DateInterval}
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### eraSpan

```php
static public DateInterval eraSpan($eraKey, $until = null)
```

指定した元号が継続した期間（開始日から終了日まで）を {DateInterval} として返します。

終了日が指定されていない元号（令和など現在も継続中の元号）については、
第二引数 $until で基準日時を指定できます。省略した場合は現在日時が使用されます。

【使用例】
```php
// 昭和の継続期間を取得する
$interval = DateInterval::eraSpan(DateTime::ERA_SHOWA);
echo $interval->y . '年' . $interval->m . 'ヶ月' . $interval->d . '日';

// 令和が現在まで継続した期間を取得する
$interval = DateInterval::eraSpan(DateTime::ERA_REIWA);

// 令和が特定日まで継続した期間を取得する
$interval = DateInterval::eraSpan(DateTime::ERA_REIWA, DateTime::parse('2026-01-01'));
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$eraKey` | —  | 元号定数（{[\JapaneseDate\DateTime::ERA_MEIJI}](../JapaneseDate/DateTime.html) など） |
| [DateTime](../JapaneseDate/DateTime.md)\|null | `$until` | `null` | 終了日（null の場合は現在日時） |

**Returns:** [DateInterval](../JapaneseDate/DateInterval.md) — 元号の継続期間を表す {\JapaneseDate\DateInterval}
---

### untilNextSolarTerm

```php
static public DateInterval untilNextSolarTerm($from, $termMethod = null)
```

基準日時から次に到来する二十四節気（または指定した節気）までの
残り期間を {DateInterval} として返します。

節気名を指定しない場合は、24 節気すべてのうち最も近い次の節気を検索します。
節気名を指定する場合は、SimpleSolarTerm / SolarTerm クラスのメソッド名
（'syunbun', 'geshi' など）を渡してください。

【使用例】
```php
// 次に到来する節気までの残り期間を取得する
$interval = DateInterval::untilNextSolarTerm(DateTime::now());
echo $interval->days . '日後が次の節気です';

// 次の夏至までの残り期間を取得する
$interval = DateInterval::untilNextSolarTerm(DateTime::now(), 'geshi');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | カウントダウン基準日時 |
| string\|null | `$termMethod` | `null` | 節気メソッド名（省略時は最も近い節気を自動検索） |

**Returns:** [DateInterval](../JapaneseDate/DateInterval.md) — 次の節気日（当日 00:00:00）までの {\JapaneseDate\DateInterval}
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
- [SolarTermException](../JapaneseDate/Exceptions/SolarTermException.md)
---

### addSolarTermsToDate

```php
static public DateTime addSolarTermsToDate($from, $n)
```

基準日から N 節気後の {DateTime} を返します。

単純な「15日 × N」ではなく、天文学的計算に基づく正確な節気の
切り替わり日を N 個分進めた日付を返します。

【使用例】
```php
// 現在から 3 節気後の日付を取得する
$from = DateTime::now();
$result = DateInterval::addSolarTermsToDate($from, 3);
echo $result->format('Y-m-d');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | 起算日 |
| int | `$n` | —  | 進める節気の数（1 以上の整数） |

**Returns:** [DateTime](../JapaneseDate/DateTime.md) — N 節気後の日付
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
- [SolarTermException](../JapaneseDate/Exceptions/SolarTermException.md)
---

### subSolarTermsToDate

```php
static public DateTime subSolarTermsToDate($from, $n)
```

基準日から N 節気前の {DateTime} を返します。

単純な「15日 × N」ではなく、天文学的計算に基づく正確な節気の
切り替わり日を N 個分遡った日付を返します。

【使用例】
```php
// 現在から 2 節気前の日付を取得する
$from = DateTime::now();
$result = DateInterval::subSolarTermsToDate($from, 2);
echo $result->format('Y-m-d');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | 起算日 |
| int | `$n` | —  | 遡る節気の数（1 以上の整数） |

**Returns:** [DateTime](../JapaneseDate/DateTime.md) — N 節気前の日付
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
- [SolarTermException](../JapaneseDate/Exceptions/SolarTermException.md)
---

### toSolarTermCount

```php
public float toSolarTermCount()
```

このインターバルの総日数を二十四節気の周期数（約15日を1単位）に換算して返します。

「2節気分」のように日本の伝統的な季節の区切り単位でインターバルを
表現したい場合に使用します。結果は小数点以下を含む浮動小数点数です。

【使用例】
```php
$interval = CarbonInterval::days(30);
$solarTermInterval = DateInterval::instance($interval);
echo round($solarTermInterval->toSolarTermCount(), 1) . '節気分';
// => 約 1.97 節気分
```

**Returns:** float — 節気数（{\JapaneseDate\self::SOLAR_TERM_AVG_DAYS} を1単位とした換算値）
---

### toLunarMonthCount

```php
public float toLunarMonthCount()
```

このインターバルの総日数を朔望月（新月から次の新月まで、約29.5日）の
数に換算して返します。

旧暦の「1ヶ月」を正確に定義するため、平均的な29.530588853日を1単位として
換算します。結果は小数点以下を含む浮動小数点数です。

【使用例】
```php
$interval = CarbonInterval::days(59);
$lunarInterval = DateInterval::instance($interval);
echo round($lunarInterval->toLunarMonthCount(), 1) . '旧暦月分';
// => 約 2.0 旧暦月分
```

**Returns:** float — 朔望月数（{\JapaneseDate\self::SYNODIC_MONTH_DAYS} を1単位とした換算値）
---

### untilNextNewMoon

```php
static public DateInterval untilNextNewMoon($from)
```

基準日時から次の新月（月相: MOON_PHASE_SHINGETSU）までの
残り期間を {DateInterval} として返します。

天文学的な新月（月の位相角 0°付近）の瞬間を基準に、
次の新月日（当日 00:00:00）までの差分を返します。

【使用例】
```php
$interval = DateInterval::untilNextNewMoon(DateTime::now());
echo $interval->days . '日後が次の新月です';
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$from` | —  | カウントダウン基準日時 |

**Returns:** [DateInterval](../JapaneseDate/DateInterval.md) — 次の新月日（当日 00:00:00）までの {\JapaneseDate\DateInterval}
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### addBusinessDaysTo

```php
public DateTime addBusinessDaysTo($baseDate, $businessDays, $config = null)
```

基準日から指定した営業日数後の日付を算出します。

営業日の判定にはインスタンス個別設定（またはグローバル/デフォルト設定）を使用します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$baseDate` | —  | 計算の基準となる日付 |
| int | `$businessDays` | —  | 加算する営業日数 |
| [DateBusiness](../JapaneseDate/DateBusiness.md)\|null | `$config` | `null` | 判定に使用する設定（省略時はインスタンス設定） |

**Returns:** [DateTime](../JapaneseDate/DateTime.md) — N営業日後の日付
---

### subBusinessDaysFrom

```php
public DateTime subBusinessDaysFrom($baseDate, $businessDays, $config = null)
```

基準日から指定した営業日数前の日付を算出します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTime](../JapaneseDate/DateTime.md) | `$baseDate` | —  | 計算の基準となる日付 |
| int | `$businessDays` | —  | 減算する営業日数 |
| [DateBusiness](../JapaneseDate/DateBusiness.md)\|null | `$config` | `null` | 判定に使用する設定（省略時はインスタンス設定） |

**Returns:** [DateTime](../JapaneseDate/DateTime.md) — N営業日前の日付
---

### countBusinessDaysBetween

```php
public int countBusinessDaysBetween($start, $end, $config = null)
```

2つの日付間の営業日数を計算します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$start` | —  | 開始日 |
| [DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$end` | —  | 終了日 |
| [DateBusiness](../JapaneseDate/DateBusiness.md)\|null | `$config` | `null` | 判定に使用する設定（省略時はインスタンス設定） |

**Returns:** int — 営業日数（start以上end以下の営業日の数）
**Throws:**

- [NativeDateTimeException](../JapaneseDate/Exceptions/NativeDateTimeException.md)
---

