<?php

namespace mtf\Assert\String;

/**
 * Description of EndsWith
 * 检查字符串是否为特定后缀（以特定字符串结尾）
 *
 * @author dongasai
 */
class EndsWith extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::endsWith($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
