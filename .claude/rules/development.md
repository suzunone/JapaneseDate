## 実装方針

### 変更禁止ファイル
- `src/Calendar.php` は変更しない（歴史的経緯を含む共通処理）

### 新機能追加の手順
1. `src/Components/` に計算ロジックを持つコンポーネントを追加する
2. `src/Traits/Component.php` にプロパティ宣言を追加する
3. `src/DateTime.php` と `src/DateTimeImmutable.php` のコンストラクタでコンポーネントを初期化する
4. `src/Traits/Modern.php` に getter メソッドを追加する
5. `src/Traits/Getter.php` の `__get` とクラスドキュメントに追記する
6. 必要に応じて `src/Traits/Modifier.php` に移動メソッドを追加する

### Trait の新設ルール
追加するメソッドが多く（目安: getter + modifier 合わせて 4 メソッド超）、機能として独立している場合は `Modern.php` / `Modifier.php` に直接追加せず、**専用の Trait ファイルを新設**する。

**手順:**
1. `src/Traits/` に新しい Trait ファイルを作成する（例: `SeventyTwoKou.php`）
   - getter（protected）と移動メソッド（public）をまとめて定義する
   - ファイル・クラスに日本語 PHPDoc を付与する
   - `@mixin \JapaneseDate\DateTime` と `@mixin \JapaneseDate\DateTimeImmutable` を記載する
2. `src/Traits/DateTimeImport.php` に `use NewTrait;` を追記する
   - 追記位置: `FindSolarTerm` と `Getter` の間
3. テストは `tests/Tests/JapaneseDate/Traits/` に **新設 Trait 専用のテストファイル** を作成する
   - ファイル名: `{TraitName}TraitTest.php`（例: `SeventyTwoKouTraitTest.php`）
   - protected メソッドは `InvokeTrait` 経由で呼び出す
   - `#[CoversTrait]` と `#[CoversMethod]` を新 Trait に対して宣言する
   - Trait 単独で **C0 カバレッジ 100%** を達成する
   - 複数条件でのテストが必要な場合は、DataProvider を活用してテストケースを整理する
4. 必要に応じてカバレッジc0 100％だけでなく、以下の条件も満たすようにする
   - 分岐が存在するメソッドはすべての分岐を通過するテストケースを用意する
   - 例外が発生する可能性のあるメソッドは、例外が発生するケースもカバーする
   - 境界値が存在するメソッドは、境界値を含むテストケースを用意する

```php
// 良い例: Trait 専用テストの構造
#[CoversTrait(\JapaneseDate\Traits\NewFeature::class)]
#[CoversMethod(\JapaneseDate\Traits\NewFeature::class, 'getNewFeature')]
#[CoversMethod(\JapaneseDate\Traits\NewFeature::class, 'nextNewFeature')]
class NewFeatureTraitTest extends TestCase
{
    use InvokeTrait;

    public function test_getNewFeature_protected(): void
    {
        $dt     = new DateTime('2025-01-01');
        $result = $this->invokeExecuteMethod($dt, 'getNewFeature', []);
        $this->assertSame($expected, $result);
    }

    public function test_nextNewFeature_public(): void
    {
        $dt   = new DateTimeImmutable('2025-01-01');
        $next = $dt->nextNewFeature();
        $this->assertInstanceOf(DateTimeImmutable::class, $next);
    }
}
```

### Getter.php へのプロパティ公開ルール

`src/Traits/Getter.php` の `__get()` にプロパティを追加するときは、**スネークケースとキャメルケースの両方**を必ず登録する。

```php
// 良い例: 両ケースを同時に登録
'snake_case_name', 'camelCaseName'  => $this->getSomething(),

// 悪い例: キャメルケースのみ
'camelCaseName'                     => $this->getSomething(),
```

`@property-read` PHPDoc も同様に両ケース分を記載する:

```php
 * @property-read Type $snake_case_name 説明（スネークケース）。
 * @property-read Type $camelCaseName 説明。
```

テストでもスネークケース・キャメルケースの両プロパティアクセスを検証すること。

### PHPDoc
- すべての新規メソッド・プロパティに日本語で詳細な PHPDoc を記述する
- `@param`・`@return` の型は正確に記載する
- `doctum` でドキュメントが完全に生成されることを確認する

### 定数命名
- 定数は `UPPER_SNAKE_CASE` で命名し、クラス内にまとめて定義する
- `src/DateTime.php` と `src/DateTimeImmutable.php` の両方に同値の定数を定義する

---
