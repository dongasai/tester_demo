<?php

namespace mtf\Assert\Arr;

use mtf\Util\InvalidArgumentHelper;
use Webmozart\Assert\Assert;

/**
 * 属性的类型都是同一个类型
 *
 */
class ContainsOnly extends \mtf\Framework\Constraint
{

    /**
     * 断言
     *
     * @param string $value
     * @param null $message
     * @return bool
     * @throws \mtf\Excetions\Exception
     */
    public function assertions($value, $message = null): bool
    {
        if (!\is_array($value) &&
            !(\is_object($value) && $value instanceof \Traversable)) {
            throw InvalidArgumentHelper::factory(
                2,
                'array or traversable'
            );
        }

        $message = $this->getMessage($message);

        $func    = 'all' . ucfirst($this->expected);

        Assert::$func($value, $message);

        return true;
    }

}
