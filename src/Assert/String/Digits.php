<?php

namespace mtf\Assert\String;

/**
 * Description of Digits
 * 检查字符串是否只包含数字
 *
 * @author dongasai
 */
class Digits extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::digits($value, $this->getMessage($message));
        return true;
    }

}
