<?php

namespace mtf\Assert\Arr;

use mtf\Util\InvalidArgumentHelper;
use mtf\Util\Type;
use Webmozart\Assert\Assert;

/**
 * 属性的类型都是同一个类型
 *
 */
class ContainsOnlyInOf extends \mtf\Framework\Constraint
{

    /**
     * 断言
     *
     * @param string $value
     * @param null $message
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function assertions($value, $message = ''): bool
    {
        if (!\is_array($value) &&
            !(\is_object($value) && $value instanceof \Traversable)) {
            throw InvalidArgumentHelper::factory(
                2,
                'array or traversable'
            );
        }

        $message = $this->getMessage($message);

        foreach ($value as $item) {

            if ($item instanceof $this->expected) {

            } else {
                // 不是指定的类
                $msg = sprintf(
                         $message ?: 'Expected a value to contain %2$s. Got: %s',
                         Type::typeToString($item),
                         $this->expected
                     );

                InvalidArgumentHelper::reportInvalidArgument($msg);
            }

        }

        return true;
    }

}
