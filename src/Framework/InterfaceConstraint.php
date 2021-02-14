<?php

namespace mtf\Framework;

/**
 * 断言抽象
 * @author dongasai
 */
interface InterfaceConstraint
{

    public function matches($value, string $message);
}
