<?php

namespace mtf\Assert;

/**
 * Description of Assert
 *
 * @author dongasai
 */
class Assert
{

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function valueToString($value)
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

        if (\is_array($value)) {
            return 'array';
        }

        if (\is_object($value)) {
            if (\method_exists($value, '__toString')) {
                return \get_class($value) . ': ' . self::valueToString($value->__toString());
            }

            if ($value instanceof DateTime || $value instanceof DateTimeImmutable) {
                return \get_class($value) . ': ' . self::valueToString($value->format('c'));
            }

            return \get_class($value);
        }

        if (\is_resource($value)) {
            return 'resource';
        }

        if (\is_string($value)) {
            return '"' . $value . '"';
        }

        return (string)$value;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    public static function typeToString($value)
    {
        return \is_object($value) ? \get_class($value) : \gettype($value);
    }

    public static function strlen($value)
    {
        if (!\function_exists('mb_detect_encoding')) {
            return \strlen($value);
        }

        if (false === $encoding = \mb_detect_encoding($value)) {
            return \strlen($value);
        }

        return \mb_strlen($value, $encoding);
    }

    /**
     * @param string $message
     *
     * @throws InvalidArgumentException
     *
     * @psalm-pure this method is not supposed to perform side-effects
     */
    public static function reportInvalidArgument($message)
    {
        throw new InvalidArgumentException($message);
    }

}
