<?php

namespace mtf\Assert\String;

/**
 * Description of Ip
 * 是否为Ip地址，（ IPv4 或 IPv6）
 * @author dongasai
 */
class Ip extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::ip($value, $this->getMessage($message));
    }

}
