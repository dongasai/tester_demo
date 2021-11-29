<?php


/**
 * Description of ATest
 * 一个测试案例
 *
 * @thread 1 运行于那个线程
 * @author dongasai
 */
class A1Test extends \mtf\Framework\TestCase
{

    public function testA()
    {

        foreach (range(1, 10) as $item) {
            self::assertLessThanOrEqual(5, $item);
        }

    }

}

/**
 * @thread 2 运行于那个线程
 */
class A2Test extends \mtf\Framework\TestCase
{

    public function testA()
    {
        echo __CLASS__ . "\r\n";
        sleep(2);
    }

}

/**
 * @thread 3 运行于那个线程
 */
class A3Test extends \mtf\Framework\TestCase
{

    public function testA()
    {
        echo __CLASS__ . "\r\n";
        sleep(2);
    }

}


/**
 * @thread 4 运行于那个线程
 */
class A4Test extends \mtf\Framework\TestCase
{

    public function testA()
    {
        echo __CLASS__ . "\r\n";
        sleep(2);
    }

}

/**
 * @thread 5 运行于那个线程
 */
class A5Test extends \mtf\Framework\TestCase
{

    public function testA()
    {
        echo __CLASS__ . "\r\n";
        sleep(2);
    }

}


/**
 * @thread 6 运行于那个线程
 */
class A6Test extends \mtf\Framework\TestCase
{

    public function testA()
    {
        echo __CLASS__ . "\r\n";
        sleep(2);
    }

}

/**
 * @thread 7
 *
 * 运行于那个线程
 */
class A7Test extends \mtf\Framework\TestCase
{

    public function testA()
    {
        echo __CLASS__ . "\r\n";
        sleep(2);
    }

}

/**
 * @thread 8 运行于那个线程
 */
class A8Test extends \mtf\Framework\TestCase
{

    public function testA()
    {
        echo __CLASS__ . "\r\n";
        sleep(2);
        self::assertEquals(1, 1);
    }

}
