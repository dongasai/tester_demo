<?php

namespace mtf\Assert\String;

/**
 * Description of NotContains
 * 检查字符串不包含子字符串
 * @author dongasai
 */
class NotContains extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notContains($value, $this->expected, $this->getMessage($message));
    }

}
