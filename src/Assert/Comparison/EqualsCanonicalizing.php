<?php

namespace mtf\Assert\Comparison;

/**
 * 规范化后的相同
 * 数组排序，对象转数组
 * @author dongasai
 * @todo 对象转换为包含私有，保护，公开属性的数组进行排序比较
 */
class EqualsCanonicalizing extends \mtf\Framework\Constraint
{

    /**
     * 进行断言
     * @param mixed $value
     * @param null $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        sort($value);
        sort($this->expected);
        \Webmozart\Assert\Assert::eq($value, $this->expected, $this->getMessage($message));

        return true;
    }

}
