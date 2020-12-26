<?php
namespace ter;

include_once dirname(__DIR__) .'/vendor/autoload.php';

use Tester\Assert as AssertEr;

/**
 * Description of Atest
 * @testCase
 * @author dongasai
 */
class ATest extends \Tester\TestCase
{
    
    /**
     * 第一个测试
     */
    public function testOne()
    {
        $actual= 0;
        AssertEr::same(0, $actual);
    }
    /**
     * 
     */
    public function testC()
    {
        $actual= 0;
        sleep(3);
        AssertEr::same(0, $actual);
    }
    
    /**
     * 
     */
    public function testD()
    {
        $actual= 0;
        sleep(3);
        AssertEr::same(0, $actual);
    }
    
    /**
     * 
     */
    public function testE()
    {
        $actual= 0;
        sleep(3);
        AssertEr::same(0, $actual);
    }
    
    /**
     * 
     */
    public function testF()
    {
        $actual= 0;
        sleep(3);
        AssertEr::same(0, $actual);
    }
    
    /**
     * 
     */
    public function testF1()
    {
        $actual= 0;
        sleep(3);
        AssertEr::same(0, $actual);
    }
   
    
    /**
     * 测试正常的时间
     */
    public function testTime1()
    {       
        echo 10;
        Assert::gt(1000, time());
    }
    
     /**
     * 测试正常的时间
     */
    public function testTime2()
    {       
        echo 10;
        Assert::gt(1000, time());
    }
    
    /**
     * 测试正常的时间
     */
    public function testTime3()
    {       
        echo 10;
        Assert::gt(1000, time());
    }
    
}

(new ATest)->run();