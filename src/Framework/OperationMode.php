<?php

namespace mtf\Framework;

use mtf\Options;

/**
 * 运行模式
 *
 */
class OperationMode
{

    /**
     * 运行所有已经找到的测试用例
     */
    const ALL = 0;

    /**
     * 运行文件
     */
    const RUN_Files = 1;

    /**
     * 运行示例集合
     */
    const RUN_Suites = 2;

    /**
     * 运行指定分组
     */
    const RUN_Groups = 3;

    /**
     * 运行 指定标签
     */
    const RUN_Tags = 4;

    static public function getMode()
    {
        if(Options::$file){
           return self::RUN_Files;
        }
        if(Options::$testSuite){
            return self::RUN_Suites;
        }
        if(Options::$group){
            return self::RUN_Groups;
        }
        return 1;
    }

}