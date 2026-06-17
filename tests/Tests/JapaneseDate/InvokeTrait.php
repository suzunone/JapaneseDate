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
 */

namespace Tests\JapaneseDate;

use ReflectionClass;

use const PHP_VERSION_ID;

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
    public function invokeExecuteMethod(object|string $instance, string $method_name, array $options): mixed
    {
        if (is_string($instance)) {
            $instance = new $instance();
        }

        $reflection = new ReflectionClass($instance);
        $method = $reflection->getMethod($method_name);
        if (PHP_VERSION_ID < 80100) {
            /** @noinspection PhpExpressionResultUnusedInspection */
            $method->setAccessible(true);
        }

        return $method->invokeArgs($instance, $options);
    }

    /**
     * @param object|string $instance
     * @param string $property_name
     * @return mixed
     * @throws \ReflectionException
     */
    public function invokeGetProperty(object|string $instance, string $property_name): mixed
    {
        if (is_string($instance)) {
            $instance = new $instance();
        }

        $reflection = new ReflectionClass($instance);
        $property = $reflection->getProperty($property_name);
        if (PHP_VERSION_ID < 80100) {
            /** @noinspection PhpExpressionResultUnusedInspection */
            $property->setAccessible(true);
        }

        return $property->getValue($instance);
    }

    /**
     * @param object|string $instance
     * @param string $property_name
     * @param mixed $data
     * @throws \ReflectionException
     */
    public function invokeSetProperty(object|string $instance, string $property_name, mixed $data): void
    {
        if (is_string($instance)) {
            $instance = new $instance();
        }

        $reflection = new ReflectionClass($instance);
        $property = $reflection->getProperty($property_name);
        if (PHP_VERSION_ID < 80100) {
            /** @noinspection PhpExpressionResultUnusedInspection */
            $property->setAccessible(true);
        }

        $property->setValue($instance, $data);
    }
}
