<?php

namespace mtf\Assert\Object;

use mtf\Assert\Assert;
use ReflectionClass;

/**
 * Constraint that asserts that the class it is evaluated for has a given
 * static attribute.
 *
 * The attribute name is passed in the constructor.
 */
class ClassHasStaticAttribute extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        if (!$this->matches($value)) {
            Assert::reportInvalidArgumenta(\sprintf(
                                               $message ?: 'Expected the Static Attribute %s to exist.',
                                               Assert::valueToString($value)
                                           ));
        }

        return true;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * @param mixed $other Value or object to evaluate.
     *
     * @return bool
     */
    protected function matches($other)
    {
        $class = new ReflectionClass($other);

        if ($class->hasProperty($this->expected)) {
            $attribute = $class->getProperty($this->expected);

            return $attribute->isStatic();
        }

        return false;
    }

}
