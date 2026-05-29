# NativeDateTimeException

**Namespace:** `JapaneseDate\Exceptions`

class **NativeDateTimeException** extends [Exception](../../JapaneseDate/Exceptions/Exception.md)

ネイティブ DateTime および Carbon 由来の例外クラス。

PHP 組み込みの \DateTime や Carbon ライブラリが送出する例外を
JapaneseDate パッケージの例外体系でラップするために使用します。
不正な日付文字列や範囲外の日付操作など、日時解析・変換時の
エラーを表現します。

【使用例】
```php
use JapaneseDate\Exceptions\NativeDateTimeException;

try {
    // 不正な日付操作
} catch (\Exception $e) {
    throw new NativeDateTimeException($e->getMessage(), $e->getCode(), $e);
}
```

