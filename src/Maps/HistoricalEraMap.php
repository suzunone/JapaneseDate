<?php

/**
 * HistoricalEraMap.php
 *
 * 大化から現代までのすべての元号データを保持するマッピングクラスです。
 * 親クラス {@see \JapaneseDate\Maps\Map} の Lazy Loading 機構を利用し、
 * データが必要になるまで配列の初期化コストを回避します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Maps
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace JapaneseDate\Maps;

use JapaneseDate\DateTime;

/**
 * 大化〜令和の全元号マッピングデータを提供するクラス。
 *
 * 南北朝時代（1331年〜1392年）は北朝・南朝の元号が並存するため、
 * 同一期間に複数のエントリが存在します。
 * `court` キーで {@see DateTime::COURT_NORTH}・
 * {@see DateTime::COURT_SOUTH}・
 * {@see DateTime::COURT_MAIN} を区別します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Maps
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */
class HistoricalEraMap extends Map
{
    /**
     * 大化から令和までの元号マッピング配列。
     *
     * 各要素のキー:
     * - `start` : 元号開始日（ISO 8601 形式、JST）
     * - `end`   : 元号終了日（ISO 8601 形式、JST）
     * - `name`  : 元号名（漢字）
     * - `kana`  : 元号読み（カタカナ）
     * - `court` : 朝廷区分（`DateTime::COURT_MAIN` / `COURT_NORTH` / `COURT_SOUTH`）
     *
     * @var array<int, array<string, string>>
     */
    protected array $map = [
        ['start' => '645-07-29T00:00:00+09:00', 'end' => '650-03-22T00:00:00+09:00', 'name' => '大化', 'kana' => 'タイカ', 'court' => Datetime::COURT_MAIN],
        ['start' => '650-03-22T00:00:00+09:00', 'end' => '655-02-11T00:00:00+09:00', 'name' => '白雉', 'kana' => 'ハクチ', 'court' => Datetime::COURT_MAIN],
        ['start' => '686-08-14T00:00:00+09:00', 'end' => '687-02-17T00:00:00+09:00', 'name' => '朱鳥', 'kana' => 'シュチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '701-05-03T00:00:00+09:00', 'end' => '704-06-16T00:00:00+09:00', 'name' => '大宝', 'kana' => 'タイホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '704-06-16T00:00:00+09:00', 'end' => '708-02-07T00:00:00+09:00', 'name' => '慶雲', 'kana' => 'ケイウン', 'court' => Datetime::COURT_MAIN],
        ['start' => '708-02-07T00:00:00+09:00', 'end' => '715-10-03T00:00:00+09:00', 'name' => '和銅', 'kana' => 'ワドウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '715-10-03T00:00:00+09:00', 'end' => '717-12-24T00:00:00+09:00', 'name' => '霊亀', 'kana' => 'レイキ', 'court' => Datetime::COURT_MAIN],
        ['start' => '717-12-24T00:00:00+09:00', 'end' => '724-03-03T00:00:00+09:00', 'name' => '養老', 'kana' => 'ヨウロウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '724-03-03T00:00:00+09:00', 'end' => '729-09-02T00:00:00+09:00', 'name' => '神亀', 'kana' => 'ジンキ', 'court' => Datetime::COURT_MAIN],
        ['start' => '729-09-02T00:00:00+09:00', 'end' => '749-05-04T00:00:00+09:00', 'name' => '天平', 'kana' => 'テンピョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '749-05-04T00:00:00+09:00', 'end' => '749-08-19T00:00:00+09:00', 'name' => '天平感宝', 'kana' => 'テンピョウカンポウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '749-08-19T00:00:00+09:00', 'end' => '757-09-06T00:00:00+09:00', 'name' => '天平勝宝', 'kana' => 'テンピョウショウホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '757-09-06T00:00:00+09:00', 'end' => '765-02-01T00:00:00+09:00', 'name' => '天平宝字', 'kana' => 'テンピョウホウジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '765-02-01T00:00:00+09:00', 'end' => '767-09-13T00:00:00+09:00', 'name' => '天平神護', 'kana' => 'テンピョウジンゴ', 'court' => Datetime::COURT_MAIN],
        ['start' => '767-09-13T00:00:00+09:00', 'end' => '770-10-23T00:00:00+09:00', 'name' => '神護景雲', 'kana' => 'ジンゴケイウン', 'court' => Datetime::COURT_MAIN],
        ['start' => '770-10-23T00:00:00+09:00', 'end' => '781-01-30T00:00:00+09:00', 'name' => '宝亀', 'kana' => 'ホウキ', 'court' => Datetime::COURT_MAIN],
        ['start' => '781-01-30T00:00:00+09:00', 'end' => '782-09-30T00:00:00+09:00', 'name' => '天応', 'kana' => 'テンオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '782-09-30T00:00:00+09:00', 'end' => '806-06-08T00:00:00+09:00', 'name' => '延暦', 'kana' => 'エンリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '806-06-08T00:00:00+09:00', 'end' => '810-10-20T00:00:00+09:00', 'name' => '大同', 'kana' => 'ダイドウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '810-10-20T00:00:00+09:00', 'end' => '824-02-08T00:00:00+09:00', 'name' => '弘仁', 'kana' => 'コウニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '824-02-08T00:00:00+09:00', 'end' => '834-02-14T00:00:00+09:00', 'name' => '天長', 'kana' => 'テンチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '834-02-14T00:00:00+09:00', 'end' => '848-07-16T00:00:00+09:00', 'name' => '承和', 'kana' => 'ジョウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '848-07-16T00:00:00+09:00', 'end' => '851-06-01T00:00:00+09:00', 'name' => '嘉祥', 'kana' => 'カショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '851-06-01T00:00:00+09:00', 'end' => '854-12-23T00:00:00+09:00', 'name' => '仁寿', 'kana' => 'ニンジュ', 'court' => Datetime::COURT_MAIN],
        ['start' => '854-12-23T00:00:00+09:00', 'end' => '857-03-20T00:00:00+09:00', 'name' => '斉衡', 'kana' => 'サイコウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '857-03-20T00:00:00+09:00', 'end' => '859-05-20T00:00:00+09:00', 'name' => '天安', 'kana' => 'テンアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '859-05-20T00:00:00+09:00', 'end' => '877-06-01T00:00:00+09:00', 'name' => '貞観', 'kana' => 'ジョウガン', 'court' => Datetime::COURT_MAIN],
        ['start' => '877-06-01T00:00:00+09:00', 'end' => '885-03-11T00:00:00+09:00', 'name' => '元慶', 'kana' => 'ガンギョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '885-03-11T00:00:00+09:00', 'end' => '889-05-30T00:00:00+09:00', 'name' => '仁和', 'kana' => 'ニンナ', 'court' => Datetime::COURT_MAIN],
        ['start' => '889-05-30T00:00:00+09:00', 'end' => '898-05-20T00:00:00+09:00', 'name' => '寛平', 'kana' => 'カンピョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '898-05-20T00:00:00+09:00', 'end' => '901-08-31T00:00:00+09:00', 'name' => '昌泰', 'kana' => 'ショウタイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '901-08-31T00:00:00+09:00', 'end' => '923-05-29T00:00:00+09:00', 'name' => '延喜', 'kana' => 'エンギ', 'court' => Datetime::COURT_MAIN],
        ['start' => '923-05-29T00:00:00+09:00', 'end' => '931-05-16T00:00:00+09:00', 'name' => '延長', 'kana' => 'エンチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '931-05-16T00:00:00+09:00', 'end' => '938-06-22T00:00:00+09:00', 'name' => '承平', 'kana' => 'ジョウヘイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '938-06-22T00:00:00+09:00', 'end' => '947-05-15T00:00:00+09:00', 'name' => '天慶', 'kana' => 'テンギョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '947-05-15T00:00:00+09:00', 'end' => '957-11-21T00:00:00+09:00', 'name' => '天暦', 'kana' => 'テンリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '957-11-21T00:00:00+09:00', 'end' => '961-03-05T00:00:00+09:00', 'name' => '天徳', 'kana' => 'テントク', 'court' => Datetime::COURT_MAIN],
        ['start' => '961-03-05T00:00:00+09:00', 'end' => '964-08-19T00:00:00+09:00', 'name' => '応和', 'kana' => 'オウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '964-08-19T00:00:00+09:00', 'end' => '968-09-08T00:00:00+09:00', 'name' => '康保', 'kana' => 'コウホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '968-09-08T00:00:00+09:00', 'end' => '970-05-03T00:00:00+09:00', 'name' => '安和', 'kana' => 'アンナ', 'court' => Datetime::COURT_MAIN],
        ['start' => '970-05-03T00:00:00+09:00', 'end' => '974-01-16T00:00:00+09:00', 'name' => '天禄', 'kana' => 'テンロク', 'court' => Datetime::COURT_MAIN],
        ['start' => '974-01-16T00:00:00+09:00', 'end' => '976-08-11T00:00:00+09:00', 'name' => '天延', 'kana' => 'テンエン', 'court' => Datetime::COURT_MAIN],
        ['start' => '976-08-11T00:00:00+09:00', 'end' => '978-12-31T00:00:00+09:00', 'name' => '貞元', 'kana' => 'ジョウゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '978-12-31T00:00:00+09:00', 'end' => '983-05-29T00:00:00+09:00', 'name' => '天元', 'kana' => 'テンゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '983-05-29T00:00:00+09:00', 'end' => '985-05-19T00:00:00+09:00', 'name' => '永観', 'kana' => 'エイカン', 'court' => Datetime::COURT_MAIN],
        ['start' => '985-05-19T00:00:00+09:00', 'end' => '987-05-05T00:00:00+09:00', 'name' => '寛和', 'kana' => 'カンナ', 'court' => Datetime::COURT_MAIN],
        ['start' => '987-05-05T00:00:00+09:00', 'end' => '989-09-10T00:00:00+09:00', 'name' => '永延', 'kana' => 'エイエン', 'court' => Datetime::COURT_MAIN],
        ['start' => '989-09-10T00:00:00+09:00', 'end' => '990-11-26T00:00:00+09:00', 'name' => '永祚', 'kana' => 'エイソ', 'court' => Datetime::COURT_MAIN],
        ['start' => '990-11-26T00:00:00+09:00', 'end' => '995-03-25T00:00:00+09:00', 'name' => '正暦', 'kana' => 'ショウリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '995-03-25T00:00:00+09:00', 'end' => '999-02-01T00:00:00+09:00', 'name' => '長徳', 'kana' => 'チョウトク', 'court' => Datetime::COURT_MAIN],
        ['start' => '999-02-01T00:00:00+09:00', 'end' => '1004-08-08T00:00:00+09:00', 'name' => '長保', 'kana' => 'チョウホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1004-08-08T00:00:00+09:00', 'end' => '1013-02-08T00:00:00+09:00', 'name' => '寛弘', 'kana' => 'カンコウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1013-02-08T00:00:00+09:00', 'end' => '1017-05-21T00:00:00+09:00', 'name' => '長和', 'kana' => 'チョウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1017-05-21T00:00:00+09:00', 'end' => '1021-03-17T00:00:00+09:00', 'name' => '寛仁', 'kana' => 'カンニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1021-03-17T00:00:00+09:00', 'end' => '1024-08-19T00:00:00+09:00', 'name' => '治安', 'kana' => 'ジアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1024-08-19T00:00:00+09:00', 'end' => '1028-08-18T00:00:00+09:00', 'name' => '万寿', 'kana' => 'マンジュ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1028-08-18T00:00:00+09:00', 'end' => '1037-05-09T00:00:00+09:00', 'name' => '長元', 'kana' => 'チョウゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1037-05-09T00:00:00+09:00', 'end' => '1040-12-16T00:00:00+09:00', 'name' => '長暦', 'kana' => 'チョウリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1040-12-16T00:00:00+09:00', 'end' => '1044-12-16T00:00:00+09:00', 'name' => '長久', 'kana' => 'チョウキュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1044-12-16T00:00:00+09:00', 'end' => '1046-05-22T00:00:00+09:00', 'name' => '寛徳', 'kana' => 'カントク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1046-05-22T00:00:00+09:00', 'end' => '1053-02-02T00:00:00+09:00', 'name' => '永承', 'kana' => 'エイショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1053-02-02T00:00:00+09:00', 'end' => '1058-09-19T00:00:00+09:00', 'name' => '天喜', 'kana' => 'テンギ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1058-09-19T00:00:00+09:00', 'end' => '1065-09-04T00:00:00+09:00', 'name' => '康平', 'kana' => 'コウヘイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1065-09-04T00:00:00+09:00', 'end' => '1069-05-06T00:00:00+09:00', 'name' => '治暦', 'kana' => 'ジリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1069-05-06T00:00:00+09:00', 'end' => '1074-09-16T00:00:00+09:00', 'name' => '延久', 'kana' => 'エンキュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1074-09-16T00:00:00+09:00', 'end' => '1077-12-05T00:00:00+09:00', 'name' => '承保', 'kana' => 'ジョウホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1077-12-05T00:00:00+09:00', 'end' => '1081-03-22T00:00:00+09:00', 'name' => '承暦', 'kana' => 'ジョウリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1081-03-22T00:00:00+09:00', 'end' => '1084-03-15T00:00:00+09:00', 'name' => '永保', 'kana' => 'エイホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1084-03-15T00:00:00+09:00', 'end' => '1087-05-11T00:00:00+09:00', 'name' => '応徳', 'kana' => 'オウトク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1087-05-11T00:00:00+09:00', 'end' => '1095-01-23T00:00:00+09:00', 'name' => '寛治', 'kana' => 'カンジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1095-01-23T00:00:00+09:00', 'end' => '1097-01-03T00:00:00+09:00', 'name' => '嘉保', 'kana' => 'カホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1097-01-03T00:00:00+09:00', 'end' => '1097-12-27T00:00:00+09:00', 'name' => '永長', 'kana' => 'エイチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1097-12-27T00:00:00+09:00', 'end' => '1099-09-15T00:00:00+09:00', 'name' => '承徳', 'kana' => 'ジョウトク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1099-09-15T00:00:00+09:00', 'end' => '1104-03-08T00:00:00+09:00', 'name' => '康和', 'kana' => 'コウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1104-03-08T00:00:00+09:00', 'end' => '1106-05-13T00:00:00+09:00', 'name' => '長治', 'kana' => 'チョウジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1106-05-13T00:00:00+09:00', 'end' => '1108-09-09T00:00:00+09:00', 'name' => '嘉承', 'kana' => 'カショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1108-09-09T00:00:00+09:00', 'end' => '1110-07-31T00:00:00+09:00', 'name' => '天仁', 'kana' => 'テンニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1110-07-31T00:00:00+09:00', 'end' => '1113-08-25T00:00:00+09:00', 'name' => '天永', 'kana' => 'テンエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1113-08-25T00:00:00+09:00', 'end' => '1118-04-25T00:00:00+09:00', 'name' => '永久', 'kana' => 'エイキュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1118-04-25T00:00:00+09:00', 'end' => '1120-05-09T00:00:00+09:00', 'name' => '元永', 'kana' => 'ゲンエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1120-05-09T00:00:00+09:00', 'end' => '1124-05-18T00:00:00+09:00', 'name' => '保安', 'kana' => 'ホウアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1124-05-18T00:00:00+09:00', 'end' => '1126-02-15T00:00:00+09:00', 'name' => '天治', 'kana' => 'テンジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1126-02-15T00:00:00+09:00', 'end' => '1131-02-28T00:00:00+09:00', 'name' => '大治', 'kana' => 'ダイジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1131-02-28T00:00:00+09:00', 'end' => '1132-09-21T00:00:00+09:00', 'name' => '天承', 'kana' => 'テンショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1132-09-21T00:00:00+09:00', 'end' => '1135-06-10T00:00:00+09:00', 'name' => '長承', 'kana' => 'チョウショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1135-06-10T00:00:00+09:00', 'end' => '1141-08-13T00:00:00+09:00', 'name' => '保延', 'kana' => 'ホウエン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1141-08-13T00:00:00+09:00', 'end' => '1142-05-25T00:00:00+09:00', 'name' => '永治', 'kana' => 'エイジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1142-05-25T00:00:00+09:00', 'end' => '1144-03-28T00:00:00+09:00', 'name' => '康治', 'kana' => 'コウジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1144-03-28T00:00:00+09:00', 'end' => '1145-08-12T00:00:00+09:00', 'name' => '天養', 'kana' => 'テンヨウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1145-08-12T00:00:00+09:00', 'end' => '1151-02-14T00:00:00+09:00', 'name' => '久安', 'kana' => 'キュウアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1151-02-14T00:00:00+09:00', 'end' => '1154-12-04T00:00:00+09:00', 'name' => '仁平', 'kana' => 'ニンペイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1154-12-04T00:00:00+09:00', 'end' => '1156-05-18T00:00:00+09:00', 'name' => '久寿', 'kana' => 'キュウジュ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1156-05-18T00:00:00+09:00', 'end' => '1159-05-09T00:00:00+09:00', 'name' => '保元', 'kana' => 'ホウゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1159-05-09T00:00:00+09:00', 'end' => '1160-02-18T00:00:00+09:00', 'name' => '平治', 'kana' => 'ヘイジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1160-02-18T00:00:00+09:00', 'end' => '1161-09-24T00:00:00+09:00', 'name' => '永暦', 'kana' => 'エイリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1161-09-24T00:00:00+09:00', 'end' => '1163-05-04T00:00:00+09:00', 'name' => '応保', 'kana' => 'オウホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1163-05-04T00:00:00+09:00', 'end' => '1165-07-14T00:00:00+09:00', 'name' => '長寛', 'kana' => 'チョウカン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1165-07-14T00:00:00+09:00', 'end' => '1166-09-23T00:00:00+09:00', 'name' => '永万', 'kana' => 'エイマン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1166-09-23T00:00:00+09:00', 'end' => '1169-05-06T00:00:00+09:00', 'name' => '仁安', 'kana' => 'ニンアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1169-05-06T00:00:00+09:00', 'end' => '1171-05-27T00:00:00+09:00', 'name' => '嘉応', 'kana' => 'カオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1171-05-27T00:00:00+09:00', 'end' => '1175-08-16T00:00:00+09:00', 'name' => '承安', 'kana' => 'ジョウアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1175-08-16T00:00:00+09:00', 'end' => '1177-08-29T00:00:00+09:00', 'name' => '安元', 'kana' => 'アンゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1177-08-29T00:00:00+09:00', 'end' => '1181-08-25T00:00:00+09:00', 'name' => '治承', 'kana' => 'ジショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1181-08-25T00:00:00+09:00', 'end' => '1182-06-29T00:00:00+09:00', 'name' => '養和', 'kana' => 'ヨウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1182-06-29T00:00:00+09:00', 'end' => '1184-05-27T00:00:00+09:00', 'name' => '寿永', 'kana' => 'ジュエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1184-05-27T00:00:00+09:00', 'end' => '1185-09-09T00:00:00+09:00', 'name' => '元暦', 'kana' => 'ゲンリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1185-09-09T00:00:00+09:00', 'end' => '1190-05-16T00:00:00+09:00', 'name' => '文治', 'kana' => 'ブンジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1190-05-16T00:00:00+09:00', 'end' => '1199-05-23T00:00:00+09:00', 'name' => '建久', 'kana' => 'ケンキュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1199-05-23T00:00:00+09:00', 'end' => '1201-03-19T00:00:00+09:00', 'name' => '正治', 'kana' => 'ショウジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1201-03-19T00:00:00+09:00', 'end' => '1204-03-23T00:00:00+09:00', 'name' => '建仁', 'kana' => 'ケンニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1204-03-23T00:00:00+09:00', 'end' => '1206-06-05T00:00:00+09:00', 'name' => '元久', 'kana' => 'ゲンキュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1206-06-05T00:00:00+09:00', 'end' => '1207-11-16T00:00:00+09:00', 'name' => '建永', 'kana' => 'ケンエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1207-11-16T00:00:00+09:00', 'end' => '1211-04-23T00:00:00+09:00', 'name' => '承元', 'kana' => 'ジョウゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1211-04-23T00:00:00+09:00', 'end' => '1214-01-18T00:00:00+09:00', 'name' => '建暦', 'kana' => 'ケンリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1214-01-18T00:00:00+09:00', 'end' => '1219-05-27T00:00:00+09:00', 'name' => '建保', 'kana' => 'ケンポウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1219-05-27T00:00:00+09:00', 'end' => '1222-05-25T00:00:00+09:00', 'name' => '承久', 'kana' => 'ジョウキュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1222-05-25T00:00:00+09:00', 'end' => '1224-12-31T00:00:00+09:00', 'name' => '貞応', 'kana' => 'ジョウオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1224-12-31T00:00:00+09:00', 'end' => '1225-05-28T00:00:00+09:00', 'name' => '元仁', 'kana' => 'ゲンニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1225-05-28T00:00:00+09:00', 'end' => '1228-01-18T00:00:00+09:00', 'name' => '嘉禄', 'kana' => 'カロク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1228-01-18T00:00:00+09:00', 'end' => '1229-03-31T00:00:00+09:00', 'name' => '安貞', 'kana' => 'アンテイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1229-03-31T00:00:00+09:00', 'end' => '1232-04-23T00:00:00+09:00', 'name' => '寛喜', 'kana' => 'カンギ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1232-04-23T00:00:00+09:00', 'end' => '1233-05-25T00:00:00+09:00', 'name' => '貞永', 'kana' => 'ジョウエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1233-05-25T00:00:00+09:00', 'end' => '1234-11-27T00:00:00+09:00', 'name' => '天福', 'kana' => 'テンプク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1234-11-27T00:00:00+09:00', 'end' => '1235-11-01T00:00:00+09:00', 'name' => '文暦', 'kana' => 'ブンリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1235-11-01T00:00:00+09:00', 'end' => '1238-12-30T00:00:00+09:00', 'name' => '嘉禎', 'kana' => 'カテイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1238-12-30T00:00:00+09:00', 'end' => '1239-03-13T00:00:00+09:00', 'name' => '暦仁', 'kana' => 'リャクニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1239-03-13T00:00:00+09:00', 'end' => '1240-08-05T00:00:00+09:00', 'name' => '延応', 'kana' => 'エンオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1240-08-05T00:00:00+09:00', 'end' => '1243-03-18T00:00:00+09:00', 'name' => '仁治', 'kana' => 'ニンジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1243-03-18T00:00:00+09:00', 'end' => '1247-04-05T00:00:00+09:00', 'name' => '寛元', 'kana' => 'カンゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1247-04-05T00:00:00+09:00', 'end' => '1249-05-02T00:00:00+09:00', 'name' => '宝治', 'kana' => 'ホウジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1249-05-02T00:00:00+09:00', 'end' => '1256-10-24T00:00:00+09:00', 'name' => '建長', 'kana' => 'ケンチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1256-10-24T00:00:00+09:00', 'end' => '1257-03-31T00:00:00+09:00', 'name' => '康元', 'kana' => 'コウゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1257-03-31T00:00:00+09:00', 'end' => '1259-04-20T00:00:00+09:00', 'name' => '正嘉', 'kana' => 'ショウカ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1259-04-20T00:00:00+09:00', 'end' => '1260-05-24T00:00:00+09:00', 'name' => '正元', 'kana' => 'ショウゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1260-05-24T00:00:00+09:00', 'end' => '1261-03-22T00:00:00+09:00', 'name' => '文応', 'kana' => 'ブンオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1261-03-22T00:00:00+09:00', 'end' => '1264-03-27T00:00:00+09:00', 'name' => '弘長', 'kana' => 'コウチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1264-03-27T00:00:00+09:00', 'end' => '1275-05-22T00:00:00+09:00', 'name' => '文永', 'kana' => 'ブンエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1275-05-22T00:00:00+09:00', 'end' => '1278-03-23T00:00:00+09:00', 'name' => '建治', 'kana' => 'ケンジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1278-03-23T00:00:00+09:00', 'end' => '1288-05-29T00:00:00+09:00', 'name' => '弘安', 'kana' => 'コウアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1288-05-29T00:00:00+09:00', 'end' => '1293-09-06T00:00:00+09:00', 'name' => '正応', 'kana' => 'ショウオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1293-09-06T00:00:00+09:00', 'end' => '1299-05-25T00:00:00+09:00', 'name' => '永仁', 'kana' => 'エイニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1299-05-25T00:00:00+09:00', 'end' => '1302-12-10T00:00:00+09:00', 'name' => '正安', 'kana' => 'ショウアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1302-12-10T00:00:00+09:00', 'end' => '1303-09-16T00:00:00+09:00', 'name' => '乾元', 'kana' => 'ケンゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1303-09-16T00:00:00+09:00', 'end' => '1307-01-18T00:00:00+09:00', 'name' => '嘉元', 'kana' => 'カゲン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1307-01-18T00:00:00+09:00', 'end' => '1308-11-22T00:00:00+09:00', 'name' => '徳治', 'kana' => 'トクジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1308-11-22T00:00:00+09:00', 'end' => '1311-05-17T00:00:00+09:00', 'name' => '延慶', 'kana' => 'エンキョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1311-05-17T00:00:00+09:00', 'end' => '1312-04-27T00:00:00+09:00', 'name' => '応長', 'kana' => 'オウチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1312-04-27T00:00:00+09:00', 'end' => '1317-03-16T00:00:00+09:00', 'name' => '正和', 'kana' => 'ショウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1317-03-16T00:00:00+09:00', 'end' => '1319-05-18T00:00:00+09:00', 'name' => '文保', 'kana' => 'ブンポウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1319-05-18T00:00:00+09:00', 'end' => '1321-03-22T00:00:00+09:00', 'name' => '元応', 'kana' => 'ゲンオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1321-03-22T00:00:00+09:00', 'end' => '1324-12-25T00:00:00+09:00', 'name' => '元亨', 'kana' => 'ゲンコウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1324-12-25T00:00:00+09:00', 'end' => '1326-05-28T00:00:00+09:00', 'name' => '正中', 'kana' => 'ショウチュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1326-05-28T00:00:00+09:00', 'end' => '1329-09-22T00:00:00+09:00', 'name' => '嘉暦', 'kana' => 'カリャク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1329-09-22T00:00:00+09:00', 'end' => '1332-05-23T00:00:00+09:00', 'name' => '元徳', 'kana' => 'ゲントク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1331-09-11T00:00:00+09:00', 'end' => '1334-03-05T00:00:00+09:00', 'name' => '元弘', 'kana' => 'ゲンコウ', 'court' => Datetime::COURT_SOUTH],
        ['start' => '1332-05-23T00:00:00+09:00', 'end' => '1333-07-07T00:00:00+09:00', 'name' => '正慶', 'kana' => 'ショウケイ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1334-03-05T00:00:00+09:00', 'end' => '1338-10-11T00:00:00+09:00', 'name' => '建武', 'kana' => 'ケンム', 'court' => Datetime::COURT_MAIN], // 「延元」への改元・南朝成立後も、北朝・足利方では引き続き「建武」の元号を使用した。
        ['start' => '1336-04-11T00:00:00+09:00', 'end' => '1340-05-25T00:00:00+09:00', 'name' => '延元', 'kana' => 'エンゲン', 'court' => Datetime::COURT_SOUTH],
        ['start' => '1338-10-11T00:00:00+09:00', 'end' => '1342-06-01T00:00:00+09:00', 'name' => '暦応', 'kana' => 'リャクオウ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1340-05-25T00:00:00+09:00', 'end' => '1347-01-20T00:00:00+09:00', 'name' => '興国', 'kana' => 'コウコク', 'court' => Datetime::COURT_SOUTH],
        ['start' => '1342-06-01T00:00:00+09:00', 'end' => '1345-11-15T00:00:00+09:00', 'name' => '康永', 'kana' => 'コウエイ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1345-11-15T00:00:00+09:00', 'end' => '1350-04-04T00:00:00+09:00', 'name' => '貞和', 'kana' => 'ジョウワ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1347-01-20T00:00:00+09:00', 'end' => '1370-08-16T00:00:00+09:00', 'name' => '正平', 'kana' => 'ショウヘイ', 'court' => Datetime::COURT_SOUTH],
        ['start' => '1350-04-04T00:00:00+09:00', 'end' => '1352-11-04T00:00:00+09:00', 'name' => '観応', 'kana' => 'カンノウ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1352-11-04T00:00:00+09:00', 'end' => '1356-04-29T00:00:00+09:00', 'name' => '文和', 'kana' => 'ブンナ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1356-04-29T00:00:00+09:00', 'end' => '1361-05-04T00:00:00+09:00', 'name' => '延文', 'kana' => 'エンブン', 'court' => Datetime::COURT_NORTH],
        ['start' => '1361-05-04T00:00:00+09:00', 'end' => '1362-10-11T00:00:00+09:00', 'name' => '康安', 'kana' => 'コウアン', 'court' => Datetime::COURT_NORTH],
        ['start' => '1362-10-11T00:00:00+09:00', 'end' => '1368-03-07T00:00:00+09:00', 'name' => '貞治', 'kana' => 'ジョウジ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1368-03-07T00:00:00+09:00', 'end' => '1375-03-29T00:00:00+09:00', 'name' => '応安', 'kana' => 'オウアン', 'court' => Datetime::COURT_NORTH],
        ['start' => '1370-08-16T00:00:00+09:00', 'end' => '1372-05-04T00:00:00+09:00', 'name' => '建徳', 'kana' => 'ケントク', 'court' => Datetime::COURT_SOUTH], // 建徳3年4月1日（ユリウス暦1372年5月4日）に文中に改元
        ['start' => '1372-05-04T00:00:00+09:00', 'end' => '1375-06-26T00:00:00+09:00', 'name' => '文中', 'kana' => 'ブンチュウ', 'court' => Datetime::COURT_SOUTH], // 建徳3年4月1日（ユリウス暦1372年5月4日）に文中に改元
        ['start' => '1375-03-29T00:00:00+09:00', 'end' => '1379-04-09T00:00:00+09:00', 'name' => '永和', 'kana' => 'エイワ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1375-06-26T00:00:00+09:00', 'end' => '1381-03-06T00:00:00+09:00', 'name' => '天授', 'kana' => 'テンジュ', 'court' => Datetime::COURT_SOUTH],
        ['start' => '1379-04-09T00:00:00+09:00', 'end' => '1381-03-20T00:00:00+09:00', 'name' => '康暦', 'kana' => 'コウリャク', 'court' => Datetime::COURT_NORTH],
        ['start' => '1381-03-20T00:00:00+09:00', 'end' => '1384-03-19T00:00:00+09:00', 'name' => '永徳', 'kana' => 'エイトク', 'court' => Datetime::COURT_NORTH],
        ['start' => '1381-03-06T00:00:00+09:00', 'end' => '1384-05-18T00:00:00+09:00', 'name' => '弘和', 'kana' => 'コウワ', 'court' => Datetime::COURT_SOUTH],
        ['start' => '1384-03-19T00:00:00+09:00', 'end' => '1387-10-05T00:00:00+09:00', 'name' => '至徳', 'kana' => 'シトク', 'court' => Datetime::COURT_NORTH],
        ['start' => '1384-05-18T00:00:00+09:00', 'end' => '1392-11-19T00:00:00+09:00', 'name' => '元中', 'kana' => 'ゲンチュウ', 'court' => Datetime::COURT_SOUTH],
        ['start' => '1387-10-05T00:00:00+09:00', 'end' => '1389-03-07T00:00:00+09:00', 'name' => '嘉慶', 'kana' => 'カケイ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1389-03-07T00:00:00+09:00', 'end' => '1390-04-12T00:00:00+09:00', 'name' => '康応', 'kana' => 'コウオウ', 'court' => Datetime::COURT_NORTH],
        ['start' => '1390-04-12T00:00:00+09:00', 'end' => '1394-08-02T00:00:00+09:00', 'name' => '明徳', 'kana' => 'メイトク', 'court' => Datetime::COURT_NORTH],
        ['start' => '1394-08-02T00:00:00+09:00', 'end' => '1428-06-10T00:00:00+09:00', 'name' => '応永', 'kana' => 'オウエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1428-06-10T00:00:00+09:00', 'end' => '1429-10-03T00:00:00+09:00', 'name' => '正長', 'kana' => 'ショウチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1429-10-03T00:00:00+09:00', 'end' => '1441-03-10T00:00:00+09:00', 'name' => '永享', 'kana' => 'エイキョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1441-03-10T00:00:00+09:00', 'end' => '1444-02-23T00:00:00+09:00', 'name' => '嘉吉', 'kana' => 'カキツ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1444-02-23T00:00:00+09:00', 'end' => '1449-08-16T00:00:00+09:00', 'name' => '文安', 'kana' => 'ブンアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1449-08-16T00:00:00+09:00', 'end' => '1452-08-10T00:00:00+09:00', 'name' => '宝徳', 'kana' => 'ホウトク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1452-08-10T00:00:00+09:00', 'end' => '1455-09-06T00:00:00+09:00', 'name' => '享徳', 'kana' => 'キョウトク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1455-09-06T00:00:00+09:00', 'end' => '1457-10-16T00:00:00+09:00', 'name' => '康正', 'kana' => 'コウショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1457-10-16T00:00:00+09:00', 'end' => '1461-02-01T00:00:00+09:00', 'name' => '長禄', 'kana' => 'チョウロク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1461-02-01T00:00:00+09:00', 'end' => '1466-03-14T00:00:00+09:00', 'name' => '寛正', 'kana' => 'カンショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1466-03-14T00:00:00+09:00', 'end' => '1467-04-09T00:00:00+09:00', 'name' => '文正', 'kana' => 'ブンショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1467-04-09T00:00:00+09:00', 'end' => '1469-06-08T00:00:00+09:00', 'name' => '応仁', 'kana' => 'オウニン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1469-06-08T00:00:00+09:00', 'end' => '1487-08-09T00:00:00+09:00', 'name' => '文明', 'kana' => 'ブンメイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1487-08-09T00:00:00+09:00', 'end' => '1489-09-16T00:00:00+09:00', 'name' => '長享', 'kana' => 'チョウキョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1489-09-16T00:00:00+09:00', 'end' => '1492-08-12T00:00:00+09:00', 'name' => '延徳', 'kana' => 'エントク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1492-08-12T00:00:00+09:00', 'end' => '1501-03-18T00:00:00+09:00', 'name' => '明応', 'kana' => 'メイオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1501-03-18T00:00:00+09:00', 'end' => '1504-03-16T00:00:00+09:00', 'name' => '文亀', 'kana' => 'ブンキ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1504-03-16T00:00:00+09:00', 'end' => '1521-09-23T00:00:00+09:00', 'name' => '永正', 'kana' => 'エイショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1521-09-23T00:00:00+09:00', 'end' => '1528-09-03T00:00:00+09:00', 'name' => '大永', 'kana' => 'タイエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1528-09-03T00:00:00+09:00', 'end' => '1532-08-29T00:00:00+09:00', 'name' => '享禄', 'kana' => 'キョウロク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1532-08-29T00:00:00+09:00', 'end' => '1555-11-07T00:00:00+09:00', 'name' => '天文', 'kana' => 'テンブン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1555-11-07T00:00:00+09:00', 'end' => '1558-03-18T00:00:00+09:00', 'name' => '弘治', 'kana' => 'コウジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1558-03-18T00:00:00+09:00', 'end' => '1570-05-27T00:00:00+09:00', 'name' => '永禄', 'kana' => 'エイロク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1570-05-27T00:00:00+09:00', 'end' => '1573-08-25T00:00:00+09:00', 'name' => '元亀', 'kana' => 'ゲンキ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1573-08-25T00:00:00+09:00', 'end' => '1593-01-10T00:00:00+09:00', 'name' => '天正', 'kana' => 'テンショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1593-01-10T00:00:00+09:00', 'end' => '1596-12-16T00:00:00+09:00', 'name' => '文禄', 'kana' => 'ブンロク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1596-12-16T00:00:00+09:00', 'end' => '1615-09-05T00:00:00+09:00', 'name' => '慶長', 'kana' => 'ケイチョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1615-09-05T00:00:00+09:00', 'end' => '1624-04-17T00:00:00+09:00', 'name' => '元和', 'kana' => 'ゲンナ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1624-04-17T00:00:00+09:00', 'end' => '1645-01-13T00:00:00+09:00', 'name' => '寛永', 'kana' => 'カンエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1645-01-13T00:00:00+09:00', 'end' => '1648-04-07T00:00:00+09:00', 'name' => '正保', 'kana' => 'ショウホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1648-04-07T00:00:00+09:00', 'end' => '1652-10-20T00:00:00+09:00', 'name' => '慶安', 'kana' => 'ケイアン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1652-10-20T00:00:00+09:00', 'end' => '1655-05-18T00:00:00+09:00', 'name' => '承応', 'kana' => 'ジョウオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1655-05-18T00:00:00+09:00', 'end' => '1658-08-21T00:00:00+09:00', 'name' => '明暦', 'kana' => 'メイレキ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1658-08-21T00:00:00+09:00', 'end' => '1661-05-23T00:00:00+09:00', 'name' => '万治', 'kana' => 'マンジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1661-05-23T00:00:00+09:00', 'end' => '1673-10-30T00:00:00+09:00', 'name' => '寛文', 'kana' => 'カンブン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1673-10-30T00:00:00+09:00', 'end' => '1681-11-09T00:00:00+09:00', 'name' => '延宝', 'kana' => 'エンポウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1681-11-09T00:00:00+09:00', 'end' => '1684-04-05T00:00:00+09:00', 'name' => '天和', 'kana' => 'テンナ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1684-04-05T00:00:00+09:00', 'end' => '1688-10-23T00:00:00+09:00', 'name' => '貞享', 'kana' => 'ジョウキョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1688-10-23T00:00:00+09:00', 'end' => '1704-04-16T00:00:00+09:00', 'name' => '元禄', 'kana' => 'ゲンロク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1704-04-16T00:00:00+09:00', 'end' => '1711-06-11T00:00:00+09:00', 'name' => '宝永', 'kana' => 'ホウエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1711-06-11T00:00:00+09:00', 'end' => '1716-08-09T00:00:00+09:00', 'name' => '正徳', 'kana' => 'ショウトク', 'court' => Datetime::COURT_MAIN],
        ['start' => '1716-08-09T00:00:00+09:00', 'end' => '1736-06-07T00:00:00+09:00', 'name' => '享保', 'kana' => 'キョウホウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1736-06-07T00:00:00+09:00', 'end' => '1741-04-12T00:00:00+09:00', 'name' => '元文', 'kana' => 'ゲンブン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1741-04-12T00:00:00+09:00', 'end' => '1744-04-03T00:00:00+09:00', 'name' => '寛保', 'kana' => 'カンポウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1744-04-03T00:00:00+09:00', 'end' => '1748-08-05T00:00:00+09:00', 'name' => '延享', 'kana' => 'エンキョウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1748-08-05T00:00:00+09:00', 'end' => '1751-12-14T00:00:00+09:00', 'name' => '寛延', 'kana' => 'カンエン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1751-12-14T00:00:00+09:00', 'end' => '1764-06-30T00:00:00+09:00', 'name' => '宝暦', 'kana' => 'ホウレキ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1764-06-30T00:00:00+09:00', 'end' => '1772-12-10T00:00:00+09:00', 'name' => '明和', 'kana' => 'メイワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1772-12-10T00:00:00+09:00', 'end' => '1781-04-25T00:00:00+09:00', 'name' => '安永', 'kana' => 'アンエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1781-04-25T00:00:00+09:00', 'end' => '1789-02-19T00:00:00+09:00', 'name' => '天明', 'kana' => 'テンメイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1789-02-19T00:00:00+09:00', 'end' => '1801-03-19T00:00:00+09:00', 'name' => '寛政', 'kana' => 'カンセイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1801-03-19T00:00:00+09:00', 'end' => '1804-03-22T00:00:00+09:00', 'name' => '享和', 'kana' => 'キョウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1804-03-22T00:00:00+09:00', 'end' => '1818-05-26T00:00:00+09:00', 'name' => '文化', 'kana' => 'ブンカ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1818-05-26T00:00:00+09:00', 'end' => '1831-01-23T00:00:00+09:00', 'name' => '文政', 'kana' => 'ブンセイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1831-01-23T00:00:00+09:00', 'end' => '1845-01-09T00:00:00+09:00', 'name' => '天保', 'kana' => 'テンポウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1845-01-09T00:00:00+09:00', 'end' => '1848-04-01T00:00:00+09:00', 'name' => '弘化', 'kana' => 'コウカ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1848-04-01T00:00:00+09:00', 'end' => '1855-01-15T00:00:00+09:00', 'name' => '嘉永', 'kana' => 'カエイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1855-01-15T00:00:00+09:00', 'end' => '1860-04-08T00:00:00+09:00', 'name' => '安政', 'kana' => 'アンセイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1860-04-08T00:00:00+09:00', 'end' => '1861-03-29T00:00:00+09:00', 'name' => '万延', 'kana' => 'マンエン', 'court' => Datetime::COURT_MAIN],
        ['start' => '1861-03-29T00:00:00+09:00', 'end' => '1864-03-27T00:00:00+09:00', 'name' => '文久', 'kana' => 'ブンキュウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1864-03-27T00:00:00+09:00', 'end' => '1865-05-01T00:00:00+09:00', 'name' => '元治', 'kana' => 'ゲンジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1865-05-01T00:00:00+09:00', 'end' => '1868-10-23T00:00:00+09:00', 'name' => '慶応', 'kana' => 'ケイオウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1868-10-23T00:00:00+09:00', 'end' => '1912-07-30T00:00:00+09:00', 'name' => '明治', 'kana' => 'メイジ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1912-07-30T00:00:00+09:00', 'end' => '1926-12-25T00:00:00+09:00', 'name' => '大正', 'kana' => 'タイショウ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1926-12-25T00:00:00+09:00', 'end' => '1989-01-08T00:00:00+09:00', 'name' => '昭和', 'kana' => 'ショウワ', 'court' => Datetime::COURT_MAIN],
        ['start' => '1989-01-08T00:00:00+09:00', 'end' => '2019-05-01T00:00:00+09:00', 'name' => '平成', 'kana' => 'ヘイセイ', 'court' => Datetime::COURT_MAIN],
        ['start' => '2019-05-01T00:00:00+09:00', 'end' => '9999-12-31T23:59:59+09:00', 'name' => '令和', 'kana' => 'レイワ'] // 令和の終了日は便宜上の一時的な値としてマッピング
    ];
}
