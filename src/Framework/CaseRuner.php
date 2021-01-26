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

    public function __construct($caseClass)
    {
        $this->caseClasss = $caseClass;
    }

    /**
     * 运行测试测试用例们 
     */
    public function run()
    {
        dump($this->caseClasss,getmypid());
    }

}
