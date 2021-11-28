<?php

namespace mtf\Assert\Type;

/**
 * Description of IsInstanceOfAny
 *
 * @author dongasai
 */
class IsInstanceOfAny extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isInstanceOfAny($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
