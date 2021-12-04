<?php

namespace mtf\Framework;


/**
 * Description of Timeer
 * 计时器，支持多次取结束时间
 *
 * @author dongasai
 */
final class Timeer
{

    /**
     * @var float
     */
    private $startTimes;
    private $endTimes;

    public function __construct()
    {
        $this->start();
    }

    public function start()
    {
        if ($this->startTimes) {
            throw new \mtf\Excetions\Exception("重复初始化计时器");
        }
        $this->startTimes = (float)microtime(true);
    }

    /**
     * 结束计时
     *
     * @return float
     * @throws \Exception
     */
    public function end(): float
    {
        if (empty($this->startTimes)) {
            throw new \Exception(
                '没有开始，请先开始'
            );
        }
        $this->endTimes[] = (float)microtime(true);

        return microtime(true) - $this->startTimes;
    }

    public function getLastTime()
    {
        $last = end($this->endTimes);
        reset($this->endTimes);

        return microtime(true) - $this->startTimes;
    }

}
