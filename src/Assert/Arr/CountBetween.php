<?php

namespace mtf\Assert\Arr;

/**
 * Description of CountBetween
 * 检查数组的计数是否在给定范围内
 *
 * @author dongasai
 */
class CountBetween extends \mtf\Framework\Constraint
{

    /**
     * 构造方法
     *
     * @param int $min 最少计数
     * @param int $max 最多计数
     */
    public function __construct(int $min, int $max)
    {
        $this->expected = [ $min, $max ];
    }

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::countBetween($value, $this->expected[0], $this->expected[1], $$this->getMessage($message));
        return true;
    }

}
