# CacheSetting

**Namespace:** `JapaneseDate\Traits`

trait **CacheSetting**

キャッシュ設定メソッドを提供する Trait。

旧暦変換・祝日判定・二十四節気の計算は CPU コストが比較的高く、
高頻度に呼ばれるアプリケーションではパフォーマンス上の課題になることがあります。
このトレイトでは、計算結果をキャッシュする方式（APC・ファイル・独自実装・キャッシュなし）を
アプリケーション側から切り替える API を提供します。

**キャッシュはプロセス（リクエスト）をまたいで静的に保持されます。**
`setCacheMode()` などは呼び出した以降、同一プロセス内で次に変更されるまで有効です。

**利用可能なキャッシュモード（{\JapaneseDate\CacheMode} 参照）:**

| モード定数 | 説明 |
|---|---|
| `CacheMode::MODE_AUTO` | APC が利用可能なら APC、そうでなければオブジェクト内静的キャッシュ（デフォルト） |
| `CacheMode::MODE_APC` | APCu を使用してプロセスをまたいだキャッシュを行う |
| `CacheMode::MODE_FILE` | ファイルにキャッシュを保存する（{\JapaneseDate\Traits\setCacheFilePath()} でディレクトリを指定） |
| `CacheMode::MODE_ORIGINAL` | 独自のキャッシュロジックを使用する（{\JapaneseDate\Traits\setCacheClosure()} でクロージャを登録） |
| `CacheMode::MODE_NONE` | キャッシュを一切使用しない |

## Methods

| Return | Method | Description |
|---|---|---|
| void | [setCacheMode()](#setcachemode) | 旧暦・祝日計算に使用するキャッシュモードを設定します。 |
| void | [setCacheFilePath()](#setcachefilepath) | ファイルキャッシュの保存先ディレクトリを設定します。 |
| void | [setCacheClosure()](#setcacheclosure) | 独自キャッシュロジックを実装したクロージャを登録します。 |

---

## Method Details

### setCacheMode

```php
static public void setCacheMode($mode)
```

旧暦・祝日計算に使用するキャッシュモードを設定します。

キャッシュモードを切り替えることで、計算結果の保存方式を変更できます。
設定は静的に保持されるため、同一プロセス内では次に `setCacheMode()` が
呼ばれるまで有効です。

**使用例:**
```php
use JapaneseDate\CacheMode;
use JapaneseDate\DateTime;

// キャッシュを無効化する
DateTime::setCacheMode(CacheMode::MODE_NONE);

// APC を使用する
DateTime::setCacheMode(CacheMode::MODE_APC);
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| int | `$mode` | —  | キャッシュモードを表す定数 |

**Returns:** void
**See also:**

- CacheMode::MODE_AUTO — 自動（デフォルト）: APC が利用可能なら APC、そうでなければ静的キャッシュ
- CacheMode::MODE_APC — APCu を使用したプロセス間共有キャッシュ
- CacheMode::MODE_FILE — ファイルシステムを使用したキャッシュ
- CacheMode::MODE_ORIGINAL — 独自キャッシュロジック（{@see \JapaneseDate\Traits\setCacheClosure()} と組み合わせて使用）
- CacheMode::MODE_NONE — キャッシュ無効
---

### setCacheFilePath

```php
static public void setCacheFilePath($cache_file_path)
```

ファイルキャッシュの保存先ディレクトリを設定します。

{[\JapaneseDate\CacheMode::MODE_FILE}](../../JapaneseDate/CacheMode.html) を使用する場合に、
キャッシュファイルの保存先となるディレクトリパスを指定します。
このメソッドを呼ぶ前に `setCacheMode(CacheMode::MODE_FILE)` を
呼び出してキャッシュモードをファイルに切り替えてください。

**使用例:**
```php
use JapaneseDate\CacheMode;
use JapaneseDate\DateTime;

DateTime::setCacheMode(CacheMode::MODE_FILE);
DateTime::setCacheFilePath('/var/cache/japanesedate');
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| string | `$cache_file_path` | —  | キャッシュファイルを保存するディレクトリの絶対パス |

**Returns:** void
**See also:**

- CacheMode::MODE_FILE — ファイルキャッシュモード
---

### setCacheClosure

```php
static public void setCacheClosure($function)
```

独自キャッシュロジックを実装したクロージャを登録します。

{[\JapaneseDate\CacheMode::MODE_ORIGINAL}](../../JapaneseDate/CacheMode.html) と組み合わせて使用します。
Redis・Memcached・フレームワーク固有のキャッシュ機構など、
任意のキャッシュバックエンドを利用できます。

**クロージャのシグネチャ:**

```php
function (string $key, \Closure $function): mixed
```

| パラメータ | 型 | 説明 |
|---|---|---|
| `$key` | `string` | キャッシュエントリを一意に識別するキー文字列 |
| `$function` | `\Closure` | キャッシュミス時に呼び出す計算ロジック。実行するとキャッシュすべきデータが返る |

クロージャの実装では、`$key` に対応するキャッシュが存在すればそれを返し、
なければ `$function()` を実行してその結果をキャッシュしてから返してください。

**使用例（Laravel の Cache ファサードを利用する場合）:**
```php
use JapaneseDate\CacheMode;
use JapaneseDate\DateTime;
use Illuminate\Support\Facades\Cache;

DateTime::setCacheMode(CacheMode::MODE_ORIGINAL);
DateTime::setCacheClosure(function (string $key, \Closure $fn) {
    return Cache::remember($key, 3600, $fn);
});
```

**Parameters:**

| Type | Name | Default | Description |
|---|---|---|---|
| [Closure](https://www.php.net/class.closure) | `$function` | —  | 
`function(string $key, \Closure $function): mixed` シグネチャを持つクロージャ。
キャッシュヒット時はキャッシュ済みデータを、ミス時は計算実行結果を返す必要があります。 |

**Returns:** void
**See also:**

- CacheMode::MODE_ORIGINAL — 独自キャッシュモード
---

