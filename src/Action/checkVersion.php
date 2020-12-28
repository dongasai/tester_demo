<?php

namespace mtf\Action;

/**
 * Description of checkVersion
 *
 * @author dongasai
 */
class checkVersion extends Action
{

    public function run()
    {
        $write = new \Ahc\Cli\Output\Writer();
        $write->yellow("检查升级,此功能正在实现中...", true);
    }

}
