<?php

namespace mtf\Framework;

/**
 * Description of TestResult
 *
 * @author Administrator
 */
class TestResult
        implements InterfaceTestResult
{

    /**
     * 增加一个致命错误
     * @param \mtf\Framework\Test $test
     * @param \Throwable $t
     * @param float $time
     */
    public function addError(Test $test, Result\Throwable $t, float $time)
    {
        // TODO: Implement addError() method.
    }

    /**
     * 增加一个监听器
     * @param \mtf\Framework\TestListener $listener
     */
    public function addListener(TestListener $listener)
    {
        
    }

    /**
     * 移除一个监听级
     * @param \mtf\Framework\TestListener $listener
     */
    public function removeListener(TestListener $listener)
    {

        ;
    }

    public function flushListeners()
    {
        
    }

    /**
     * 增加一个 测试 警告
     * @param \mtf\Framework\Test $test
     * @param \mtf\Framework\Result\Warning $e
     * @param float $time
     */
    public function addWarning(Test $test, Result\Warning $e, float $time)
    {
        
    }

    /**
     * 增加一个测试失败
     * @param \mtf\Framework\Test $test
     * @param \mtf\Framework\Result\AssertionFailedError $e
     * @param float $time
     */
    public function addFailure(Test $test, Result\AssertionFailedError $e, float $time)
    {
        ;
    }

    /**
     * 通知测试套件将开始.
     */
    public function startTestSuite(TestSuite $suite)
    {
        
    }

    /**
     * 通知测试套件已经完成。
     */
    public function endTestSuite(TestSuite $suite)
    {
        
    }

    /**
     * 通知测试将要开始了。
     */
    public function startTest(Test $test)
    {
        
    }

    /**
     * 通知测试已完成。
     *
     * @throws \mtf\Excetions\InvalidArgumentException
     */
    public function endTest(Test $test, float $time)
    {
        
    }

}
