<?php

namespace mtf\Assert\String;

/**
 * Description of StartsWith
 * 检查字符串是否有前缀
 *
 * @author dongasai
 */
class StartsWith extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::startsWith($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
