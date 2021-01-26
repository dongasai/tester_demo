<?php

namespace mtf\Framework;

/**
 * Description of Pool
 * @property Process[] $processes 进程池
 * @author dongasia
 */
class Pool extends \Jenner\SimpleFork\AbstractPool
{

    /**
     * @var int max process count
     */
    protected $max;
    private $pool = [];

    /**
     * @param int $max
     */
    public function __construct($max = 4)
    {
        $this->max = $max;
        for ($i = 1; $i <= $max; $i++) {
            $this->pool[$i] = false;
        }
    }

    /**
     * 设置线程状态
     * @param int $Ptid
     */
    private function setPoolStatus($Ptid = 0)
    {
        if ($Ptid > 0) {
            if ($this->pool[$Ptid]) {
               
                return false;
            } else {
                $this->pool[$Ptid] = true;
                return $Ptid;
            }
        } else {
            foreach ($this->pool as $k => $val) {
                if ($val === false) {
                    $this->pool[$k] = true;
                    return $k;
                }
            }
            return false;
        }
    }
    /**
     * 取消正在运行的状态
     * @param int $Ptid
     */
    private function clearPoolStatus($Ptid)
    {
        $this->pool[$Ptid] = false;
        return $Ptid;
    }

    /**
     * 执行进程
     * @param Process $process
     */
    public function execute(Process $process)
    {
        \Jenner\SimpleFork\Utils::checkOverwriteRunMethod(get_class($process));

        if (!$process->isStarted()  ) {
            $Ptid  = $this->setPoolStatus($process->name());
            if($Ptid){
                // 获取进程成功,可以启动
                $process->setPtid($Ptid);
                $process->start();
                
            }
        }
        array_push($this->processes, $process);
    }

    /**
     * wait for all process done
     *
     * @param bool $block block the master process
     * to keep the sub process count all the time
     * @param int $interval check time interval
     */
    public function wait($block = false, $interval = 100)
    {
        do {
            if ($this->isFinished()) {
                return;
            }
            parent::wait(false);
            if ($this->aliveCount() < $this->max) {
                foreach ($this->processes as $process) {
                    if ($process->isStarted()) {
                        if(!$process->isStopped()){
                            $this->clearPoolStatus($process->getPtid());
                        }
                        continue;
                    }
                
                    $Ptid  = $this->setPoolStatus($process->name());
                    if($Ptid){
                        // 获取进程成功,可以启动
                        $process->setPtid($Ptid);
                        $process->start();
                        
                    }
                    
                    
                    if ($this->aliveCount() >= $this->max) {
                        break;
                    }
                }
            }
            $block ? usleep($interval) : null;
        } while ($block);
    }

    

}
