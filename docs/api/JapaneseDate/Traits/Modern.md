# Modern

**Namespace:** `JapaneseDate\Traits`

trait **Modern**

近代日本の暦体系に関する内部計算ロジックをまとめた Trait。

このトレイトは {\JapaneseDate\DateTime} および
{\JapaneseDate\DateTimeImmutable} に mix-in されており、
外部から直接呼ばれることはありません。
各 `protected` メソッドは {\JapaneseDate\Traits\Getter} の
マジックゲッター経由でプロパティとして公開されます。

**実装している計算カテゴリ**
- 十二支（oriental zodiac）: 年単位の十二支キーおよびテキスト
- 十干（heavenly stem）: 年単位の十干キーおよびテキスト
- 祝日・休日: 国民の祝日法に基づく判定
- 曜日テキスト: 日本語曜日名
- 月テキスト: 日本語月名
- 元号: 明治〜令和の元号名・元号年

