<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsEmpty
 * 是否为empty
 * @author dongasai
 */
class IsEmpty extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::isEmpty($value, $this->getMessage($message));

        return true;
    }

}
