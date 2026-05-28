# CacheSetting

**Namespace:** `JapaneseDate\Traits`

trait **CacheSetting**

Trait CacheSetting

## Methods

| Return | Method | Description |
|---|---|---|
| void | [setCacheMode()](#setcachemode) | キャッシュモードを指定する |
| void | [setCacheFilePath()](#setcachefilepath) | キャッシュファイル保存ディレクトリをセットします |
| void | [setCacheClosure()](#setcacheclosure) | 独自キャッシュロジックのセット |

---

## Method Details

### setCacheMode

```php
static public void setCacheMode($mode)
```

キャッシュモードを指定する

指定するキャッシュモードは、{\JapaneseDate\CacheMode}参照。

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$mode` | —  | キャッシュモード |

**Returns:** void
**See also:**

- CacheMode::MODE_AUTO — 自動でキャッシュモードを選択
- CacheMode::MODE_APC — APCを使用したキャッシュ
- CacheMode::MODE_FILE — ファイルを使用したキャッシュ
- CacheMode::MODE_ORIGINAL — 独自キャッシュ
- CacheMode::MODE_NONE — キャッシュなし
---

### setCacheFilePath

```php
static public void setCacheFilePath($cache_file_path)
```

キャッシュファイル保存ディレクトリをセットします

キャッシュモードがファイル{[\JapaneseDate\CacheMode::MODE_FILE}の時に使用する、キャッシュファイル保存ディレクトリをセットします。](../../JapaneseDate/CacheMode.html)

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$cache_file_path` | —  | キャッシュファイルを保存するディレクトリ |

**Returns:** void
---

### setCacheClosure

```php
static public void setCacheClosure($function)
```

独自キャッシュロジックのセット

キャッシュモードが独自キャッシュ{[\JapaneseDate\CacheMode::MODE_ORIGINAL}の時に使用する、クロージャをセットします。

セットされるクロージャは、

mixed](../../JapaneseDate/CacheMode.html) ClosureFunction(string $key, Closure $function)

| Parameter | Type | Description |
|-----------|------|-------------|
| `$key` | **string** | キャッシュ単位の一意なキー。このキーにマッチしたキャッシュデータが有る場合は、キャッシュされたデータをreturnしてください。 |
| `$function` | **\Closure** | キャッシュされたデータが取得できない場合に実行するクロージャです。実行すれば、キャッシュするべきデータが返されます。 |

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [Closure](https://www.php.net/class.closure) | `$function` | —  | 独自キャッシュのロジックが含まれたクロージャ |

**Returns:** void
---

