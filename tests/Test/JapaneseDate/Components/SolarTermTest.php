<?php

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\SolarTerm;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\SolarTermDate;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(SolarTerm::class)]
class SolarTermTest extends TestCase
{
    public static function getSolarTermDataProvider()
    {
        return [
            [2000, DateTime::SOLAR_TERM_SYUNBUN, 3, 20],
            [2000, DateTime::SOLAR_TERM_SEIMEI, 4, 4],
            [2000, DateTime::SOLAR_TERM_KOKUU, 4, 20],
            [2000, DateTime::SOLAR_TERM_RIKKA, 5, 5],
            [2000, DateTime::SOLAR_TERM_SYOUMAN, 5, 21],
            [2000, DateTime::SOLAR_TERM_BOUSYU, 6, 5],
            [2000, DateTime::SOLAR_TERM_GESHI, 6, 21],
            [2000, DateTime::SOLAR_TERM_SYOUSYO, 7, 7],
            [2000, DateTime::SOLAR_TERM_TAISYO, 7, 22],
            [2000, DateTime::SOLAR_TERM_RISSYUU, 8, 7],
            [2000, DateTime::SOLAR_TERM_SYOSYO, 8, 23],
            [2000, DateTime::SOLAR_TERM_HAKURO, 9, 7],
            [2000, DateTime::SOLAR_TERM_SYUUBUN, 9, 23],
            [2000, DateTime::SOLAR_TERM_KANRO, 10, 8],
            [2000, DateTime::SOLAR_TERM_SOUKOU, 10, 23],
            [2000, DateTime::SOLAR_TERM_RITTOU, 11, 7],
            [2000, DateTime::SOLAR_TERM_SYOUSETSU, 11, 22],
            [2000, DateTime::SOLAR_TERM_TAISETSU, 12, 7],
            [2000, DateTime::SOLAR_TERM_TOUJI, 12, 21],
            '小寒' => [2000, DateTime::SOLAR_TERM_SYOUKAN, 1, 6],
            '大寒' => [2000, DateTime::SOLAR_TERM_DAIKAN, 1, 21],
            '立春' => [2000, DateTime::SOLAR_TERM_RISSYUN, 2, 4],
            '雨水' => [2000, DateTime::SOLAR_TERM_USUI, 2, 19],
            '啓蟄' => [2000, DateTime::SOLAR_TERM_KEICHITSU, 3, 5],
        ];
    }

    /**
     * @return void
     * @throws \JapaneseDate\Exceptions\SolarTermException
     */
    #[DataProvider('getSolarTermDataProvider')]
    public function test_getSolarTerm($year, $solar_term_code, $month, $day)
    {
        $SolarTerm = new SolarTerm();
        $SolarTermData = $SolarTerm->getSolarTerm($year, $solar_term_code);

        $this->assertInstanceOf(SolarTermDate::class, $SolarTermData);
        $this->assertEquals($year, $SolarTermData->year);
        $this->assertEquals($month, $SolarTermData->month);
        $this->assertEquals($day, $SolarTermData->day);
    }
}
