<?php

namespace mtf\Assert\Object;

/**
 * Description of InterfaceExists
 * 断言接口（Interface）存在
 *
 * @author dongasai
 */
class InterfaceExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::interfaceExists($value, $this->getMessage($message));

        return true;
    }

}
