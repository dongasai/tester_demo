<?php

namespace mtf\Assert\String;

use Webmozart\Assert\Assert;

/**
 * 字符串符合文件内容要求的格式
 *
 * @author dongasai
 */
class StringMatchesFormatFile extends StringMatchesFormat
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
        Assert::fileExists($this->expected);
        $this->pattern = $this->createPatternFromFormat(
            \preg_replace('/\r\n/', "\n", file_get_contents($this->expected))
        );

        return parent::assertions($value, $message);
    }

}