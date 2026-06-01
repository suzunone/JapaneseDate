## Carbon 3 から Carbon 2 へのダウングレード時の対応

Carbon 2 の `Carbon\Carbon::add()` は、引数型と戻り値型を宣言しない。

```php
public function add($unit, $value = 1, $overflow = null)
```

そのため、`DateTime` / `Carbon` を継承したテスト用クラスで `add()` をオーバーライドしている場合は、
Carbon 2 のシグネチャに合わせる。

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

修正後は該当テストを実行する。

```bash
vendor/bin/phpunit --filter CalendarTest
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

