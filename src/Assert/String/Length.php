<?php

namespace mtf\Assert\String;

/**
 * Description of Length
 * 检查字符串长度
 * @author dongasai
 */
class Length extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::length($value, $this->expected, $this->getMessage($message));
    }

}
