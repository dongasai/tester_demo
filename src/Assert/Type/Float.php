<?php

namespace mtf\Assert\Type;

/**
 * Description of Float
 *
 * @author dongasai
 */
class Float extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是`浮点型`。结果: %s';

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::float($value, $this->getMessage($message));
    }

}
