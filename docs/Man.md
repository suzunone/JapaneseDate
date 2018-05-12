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

__JapaneseDate\DateTime__ では、DateTimeクラスに存在する機能、Carbonクラスに存在する機能のすべてを使用することができます。

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

echo JapaneseDateTime::parse(time());    // Throw Exception DateTime::__construct(): Failed to parse time string (1526114028) at position 7 (0): Unexpected character
echo JapaneseDateTime::parse(new DateTime('now'));    // PHP Fatal error:  Uncaught TypeError: DateTime::__construct() expects parameter 1 to be string, object given
```

`Carbon::parse()`を利用した
`JapaneseDate\DateTime::parse()`ではUNIXタイムスタンプや、
標準のDateTimeオブジェクトの利用ができないためです。

そういった場合は、`JapaneseDate\DateTime::factory()`を使用します。

``` .php
echo JapaneseDateTime::factory(time());    // 2018-05-12 17:33:48

echo JapaneseDateTime::factory(new DateTime('now'));    // 2018-05-12 17:33:48

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
echo $now;                               // 2018-05-12 17:33:48
$today = JapaneseDateTime::today();
echo $today;                             // 2018-05-12 00:00:00
$tomorrow = JapaneseDateTime::tomorrow('Europe/London');
echo $tomorrow;                          // 2018-05-13 00:00:00
$yesterday = JapaneseDateTime::yesterday();
echo $yesterday;                         // 2018-05-11 00:00:00
```


Getter
=================================================

getterはMagicMethodの__get()メソッドで実装されています。



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

var_export($dt->solar_term);                                   // 0
var_export($dt->solar_term_text);                              // '春分'

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solar_term);                                   // false
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solar_term_text);                              // ''

// 元号

// 1000 => 明治
// 1001 => 大正
// 1002 => 昭和
// 1003 => 平成
// 1004 => 平成の次

var_export($dt->era_name);                                     // 1003
var_export($dt->era_name_text);                                // '平成'
var_export($dt->era_year);                                     // 30

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
var_export($dt->oriental_zodiac);                              // 11
var_export($dt->oriental_zodiac_text);                         // '戌'

// ６曜

// 0 => 大安
// 1 => 赤口
// 2 => 先勝
// 3 => 友引
// 4 => 先負
// 5 => 仏滅
var_export($dt->six_weekday);                                  // 1
var_export($dt->six_weekday_text);                             // '赤口'

// 曜日文字列
var_export($dt->weekday_text);                                 // '水'
// 月
var_export($dt->month_text);                                   // '弥生'
// 祝日

// 0 => 非祝日(holiday_textでは空文字列が返ります)
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
var_export($dt->holiday_text);                                 // '春分の日'

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday);                                   // 0
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday_text);                              // ''

// 旧暦：月
var_export($dt->lunar_month);                                  // '2'
var_export($dt->lunar_month_text);                             // '如月'
// 旧暦：年
var_export($dt->lunar_year);                                   // '2018'
// 旧暦：日
var_export($dt->lunar_day);                                    // '5'
// 閏月かどうか
var_export($dt->is_leap_month);                                // false


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


