<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsNull
 *
 * @author dongasai
 */
class IsNull extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::null($value, $this->getMessage($message));
        
    }

}
