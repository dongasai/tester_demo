<?php

namespace mtf\Assert\String;

use Webmozart\Assert\Assert;

/**
 * 文件内容符合字符换要求的格式
 *
 * @author dongasai
 */
class StringFileMatchesFormat extends StringMatchesFormat
{

    /**
     * 执行断言
     *
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        Assert::fileExists($value);

        return parent::assertions(file_get_contents($value), $message);
    }

}