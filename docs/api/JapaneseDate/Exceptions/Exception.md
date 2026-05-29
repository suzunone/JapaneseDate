# Exception

**Namespace:** `JapaneseDate\Exceptions`

class **Exception** extends [Exception](https://www.php.net/class.exception)

JapaneseDate パッケージ共通の汎用例外クラス。

パッケージ内で発生する一般的な例外の基底クラスです。
個別の例外クラスはこのクラスを継承して定義します。

【使用例】
```php
use JapaneseDate\Exceptions\Exception;

throw new Exception('エラーが発生しました。');
```

