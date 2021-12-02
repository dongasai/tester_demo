<?php

namespace mtf\Assert\File;

use Assert\Assertion;
use mtf\Framework\Constraint;
use Webmozart\Assert\Assert;

/**
 * json内容和
 * @author dongasai
 */
class JsonStringEqualsJsonString extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        Assert::string($value, $this->getMessage($message));
        Assert::string($this->expected, $this->getMessage($message));

        Assertion::isJsonString($value);
        Assertion::isJsonString($this->expected);
        $a = json_decode($value, true);
        $b = json_decode($this->expected, true);
        sort($a);
        sort($b);
        Assert::eq($a, $b);

        return true;
    }

    /**
     * 约束数量
     *
     * @return int
     */
    public function count(): int
    {
        // 是文件,存在,内容相同
        return 3;
    }

}