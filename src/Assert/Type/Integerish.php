<?php

namespace mtf\Assert\Type;

/**
 * Description of Integerish
 *
 * @author dongasai
 */
class Integerish extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是整数. 结果: %s';

    public function assertions($value, $message = null): bool
    {

        \Webmozart\Assert\Assert::integerish($value, $this->getMessage($message));
    }

}
