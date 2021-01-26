<?php

namespace mtf\Framework;

/**
 * Description of CaseRuner
 * 测试用例运行
 * @author dongasai
 */
class CaseRuner implements \Jenner\SimpleFork\Runnable
{

    private $caseClasss;
    
    private $Ptid; // 线程id,位于第几线程,并非系统进程id

    public function __construct($caseClass)
    {
        $this->caseClasss = $caseClass;
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
        sleep(1);
        dump($this->caseClasss, time(), $this->Ptid);
    }

}
