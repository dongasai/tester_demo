<?php
namespace ter;

include_once dirname(__DIR__) .'/vendor/autoload.php';

use Tester\Assert as AssertEr;

/**
 * Description of BTest
 * @testCase
 * @author dongasai
 */
class BTest extends \Tester\TestCase
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
        AssertEr::equal(0, $actual);
    }
    
    /**
     * 
     */
    public function testE1()
    {
        $actual= 0;
        sleep(3);
        AssertEr::equal(0, $actual);
    }
    
    /**
     * 
     */
    public function testE2()
    {
        $actual= 0;
        sleep(3);
        AssertEr::equal(0, $actual);
    }
    
    /**
     * 
     */
    public function testFace()
    {
        $actual= 0;
        sleep(3);
        AssertEr::equal(0, $actual);
    }
    
    /**
     * 
     */
    public function testFace2()
    {
        $actual= 0;
        sleep(3);
        AssertEr::equal(0, $actual);
    }
    
    /**
     * 
     */
    public function testFace3()
    {
        $actual= time();
        sleep(3);
        Assert::gt(time(), $actual);
        sleep(9);
        AssertEr::equal(time(), $actual);
    }
    
}

/** @testCase */
(new BTest)->run();
