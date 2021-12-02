<?php

namespace mtf\Assert\Object;

/**
 * Description of ClassExists
 * 断言类存在
 *
 * @author dongasai
 */
class ClassExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::classExists($value, $this->getMessage($message));
        return true;
    }

}
