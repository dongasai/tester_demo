<?php

namespace mtf\Framework;

/**
 * Description of Process
 * @property CaseRuner $runnable 测试用例
 * @author dongasi
 */
class Process extends \Jenner\SimpleFork\Process
{

    private $Ptid;

    public function __construct($execution = null, $name = null)
    {
        parent::__construct($execution, $name);
    }

    /**
     * 设置线程id
     * @param int $Ptid
     */
    public function setPtid($Ptid)
    {
        $this->Ptid = $Ptid;
        $this->runnable->setPtid($Ptid);
    }
    
    /**
     * 获取线程id
     * @return type
     */
    public function getPtid()
    {
        return $this->Ptid;
    }

    public function run()
    {
        dump(133, $this->name());
    }

}
