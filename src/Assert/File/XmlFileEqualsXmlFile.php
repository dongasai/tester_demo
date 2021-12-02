<?php

namespace mtf\Assert\File;

use mtf\Assert\Object\XmlEq;
use mtf\Framework\Constraint;
use mtf\Util\Xml;
use Webmozart\Assert\Assert;

/**
 * 两个xml 文件相同
 *
 * @author dongasai
 */
class XmlFileEqualsXmlFile extends Constraint
{

    protected $defaultMessage = "期望文件相同，结果不相同。";

    public function assertions($value, $message = ''): bool
    {
        Assert::fileExists($value);
        Assert::fileExists($this->expected);

        $expected = Xml::loadFile($this->expected);
        $actual   = Xml::loadFile($value);
        $this->callConstraint(new XmlEq($expected), $actual, $message);

        return true;
    }

    /**
     * 约束条件个数
     * @return int
     */
    public function count(): int
    {
        // 文件存在，内容相同
        return 2;
    }

}