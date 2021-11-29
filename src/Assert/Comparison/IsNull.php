<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsNull
 * 是Null
 * @author dongasai
 */
class IsNull extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::null($value, $this->getMessage($message));
        return true;
    }

}
