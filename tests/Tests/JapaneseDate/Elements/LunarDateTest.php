<?php

/**
 * LunarDate クラスのテスト
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */

namespace Tests\JapaneseDate\Elements;

use JapaneseDate\Components\LunarCalendar;
use JapaneseDate\DateTime;
use JapaneseDate\Elements\LunarDate;
use JapaneseDate\Exceptions\ErrorException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

/**
 * LunarDate クラスのテスト
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @covers \JapaneseDate\Elements\LunarDate
 */
class LunarDateTest extends TestCase
{
    public function test__construct(): void
    {
        // LunarCalendar 経由で取得した旧暦日が LunarDate インスタンスになることを確認する
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $this->assertInstanceOf(LunarDate::class, $LunarDate);
    }
    public function test__construct_error(): void
    {
        $this->expectException(ErrorException::class);

        // DAY_KEY (index 3) を含まない配列で例外が発生することを確認
        new LunarDate([LunarDate::YEAR_KEY => 2020, LunarDate::IS_LEAP_MONTH_FLAG_KEY => false, LunarDate::MONTH_KEY => 3], false);
    }
    public function test__get(): void
    {
        // マジックメソッド __get() で旧暦の各プロパティを取得できることを確認する
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));

        // 2020-03-01 は旧暦 2020 年 2 月 7 日で、閏月や二十四節気には該当しない
        $this->assertEquals(2020, $LunarDate->year);
        $this->assertEquals(2, $LunarDate->month);
        $this->assertEquals(7, $LunarDate->day);
        $this->assertFalse($LunarDate->is_leap_month);
        $this->assertFalse($LunarDate->solar_term);

        // 2020-03-20 は二十四節気に該当するため、節気番号を取得できることを確認する
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-20'));
        $this->assertEquals(0, $LunarDate->solar_term);
    }
    public function test__get_error(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectException(ErrorException::class);

        // 存在しないプロパティを参照した場合に例外が発生することを確認する
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $LunarDate->aaaaaaaaaaaa;
    }
    public function test__isset(): void
    {
        // __isset() が定義済みプロパティと未定義プロパティを判別できることを確認する
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $this->assertTrue(isset($LunarDate->solar_term));
        $this->assertFalse(isset($LunarDate->solar_termaaa));
    }
    public function test__set(): void
    {
        $this->expectException(ErrorException::class);
        $this->expectException(ErrorException::class);

        // LunarDate は読み取り専用のため、プロパティ変更時に例外が発生することを確認する
        $LunarCalendar = new LunarCalendar();
        $LunarDate = $LunarCalendar->getLunarDate(DateTime::factory('2020-03-01'));
        $LunarDate->__set('is_leap_month', true);
    }
}
