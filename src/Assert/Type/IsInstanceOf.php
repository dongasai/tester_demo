<?php

namespace mtf\Assert\Type;

/**
 * Description of IsInstanceOf
 *
 * @author dongasai
 */
class IsInstanceOf extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望对象类型为： %2$s. 结果是: %s';
    
    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isInstanceOf($value, $this->expected, $this->getMessage($message));
    }

}
