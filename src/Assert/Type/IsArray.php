<?php

namespace mtf\Assert\Type;

/**
 * Description of IsArray
 *
 * @author dongasai
 */
class IsArray extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是一个数组. 结果是: %s';

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isArray($value, $this->getMessage($message));
    }

}
