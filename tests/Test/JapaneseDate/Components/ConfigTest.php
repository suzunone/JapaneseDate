<?php

/**
 * ConfigTest.php
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Config;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\PreserveGlobalState;
use PHPUnit\Framework\Attributes\RunInSeparateProcess;
use PHPUnit\Framework\TestCase;

#[CoversClass(\JapaneseDate\Components\Config::class)]
class ConfigTest extends TestCase
{
    private string $tmpDir;

    protected function setUp(): void
    {
        $this->tmpDir = sys_get_temp_dir() . '/japanese_date_config_test_' . uniqid('', true);
        mkdir($this->tmpDir, 0777, true);

        file_put_contents($this->tmpDir . '/2026.php', <<<'PHP'
<?php
return [
    'lunarCalendar' => [
        [
            'year'              => 2026,
            'month'             => 1,
            'day'               => 19,
            'lunar_year'        => 2025,
            'lunar_month'       => 12,
            'lunar_month_leap'  => false,
        ],
    ],
    'solarTerm' => [
        ['month' => 1, 'day' => 5, 'solar_term' => 21],
    ],
];
PHP
        );

        Config::setLCPath([$this->tmpDir]);
    }

    protected function tearDown(): void
    {
        @unlink($this->tmpDir . '/2026.php');
        @rmdir($this->tmpDir);
        Config::setLCPath([]);
    }

    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_getLC_returns_lunarCalendar_data()
    {
        $result = Config::getLC(2026);

        $this->assertNotEmpty($result, 'getLC(2026) は空配列ではなく lunarCalendar データを返すべき');
        $this->assertCount(1, $result);

        $entry = $result[0];
        $this->assertEquals(2026, $entry['year']);
        $this->assertEquals(1, $entry['month']);
        $this->assertEquals(19, $entry['day']);
        $this->assertEquals(2025, $entry['lunar_year']);
        $this->assertEquals(12, $entry['lunar_month']);
        $this->assertFalse($entry['lunar_month_leap']);

        // jd (ユリウス通日) が補完されること
        $this->assertArrayHasKey('jd', $entry, 'jd キーが補完されること');
        $this->assertGreaterThan(0, $entry['jd']);
    }

    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_getST_returns_solarTerm_data()
    {
        $result = Config::getST(2026);

        $this->assertNotEmpty($result, 'getST(2026) は空配列ではなく solarTerm データを返すべき');
        $this->assertCount(1, $result);

        $entry = $result[0];
        $this->assertEquals(1, $entry['month']);
        $this->assertEquals(5, $entry['day']);
        $this->assertEquals(21, $entry['solar_term']);
    }

    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_getLC_returns_empty_for_missing_year()
    {
        $result = Config::getLC(1800);
        $this->assertSame([], $result);
    }

    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_getST_returns_empty_for_missing_year()
    {
        $result = Config::getST(1800);
        $this->assertSame([], $result);
    }

    #[RunInSeparateProcess] #[PreserveGlobalState(false)]
    public function test_addLCPath()
    {
        Config::setLCPath([]);
        Config::addLCPath($this->tmpDir);

        $result = Config::getLC(2026);
        $this->assertNotEmpty($result);
    }
}
