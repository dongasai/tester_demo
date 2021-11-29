<?php

namespace mtf\Assert\File;

/**
 * Description of Readable
 * 检查值是可读路径
 *
 * @author dongasai
 */
class Readable extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::readable($value, $this->getMessage($message));
        return true;
    }

}
