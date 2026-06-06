## テスト方針

### 責務の分離
- **コンポーネントはコンポーネント単独でテストする**
  - `src/Components/` 配下のクラスは `tests/Tests/JapaneseDate/Components/` にテストファイルを置く
  - コンポーネントテストはそのコンポーネントの振る舞いだけを検証し、他のコンポーネントや Trait の副作用に頼らない
  - コンポーネントテストでは `DateTime` / `DateTimeImmutable` の公開メソッドやマジックプロパティを通じた Trait 経由の呼び出しを検証しない
  - コンポーネントから呼び出す Map・ValueObject など、直接の入出力に必要な協調クラスだけを検証対象に含める
- **Trait のテストは Trait の振る舞いのみ検証する**
  - `tests/Tests/JapaneseDate/Traits/` にテストファイルを置く
  - コンポーネント内部のカバレッジをここで補完しない
  - Trait が `DateTime` / `DateTimeImmutable` に mix-in される機能は、Trait 専用テストで両方のクラスから呼び出して検証する
  - Trait がマジックプロパティ経由で利用される想定を持つ場合は、メソッド呼び出しとプロパティ呼び出しの両方を Trait 専用テストで検証する

### テストファイルの namespace
- `tests/Tests/JapaneseDate/` 配下のテストは、必ず `Tests\JapaneseDate\...` namespace を使用する
- ディレクトリと namespace は PSR-4 の `autoload-dev` に合わせる
  - `tests/Tests/JapaneseDate/Components/FooTest.php` は `namespace Tests\JapaneseDate\Components;`
  - `tests/Tests/JapaneseDate/Traits/FooTraitTest.php` は `namespace Tests\JapaneseDate\Traits;`
- `Test\JapaneseDate\...` のような単数形 namespace は使用しない

### getter / マジックプロパティの検証

> **⚠️ この節のルールは過去に繰り返し漏れが発生しているため、実装完了後に必ずチェックリストとして使用すること。**

- 新しい getter や Trait メソッドを `$date->foo` / `$date->fooBar` / `$date->foo_bar` のようなマジックプロパティで利用する仕様の場合、`src/Traits/Getter.php` の `__get()` とクラス PHPDoc の `@property-read` も更新する
- `__get()` の match にはスネークケースとキャメルケースを**必ず両方**登録する（片方だけは禁止）
- マジックプロパティ対応を追加した場合は、直接メソッド呼び出しとは別にプロパティアクセスのテストを必ず追加する
- プロパティアクセスのテストでは **スネークケース・キャメルケースの両方**について、`DateTime` と `DateTimeImmutable` の各インスタンスで期待値が返ることを確認する

**実装後の必須チェックリスト（毎回確認）:**

```
[ ] Getter.php __get() に 'snake_case', 'camelCase' の2キーで登録した
[ ] Getter.php @property-read に snake_case と camelCase の両行を追記した
[ ] Trait 専用テスト（{Trait}TraitTest.php）にメソッド呼び出しのテストを追加した
[ ] Trait 専用テスト（{Trait}TraitTest.php）にキャメルケースプロパティ経由アクセスのテストを追加した
[ ] Trait 専用テスト（{Trait}TraitTest.php）にスネークケースプロパティ経由アクセスのテストを追加した
[ ] GetterTest.php にキャメルケースプロパティのテストを追加した
[ ] GetterTest.php にスネークケースプロパティのテストを追加した
```

> GetterTest.php の追加を忘れやすい。Trait 専用テストで検証済みであっても、**GetterTest.php は `Getter` トレイト自体の `__get()` dispatch を検証する独立した責務**を持つため、省略できない。

### private / protected へのアクセス
- private・protected なメソッドやプロパティにアクセスするテストは必ず `tests/Tests/JapaneseDate/InvokeTrait.php` を使用する
- テストクラス内で `ReflectionClass` を直接インスタンス化しない

```php
// 良い例
use Tests\JapaneseDate\InvokeTrait;

class FooTest extends TestCase
{
    use InvokeTrait;

    public function test_something(): void
    {
        $result = $this->invokeExecuteMethod($instance, 'privateMethod', [$arg]);
        $this->invokeSetProperty($instance, 'privateProperty', $value);
        $val = $this->invokeGetProperty($instance, 'privateProperty');
    }
}

// 悪い例（直接 ReflectionClass を使わない）
$ref  = new ReflectionClass(Foo::class);
$prop = $ref->getProperty('bar');
$prop->setValue(null, null);
```

### シングルトンの static プロパティをリセットするケース
- クラスプロパティ（`private static ?self $instance = null;`）でシングルトンを管理している場合は `invokeSetProperty` でリセットできる

```php
// static クラスプロパティのリセット（InvokeTrait 経由）
$this->invokeSetProperty(FooCalculator::class, 'instance', null);
```

- メソッド内 static 変数（`static $instance;`）でシングルトンを管理している場合は外部からリセット不可のため、リセットしないでシングルトン動作のみを確認する

### カバレッジ
- **C0（命令網羅）カバレッジ 100%** を各コンポーネントのテストで達成する
- 新設 Trait は専用テストで C0（命令網羅）カバレッジ 100% を達成する
- 分岐が存在するメソッドはすべての分岐を通過するテストケースを用意する
- `fetchSolarTermDate` のような try-catch フォールバックも catch ブロックを必ずカバーする
- PHPUnit の `#[CoversClass]` / `#[CoversTrait]` / `#[CoversMethod]` は、テスト対象の責務に合わせて過不足なく付与する
- コンポーネントテストに Trait の `#[CoversTrait]` を混ぜたり、Trait テストにコンポーネントの C0 補完を目的とした `#[CoversClass]` を混ぜたりしない

### テストの副作用禁止
- あるテストが別のクラス・コンポーネントのカバレッジを「副作用として」補完することを禁止する
- static プロパティをリセットした場合は、テスト終了後に必ず元の状態（`null`）に戻す

### テスト実行コマンド
- テストの実行には **`paratest`** を使用する（`vendor/bin/paratest`）
- 単一ファイル・単一テストを実行する場合も `paratest` を使用すること
- 全体テストを実行する場合は、原則として **`large` グループのテストを除外**して実行する

```bash
# 全体テスト（large を除外）
vendor/bin/paratest --exclude-group large

# 特定ファイルのみ
vendor/bin/paratest tests/Tests/JapaneseDate/Traits/FooTraitTest.php
```

- `large` グループのテストが必要な場合は、その理由を明示した上でユーザーに確認を取るか、別途明示的に実行する

### 実装後の確認
- 新規・修正したテストファイルは単体で実行し、対象テストが期待通り通ることを確認する
- 全体実行が時間・環境の都合でできない場合は、その理由と未確認範囲を作業結果に明記する

---
