<?php

namespace mtf\Assert\String;

/**
 * Description of NotWhitespaceOnly
 * 检查字符串是否至少包含一个非空格字符
 *
 * @author dongasai
 */
class NotWhitespaceOnly extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::notWhitespaceOnly($value, $this->getMessage($message));
        return true;
    }

}
