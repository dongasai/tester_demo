<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsFalse
 *
 * @author dongasai
 */
class IsFalse extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::false($value, $this->getMessage($message));
    }

}
