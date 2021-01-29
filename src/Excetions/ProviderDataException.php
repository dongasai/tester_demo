<?php

namespace mtf\Excetions;

/**
 * Description of ProviderDataException
 * 供给数据错误
 * @author dongasai
 */
class ProviderDataException
        extends Exception
{

    public function __construct($that, $dataProvider)
    {
        $message = " 测试用例:" . get_class($that) . ",供给器方法 :$dataProvider,供给数据错误";
        parent::__construct($message, 0, null);
    }

}
