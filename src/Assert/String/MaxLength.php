<?php

namespace mtf\Assert\String;

/**
 * Description of MaxLength
 * 字符串最大长度
 * @author dongasai
 */
class MaxLength extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::maxLength($value, $this->expected, $this->getMessage($message));
    }

}
