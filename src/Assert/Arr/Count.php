<?php

namespace mtf\Assert\Arr;

/**
 * Description of Count
 * 断言数组中包含指定数量的元素
 *
 * @author dongasai
 */
class Count extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::count($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
