<?php

namespace mtf\Assert\File;

/**
 * Description of Directory
 * 断言路径为文件夹
 *
 * @author dongasai
 */
class Directory extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = ''): bool
    {
        \Webmozart\Assert\Assert::directory($value, $this->getMessage($message));
        return true;
    }

}
