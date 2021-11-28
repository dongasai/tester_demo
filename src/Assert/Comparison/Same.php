<?php

namespace mtf\Assert\Comparison;

/**
 * Description of Same
 * 检查一个值是否与另一个值相同 (===)
 *
 * @author dongasai
 */
class Same extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::same($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
