# Factory

**Namespace:** `JapaneseDate\Traits`

trait **Factory**

JapaneseDate\DateTime / DateTimeImmutable のインスタンス生成を担うファクトリトレイト。

Carbon の `parse()` メソッドは文字列しか受け付けないため、
Unix タイムスタンプ・`DateTimeInterface` オブジェクトを渡した場合に
正しく動作しないことがあります。このトレイトが提供する {\JapaneseDate\Traits\factory()} は
以下の型すべてを安全に受け付け、適切な方法でインスタンスを生成します。

- `int` / `float`: Unix タイムスタンプとして解釈
- `DateTimeInterface`: 書式文字列経由でコピーを生成
- `string`（数字のみ）: `strtotime()` でパースを試みてタイムスタンプとして解釈
- `string`（その他）: Carbon のコンストラクタに委譲
- `null`: 現在時刻を使用

## Methods

| Return | Method | Description |
|---|---|---|
| Factory | [factory()](#factory) | 多様な型の引数から {\JapaneseDate\DateTime} / {\JapaneseDate\DateTimeImmutable}
インスタンスを生成するユニバーサルファクトリメソッドです。 |

---

## Method Details

### factory

```php
static public Factory factory($date_time = null, $time_zone = null)
```

多様な型の引数から {\JapaneseDate\DateTime} / {\JapaneseDate\DateTimeImmutable}
インスタンスを生成するユニバーサルファクトリメソッドです。

Carbon の `parse()` や `new DateTime()` は第一引数に文字列しか受け付けませんが、
このメソッドは以下のすべての型を安全に受け付けます。

**引数の型別動作:**

| 型 | 動作 |
|---|---|
| `int` / `float` | Unix タイムスタンプとして解釈し `@timestamp` 形式でインスタンス化 |
| `DateTimeInterface` | `Y-m-d H:i:s` 形式に変換してからインスタンス化 |
| 数字のみの `string` | `strtotime()` でパースを試み、成功すればタイムスタンプとして処理 |
| その他の `string` | Carbon のコンストラクタに直接委譲（相対表現・絶対表現に対応） |
| `null` | 現在日時を使用（`new static()` と同等） |

**使用例:**

```php
// Unix タイムスタンプから生成する
$dt = DateTime::factory(1609459200);

// 既存の DateTimeInterface オブジェクトから生成する
$dt = DateTime::factory(new \DateTime('2026-05-01'));

// 日時文字列から生成する（Carbon::parse() と同等）
$dt = DateTime::factory('2026-05-01 12:34:56');

// タイムゾーンを指定して生成する
$dt = DateTime::factory('now', new \DateTimeZone('Asia/Tokyo'));
```

日付/時刻 文字列の書式については
http://php.net/manual/ja/datetime.formats.php サポートする日付と時刻の書式
を参照してください。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int\|float\|string\|[DateTimeInterface](https://www.php.net/class.datetimeinterface)\|null | `$date_time` | `null` | 
生成元となる日時値。Unix タイムスタンプ（int/float）、
{\DateTimeInterface} の実装オブジェクト、
日時文字列（相対・絶対の両方に対応）、または null（現在日時）を渡せます。 |
| [DateTimeZone](https://www.php.net/class.datetimezone)\|null | `$time_zone` | `null` | 
使用するタイムゾーン。省略した場合は $date_time が保持するタイムゾーンか、
PHP のデフォルトタイムゾーンが使用されます。 |

**Returns:** [Factory](../../JapaneseDate/Traits/Factory.md) — 指定した日時を表す新しいインスタンス
**Throws:**

- [NativeDateTimeException](../../JapaneseDate/Exceptions/NativeDateTimeException.md)
---

