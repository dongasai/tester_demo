<?php

namespace mtf\Assert\Object;

/**
 * Description of SubclassOf
 * 断言是它的子类
 *
 * @author dongasai
 */
class SubclassOf extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::subclassOf($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
