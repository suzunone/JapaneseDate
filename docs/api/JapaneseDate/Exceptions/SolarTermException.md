# SolarTermException

**Namespace:** `JapaneseDate\Exceptions`

class **SolarTermException** extends [Exception](../../JapaneseDate/Exceptions/Exception.md)

二十四節気に関連する例外クラス。

不正な節気コードの指定や節気計算の失敗など、
二十四節気処理に特有のエラーを表現します。

【使用例】
```php
use JapaneseDate\Exceptions\SolarTermException;

if (!isset($solarTermMap[$code])) {
    throw new SolarTermException('不正な節気コードが指定されました: ' . $code);
}
```

