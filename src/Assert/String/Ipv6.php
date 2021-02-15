<?php

namespace mtf\Assert\String;

/**
 * Description of Ipv6
 * 是否为Ipv6 的ip地址
 * @author dongasai
 */
class Ipv6 extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::ipv6($value, $this->getMessage($message));
    }

}
