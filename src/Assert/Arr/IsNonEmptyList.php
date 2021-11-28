<?php

namespace mtf\Assert\Arr;

/**
 * Description of IsNonEmptyList
 * 检查数组是否为非关联列表，并且不为空
 *
 * @author dongasai
 */
class IsNonEmptyList extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isNonEmptyList($value, $this->getMessage($message));
        return true;
    }

    public function count(): int
    {
        return 2;
    }

}
