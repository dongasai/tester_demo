<?php

namespace mtf\Assert\Comparison;

/**
 * Description of GreaterThan
 *
 * @author dongasai
 */
class GreaterThan extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::greaterThan($value, $this->expected, $this->getMessage($message));
    }

}
