<?php

/**
 * HistoricalEra.php
 *
 * 指定された日付に対応する歴史的元号を {@see \JapaneseDate\Maps\HistoricalEraMap} から
 * 取得し、{@see \JapaneseDate\Values\Era} オブジェクトの配列として返すコンポーネントです。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */

namespace JapaneseDate\Components;

use JapaneseDate\DateTime;
use JapaneseDate\DateTimeImmutable;
use JapaneseDate\Maps\HistoricalEraMap;
use JapaneseDate\Values\Era;

/**
 * 歴史的元号データの取得・変換を担うコンポーネント。
 *
 * {@see \JapaneseDate\Maps\HistoricalEraMap::findByDate()} で該当エントリを抽出し、
 * それぞれを {@see \JapaneseDate\Values\Era} バリューオブジェクトへ変換して返します。
 * 南北朝時代のように元号が並存する場合は複数の `Era` を含む配列を返します。
 *
 * @category    DateTime
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   Suzunone
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       8.4.0
 */
class HistoricalEra
{
    /**
     * 指定された日付に対応する歴史的元号を `Era[]` として返す。
     *
     * `court` キーが存在しないエントリ（令和など一部）は `DateTime::COURT_MAIN` を補完します。
     * 該当する元号が存在しない場合は空配列を返します。
     *
     * @param \JapaneseDate\DateTime|\JapaneseDate\DateTimeImmutable $date 検索基準日
     * @return \JapaneseDate\Values\Era[] 該当する元号バリューオブジェクトの配列
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @throws \Exception
     */
    public function findByDate(DateTime|DateTimeImmutable $date): array
    {
        $entries = HistoricalEraMap::findByDate($date);
        $eras = [];

        foreach ($entries as $entry) {
            $eras[] = new Era(
                $entry['name'],
                $entry['kana'],
                $entry['court'] ?? DateTime::COURT_MAIN,
                $entry['start'],
                $entry['end'],
                $date
            );
        }

        return $eras;
    }
}
