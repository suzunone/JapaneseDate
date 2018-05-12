<?php
include __DIR__.'/vendor/autoload.php';
ob_start();

date_default_timezone_set('Asia/Tokyo');

use Carbon\Carbon;
use JapaneseDate\DateTime as JapaneseDateTime;
use JapaneseDate\Calendar as JapaneseDateCalendar;

$open_tag = '<?php';
$close_tag = '?>';

?>
はじめに
=====================================
__JapaneseDate\DateTime__クラスは、[Carbon](https://carbon.nesbot.com/docs/)継承しており、
CarbonはPHP [DateTime](http://php.net/manual/ja/class.datetime.php)クラスを継承しています。

```DateTime.php
<?= $open_tag ?>

namespace JapaneseDate;

class DateTime extends \Carbon\Carbon
{

}
```

```Carbon.php
<?= $open_tag ?>

namespace Carbon;

class Carbon extends \DateTime
{

}
```

__JapaneseDate\DateTime__では、DateTimeクラスに存在する機能、Carbonクラスに存在する機能のすべてを使用することができます。

このドキュメントから漏れている機能であっても……です。

そのため、__JapaneseDate\DateTime__のすべての機能を使用するには、
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
__JapaneseDate\DateTime__の新しいインスタンスを作成するには、いくつかの方法があります。
まず、最初にコンストラクタがあります。


コンストラクタで使用する引数は、

[DateTime::__construct](http://php.net/manual/ja/datetime.construct.php)

とほぼ同様となりますので、まずは上記のドキュメントを参照してください。


コンストラクタを直接使用することはめったにありませんが、
当然ながら以下で説明する静的メソッドでの呼び出しは、内部的にこのコンストラクタが使用されています。


``` .php
$date_time = new JapaneseDateTime();        // JapaneseDateTime::now(); と同等です。
$date_time = new JapaneseDateTime('first day of January 2018', 'Asia/Tokyo');
echo get_class($date_time);                 // <?php
$date_time = new JapaneseDateTime('first day of January 2018', 'Asia/Tokyo');
echo get_class($date_time);
?>

echo $date_time->format('Y-m-d H:i:s');    // <?php
echo $date_time->format('Y-m-d H:i:s');
?>

$date_time = new JapaneseDateTime('first day of January 2018', 9);
echo get_class($date_time);// <?php
$date_time = new JapaneseDateTime('first day of January 2018', 9);
echo get_class($date_time);
?>


echo $date_time->format('Y-m-d H:i:s');    // <?php
echo $date_time->format('Y-m-d H:i:s');
?>

```

上の例では、timezone（2番目）のパラメータが\DateTimeZoneインスタンスではなく文字列と整数として渡されています。

すべてのDateTimeZoneパラメータが拡張され、GMTにDateTimeZoneインスタンス、文字列または整数オフセットを渡すことができ、
タイムゾーンが作成されます。

この整数を渡す処理は、Carbonとは微妙に動作が異なりますので、注意してください。


``` .php
date_default_timezone_set('Europe/London');
// 夏時間が有効なデフォルトタイムゾーンで、+1時間
echo Carbon::now(1)->tzName;             // <?php
echo Carbon::now(1)->tzName;
?>

echo JapaneseDateTime::now(1)->tzName;             // <?php
echo JapaneseDateTime::now(1)->tzName;
?>

// 夏時間が有効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now(9)->tzName;             // <?php
try{
    Carbon::now(9)->tzName;
} catch (Exception $exception) {
    echo 'Throw ',get_class($exception), ' '.$exception->getMessage();
}
?>

echo JapaneseDateTime::now(9)->tzName;             // <?php
echo JapaneseDateTime::now(9)->tzName;
?>


date_default_timezone_set('Asia/Tokyo');
// 夏時間が無効なデフォルトタイムゾーンで、+1時間
echo Carbon::now(1)->tzName;             // <?php
echo Carbon::now(1)->tzName;
?>

echo JapaneseDateTime::now(1)->tzName;             // <?php
echo JapaneseDateTime::now(1)->tzName;
?>

// 夏時間が無効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now(9)->tzName;             // <?php
try{
    Carbon::now(9)->tzName;
} catch (Exception $exception) {
    echo 'Throw ',get_class($exception), ' '.$exception->getMessage();
}
?>

echo JapaneseDateTime::now(9)->tzName;             // <?php
echo JapaneseDateTime::now(9)->tzName;
?>
```

`new`を使用せずメソッドチェーンを使用するなら、

 - `JapaneseDate\DateTime::parse()`
 - `JapaneseDate\DateTime::factory()`

を使用してください。


まずは、`JapaneseDate\DateTime::parse()`の例から説明します。

下記のコードは、同等です。

``` .php
echo (new JapaneseDateTime('first day of December 2018'))->addWeeks(2);     // <?php
echo (new JapaneseDateTime('first day of December 2018'))->addWeeks(2);
?>


echo JapaneseDateTime::parse('first day of December 2018')->addWeeks(2);    // <?php
echo JapaneseDateTime::parse('first day of December 2018')->addWeeks(2);
?>

```


`JapaneseDate\DateTime::parse()`の第一引数、
または`new JapaneseDate\DateTime()`の第一引数では、
相対時刻（次の日曜日、明日、翌月の翌日、昨年）または絶対時刻（2018年12月の初日、2017-01-06）を表します。

`JapaneseDate\DateTime::hasRelativeKeywords()`を使用することで。
文字列が相対日付または絶対日付を生成するかどうかをテストできます。


つぎに、`JapaneseDate\DateTime::factory()`の例から説明します。

`JapaneseDate\DateTime::parse()`は便利ですが、以下のようなコードは動作しません。


``` .php

echo JapaneseDateTime::parse(time());    // <?php
try{
    echo JapaneseDateTime::parse(time());
} catch (Exception $exception) {
    echo 'Throw ',get_class($exception), ' '.$exception->getMessage();
}
?>

echo JapaneseDateTime::parse(new DateTime('now'));    // PHP Fatal error:  Uncaught TypeError: DateTime::__construct() expects parameter 1 to be string, object given
```

`Carbon::parse()`を利用した
`JapaneseDate\DateTime::parse()`ではUNIXタイムスタンプや、
標準のDateTimeオブジェクトの利用ができないためです。

そういった場合は、`JapaneseDate\DateTime::factory()`を使用します。

``` .php
echo JapaneseDateTime::factory(time());    // <?php
echo JapaneseDateTime::factory(time());
?>


echo JapaneseDateTime::factory(new DateTime('now'));    // <?php
echo JapaneseDateTime::factory(new DateTime('now'));
?>


// もちろんこういったコードも動作します
echo JapaneseDateTime::factory('first day of December 2018')->addWeeks(2);    // <?php
echo JapaneseDateTime::factory('first day of December 2018')->addWeeks(2);
?>


// 一見数字文字列であっても、JapaneseDateTime::parse でパースできる場合は、同様の結果を返すことに注意してください。
echo JapaneseDateTime::parse('100');    // <?php
try{
    echo JapaneseDateTime::parse('100');
} catch (Exception $exception) {
    echo 'Throw ',get_class($exception), ' '.$exception->getMessage();
}
?>

echo JapaneseDateTime::factory('100');    // <?php
echo JapaneseDateTime::factory('100');
?>

echo JapaneseDateTime::parse('20180404050505');    // <?php
echo JapaneseDateTime::parse('20180404050505');
?>

echo JapaneseDateTime::factory('20180404050505');    // <?php
echo JapaneseDateTime::factory('20180404050505');
?>

// 上記の結果が意図したものでない場合は、必ずint型で渡してください
echo JapaneseDateTime::factory(20180404050505);    // <?php
echo JapaneseDateTime::factory(20180404050505);
?>


```


その他、[Carbon](https://carbon.nesbot.com/docs/#api-instantiation)で使用することができる、
インスタンス化メソッドは全て使用できます。

[Carbon ドキュメント](https://carbon.nesbot.com/docs/#api-instantiation)内の、`Carbon::`はすべて、`JapaneseDate\DateTime::`に置き換えてください。

以下に、`today()`、`tomorrow()`、`yesterday()`の例を示します。


``` .php
$now = JapaneseDateTime::now();
echo $now;                               // <?php
$now = JapaneseDateTime::now();
echo $now;
?>

$today = JapaneseDateTime::today();
echo $today;                             // <?php
$today = JapaneseDateTime::today();
echo $today;
?>

$tomorrow = JapaneseDateTime::tomorrow('Europe/London');
echo $tomorrow;                          // <?php
$tomorrow = JapaneseDateTime::tomorrow('Europe/London');
echo $tomorrow;
?>

$yesterday = JapaneseDateTime::yesterday();
echo $yesterday;                         // <?php
$yesterday = JapaneseDateTime::yesterday();
echo $yesterday;
?>

```


Getter
=================================================

getterはMagicMethodの__get()メソッドで実装されています。



``` .php
$dt = JapaneseDateTime::parse('2018-3-21 23:26:11.123789');
<?php
$dt = JapaneseDateTime::parse('2018-3-21 23:26:11.123789');
?>

// 標準的な日付データ
//  年
var_export($dt->year);                                         // <?php
var_export($dt->year);
?>

// 月
var_export($dt->month);                                        // <?php
var_export($dt->month);
?>

// 日
var_export($dt->day);                                          // <?php
var_export($dt->day);
?>

// 時
var_export($dt->hour);                                         // <?php
var_export($dt->hour);
?>

// 分
var_export($dt->minute);                                       // <?php
var_export($dt->minute);
?>

// 秒
var_export($dt->second);                                       // <?php
var_export($dt->second);
?>

// マイクロ秒
var_export($dt->micro);                                        // <?php
var_export($dt->micro);
?>

// 日本の暦

// ２４節気

<?php
foreach (JapaneseDate\Components\JapaneseDate::SOLAR_TERM as $key => $item) {
    echo "// {$key} => $item\n";
}
?>

var_export($dt->solar_term);                                   // <?php
var_export($dt->solar_term);
?>

var_export($dt->solar_term_text);                              // <?php
var_export($dt->solar_term_text);
?>


var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solar_term);                                   // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solar_term);
?>

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solar_term_text);                              // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solar_term_text);
?>


// 元号

<?php
foreach ([
             JapaneseDateTime::ERA_MEIJI       => '明治',
             JapaneseDateTime::ERA_TAISHO      => '大正',
             JapaneseDateTime::ERA_SHOWA       => '昭和',
             JapaneseDateTime::ERA_HEISEI      => '平成',
             JapaneseDateTime::ERA_HEISEI_NEXT => '平成の次',
         ] as $key => $item) {
    echo "// {$key} => $item\n";
}
?>

var_export($dt->era_name);                                     // <?php
var_export($dt->era_name);
?>

var_export($dt->era_name_text);                                // <?php
var_export($dt->era_name_text);
?>

var_export($dt->era_year);                                     // <?php
var_export($dt->era_year);
?>


// 干支

<?php
foreach (JapaneseDate\Components\JapaneseDate::ORIENTAL_ZODIAC as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->oriental_zodiac);                              // <?php
var_export($dt->oriental_zodiac);
?>

var_export($dt->oriental_zodiac_text);                         // <?php
var_export($dt->oriental_zodiac_text);
?>


// ６曜

<?php
foreach (JapaneseDate\Components\JapaneseDate::SIX_WEEKDAY as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->six_weekday);                                  // <?php
var_export($dt->six_weekday);
?>

var_export($dt->six_weekday_text);                             // <?php
var_export($dt->six_weekday_text);
?>


// 曜日文字列
var_export($dt->weekday_text);                                 // <?php
var_export($dt->weekday_text);
?>

// 月
var_export($dt->month_text);                                   // <?php
var_export($dt->month_text);
?>

// 祝日

<?php
foreach ([
             JapaneseDateTime::NO_HOLIDAY                  => '非祝日(holiday_textでは空文字列が返ります)',
             JapaneseDateTime::NEW_YEAR_S_DAY                  => '元旦',
             JapaneseDateTime::COMING_OF_AGE_DAY               => '成人の日',
             JapaneseDateTime::NATIONAL_FOUNDATION_DAY         => '建国記念の日',
             JapaneseDateTime::THE_SHOWA_EMPEROR_DIED          => '昭和天皇の大喪の礼',
             JapaneseDateTime::VERNAL_EQUINOX_DAY              => '春分の日',
             JapaneseDateTime::DAY_OF_SHOWA                    => '昭和の日',
             JapaneseDateTime::GREENERY_DAY                    => 'みどりの日',
             JapaneseDateTime::THE_EMPEROR_S_BIRTHDAY          => '天皇誕生日',
             JapaneseDateTime::CROWN_PRINCE_HIROHITO_WEDDING   => '皇太子明仁親王の結婚の儀',
             JapaneseDateTime::CONSTITUTION_DAY                => '憲法記念日',
             JapaneseDateTime::NATIONAL_HOLIDAY                => '国民の休日',
             JapaneseDateTime::CHILDREN_S_DAY                  => 'こどもの日',
             JapaneseDateTime::COMPENSATING_HOLIDAY            => '振替休日',
             JapaneseDateTime::CROWN_PRINCE_NARUHITO_WEDDING   => '皇太子徳仁親王の結婚の儀',
             JapaneseDateTime::MARINE_DAY                      => '海の日',
             JapaneseDateTime::AUTUMNAL_EQUINOX_DAY            => '秋分の日',
             JapaneseDateTime::RESPECT_FOR_SENIOR_CITIZENS_DAY => '敬老の日',
             JapaneseDateTime::SPORTS_DAY                      => '体育の日',
             JapaneseDateTime::CULTURE_DAY                     => '文化の日',
             JapaneseDateTime::LABOR_THANKSGIVING_DAY          => '勤労感謝の日',
             JapaneseDateTime::REGNAL_DAY                      => '即位礼正殿の儀',
             JapaneseDateTime::MOUNTAIN_DAY                    => '山の日',
         ] as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->holiday);                                      // <?php
var_export($dt->holiday);
?>

var_export($dt->holiday_text);                                 // <?php
var_export($dt->holiday_text);
?>


var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday);                                   // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday);
?>

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday_text);                              // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday_text);
?>


// 旧暦：月
var_export($dt->lunar_month);                                  // <?php
var_export($dt->lunar_month);
?>

var_export($dt->lunar_month_text);                             // <?php
var_export($dt->lunar_month_text);
?>

// 旧暦：年
var_export($dt->lunar_year);                                   // <?php
var_export($dt->lunar_year);
?>

// 旧暦：日
var_export($dt->lunar_day);                                    // <?php
var_export($dt->lunar_day);
?>

// 閏月かどうか
var_export($dt->is_leap_month);                                // <?php
var_export($dt->is_leap_month);
?>



// dayOfWeek は 0 (日) から 6 (土)の数値を返します
var_export($dt->dayOfWeek);                                    // <?php
var_export($dt->dayOfWeek);
?>


// dayOfWeekIso は between 1 (月) and 7 (日)の数値を返します
var_export($dt->dayOfWeekIso);                                 // <?php
var_export($dt->dayOfWeekIso);
?>

var_export($dt->dayOfYear);                                    // <?php
var_export($dt->dayOfYear);
?>

var_export($dt->weekNumberInMonth);                            // <?php
var_export($dt->weekNumberInMonth);
?>


// weekNumberInMonthは月曜日から日曜日までの週を考慮しているので、1週目は月が日曜日で始まる場合は1日を、
// 月曜で始まる場合は最大7日を含みます
var_export($dt->weekOfMonth);                                  // <?php
var_export($dt->weekOfMonth);
?>


// weekOfMonthは、月の最初の7日に1を返し、次に8日に2を返します。
// 14日、15日から3日、3日、22日から28日、5日
var_export($dt->weekOfYear);                                   // <?php
var_export($dt->weekOfYear);
?>

var_export($dt->daysInMonth);                                  // <?php
var_export($dt->daysInMonth);
?>

var_export($dt->timestamp);                                    // <?php
var_export($dt->timestamp);
?>

var_export(JapaneseDateTime::createFromDate(1975, 5, 21)->age);          // <?php
var_export(JapaneseDateTime::createFromDate(1975, 5, 21)->age);
?>

var_export($dt->quarter);                                      // <?php
var_export($dt->quarter);
?>


// UTCからの秒の差をintで返します（+/-符号を含む）
var_export(JapaneseDateTime::createFromTimestampUTC(0)->offset);         // <?php
var_export(JapaneseDateTime::createFromTimestampUTC(0)->offset);
?>

var_export(JapaneseDateTime::createFromTimestamp(0)->offset);            // <?php
var_export(JapaneseDateTime::createFromTimestamp(0)->offset);
?>


// UTCからの時差の整数を返します（+/-符号を含む）
var_export(JapaneseDateTime::createFromTimestamp(0)->offsetHours);       // <?php
var_export(JapaneseDateTime::createFromTimestamp(0)->offsetHours);
?>


// 夏時間が有効かどうかを返します
var_export(JapaneseDateTime::createFromDate(2012, 1, 1)->dst);           // <?php
var_export(JapaneseDateTime::createFromDate(2012, 1, 1)->dst);
?>

var_export(JapaneseDateTime::createFromDate(2012, 9, 1)->dst);           // <?php
var_export(JapaneseDateTime::createFromDate(2012, 9, 1)->dst);
?>


// インスタンスがローカルのタイムゾーンと同じタイムゾーンにあるかどうかを示します。
var_export(JapaneseDateTime::now()->local);                              // <?php
var_export(JapaneseDateTime::now()->local);
?>

var_export(JapaneseDateTime::now('America/Vancouver')->local);           // <?php
var_export(JapaneseDateTime::now('America/Vancouver')->local);
?>

var_export(JapaneseDateTime::now('America/Vancouver')->local);
?>


// インスタンスがUTCタイムゾーンにあるかどうかを示します。
var_export(JapaneseDateTime::now()->utc);                                // <?php
var_export(JapaneseDateTime::now()->utc);
?>

var_export(JapaneseDateTime::now('Europe/London')->utc);                 // <?php
var_export(JapaneseDateTime::now('Europe/London')->utc);
?>

var_export(JapaneseDateTime::createFromTimestampUTC(0)->utc);            // <?php
var_export(JapaneseDateTime::createFromTimestampUTC(0)->utc);
?>


// DateTimeZoneインスタンスを取得します。
echo get_class(JapaneseDateTime::now()->timezone);                     // <?php
echo get_class(JapaneseDateTime::now()->timezone);
?>

echo get_class(JapaneseDateTime::now()->tz);                           // <?php
echo get_class(JapaneseDateTime::now()->tz);
?>


// ->timezone->getName() へのエイリアスです
echo JapaneseDateTime::now()->timezoneName;                            // <?php
echo JapaneseDateTime::now()->timezoneName;
?>

echo JapaneseDateTime::now()->tzName;                                  // <?php
echo JapaneseDateTime::now()->tzName;
?>




```


<?php
$content = ob_get_contents();
ob_end_flush();
file_put_contents(__DIR__.'/docs/Man.md', $content);
?>