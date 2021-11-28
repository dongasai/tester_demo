<?php

namespace mtf\Assert\String;

/**
 * Description of Uuid
 * 是否为uuid（符合uuid标准的字符串）
 *
 * @author dongasai
 */
class Uuid extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::uuid($value, $this->getMessage($message));
        return true;
    }

}
