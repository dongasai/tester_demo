<?php

namespace mtf\Assert\Comparison;

/**
 * Description of Equals
 *
 * @author dongasai
 */
class Equals extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::eq($value, $this->expected, $this->getMessage($message));

        return true;
    }

}
