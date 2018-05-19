# Japanese DateTime Document

## Table of Contents

* [CacheMode](#cachemode)
* [Calendar](#calendar)
    * [__construct](#__construct)
    * [addBypassWeekDay](#addbypassweekday)
    * [getDatesOfMonth](#getdatesofmonth)
    * [removeBypassWeekDay](#removebypassweekday)
    * [resetBypassWeekDay](#resetbypassweekday)
    * [addBypassDay](#addbypassday)
    * [removeBypassDay](#removebypassday)
    * [resetBypassDay](#resetbypassday)
    * [setBypassHoliday](#setbypassholiday)
    * [getWorkingDayBySpan](#getworkingdaybyspan)
    * [getWorkingDay](#getworkingday)
    * [getWorkingDayByLimit](#getworkingdaybylimit)
* [DateTime](#datetime)
    * [__construct](#__construct-1)
    * [factory](#factory)
    * [setCacheMode](#setcachemode)
    * [setCacheFilePath](#setcachefilepath)
    * [setCacheClosure](#setcacheclosure)
    * [strftime](#strftime)
    * [formatLocalized](#formatlocalized)
    * [formatLocalizedSimple](#formatlocalizedsimple)
    * [getCalendar](#getcalendar)
    * [__get](#__get)

## CacheMode

Class CacheMode



* Full name: \JapaneseDate\CacheMode

**See Also:**

* https://github.com/suzunone/JapaneseDate * https://github.com/suzunone/JapaneseDate 

## Calendar

日付オブジェクト配列作成

様々な条件の元、一定期間内の日付の配列を取得します。

* Full name: \JapaneseDate\Calendar

**See Also:**

* https://github.com/suzunone/JapaneseDate * https://github.com/suzunone/JapaneseDate 

### __construct

JapaneseDateCalendar constructor.

```php
Calendar::__construct( string|\JapaneseDate\DateTimeInterface $time = &#039;now&#039;, \DateTimeZone|integer|null $timezone = null )
```

日付/時刻 文字列の書式については [サポートする日付と時刻の書式](http://php.net/manual/ja/datetime.formats.php) を参考にしてください。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;\JapaneseDate\DateTimeInterface** | 日付配列取得の起点となる、日付オブジェクト OR Unix Time Stamp OR 日付/時刻 文字列 |
| `$timezone` | **\DateTimeZone&#124;integer&#124;null** | オブジェクトか、時差の時間、タイムゾーンテキスト |




---

### addBypassWeekDay

スキップする曜日を追加する

```php
Calendar::addBypassWeekDay( integer $val ): \JapaneseDate\Calendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **integer** | スキップする曜日(0:日曜-6:土曜) |




---

### getDatesOfMonth

指定月の日付配列を取得します

```php
Calendar::getDatesOfMonth(  ): array
```







---

### removeBypassWeekDay

スキップする曜日を削除する

```php
Calendar::removeBypassWeekDay( integer $val ): \JapaneseDate\Calendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **integer** | スキップする曜日(0:日曜-6:土曜) |




---

### resetBypassWeekDay

スキップする曜日を初期化する

```php
Calendar::resetBypassWeekDay(  ): \JapaneseDate\Calendar
```







---

### addBypassDay

スキップする日を追加する

```php
Calendar::addBypassDay( string|\JapaneseDate\DateTime $time ): \JapaneseDate\Calendar
```

日付/時刻 文字列の書式については [サポートする日付と時刻の書式](http://php.net/manual/ja/datetime.formats.php) を参考にしてください。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;\JapaneseDate\DateTime** | 日付/時刻 文字列。DateTimeオブジェクト |




---

### removeBypassDay

スキップする日を削除する

```php
Calendar::removeBypassDay( string|\JapaneseDate\DateTime $time ): \JapaneseDate\Calendar
```

日付/時刻 文字列の書式については [サポートする日付と時刻の書式](http://php.net/manual/ja/datetime.formats.php) を参考にしてください。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;\JapaneseDate\DateTime** | 日付/時刻 文字列。DateTimeオブジェクト |




---

### resetBypassDay

スキップする曜日を初期化する

```php
Calendar::resetBypassDay(  ): \JapaneseDate\Calendar
```







---

### setBypassHoliday

祝日を除くかどうか

```php
Calendar::setBypassHoliday( boolean $val ): \JapaneseDate\Calendar
```

除く場合true、そうでない場合false


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **boolean** | 除く場合true、そうでない場合false |




---

### getWorkingDayBySpan

期間内の営業日を取得する

```php
Calendar::getWorkingDayBySpan( integer|string $jdt_end ): array&lt;mixed,\JapaneseDate\DateTime&gt;
```

日付/時刻 文字列の書式については [サポートする日付と時刻の書式](http://php.net/manual/ja/datetime.formats.php) を参考にしてください。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$jdt_end` | **integer&#124;string** | 取得終了日 |




---

### getWorkingDay

営業日を取得します

```php
Calendar::getWorkingDay( integer $lim_day ): array&lt;mixed,\JapaneseDate\DateTime&gt;
```

getWorkingDayByLimitへのエイリアスです。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$lim_day` | **integer** | 取得日数 |




---

### getWorkingDayByLimit

営業日を取得します

```php
Calendar::getWorkingDayByLimit( integer $lim_day ): array&lt;mixed,\JapaneseDate\DateTime&gt;
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$lim_day` | **integer** | 取得日数 |




---

## DateTime

日本の暦対応のDateTimeオブジェクト拡張



* Full name: \JapaneseDate\DateTime
* Parent class: 

**See Also:**

* https://github.com/suzunone/JapaneseDate * https://carbon.nesbot.com/docs/ * https://github.com/suzunone/JapaneseDate 

### __construct

DateTime constructor.

```php
DateTime::__construct( string|\DateTimeInterface|null $time = null, \DateTimeZone|string|null|integer $time_zone = null )
```

日付/時刻 文字列の書式については [サポートする日付と時刻の書式](http://php.net/manual/ja/datetime.formats.php) を参考にしてください。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;\DateTimeInterface&#124;null** | 日付/時刻 文字列。DateTimeオブジェクト |
| `$time_zone` | **\DateTimeZone&#124;string&#124;null&#124;integer** | DateTimeZone オブジェクトか、時差の時間、タイムゾーンテキスト |




---

### factory

DateTimeオブジェクトの生成

```php
DateTime::factory( string|integer|\DateTimeInterface|null $date_time = null, \DateTimeZone|null|string $time_zone = null ): static
```

日付/時刻 文字列の書式については [サポートする日付と時刻の書式](http://php.net/manual/ja/datetime.formats.php) を参考にしてください。

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$date_time` | **string&#124;integer&#124;\DateTimeInterface&#124;null** | 日付オブジェクト OR Unix Time Stamp OR 日付/時刻 文字列 |
| `$time_zone` | **\DateTimeZone&#124;null&#124;string** | オブジェクトか、時差の時間、タイムゾーンテキスト |




---

### setCacheMode

キャッシュモードを指定する

```php
DateTime::setCacheMode( integer $mode )
```

指定するキャッシュモードは、[\JapaneseDate\CacheMode](../classes/JapaneseDate.CacheMode.html)参照。

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$mode` | **integer** | キャッシュモード |



**See Also:**

* \JapaneseDate\CacheMode::MODE_NONE - キャッシュなし
* \JapaneseDate\CacheMode::MODE_AUTO - 自動でキャッシュモードを選択
* \JapaneseDate\CacheMode::MODE_APC - APCを使用したキャッシュ
* \JapaneseDate\CacheMode::MODE_FILE - ファイルを使用したキャッシュ
* \JapaneseDate\CacheMode::MODE_ORIGINAL - 独自キャッシュ

---

### setCacheFilePath

キャッシュファイル保存ディレクトリをセットします

```php
DateTime::setCacheFilePath( string $cache_file_path )
```

キャッシュモードがファイル[\JapaneseDate\CacheMode::MODE_FILE](../classes/JapaneseDate.CacheMode.html#constant_MODE_FILE)の時に使用する、キャッシュファイル保存ディレクトリをセットします。

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$cache_file_path` | **string** | キャッシュファイルを保存するディレクトリ |




---

### setCacheClosure

独自キャッシュロジックのセット

```php
DateTime::setCacheClosure( \Closure $function )
```

キャッシュモードが独自キャッシュ[\JapaneseDate\CacheMode::MODE_ORIGINAL](../classes/JapaneseDate.CacheMode.html#constant_MODE_ORIGINAL)の時に使用する、クロージャをセットします。

セットされるクロージャは、

mixed ClosureFunction(string $key, Closure $Cloosure)

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **string** | キャッシュ単位の一意なキー。このキーにマッチしたキャッシュデータが有る場合は、キャッシュされたデータをreturnしてください。 |
| `$Cloosure` | **\Closure** | キャッシュされたデータが取得できない場合に実行するクロージャです。実行すれば、キャッシュするべきデータが返されます。 |

* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$function` | **\Closure** | 独自キャッシュのロジックが含まれたクロージャ |




---

### strftime

日本語カレンダー対応したstrftime()

```php
DateTime::strftime( string $format ): string
```

[function.strftime strftimeの仕様](http://php.net/manual/ja/function.strftime.php)
に加え、

- %J 1～31の日
- %e 1～9なら先頭にスペースを付ける、1～31の日
- %g 1～9なら先頭にスペースを付ける、1～12の月
- %k 六曜番号
- %6 六曜
- %K 曜日
- %l 祝日番号
- %L 祝日
- %o 干支番号
- %O 干支
- %E 旧暦年
- %G 旧暦の月
- %F 年号
- %f 年号ID

が使用できます。

このメソッドは非推奨です。 \DateTime::formatLocalized()を使用してください。

* **Warning:** this method is **deprecated**. This means that this method will likely be removed in a future version.

**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$format` | **string** | フォーマット |


**Return Value:**

指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。



---

### formatLocalized

日本語カレンダー対応したstrftime()

```php
DateTime::formatLocalized( string $format ): string
```

[function.strftime strftimeの仕様](http://php.net/manual/ja/function.strftime.php)
に加え、

- %#J 1～31の日
- %#e 1～9なら先頭にスペースを付ける、1～31の日
- %#g 1～9なら先頭にスペースを付ける、1～12の月
- %#k 六曜番号
- %#6 六曜
- %#K 曜日
- %#l 祝日番号
- %#L 祝日
- %#o 干支番号
- %#O 干支
- %#E 旧暦年
- %#G 旧暦の月
- %#F 年号
- %#f 年号ID

が使用できます。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$format` | **string** | フォーマット |


**Return Value:**

指定したフォーマット文字列に基づき文字列をフォーマットして返します。 月および曜日の名前、およびその他の言語依存の文字列は、 setlocale() で設定された現在のロケールを尊重して表示されます。



---

### formatLocalizedSimple

CarbonデフォルトのformatLocalizedへのエイリアス

```php
DateTime::formatLocalizedSimple( string $format ): string
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$format` | **string** | フォーマット |




---

### getCalendar

サポートされるカレンダーに変換する

```php
DateTime::getCalendar( integer $calendar = CAL_GREGORIAN ): array
```

サポートされる calendar の値は、 CAL_GREGORIAN、 CAL_JULIAN、 CAL_JEWISH および CAL_FRENCH です。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$calendar` | **integer** | サポートされるカレンダー |


**Return Value:**

カレンダーの情報を含む配列を返します。この配列には、 年、月、日、週、曜日名、月名、"月/日/年" 形式の文字列 などが含まれます。



---

### __get

MagicMethod:__get()

```php
DateTime::__get( string $name ): \DateTimeZone|integer|string
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$name` | **string** |  |



**See Also:**

* https://carbon.nesbot.com/docs/#api-getters 

---



--------
> This document was automatically generated from source code comments on 2018-05-19 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
