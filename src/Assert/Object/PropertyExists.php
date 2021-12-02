<?php

namespace mtf\Assert\Object;

/**
 * Description of PropertyExists
 * 断言类/对象中存在属性
 *
 * @author dongasai
 */
class PropertyExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::propertyExists($value, $this->expected, $this->getMessage($message));
        return true;
    }

}
