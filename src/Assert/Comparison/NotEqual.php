<?php

namespace mtf\Assert\Comparison;

/**
 * Description of NotEqual
 *
 * @author dongasai
 */
class NotEqual extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::notEq($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
