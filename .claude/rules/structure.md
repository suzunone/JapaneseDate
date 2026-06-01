
## ファイル配置

```
src/
  Components/              ← 計算・変換ロジック（コンポーネント）
  Traits/
    Component.php          ← コンポーネントのプロパティ宣言
    DateTimeImport.php     ← 全 Trait の use をまとめる集約ファイル
    Modern.php             ← 小規模な getter の実装（既存機能）
    Modifier.php           ← 小規模な日付移動メソッド（既存機能）
    FindSolarTerm.php      ← 二十四節気日付取得メソッド
    Getter.php             ← __get マジックメソッドとプロパティドキュメント
    SeventyTwoKou.php      ← 七十二候 getter・移動メソッド（新設 Trait の例）
    {NewFeature}.php       ← 機能単位で新設する Trait（4 メソッド超が目安）
  DateTime.php             ← 定数定義・コンストラクタ
  DateTimeImmutable.php    ← 定数定義・コンストラクタ

tests/
  Tests/JapaneseDate/
    Components/            ← コンポーネント単独テスト（C0 100%）
    Traits/
      SeventyTwoKouTraitTest.php   ← 新設 Trait の専用テスト（例）
      {NewFeature}TraitTest.php    ← 新設 Trait ごとに作成
    InvokeTrait.php        ← private/protected アクセス用トレイト
```
