<?php

namespace mtf\Assert\Comparison;

/**
 * Description of IsFalse
 * 是false ，bool类型
 * @author dongasai
 */
class IsFalse extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::false($value, $this->getMessage($message));

        return true;
    }

}
