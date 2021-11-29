<?php

namespace mtf\Assert\Comparison;

/**
 * 不区分大小写的相同
 * @author dongasai
 */
class EqualsIgnoringCase  extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::eq(mb_strtolower($value),mb_strtolower($this->expected) , $this->getMessage($message));

        return true;
    }

}
