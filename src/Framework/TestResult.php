<?php

namespace mtf\Framework;

use mtf\Excetions\IncompleteTestError;
use mtf\Excetions\SkippedTestError;
use SebastianBergmann\Timer\Duration;

/**
 * Description of TestResult
 *
 * @author Administrator
 */
class TestResult implements InterfaceTestResult
{

    static private $instance;

    static public function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * 增加一个监听器
     *
     * @param \mtf\Framework\TestListener $listener
     */
    public function addListener(TestListener $listener)
    {

    }

    /**
     * 移除一个监听级
     *
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
     * 增加一个致命错误
     *
     * @param \mtf\Framework\Test $test
     * @param \Throwable $t
     * @param float $time
     */
    public function addError(Test $test, $t, $time)
    {
        // TODO: Implement addError() method.
    }

    /**
     * 增加一个 测试 警告
     *
     * @param \mtf\Framework\Test $test
     * @param \mtf\Framework\Result\Warning $e
     * @param Duration $time
     */
    public function addWarning(Test $test, $e, $time)
    {

    }

    /**
     * 增加一个测试失败（断言失败）
     *
     * @param \mtf\Framework\Test $test
     * @param \mtf\Framework\Result\AssertionFailedError $e
     * @param Duration $time
     */
    public function addFailure(Test $test, $e, $time)
    {
        ;
    }


    /**
     * 标记一个未完成的测试
     *
     * @param Test $test
     * @param IncompleteTestError $incompleteTestError
     * @return void
     */
    public function addIncomplete(Test $test, IncompleteTestError $incompleteTestError)
    {

    }

    /**
     * 标记一个测试跳过
     *
     * @param Test $test
     * @param SkippedTestError $skippedTestError
     * @return void
     */
    public function addSkip(Test $test, SkippedTestError $skippedTestError)
    {

    }

    /**
     * 通知测试套件将开始.
     */
    public function startTestSuite(TestSuite $suite)
    {


    }

    /**
     * 通知测试套件已经完成。
     *
     * @param \mtf\Framework\TestSuite $suite
     * @param Duration $time
     */
    public function endTestSuite(TestSuite $suite, Timeer $time)
    {

    }

    /**
     * 通知测试将要开始了。
     */
    public function startTest(Test $test)
    {

    }

    /**
     * @param Test $test
     * @return void
     */
    public function endTest(Test $test)
    {

    }

}
