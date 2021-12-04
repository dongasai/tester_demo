<?php

namespace mtf\Excetions;

/**
 * 跳过验证的异常
 * 整个用例都将跳过
 * @author dongasai
 *
 */
class SkippedTestError extends AssertionFailedError
{

}