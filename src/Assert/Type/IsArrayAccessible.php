<?php

namespace mtf\Assert\Type;

/**
 * Description of IsArrayAccessible
 *
 * @author dongasai
 */
class IsArrayAccessible extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::isArrayAccessible($value, $this->getMessage($message));
    }

}
