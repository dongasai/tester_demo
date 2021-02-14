<?php

namespace mtf\Assert\String;

/**
 * Description of NotRegex
 * 检查字符串是否与正则表达式不匹配
 * @author dongasai
 */
class NotRegex extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notRegex($value, $this->expected, $this->getMessage($message));
    }

}
