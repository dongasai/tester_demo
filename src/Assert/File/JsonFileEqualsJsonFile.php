<?php

namespace mtf\Assert\File;

use mtf\Framework\Constraint;
use Webmozart\Assert\Assert;

/**
 * json文件，数据相同
 * @author dongasai
 */
class JsonFileEqualsJsonFile extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        Assert::fileExists($value, $this->getMessage($message));
        Assert::fileExists($this->expected, $this->getMessage($message));
        $a = json_decode(file_get_contents($value),true);
        $b = json_decode(file_get_contents($this->expected),true);
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