<?php

namespace mtf\Assert\Comparison;

/**
 * Description of InArray
 * 是否在数组的键值内
 * @author dongasai
 */
class InArray extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::inArray($this->expected,$value,  $this->getMessage($message));

        return true;
    }

}
