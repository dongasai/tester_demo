<?php

namespace mtf\Assert\String;

/**
 * Description of Lower
 * 检查字符串是否只包含小写字符
 *
 * @author dongasai
 */
class Lower extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::lower($value, $this->getMessage($message));
        return true;
    }

}
