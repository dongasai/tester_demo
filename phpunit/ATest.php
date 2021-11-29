<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ATest
 *
 * @author Administrator
 */
class ATest
    extends \PHPUnit\Framework\TestCase
{

    public function testA()
    {
        $actual = 0;
        $this->assertEquals(0, $actual);
        $this->assertContains('foo', stdClass::class);

        $this->assertContainsOnly('string', ['1', '2']);
        $this->assertEqualsCanonicalizing([3, 2, 1], [2, 3, 1]);
        $this->assertEqualsWithDelta(1.0, 1.5, 0.1);
        $this->assertFileIsReadable('/path/to/file');
        $this->assertInfinite(1);


    }

}
