<?php

namespace mtf\Framework;

/**
 *
 * @author dongasai
 */
interface InterfaceTestResult
{

    /**
     * @deprecated Use the `TestHook` interfaces instead
     *
     * @codeCoverageIgnore
     *
     * Registers a TestListener.
     */
    public function addListener(TestListener $listener);

    /**
     * @deprecated Use the `TestHook` interfaces instead
     *
     * @codeCoverageIgnore
     *
     * Unregisters a TestListener.
     */
    public function removeListener(TestListener $listener);

    /**
     * @deprecated Use the `TestHook` interfaces instead
     *
     * @codeCoverageIgnore
     *
     * Flushes all flushable TestListeners.
     */
    public function flushListeners();

    /**
     * Adds an error to the list of errors.
     */
    public function addError(Test $test, Throwable $t, float $time);

    /**
     * Adds a warning to the list of warnings.
     * The passed in exception caused the warning.
     */
    public function addWarning(Test $test, Warning $e, float $time);

    /**
     * 向失败列表中添加一个失败
     * 异常传入导致失败
     */
    public function addFailure(Test $test, AssertionFailedError $e, float $time);

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
     * @throws \mtf\Excetions\InvalidArgumentException
     */
    public function endTest(Test $test, float $time);
}
