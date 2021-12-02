<?php

namespace mtf\Assert\Arr;

/**
 * Description of IsList
 * 检查数组是否为非关联列表
 *
 * @author dongasai
 */
class IsList extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::isList($value, $this->getMessage($message));
        return true;
    }

}
