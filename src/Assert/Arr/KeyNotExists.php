<?php

namespace mtf\Assert\Arr;

/**
 * Description of KeyNotExists
 * 断言数组中不存在指定的key
 *
 * @author dongasai
 */
class KeyNotExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::keyNotExists($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
