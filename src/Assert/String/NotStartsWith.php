<?php

namespace mtf\Assert\String;

/**
 * Description of NotStartsWith
 * 字符串不能以X开头
 *
 * @author dongasai
 */
class NotStartsWith extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::notStartsWith($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
