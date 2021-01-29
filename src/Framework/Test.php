<?php

namespace mtf\Framework;

/**
 * Description of Test
 * 测试描述
 * @author dongasai
 */
class Test
{

    private $case;
    private $func;
    /**
     *
     * @var Timeer 
     */
    private $time;

    public function __construct($case, $func)
    {
        $this->case  = $case;
        $this->func  = $func;
        $this->time = new Timeer();
        $this->time->start();
    }

    public function run()
    {
        
    }

    public function getRunTimes()
    {
        return $this->time->end();
    }

}
