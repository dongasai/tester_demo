<?php

namespace mtf\Assert\String;

/**
 * Description of Regex
 * 检查字符串是否与正则表达式匹配 
 * @author dongasai
 */
class Regex extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::regex($value, $this->expected, $this->getMessage($message));
    }

}
