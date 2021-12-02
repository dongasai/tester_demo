<?php

namespace mtf\Assert\Type;

use mtf\Framework\Constraint;
use mtf\Util\Helper;
use mtf\Util\InvalidArgumentHelper;

use function is_infinite;
use function sprintf;

/**
 * 是否为INF
 * @author dongasai
 */
class Infinite extends Constraint
{

    /**
     *
     * @param mixed $value
     * @param string $message
     * @return bool
     */
    public function assertions($value, $message = ''): bool
    {
        if (false === is_infinite($value)) {
            InvalidArgumentHelper::reportInvalidArgument(sprintf(
                                              $message ?: 'Expected a value to is INF Got: %s',
                                              Helper::valueToString($value)
                                          ));
        }

        return true;
    }

}