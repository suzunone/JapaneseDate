# CacheMode

**Namespace:** `JapaneseDate`

class **CacheMode**

キャッシュ制御モードを定義する定数クラス。

暦の計算結果（特に計算負荷の高い旧暦や二十四節気など）をキャッシュ保持する際の
ストレージドライバや挙動を指定するための識別子を提供します。

主に {[\JapaneseDate\DateTime::setCacheMode}](../JapaneseDate/DateTime.html) などの
キャッシュ設定メソッドの引数として利用されます。

## Constants

| Modifier | Name | Description |
|---|---|---|
| public | `MODE_NONE` | Cache なし |
| public | `MODE_AUTO` | 自動的に最適なCacheモードを選択する |
| public | `MODE_APC` | APC にキャッシュする |
| public | `MODE_FILE` | ファイルにキャッシュする |
| public | `MODE_ORIGINAL` | 独自のキャッシュモード |

