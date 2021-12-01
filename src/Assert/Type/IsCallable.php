<?php

namespace mtf\Assert\Type;

/**
 * Description of IsCallable
 *
 * @author dongasai
 */
class IsCallable extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '希望是`可调用结构`. 结果是: %s';

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::isCallable($value, $this->getMessage($message));
        return true;
    }

}
