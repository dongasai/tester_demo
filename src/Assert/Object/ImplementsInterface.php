<?php

namespace mtf\Assert\Object;

/**
 * Description of ImplementsInterface
 * 断言实现了接口
 * @author dongasai
 */
class ImplementsInterface extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::implementsInterface($value, $this->expected, $this->getMessage($message));
    }

}
