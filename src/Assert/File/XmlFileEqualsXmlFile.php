<?php

namespace mtf\Assert\File;

use Assert\Assertion;
use mtf\Framework\Constraint;
use mtf\Util\Xml;
use Webmozart\Assert\Assert;

/**
 * 两个xml 文件相同
 * @author dongasai
 */
class XmlFileEqualsXmlFile extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        Assert::fileExists($value);
        Assert::fileExists($this->expected);

        $expected = Xml::loadFile($this->expected);
        $actual   = Xml::loadFile($value);
        dump($expected->ge,$actual);

        Assert::eq($expected, $actual);

        return true;
    }

}