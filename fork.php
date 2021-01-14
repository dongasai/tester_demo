<?php
// fork 进程的测试

include_once 'vendor/autoload.php';

class TestRunnable implements \Jenner\SimpleFork\Runnable
{

    /**
     * @return mixed
     */
    public function run()
    {
        dump(time());
        sleep(1);
        echo getmypid() . ':done' . PHP_EOL;
         dump(time());
    }
}
class JobRunner
        extends \Jenner\SimpleFork\Process
{

    function __construct($job)
    {
        parent::__construct($job);
    }
   

}

$pool = new \Jenner\SimpleFork\FixedPool(4);
$pool->execute(new JobRunner(new TestRunnable()));
$pool->execute(new JobRunner(new TestRunnable()));
$pool->execute(new JobRunner(new TestRunnable()));

$pool->wait();
dump(time());