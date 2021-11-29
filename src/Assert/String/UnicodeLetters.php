<?php

namespace mtf\Assert\String;

/**
 * Description of UnicodeLetters
 * 检查字符串是否只包含Unicode字母
 *
 * @author dongasai
 */
class UnicodeLetters extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::unicodeLetters($value, $this->getMessage($message));
        return true;
    }

}
