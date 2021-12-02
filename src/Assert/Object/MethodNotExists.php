<?php

namespace mtf\Assert\Object;

/**
 * Description of MethodNotExists
 * 断言类、对象中不存在指定方法
 *
 * @author dongasai
 */
class MethodNotExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::methodNotExists($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
