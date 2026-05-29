# Business

**Namespace:** `JapaneseDate\Traits`

trait **Business**

## Methods

| Return | Method | Description |
|---|---|---|
| bool | [isBusinessDay()](#isbusinessday) | このインスタンスの日付が営業日かどうかを判定します。 |
| string\|null | [getBusinessDayLabel()](#getbusinessdaylabel) | このインスタンスの日付が休業日の場合、そのラベルを返します。 |
| Business | [nextBusinessDay()](#nextbusinessday) | 次の営業日を取得します。 |
| Business | [previousBusinessDay()](#previousbusinessday) | 前の営業日を取得します。 |
| Business | [shiftToClosestBusinessDayAfter()](#shifttoclosestbusinessdayafter) | この日が休業日の場合、翌営業日にシフトしたインスタンスを返します。 |
| Business | [shiftToClosestBusinessDayBefore()](#shifttoclosestbusinessdaybefore) | この日が休業日の場合、前営業日にシフトしたインスタンスを返します。 |
| Business | [addBusinessDays()](#addbusinessdays) | 指定した営業日数後の日付を返します。 |
| Business | [subBusinessDays()](#subbusinessdays) | 指定した営業日数前の日付を返します。 |

---

## Method Details

### isBusinessDay

```php
public bool isBusinessDay()
```

このインスタンスの日付が営業日かどうかを判定します。

適用されているカレンダー設定（インスタンス個別 > グローバル > デフォルト）に基づいて判定します。

**Returns:** bool — 営業日であれば true、休業日であれば false
---

### getBusinessDayLabel

```php
public string\|null getBusinessDayLabel()
```

このインスタンスの日付が休業日の場合、そのラベルを返します。

営業日の場合は null を返します。

**Returns:** string\|null — 休業ラベル、または null
---

### nextBusinessDay

```php
public Business nextBusinessDay()
```

次の営業日を取得します。

翌日から順に走査し、最初に見つかった営業日を返します。

**Returns:** [Business](../../JapaneseDate/Traits/Business.md) — 次の営業日を表すインスタンス
---

### previousBusinessDay

```php
public Business previousBusinessDay()
```

前の営業日を取得します。

前日から順に走査し、最初に見つかった営業日を返します。

**Returns:** [Business](../../JapaneseDate/Traits/Business.md) — 前の営業日を表すインスタンス
---

### shiftToClosestBusinessDayAfter

```php
public Business shiftToClosestBusinessDayAfter()
```

この日が休業日の場合、翌営業日にシフトしたインスタンスを返します。

営業日の場合はそのまま自身を返します。

**Returns:** [Business](../../JapaneseDate/Traits/Business.md) — この日または翌以降の直近営業日を表すインスタンス
---

### shiftToClosestBusinessDayBefore

```php
public Business shiftToClosestBusinessDayBefore()
```

この日が休業日の場合、前営業日にシフトしたインスタンスを返します。

営業日の場合はそのまま自身を返します。

**Returns:** [Business](../../JapaneseDate/Traits/Business.md) — この日または前以前の直近営業日を表すインスタンス
---

### addBusinessDays

```php
public Business addBusinessDays($days)
```

指定した営業日数後の日付を返します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$days` | —  | 加算する営業日数（正の整数） |

**Returns:** [Business](../../JapaneseDate/Traits/Business.md) — N営業日後を表すインスタンス
---

### subBusinessDays

```php
public Business subBusinessDays($days)
```

指定した営業日数前の日付を返します。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$days` | —  | 減算する営業日数（正の整数） |

**Returns:** [Business](../../JapaneseDate/Traits/Business.md) — N営業日前を表すインスタンス
---

