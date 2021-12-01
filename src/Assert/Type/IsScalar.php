<?php

namespace mtf\Assert\Type;

/**
 * Description of IsScalar
 * 标量类型
 * @author dongasai
 */
class IsScalar extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是一个标量. 结果是: %s';

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::scalar($value, $this->getMessage($message));
        return true;
    }

}
