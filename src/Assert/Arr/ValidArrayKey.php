<?php

namespace mtf\Assert\Arr;

/**
 * Description of ValidArrayKey
 * 检查值是否为有效的数组键（int或字符串）
 *
 * @author dongasai
 */
class ValidArrayKey extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::validArrayKey($value, $this->getMessage($message));
        return true;
    }

}
