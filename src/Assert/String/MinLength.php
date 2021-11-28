<?php

namespace mtf\Assert\String;

/**
 * Description of MinLength
 * 字符串最小长度
 *
 * @author dongasai
 */
class MinLength extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::minLength($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
