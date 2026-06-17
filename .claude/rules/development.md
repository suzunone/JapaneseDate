## 実装方針

### 変数の命名規約

- `stdClass` や `Collection` などの汎用オブジェクトを除き、オブジェクトを格納する変数名はクラス名と同じパスカルケースにする
  - 例: `DateTimeZone` のインスタンスは `$DateTimeZone`
- 同じクラスのオブジェクトを複数扱う場合は、「説明 + クラス名」をパスカルケースで命名する
  - 例: `$DefaultDateTimeZone`、`$EraDateTimeZone`
- `stdClass` や `Collection` などの汎用オブジェクトを格納する場合は、「説明 + クラス名」をパスカルケースで命名する
  - 例: `$HolidayCollection`、`$ConfigStdClass`
- メソッドなどの返り値を格納する変数、または `null` の可能性がある引数や変数にオブジェクトが入る場合も、「説明 + クラス名」をパスカルケースで命名する
  - 例: `$ResultDateTime`、`$DisplayDateTimeZone`
- 上記以外の変数はスネークケースで命名する
  - 例: `$is_japanese_date`、`$check_time`
- 略語などは用いず意味のある単語にする
- InterfaceはそのInterfaceを実装したクラスのクラス名
  - 複数ある場合は一番短い名前のクラス名を採用する

### 変更スコープの原則
- **コードの修正は最小限にとどめる**。タスクに直接関係しない箇所には手を入れない
- リファクタリング・命名変更・構造整理など、タスクのスコープを超える変更を行う場合は、**事前にユーザーへ確認**を取る
- 既存の動作に影響する可能性がある変更（共通処理・基底クラス・Map・定数など）も、同様に確認を取ること

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

### 動的メソッド呼び出しの禁止

`->{$method}()` のような動的メソッド呼び出しは使用しない。

呼び出し先のメソッド名が文字列変数で渡される場合は、`match` 式で明示的に分岐すること。

```php
// 悪い例: 動的呼び出し
$obj->{$method}($year);

// 良い例: match で明示的に分岐
match ($method) {
    'foo' => $obj->foo($year),
    'bar' => $obj->bar($year),
};
```

対象のメソッドが増えた場合も、`match` に追記する形で対応する。

### アクセス権
テストのしやすさを考慮してprivateは使わず、protectedかpublicを用いる


### PHPDoc
- すべての新規メソッド・プロパティに日本語で詳細な PHPDoc を記述する
- `@param`・`@return` の型は正確に記載する
- `doctum` でドキュメントが完全に生成されることを確認する

### 定数命名
- 定数は `UPPER_SNAKE_CASE` で命名し、クラス内にまとめて定義する
- `src/DateTime.php` と `src/DateTimeImmutable.php` の両方に同値の定数を定義する

---
