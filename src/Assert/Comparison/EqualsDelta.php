<?php

namespace mtf\Assert\Comparison;

/**
 * Description of Equals
 * 相同
 *
 * @author dongasai
 */
class EqualsDelta extends \mtf\Framework\Constraint
{

    /**
     * @var int $delta 差值
     */
    private $delta = 0;

    /**
     * @param int $expected
     * @param int $delta
     */
    public function __construct($expected = 0, $delta = 0)
    {
        $this->expected = $expected;
        $this->delta    = $delta;
    }

    /**
     * 断言
     *
     * @param int $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::lessThanEq($value, $this->expected + $this->delta, $this->getMessage($message));
        \Webmozart\Assert\Assert::greaterThanEq($value, $this->expected - $this->delta, $this->getMessage($message));

        return true;
    }

    /**
     * 约束个数
     *
     * @return int
     */
    public function count(): int
    {
        // 标准值，差值
        return 2;
    }

}
