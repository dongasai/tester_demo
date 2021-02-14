<?php

namespace mtf\Assert\Comparison;

/**
 * Description of OneOf
 *
 * @author dongasai
 */
class OneOf extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::oneOf($value, $this->expected, $this->getMessage($message));
    }

}
