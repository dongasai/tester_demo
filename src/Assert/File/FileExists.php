<?php

namespace mtf\Assert\File;

/**
 * Description of FileExists
 * 断言路径为文件
 *
 * @author dongasai
 */
class FileExists extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::fileExists($value, $this->getMessage($message));
        return true;
    }

}
