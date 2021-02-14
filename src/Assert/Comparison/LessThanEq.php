<?php

namespace mtf\Assert\Comparison;

/**
 * Description of LessThanEq
 * 小于等于
 * @author dongasai
 */
class LessThanEq extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::lessThanEq($value, $this->expected, $this->getMessage($message));
    }
    
}
