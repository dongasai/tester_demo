<?php

namespace mtf\Assert\Comparison;

/**
 * Description of GreaterThanEq
 * 大于等于
 * @author dongasai
 */
class GreaterThanEq extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::greaterThanEq($value, $this->expected, $this->getMessage($message));
    }

}
