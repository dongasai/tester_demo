<?php

namespace mtf\Assert\Type;


/**
 * Description of string
 *
 * @author dongasai
 */
class IsString extends \mtf\Framework\Constraint
{
    protected $defaultMessage = '期望是`字符串`，结果是: %s';

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::string($value, $this->getMessage($message));
        return true;
    }

}
