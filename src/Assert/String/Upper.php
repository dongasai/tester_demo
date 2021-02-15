<?php

namespace mtf\Assert\String;

/**
 * Description of Upper
 * 检查字符串是否仅包含大写字符
 * @author dongasai
 */
class Upper extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::upper($value, $this->getMessage($message));
    }

}
