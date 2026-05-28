# Calendar

**Namespace:** `JapaneseDate`

class **Calendar**

様々な除外条件（設定）に基づいて、特定の期間や月の営業日・日付オブジェクトの配列を生成するクラス。

特定の曜日、祝日、あるいは個別に指定した日付をスキップ（バイパス）するフィルタリング機能を備えており、
企業の営業日計算、一括スケジュール生成、非稼働日を除外したタスク割り当てなどに利用できます。

メソッドチェーンによる柔軟な条件指定が可能です。

【ユースケース例：土日祝と特定の日を除外した5営業日を取得する】
```php
$calendar = new Calendar();
$workingDays = $calendar->addBypassWeekDay(Calendar::SATURDAY)
->addBypassWeekDay(Calendar::SUNDAY)
->setBypassHoliday(true)
->addBypassDay('2026-05-01') // 独自の臨時休業日
->getWorkingDay(5);          // 本日から5営業日分を取得
```

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

