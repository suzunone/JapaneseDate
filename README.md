JapaneseDate
=========================================
[![CircleCI](https://circleci.com/gh/suzunone/JapaneseDate.svg?style=svg)](https://circleci.com/gh/suzunone/JapaneseDate)

はじめに
-----------------------------------------
このLibraryは、かつて、[php.five-foxes.com](http://php.five-foxes.com) や、
[ENVIのサブパッケージ](https://github.com/EnviFramework/JapaneseDate) として公開していたものを、GitHubに移行したものです。


使用方法
-----------------------------------------

 - [ドキュメント](https://github.com/suzunone/JapaneseDate/blob/v4.X/docs/Man.md)
 - [APIドキュメント](https://github.com/suzunone/JapaneseDate/blob/v4.X/docs/README.md)


概要
-----------------------------------------

日本の祝日、六曜、干支、日本語での曜日表記など、日本での日付処理をまとめた物です。

インストール手順
-----------------------------------------

### Composer
composer require japanese-date/japanese-date


更新履歴
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
