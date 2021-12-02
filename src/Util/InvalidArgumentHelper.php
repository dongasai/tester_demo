<?php

namespace mtf\Util;

use mtf\Excetions\Exception;
use Closure;

class InvalidArgumentHelper
{

    /**
     * @param int $argument
     * @param string $type
     * @param mixed $value
     *
     * @return Exception
     */
    public static function factory($argument, $type, $value = null)
    {
        $stack = \debug_backtrace();

        return new Exception(
            \sprintf(
                'Argument #%d%sof %s::%s() must be a %s',
                $argument,
                $value !== null ? ' (' . \gettype($value) . '#' . $value . ')' : ' (No Value) ',
                $stack[1]['class'],
                $stack[1]['function'],
                $type
            )
        );
    }


    /**
     * @param string $message
     *
     * @throws \InvalidArgumentException
     *
     */
    static public function reportInvalidArgument(string $message)
    {
        throw new \InvalidArgumentException($message);
    }

}