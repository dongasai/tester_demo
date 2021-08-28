<?php


/**
 * Description of BTest
 * 一个测试案例
 *
 * @thread 1 运行于那个线程
 * @author dongasai
 */
class BTest extends \mtf\Framework\TestCase
{

    /**
     * 一个测试
     */
    public function testA()
    {
        $a = 1;
        $this->assertEquals(1, $a);
    }

}


/**
 * Description of BTest
 * 一个测试案例
 *
 * @thread 1 运行于那个线程
 * @author dongasai
 */
class B1Test extends \mtf\Framework\TestCase
{

    /**
     * 一个测试
     */
    public function testA()
    {
        $a = 1;
        $this->assertEquals(1, $a);
        $this->assertEquals(1, $a);
        $this->assertEquals(1, $a);
        $this->assertEquals(1, $a);

    }

}