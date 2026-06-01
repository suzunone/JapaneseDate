# DateBusiness

**Namespace:** `JapaneseDate`

class **DateBusiness**

営業日カレンダーの設定を保持するバリューオブジェクトクラス。

このクラスは、企業独自の営業日ルールを「何をどの優先度で適用するか」
という観点でまとめて管理します。設定はすべてメソッドチェーン（Fluent Interface）
で記述でき、生成したオブジェクトを \JapaneseDate\Components\BusinessCalendar
に渡すことで判定ロジックが動作します。

**判定の優先順位（下ほど強い）:**
1. 曜日設定（closingWeekdays）
2. 祝日設定（bypassHoliday）
3. 第XX曜日 営業指定（openNthWeekdays）
4. 第XX曜日 休業指定（closingNthWeekdays）
5. 特定日 営業指定（openDates）
6. 特定日 休業指定（closingDates）
7. 営業指定フィルタ（openFilters）
8. 休業指定フィルタ（closingFilters）
9. マクロ（macro）

**使用例:**
```php
use JapaneseDate\DateBusiness;

$config = (new DateBusiness())
    ->setClosingWeekdays([6, 0])           // 土日休み
    ->setBypassHoliday(true)               // 祝日休み
    ->addClosingDate('2026-08-15', '夏期休暇')
    ->addOpenDate('2026-12-30')            // 特別営業日
    ->addClosingFilter(
        fn(\DateTimeInterface $d) => $d->format('md') === '1231',
        '大晦日休業'
    );
```

## Methods

| Return | Method | Description |
|---|---|---|
| DateBusiness | [setClosingWeekdays()](#setclosingweekdays) | 休業曜日を一括設定します。 |
| DateBusiness | [addClosingWeekday()](#addclosingweekday) | 休業曜日を1件追加します。 |
| DateBusiness | [removeClosingWeekday()](#removeclosingweekday) | 休業曜日の設定を削除します。 |
| DateBusiness | [setBypassHoliday()](#setbypassholiday) | 祝日を休業日として扱うかどうかを設定します。 |
| DateBusiness | [addOpenNthWeekday()](#addopennthweekday) | 第XX曜日を営業日として指定します（曜日設定・祝日設定より優先）。 |
| DateBusiness | [removeOpenNthWeekday()](#removeopennthweekday) | 第XX曜日の営業指定を削除します。 |
| DateBusiness | [addClosingNthWeekday()](#addclosingnthweekday) | 第XX曜日を休業日として指定します（営業指定より優先）。 |
| DateBusiness | [removeClosingNthWeekday()](#removeclosingnthweekday) | 第XX曜日の休業指定を削除します。 |
| DateBusiness | [addOpenDate()](#addopendate) | 特定の日付を営業日として指定します（休業日設定より優先）。 |
| DateBusiness | [removeOpenDate()](#removeopendate) | 特定日の営業指定を削除します。 |
| DateBusiness | [addClosingDate()](#addclosingdate) | 特定の日付を休業日として指定します（営業指定より優先）。 |
| DateBusiness | [removeClosingDate()](#removeclosingdate) | 特定日の休業指定を削除します。 |
| DateBusiness | [addOpenFilter()](#addopenfilter) | 営業指定フィルタを追加します（優先度7）。 |
| DateBusiness | [addClosingFilter()](#addclosingfilter) | 休業指定フィルタを追加します（優先度8）。 |
| DateBusiness | [setMacro()](#setmacro) | 判定ロジックを完全に上書きするマクロを設定します（優先度9・最高）。 |
| DateBusiness | [reset()](#reset) | すべての設定をリセットしてデフォルト状態（土日休み・祝日休み）に戻します。 |
| array | [getClosingWeekdays()](#getclosingweekdays) | 休業曜日の設定を取得します。 |
| bool | [isBypassHoliday()](#isbypassholiday) | 祝日を休業日とするかどうかを取得します。 |
| array | [getOpenNthWeekdays()](#getopennthweekdays) | 第XX曜日 営業指定の設定を取得します。 |
| array | [getClosingNthWeekdays()](#getclosingnthweekdays) | 第XX曜日 休業指定の設定を取得します。 |
| array | [getOpenDates()](#getopendates) | 特定日 営業指定の設定を取得します。 |
| array | [getClosingDates()](#getclosingdates) | 特定日 休業指定の設定を取得します。 |
| array | [getOpenFilters()](#getopenfilters) | 営業指定フィルタの一覧を取得します。 |
| array | [getClosingFilters()](#getclosingfilters) | 休業指定フィルタの一覧を取得します。 |
| callable\|null | [getMacro()](#getmacro) | マクロを取得します。 |

---

## Method Details

### setClosingWeekdays

```php
public DateBusiness setClosingWeekdays($weekdays)
```

休業曜日を一括設定します。

0（日曜）〜 6（土曜）の整数配列で指定します。
既存の設定を上書きします。

**使用例:**
```php
$config->setClosingWeekdays([0, 6]); // 日曜・土曜を休業に
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int[] | `$weekdays` | —  | 休業曜日の配列（例: [0, 6] で日・土） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### addClosingWeekday

```php
public DateBusiness addClosingWeekday($weekday)
```

休業曜日を1件追加します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### removeClosingWeekday

```php
public DateBusiness removeClosingWeekday($weekday)
```

休業曜日の設定を削除します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### setBypassHoliday

```php
public DateBusiness setBypassHoliday($bypass)
```

祝日を休業日として扱うかどうかを設定します。

デフォルトは `true`（祝日を休業日とする）です。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| bool | `$bypass` | —  | true の場合、祝日を休業日とする |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### addOpenNthWeekday

```php
public DateBusiness addOpenNthWeekday($weekday, $nth)
```

第XX曜日を営業日として指定します（曜日設定・祝日設定より優先）。

例：第2土曜日を営業日にする場合は `addOpenNthWeekday(6, 2)` とします。

**使用例:**
```php
$config->addOpenNthWeekday(6, 2); // 第2土曜日は営業
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### removeOpenNthWeekday

```php
public DateBusiness removeOpenNthWeekday($weekday, $nth)
```

第XX曜日の営業指定を削除します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### addClosingNthWeekday

```php
public DateBusiness addClosingNthWeekday($weekday, $nth, $label = null)
```

第XX曜日を休業日として指定します（営業指定より優先）。

例：第3水曜日を定休日にする場合は `addClosingNthWeekday(3, 3, '定休日')` とします。

**使用例:**
```php
$config->addClosingNthWeekday(3, 3, '定休日'); // 第3水曜日は休業
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |
| string\|null | `$label` | `null` | 休業ラベル（例: '定休日'） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### removeClosingNthWeekday

```php
public DateBusiness removeClosingNthWeekday($weekday, $nth)
```

第XX曜日の休業指定を削除します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$weekday` | —  | 曜日（0=日曜〜6=土曜） |
| int | `$nth` | —  | 第何曜日か（1〜5） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### addOpenDate

```php
public DateBusiness addOpenDate($date)
```

特定の日付を営業日として指定します（休業日設定より優先）。

日付文字列は `Y-m-d` 形式（例: `'2026-12-30'`）を推奨します。

**使用例:**
```php
$config->addOpenDate('2026-12-30'); // 2026年12月30日は特別営業
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 営業日として指定する日付 |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### removeOpenDate

```php
public DateBusiness removeOpenDate($date)
```

特定日の営業指定を削除します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 削除する日付 |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### addClosingDate

```php
public DateBusiness addClosingDate($date, $label = null)
```

特定の日付を休業日として指定します（営業指定より優先）。

日付文字列は `Y-m-d` 形式を推奨します。
オプションでラベル（例: '夏期休暇'）を付与できます。

**使用例:**
```php
$config->addClosingDate('2026-08-15', '夏期休暇');
$config->addClosingDate('2026-12-31', '年末休業');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 休業日として指定する日付 |
| string\|null | `$label` | `null` | 休業理由のラベル（例: '夏期休暇'） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### removeClosingDate

```php
public DateBusiness removeClosingDate($date)
```

特定日の休業指定を削除します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface) | `$date` | —  | 削除する日付 |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
**Throws:**

- [Exception](https://www.php.net/class.exception)
---

### addOpenFilter

```php
public DateBusiness addOpenFilter($filter)
```

営業指定フィルタを追加します（優先度7）。

フィルタは `fn(\DateTimeInterface $date): bool` の形式で、
`true` を返した場合にその日を営業日とします。
複数登録した場合、いずれかが `true` を返せば営業日として扱われます。

**使用例:**
```php
// 毎月10日は営業
$config->addOpenFilter(fn(\DateTimeInterface $d) => $d->format('d') === '10');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$filter` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### addClosingFilter

```php
public DateBusiness addClosingFilter($filter, $label = null)
```

休業指定フィルタを追加します（優先度8）。

フィルタは `fn(\DateTimeInterface $date): bool` の形式で、
`true` を返した場合にその日を休業日とします。
オプションでラベルを付与できます。

**使用例:**
```php
// 毎月最終日曜日は休業
$config->addClosingFilter(
    fn(\DateTimeInterface $d) => $d->format('N') === '7' &&
        (int)$d->format('d') > (int)(new \DateTime('+7 days', new \DateTimeZone($d->format('e'))))->format('d'),
    '月末休業'
);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable | `$filter` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック |
| string\|null | `$label` | `null` | 休業理由のラベル（例: '月末休業'） |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### setMacro

```php
public DateBusiness setMacro($macro)
```

判定ロジックを完全に上書きするマクロを設定します（優先度9・最高）。

マクロは `fn(\DateTimeInterface $date): bool` の形式で、
`true` を返した場合にその日を営業日、`false` を返した場合に休業日と判定します。
設定されたマクロは他のすべての設定より優先されます。
`null` を渡すとマクロを解除します。

**使用例:**
```php
// 月〜木のみ営業という完全カスタムロジック
$config->setMacro(fn(\DateTimeInterface $d) => in_array((int)$d->format('N'), [1,2,3,4]));
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| callable\|null | `$macro` | —  | `fn(\DateTimeInterface $date): bool` 形式のコールバック、または null |

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### reset

```php
public DateBusiness reset()
```

すべての設定をリセットしてデフォルト状態（土日休み・祝日休み）に戻します。

**Returns:** [DateBusiness](../JapaneseDate/DateBusiness.md) — メソッドチェーン用に自身を返します
---

### getClosingWeekdays

```php
public array getClosingWeekdays()
```

休業曜日の設定を取得します。

**Returns:** array
---

### isBypassHoliday

```php
public bool isBypassHoliday()
```

祝日を休業日とするかどうかを取得します。

**Returns:** bool
---

### getOpenNthWeekdays

```php
public array getOpenNthWeekdays()
```

第XX曜日 営業指定の設定を取得します。

**Returns:** array
---

### getClosingNthWeekdays

```php
public array getClosingNthWeekdays()
```

第XX曜日 休業指定の設定を取得します。

**Returns:** array
---

### getOpenDates

```php
public array getOpenDates()
```

特定日 営業指定の設定を取得します。

**Returns:** array
---

### getClosingDates

```php
public array getClosingDates()
```

特定日 休業指定の設定を取得します。

**Returns:** array
---

### getOpenFilters

```php
public array getOpenFilters()
```

営業指定フィルタの一覧を取得します。

**Returns:** array
---

### getClosingFilters

```php
public array getClosingFilters()
```

休業指定フィルタの一覧を取得します。

**Returns:** array
---

### getMacro

```php
public callable\|null getMacro()
```

マクロを取得します。

**Returns:** callable\|null
---

