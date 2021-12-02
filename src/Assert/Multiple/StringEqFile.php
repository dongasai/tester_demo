<?php

namespace mtf\Assert\Multiple;

use mtf\Framework\Constraint;
use Webmozart\Assert\Assert;

/**
 * 字符串内容与文件内容相同
 *
 * @author dongasai
 */
class StringEqFile extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        Assert::fileExists($this->expected);
        Assert::eq(file_get_contents($this->expected), $value);

        return true;
    }

}