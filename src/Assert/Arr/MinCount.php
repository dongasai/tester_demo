<?php

namespace mtf\Assert\Arr;

/**
 * Description of MinCount
 * 断言数组中至少包含指定数量的元素
 *
 * @author dongasai
 */
class MinCount extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::minCount($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
