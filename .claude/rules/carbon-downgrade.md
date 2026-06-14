## Carbon 3 から Carbon 2 へのダウングレード時の対応

Carbon 2 の `Carbon\Carbon::add()` は、引数型と戻り値型を宣言しない。

```php
public function add($unit, $value = 1, $overflow = null)
```

そのため、`DateTime` / `Carbon` を継承したテスト用クラスで `add()` をオーバーライドしている場合は、
すべて Carbon 2 のシグネチャに合わせる。`CalendarTest` 以外のテスト補助クラスにも同様の
オーバーライドが存在する可能性があるため、リポジトリ全体を検索する。

```bash
rg -n 'function add\(' src tests --glob '*.php'
```

今回の修正例:

```php
class ThrowingDateTime extends DateTime
{
    #[ReturnTypeWillChange]
    public function add($unit, $value = 1, $overflow = null)
    {
        throw new Exception('DateTime add failed.');
    }
}
```

`?bool $overflow` や `: static` は付けない。

## `__get()` のシグネチャ対応

Carbon 2 の `Carbon\Carbon::__get()` も、引数型と戻り値型を宣言しない。

```php
public function __get($name)
```

Carbon を継承するクラスへ取り込まれる Trait で `__get()` を実装している場合、
`string $name` や `: mixed` を付けると、クラス読み込み時に互換性エラーが発生する。

```text
Declaration of ...::__get(string $name): mixed must be compatible with Carbon\Carbon::__get($name)
```

Carbon 2 のシグネチャに合わせ、必要な型情報は PHPDoc に残す。

```php
#[ReturnTypeWillChange]
public function __get($name)
{
    // ...
}
```

修正後はクラスを直接読み込めることも確認する。

```bash
php -r "require 'vendor/autoload.php'; new JapaneseDate\\DateTime(); new JapaneseDate\\DateTimeImmutable();"
```

## 修正後のテスト

テストはプロジェクト規約に従い `paratest` で実行する。まず修正したファイルを個別実行し、
共通 Trait を変更した場合でも、全体テストはユーザーから明示的な許可を得てから実行する。
許可を得る前に全体テストを開始してはならない。

```bash
vendor/bin/paratest tests/Tests/JapaneseDate/CalendarTest.php
vendor/bin/paratest tests/Tests/JapaneseDate/Traits/DateBusinessCommonCalendarTest.php
vendor/bin/paratest tests/Tests/JapaneseDate/Traits/GetterTest.php
```

全体テストの実行許可を得た場合:

```bash
vendor/bin/paratest --exclude-group large --exclude-group long-running
```

`paratest` の worker がクラッシュする一方、同じ対象を `phpunit` で実行すると正常に完了する場合がある。
その場合は worker クラッシュをテスト失敗と混同せず、対象テストを `phpunit` で再実行して結果を確認する。
ただし、全体テストを `phpunit` で再実行する場合も事前にユーザーの許可を得る。

```bash
vendor/bin/phpunit --configuration phpunit.coverage.xml tests/Tests/JapaneseDate/Traits/FindSolarTermTest.php
```

インストール済みの Carbon が 2 系であることも確認する。

```bash
composer show nesbot/carbon
```

## マージ由来の重複テストへの対応

全体テストの収集時に次のエラーが発生した場合は、マージによって同名のテストメソッドが
重複していないか確認する。

```text
Cannot redeclare ...Test::test_...
```

同名メソッドの内容を比較し、同じ条件と処理を検証している場合は、アサーションがより充実した
一方を残して重複した方を削除する。名前だけを変更して同じテストを2件残さない。

今回、重複が確認されたファイル:

```bash
vendor/bin/paratest tests/Tests/JapaneseDate/DateIntervalTest.php
vendor/bin/paratest tests/Tests/JapaneseDate/DatePeriodTest.php
vendor/bin/paratest tests/Tests/JapaneseDate/Traits/FindSolarTermTest.php
```

修正後は対象ファイルを単独実行する。全体テストで別の重複が残っていないか確認する場合は、
必ずユーザーから実行許可を得る。

## PHP 8.5 でのテスト補助クラスの戻り値型

PHP 8.5 では、`DateTimeImmutable::getTimezone()` をオーバーライドするテスト補助クラスの
戻り値型が親メソッドと一致しない場合、非推奨警告が発生する。

```text
Return type of ...::getTimezone(): DateTimeZone|bool should either be compatible with
DateTimeImmutable::getTimezone(): DateTimeZone|false
```

`false` を返すテスト補助クラスでは、広い `bool` ではなく親メソッドと互換な
`DateTimeZone|false` を宣言する。

```php
class FalseTimezoneDate extends DateTimeImmutable
{
    public function getTimezone(): DateTimeZone|false
    {
        return false;
    }
}
```

## doctum でのドキュメント生成エラー対応

Carbon の vendor ファイル（例: `CarbonPeriod.php`）に `...$arguments` バリアディックパラメータの `@param` タグが欠落しているメソッドが存在し、doctum 実行時に以下のようなエラーが発生する場合がある。

```
ERROR: The "arguments" parameter of the method "follows" is missing a @param tag on "Carbon\CarbonPeriod::follows"
```

vendor ファイルは変更・コピー禁止のため、`doc.sh` の doctum コマンドに `--ignore-parse-errors` を付与して対処する。

```bash
./doctum.phar update doctum.php -vvv --force --ignore-parse-errors
./doctum.phar update doctum-md.php -vvv --force --ignore-parse-errors
```
