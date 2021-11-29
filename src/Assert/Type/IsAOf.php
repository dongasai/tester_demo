<?php

namespace mtf\Assert\Type;

/**
 * Description of IsAOf
 *
 * @author dongasai
 */
class IsAOf extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::isAOf($value, $this->expected, $this->getMessage($message));
    }

}
