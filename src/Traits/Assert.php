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
    static $count;

    /**
     * 断言两个变量相等
     * @param $expected 期望值
     * @param $actual 实际值
     * @param string $message 消息
     */
    public static function assertEquals($expected, $actual, string $message = '')
    {
        $constraint = new Equal($expected);

        static::assertThat($actual, $constraint, $message);
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
        self::$count += count($constraint);

        $constraint->evaluate($value, $message);
    }

}
