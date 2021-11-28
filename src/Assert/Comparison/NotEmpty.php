<?php

namespace mtf\Assert\Comparison;

/**
 * Description of NotEmpty
 *
 * @author dongasai
 */
class NotEmpty extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notEmpty($value, $this->getMessage($message));
        return true;
    }

}
