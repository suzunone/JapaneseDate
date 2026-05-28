# Factory

**Namespace:** `JapaneseDate\Traits`

trait **Factory**

Trait Factory

## Methods

| Return | Method | Description |
|---|---|---|
| Factory | [factory()](#factory) | DateTimeオブジェクトの生成 |

---

## Method Details

### factory

```php
static public Factory factory($date_time = null, $time_zone = null)
```

DateTimeオブジェクトの生成

日付/時刻 文字列の書式については http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式 を参考にしてください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int|float|string|[DateTimeInterface](https://www.php.net/class.datetimeinterface)|null | `$date_time` | `null` | 日付/時刻 文字列。DateTimeオブジェクト |
| [DateTimeZone](https://www.php.net/class.datetimezone)|null | `$time_zone` | `null` | DateTimeZone オブジェクトか、時差の時間、タイムゾーンテキスト(omit 予定) |

**Returns:** [Factory](../../JapaneseDate/Traits/Factory.md)
**Throws:**

- NativeDateTimeException
---

