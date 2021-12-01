<?php

namespace mtf\Assert\Type;


/**
 * Description of string
 * 字符串类型
 * @author dongasai
 */
class IsString extends \mtf\Framework\Constraint
{
    protected $defaultMessage = '期望是`字符串`，结果是: %s';

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::string($value, $this->getMessage($message));
        return true;
    }

}
