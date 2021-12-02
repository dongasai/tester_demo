<?php

namespace mtf\Assert\Object;

/**
 * Description of PropertyNotExists
 * 断言类、对象中不存在指定属性
 *
 * @author dongasai
 */
class PropertyNotExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::propertyNotExists($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
