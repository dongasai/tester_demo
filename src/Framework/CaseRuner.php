<?php

namespace mtf\Framework;

/**
 * Description of CaseRuner
 * 测试用例运行
 * @author dongasai
 */
class CaseRuner
        implements \Jenner\SimpleFork\Runnable
{

    private $caseClasss;
    private $Ptid; // 线程id,位于第几线程,并非系统进程id
    private $testFunc = [];
    /**
     *
     * @var TestCase 
     */
    private $handle;

    public function __construct($caseClass)
    {
        $this->caseClasss = $caseClass;
    }

    public function getCaseClasss()
    {
        return $this->caseClasss;
    }

    public function setPtid($Ptid)
    {
        $this->Ptid = $Ptid;
    }

    /**
     * 运行测试测试用例们 
     */
    public function run()
    {
        sleep(2);
        $caseClass = $this->caseClasss;


        // 前置方法
        $caseClass::setUpBeforeClass();

        // 正式运行
        $case = new $caseClass();
        if ($case instanceof TestCase) {
            
        }
        $this->handle = $case;
        $me           = get_class_methods($case);

        foreach ($me as $func) {
            if (substr($func, 0, 4) === 'test') {
                $this->testFunc[] = $func;
            }
        }

        foreach ($this->testFunc as $func) {
            $this->handle->run($func);
        }

        // 后置方法
        // tearDownAfterClass
        $caseClass::tearDownAfterClass();
    }

  
    

}
