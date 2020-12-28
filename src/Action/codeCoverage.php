<?php

namespace mtf\Action;

use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\CodeCoverage as SCodeCoverage;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;

/**
 * codeCoverage
 * 代码覆盖率分析
 * @author dongasai
 */
class codeCoverage extends Action
{

    public function run()
    {
        $pathCoverage = \mtf\Options::$pathCoverage;
        if (empty($pathCoverage) || !is_dir($pathCoverage)) {
            throw new \Exception("代码覆盖率测试失败,需要测试的文件夹不是有效的文件夹: $dir ");
        }

        $filter = new Filter;
        $filter->includeDirectory($pathCoverage);

        $coverage = new SCodeCoverage(
                (new Selector)->forLineCoverage($filter),
                                                $filter
        );

        $coverage->start('codeCoverage');

        $coverage->stop();
        (new HtmlReport)->process($coverage, START_DIR . DIRECTORY_SEPARATOR . 'codeCoverage.html');
    }

}
