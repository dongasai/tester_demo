<?php


/**
 * Description of D
 * @thread 4 运行于第四个线程
 * @author dongasai
 * @group lisi
 * @group wamgwu
 * @requires PHP 5.3.3
 * @requires Mtf 3.6.3
 * @requires OS Linux
 * @requires OS WIN32|WINNT
 * @requires PHPUnit 4.6
 * @requires function imap_open
 * @requires function ReflectionMethod::setAccessible
 * @requires extension mysqli
 * @requires extension redis 2.2.0
 * @small
 * @medium
 * @large
 * 
 */
class DTest extends \mtf\Framework\TestCase
{

    /**
     * @times 3
     */
    public function testA()
    {
        $actual= 52;
        $this->assertEquals(52, $actual);
        sleepms(mt_rand(10,40)/10);
        $this->assertGreaterThan(1, $actual);
    }

}
