<?php

namespace mtf\Assert\File;

/**
 * Description of Directory
 * 断言路径为文件夹
 *
 * @author dongasai
 */
class DirectoryReadable extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::directory($value, $this->getMessage($message));
        \Webmozart\Assert\Assert::readable($value, $this->getMessage($message));

        return true;
    }

    /**
     * 约束条件的数量
     * 两个约束条件的比如:范围断言，非空字符串断言
     *
     * @return int
     */
    public function count(): int
    {
        // 文件夹，可读
        return 2;
    }

}
