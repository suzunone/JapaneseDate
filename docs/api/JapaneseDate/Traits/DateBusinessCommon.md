# DateBusinessCommon

**Namespace:** `JapaneseDate\Traits`

trait **DateBusinessCommon**

営業日カレンダー機能を各日時クラスに付与する共通Trait。

このTraitを `use` したクラスは、インスタンスごとに DateBusiness 設定を保持でき、
設定を保持していない場合は BusinessCalendar のグローバル/デフォルト設定を参照します。

**提供するインターフェイス:**
- `setBusinessConfig()` / `getBusinessConfig()` でインスタンス個別設定を操作
- `setClosingDay()`, `setOpenDay()`, `setClosingWeekdays()` などの直接設定ショートカット
- `isBusinessDay()`, `getBusinessDayLabel()` で判定

**設定の優先順位（強い順）:**
1. インスタンス個別設定（このTraitが保持）
2. グローバル設定（`BusinessCalendarManager::setGlobalConfig()` で設定）
3. デフォルト設定（土日・祝日休み）

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
| [DateBusiness](../../JapaneseDate/DateBusiness.md)\|null | `$config` | —  | インスタンスに適用する設定オブジェクト、または null（解除） |

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
---

### getBusinessConfig

```php
public DateBusiness\|null getBusinessConfig()
```

インスタンスが保持している個別の営業日設定を取得します。

個別設定を持っていない場合は `null` を返します。
判定に実際に使用される設定（グローバル/デフォルト含む解決済み設定）は
BusinessCalendar::resolveConfig() で取得できます。

**Returns:** [DateBusiness](../../JapaneseDate/DateBusiness.md)\|null — インスタンス個別設定、または null
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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
| int[] | `$weekdays` | —  | 休業曜日の配列（例: [0, 6] で日・土） |

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

**Returns:** [DateBusinessCommon](../../JapaneseDate/Traits/DateBusinessCommon.md) — メソッドチェーン用に自身を返します
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

