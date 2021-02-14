<?php

namespace mtf\Assert\Type;

/**
 * Description of IsIterable
 *
 * @author dongasai
 */
class IsIterable extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是`可迭代结构`. 结果是: %s';

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isIterable($value, $this->getMessage($message));
    }

}
