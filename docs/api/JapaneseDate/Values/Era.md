# Era

**Namespace:** `JapaneseDate\Values`

class **Era**

歴史的元号の名称・朝廷区分・有効期間を表す読み取り専用の値オブジェクト。

{\JapaneseDate\Components\HistoricalEra} が、指定日の前後に存在する元号情報を
返す際に使用します。元号名・読み・朝廷区分は public readonly プロパティとして公開し、
開始日・終了日は magic property として clone した日付オブジェクトを返します。

開始日と終了日は、コンストラクタに渡された基準日オブジェクトと同じ可変性を保ちます。
つまり {\JapaneseDate\DateTime} を渡した場合は {\JapaneseDate\Values\startDate} と {\JapaneseDate\Values\endDate} も
{\JapaneseDate\DateTime}、{@see \JapaneseDate\DateTimeImmutable} を渡した場合は
{\JapaneseDate\DateTimeImmutable} になります。

## Properties

| Modifier | Type | Name | Description |
|---|---|---|---|
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$startDate` | 元号の開始日。 |
| public _(read-only)_ | [DateTime](../../JapaneseDate/DateTime.md)\|[DateTimeImmutable](../../JapaneseDate/DateTimeImmutable.md) | `$endDate` | 元号の終了日。 |

