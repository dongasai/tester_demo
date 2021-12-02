<?php

namespace mtf\Assert\Arr;

/**
 * Description of MaxCount
 * 断言数组中最多包含指定数量的元素
 *
 * @author dongasai
 */
class MaxCount extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::maxCount($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
