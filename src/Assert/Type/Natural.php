<?php

namespace mtf\Assert\Type;

/**
 * Description of natural
 *
 * @author dongasai
 */
class Natural extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望一个非负整数。结果: %s';

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::natural($value, $this->getMessage($message));
    }

}
