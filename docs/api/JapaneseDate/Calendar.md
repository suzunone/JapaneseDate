# Calendar

**Namespace:** `JapaneseDate`

class **Calendar**

日付オブジェクト配列作成

様々な条件の元、一定期間内の日付の配列を取得します。

## Methods

| Return | Method | Description |
|---|---|---|
| Calendar | [addBypassWeekDay()](#addbypassweekday) | スキップする曜日を追加する |
| array | [getDatesOfMonth()](#getdatesofmonth) | 指定月の日付配列を取得します |
| Calendar | [removeBypassWeekDay()](#removebypassweekday) | スキップする曜日を削除する |
| Calendar | [resetBypassWeekDay()](#resetbypassweekday) | スキップする曜日を初期化する |
| Calendar | [addBypassDay()](#addbypassday) | スキップする日を追加する |
| Calendar | [removeBypassDay()](#removebypassday) | スキップする日を削除する |
| Calendar | [resetBypassDay()](#resetbypassday) | スキップする曜日を初期化する |
| Calendar | [setBypassHoliday()](#setbypassholiday) | 祝日を除くかどうか |
| array | [getWorkingDayBySpan()](#getworkingdaybyspan) | 期間内の営業日を取得する |
| array | [getWorkingDay()](#getworkingday) | 営業日を取得します |
| array | [getWorkingDayByLimit()](#getworkingdaybylimit) | 営業日を取得します |

---

## Method Details

### addBypassWeekDay

```php
public Calendar addBypassWeekDay($val)
```

スキップする曜日を追加する

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$val` | —  | スキップする曜日(0:日曜-6:土曜) |

**Returns:** [Calendar](../JapaneseDate/Calendar.md)
---

### getDatesOfMonth

```php
public array getDatesOfMonth()
```

指定月の日付配列を取得します

**Returns:** array
**Throws:**

- Exception
---

### removeBypassWeekDay

```php
public Calendar removeBypassWeekDay($val)
```

スキップする曜日を削除する

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$val` | —  | スキップする曜日(0:日曜-6:土曜) |

**Returns:** [Calendar](../JapaneseDate/Calendar.md)
---

### resetBypassWeekDay

```php
public Calendar resetBypassWeekDay()
```

スキップする曜日を初期化する

**Returns:** [Calendar](../JapaneseDate/Calendar.md)
---

### addBypassDay

```php
public Calendar addBypassDay($time)
```

スキップする日を追加する

日付/時刻 文字列の書式については http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式 を参考にしてください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$time` | —  | 日付/時刻 文字列。DateTimeオブジェクト |

**Returns:** [Calendar](../JapaneseDate/Calendar.md)
**Throws:**

- Exception
---

### removeBypassDay

```php
public Calendar removeBypassDay($time)
```

スキップする日を削除する

日付/時刻 文字列の書式については http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式 を参考にしてください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$time` | —  | 日付/時刻 文字列。DateTimeオブジェクト |

**Returns:** [Calendar](../JapaneseDate/Calendar.md)
**Throws:**

- Exception
---

### resetBypassDay

```php
public Calendar resetBypassDay()
```

スキップする曜日を初期化する

**Returns:** [Calendar](../JapaneseDate/Calendar.md)
---

### setBypassHoliday

```php
public Calendar setBypassHoliday($val)
```

祝日を除くかどうか

除く場合true、そうでない場合false

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$val` | —  | 除く場合true、そうでない場合false |

**Returns:** [Calendar](../JapaneseDate/Calendar.md)
---

### getWorkingDayBySpan

```php
public array getWorkingDayBySpan($jdt_end)
```

期間内の営業日を取得する

日付/時刻 文字列の書式については http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式 を参考にしてください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$jdt_end` | —  | 取得終了日 |

**Returns:** array
**Throws:**

- Exception
---

### getWorkingDay

```php
public array getWorkingDay($lim_day)
```

営業日を取得します

getWorkingDayByLimitへのエイリアスです。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$lim_day` | —  | 取得日数 |

**Returns:** array
**Throws:**

- Exception
---

### getWorkingDayByLimit

```php
public array getWorkingDayByLimit($lim_day)
```

営業日を取得します

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$lim_day` | —  | 取得日数 |

**Returns:** array
**Throws:**

- NativeDateTimeException
---

