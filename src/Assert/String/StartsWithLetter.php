<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mtf\Assert\String;

/**
 * Description of StartsWithLetter
 * 检查字符串以字母开头
 *
 * @author dongasai
 */
class StartsWithLetter extends \mtf\Framework\Constraint
{

    public function assertions($value, $message = null): bool
    {
        \Webmozart\Assert\Assert::startsWithLetter($value, $this->getMessage($message));
        return true;
    }

}
