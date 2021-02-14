<?php

namespace mtf\Assert\Type;

/**
 * Description of Numeric
 *
 * @author dongasai
 */
class Numeric extends \mtf\Framework\Constraint
{
    protected $defaultMessage = '期望事故一个数字. 结果: %s';
    
    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::numeric($value, $this->getMessage($message));
    }
}
