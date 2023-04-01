<?php
/**
 * Class InvokeTrait
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @codeCoverageIgnore
 */

namespace Tests\JapaneseDate;

use ReflectionClass;

/**
 * Class InvokeTrait
 *
 * @category    Test
 * @package     JapaneseDate
 * @subpackage  Tests
 * @author      Suzunone<suzunone.eleven@gmail.com>
 * @version     GIT: $Id$
 * @link        https://github.com/suzunone/JapaneseDate
 * @see         https://github.com/suzunone/JapaneseDate
 * @since       Class available since Release 1.0.0
 * @codeCoverageIgnore
 */
trait InvokeTrait
{
    /**
     * @param object|string $instance
     * @param string $method_name
     * @param array $options
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeExecuteMethod($instance, string $method_name, array $options)
    {
        if (gettype($instance) === 'string') {
            $instance = new $instance();
        }

        $reflection = new ReflectionClass($instance);
        $method = $reflection->getMethod($method_name);
        $method->setAccessible(true);

        return $method->invokeArgs($instance, $options);
    }

    /**
     * @param object|string $instance
     * @param string $property_name
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeGetProperty($instance, string $property_name)
    {
        if (gettype($instance) === 'string') {
            $instance = new $instance();
        }

        $reflection = new ReflectionClass($instance);
        $property = $reflection->getProperty($property_name);
        $property->setAccessible(true);

        return $property->getValue($instance);
    }

    /**
     * @param object|string $instance
     * @param string $property_name
     * @param mixed $data
     * @throws \ReflectionException
     */
    public function invokeSetProperty($instance, string $property_name, $data)
    {
        if (gettype($instance) === 'string') {
            $instance = new $instance();
        }

        $reflection = new ReflectionClass($instance);
        $property = $reflection->getProperty($property_name);
        $property->setAccessible(true);

        $property->setValue($instance, $data);
    }
}
