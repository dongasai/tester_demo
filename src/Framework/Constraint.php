<?php

namespace mtf\Framework;

/**
 * Class Constraint InterfaceConstraint
 * 约束类,断言类应继承继承此类
 * @package mtf\Framework
 */
abstract class Constraint
        implements SelfDescribing, \Countable
{

    public function __construct()
    {
        ;
    }

    /**
     * @param $value
     * @param $message
     */
    public function evaluate($value, $message)
    {
        
    }

    /**
     * 约束条件的数量
     * 两个约束条件的比如:范围断言
     * @return int
     */
    public function count(): int
    {
        return 1;
    }

}
