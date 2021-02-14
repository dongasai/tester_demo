<?php

namespace mtf\Assert\Comparison;

/**
 * Description of NotNull
 *
 * @author dongasai
 */
class NotNull extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notNull($value, $this->getMessage($message));
    }
    
}
