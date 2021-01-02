<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mtf\Action;

/**
 * Description of Test
 *
 * @author dongasai
 */
class Tester extends Action
{

    public function run()
    {
        if (\mtf\Options::$pathCoverage) {
            $this->callAction(codeCoverage::class, [\mtf\Options::$pathCoverage]);
        }
        
        if(\mtf\Options::$dir){
            
        }
    }

    private function callAction($className, $param_arr)
    {
         if (!class_exists($className)) {
            throw new Exception("不存在的 Action 类");
        }
        call_user_func_array([new $className($this->command),'run'], $param_arr);        
    }

}
