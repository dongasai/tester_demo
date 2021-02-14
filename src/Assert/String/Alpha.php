<?php

namespace mtf\Assert\String;

/**
 * Description of Alpha
 * 检查字符串是否只包含字母
 * @author dongasai
 */
class Alpha extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::alpha($value, $this->getMessage($message));
    }

}
