<?php

/**
 * DateTime の統合テスト（カバレッジ対象外）
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       1.0.0 リリースから利用可能
 */

namespace Tests\JapaneseDate;

use JapaneseDate\DateTime;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * DateTime クラスのテスト(CoversNothing)
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       2026-06-16
 * @coversNothing
 * @group long-running
 */
class DateTimeCoversNothingTest extends TestCase
{
    use InvokeTrait;
    /**
     * 年始の getter 計測対象を返す
     *
     * @return array<string, array{string, string}>
     */
    public static function newYearGetterDataProvider(): array
    {
        $getters = [
            'solar_seasonal_festival',
            'solar_seasonal_festival_name',
            'solar_seasonal_festival_alias',
            'lunar_seasonal_festival',
            'lunar_seasonal_festival_name',
            'lunar_seasonal_festival_alias',
            'misc_seasonal_node',
            'misc_seasonal_node_text',
            'solar_term',
            'solar_term_text',
            'is_solar_term',
            'era_name_text',
            'era_name',
            'era_year',
            'oriental_zodiac_text',
            'oriental_zodiac',
            'heavenly_stem_text',
            'heavenly_stem',
            'six_weekday_text',
            'six_weekday',
            'weekday_text',
            'month_text',
            'holiday_text',
            'holiday',
            'is_holiday',
            'lunar_month_text',
            'lunar_month',
            'lunar_year',
            'lunar_day',
            'is_leap_month',
            'moon_age',
            'moon_phase_angle',
            'moon_phase',
            'moon_phase_text',
        ];

        $data = [];
        foreach (range(2011, 2025) as $year) {
            foreach ([1, 2] as $day) {
                $date = sprintf('%04d-01-%02d', $year, $day);
                foreach ($getters as $getter) {
                    $data[$date . ' ' . $getter] = [$date, $getter];
                }
            }
        }

        return $data;
    }
    /**
     * 年始の toArray で使用する getter を個別に取得できることを確認する
     *
     * @param string $date 計測対象日
     * @param string $getter 計測対象 getter
     * @return void
     * @throws \JapaneseDate\Exceptions\NativeDateTimeException
     * @dataProvider newYearGetterDataProvider
     */
    public function test_new_year_getter($date, $getter): void
    {
        $moonAlgorithm = DateTime::moonAlgorithm();
        DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_ELP2000);
        try {
            $DateTime = new DateTime($date);

            switch ($getter) {
                case 'solar_seasonal_festival':
                    $value = $DateTime->solar_seasonal_festival;
                    break;
                case 'solar_seasonal_festival_name':
                    $value = $DateTime->solar_seasonal_festival_name;
                    break;
                case 'solar_seasonal_festival_alias':
                    $value = $DateTime->solar_seasonal_festival_alias;
                    break;
                case 'lunar_seasonal_festival':
                    $value = $DateTime->lunar_seasonal_festival;
                    break;
                case 'lunar_seasonal_festival_name':
                    $value = $DateTime->lunar_seasonal_festival_name;
                    break;
                case 'lunar_seasonal_festival_alias':
                    $value = $DateTime->lunar_seasonal_festival_alias;
                    break;
                case 'misc_seasonal_node':
                    $value = $DateTime->misc_seasonal_node;
                    break;
                case 'misc_seasonal_node_text':
                    $value = $DateTime->misc_seasonal_node_text;
                    break;
                case 'solar_term':
                    $value = $DateTime->solar_term;
                    break;
                case 'solar_term_text':
                    $value = $DateTime->solar_term_text;
                    break;
                case 'is_solar_term':
                    $value = $DateTime->is_solar_term;
                    break;
                case 'era_name_text':
                    $value = $DateTime->era_name_text;
                    break;
                case 'era_name':
                    $value = $DateTime->era_name;
                    break;
                case 'era_year':
                    $value = $DateTime->era_year;
                    break;
                case 'oriental_zodiac_text':
                    $value = $DateTime->oriental_zodiac_text;
                    break;
                case 'oriental_zodiac':
                    $value = $DateTime->oriental_zodiac;
                    break;
                case 'heavenly_stem_text':
                    $value = $DateTime->heavenly_stem_text;
                    break;
                case 'heavenly_stem':
                    $value = $DateTime->heavenly_stem;
                    break;
                case 'six_weekday_text':
                    $value = $DateTime->six_weekday_text;
                    break;
                case 'six_weekday':
                    $value = $DateTime->six_weekday;
                    break;
                case 'weekday_text':
                    $value = $DateTime->weekday_text;
                    break;
                case 'month_text':
                    $value = $DateTime->month_text;
                    break;
                case 'holiday_text':
                    $value = $DateTime->holiday_text;
                    break;
                case 'holiday':
                    $value = $DateTime->holiday;
                    break;
                case 'is_holiday':
                    $value = $DateTime->is_holiday;
                    break;
                case 'lunar_month_text':
                    $value = $DateTime->lunar_month_text;
                    break;
                case 'lunar_month':
                    $value = $DateTime->lunar_month;
                    break;
                case 'lunar_year':
                    $value = $DateTime->lunar_year;
                    break;
                case 'lunar_day':
                    $value = $DateTime->lunar_day;
                    break;
                case 'is_leap_month':
                    $value = $DateTime->is_leap_month;
                    break;
                case 'moon_age':
                    $value = $DateTime->moon_age;
                    break;
                case 'moon_phase_angle':
                    $value = $DateTime->moon_phase_angle;
                    break;
                case 'moon_phase':
                    $value = $DateTime->moon_phase;
                    break;
                case 'moon_phase_text':
                    $value = $DateTime->moon_phase_text;
                    break;
            }

            $this->assertTrue(is_scalar($value) || $value === null);
        } finally {
            DateTime::useMoonAlgorithm($moonAlgorithm);
        }
    }
}
