<?php

namespace mtf\Assert\Type;

/**
 * Description of IsInstanceOf
 * 对象类型断言
 * @author dongasai
 */
class IsInstanceOf extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望对象类型为： %2$s. 结果是: %s';

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::isInstanceOf($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
