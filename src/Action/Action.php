<?php

namespace mtf\Action;

/**
 * Description of Action
 *
 * @author dongasai
 */
abstract class Action implements interfaceAction
{
   
    /**
     * 命令行对象托管
     * @var \mtf\Command 
     */
    protected $command;

    public function __construct(\mtf\Command $command)
    {
        $this->command = $command;
    }
}
