<?php
foreach ([__DIR__ . '/../../autoload.php', __DIR__ . '/../vendor/autoload.php', __DIR__ . '/vendor/autoload.php'] as $file) {
    if (file_exists($file)) {
        define('JD_COMPOSER_INSTALL', $file);

        break;
    }
}

unset($file);

if (!defined('JD_COMPOSER_INSTALL')) {
    fwrite(
        STDERR,
        'You need to set up the project dependencies using Composer:' . PHP_EOL . PHP_EOL .
        '    composer install' . PHP_EOL . PHP_EOL .
        'You can learn all about Composer on https://getcomposer.org/.' . PHP_EOL
    );

    die(1);
}

require JD_COMPOSER_INSTALL;

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
__JapaneseDate\DateTime__ クラスは、[Carbon](https://carbon.nesbot.com/)継承しており、
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

新しい__JapaneseDate\DateTime__ では、DateTimeクラスに存在する機能、Carbonクラスに存在する機能のすべてを使用することができます。

このドキュメントから漏れている機能であっても……です。

そのため、__JapaneseDate\DateTime__ のすべての機能を使用するには、
[Carbonのドキュメント](https://carbon.nesbot.com/)と、
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
echo Carbon::now()->tzName;             // <?php
echo Carbon::now()->tzName;
?>

echo JapaneseDateTime::now()->tzName;             // <?php
echo JapaneseDateTime::now()->tzName;
?>

// 夏時間が有効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now()->tzName;             // <?php
try {
    Carbon::now()->tzName;
} catch (Exception $exception) {
    echo 'Throw ',get_class($exception), ' '.$exception->getMessage();
}
?>

echo JapaneseDateTime::now()->tzName;             // <?php
echo JapaneseDateTime::now()->tzName;
?>


date_default_timezone_set('Asia/Tokyo');
// 夏時間が無効なデフォルトタイムゾーンで、+1時間
echo Carbon::now()->tzName;             // <?php
echo Carbon::now()->tzName;
?>

echo JapaneseDateTime::now()->tzName;             // <?php
echo JapaneseDateTime::now()->tzName;
?>

// 夏時間が無効なデフォルトタイムゾーンで、+9時間(夏時間があるタイムゾーンがない)
echo Carbon::now()->tzName;             // <?php
try {
    Carbon::now()->tzName;
} catch (Exception $exception) {
    echo 'Throw ',get_class($exception), ' '.$exception->getMessage();
}
?>

echo JapaneseDateTime::now()->tzName;             // <?php
echo JapaneseDateTime::now()->tzName;
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
try {
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
try {
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


その他、[Carbon](https://carbon.nesbot.com/#api-instantiation)で使用することができる、
インスタンス化メソッドは全て使用できます。

[Carbon ドキュメント](https://carbon.nesbot.com/#api-instantiation)内の、`Carbon::`はすべて、`JapaneseDate\DateTime::`に置き換えてください。

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

propertiesにアクセスするだけで、様々な情報を取得できます。


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

var_export($dt->solarTerm);                                   // <?php
var_export($dt->solarTerm);
?>

var_export($dt->solarTermText);                              // <?php
var_export($dt->solarTermText);
?>


var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solarTerm);                                   // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solarTerm);
?>

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solarTermText);                              // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->solarTermText);
?>


// 元号

<?php
foreach ([
             JapaneseDateTime::ERA_MEIJI  => '明治',
             JapaneseDateTime::ERA_TAISHO => '大正',
             JapaneseDateTime::ERA_SHOWA  => '昭和',
             JapaneseDateTime::ERA_HEISEI => '平成',
             JapaneseDateTime::ERA_REIWA  => '令和',
         ] as $key => $item) {
    echo "// {$key} => $item\n";
}
?>

var_export($dt->eraName);                                     // <?php
var_export($dt->eraName);
?>

var_export($dt->eraNameText);                                // <?php
var_export($dt->eraNameText);
?>

var_export($dt->eraYear);                                     // <?php
var_export($dt->eraYear);
?>


// 十二支（干支）

<?php
foreach (JapaneseDate\Components\JapaneseDate::ORIENTAL_ZODIAC as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->orientalZodiac);                              // <?php
var_export($dt->orientalZodiac);
?>

var_export($dt->orientalZodiacText);                         // <?php
var_export($dt->orientalZodiacText);
?>


// 十干

<?php
foreach (JapaneseDate\Components\SexagenaryCycle::HEAVENLY_STEMS as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->heavenlyStem);                               // <?php
var_export($dt->heavenlyStem);
?>

var_export($dt->heavenlyStemText);                           // <?php
var_export($dt->heavenlyStemText);
?>


// 六十干支（十干 + 十二支の組み合わせ）
// 十干テキスト + 十二支テキスト で表現します
var_export($dt->heavenlyStemText . $dt->orientalZodiacText); // <?php
var_export($dt->heavenlyStemText . $dt->orientalZodiacText);
?>


// ６曜

<?php
foreach (JapaneseDate\Components\JapaneseDate::SIX_WEEKDAY as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->sixWeekday);                                  // <?php
var_export($dt->sixWeekday);
?>

var_export($dt->sixWeekdayText);                             // <?php
var_export($dt->sixWeekdayText);
?>


// 曜日文字列
var_export($dt->weekdayText);                                 // <?php
var_export($dt->weekdayText);
?>

// 月
var_export($dt->monthText);                                   // <?php
var_export($dt->monthText);
?>

// 祝日

<?php
foreach ([
             JapaneseDateTime::NO_HOLIDAY                      => '非祝日(holidayTextでは空文字列が返ります)',
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
             JapaneseDateTime::LEGACY_SPORTS_DAY               => '体育の日',
             JapaneseDateTime::SPORTS_DAY                      => 'スポーツの日',
             JapaneseDateTime::CULTURE_DAY                     => '文化の日',
             JapaneseDateTime::LABOR_THANKSGIVING_DAY          => '勤労感謝の日',
             JapaneseDateTime::REGNAL_DAY                      => '即位礼正殿の儀',
             JapaneseDateTime::MOUNTAIN_DAY                    => '山の日',
             JapaneseDateTime::EMPERORS_THRONE_DAY             => '天皇の即位の日',
         ] as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->holiday);                                      // <?php
var_export($dt->holiday);
?>

var_export($dt->holidayText);                                 // <?php
var_export($dt->holidayText);
?>


var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday);                                   // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holiday);
?>

var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holidayText);                              // <?php
var_export(JapaneseDateTime::parse('2018-04-01 12:23:45.6789')->holidayText);
?>


// 五節句（西暦）

<?php
foreach ([
             JapaneseDateTime::SEASONAL_FESTIVAL_NONE     => '非節句（空文字列が返ります）',
             JapaneseDateTime::SEASONAL_FESTIVAL_JINJITSU => '人日の節句（七草の節句）',
             JapaneseDateTime::SEASONAL_FESTIVAL_JOSHI    => '上巳の節句（桃の節句）',
             JapaneseDateTime::SEASONAL_FESTIVAL_TANGO    => '端午の節句（菖蒲の節句）',
             JapaneseDateTime::SEASONAL_FESTIVAL_TANABATA => '七夕の節句（笹の節句）',
             JapaneseDateTime::SEASONAL_FESTIVAL_CHOYO    => '重陽の節句（菊の節句）',
         ] as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->solarSeasonalFestival);                       // <?php
var_export($dt->solarSeasonalFestival);
?>

var_export($dt->solarSeasonalFestivalName);                   // <?php
var_export($dt->solarSeasonalFestivalName);
?>

var_export($dt->solarSeasonalFestivalAlias);                  // <?php
var_export($dt->solarSeasonalFestivalAlias);
?>

var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestival);     // <?php
var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestival);
?>

var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestivalName); // <?php
var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestivalName);
?>

var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestivalAlias); // <?php
var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestivalAlias);
?>


// 五節句（旧暦）
var_export($dt->lunarSeasonalFestival);                       // <?php
var_export($dt->lunarSeasonalFestival);
?>

var_export($dt->lunarSeasonalFestivalName);                   // <?php
var_export($dt->lunarSeasonalFestivalName);
?>

var_export($dt->lunarSeasonalFestivalAlias);                  // <?php
var_export($dt->lunarSeasonalFestivalAlias);
?>


// 雑節

<?php
foreach ([
             JapaneseDateTime::MISC_SEASONAL_NODE_NONE             => '非雑節（空文字列が返ります）',
             JapaneseDateTime::MISC_SEASONAL_NODE_SETSUBUN          => '節分',
             JapaneseDateTime::MISC_SEASONAL_NODE_HIGAN             => '彼岸',
             JapaneseDateTime::MISC_SEASONAL_NODE_SHANICHI          => '社日',
             JapaneseDateTime::MISC_SEASONAL_NODE_HACHIJUHACHIYA    => '八十八夜',
             JapaneseDateTime::MISC_SEASONAL_NODE_NYUBAI            => '入梅',
             JapaneseDateTime::MISC_SEASONAL_NODE_HANGESHO          => '半夏生',
             JapaneseDateTime::MISC_SEASONAL_NODE_DOYO              => '土用',
             JapaneseDateTime::MISC_SEASONAL_NODE_NIHYAKUTOKA       => '二百十日',
             JapaneseDateTime::MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI => '二百二十日',
         ] as $key => $item) {
    echo "// {$key} => $item\n";
}
?>
var_export($dt->miscSeasonalNode);                            // <?php
var_export($dt->miscSeasonalNode);
?>

var_export($dt->miscSeasonalNodeText);                        // <?php
var_export($dt->miscSeasonalNodeText);
?>

var_export(JapaneseDateTime::parse('2026-02-03')->miscSeasonalNode);     // <?php
var_export(JapaneseDateTime::parse('2026-02-03')->miscSeasonalNode);
?>

var_export(JapaneseDateTime::parse('2026-02-03')->miscSeasonalNodeText); // <?php
var_export(JapaneseDateTime::parse('2026-02-03')->miscSeasonalNodeText);
?>


// 旧暦：月
var_export($dt->lunarMonth);                                  // <?php
var_export($dt->lunarMonth);
?>

var_export($dt->lunarMonthText);                              // <?php
var_export($dt->lunarMonthText);
?>

// 旧暦：年
var_export($dt->lunarYear);                                   // <?php
var_export($dt->lunarYear);
?>

// 旧暦：日
var_export($dt->lunarDay);                                    // <?php
var_export($dt->lunarDay);
?>

// 閏月かどうか
var_export($dt->isLeapMonth);                                // <?php
var_export($dt->isLeapMonth);
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


五節句
=================================================

五節句とは、年間の5つの節句（人日・上巳・端午・七夕・重陽）のことです。

`solarSeasonalFestival` / `solarSeasonalFestivalName` / `solarSeasonalFestivalAlias` は西暦の月日から判定し、
`lunarSeasonalFestival` / `lunarSeasonalFestivalName` / `lunarSeasonalFestivalAlias` は旧暦の月日から判定します。

| 定数 | 値 | 式名 | 別名 | 月日（西暦） |
|---|---|---|---|---|
| `SEASONAL_FESTIVAL_NONE` | 0 | （空文字列） | （空文字列） | — |
| `SEASONAL_FESTIVAL_JINJITSU` | 1 | 人日の節句 | 七草の節句 | 1月7日 |
| `SEASONAL_FESTIVAL_JOSHI` | 2 | 上巳の節句 | 桃の節句 | 3月3日 |
| `SEASONAL_FESTIVAL_TANGO` | 3 | 端午の節句 | 菖蒲の節句 | 5月5日 |
| `SEASONAL_FESTIVAL_TANABATA` | 4 | 七夕の節句 | 笹の節句 | 7月7日 |
| `SEASONAL_FESTIVAL_CHOYO` | 5 | 重陽の節句 | 菊の節句 | 9月9日 |

``` .php
$dt = JapaneseDateTime::parse('2026-07-07');

var_export($dt->solarSeasonalFestival);      // <?php
var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestival);
?>

var_export($dt->solarSeasonalFestivalName);  // <?php
var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestivalName);
?>

var_export($dt->solarSeasonalFestivalAlias); // <?php
var_export(JapaneseDateTime::parse('2026-07-07')->solarSeasonalFestivalAlias);
?>

```


十二支・十干・六十干支
=================================================

**十二支**（じゅうにし）は「子・丑・寅・卯・辰・巳・午・未・申・酉・戌・亥」の12年サイクルです。

**十干**（じっかん）は「甲・乙・丙・丁・戊・己・庚・辛・壬・癸」の10年サイクルです。

**六十干支**（ろくじっかんし）は十干と十二支の最小公倍数である60年周期の組み合わせで、
`heavenlyStemText` と `orientalZodiacText` を連結することで表現できます（例：「甲子」「丙午」）。

| 定数（十二支） | 値 | 表記 |
|---|---|---|
| `ORIENTAL_ZODIAC_I` | 0 | 亥 |
| `ORIENTAL_ZODIAC_NE` | 1 | 子 |
| `ORIENTAL_ZODIAC_USHI` | 2 | 丑 |
| `ORIENTAL_ZODIAC_TORA` | 3 | 寅 |
| `ORIENTAL_ZODIAC_U` | 4 | 卯 |
| `ORIENTAL_ZODIAC_TATSU` | 5 | 辰 |
| `ORIENTAL_ZODIAC_MI` | 6 | 巳 |
| `ORIENTAL_ZODIAC_UMA` | 7 | 午 |
| `ORIENTAL_ZODIAC_HITSUJI` | 8 | 未 |
| `ORIENTAL_ZODIAC_SARU` | 9 | 申 |
| `ORIENTAL_ZODIAC_TORI` | 10 | 酉 |
| `ORIENTAL_ZODIAC_INU` | 11 | 戌 |

| 定数（十干） | 値 | 表記 |
|---|---|---|
| `HEAVENLY_STEM_KINOE` | 0 | 甲（きのえ） |
| `HEAVENLY_STEM_KINOTO` | 1 | 乙（きのと） |
| `HEAVENLY_STEM_HINOE` | 2 | 丙（ひのえ） |
| `HEAVENLY_STEM_HINOTO` | 3 | 丁（ひのと） |
| `HEAVENLY_STEM_TSUCHINOE` | 4 | 戊（つちのえ） |
| `HEAVENLY_STEM_TSUCHINOTO` | 5 | 己（つちのと） |
| `HEAVENLY_STEM_KANOE` | 6 | 庚（かのえ） |
| `HEAVENLY_STEM_KANOTO` | 7 | 辛（かのと） |
| `HEAVENLY_STEM_MIZUNOE` | 8 | 壬（みずのえ） |
| `HEAVENLY_STEM_MIZUNOTO` | 9 | 癸（みずのと） |

``` .php
$dt = JapaneseDateTime::parse('2026-05-29');

// 十二支
var_export($dt->orientalZodiac);     // <?php
var_export(JapaneseDateTime::parse('2026-05-29')->orientalZodiac);
?>

var_export($dt->orientalZodiacText); // <?php
var_export(JapaneseDateTime::parse('2026-05-29')->orientalZodiacText);
?>


// 十干
var_export($dt->heavenlyStem);       // <?php
var_export(JapaneseDateTime::parse('2026-05-29')->heavenlyStem);
?>

var_export($dt->heavenlyStemText);   // <?php
var_export(JapaneseDateTime::parse('2026-05-29')->heavenlyStemText);
?>


// 六十干支（十干 + 十二支）
var_export($dt->heavenlyStemText . $dt->orientalZodiacText); // <?php
var_export(JapaneseDateTime::parse('2026-05-29')->heavenlyStemText . JapaneseDateTime::parse('2026-05-29')->orientalZodiacText);
?>

```


雑節
=================================================

雑節（ざっせつ）とは、節分・彼岸・社日・八十八夜・入梅・半夏生・土用・二百十日・二百二十日などの
季節の節目を指します。

| 定数 | 値 | 名称 |
|---|---|---|
| `MISC_SEASONAL_NODE_NONE` | 0 | （非雑節、空文字列が返ります） |
| `MISC_SEASONAL_NODE_SETSUBUN` | 1 | 節分 |
| `MISC_SEASONAL_NODE_HIGAN` | 2 | 彼岸 |
| `MISC_SEASONAL_NODE_SHANICHI` | 3 | 社日 |
| `MISC_SEASONAL_NODE_HACHIJUHACHIYA` | 4 | 八十八夜 |
| `MISC_SEASONAL_NODE_NYUBAI` | 5 | 入梅 |
| `MISC_SEASONAL_NODE_HANGESHO` | 6 | 半夏生 |
| `MISC_SEASONAL_NODE_DOYO` | 7 | 土用 |
| `MISC_SEASONAL_NODE_NIHYAKUTOKA` | 8 | 二百十日 |
| `MISC_SEASONAL_NODE_NIHYAKUNIJUUNICHI` | 9 | 二百二十日 |

``` .php
$dt = JapaneseDateTime::parse('2026-02-03');

var_export($dt->miscSeasonalNode);     // <?php
var_export(JapaneseDateTime::parse('2026-02-03')->miscSeasonalNode);
?>

var_export($dt->miscSeasonalNodeText); // <?php
var_export(JapaneseDateTime::parse('2026-02-03')->miscSeasonalNodeText);
?>

var_export(JapaneseDateTime::parse('2026-05-02')->miscSeasonalNode);     // <?php
var_export(JapaneseDateTime::parse('2026-05-02')->miscSeasonalNode);
?>

var_export(JapaneseDateTime::parse('2026-05-02')->miscSeasonalNodeText); // <?php
var_export(JapaneseDateTime::parse('2026-05-02')->miscSeasonalNodeText);
?>

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
echo $dt->nextHoliday();                  // <?php
echo JapaneseDateTime::parse('2024-01-01')->nextHoliday();
?>

// 次の「大安」を取得する
$dt = JapaneseDateTime::parse('2024-01-01');
echo $dt->nextSixWeek(JapaneseDateTime::SIX_WEEKDAY_TAIAN);

```


DateTime 営業日機能
=================================================

`JapaneseDate\DateTime` には、インスタンスに対して直接営業日を操作するメソッドが用意されています。

デフォルト設定では土日・祝日が休業日として扱われます。

``` .php
use JapaneseDate\DateTime as JapaneseDateTime;

$dt = JapaneseDateTime::parse('2026-05-29'); // 金曜日

// 営業日かどうかを判定する
var_export($dt->isBusinessDay());             // <?php
var_export(JapaneseDateTime::parse('2026-05-29')->isBusinessDay());
?>


var_export(JapaneseDateTime::parse('2026-05-30')->isBusinessDay());   // 土曜日 // <?php
var_export(JapaneseDateTime::parse('2026-05-30')->isBusinessDay());
?>


// 休業日のラベルを取得する（setClosingDay で設定したラベルを返す。土日・祝日は null）
$dt2 = JapaneseDateTime::parse('2026-05-29');
$dt2->setClosingDay('2026-05-29', '創立記念日');
var_export($dt2->getBusinessDayLabel());    // <?php
$dt2 = JapaneseDateTime::parse('2026-05-29');
$dt2->setClosingDay('2026-05-29', '創立記念日');
var_export($dt2->getBusinessDayLabel());
?>


// 次の営業日を取得する
echo $dt->nextBusinessDay()->format('Y-m-d'); // <?php
echo JapaneseDateTime::parse('2026-05-29')->nextBusinessDay()->format('Y-m-d');
?>


// 前の営業日を取得する
echo $dt->previousBusinessDay()->format('Y-m-d'); // <?php
echo JapaneseDateTime::parse('2026-05-29')->previousBusinessDay()->format('Y-m-d');
?>


// 休業日の場合は翌営業日にシフト、営業日ならそのまま返す
echo JapaneseDateTime::parse('2026-05-30')->shiftToClosestBusinessDayAfter()->format('Y-m-d'); // <?php
echo JapaneseDateTime::parse('2026-05-30')->shiftToClosestBusinessDayAfter()->format('Y-m-d');
?>


// 休業日の場合は前営業日にシフト、営業日ならそのまま返す
echo JapaneseDateTime::parse('2026-05-30')->shiftToClosestBusinessDayBefore()->format('Y-m-d'); // <?php
echo JapaneseDateTime::parse('2026-05-30')->shiftToClosestBusinessDayBefore()->format('Y-m-d');
?>


// N 営業日後の日付を取得する
echo $dt->addBusinessDays(3)->format('Y-m-d'); // <?php
echo JapaneseDateTime::parse('2026-05-29')->addBusinessDays(3)->format('Y-m-d');
?>


// N 営業日前の日付を取得する
echo $dt->subBusinessDays(3)->format('Y-m-d'); // <?php
echo JapaneseDateTime::parse('2026-05-29')->subBusinessDays(3)->format('Y-m-d');
?>

```

インスタンスごとに営業日設定をカスタマイズすることもできます。

``` .php
use JapaneseDate\DateTime as JapaneseDateTime;

$dt = JapaneseDateTime::parse('2026-05-29');

// 土日のみ休業日とし、祝日は営業日として扱う
$dt->setClosingWeekdays([JapaneseDateTime::SATURDAY, JapaneseDateTime::SUNDAY]);
$dt->setBypassHoliday(false);

// 特定日を休業日（任意ラベル付き）として登録する
$dt->setClosingDay('2026-06-01', '創立記念日');

// 特定日を営業日として強制登録する（祝日・休業曜日でも営業日とする）
$dt->setOpenDay('2026-05-04');

// 第N曜日を休業日として登録する（例：第1土曜）
$dt->setClosingNthWeekday(JapaneseDateTime::SATURDAY, 1, '第1土曜休業');

// 独自フィルタで営業日判定をカスタマイズする
$dt->addClosingFilter(function (\DateTimeInterface $date): bool {
    // 例：毎月末日を休業日にする
    return (int)$date->format('d') === (int)$date->format('t');
}, '月末休業');

var_export($dt->checkIsBusinessDay());  // 現在のインスタンスの日付で営業日判定
var_export($dt->checkIsBusinessDay(JapaneseDateTime::parse('2026-06-01')));  // 任意の日付で判定

```

`DateTime` クラスで使用できる主な営業日メソッド:

| メソッド | 説明 |
|---|---|
| `isBusinessDay()` | この日が営業日かどうかを返す |
| `getBusinessDayLabel()` | 休業日の場合はそのラベルを返す（営業日は null） |
| `nextBusinessDay()` | 次の営業日を返す |
| `previousBusinessDay()` | 前の営業日を返す |
| `shiftToClosestBusinessDayAfter()` | 休業日なら翌営業日、営業日ならそのまま返す |
| `shiftToClosestBusinessDayBefore()` | 休業日なら前営業日、営業日ならそのまま返す |
| `addBusinessDays(int $n)` | N 営業日後の日付を返す |
| `subBusinessDays(int $n)` | N 営業日前の日付を返す |
| `setClosingWeekdays(array $weekdays)` | 休業曜日を配列で設定 |
| `setBypassHoliday(bool $bypass)` | 祝日を休業日として扱うか設定 |
| `setClosingDay($date, ?string $label)` | 特定日を休業日として登録 |
| `setOpenDay($date)` | 特定日を強制的に営業日として登録 |
| `setClosingNthWeekday(int $weekday, int $nth, ?string $label)` | 第N曜日を休業日として登録 |
| `setOpenNthWeekday(int $weekday, int $nth)` | 第N曜日を強制的に営業日として登録 |
| `addClosingFilter(callable $filter, ?string $label)` | 独自の休業日フィルタを追加 |
| `addOpenFilter(callable $filter)` | 独自の営業日強制フィルタを追加 |
| `checkIsBusinessDay(?DateTimeInterface $date)` | 任意の日付で営業日判定（省略時は自身の日付） |
| `checkGetBusinessDayLabel(?DateTimeInterface $date)` | 任意の日付で休業ラベル取得 |


DateTimeImmutable
=================================================

`JapaneseDate\DateTimeImmutable` クラスは、[CarbonImmutable](https://carbon.nesbot.com/)を継承した
イミュータブルな日本暦対応オブジェクトです。

```DateTimeImmutable.php
<?= $open_tag ?>

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
echo $dt->format('Y-m-d');   // <?php
echo \JapaneseDate\DateTimeImmutable::parse('2024-03-20')->format('Y-m-d');
?>

echo $dt2->format('Y-m-d');  // <?php
echo \JapaneseDate\DateTimeImmutable::parse('2024-03-20')->addDays(1)->format('Y-m-d');
?>

// 日本暦プロパティも同様に使用できます
$dt = JapaneseDateTimeImmutable::parse('2024-03-20');
var_export($dt->solarTermText);  // <?php
var_export(\JapaneseDate\DateTimeImmutable::parse('2024-03-20')->solarTermText);
?>

var_export($dt->eraName);        // <?php
var_export(\JapaneseDate\DateTimeImmutable::parse('2024-03-20')->eraName);
?>

var_export($dt->eraYear);        // <?php
var_export(\JapaneseDate\DateTimeImmutable::parse('2024-03-20')->eraYear);
?>

```


Calendar
=================================================

`JapaneseDate\Calendar` クラスは、一定期間内の日付配列や営業日配列を取得するためのユーティリティクラスです。
`JapaneseDate\DatePeriod`でもほぼ同じことができます。
類似クラスがあるのはCalendarクラスがDatePeriodが誕生するより前から存在しているためで、DatePeriodクラスの方が新しいクラスになります。

``` .php
use JapaneseDate\Calendar as JapaneseDateCalendar;

// 指定月の全日付を取得
$calendar = new JapaneseDateCalendar('2024-03-01');
$dates = $calendar->getDatesOfMonth();
echo count($dates);  // <?php
$calendar = new \JapaneseDate\Calendar('2024-03-01');
echo count($calendar->getDatesOfMonth());
?>

// 期間内の営業日（土日を除く）を取得
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
$calendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
$workDays = $calendar->getWorkingDayBySpan('2024-03-31');
echo count($workDays);  // <?php
$calendar = new \JapaneseDate\Calendar('2024-03-01');
$calendar->addBypassWeekDay(\JapaneseDate\DateTime::SATURDAY);
$calendar->addBypassWeekDay(\JapaneseDate\DateTime::SUNDAY);
echo count($calendar->getWorkingDayBySpan('2024-03-31'));
?>

// 祝日も除外する
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
$calendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
$calendar->setBypassHoliday(true);
$workDays = $calendar->getWorkingDayBySpan('2024-03-31');
echo count($workDays);  // <?php
$calendar = new \JapaneseDate\Calendar('2024-03-01');
$calendar->addBypassWeekDay(\JapaneseDate\DateTime::SATURDAY);
$calendar->addBypassWeekDay(\JapaneseDate\DateTime::SUNDAY);
$calendar->setBypassHoliday(true);
echo count($calendar->getWorkingDayBySpan('2024-03-31'));
?>

// 件数指定で営業日を取得
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassWeekDay(JapaneseDateTime::SATURDAY);
$calendar->addBypassWeekDay(JapaneseDateTime::SUNDAY);
$workDays = $calendar->getWorkingDay(10);
echo count($workDays);  // <?php
$calendar = new \JapaneseDate\Calendar('2024-03-01');
$calendar->addBypassWeekDay(\JapaneseDate\DateTime::SATURDAY);
$calendar->addBypassWeekDay(\JapaneseDate\DateTime::SUNDAY);
echo count($calendar->getWorkingDay(10));
?>

// 特定日をスキップする
$calendar = new JapaneseDateCalendar('2024-03-01');
$calendar->addBypassDay('2024-03-11');
$calendar->addBypassDay('2024-03-22');
$workDays = $calendar->getWorkingDayBySpan('2024-03-15');
echo count($workDays);  // <?php
$calendar = new \JapaneseDate\Calendar('2024-03-01');
$calendar->addBypassDay('2024-03-11');
$calendar->addBypassDay('2024-03-22');
echo count($calendar->getWorkingDayBySpan('2024-03-15'));
?>

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
<?php
use JapaneseDate\CacheMode;

JapaneseDateTime::setCacheMode(CacheMode::MODE_NONE);
?>
```
を使用してください。
静的に処理されるため、同一Request内では、次にsetCacheModeするまでは同一のキャッシュモードが使用されることに注意してください。

キャッシュモードの切り替えは、`JapaneseDateTime::setCacheMode`での切り替え以外に、
[JapaneseDateTime::setCacheFilePath](https://github.com/suzunone/JapaneseDate/blob/master/docs/api/JapaneseDate/DateTime.md)を使用してキャッシュファイルのパスを指定したり、
[JapaneseDateTime::setCacheClosure](https://github.com/suzunone/JapaneseDate/blob/master/docs/api/JapaneseDate/DateTime.md)をして、独自のキャッシュロジックを登録することでも切り替えることができます。


DateInterval
=================================================

`JapaneseDate\DateInterval` クラスは、[CarbonInterval](https://carbon.nesbot.com/)を継承した
日本暦に対応した期間（インターバル）クラスです。

```DateInterval.php
<?= $open_tag ?>

namespace JapaneseDate;

class DateInterval extends \Carbon\CarbonInterval
{

}
```

営業日計算・六曜・元号・二十四節気・旧暦（月相）に基づく期間操作機能を提供します。

``` .php
use JapaneseDate\DateInterval;
use JapaneseDate\DateTime as JapaneseDateTime;

// N 営業日後の日付を取得する（土日・祝日をスキップ）
$from = JapaneseDateTime::parse('2026-05-01');
$result = DateInterval::addBusinessDaysToDate($from, 3);
echo $result->format('Y-m-d');  // <?php
use JapaneseDate\DateInterval;
use JapaneseDate\DatePeriod;
echo DateInterval::addBusinessDaysToDate(JapaneseDateTime::parse('2026-05-01'), 3)->format('Y-m-d');
?>


// N 営業日前の日付を取得する
$result = DateInterval::subBusinessDaysToDate($from, 3);
echo $result->format('Y-m-d');  // <?php
echo DateInterval::subBusinessDaysToDate(JapaneseDateTime::parse('2026-05-11'), 3)->format('Y-m-d');
?>


// 次の祝日までの残り期間を DateInterval として取得する
$interval = DateInterval::untilNextHoliday(JapaneseDateTime::parse('2026-05-01'));
echo $interval->days . '日後が次の祝日';  // <?php
$iv = DateInterval::untilNextHoliday(JapaneseDateTime::parse('2026-05-01'));
echo $iv->days . '日後が次の祝日';
?>


// 次の大安までの残り期間を取得する
$interval = DateInterval::untilNextSixWeek(
    JapaneseDateTime::parse('2026-05-01'),
    JapaneseDateTime::SIX_WEEKDAY_TAIAN
);
echo $interval->days . '日後が次の大安';  // <?php
$iv2 = DateInterval::untilNextSixWeek(JapaneseDateTime::parse('2026-05-01'), JapaneseDateTime::SIX_WEEKDAY_TAIAN);
echo $iv2->days . '日後が次の大安';
?>


// 令和の継続期間を取得する
$interval = DateInterval::eraSpan(JapaneseDateTime::ERA_REIWA, JapaneseDateTime::parse('2026-05-01'));
echo $interval->y . '年' . $interval->m . 'ヶ月';  // <?php
$iv3 = DateInterval::eraSpan(JapaneseDateTime::ERA_REIWA, JapaneseDateTime::parse('2026-05-01'));
echo $iv3->y . '年' . $iv3->m . 'ヶ月';
?>


// 30日が何節気分かを換算する
$interval = new DateInterval('P30D');
echo round($interval->toSolarTermCount(), 1) . '節気分';  // <?php
$iv4 = new DateInterval('P30D');
echo round($iv4->toSolarTermCount(), 1) . '節気分';
?>


// 59日が何朔望月分かを換算する
$interval = new DateInterval('P59D');
echo round($interval->toLunarMonthCount(), 1) . '朔望月';  // <?php
$iv5 = new DateInterval('P59D');
echo round($iv5->toLunarMonthCount(), 1) . '朔望月';
?>


// 次の新月までの残り日数を取得する
$interval = DateInterval::untilNextNewMoon(JapaneseDateTime::parse('2026-05-01'));
echo $interval->days . '日後が次の新月';  // <?php
$iv6 = DateInterval::untilNextNewMoon(JapaneseDateTime::parse('2026-05-01'));
echo $iv6->days . '日後が次の新月';
?>

```

`DateInterval` クラスで使用できる主なメソッド:

| メソッド | 説明 |
|---|---|
| `addBusinessDaysToDate(DateTime $from, int $n)` | N 営業日後の日付を返す（static） |
| `subBusinessDaysToDate(DateTime $from, int $n)` | N 営業日前の日付を返す（static） |
| `isBusinessDay(DateTime $date)` | 営業日かどうかを返す（static） |
| `untilNextHoliday(DateTime $from)` | 次の祝日までの期間を返す（static） |
| `untilNextSixWeek(DateTime $from, int $sixWeekday)` | 次の指定六曜までの期間を返す（static） |
| `eraSpan(int $eraKey, ?DateTime $until)` | 元号の継続期間を返す（static） |
| `untilNextSolarTerm(DateTime $from, ?string $termMethod)` | 次の節気までの期間を返す（static） |
| `addSolarTermsToDate(DateTime $from, int $n)` | N 節気後の日付を返す（static） |
| `subSolarTermsToDate(DateTime $from, int $n)` | N 節気前の日付を返す（static） |
| `toSolarTermCount()` | 保持する日数を節気数に換算する |
| `toLunarMonthCount()` | 保持する日数を朔望月数に換算する |
| `untilNextNewMoon(DateTime $from)` | 次の新月までの期間を返す（static） |


DatePeriod
=================================================

`JapaneseDate\DatePeriod` クラスは、[CarbonPeriod](https://carbon.nesbot.com/)を継承した
日本暦に対応した期間イテレータクラスです。

```DatePeriod.php
<?= $open_tag ?>

namespace JapaneseDate;

class DatePeriod extends \Carbon\CarbonPeriod
{

}
```

フィルタメソッドはメソッドチェーンで接続でき、`foreach` で直接利用可能なイテレータを返します。

``` .php
use JapaneseDate\DatePeriod;
use JapaneseDate\DateTime as JapaneseDateTime;

// 2026年度の祝日のみを取得する
$period = DatePeriod::create('2026-04-01', '1 day', '2027-03-31')
    ->onlyHolidays();

foreach ($period as $date) {
    $jd = JapaneseDateTime::factory($date);
    echo $jd->format('Y-m-d') . ' ' . $jd->holidayText . PHP_EOL;
}

// 2026年5月の大安のみを取得する
$taianDays = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
    ->onlySixWeekday(JapaneseDateTime::SIX_WEEKDAY_TAIAN);

// 2026年5月の営業日のみを取得する（土日・祝日を除外）
$businessDays = DatePeriod::create('2026-05-01', '1 day', '2026-05-31')
    ->onlyWeekdays();

echo count(iterator_to_array($businessDays)) . '営業日';  // <?php
echo count(iterator_to_array(DatePeriod::create('2026-05-01', '1 day', '2026-05-31')->onlyWeekdays())) . '営業日';
?>


// 2026年の節気区切りでイテレートする
$period = DatePeriod::eachSolarTerm(
    JapaneseDateTime::parse('2026-01-01'),
    JapaneseDateTime::parse('2026-03-31')
);

foreach ($period as $date) {
    $jd = JapaneseDateTime::factory($date);
    echo $jd->format('Y-m-d') . ' ' . $jd->solarTermText . PHP_EOL;
}

// 2026年から4ヶ月分の旧暦朔日を取得する
$period = DatePeriod::eachLunarMonth(JapaneseDateTime::parse('2026-01-01'), 4);
foreach ($period as $date) {
    $jd = JapaneseDateTime::factory($date);
    echo $date->format('Y-m-d') . ' 旧暦' . $jd->lunarYear . '年' . $jd->lunarMonth . '月朔日' . PHP_EOL;
}

// 1988〜1990年の期間を元号で分割する
$fullPeriod = DatePeriod::create('1988-01-01', '1 day', '1990-12-31');
$split = $fullPeriod->splitByEra();
foreach ($split as $eraKey => $subPeriod) {
    $jd = JapaneseDateTime::factory($subPeriod->getStartDate());
    echo $jd->eraNameText . ': '
        . $subPeriod->getStartDate()->format('Y-m-d')
        . ' 〜 '
        . $subPeriod->getEndDate()->format('Y-m-d') . PHP_EOL;
}

// 令和6年度〜令和8年度の年度開始日を取得する
$period = DatePeriod::eachJapaneseFiscalYear(2024, 2026);
foreach ($period as $date) {
    $jd = JapaneseDateTime::factory($date);
    echo $jd->eraNameText . $jd->eraYear . '年度 (' . $date->format('Y/m/d') . ')' . PHP_EOL;
}

```

`DatePeriod` クラスで使用できる主なメソッド:

| メソッド | 説明 |
|---|---|
| `onlyHolidays()` | 祝日・休日のみを抽出するフィルタを追加 |
| `withoutHolidays()` | 祝日・休日を除外するフィルタを追加 |
| `withoutWeekends()` | 土日を除外するフィルタを追加 |
| `onlyWeekdays()` | 土日・祝日を除外した平日のみを抽出 |
| `onlyGotobi(string $adjust)` | 五十日（5・10・15・20・25・月末）かつ営業日のみを抽出 |
| `onlySixWeekday(int ...$sixWeekdays)` | 指定した六曜のみを抽出するフィルタを追加 |
| `withoutSixWeekday(int ...$sixWeekdays)` | 指定した六曜を除外するフィルタを追加 |
| `onlyDoyo()` | 土用期間内の日付のみを抽出するフィルタを追加 |
| `onlyHigan()` | 彼岸期間内の日付のみを抽出するフィルタを追加 |
| `eachSolarTerm(DateTime $start, DateTime $end)` | 節気区切りの DatePeriod を生成（static） |
| `eachLunarMonth(DateTime $start, int $months)` | 旧暦月の朔日を順次返す DatePeriod を生成（static） |
| `splitByEra()` | 元号ごとにサブ期間に分割して配列を返す |
| `eachJapaneseFiscalYear(int $start, int $end)` | 和暦年度開始日（4月1日）を順次返す DatePeriod を生成（static） |


<?php
$content = ob_get_contents();
ob_end_flush();
file_put_contents(__DIR__.'/docs/README.md', $content);
?>
