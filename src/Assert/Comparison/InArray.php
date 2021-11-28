<?php

namespace mtf\Assert\Comparison;

/**
 * Description of InArray
 *
 * @author dongasai
 */
class InArray extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::inArray($value, $this->expected, $this->getMessage($message));

        return true;
    }

}
