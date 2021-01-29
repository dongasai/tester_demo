<?php

namespace mtf\Framework;

use mtf\Excetions\Exception;

/**
 *
 * @author dongasai
 */
interface InterfaceTestResult
{

    /**
     * 注册一个钩子.
     */
    public function addListener(TestListener $listener);

    /**
     *
     * 取消注册一个钩子.
     */
    public function removeListener(TestListener $listener);

    /**
     *
     * 清空所有已注册的钩子.
     */
    public function flushListeners();

    /**
     * 将错误添加到错误列表.
     */
    public function addError(Test $test, Result\Throwable $t, float $time);

    /**
     * 将警告添加到警告列表中.
     * 传入的异常导致了警告.
     */
    public function addWarning(Test $test, Result\Warning $e, float $time);

    /**
     * 向失败列表中添加一个失败
     * 异常传入导致失败
     */
    public function addFailure(Test $test, Result\AssertionFailedError $e, float $time);

    /**
     * 通知测试套件将开始.
     */
    public function startTestSuite(TestSuite $suite);

    /**
     * 通知测试套件已经完成。
     */
    public function endTestSuite(TestSuite $suite);

    /**
     * 通知测试将要开始了。
     */
    public function startTest(Test $test);

    /**
     * 通知测试已完成。
     *
     * @throws \mtf\Excetions\InvalidArgumentException
     */
    public function endTest(Test $test, float $time);
}
