<?php

namespace mtf\Assert\Type;

/**
 * Description of Integer
 *
 * @author dongasai
 */
class Integer extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是`整型`，结果: %s';

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::integer($value, $this->getMessage($message));
    }

    

}
