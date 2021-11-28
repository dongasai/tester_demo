<?php

namespace mtf\Assert\Type;

/**
 * Description of IsTraversable
 *
 * @deprecated use "isIterable" or "isInstanceOf" instead
 * @author dongasai
 */
class IsTraversable extends \mtf\Framework\Constraint
{

    protected $defaultMessage = 'The "%s" assertion is deprecated. You should stop using it, as it will soon be removed in 2.0 version. Use "isIterable" or "isInstanceOf" instead.';

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::isTraversable($value, $this->getMessage($message));
        return true;
    }

}
