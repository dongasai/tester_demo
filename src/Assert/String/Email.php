<?php

namespace mtf\Assert\String;

/**
 * Description of Email
 * 是否为Email
 *
 * @author dongasai
 */
class Email extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::email($value, $this->getMessage($message));
        return true;
    }

}
