<?php

namespace mtf\Assert\Multiple;

use mtf\Assert\Object\XmlEq;
use mtf\Framework\Constraint;
use mtf\Util\Xml;
use Webmozart\Assert\Assert;

/**
 * xml字符串和xml文件内容相同
 * @author dongasai
 *
 */
class XmlStringEqualsXmlFile extends Constraint
{

    protected $defaultMessage = "期望字符串和文件内容相同，结果不相同。";

    public function assertions($value, $message = ''): bool
    {
        Assert::fileExists($this->expected);

        $expected = Xml::loadFile($this->expected);
        $actual   = Xml::load($value);
        $this->callConstraint(new XmlEq($expected), $actual, $message);

        return true;
    }

    /**
     * 约束条件个数
     *
     * @return int
     */
    public function count(): int
    {
        // 文件存在，内容相同
        return 2;
    }

}