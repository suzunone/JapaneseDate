# Calendar

**Namespace:** `JapaneseDate`

class **Calendar**

様々な除外条件（設定）に基づいて、特定の期間や月の営業日・日付オブジェクトの配列を生成するクラス。

旧来の bypass 系 API と、[\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) を使った新しい
営業日カレンダー設定の両方をサポートしています。

**bypass 系 API（旧来方式）**
- 特定の曜日・日付・祝日をスキップする条件を個別に積み上げる方式。
- addBypassWeekDay()} / {@link addBypassDay()} / {@link setBypassHoliday() で設定し、
  getWorkingDay()} / {@link getWorkingDayBySpan() で取得します。

**DateBusiness カレンダー API（新方式）**
- [\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) オブジェクトで曜日・祝日・第XX曜日・特定日・
  フィルタ・マクロを優先順位付きで柔軟に組み合わせられます。
- setBusinessConfig() でインスタンス個別設定を、
  \JapaneseDate\Components\BusinessCalendar::setGlobalConfig() でグローバル設定を指定します。
- getBusinessDaysBySpan()} / {@link getBusinessDaysByLimit()} / {@link isBusinessDayByConfig() で取得・判定します。

【bypass 系 使用例: 土日祝と特定日を除外した5営業日を取得する】
```php
use JapaneseDate\Calendar;

$calendar = new Calendar();
$days = $calendar
    ->addBypassWeekDay(Calendar::SATURDAY)
    ->addBypassWeekDay(Calendar::SUNDAY)
    ->setBypassHoliday(true)
    ->addBypassDay('2026-05-01')
    ->getWorkingDay(5);
```

【DateBusiness カレンダー 使用例: 夏期休暇・第3水曜定休を加えた営業日取得】
```php
use JapaneseDate\Calendar;
use JapaneseDate\DateBusiness;

$config = (new DateBusiness())
    ->setClosingWeekdays([0, 6])
    ->setBypassHoliday(true)
    ->addClosingDate('2026-08-15', '夏期休暇')
    ->addClosingNthWeekday(3, 3, '第3水曜定休');

$calendar = new Calendar('2026-08-10');
$calendar->setBusinessConfig($config);
$days = $calendar->getBusinessDaysByLimit(5);
```

## Traits

- [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md)

## Constants

| Modifier | Name | Description |
|---|---|---|
| public | `SUNDAY` | 日曜日を表す曜日定数。 |
| public | `MONDAY` | 月曜日を表す曜日定数。 |
| public | `TUESDAY` | 火曜日を表す曜日定数。 |
| public | `WEDNESDAY` | 水曜日を表す曜日定数。 |
| public | `THURSDAY` | 木曜日を表す曜日定数。 |
| public | `FRIDAY` | 金曜日を表す曜日定数。 |
| public | `SATURDAY` | 土曜日を表す曜日定数。 |

## Methods

| Return | Method | Description |
|---|---|---|
| DateBusinessCommon | [DateBusinessCommon::setBusinessConfig](../JapaneseDate/Traits/DateBusinessCommon.md#setbusinessconfig) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | インスタンスに個別の営業日設定を適用します。 |
| DateBusiness\|null | [DateBusinessCommon::getBusinessConfig](../JapaneseDate/Traits/DateBusinessCommon.md#getbusinessconfig) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | インスタンスが保持している個別の営業日設定を取得します。 |
| DateBusinessCommon | [DateBusinessCommon::setClosingDay](../JapaneseDate/Traits/DateBusinessCommon.md#setclosingday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 特定の日付を休業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::setOpenDay](../JapaneseDate/Traits/DateBusinessCommon.md#setopenday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 特定の日付を営業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::setClosingWeekdays](../JapaneseDate/Traits/DateBusinessCommon.md#setclosingweekdays) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 休業曜日を一括設定します。 |
| Calendar | [setBypassHoliday()](#setbypassholiday) | 祝日をスキップするかどうかを設定します（bypass 系 API）。 |
| DateBusinessCommon | [DateBusinessCommon::setOpenNthWeekday](../JapaneseDate/Traits/DateBusinessCommon.md#setopennthweekday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 第XX曜日を営業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::setClosingNthWeekday](../JapaneseDate/Traits/DateBusinessCommon.md#setclosingnthweekday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 第XX曜日を休業日として指定します。 |
| DateBusinessCommon | [DateBusinessCommon::addOpenFilter](../JapaneseDate/Traits/DateBusinessCommon.md#addopenfilter) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 営業指定フィルタを追加します。 |
| DateBusinessCommon | [DateBusinessCommon::addClosingFilter](../JapaneseDate/Traits/DateBusinessCommon.md#addclosingfilter) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 休業指定フィルタを追加します。 |
| DateBusinessCommon | [DateBusinessCommon::setBusinessMacro](../JapaneseDate/Traits/DateBusinessCommon.md#setbusinessmacro) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 判定ロジックを完全に上書きするマクロを設定します。 |
| bool | [DateBusinessCommon::checkIsBusinessDay](../JapaneseDate/Traits/DateBusinessCommon.md#checkisbusinessday) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 指定した日付（または自身が保持する日付）が営業日かどうかを判定します。 |
| string\|null | [DateBusinessCommon::checkGetBusinessDayLabel](../JapaneseDate/Traits/DateBusinessCommon.md#checkgetbusinessdaylabel) _(from [DateBusinessCommon](../JapaneseDate/Traits/DateBusinessCommon.md))_ | 指定した日付（または自身が保持する日付）の休業ラベルを取得します。 |
| Calendar | [addBypassWeekDay()](#addbypassweekday) | スキップする曜日を追加します（bypass 系 API）。 |
| array | [getDatesOfMonth()](#getdatesofmonth) | 指定月の全日付配列を取得します。 |
| Calendar | [removeBypassWeekDay()](#removebypassweekday) | スキップする曜日を削除します（bypass 系 API）。 |
| Calendar | [resetBypassWeekDay()](#resetbypassweekday) | スキップする曜日をすべてリセットします（bypass 系 API）。 |
| Calendar | [addBypassDay()](#addbypassday) | スキップする日付を追加します（bypass 系 API）。 |
| Calendar | [removeBypassDay()](#removebypassday) | スキップする日付を削除します（bypass 系 API）。 |
| Calendar | [resetBypassDay()](#resetbypassday) | スキップする日付をすべてリセットします（bypass 系 API）。 |
| array | [getWorkingDayBySpan()](#getworkingdaybyspan) | 期間内の営業日を取得します（bypass 系 API）。 |
| array | [getWorkingDay()](#getworkingday) | 営業日を取得します（bypass 系 API）。 |
| array | [getWorkingDayByLimit()](#getworkingdaybylimit) | 指定件数の営業日を取得します（bypass 系 API）。 |
| bool | [isBusinessDayByConfig()](#isbusinessdaybyconfig) | 開始日（または指定日付）が営業日かどうかを [\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定で判定します。 |
| array | [getBusinessDaysBySpan()](#getbusinessdaysbyspan) | [\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定を使用して期間内の営業日を取得します。 |
| array | [getBusinessDaysByLimit()](#getbusinessdaysbylimit) | [\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定を使用して指定件数の営業日を取得します。 |

---

## Method Details

### setBypassHoliday

```php
public Calendar setBypassHoliday($val)
```

祝日をスキップするかどうかを設定します（bypass 系 API）。

`true` を設定すると、国民の祝日・休日が getWorkingDay() などの
結果から除外されます。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$val` | —  | `true` で祝日を除外、`false` で祝日を営業日として扱う |

**Returns:** [Calendar](../JapaneseDate/Calendar.md) — メソッドチェーン用に自身を返します
---

### addBypassWeekDay

```php
public Calendar addBypassWeekDay($val)
```

スキップする曜日を追加します（bypass 系 API）。

曜日番号は 0（日曜）〜 6（土曜）、またはクラス定数（`Calendar::SATURDAY` など）で指定します。

**使用例:**
```php
$calendar->addBypassWeekDay(Calendar::SATURDAY)->addBypassWeekDay(Calendar::SUNDAY);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$val` | —  | スキップする曜日（0=日曜〜6=土曜） |

**Returns:** [Calendar](../JapaneseDate/Calendar.md) — メソッドチェーン用に自身を返します
---

### getDatesOfMonth

```php
public array getDatesOfMonth()
```

指定月の全日付配列を取得します。

コンストラクタで指定した日付が属する月の、1日から月末までの
[\JapaneseDate\DateTime](../JapaneseDate/DateTime.html) 配列を返します。

**使用例:**
```php
$calendar = new Calendar('2026-05-15');
$days = $calendar->getDatesOfMonth(); // 2026年5月1日〜31日
```

**Returns:** array — 月内の全日付の配列
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### removeBypassWeekDay

```php
public Calendar removeBypassWeekDay($val)
```

スキップする曜日を削除します（bypass 系 API）。

登録されていない曜日を指定した場合は何もしません。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$val` | —  | 削除する曜日（0=日曜〜6=土曜） |

**Returns:** [Calendar](../JapaneseDate/Calendar.md) — メソッドチェーン用に自身を返します
---

### resetBypassWeekDay

```php
public Calendar resetBypassWeekDay()
```

スキップする曜日をすべてリセットします（bypass 系 API）。

**Returns:** [Calendar](../JapaneseDate/Calendar.md) — メソッドチェーン用に自身を返します
---

### addBypassDay

```php
public Calendar addBypassDay($time)
```

スキップする日付を追加します（bypass 系 API）。

日付/時刻 文字列の書式については
http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式
を参考にしてください。

**使用例:**
```php
$calendar->addBypassDay('2026-05-01')->addBypassDay('2026-08-15');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$time` | —  | スキップする日付 |

**Returns:** [Calendar](../JapaneseDate/Calendar.md) — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### removeBypassDay

```php
public Calendar removeBypassDay($time)
```

スキップする日付を削除します（bypass 系 API）。

登録されていない日付を指定した場合は何もしません。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$time` | —  | 削除する日付 |

**Returns:** [Calendar](../JapaneseDate/Calendar.md) — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### resetBypassDay

```php
public Calendar resetBypassDay()
```

スキップする日付をすべてリセットします（bypass 系 API）。

**Returns:** [Calendar](../JapaneseDate/Calendar.md) — メソッドチェーン用に自身を返します
---

### getWorkingDayBySpan

```php
public array getWorkingDayBySpan($jdt_end)
```

期間内の営業日を取得します（bypass 系 API）。

開始日（コンストラクタで指定）から `$jdt_end` までの範囲で、
bypass 系の設定（曜日・特定日・祝日）を除外した営業日の配列を返します。

日付/時刻 文字列の書式については
http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式
を参考にしてください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$jdt_end` | —  | 取得終了日 |

**Returns:** array
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### getWorkingDay

```php
public array getWorkingDay($lim_day)
```

営業日を取得します（bypass 系 API）。

getWorkingDayByLimit() のエイリアスです。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$lim_day` | —  | 取得件数 |

**Returns:** array
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### getWorkingDayByLimit

```php
public array getWorkingDayByLimit($lim_day)
```

指定件数の営業日を取得します（bypass 系 API）。

開始日から順に走査し、bypass 系の設定（曜日・特定日・祝日）を除外しながら
`$lim_day` 件分の営業日を返します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$lim_day` | —  | 取得件数 |

**Returns:** array
**Throws:**

- [NativeDateTimeException](../JapaneseDate/Exceptions/NativeDateTimeException.md)
---

### isBusinessDayByConfig

```php
public bool isBusinessDayByConfig($date = null)
```

開始日（または指定日付）が営業日かどうかを [\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定で判定します。

インスタンス個別設定 → グローバル設定 → デフォルト設定（土日・祝日休み）の順で
有効な設定を解決して判定します。

**使用例:**
```php
$calendar = new Calendar('2026-05-30'); // 土曜
$calendar->setOpenDay('2026-05-30');    // 特別営業日に設定
$calendar->isBusinessDayByConfig();     // true
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date` | `null` | 判定する日付（省略時はコンストラクタで指定した開始日） |

**Returns:** bool — 営業日であれば true
---

### getBusinessDaysBySpan

```php
public array getBusinessDaysBySpan($jdt_end)
```

[\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定を使用して期間内の営業日を取得します。

旧来の getWorkingDayBySpan() と異なり、インスタンス個別の
[\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定（グローバル/デフォルト含む）を使用して
優先順位付きで営業日を判定します。

**使用例:**
```php
$config = (new DateBusiness())->setClosingWeekdays([0, 6])->addClosingDate('2026-08-15', '夏期休暇');
$calendar = new Calendar('2026-08-10');
$calendar->setBusinessConfig($config);
$days = $calendar->getBusinessDaysBySpan('2026-08-31');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$jdt_end` | —  | 取得終了日 |

**Returns:** array
**Throws:**

- [Exception](../JapaneseDate/Exceptions/Exception.md)
---

### getBusinessDaysByLimit

```php
public array getBusinessDaysByLimit($lim_day)
```

[\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定を使用して指定件数の営業日を取得します。

旧来の getWorkingDayByLimit() と異なり、インスタンス個別の
[\JapaneseDate\DateBusiness](../JapaneseDate/DateBusiness.html) 設定（グローバル/デフォルト含む）を使用して
優先順位付きで営業日を判定します。

**使用例:**
```php
$config = (new DateBusiness())
    ->setClosingWeekdays([0, 6])
    ->setBypassHoliday(true)
    ->addClosingNthWeekday(3, 3, '第3水曜定休');

$calendar = new Calendar('2026-06-01');
$calendar->setBusinessConfig($config);
$days = $calendar->getBusinessDaysByLimit(10);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$lim_day` | —  | 取得件数 |

**Returns:** array
**Throws:**

- [NativeDateTimeException](../JapaneseDate/Exceptions/NativeDateTimeException.md)
---

