<?php

namespace mtf\Assert\String;

/**
 * Description of NotEndsWith
 * 检查字符串是否不是特定后缀（不以特定字符串结尾）
 * @author dongasai
 */
class NotEndsWith extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notEndsWith($value, $this->expected, $this->getMessage($message));
    }

}
