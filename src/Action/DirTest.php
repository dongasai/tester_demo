<?php

namespace mtf\Action;

/**
 * Description of DirTest
 * 文件夹测试,从文件夹中寻找测试内容
 * @author dongasai
 */
class DirTest
        extends Action
{

    public function run()
    {
        $dir = \mtf\Options::$dir;
        if (is_array($dir)) {
            foreach ($dir as $d) {
                return $this->testRun($d);
            }
        }
        $this->testRun($dir);
    }

    /**
     * 
     * @param type $dir
     */
    private function testRun($dir)
    {
        throw new Exception();
    
    }

}
