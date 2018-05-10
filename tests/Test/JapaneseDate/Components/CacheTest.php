<?php

/**
 *
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @copyright   JapaneseDate
 * @license     BSD-2
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 2018/05/08 19:14
 */

namespace Tests\JapaneseDate\Components;

use JapaneseDate\Components\Cache;
use PHPUnit\Framework\TestCase;
use Tests\JapaneseDate\InvokeTrait;


/**
 * Class CacheTest
 *
 * @category    Tests
 * @package     JapaneseDate
 * @subpackage  Components
 * @author      Suzunone <suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 */
class CacheTest extends TestCase
{
    use InvokeTrait;

    /**
     * @test
     * @covers              \JapaneseDate\Components\Cache
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @throws \ReflectionException
     * @throws \ReflectionException
     */
    public function test_setMode()
    {
        $this->assertEquals(Cache::MODE_AUTO,
                            $this->invokeGetProperty(Cache::class, 'mode')
        );

        Cache::setMode(Cache::MODE_APC);
        $this->assertEquals(Cache::MODE_APC,
                            $this->invokeGetProperty(Cache::class, 'mode')
        );

    }

    /**
     * @test
     * @covers              \JapaneseDate\Components\Cache
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @throws \ReflectionException
     * @throws \ReflectionException
     */
    public function test_setCacheClosure()
    {
        $closure = function () {
        };

        Cache::setCacheClosure($closure);
        $this->assertEquals(Cache::MODE_ORIGINAL,
                            $this->invokeGetProperty(Cache::class, 'mode')
        );

        $this->assertSame($closure,
                          $this->invokeGetProperty(Cache::class, 'cache_closure')
        );

    }


    /**
     * @test
     * @covers              \JapaneseDate\Components\Cache
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     * @throws \ReflectionException
     * @throws \ReflectionException
     */
    public function test_setCacheFilePath()
    {
        $file = __DIR__ . '/example_text.txt';
        Cache::setCacheFilePath($file);
        $this->assertEquals(Cache::MODE_FILE,
                            $this->invokeGetProperty(Cache::class, 'mode')
        );

        $this->assertSame($file,
                          $this->invokeGetProperty(Cache::class, 'cache_file_path')
        );

    }


}
