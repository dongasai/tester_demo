<?php

namespace mtf\Assert\Type;

/**
 * Description of Scalar
 *
 * @author dongasai
 */
class Scalar extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是一个标量. 结果是: %s';

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::scalar($value, $this->getMessage($message));
        return true;
    }

}
