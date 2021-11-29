<?php

namespace mtf\Assert\Type;

/**
 * Description of StringNotEmpty
 *
 * @author dongasai
 */
class StringNotEmpty extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是`字符串`，切不为空，结果是：%s';

    public function assertions($value, $message = ''): bool
    {

        \Webmozart\Assert\Assert::stringNotEmpty($value, $this->getMessage($message));
        return true;
    }


}
