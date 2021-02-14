<?php

namespace mtf\Assert\Type;

/**
 * Description of Resource
 *
 * @author dongasai
 */
class Resource extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::resource($value, $this->expected, $this->getMessage($message));
    }

    public function count(): int
    {
        return 2;
    }

}
