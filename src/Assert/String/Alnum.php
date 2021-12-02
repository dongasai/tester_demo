<?php

namespace mtf\Assert\String;

/**
 * Description of Alnum
 * 检查字符串是否只包含字母和数字
 *
 * @author dongasai
 */
class Alnum extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::alnum($value, $this->getMessage($message));
        return true;
    }

}
