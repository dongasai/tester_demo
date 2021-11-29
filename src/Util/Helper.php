<?php

namespace mtf\Util;

use DateTime;
use DateTimeImmutable;

use function get_class;
use function is_array;
use function is_object;
use function is_resource;
use function is_string;
use function method_exists;

class Helper
{

    /**
     * @param mixed $value
     *
     * @return string
     */
    static public function valueToString($value)
    {
        if (null === $value) {
            return 'null';
        }

        if (true === $value) {
            return 'true';
        }

        if (false === $value) {
            return 'false';
        }

        if (is_array($value)) {
            return 'array';
        }

        if (is_object($value)) {
            if (method_exists($value, '__toString')) {
                return get_class($value) . ': ' . self::valueToString($value->__toString());
            }

            if ($value instanceof DateTime || $value instanceof DateTimeImmutable) {
                return get_class($value) . ': ' . self::valueToString($value->format('c'));
            }

            return get_class($value);
        }

        if (is_resource($value)) {
            return 'resource';
        }

        if (is_string($value)) {
            return '"' . $value . '"';
        }

        return (string)$value;
    }

}