<?php

namespace mtf\Assert\File;

use Assert\Assertion;
use mtf\Framework\Constraint;
use Webmozart\Assert\Assert;

/**
 * json内容和
 * @author dongasai
 */
class assertJsonStringEqualsJsonFile extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        Assert::string($value, $this->getMessage($message));
        Assert::fileExists($this->expected, $this->getMessage($message));
        Assertion::isJsonString($value);
        $a = json_decode($value);
        $b = json_decode(file_get_contents($this->expected));
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