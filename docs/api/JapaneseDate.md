# Namespace: JapaneseDate

## Namespaces

- [JapaneseDate\Exceptions](JapaneseDate/Exceptions.md)
- [JapaneseDate\Values](JapaneseDate/Values.md)

## Classes

| Class | Description |
|---|---|
| [CacheMode](JapaneseDate/CacheMode.md) | キャッシュ制御モードを定義する定数クラス。 |
| [Calendar](JapaneseDate/Calendar.md) | 様々な除外条件（設定）に基づいて、特定の期間や月の営業日・日付オブジェクトの配列を生成するクラス。 |
| [DateBusiness](JapaneseDate/DateBusiness.md) | 営業日カレンダーの設定を保持するバリューオブジェクトクラス。 |
| [DateInterval](JapaneseDate/DateInterval.md) | 日本暦に対応した期間（インターバル）クラス。 |
| [DatePeriod](JapaneseDate/DatePeriod.md) | 日本暦に対応した期間イテレータクラス。 |
| [DateTime](JapaneseDate/DateTime.md) | 日本の暦（国民の祝日・元号・六曜・二十四節気・旧暦）に完全対応した可変（ミュータブル）日時クラス。 |
| [DateTimeImmutable](JapaneseDate/DateTimeImmutable.md) | 日本の暦（国民の祝日・元号・六曜・二十四節気・旧暦）に完全対応した不変（イミュータブル）日時クラス。 |
| [Era](JapaneseDate/Values/Era.md) | 歴史的元号の名称・朝廷区分・有効期間を表す読み取り専用の値オブジェクト。 |

## Interfaces

| Interface | Description |
|---|---|
| _[DateTimeInterface](JapaneseDate/DateTimeInterface.md)_ | 日本の暦機能を提供する日付オブジェクト用の共通インターフェース。 |

## Exceptions

| Exception | Description |
|---|---|
| [ErrorException](JapaneseDate/Exceptions/ErrorException.md) | JapaneseDate パッケージ共通のエラー例外クラス。 |
| [Exception](JapaneseDate/Exceptions/Exception.md) | JapaneseDate パッケージ共通の汎用例外クラス。 |
| [InfiniteLoopException](JapaneseDate/Exceptions/InfiniteLoopException.md) | 営業日探索の無限ループ防止例外。 |
| [MoonAgeConvergenceException](JapaneseDate/Exceptions/MoonAgeConvergenceException.md) | 月齢収束失敗例外。 |
| [NativeDateTimeException](JapaneseDate/Exceptions/NativeDateTimeException.md) | ネイティブ DateTime および Carbon 由来の例外クラス。 |
| [SolarTermException](JapaneseDate/Exceptions/SolarTermException.md) | 二十四節気に関連する例外クラス。 |

