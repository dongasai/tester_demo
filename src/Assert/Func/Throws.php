<?php

namespace mtf\Assert\Func;

/**
 * Description of Throws
 *
 * @author dongasai
 */
class Throws extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::throws($value, $this->expected, $this->getMessage($message));
    }

}
