<?php

namespace mtf\Assert\Arr;

/**
 * Description of KeyExists
 * 断言数组中存在指定的key
 *
 * @author dongasai
 */
class KeyExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::keyExists($value, $this->expected, $this->getMessage($message));

        return true;
    }

}
