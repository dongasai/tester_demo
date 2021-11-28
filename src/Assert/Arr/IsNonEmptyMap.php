<?php

namespace mtf\Assert\Arr;

/**
 * Description of IsNonEmptyMap
 * 断言为关联数组切不为空
 *
 * @author dongasai
 */
class IsNonEmptyMap extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isNonEmptyMap($value, $this->getMessage($message));
        return true;
    }

    public function count(): int
    {
        return 2;
    }

}
