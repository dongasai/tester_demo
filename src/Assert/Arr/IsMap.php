<?php

namespace mtf\Assert\Arr;

/**
 * Description of IsMap
 * 检查数组是否关联并且具有字符串作为键
 * @author dongasai
 */
class IsMap extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isMap($value, $this->getMessage($message));
    }

}
