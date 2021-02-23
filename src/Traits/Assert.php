<?php

namespace mtf\Traits;

use mtf\Assert\Equal;
use mtf\Excetions\InvalidArgumentException;
use mtf\Framework\Constraint;

/**
 * Trait Assert
 * 断言工具集
 *
 * @package mtf\Framework
 */
trait Assert
{

    static $count = 0;
    static $AssertCount = 0;

    /**
     * 断言两个变量相等
     * @param $expected 期望值
     * @param $actual 实际值
     * @param string $message 消息
     */
    public static function assertEquals($expected, $actual, string $message = '')
    {
        $constraint = new \mtf\Assert\Comparison\Equals($expected);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 断言数组中存在指定的key
     * @param mixed $key
     * @param array $array
     * @param string $message
     */
    public static function assertArrayHasKey($key, array $array, string $message = '')
    {
        $constraint = new \mtf\Assert\Arr\KeyExists($key);
        static::assertThat($array, $constraint, $message);
    }

    /**
     * 断言数组中不存在指定的key
     * @param type $key
     * @param mixed $array
     * @param string $message
     */
    public static function assertArrayNotHasKey($key, array $array, string $message = '')
    {
        $constraint = new \mtf\Assert\Arr\KeyNotExists($key);
        static::assertThat($array, $constraint, $message);
    }

    /**
     * 断言类/对象中存在属性
     * @param string $attributeName
     * @param string|object $className
     * @param string $message
     */
    public static function assertClassHasAttribute(string $attributeName, $className, string $message = '')
    {
        $constraint = new \mtf\Assert\Object\PropertyExists($attributeName);
        static::assertThat($className, $constraint, $message);
    }

    /**
     * 断言类、对象中不存在指定属性
     * @param string $attributeName
     * @param string|object $className
     * @param string $message
     */
    public static function assertClassNotHasAttribute(string $attributeName, $className, string $message = '')
    {
        $constraint = new \mtf\Assert\Object\PropertyNotExists($attributeName);
        static::assertThat($className, $constraint, $message);
    }
    /**
     * 
     * @param string $attributeName
     * @param string|object $className
     * @param string $message
     */
    public static function assertClassHasStaticAttribute(string $attributeName,  $className, string $message = '')
    {
         $constraint = new \mtf\Assert\Object\PropertyExists($attributeName);
        static::assertThat($className, $constraint, $message);
        
    }

    
    /**
     * 断言是否为资源型，可附加断言资源类型
     * @param $actual 变量
     * @param $expected 资源类型
     * @param string $message
     */
    public static function assertResource($actual, $expected = null, string $message = '')
    {

        $constraint = new \mtf\Assert\Type\Resource($expected);
        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 执行一个约束
     * @throws InvalidArgumentException
     */
    protected static function assertThat($value, Constraint $constraint, string $message = '')
    {
        self::$count += count($constraint); //约束
        self::$AssertCount++; //断言
        $debug = debug_backtrace()[2];
        $case = $debug['class'] ?? $debug['file'];
        $func = $debug['function'] ?? $debug['line'];
        $args = $debug['args'];
        $test = new \mtf\Framework\Test($case, $func, $args);
        try {
            $constraint->evaluate($value, $message);
        } catch (\mtf\Excetions\AssertionFailedError $ex) {
            \mtf\Framework\TestResult::getInstance()->addFailure($test, $ex, $test->getRunTimes());
        }
    }

}
