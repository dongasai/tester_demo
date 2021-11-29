<?php

namespace mtf\Assert\Type;

/**
 * Description of IsNotA
 *
 * @author dongasai
 */
class IsNotA extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::isNotA($value, $this->expected, $this->getMessage($message));
    }

}
