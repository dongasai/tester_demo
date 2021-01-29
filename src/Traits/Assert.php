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
     * Asserts that two variables are equal.
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
     */
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
     * 执行一个约束
     * @throws InvalidArgumentException
     */
    public static function assertThat($value, Constraint $constraint, string $message = '')
    {
        self::$count += count($constraint);

        $constraint->evaluate($value, $message);
    }

}