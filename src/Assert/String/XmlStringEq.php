<?php

namespace mtf\Assert\String;

use mtf\Assert\Object\XmlEq;
use mtf\Framework\Constraint;
use mtf\Util\Xml;

/**
 * xml 字符串 表述的数据相同
 *
 * @author dongasai
 */
class XmlStringEq extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        $expected = Xml::load($this->expected);
        $actual   = Xml::load($value);
        $this->callConstraint(new XmlEq($expected), $actual, $message);

        return true;
    }

}