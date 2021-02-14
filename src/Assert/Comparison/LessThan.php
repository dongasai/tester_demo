<?php

namespace mtf\Assert\Comparison;

/**
 * Description of LessThan
 * 小于
 * @author dongasai
 */
class LessThan extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::lessThan($value, $this->expected, $this->getMessage($message));
    }

}
