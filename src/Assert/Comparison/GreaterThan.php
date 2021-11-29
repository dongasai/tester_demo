<?php

namespace mtf\Assert\Comparison;

/**
 * Description of GreaterThan
 * 大于
 * @author dongasai
 */
class GreaterThan extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::greaterThan($value, $this->expected, $this->getMessage($message));

        return true;
    }

}
