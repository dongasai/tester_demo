<?php

namespace mtf\Traits;

use http\Encoding\Stream\Inflate;
use mtf\Assert\Arr\ContainsOnly;
use mtf\Assert\Arr\ContainsOnlyInOf;
use mtf\Assert\Arr\Count;
use mtf\Assert\Comparison\InArray;
use mtf\Assert\Comparison\IsEmpty;
use mtf\Assert\Comparison\IsFalse;
use mtf\Assert\Comparison\IsTrue;
use mtf\Assert\Equal;
use mtf\Assert\File\Directory;
use mtf\Assert\File\DirectoryReadable;
use mtf\Assert\File\FileExists;
use mtf\Assert\File\Readable;
use mtf\Assert\File\Writable;
use mtf\Assert\String\Contains;
use mtf\Assert\String\ContainsIgnoringCase;
use mtf\Assert\Type\Infinite;
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

    static $count       = 0;
    static $AssertCount = 0;

    /**
     * 断言两个变量相等
     *
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
     * 差值在一定范围之内
     * @param $expected
     * @param $actual
     * @param float $delta
     * @param string $message
     */
    static public function assertEqualsWithDelta($expected, $actual, $delta = 0.0,$message = ''){
        $constraint = new \mtf\Assert\Comparison\EqualsDelta($expected,$delta);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 对象的比较
     * @param $expected
     * @param $actual
     * @param float $delta
     * @param string $message
     * @deprecated 未实现
     * @todo 等待实现
     */
    static public function assertObjectEquals($expected, $actual, $delta = 0.0,$message = ''){
        $constraint = new \mtf\Assert\Comparison\EqualsDelta($expected,$delta);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 规范的相等（先进行规范，在比较）
     * 数组先排序
     *
     * @param array $expected
     * @param array $actual
     * @param string $message
     * @todo 对象则转换为包含所有属性的数组
     */
    static public function assertEqualsCanonicalizing(array $expected, array $actual, string $message = '')
    {
        $constraint = new \mtf\Assert\Comparison\EqualsCanonicalizing($expected);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 不区分大小写的相等
     * @param $expected
     * @param $actual
     * @param string $message
     */
    static public function assertEqualsIgnoringCase($expected, $actual, string $message = '')
    {
        $constraint = new \mtf\Assert\Comparison\EqualsIgnoringCase($expected);

        static::assertThat($actual, $constraint, $message);
    }


    /**
     * 断言大于
     *
     * @param $expected
     * @param $actual
     * @param string $message
     */
    public static function assertGreaterThan($expected, $actual, string $message = '')
    {
        $constraint = new \mtf\Assert\Comparison\GreaterThan($expected);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 断言大于或等于
     *
     * @param $expected
     * @param $actual
     * @param string $message
     */
    public static function assertGreaterThanOrEqual($expected, $actual, string $message = '')
    {
        $constraint = new \mtf\Assert\Comparison\GreaterThanEq($expected);

        static::assertThat($actual, $constraint, $message);
    }


    /**
     * 断言小于
     *
     * @param $expected
     * @param $actual
     * @param string $message
     */
    public static function assertLessThan($expected, $actual, string $message = '')
    {
        $constraint = new \mtf\Assert\Comparison\LessThan($expected);

        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 断言小于或等于
     *
     * @param $expected
     * @param $actual
     * @param string $message
     */
    public static function assertLessThanOrEqual($expected, $actual, string $message = '')
    {
        $constraint = new \mtf\Assert\Comparison\LessThanEq($expected);

        static::assertThat($actual, $constraint, $message);
    }


    //

    /**
     * 断言数组中存在指定的key
     *
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
     * 是否在其键值内
     *
     * @param $value
     * @param array $array
     * @param string $message
     */
    public static function assertContains($value, array $array, string $message = '')
    {
        $constraint = new InArray($value);
        static::assertThat($array, $constraint, $message);
    }

    /**
     * 是否是其子串
     *
     * @param string $value
     * @param string $string2
     * @param string $message
     */
    static public function assertStringContainsString(string $value, string $string2, string $message = '')
    {
        $constraint = new Contains($value);
        static::assertThat($string2, $constraint, $message);
    }

    /**
     * 是否是其子串，不区分大小写
     *
     * @param string $value
     * @param string $string2
     * @param string $message
     */
    static public function assertStringContainsStringIgnoringCase(string $value, string $string2, string $message = '')
    {
        $constraint = new ContainsIgnoringCase($value);
        static::assertThat($string2, $constraint, $message);
    }

    /**
     * 数组所有的键值都是指定类型
     *
     * @param string $string
     * @param array $array
     * @param string $message
     */
    static public function assertContainsOnly(string $string, $array, string $message = '')
    {
        $constraint = new ContainsOnly($string);
        static::assertThat($array, $constraint, $message);
    }

    /**
     * 数组内的所有值都是指定的类
     *
     * @param string $string
     * @param $array
     * @param string $message
     */
    public function assertContainsOnlyInstancesOf(string $string, $array, string $message = '')
    {
        $constraint = new ContainsOnlyInOf($string);
        static::assertThat($array, $constraint, $message);
    }

    /**
     * 数组元素为指定个数
     *
     * @param int $count
     * @param array $array
     * @param string $message
     */
    static public function assertCount(int $count, array $array, string $message = '')
    {
        $constraint = new Count($count);
        static::assertThat($array, $constraint, $message);
    }

    /**
     * 地址是文件夹
     *
     * @param string $dir
     * @param string $message
     */
    static public function assertDirectoryExists(string $dir, string $message = '')
    {
        $constraint = new Directory();
        static::assertThat($dir, $constraint, $message);
    }


    /**
     * 地址是可读的文件夹
     *
     * @param string $dir
     * @param string $message
     */
    static public function assertDirectoryIsReadable(string $dir, string $message = '')
    {
        $constraint = new DirectoryReadable();
        static::assertThat($dir, $constraint, $message);
    }

    /**
     * 路径是可写的文件夹
     *
     * @param string $dir
     * @param string $message
     */
    static public function assertDirectoryIsWritable(string $dir, string $message = '')
    {
        $constraint = new DirectoryReadable($dir);
        static::assertThat($dir, $constraint, $message);
    }

    /**
     * 是否为empty
     *
     * @param $value
     * @param string $message
     */
    public function assertEmpty($value, string $message = '')
    {
        $constraint = new IsEmpty();
        static::assertThat($value, $constraint, $message);
    }


    /**
     * 断言数组中不存在指定的key
     *
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
     *
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
     *
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
    public static function assertClassHasStaticAttribute(string $attributeName, $className, string $message = '')
    {
        $constraint = new \mtf\Assert\Object\PropertyExists($attributeName);
        static::assertThat($className, $constraint, $message);

    }


    /**
     * 断言是否为资源型，可附加断言资源类型
     *
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
     * 是否为false，bool类型
     * @param $value
     * @param string $message
     */
    static public function assertFalse($value, string $message = '')
    {
        $constraint = new IsFalse();
        static::assertThat($value, $constraint, $message);
    }

    /**
     * 是否为true，bool类型
     * @param $value
     * @param string $message
     */
    static public function assertTrue($value, string $message = '')
    {
        $constraint = new IsTrue();
        static::assertThat($value, $constraint, $message);
    }

    /**
     * 文件相等
     * @param string $actual
     * @param string $expected
     * @param string $message
     */
    static public function assertFileEquals(string $actual,string $expected, string $message = '')
    {
        $constraint = new \mtf\Assert\File\FileEquals($expected);
        static::assertThat($actual, $constraint, $message);
    }

    /**
     * 文件存在
     * @param $file
     * @param string $message
     */
    static public function assertFileExists($file, string $message = '')
    {
        $constraint = new FileExists();
        static::assertThat($file, $constraint, $message);
    }

    /**
     * 文件存在且可读取的
     * @param $value
     * @param string $message
     */
    static public function assertFileIsReadable($file, string $message = '')
    {
        self::assertFileExists($file,$message);
        self::assertIsReadable($file, $message);
    }

    /**
     * 文件存在且可写入的
     * @param $value
     * @param string $message
     */
    static public function assertFileIsWritable($file, string $message = '')
    {
        self::assertFileExists($file,$message);
        self::assertIsWritable($file, $message);
    }


    /**
     * 路径是可读的
     * @param $file
     * @param string $message
     */
    static public function assertIsReadable($path, string $message = '')
    {
        $constraint = new Readable();
        static::assertThat($path, $constraint, $message);
    }

    /**
     * 路径是可写入的
     * @param $path
     * @param string $message
     */
    static public function assertIsWritable($path, string $message = '')
    {
        $constraint = new Writable();
        static::assertThat($path, $constraint, $message);
    }

    static public function assertInfinite($value, string $message = '')
    {
        $constraint = new Infinite();
        static::assertThat($value, $constraint, $message);
    }

    /**
     * 执行一个约束
     *
     * @throws InvalidArgumentException
     */
    protected static function assertThat($value, Constraint $constraint, string $message = '')
    {
        self::$count += count($constraint); //约束
        self::$AssertCount++; //断言
        $debug = debug_backtrace()[2];
        $case  = $debug['class'] ?? $debug['file'];
        $func  = $debug['function'] ?? $debug['line'];
        $args  = $debug['args'];
        $test  = new \mtf\Framework\Test($case, $func, $args);
        try {
            $constraint->evaluate($value, $message);
        } catch (\mtf\Excetions\AssertionFailedError $ex) {
            \mtf\Framework\TestResult::getInstance()->addFailure($test, $ex, $test->getRunTimes());
        }
    }

}
