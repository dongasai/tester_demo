<?php

namespace mtf\Assert\String;

/**
 * Description of Ipv4
 * 是否为ipv4的ip地址
 *
 * @author dongasai
 */
class Ipv4 extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::ipv4($value, $this->getMessage($message));
        return true;
    }

}
