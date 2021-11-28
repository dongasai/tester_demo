<?php

namespace mtf\Assert\Object;

/**
 * Description of MethodExists
 * 断言类、对象中存在指定方法
 *
 * @author dongasai
 */
class MethodExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::methodExists($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
