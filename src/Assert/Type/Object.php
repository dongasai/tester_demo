<?php

namespace mtf\Assert\Type;

/**
 * Description of object
 *
 * @author dongasai
 */
class Object extends \mtf\Framework\Constraint
{

    protected $defaultMessage = '期望是个对象。结果是: %s';

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::object($value, $this->getMessage($message));
    }

}
