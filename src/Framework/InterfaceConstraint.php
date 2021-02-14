<?php

namespace mtf\Framework;

/**
 *
 * @author dongasai
 */
interface InterfaceConstraint
{

    /**
     * 断言
     * @param  $value 要断言的变量
     * @param string $message 提示信息字符串
     * @return bool
     */
    public function assertions($value, $message = null): bool;
}
