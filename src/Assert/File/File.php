<?php

namespace mtf\Assert\File;

/**
 * Description of File
 * 断言路径为文件
 * @author dongasai
 */
class File extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::file($value, $this->getMessage($message));
    }

}
