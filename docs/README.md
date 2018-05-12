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



* Full name: \JapaneseDate\Calendar

**See Also:**

* https://github.com/suzunone/JapaneseDate * https://github.com/suzunone/JapaneseDate 

### __construct

JapaneseDateCalendar constructor.

```php
Calendar::__construct( string|\JapaneseDate\DateTime $time = &#039;now&#039;, \DateTimeZone|null $timezone = null )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;\JapaneseDate\DateTime** |  |
| `$timezone` | **\DateTimeZone&#124;null** |  |




---

### addBypassWeekDay

スキップする曜日を追加する

```php
Calendar::addBypassWeekDay( integer $val ): \JapaneseDate\Calendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **integer** |  |




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
| `$val` | **integer** |  |




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




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;\JapaneseDate\DateTime** |  |




---

### removeBypassDay

スキップする日を削除する

```php
Calendar::removeBypassDay( string|\JapaneseDate\DateTime $time ): \JapaneseDate\Calendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;\JapaneseDate\DateTime** |  |




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
| `$val` | **boolean** |  |




---

### getWorkingDayBySpan

期間内の営業日を取得する

```php
Calendar::getWorkingDayBySpan( integer|string $jdt_end ): array&lt;mixed,\JapaneseDate\DateTime&gt;
```




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
DateTime::__construct( string|integer|\DateTimeInterface $time = &#039;now&#039;, \DateTimeZone|null|string $time_zone = null )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string&#124;integer&#124;\DateTimeInterface** |  |
| `$time_zone` | **\DateTimeZone&#124;null&#124;string** |  |




---

### factory

DateTimeオブジェクトの生成

```php
DateTime::factory( string|integer|\DateTimeInterface $date_time = &#039;now&#039;, \DateTimeZone|null|string $time_zone = null ): static
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$date_time` | **string&#124;integer&#124;\DateTimeInterface** | 日付オブジェクト OR Unix Time Stamp OR 日付文字列 |
| `$time_zone` | **\DateTimeZone&#124;null&#124;string** |  |




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

* \JapaneseDate\CacheMode::MODE_NONE - キャッシュなし* \JapaneseDate\CacheMode::MODE_AUTO - 自動でキャッシュモードを選択* \JapaneseDate\CacheMode::MODE_APC - APCを使用したキャッシュ* \JapaneseDate\CacheMode::MODE_FILE - ファイルを使用したキャッシュ* \JapaneseDate\CacheMode::MODE_ORIGINAL - 独自キャッシュ

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
- %N 1～12の月
- %E 旧暦年
- %G 旧暦の月
- %F 年号
- %f 年号ID

が使用できます。


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
- %N 1～12の月
- %E 旧暦年
- %G 旧暦の月
- %F 年号
- %f 年号ID

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
| `$format` | **string** |  |




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
> This document was automatically generated from source code comments on 2018-05-12 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
