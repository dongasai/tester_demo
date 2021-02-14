<?php

namespace mtf\Assert;

use mtf\Framework\Constraint;

/**
 * Class Equal
 * 断言 相等 不尽兴类型判断 等同于 == 判断
 * @package mtf\Assert
 */
class Equal
        extends Constraint
{

    public function matches($value, string$message){
        return $this->count();
    }


    public function toString(): string
    {
        return "期望值为: ,输入值是:";
    }

}
