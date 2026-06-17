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
 */
#[CoversNothing]
#[Group('long-running')]
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
     */
    #[DataProvider('newYearGetterDataProvider')]
    public function test_new_year_getter(string $date, string $getter): void
    {
        $moonAlgorithm = DateTime::moonAlgorithm();
        DateTime::useMoonAlgorithm(DateTime::MOON_ALGORITHM_ELP2000);

        try {
            $DateTime = new DateTime($date);

            $value = match ($getter) {
                'solar_seasonal_festival' => $DateTime->solar_seasonal_festival,
                'solar_seasonal_festival_name' => $DateTime->solar_seasonal_festival_name,
                'solar_seasonal_festival_alias' => $DateTime->solar_seasonal_festival_alias,
                'lunar_seasonal_festival' => $DateTime->lunar_seasonal_festival,
                'lunar_seasonal_festival_name' => $DateTime->lunar_seasonal_festival_name,
                'lunar_seasonal_festival_alias' => $DateTime->lunar_seasonal_festival_alias,
                'misc_seasonal_node' => $DateTime->misc_seasonal_node,
                'misc_seasonal_node_text' => $DateTime->misc_seasonal_node_text,
                'solar_term' => $DateTime->solar_term,
                'solar_term_text' => $DateTime->solar_term_text,
                'is_solar_term' => $DateTime->is_solar_term,
                'era_name_text' => $DateTime->era_name_text,
                'era_name' => $DateTime->era_name,
                'era_year' => $DateTime->era_year,
                'oriental_zodiac_text' => $DateTime->oriental_zodiac_text,
                'oriental_zodiac' => $DateTime->oriental_zodiac,
                'heavenly_stem_text' => $DateTime->heavenly_stem_text,
                'heavenly_stem' => $DateTime->heavenly_stem,
                'six_weekday_text' => $DateTime->six_weekday_text,
                'six_weekday' => $DateTime->six_weekday,
                'weekday_text' => $DateTime->weekday_text,
                'month_text' => $DateTime->month_text,
                'holiday_text' => $DateTime->holiday_text,
                'holiday' => $DateTime->holiday,
                'is_holiday' => $DateTime->is_holiday,
                'lunar_month_text' => $DateTime->lunar_month_text,
                'lunar_month' => $DateTime->lunar_month,
                'lunar_year' => $DateTime->lunar_year,
                'lunar_day' => $DateTime->lunar_day,
                'is_leap_month' => $DateTime->is_leap_month,
                'moon_age' => $DateTime->moon_age,
                'moon_phase_angle' => $DateTime->moon_phase_angle,
                'moon_phase' => $DateTime->moon_phase,
                'moon_phase_text' => $DateTime->moon_phase_text,
            };

            $this->assertTrue(is_scalar($value) || $value === null);
        } finally {
            DateTime::useMoonAlgorithm($moonAlgorithm);
        }
    }
}
