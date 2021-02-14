<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsTrue
 *
 * @author dongasai
 */
class IsTrue extends mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::true($value, $this->getMessage($message));
    }

}
