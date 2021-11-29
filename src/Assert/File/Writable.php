<?php

namespace mtf\Assert\File;

/**
 * Description of Writable
 * 检查值是可写路径
 *
 * @author dongasai
 */
class Writable extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::writable($value, $this->getMessage($message));
        return true;
    }

}
