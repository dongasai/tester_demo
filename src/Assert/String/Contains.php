<?php

namespace mtf\Assert\String;

/**
 * Description of Contains
 * 检查字符串是否包含子字符串
 *
 * @author dongasai
 */
class Contains extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::contains($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
