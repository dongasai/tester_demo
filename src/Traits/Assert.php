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
    /**
     * Asserts that two variables are equal.
     *
     * @throws ExpectationFailedException
     * @throws InvalidArgumentException
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