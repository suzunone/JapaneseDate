# JapaneseDate DateTime Document

## Table of Contents

* [JapaneseDateCalendar](#japanesedatecalendar)
    * [__construct](#__construct)
    * [addBypassWeekDay](#addbypassweekday)
    * [removeBypassWeekDay](#removebypassweekday)
    * [resetBypassWeekDay](#resetbypassweekday)
    * [addBypassDay](#addbypassday)
    * [removeBypassDay](#removebypassday)
    * [resetBypassDay](#resetbypassday)
    * [setBypassHoliday](#setbypassholiday)
    * [getWorkingDayBySpan](#getworkingdaybyspan)
    * [getWorkingDay](#getworkingday)
    * [getWorkingDayByLimit](#getworkingdaybylimit)
* [JapaneseDateTime](#japanesedatetime)
    * [__construct](#__construct-1)
    * [factory](#factory)
    * [getDatesOfMonth](#getdatesofmonth)
    * [getEraName](#geteraname)
    * [getEraYear](#geterayear)
    * [getOrientalZodiac](#getorientalzodiac)
    * [getWeekday](#getweekday)
    * [getYear](#getyear)
    * [getMonth](#getmonth)
    * [getDay](#getday)
    * [getHoliday](#getholiday)
    * [viewHoliday](#viewholiday)
    * [viewWeekday](#viewweekday)
    * [viewMonth](#viewmonth)
    * [viewLunarMonth](#viewlunarmonth)
    * [viewSixWeekday](#viewsixweekday)
    * [viewOrientalZodiac](#vieworientalzodiac)
    * [viewEraName](#vieweraname)
    * [getLunarCalendar](#getlunarcalendar)
    * [isChuki](#ischuki)
    * [isUruu](#isuruu)
    * [getChuki](#getchuki)
    * [getTsuitachi](#gettsuitachi)
    * [getCalendar](#getcalendar)
    * [getChukiCalendar](#getchukicalendar)
    * [getTsuitachiCalendar](#gettsuitachicalendar)
    * [getLunarYear](#getlunaryear)
    * [getLunarMonth](#getlunarmonth)
    * [getLunarDay](#getlunarday)
    * [getSixWeekday](#getsixweekday)
    * [strftime](#strftime)
    * [getCompareFormat](#getcompareformat)
    * [toIntJD](#tointjd)

## JapaneseDateCalendar





* Full name: \JapaneseDate\JapaneseDateCalendar

**See Also:**

* https://github.com/suzunone/JapaneseDate * https://github.com/suzunone/JapaneseDate 

### __construct

JapaneseDateCalendar constructor.

```php
JapaneseDateCalendar::__construct( string $time = &#039;now&#039;, \DateTimeZone|null $timezone = NULL )
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **string** |  |
| `$timezone` | **\DateTimeZone&#124;null** |  |




---

### addBypassWeekDay

+-- スキップする曜日を追加する

```php
JapaneseDateCalendar::addBypassWeekDay( mixed $val ): \JapaneseDate\JapaneseDateCalendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **mixed** |  |




---

### removeBypassWeekDay

+-- スキップする曜日を削除する

```php
JapaneseDateCalendar::removeBypassWeekDay( mixed $val ): \JapaneseDate\JapaneseDateCalendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **mixed** |  |




---

### resetBypassWeekDay

+-- スキップする曜日を初期化する

```php
JapaneseDateCalendar::resetBypassWeekDay(  ): \JapaneseDate\JapaneseDateCalendar
```







---

### addBypassDay

+-- スキップする日を追加する

```php
JapaneseDateCalendar::addBypassDay( mixed $val ): \JapaneseDate\JapaneseDateCalendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **mixed** |  |




---

### removeBypassDay

+-- スキップする日を削除する

```php
JapaneseDateCalendar::removeBypassDay( mixed $val ): \JapaneseDate\JapaneseDateCalendar
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **mixed** |  |




---

### resetBypassDay

+-- スキップする曜日を初期化する

```php
JapaneseDateCalendar::resetBypassDay(  ): \JapaneseDate\JapaneseDateCalendar
```







---

### setBypassHoliday

+-- 祝日を除くかどうか

```php
JapaneseDateCalendar::setBypassHoliday( boolean $val ): \JapaneseDate\JapaneseDateCalendar
```

除く場合true、そうでない場合false


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$val` | **boolean** | 除く場合true、そうでない場合false |




---

### getWorkingDayBySpan

+-- 期間内の営業日を取得する

```php
JapaneseDateCalendar::getWorkingDayBySpan( integer|string $JDT_end ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$JDT_end` | **integer&#124;string** | 取得終了日 |




---

### getWorkingDay

+-- 営業日を取得します

```php
JapaneseDateCalendar::getWorkingDay( integer $lim_day ): array
```

getWorkingDayByLimitへのエイリアスです。


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$lim_day` | **integer** | 取得日数 |




---

### getWorkingDayByLimit

+-- 営業日を取得します

```php
JapaneseDateCalendar::getWorkingDayByLimit( integer $lim_day ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$lim_day` | **integer** | 取得日数 |




---

## JapaneseDateTime





* Full name: \JapaneseDate\JapaneseDateTime
* Parent class: 

**See Also:**

* https://github.com/suzunone/JapaneseDate * https://github.com/suzunone/JapaneseDate 

### __construct

+-- コンストラクタ

```php
JapaneseDateTime::__construct( mixed $time = &#039;now&#039;, \DateTimeZone $timezone = NULL ): void
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **mixed** | OPTIONAL:'now' |
| `$timezone` | **\DateTimeZone** | OPTIONAL:NULL |




---

### factory

+--オブジェクトの生成

```php
JapaneseDateTime::factory( mixed $time = &#039;now&#039;, \DateTimeZone $timezone = NULL ): \JapaneseDate\JapaneseDateTime
```



* This method is **static**.
**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$time` | **mixed** | OPTIONAL:'now' |
| `$timezone` | **\DateTimeZone** | OPTIONAL:NULL |




---

### getDatesOfMonth

+-- 指定月の日付配列を取得します

```php
JapaneseDateTime::getDatesOfMonth(  ): array
```







---

### getEraName

+-- 年号キーを返す

```php
JapaneseDateTime::getEraName(  ): integer
```







---

### getEraYear

+-- 和暦を返す

```php
JapaneseDateTime::getEraYear(  ): integer
```







---

### getOrientalZodiac

+-- 干支キーを返す

```php
JapaneseDateTime::getOrientalZodiac(  ): integer
```







---

### getWeekday

+-- 七曜を数値化して返します

```php
JapaneseDateTime::getWeekday(  ): integer
```







---

### getYear

+-- 年を数値化して返します

```php
JapaneseDateTime::getYear(  ): integer
```







---

### getMonth

+-- 月を数値化して返します

```php
JapaneseDateTime::getMonth(  ): integer
```







---

### getDay

+-- 日を数値化して返します

```php
JapaneseDateTime::getDay(  ): integer
```







---

### getHoliday

+-- 祝日キーを返す

```php
JapaneseDateTime::getHoliday(  ): integer
```







---

### viewHoliday

+-- 日本語フォーマットされた休日名を返す

```php
JapaneseDateTime::viewHoliday(  ): string
```







---

### viewWeekday

+-- 日本語フォーマットされた曜日名を返す

```php
JapaneseDateTime::viewWeekday(  ): string
```







---

### viewMonth

+-- 日本語フォーマットされた旧暦月名を返す

```php
JapaneseDateTime::viewMonth(  ): string
```







---

### viewLunarMonth

+-- 旧暦(月)

```php
JapaneseDateTime::viewLunarMonth(  ): string
```







---

### viewSixWeekday

+-- 日本語フォーマットされた六曜名を返す

```php
JapaneseDateTime::viewSixWeekday(  ): string
```







---

### viewOrientalZodiac

+-- 日本語フォーマットされた干支を返す

```php
JapaneseDateTime::viewOrientalZodiac(  ): string
```







---

### viewEraName

+-- 日本語フォーマットされた年号を返す

```php
JapaneseDateTime::viewEraName(  ): string
```







---

### getLunarCalendar

+-- 旧暦データ取得

```php
JapaneseDateTime::getLunarCalendar(  ): array
```







---

### isChuki

+-- 中気かどうか

```php
JapaneseDateTime::isChuki(  ): boolean
```







---

### isUruu

+-- 閏月かどうか

```php
JapaneseDateTime::isUruu(  ): boolean
```







---

### getChuki

+-- 中気の取得

```php
JapaneseDateTime::getChuki(  ): \JapaneseDate\JapaneseDateTime
```







---

### getTsuitachi

+-- 朔の取得

```php
JapaneseDateTime::getTsuitachi(  ): \JapaneseDate\JapaneseDateTime
```







---

### getCalendar

+-- カレンダーの取得

```php
JapaneseDateTime::getCalendar( integer $calendar = CAL_GREGORIAN ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$calendar` | **integer** |  |




---

### getChukiCalendar

+-- 中気の取得

```php
JapaneseDateTime::getChukiCalendar( integer $calendar = CAL_GREGORIAN ): array
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$calendar` | **integer** |  |




---

### getTsuitachiCalendar

+-- 朔の取得

```php
JapaneseDateTime::getTsuitachiCalendar( integer $calendar = CAL_GREGORIAN ): string
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$calendar` | **integer** |  |




---

### getLunarYear

+-- 旧暦（年）

```php
JapaneseDateTime::getLunarYear(  ): string
```







---

### getLunarMonth

+-- 旧暦(月)

```php
JapaneseDateTime::getLunarMonth(  ): string
```







---

### getLunarDay

+-- 旧暦(日)・月齢

```php
JapaneseDateTime::getLunarDay(  ): string
```







---

### getSixWeekday

+-- 六曜を数値化して返します

```php
JapaneseDateTime::getSixWeekday(  ): integer
```







---

### strftime

+-- 日本語カレンダー対応したstrftime()

```php
JapaneseDateTime::strftime( string $format, integer $time_stamp = NULL ): string
```

<pre>[function.strftime strftimeの仕様](http://php.five-foxes.com/module/php_man/index.php?web=public)
に加え、
%J 1～31の日
%e 1～9なら先頭にスペースを付ける、1～31の日
%g 1～9なら先頭にスペースを付ける、1～12の月
%K 和名曜日
%k 六曜番号
%6 六曜
%K 曜日
%l 祝日番号
%L 祝日
%o 干支番号
%O 干支
%N 1～12の月
%E 旧暦年
%G 旧暦の月
%F 年号
%f 年号ID

が使用できます。</pre>


**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$format` | **string** | フォーマット |
| `$time_stamp` | **integer** | 変換したいタイムスタンプ(デフォルトは現在のロケール時間) |




---

### getCompareFormat

+-- 比較用のYMD

```php
JapaneseDateTime::getCompareFormat(  ): integer
```







---

### toIntJD

+-- 比較用のYMD

```php
JapaneseDateTime::toIntJD(  $JD ): integer
```




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$JD` | **** |  |




---



--------
> This document was automatically generated from source code comments on 2018-05-12 using [phpDocumentor](http://www.phpdoc.org/) and [cvuorinen/phpdoc-markdown-public](https://github.com/cvuorinen/phpdoc-markdown-public)
