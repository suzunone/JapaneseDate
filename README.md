日本の祝日、暦など日本での日付処理(Date processing including Japanese holiday processing)
=========================================
[![CircleCI](https://circleci.com/gh/suzunone/JapaneseDate.svg?style=svg)](https://circleci.com/gh/suzunone/JapaneseDate)


Introduction
-----------------------------------------

日本の祝日、六曜、干支、和暦、日本語での曜日表記など、日本での日付処理をまとめた物です。
It is a package that summarizes the date processing in Japan such as Japanese national holidays, rokuyo, the Oriental zodiac, the Japanese calendar, and the day of the week in Japan.


主に以下の２つの機能を提供しています。
There are three main features:.

 - PHPの有名な日付処理ライブラリCarbonをextendし、日本の祝日や、旧暦を扱えるようにした`JapaneseDate\DateTime`
    - Carbon, PHP's famous date processing library, has been extended to handle Japanese holidays and the lunar calendar `JapaneseDate \DateTime`
 - `JapaneseDate\DateTime`のImmutableオブジェクトである、`JapaneseDate\DateTimeImmutable`
    -`JapaneseDate \DateTimeImmutable`, which is an Immutable object of `JapaneseDate \DateTimeImmutable`
 - 日付の配列を扱う、`JapaneseDate\Calendar`
    - works with date arrays, `JapaneseDate \Calendar`


Proviso
-----------------------------------------

この日付ライブラリは、かつて、[php.five-foxes.com](http://php.five-foxes.com) や、
[ENVIのサブパッケージ](https://github.com/EnviFramework/JapaneseDate) として公開していたものを、GitHubに移行したものです。

This date library was formerly known as [php.five-foxes.com] (http://php.five-foxes.com)
[ENVI Subpackages] (formerly known as https://github.com/EnviFramework/JapaneseDate) has been migrated to GitHub.


How to use
-----------------------------------------

 - [Documents](https://github.com/suzunone/JapaneseDate/blob/v5.X/docs/Man.md)
 - [API Documents](https://github.com/suzunone/JapaneseDate/blob/v5.X/docs/README.md)



Installation Instructions
-----------------------------------------
### Composer
```
composer require japanese-date/japanese-date
```


Update History Before Full GitHub Migration
-----------------------------------------
 * 2005年7月29日 Version 0.1
    * とりあえずの公開
 * 2005年8月 1日 Version 1.0
    * 振替休日判定を追加
    * 特定月1日が、翌月になってしまうバグを修正。
    * 春分の日    * 秋分の日取得メソッド変更。（メソッド名も変更になって居ます。
 * 2005年9月 1日 Version 1.0.1
    * ソースのコメント修正
 * 2005年9月30日 Version 1.1
    * メソッド追加
 * 2005年11月22日 Version 1.2
    * Noticeが出ていたのを消しました。
 * 2006年3月29日 Version 1.3
    * サンプルを変更
    * mb_strftime()の挙動を修正。
    * PHP5で動作確認取りました。
    * 定数をJD_からはじめるように変更しました。
    * Stableに
 * 2006年6月19日 Version 1.4
    * 旧暦計算を付けました。
    * 六曜計算を正しく出来るようにしました。

 * 2006年10月 5日 Version 1.5
    * 営業日計算できるようにしました。

 * 2007年8月16日 Version 1.6
    * mb_strftime()に$luna引数を追加しました。
    * そのほかで使用している、$luna引数に付いての説明が抜けていたのをつけました。
    * 旧暦計算は、月の満ち欠けの計算をしていたりして、結構重いです。
    * 旧暦を使用せずに、祝日などの計算だけしたい場合は、$luna引数を、falseにすることで、高速に動作します。
    * (秋分の日、春分の日も別ロジックで求めているので、旧暦とは切り離して平気です。)


 * 2008年1月 9日 Version 1.7
    * バグ報告を受けた平成天皇誕生日が昭和でも休みになってしまっていたのを修正しました。
    * ありがとうございました。

 * 2010年8月30日  Version 1.7
    * getSpanCalendarが、$luna引数が効いていなかったので修正しました。

 * 2012年02月3日  Version 2.0
    * PHP5 専用に書きなおしました。
    * 山の日に対応しました。

 * 2016年05月13日  Version 2.1
    * Git Hub化しました

 * 2016年05月18日  Version 3
    * PHP5に正式対応

 * 2018年05月4日  Version 4
    * PHP7に正式対応



* July 29, 2005 Version 0.1
* tentative release
* August 1, 2005 Version 1.0
* Add substitute holiday judgment
* Fixed a bug that caused the 1st of a specific month to become the next month.
* Vernal Equinox Day * Autumnal Equinox Day acquisition method changed. (The method name has also been changed.).
* September 1, 2005 Version 1.0. 1
* Modify Source Comments
* September 30, 2005 Version 1.1
* Add Method
* November 22, 2005 Version 1.2
* I deleted the notice.
* March 29, 2006 Version 1.3
* Modify Sample
* Fix mb _ strftime () behavior.
* I got it working in PHP 5.
* Change constants to start with JD _ (Tom).
* To Stable
* June 19, 2006 Version 1.4
* I added the lunar calendar.
* I made it possible to calculate rokuyo correctly.

* October 5, 2006 Version 1.5
* I made it possible to calculate business days.

* August 16, 2007 Version 1.6
* Add $luna argument to mb _ strftime ().
* I left out the description of the $luna argument used elsewhere.
* The calculation of the lunar calendar is quite heavy because it calculates the phases of the moon.
* If you don't want to use the lunar calendar, but just want to calculate holidays and so on, you can set the $luna argument to false for faster performance.
* (The Autumnal Equinox Day and the Spring Equinox Day are determined by different logic, so they can be separated from the old calendar.)


* January 9, 2008 Version 1.7
* I have corrected the fact that Emperor Heisei's Birthday which I received a bug report was closed even in Showa era.
* Thank you very much.

* August 30, 2010 Version 1.7
* Fixed getSpanCalendar because the $luna argument was not working.

* February 3, 2012 Version 2.0
* Rewritten specifically for PHP 5.
* I dealt with the mountain day.

* May 13, 2016 Version 2.1
* into a Git Hub.

* May 18, 2016 Version 3
* PHP 5 officially supported

* May 4, 2018 Version 4
* PHP 7 officially supported
