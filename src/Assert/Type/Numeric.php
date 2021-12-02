<?php

namespace mtf\Assert\Type;

/**
 * Description of Numeric
 * 数字
 * @author dongasai
 */
class Numeric extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望事故一个数字. 结果: %s';

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::numeric($value, $this->getMessage($message));

        return true;
    }

}
