<?php

namespace mtf\Assert\Type;

/**
 * Description of NotInstanceOf
 *
 * @author dongasai
 */
class NotInstanceOf extends \mtf\Framework\Constraint
{
    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notInstanceOf($value, $this->expected,$this->getMessage($message));
    }
}
