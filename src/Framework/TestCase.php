<?php

namespace mtf\Framework;

/**
 * Description of TestCase
 * 测试用例基类
 * @author dongasai
 */
abstract class TestCase
{

    /**
     * 此方法在运行此测试类的第一个测试之前被调用。
     */
    public static function setUpBeforeClass()
    {
        
    }

    /**
     * 此方法在运行此测试类的最后一次测试后调用。
     */
    public static function tearDownAfterClass()
    {
        
    }

    /**
     * 这个方法在每次测试之前被调用。
     */
    protected function setUp()
    {
        
    }

    /**
     * 这个方法在每次测试之后被调用。
     */
    protected function tearDown()
    {
        

    }

}
