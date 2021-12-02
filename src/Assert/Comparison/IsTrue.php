<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsTrue
 * 是True，bool类型
 * @author dongasai
 */
class IsTrue extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::true($value, $this->getMessage($message));
        return true;
    }

}
