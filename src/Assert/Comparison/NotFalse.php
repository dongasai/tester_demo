<?php

namespace mtf\Assert\Comparison;

/**
 * Description of NotFalse
 *
 * @author dongasai
 */
class NotFalse extends \mtf\Framework\Constraint
{
    
    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notFalse($value, $this->getMessage($message));
    }
}
