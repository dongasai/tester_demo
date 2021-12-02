<?php

namespace mtf\Assert\File;

use mtf\Framework\Constraint;
use Webmozart\Assert\Assert;

/**
 * 文件内容相等
 *
 * @author dongasai
 */
class FileEquals extends Constraint
{

    public function assertions($value, $message = ''): bool
    {
        Assert::fileExists($value, $this->getMessage($message));
        Assert::fileExists($this->expected, $this->getMessage($message));
        Assert::eq(file_get_contents($value), file_get_contents($this->expected));

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
