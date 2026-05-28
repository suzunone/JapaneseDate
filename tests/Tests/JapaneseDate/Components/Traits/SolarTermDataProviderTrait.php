<?php

namespace Tests\JapaneseDate\Components\Traits;

use JapaneseDate\DateTime;

/**
 * 二十四節気テストで共通利用する期待値データを提供する Trait。
 */
trait SolarTermDataProviderTrait
{

    /**
     * 2000年の二十四節気コードと日付の期待値を返す。
     */
    public static function getSolarTermDataProvider(): array
    {
        return [
            '2000 春分' => [2000, DateTime::SOLAR_TERM_SYUNBUN, 3, 20],
            '2000 清明' => [2000, DateTime::SOLAR_TERM_SEIMEI, 4, 4],
            '2000 穀雨' => [2000, DateTime::SOLAR_TERM_KOKUU, 4, 20],
            '2000 立夏' => [2000, DateTime::SOLAR_TERM_RIKKA, 5, 5],
            '2000 小満' => [2000, DateTime::SOLAR_TERM_SYOUMAN, 5, 21],
            '2000 芒種' => [2000, DateTime::SOLAR_TERM_BOUSYU, 6, 5],
            '2000 夏至' => [2000, DateTime::SOLAR_TERM_GESHI, 6, 21],
            '2000 小暑' => [2000, DateTime::SOLAR_TERM_SYOUSYO, 7, 7],
            '2000 大暑' => [2000, DateTime::SOLAR_TERM_TAISYO, 7, 22],
            '2000 立秋' => [2000, DateTime::SOLAR_TERM_RISSYUU, 8, 7],
            '2000 処暑' => [2000, DateTime::SOLAR_TERM_SYOSYO, 8, 23],
            '2000 白露' => [2000, DateTime::SOLAR_TERM_HAKURO, 9, 7],
            '2000 秋分' => [2000, DateTime::SOLAR_TERM_SYUUBUN, 9, 23],
            '2000 寒露' => [2000, DateTime::SOLAR_TERM_KANRO, 10, 8],
            '2000 霜降' => [2000, DateTime::SOLAR_TERM_SOUKOU, 10, 23],
            '2000 立冬' => [2000, DateTime::SOLAR_TERM_RITTOU, 11, 7],
            '2000 小雪' => [2000, DateTime::SOLAR_TERM_SYOUSETSU, 11, 22],
            '2000 大雪' => [2000, DateTime::SOLAR_TERM_TAISETSU, 12, 7],
            '2000 冬至' => [2000, DateTime::SOLAR_TERM_TOUJI, 12, 21],
            '2000 小寒' => [2000, DateTime::SOLAR_TERM_SYOUKAN, 1, 6],
            '2000 大寒' => [2000, DateTime::SOLAR_TERM_DAIKAN, 1, 21],
            '2000 立春' => [2000, DateTime::SOLAR_TERM_RISSYUN, 2, 4],
            '2000 雨水' => [2000, DateTime::SOLAR_TERM_USUI, 2, 19],
            '2000 啓蟄' => [2000, DateTime::SOLAR_TERM_KEICHITSU, 3, 5],
        ];
    }
}
