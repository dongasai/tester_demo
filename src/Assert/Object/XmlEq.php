<?php

namespace mtf\Assert\Object;

use mtf\Framework\Constraint;

/**
 * xml对象判断
 */
class XmlEq extends Constraint
{

    /**
     * 约束值
     *
     * @var \DOMDocument $expected
     */
    protected $expected;

    public function assertions($value, $message = ''): bool
    {
        return true;
    }

    /**
     * 断言逻辑
     * @param \DOMDocument $value
     * @return bool
     */
    protected function matches(\DOMDocument $value): bool
    {
        foreach ($value->childNodes as $childNode){
            dump($childNode;
        }
        return true;
    }

}