<?php

namespace mtf\Framework;

/**
 * Class Constraint InterfaceConstraint
 * 约束类,断言类应继承此类
 * @package mtf\Framework
 */
abstract class Constraint implements SelfDescribing, \Countable, InterfaceConstraint
{

    protected $defaultMessage = '';
    protected $expected = null;

    public function __construct($expected)
    {
        $this->expected = $expected;
    }

    /**
     * 
     * @param string|null $message
     * @return string
     */
    public function getMessage($message = null)
    {
        if (is_null($message)) {
            return $this->defaultMessage;
        }
        return $message;
    }

    /**
     * @param $value
     * @param $message
     */
    public function evaluate($value, string $message = null)
    {
        $this->assertions($value, $message);
    }

    /**
     * 约束条件的数量
     * 两个约束条件的比如:范围断言
     * @return int
     */
    public static function count(): int
    {
        return 1;
    }

    public function toString(): string
    {
        ;
    }

}
