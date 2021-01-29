<?php

namespace mtf\Excetions;

/**
 * Description of TestDirNotFoundException
 * 测试文件夹未找到
 * @author dongasai
 */
class TestDirNotFoundException
        extends \Exception
{

    public function __construct($dir)
    {
        $message = "测试文件夹 $dir 未找到";
        parent::__construct($message, 0, null);
    }

}
