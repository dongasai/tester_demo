<?php

namespace mtf\Assert\String;

/**
 * Description of LengthBetween
 * 字符串长度范围
 * @author dongasai
 */
class LengthBetween extends \mtf\Framework\Constraint
{

    /**
     * 
     * @param int $min 最小长度
     * @param int $max 最大长度
     */
    public function __construct(int $min, int $max)
    {
        $this->expected = [$min, $max];
    }

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::lengthBetween($value, $this->expected[0], $this->expected[1], $this->getMessage($message));
    }

}
