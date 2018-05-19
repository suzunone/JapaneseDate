はじめに
=====================================
__JapaneseDate\DateTime__ クラスは、[Carbon](https://carbon.nesbot.com/docs/)継承しており、
CarbonはPHP [DateTime](http://php.net/manual/ja/class.datetime.php)クラスを継承しています。

```DateTime.php
<?php
namespace JapaneseDate;

class DateTime extends \Carbon\Carbon
{

}
```

```Carbon.php
<?php
namespace Carbon;

class Carbon extends \DateTime
{

}
```

新しい__JapaneseDate\DateTime__ では、DateTimeクラスに存在する機能、Carbonクラスに存在する機能のすべてを使用することができます。

このドキュメントから漏れている機能であっても……です。

そのため、__JapaneseDate\DateTime__ のすべての機能を使用するには、
[Carbonのドキュメント](https://carbon.nesbot.com/docs/)と、
[DateTimeのドキュメント](http://php.net/manual/ja/class.datetime.php)
も参照してください。

`JapaneseDate`では名前空間を使用しています。

```
use JapaneseDate\DateTime as JapaneseDateTime;
```

のように宣言することで、完全修飾名(`JapaneseDate\DateTime`)を使用せず、単に`JapaneseDateTime`として使用することができます。

本ドキュメントでは、上記宣言がなされているものとして記載します。


インスタンス化
=====================================
__JapaneseDate\DateTime__ の新しいインスタンスを作成するには、いくつかの方法があります。
まず、最初にコンストラクタがあります。


コンストラクタで使用する引数は、

[DateTime::__construct](http://php.net/manual/ja/datetime.construct.php)

とほぼ同様となりますので、まずは上記のドキュメントを参照してください。


コンストラクタを直接使用することはめったにありませんが、
当然ながら以下で説明する静的メソッドでの呼び出しは、内部的にこのコンストラクタが使用されています。


``` .php
$date_time = new JapaneseDateTime();        // JapaneseDateTime::now(); と同等です。
$date_time = new JapaneseDateTime('first day of January 2018', 'Asia/Tokyo');
echo get_class($date_time);                 // JapaneseDate\DateTime
echo $date_time->format('Y-m-d H:i:s');    // 2018-01-01 00:00:00
$date_time = new JapaneseDateTime('first day of January 2018', 9);
echo get_class($date_time);// JapaneseDate\DateTime

echo $date_time->format('Y-m-d H:i:s');    // 2018-01-01 00:00:00
```

上の例では、timezone（2番目）のパラメータが\DateTimeZoneインスタンスではなく文字列と整数として渡されています。

すべてのDateTimeZoneパラメータが拡張され、GMTにDateTimeZoneインスタンス、文字列または整数オフセットを渡すことができ、
タイムゾーンが作成されます。

この整数を渡す処理は、Carbonとは微妙に動作が異なりますので、注意してください。


``` .php
date_default_timezone_set('Europe/London');
// 夏時間が有効なデフォルトタイムゾーンで、+1時間
echo Carbon::now(1)->tzName;             // Europe/London
echo JapaneseDateTime::now(1)->tzName;             // Europe/Paris
// 夏時間が有効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now(9)->tzName;             // Throw InvalidArgumentException Unknown or bad timezone (9)
echo JapaneseDateTime::now(9)->tzName;             // Asia/Tokyo

date_default_timezone_set('Asia/Tokyo');
// 夏時間が無効なデフォルトタイムゾーンで、+1時間
echo Carbon::now(1)->tzName;             // Europe/London
echo JapaneseDateTime::now(1)->tzName;             // Europe/Paris
// 夏時間が無効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now(9)->tzName;             // Throw InvalidArgumentException Unknown or bad timezone (9)
echo JapaneseDateTime::now(9)->tzName;             // Asia/Tokyo
```


`new`を使用せずメソッドチェーンを使用するなら、

 - `JapaneseDate\DateTime::parse()`
 - `JapaneseDate\DateTime::factory()`

を使用してください。


まずは、`JapaneseDate\DateTime::parse()`の例から説明します。

下記のコードは、同等です。

``` .php
echo (new JapaneseDateTime('first day of December 2018'))->addWeeks(2);     // 2018-12-15 00:00:00

echo JapaneseDateTime::parse('first day of December 2018')->addWeeks(2);    // 2018-12-15 00:00:00
```


`JapaneseDate\DateTime::parse()`の第一引数、
または`new JapaneseDate\DateTime()`の第一引数では、
相対時刻（次の日曜日、明日、翌月の翌日、昨年）または絶対時刻（2018年12月の初日、2017-01-06）を表します。

`JapaneseDate\DateTime::hasRelativeKeywords()`を使用することで。
文字列が相対日付または絶対日付を生成するかどうかをテストできます。


つぎに、`JapaneseDate\DateTime::factory()`の例から説明します。

`JapaneseDate\DateTime::parse()`は便利ですが、以下のようなコードは動作しません。


``` .php

echo JapaneseDateTime::parse(time());    // Throw Exception DateTime::__construct(): Failed to parse time string (1526709775) at position 8 (7): Unexpected character
echo JapaneseDateTime::parse(new DateTime('now'));    // PHP Fatal error:  Uncaught TypeError: DateTime::__construct() expects parameter 1 to be string, object given
```

`Carbon::parse()`を利用した
`JapaneseDate\DateTime::parse()`ではUNIXタイムスタンプや、
標準のDateTimeオブジェクトの利用ができないためです。

そういった場合は、`JapaneseDate\DateTime::factory()`を使用します。

``` .php
echo JapaneseDateTime::factory(time());    // 2018-05-19 15:02:55

echo JapaneseDateTime::factory(new DateTime('now'));    // 2018-05-19 15:02:55

// もちろんこういったコードも動作します
echo JapaneseDateTime::factory('first day of December 2018')->addWeeks(2);    // 2018-12-15 00:00:00

// 一見数字文字列であっても、JapaneseDateTime::parse でパースできる場合は、同様の結果を返すことに注意してください。
echo JapaneseDateTime::parse('100');    // Throw Exception DateTime::__construct(): Failed to parse time string (100) at position 0 (1): Unexpected character
echo JapaneseDateTime::factory('100');    // 1970-01-01 09:01:40
echo JapaneseDateTime::parse('20180404050505');    // 2018-04-04 05:05:05
echo JapaneseDateTime::factory('20180404050505');    // 2018-04-04 05:05:05
// 上記の結果が意図したものでない場合は、必ずint型で渡してください
echo JapaneseDateTime::factory(20180404050505);    // 2061-07-19 16:48:25

```


その他、[Carbon](https://carbon.nesbot.com/docs/#api-instantiation)で使用することができる、
インスタンス化メソッドは全て使用できます。

[Carbon ドキュメント](https://carbon.nesbot.com/docs/#api-instantiation)内の、`Carbon::`はすべて、`JapaneseDate\DateTime::`に置き換えてください。

以下に、`today()`、`tomorrow()`、`yesterday()`の例を示します。


``` .php
$now = JapaneseDateTime::now();
echo $now;                               // 2018-05-19 15:02:55
$today = JapaneseDateTime::today();
echo $today;                             // 2018-05-19 00:00:00
$tomorrow = JapaneseDateTime::tomorrow('Europe/London');
echo $tomorrow;                          // 2018-05-20 00:00:00
$yesterday = JapaneseDateTime::yesterday();
echo $yesterday;                         // 2018-05-18 00:00:00
```

ローカライゼーション
=================================================
基本クラスのDateTimeにはローカライゼーションのサポートがありません。
ローカライゼーションをサポートするために、formatLocalized($format)メソッドや、formatLocalizedSimple()があります。

基本的な実装は、現在のインスタンスのタイムスタンプを使用してstrftime()を呼び出します。
PHP関数[setlocale()](http://php.net/manual/ja/function.setlocale.php)を使用して現在のロケールを最初に設定することで、
返される文字列は正しいロケールでフォーマットされます。

formatLocalized($format)メソッドには追加で、日本語日付に特化したオプションが用意されています。

[詳しくはこちら](https://github.com/suzunone/JapaneseDate/blob/v4.X/docs/README.md#formatlocalized)を参照してください。


``` .php
setlocale(LC_ALL, 'ja_JP');

$dt = JapaneseDateTime::parse('2018-3-21 23:26:11.123789');
echo $dt->formatLocalized('%A %d %B %Y'); // 水曜日 21 3月 2018
// %を文字列として表示したい場合は、%%のように2つ重ねる
echo $dt->formatLocalized('%#F%#E年%m月%d日(%A) 80%% %%#J');   // 平成30年03月21日(水曜日) 80% %#J
    echo $dt->formatLocalized('%#J %#e %#g %#k %#6 %#K %#l %#L %#o %#O %#N %#E %#G %#F %#f');   // 21 21  3 赤口 1 水 5 春分の日 11 戌 30 弥生 平成 1003
// formatLocalizedSimpleを使えば、単なるstrftimeとしても使用できます。
echo $dt->formatLocalizedSimple('%#J %#e %#g %#k %#6 %#K %#l %#L %#o %#O %#N %#E %#G %#F %#f');   // #J #e #g #k #6 #K #l #L #o #O #E #G #F #f
```


`JapaneseDateTime::setLocale()`を使用することで、[setlocale()](http://php.net/manual/ja/function.setlocale.php)を使用せずとも、同様の効果を得ることができます。


``` .php
    JapaneseDateTime::setLocale('ja');
    echo JapaneseDateTime::getLocale();                          // ja
    $dt = JapaneseDateTime::parse('2018-3-21 23:26:11.123789');
    echo $dt->formatLocalized('%A %d %B %Y'); // 水曜日 21 3月 2018

    echo $dt->formatLocalized('%#F%#E年%m月%d日(%A)');   // 平成30年03月21日(水曜日)
    echo $dt->formatLocalized('%#F%#E年%-m月%-d日(%A)');   // 平成30年3月21日(水曜日)

    echo $dt->formatLocalized('%#J %#e %#g %#k %#6 %#K %#l %#L %#o %#O %#N %#E %#G %#F %#f');   // 21 21  3 赤口 1 水 5 春分の日 11 戌 30 弥生 平成 1003
```

フォーマット文字対応表

### 新暦の日
| 文字 | 説明 |
|:-----------------:|:------------------|
| %#J | %-dへのエイリアス |
| %#e | 1～9なら先頭にスペースを付ける、1～31の日(%eのwin対応版) |

### 新暦の月
| 文字 | 説明 |
|:-----------------:|:------------------|
| %#g | 1～9なら先頭にスペースを付ける、1～12の月 |
| %#G | 古い名前の月名(睦月、如月) |
| %#K | 曜日 |
| %#l | 祝日番号 |
| %#L | 祝日 |
| %#o | 干支番号 |
| %#O | 干支 |

### 年号
| 文字 | 説明 |
|:-----------------:|:------------------|
| %#f | 年号ID |
| %#F | 年号 |


### 六曜
| 文字 | 説明 |
|:-----------------:|:------------------|
| %#k | 六曜番号 |
| %#6 | 六曜 |


### 旧暦年
| 文字 | 説明 |
|:-----------------:|:------------------|
| %#E | 旧暦年 |


### 旧暦日
| 文字 | 説明 |
|:-----------------:|:------------------|
| %#d | 旧暦の日(01,02...) |
| %#-d|  旧暦の日(1,2,3....) |
| %#j | 旧暦の1桁の場合は先頭にスペースをいれた日（ 1, 2, 3） |


### 旧暦月
| 文字 | 説明 |
|:-----------------:|:------------------|
| %#m | 旧暦の月(01,02...) |
| %#-m|  旧暦の月(1,2,3....) |
| %#n | 旧暦の1桁の場合は先頭にスペースをいれた月（ 1, 2, 3） |
| %#b | 旧暦の月(睦月,如月...) |
| %#h | %#bへのエイリアス |
| %#B | 旧暦の月で閏月まで表示する 皐月(閏月) |
| %#u | 閏月の場合 閏 と出力させる |
| %#U | 閏月の場合 (閏) と出力させる |



Getter
=================================================

getterはMagicMethodの__get()メソッドで実装されています。

propertiesにアクセスするだけで、様々な情報を取得できます。


``` .php
$dt = JapaneseDateTime::parse('2018-3-21 23:26:11.123789');

// 標準的な日付データ
//  年
var_export($dt->year);                                         // 2018
// 月
var_export($dt->month);                                        // 3
// 日
var_export($dt->day);                                          // 21
// 時
var_export($dt->hour);                                         // 23
// 分
var_export($dt->minute);                                       // 26
// 秒
var_export($dt->second);                                       // 11
// マイクロ秒
var_export($dt->micro);                                        // 123789
// 日本の暦

// ２４節気

// 0 => 春分
// 1 => 清明
// 2 => 穀雨
// 3 => 立夏
// 4 => 小満
// 5 => 芒種
// 6 => 夏至
// 7 => 小暑
// 8 => 大暑
// 9 => 立秋
// 10 => 処暑
// 11 => 白露
// 12 => 秋分
// 13 => 寒露
// 14 => 霜降
// 15 => 立冬
// 16 => 小雪
// 17 => 大雪
// 18 => 冬至
// 19 => 小寒
// 20 => 大寒
// 21 => 立春
// 22 => 雨水
// 23 => 啓蟄

var_export($dt->solarTerm);                                   // 0
var_export($dt->solarTermText);                              // '春分'

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solarTerm);                                   // false
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solarTermText);                              // ''

// 元号

// 1000 => 明治
// 1001 => 大正
// 1002 => 昭和
// 1003 => 平成
// 1004 => 平成の次

var_export($dt->eraName);                                     // 1003
var_export($dt->eraNameText);                                // '平成'
var_export($dt->eraYear);                                     // 30

// 干支

// 0 => 亥
// 1 => 子
// 2 => 丑
// 3 => 寅
// 4 => 卯
// 5 => 辰
// 6 => 巳
// 7 => 午
// 8 => 未
// 9 => 申
// 10 => 酉
// 11 => 戌
var_export($dt->orientalorientalZodiac);                              // 11
var_export($dt->orientalZodiacText);                         // '戌'

// ６曜

// 0 => 大安
// 1 => 赤口
// 2 => 先勝
// 3 => 友引
// 4 => 先負
// 5 => 仏滅
var_export($dt->sixWeekday);                                  // 1
var_export($dt->sixWeekdayText);                             // '赤口'

// 曜日文字列
var_export($dt->weekdayText);                                 // '水'
// 月
var_export($dt->monthText);                                   // '弥生'
// 祝日

// 0 => 非祝日(holidayTextでは空文字列が返ります)
// 1 => 元旦
// 2 => 成人の日
// 3 => 建国記念の日
// 4 => 昭和天皇の大喪の礼
// 5 => 春分の日
// 6 => 昭和の日
// 7 => みどりの日
// 8 => 天皇誕生日
// 9 => 皇太子明仁親王の結婚の儀
// 10 => 憲法記念日
// 11 => 国民の休日
// 12 => こどもの日
// 13 => 振替休日
// 14 => 皇太子徳仁親王の結婚の儀
// 15 => 海の日
// 16 => 秋分の日
// 17 => 敬老の日
// 18 => 体育の日
// 19 => 文化の日
// 20 => 勤労感謝の日
// 21 => 即位礼正殿の儀
// 22 => 山の日
var_export($dt->holiday);                                      // 5
var_export($dt->holidayText);                                 // '春分の日'

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday);                                   // 0
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holidayText);                              // ''

// 旧暦：月
var_export($dt->lunarMonth);                                  // '2'
var_export($dt->lunarMonthText);                              // '如月'
// 旧暦：年
var_export($dt->lunarYear);                                   // '2018'
// 旧暦：日
var_export($dt->lunarDay);                                    // '5'
// 閏月かどうか
var_export($dt->isLeapMonth);                                // false


// dayOfWeek は 0 (日) から 6 (土)の数値を返します
var_export($dt->dayOfWeek);                                    // 3

// dayOfWeekIso は between 1 (月) and 7 (日)の数値を返します
var_export($dt->dayOfWeekIso);                                 // 3
var_export($dt->dayOfYear);                                    // 79
var_export($dt->weekNumberInMonth);                            // 4

// weekNumberInMonthは月曜日から日曜日までの週を考慮しているので、1週目は月が日曜日で始まる場合は1日を、
// 月曜で始まる場合は最大7日を含みます
var_export($dt->weekOfMonth);                                  // 3

// weekOfMonthは、月の最初の7日に1を返し、次に8日に2を返します。
// 14日、15日から3日、3日、22日から28日、5日
var_export($dt->weekOfYear);                                   // 12
var_export($dt->daysInMonth);                                  // 31
var_export($dt->timestamp);                                    // 1521642371
var_export(JapaneseDateTime::createFromDate(1975, 5, 21)->age);          // 42
var_export($dt->quarter);                                      // 1

// UTCからの秒の差をintで返します（+/-符号を含む）
var_export(JapaneseDateTime::createFromTimestampUTC(0)->offset);         // 0
var_export(JapaneseDateTime::createFromTimestamp(0)->offset);            // 32400

// UTCからの時差の整数を返します（+/-符号を含む）
var_export(JapaneseDateTime::createFromTimestamp(0)->offsetHours);       // 9

// 夏時間が有効かどうかを返します
var_export(JapaneseDateTime::createFromDate(2012, 1, 1)->dst);           // false
var_export(JapaneseDateTime::createFromDate(2012, 9, 1)->dst);           // false

// インスタンスがローカルのタイムゾーンと同じタイムゾーンにあるかどうかを示します。
var_export(JapaneseDateTime::now()->local);                              // true
var_export(JapaneseDateTime::now('America/Vancouver')->local);           // false
var_export(JapaneseDateTime::now('America/Vancouver')->local);
?>


// インスタンスがUTCタイムゾーンにあるかどうかを示します。
var_export(JapaneseDateTime::now()->utc);                                // false
var_export(JapaneseDateTime::now('Europe/London')->utc);                 // false
var_export(JapaneseDateTime::createFromTimestampUTC(0)->utc);            // true

// DateTimeZoneインスタンスを取得します。
echo get_class(JapaneseDateTime::now()->timezone);                     // DateTimeZone
echo get_class(JapaneseDateTime::now()->tz);                           // DateTimeZone

// ->timezone->getName() へのエイリアスです
echo JapaneseDateTime::now()->timezoneName;                            // Asia/Tokyo
echo JapaneseDateTime::now()->tzName;                                  // Asia/Tokyo
```


キャッシュ
=================================================

旧暦に関する計算はCPUコストが比較的高く、高負荷なアプリケーションでの使用は不向きに見えます。

当然、旧暦に関する計算は必要がない場合は行われません。

そのため、旧暦に関する計算結果をキャッシュする仕組みを用意しています。

デフォルトでは、APCuが使用可能ならAPCuでのキャッシュを行い、そうでないなら、オブジェクト内に静的にキャッシュされるのみとなります。

キャッシュをoffにするには、
``` .php
use \JapaneseDate\CacheMode;
JapaneseDateTime::setCacheMode(CacheMode::MODE_NONE);
```
を使用してください。
静的に処理されるため、同一Request内では、次にsetCacheModeするまでは同一のキャッシュモードが使用されることに注意してください。

キャッシュモードの切り替えは、`JapaneseDateTime::setCacheMode`での切り替え以外に、
[JapaneseDateTime::setCacheFilePath](https://github.com/suzunone/JapaneseDate/blob/master/docs/README.md#setcachefilepath)を使用してキャッシュファイルのパスを指定したり、
[JapaneseDateTime::setCacheClosure](https://github.com/suzunone/JapaneseDate/blob/master/docs/README.md#setcacheclosure)をして、独自のキャッシュロジックを登録することでも切り替えることができます。


