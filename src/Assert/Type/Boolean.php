<?php

namespace mtf\Assert\Type;

/**
 * Description of Boolean
 *
 * @author dongasai
 */
class Boolean extends \mtf\Framework\Constraint
{
    protected $defaultMessage = '期望是一个`布尔型`. 结果: %s';
    
    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::boolean($value, $this->getMessage($message));
    }
}
