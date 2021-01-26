<?php

namespace mtf\Framework;

/**
 * Description of Pool
 *
 * @author zy
 */
class Pool extends \Jenner\SimpleFork\AbstractPool
{

    /**
     * @var int max process count
     */
    protected $max;

    /**
     * @param int $max
     */
    public function __construct($max = 4)
    {
        $this->max = $max;
    }

    /**
     * 执行进程
     * @param Process $process
     */
    public function execute(Process $process)
    {
        \Jenner\SimpleFork\Utils::checkOverwriteRunMethod(get_class($process));

        if ($this->aliveCount() < $this->max && !$process->isStarted()) {

            if ($process->name() == 0 || $this->aliveCountP($process->name()) == 0) {
                // 随机进程,同名进程为0 
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
                        continue;
                    }
                    if ($process->name() == 0 || $this->aliveCountP($process->name()) == 0) {
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

    /**
     * 统计正在运行的进程,根据进程名字
     * @param int $processesNumber
     * @return int
     */
    public function aliveCountP($processesNumber)
    {
        $count = 0;
        /**
         * @var $process Process
         */
        foreach ($this->processes as $process) {
            if ($process->name() == $processesNumber && $process->isRunning()) {
                $count++;
            }
        }

        return $count;
    }

}
