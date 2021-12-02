<?php

namespace mtf\Assert\String;

use Assert\Assertion;
use mtf\Framework\Constraint;

/**
 * 字符串格式
 *
 * @author dongasai
 */
class StringMatchesFormat extends Constraint
{
    protected $defaultMessage = "期望的格式 %2s ,结果 %s";

    /**
     * @var string 正则匹配
     */
    protected $pattern;

    public function __construct($expected = null)
    {
        $this->pattern = $this->createPatternFromFormat(
            \preg_replace('/\r\n/', "\n", $expected)
        );

        $this->expected = $expected;
    }

    /**
     * 执行断言
     *
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        $this->callMatches($value, $message);
        return true;
    }

    /**
     * 断言逻辑
     *
     * @param $value
     * @return bool
     */
    protected function matches($value): bool
    {
        return \preg_match($this->pattern, $value) > 0;
    }

    protected function createPatternFromFormat($string)
    {
        $string = \str_replace(
            [
                '%e',
                '%s',
                '%S',
                '%a',
                '%A',
                '%w',
                '%i',
                '%d',
                '%x',
                '%f',
                '%c'
            ],
            [
                '\\' . DIRECTORY_SEPARATOR,
                '[^\r\n]+',
                '[^\r\n]*',
                '.+',
                '.*',
                '\s*',
                '[+-]?\d+',
                '\d+',
                '[0-9a-fA-F]+',
                '[+-]?\.?\d+\.?\d*(?:[Ee][+-]?\d+)?',
                '.'
            ],
            \preg_quote($string, '/')
        );

        return '/^' . $string . '$/s';
    }

}