<?php

namespace mtf\Assert\Object;

use mtf\Framework\Constraint;
use Webmozart\Assert\Assert;

/**
 * 判断对象存在指定属性
 * @author dongasai
 */
class ObjectHasAttribute extends Constraint
{

    /**
     * 执行逻辑
     *
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        Assert::object($value);
        $this->callMatches($value, $message);

        return true;
    }

    /**
     * 断言逻辑
     *
     * @param $value
     * @return bool
     */
    protected function matches($value): bool
    {
        $object = new \ReflectionObject($value);

        return $object->hasProperty($this->expected);
    }

    /**
     * 约束数量
     *
     * @return int
     */
    public function count(): int
    {
        // 是对象，存在属性
        return 2;
    }

}