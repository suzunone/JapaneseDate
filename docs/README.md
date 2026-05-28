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
echo Carbon::now()->tzName;             // Asia/Tokyo
echo JapaneseDateTime::now()->tzName;             // Asia/Tokyo
// 夏時間が有効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now()->tzName;             // 
echo JapaneseDateTime::now()->tzName;             // Asia/Tokyo

date_default_timezone_set('Asia/Tokyo');
// 夏時間が無効なデフォルトタイムゾーンで、+1時間
echo Carbon::now()->tzName;             // Asia/Tokyo
echo JapaneseDateTime::now()->tzName;             // Asia/Tokyo
// 夏時間が無効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now()->tzName;             // 
echo JapaneseDateTime::now()->tzName;             // Asia/Tokyo
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

echo JapaneseDateTime::parse(time());    // 2026-05-28 23:45:07
echo JapaneseDateTime::parse(new DateTime('now'));    // PHP Fatal error:  Uncaught TypeError: DateTime::__construct() expects parameter 1 to be string, object given
```

`Carbon::parse()`を利用した
`JapaneseDate\DateTime::parse()`ではUNIXタイムスタンプや、
標準のDateTimeオブジェクトの利用ができないためです。

そういった場合は、`JapaneseDate\DateTime::factory()`を使用します。

``` .php
echo JapaneseDateTime::factory(time());    // 2026-05-28 23:45:07

echo JapaneseDateTime::factory(new DateTime('now'));    // 2026-05-29 08:45:07

// もちろんこういったコードも動作します
echo JapaneseDateTime::factory('first day of December 2018')->addWeeks(2);    // 2018-12-15 00:00:00

// 一見数字文字列であっても、JapaneseDateTime::parse でパースできる場合は、同様の結果を返すことに注意してください。
echo JapaneseDateTime::parse('100');    // Throw Carbon\Exceptions\InvalidFormatException Could not parse '100': Throwing native DateTime class construct exception.
echo JapaneseDateTime::factory('100');    // 1970-01-01 09:01:40
echo JapaneseDateTime::parse('20180404050505');    // 2018-04-04 05:05:05
echo JapaneseDateTime::factory('20180404050505');    // 2018-04-04 05:05:05
// 上記の結果が意図したものでない場合は、必ずint型で渡してください
echo JapaneseDateTime::factory(20180404050505);    // 641461-07-19 07:48:25

```


その他、[Carbon](https://carbon.nesbot.com/docs/#api-instantiation)で使用することができる、
インスタンス化メソッドは全て使用できます。

[Carbon ドキュメント](https://carbon.nesbot.com/docs/#api-instantiation)内の、`Carbon::`はすべて、`JapaneseDate\DateTime::`に置き換えてください。

以下に、`today()`、`tomorrow()`、`yesterday()`の例を示します。


``` .php
$now = JapaneseDateTime::now();
echo $now;                               // 2026-05-29 08:45:07
$today = JapaneseDateTime::today();
echo $today;                             // 2026-05-29 00:00:00
$tomorrow = JapaneseDateTime::tomorrow('Europe/London');
echo $tomorrow;                          // 2026-05-30 00:00:00
$yesterday = JapaneseDateTime::yesterday();
echo $yesterday;                         // 2026-05-28 00:00:00
```

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
// 1004 => 令和

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
var_export($dt->orientalZodiac);                              // 11
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
// 24 => スポーツの日
// 19 => 文化の日
// 20 => 勤労感謝の日
// 21 => 即位礼正殿の儀
// 22 => 山の日
// 23 => 天皇の即位の日
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
var_export($dt->dayOfYear);                                    // 80
var_export($dt->weekNumberInMonth);                            // 4

// weekNumberInMonthは月曜日から日曜日までの週を考慮しているので、1週目は月が日曜日で始まる場合は1日を、
// 月曜で始まる場合は最大7日を含みます
var_export($dt->weekOfMonth);                                  // 3

// weekOfMonthは、月の最初の7日に1を返し、次に8日に2を返します。
// 14日、15日から3日、3日、22日から28日、5日
var_export($dt->weekOfYear);                                   // 12
var_export($dt->daysInMonth);                                  // 31
var_export($dt->timestamp);                                    // 1521642371
var_export(JapaneseDateTime::createFromDate(1975, 5, 21)->age);          // 51
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

// インスタンスがUTCタイムゾーンにあるかどうかを示します。
var_export(JapaneseDateTime::now()->utc);                                // false
var_export(JapaneseDateTime::now('Europe/London')->utc);                 // false
var_export(JapaneseDateTime::createFromTimestampUTC(0)->utc);            // true

// DateTimeZoneインスタンスを取得します。
echo get_class(JapaneseDateTime::now()->timezone);                     // Carbon\CarbonTimeZone
echo get_class(JapaneseDateTime::now()->tz);                           // Carbon\CarbonTimeZone

// ->timezone->getName() へのエイリアスです
echo JapaneseDateTime::now()->timezoneName;                            // Asia/Tokyo
echo JapaneseDateTime::now()->tzName;                                  // Asia/Tokyo
```


二十四節気の検索メソッド
=================================================

`JapaneseDate\DateTime` には、二十四節気の日付を取得するためのgetterが用意されています。

各節気について「当年の節気日」「次の節気日」「直前の節気日」をプロパティとして取得できます。

同様のgetterが以下の二十四節気すべてに存在します:

| プロパティ名 | 節気 |
|---|---|
| syunbun / nextSyunbun / beforeSyunbun | 春分 |
| seimei / nextSeimei / beforeSeimei | 清明 |
| kokuu / nextKokuu / beforeKokuu | 穀雨 |
| rikka / nextRikka / beforeRikka | 立夏 |
| syouman / nextSyouman / beforeSyouman | 小満 |
| bousyu / nextBousyu / beforeBousyu | 芒種 |
| geshi / nextGeshi / beforeGeshi | 夏至 |
| syousyo / nextSyousyo / beforeSyousyo | 小暑 |
| taisyo / nextTaisyo / beforeTaisyo | 大暑 |
| rissyuu / nextRissyuu / beforeRissyuu | 立秋 |
| syosyo / nextSyosyo / beforeSyosyo | 処暑 |
| hakuro / nextHakuro / beforeHakuro | 白露 |
| syuubun / nextSyuubun / beforeSyuubun | 秋分 |
| kanro / nextKanro / beforeKanro | 寒露 |
| soukou / nextSoukou / beforeSoukou | 霜降 |
| rittou / nextRittou / beforeRittou | 立冬 |
| syousetsu / nextSyousetsu / beforeSyousetsu | 小雪 |
| taisetsu / nextTaisetsu / beforeTaisetsu | 大雪 |
| touji / nextTouji / beforeTouji | 冬至 |
| syoukan / nextSyoukan / beforeSyoukan | 小寒 |
| daikan / nextDaikan / beforeDaikan | 大寒 |
| rissyun / nextRissyun / beforeRissyun | 立春 |
| usui / nextUsui / beforeUsui | 雨水 |
| keichitsu / nextKeichitsu / beforeKeichitsu | 啓蟄 |


Modifier
=================================================

`nextHoliday()` と `nextSixWeek()` が使用できます。

``` .php
// 次の祝日を取得する
$dt = JapaneseDateTime::parse('2024-01-01');
echo $dt->nextHoliday();                  // 2024-01-08 00:00:00
// 次の「大安」を取得する
$dt = JapaneseDateTime::parse('2024-01-01');
echo $dt->nextSixWeek(JapaneseDateTime::SIX_WEEKDAY_TAIAN);

```


DateTimeImmutable
=================================================

`JapaneseDate\DateTimeImmutable` クラスは、[CarbonImmutable](https://carbon.nesbot.com/docs/)を継承した
イミュータブルな日本暦対応オブジェクトです。

```DateTimeImmutable.php
<?php
namespace JapaneseDate;

class DateTimeImmutable extends \Carbon\CarbonImmutable
{

}
```

`JapaneseDate\DateTime` と同じメソッド・プロパティがすべて使用できますが、
各操作は元のオブジェクトを変更せず新しいインスタンスを返します。

``` .php
use JapaneseDate\DateTimeImmutable as JapaneseDateTimeImmutable;

$dt = JapaneseDateTimeImmutable::parse('2024-03-20');
$dt2 = $dt->addDays(1);

// $dt は変更されない
echo $dt->format('Y-m-d');   // 2024-03-20
echo $dt2->format('Y-m-d');  // 2024-03-21
// 日本暦プロパティも同様に使用できます
$dt = JapaneseDateTimeImmutable::parse('2024-03-20');
var_export($dt->solarTermText);  // '春分'
var_export($dt->eraName);        // 1004
var_export($dt->eraYear);        // 6
```


Calendar
=================================================

`JapaneseDate\Calendar` クラスは、一定期間内の日付配列や営業日配列を取得するためのユーティリティクラスです。

``` .php
use JapaneseDate\Calendar as JapaneseDateCalendar;

// 指定月の全日付を取得
$calendar = new JapaneseDateCalendar('2024-03-01');
$dates = $calendar->getDatesOfMonth();
echo count($dates);  // 31
// 期間内の営業日（土日を除く）を取得
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
$calendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
$workDays = $calendar->getWorkingDayBySpan('2024-03-31');
echo count($workDays);  // 21
// 祝日も除外する
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
$calendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
$calendar->setBypassHoliday(true);
$workDays = $calendar->getWorkingDayBySpan('2024-03-31');
echo count($workDays);  // 20
// 件数指定で営業日を取得
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
$calendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
$workDays = $calendar->getWorkingDay(10);
echo count($workDays);  // 10
// 特定日をスキップする
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassDay('2024-03-11');
$calendar->addBypassDay('2024-03-22');
$workDays = $calendar->getWorkingDayBySpan('2024-03-15');
echo count($workDays);  // 14
```

`Calendar` クラスで使用できる主なメソッド:

| メソッド | 説明 |
|---|---|
| `getDatesOfMonth()` | 指定月の全日付配列を返す |
| `getWorkingDayBySpan($end)` | 開始日〜終了日の営業日配列を返す |
| `getWorkingDayByLimit($n)` | 開始日から $n 件の営業日配列を返す |
| `getWorkingDay($n)` | `getWorkingDayByLimit` のエイリアス |
| `addBypassWeekDay($dow)` | スキップする曜日を追加 (0=日〜6=土) |
| `removeBypassWeekDay($dow)` | スキップする曜日を削除 |
| `resetBypassWeekDay()` | スキップする曜日をリセット |
| `addBypassDay($date)` | スキップする日を追加 |
| `removeBypassDay($date)` | スキップする日を削除 |
| `resetBypassDay()` | スキップする日をリセット |
| `setBypassHoliday($bool)` | 祝日をスキップするか設定 |


キャッシュ
=================================================

旧暦に関する計算はCPUコストが比較的高く、高負荷なアプリケーションでの使用は不向きに見えます。

当然、旧暦に関する計算は必要がない場合は行われません。

そのため、旧暦に関する計算結果をキャッシュする仕組みを用意しています。

デフォルトでは、APCが使用可能ならAPCでのキャッシュを行い、そうでないなら、オブジェクト内に静的にキャッシュされるのみとなります。

キャッシュをoffにするには、
``` .php
use \JapaneseDate\CacheMode;
JapaneseDateTime::setCacheMode(CacheMode::MODE_NONE);
```
を使用してください。
静的に処理されるため、同一Request内では、次にsetCacheModeするまでは同一のキャッシュモードが使用されることに注意してください。

キャッシュモードの切り替えは、`JapaneseDateTime::setCacheMode`での切り替え以外に、
[JapaneseDateTime::setCacheFilePath](https://github.com/suzunone/JapaneseDate/blob/v7.X/docs/api/JapaneseDate/DateTime.md)を使用してキャッシュファイルのパスを指定したり、
[JapaneseDateTime::setCacheClosure](https://github.com/suzunone/JapaneseDate/blob/v7.X/docs/api/JapaneseDate/DateTime.md)をして、独自のキャッシュロジックを登録することでも切り替えることができます。


