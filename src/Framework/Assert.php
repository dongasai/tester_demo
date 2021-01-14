<?php

namespace mtf\Framework;

/**
 * Description of Assert
 * 断言工具
 * @author dongasai
 */
trait Assert
{

    /**
     * Asserts that two variables are equal.
     *
     * @throws \mtf\Excetions\ExpectationFailedException
     * @throws \mtf\Excetions\InvalidArgumentException
     */
    static public function assertEquals($expected, $actual, string $message = ''): void
    {
        $constraint = new IsEqual($expected);

        static::assertThat($actual, $constraint, $message);
    }
    
    /**
     * 
     * @param type $actual
     * @param type $constraint
     * @param type $message
     */
    static public function assertThat($actual, $constraint, $message)
    {
        
    }
    

}
