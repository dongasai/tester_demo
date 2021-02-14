<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsEmpty
 *
 * @author dongasai
 */
class IsEmpty extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isEmpty($value, $this->getMessage($message));
    }

}
