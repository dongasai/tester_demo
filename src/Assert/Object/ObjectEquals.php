<?php

namespace mtf\Assert\Object;

use mtf\Framework\Constraint;

/**
 * 对象 相等比较
 * @author dongasai
 * @todo 等待实现
 * @deprecated
 */
class ObjectEquals extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        return true;
    }

}