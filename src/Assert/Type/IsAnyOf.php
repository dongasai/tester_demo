<?php

namespace mtf\Assert\Type;

/**
 * Description of IsAnyOf
 *
 * @author dongasai
 */
class IsAnyOf extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isAnyOf($value, $this->expected, $this->getMessage($message));
    }

}
