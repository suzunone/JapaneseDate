<?php

namespace Tests\JapaneseDate\Components\Traits;

use JapaneseDate\Components\ELP2000Reduced;
use JapaneseDate\Components\Traits\ELP2000LonReduced;
use PHPUnit\Framework\Attributes\CoversMethod;
use PHPUnit\Framework\Attributes\CoversTrait;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;

/**
 * ELP2000LonReduced トレイトのテスト。
 *
 * 縮約 LON 系 12 メソッドが float を返すことを検証し、
 * ELP2000LonReduced トレイト単体の C0 カバレッジ 100% を達成する。
 *
 * 各メソッドは {@see ELP2000Reduced} インスタンス経由で呼び出す。
 * トレイトを直接インスタンス化できないため、ELP2000Reduced を媒体として使用する。
 *
 * 引数は簡易的な float 値を使用（メソッド内部に条件分岐はなく、
 * 任意の引数で全コードパスが実行される）。
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::mainProblemLonFloat
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::tidesLon3Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::tidesLon6Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::tidesLon21Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::tidesLon24Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::tidesLon27Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::tidesLon30Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::tidesLon33Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::planetaryLon9Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::planetaryLon12Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::planetaryLon15Float
 * @covers \JapaneseDate\Components\Traits\ELP2000LonReduced::planetaryLon18Float
 */
class ELP2000LonReducedTraitTest extends TestCase
{
    use InvokeTrait;
    /**
     * longitudeMoon() を1回呼んで全 12 LON メソッドが実行され float を返すこと。
     * computeLongitudeSeries() が全 LON メソッドを呼び出すことを利用する。
     *
     * @throws \Exception
     */
    public function test_allLonMethods_areCoveredByLongitudeMoon(): void
    {
        $reduced = new ELP2000Reduced();
        // 2025-03-29 10:58 UTC の TDB JD（USNO 既知新月付近）
        $lon = (float) $reduced->preciseLongitude('2460763.956944');
        $this->assertIsFloat($lon);
        $this->assertGreaterThanOrEqual(0.0, $lon);
        $this->assertLessThan(360.0, $lon);
    }
    /**
     * mainProblemLonFloat() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_mainProblemLonFloat_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'mainProblemLonFloat', [1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * tidesLon3Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_tidesLon3Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'tidesLon3Float', [0.1, 1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * tidesLon6Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_tidesLon6Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'tidesLon6Float', [0.1, 1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * tidesLon21Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_tidesLon21Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'tidesLon21Float', [0.1, 1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * tidesLon24Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_tidesLon24Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'tidesLon24Float', [0.1, 1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * tidesLon27Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_tidesLon27Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'tidesLon27Float', [0.1, 1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * tidesLon30Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_tidesLon30Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'tidesLon30Float', [0.1, 1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * tidesLon33Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_tidesLon33Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod($reduced, 'tidesLon33Float', [0.1, 1.0, 0.5, 2.0, 1.5]);
        $this->assertIsFloat($result);
    }
    /**
     * planetaryLon9Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_planetaryLon9Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod(
            $reduced,
            'planetaryLon9Float',
            [0.1, 1.0, 0.5, 2.0, 1.5, 1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0, 8.0]
        );
        $this->assertIsFloat($result);
    }
    /**
     * planetaryLon12Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_planetaryLon12Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod(
            $reduced,
            'planetaryLon12Float',
            [0.1, 1.0, 0.5, 2.0, 1.5, 1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0, 8.0]
        );
        $this->assertIsFloat($result);
    }
    /**
     * planetaryLon15Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_planetaryLon15Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod(
            $reduced,
            'planetaryLon15Float',
            [0.1, 1.0, 0.5, 2.0, 1.5, 1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0, 8.0]
        );
        $this->assertIsFloat($result);
    }
    /**
     * planetaryLon18Float() が float を返すこと（直接呼び出し）。
     *
     * @throws \ReflectionException
     */
    public function test_planetaryLon18Float_returnsFloat(): void
    {
        $reduced = new ELP2000Reduced();
        $result = $this->invokeExecuteMethod(
            $reduced,
            'planetaryLon18Float',
            [0.1, 1.0, 0.5, 2.0, 1.5, 1.0, 2.0, 3.0, 4.0, 5.0, 6.0, 7.0, 8.0]
        );
        $this->assertIsFloat($result);
    }
}
