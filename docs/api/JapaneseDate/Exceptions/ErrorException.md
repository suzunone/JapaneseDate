# ErrorException

**Namespace:** `JapaneseDate\Exceptions`

class **ErrorException** extends [ErrorException](https://www.php.net/class.errorexception)

JapaneseDate パッケージ共通のエラー例外クラス。

PHP 組み込みの \ErrorException を継承しており、パッケージ内で
エラーレベルの例外を送出する際に使用します。

【使用例】
```php
use JapaneseDate\Exceptions\ErrorException;

throw new ErrorException('処理中にエラーが発生しました。');
```

