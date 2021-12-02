<?php

namespace mtf\Assert\Type;

/**
 * Description of UniqueValues
 *
 * @author dongasai
 */
class UniqueValues extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::uniqueValues($value, $this->getMessage($message));
        return true;
    }

}
