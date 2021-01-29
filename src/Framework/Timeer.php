<?php

namespace mtf\Framework;

use SebastianBergmann\Timer\Duration;

/**
 * Description of Timeer
 * 计时器，支持多次取结束时间
 * @author dongasai
 */
final class Timeer
{

    /**
     * @var float
     */
    private $startTimes;

    public function start(): void
    {
        if ($this->startTimes) {
            throw new \mtf\Excetions\Exception("重复初始化计时器");
        }
        $this->startTimes = (float) hrtime(true);
    }

    /**
     * @throws NoActiveTimerException
     */
    public function end(): Duration
    {
        if (empty($this->startTimes)) {
            throw new \SebastianBergmann\Timer\NoActiveTimerException(
                    'Timer::start() has to be called before Timer::stop()'
            );
        }

        return Duration::fromNanoseconds((float) hrtime(true) - $this->startTimes);
    }

}
