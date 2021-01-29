<?php

namespace mtf\Framework;

/**
 * 自我描述(能够自转字符串)
 * @author dongasai
 */
interface SelfDescribing
{

    /**
     * 对象转字符串
     */
    public function toString(): string;
}
