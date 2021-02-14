<?php

namespace mtf\Assert\Comparison;

/**
 * Description of NotSame
 * 检查一个值与另一个值是否不相同（!==）
 * @author dongasai
 */
class NotSame extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notSame($value, $this->expected, $this->getMessage($message));
    }

}
