<?php

namespace mtf\Assert\Comparison;

/**
 * Description of Range
 * 检查值是否在范围内
 *
 * @author dongasai
 */
class Range extends \mtf\Framework\Constraint
{

    public function __construct($min, $max)
    {
        $this->expected = [ $min, $max ];
    }

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::range($value, $this->expected[0], $this->expected[1], $message);
        return true;
    }

    public function count(): int
    {
        return 2;
    }

}
