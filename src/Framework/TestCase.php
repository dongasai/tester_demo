<?php

namespace mtf\Framework;

use mtf\Framework\Result\Warning;

/**
 * Description of TestCase
 * 测试用例基类
 *
 * @author dongasai
 */
abstract class TestCase
{

    use \mtf\Traits\Assert;

    static public $_return;

    /**
     * 此方法在运行此测试类的第一个测试之前被调用。
     */
    static public function setUpBeforeClass()
    {
        
    }

    /**
     * 此方法在运行此测试类的最后一次测试后调用。
     */
    static public function tearDownAfterClass()
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

    public function run($func)
    {

        $assertCountBefore = TestCase::$AssertCount;

        $test         = new Test($this, $func);
        $options      = new Comment([$this, $func], 'Method');
        $times        = $options->getTimes();
        $dataProvider = $options->getDataProvider();
        $depends      = $options->getDepends();
        $provider     = null;
        $dependData   = null;
        // 数据
        if ($dataProvider) {
            if (!method_exists($this, $dataProvider)) {
                new \mtf\Excetions\DataProviderFileNotFoundExcetion($this, $func, $dataProvider);
            }
            $provider = call_user_func([$this, $dataProvider]);
            if (!is_array($provider)) {
                new \mtf\Excetions\ProviderDataException($this, $dataProvider);
            }
        }
        if ($depends) {
            if (!isset(self::$_return['depends'])) {
                // 跳过
                TestResult::getInstance()->addWarning($test, new Result\Warning(),$test->getRunTimes());
            }
        }
        // 进行多次执行
        for ($i = 0; $i < $times; $i++) {
            $this->setUp();
            TestResult::getInstance()->startTest($test);
            if ($provider) {
                foreach ($provider as $providerD) {
                    self::$_return[$func] = call_user_func_array([$this, $func], $providerD);
                }
            } elseif ($dependData) {
                self::$_return[$func] = call_user_func_array([$this, $func], $dependData);
            } else {
                self::$_return[$func] = call_user_func([$this, $func]);
            }
            $test->getRunTimes();
            TestResult::getInstance()->endTest($test);
            $this->tearDown();
        }
        $assertCountRun = TestCase::$AssertCount - $assertCountBefore;
        if ( $assertCountRun == 0) {
            // 这个测试方法没有断言，标记危险
            TestResult::getInstance()->addRisky($test,new Warning("没有断言!"));
        }

    }

}
