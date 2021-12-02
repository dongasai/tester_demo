<?php

namespace mtf\Util;

/**
 *
 */
class Type
{

    /**
     * @param mixed $value
     *
     * @return string
     */
    static public function typeToString($value)
    {
        return \is_object($value) ? \get_class($value) : \gettype($value);
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function isType($type)
    {
        return \in_array(
            $type,
            [
                'numeric',
                'integer',
                'int',
                'float',
                'string',
                'boolean',
                'bool',
                'null',
                'array',
                'object',
                'resource',
                'scalar'
            ]
        );
    }

}
