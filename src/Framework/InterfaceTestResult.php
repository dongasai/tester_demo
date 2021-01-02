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
public function addListener(TestListener $listener): void
{
$this->listeners[] = $listener;
}

/**
 * @deprecated Use the `TestHook` interfaces instead
 *
 * @codeCoverageIgnore
 *
 * Unregisters a TestListener.
 */
public function removeListener(TestListener $listener): void
{
foreach ($this->listeners as $key => $_listener) {
if ($listener === $_listener) {
unset($this->listeners[$key]);
}
}
}

/**
 * @deprecated Use the `TestHook` interfaces instead
 *
 * @codeCoverageIgnore
 *
 * Flushes all flushable TestListeners.
 */
public function flushListeners(): void
{
foreach ($this->listeners as $listener) {
if ($listener instanceof Printer) {
$listener->flush();
}
}
}

/**
 * Adds an error to the list of errors.
 */
public function addError(Test $test, Throwable $t, float $time): void
{
if ($t instanceof RiskyTestError) {
$this->recordRisky($test, $t);

$notifyMethod = 'addRiskyTest';

if ($test instanceof TestCase) {
$test->markAsRisky();
}

if ($this->stopOnRisky || $this->stopOnDefect) {
$this->stop();
}
} elseif ($t instanceof IncompleteTest) {
$this->recordNotImplemented($test, $t);

$notifyMethod = 'addIncompleteTest';

if ($this->stopOnIncomplete) {
$this->stop();
}
} elseif ($t instanceof SkippedTest) {
$this->recordSkipped($test, $t);

$notifyMethod = 'addSkippedTest';

if ($this->stopOnSkipped) {
$this->stop();
}
} else {
$this->recordError($test, $t);

$notifyMethod = 'addError';

if ($this->stopOnError || $this->stopOnFailure) {
$this->stop();
}
}

// @see https://github.com/sebastianbergmann/phpunit/issues/1953
if ($t instanceof Error) {
$t = new ExceptionWrapper($t);
}

foreach ($this->listeners as $listener) {
$listener->{$notifyMethod}($test, $t, $time);
}

$this->lastTestFailed = true;
$this->time += $time;
}

/**
 * Adds a warning to the list of warnings.
 * The passed in exception caused the warning.
 */
public function addWarning(Test $test, Warning $e, float $time): void
{
if ($this->stopOnWarning || $this->stopOnDefect) {
$this->stop();
}

$this->recordWarning($test, $e);

foreach ($this->listeners as $listener) {
$listener->addWarning($test, $e, $time);
}

$this->time += $time;
}

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
