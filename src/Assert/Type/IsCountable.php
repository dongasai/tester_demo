<?php

namespace mtf\Assert\Type;

/**
 * Description of IsCountable
 *
 * @author dongasai
 */
class IsCountable extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isCountable($value, $this->getMessage($message));
        return true;
    }

}
