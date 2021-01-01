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
class codeCoverage
        extends Action
{

    public function run()
    {
        $pathCoverage = \mtf\Options::$pathCoverage;
        if (empty($pathCoverage) || !is_dir($pathCoverage)) {
            throw new \Exception("代码覆盖率测试失败,需要测试的文件夹不是有效的文件夹: $pathCoverage ");
        }
        
        $filter = new Filter;
        if(\mtf\Options::$coverageFilter){
            $filter->includeDirectory($pathCoverage);
        }
        

        $coverage = new SCodeCoverage(
                (new Selector)->forLineCoverage($filter),
                $filter
        );

        $coverage->start('codeCoverage');

        $coverage->stop();
        if ($this->isDefault()) {
            if (\mtf\Options::$coverageClover) {
                (new \SebastianBergmann\CodeCoverage\Report\Clover())->process($coverage, \mtf\Options::$coverageClover, 'tester');
            }

            if (\mtf\Options::$coverageCrap4j) {
                (new \SebastianBergmann\CodeCoverage\Report\Crap4j())->process($coverage, \mtf\Options::$coverageCrap4j, 'tester');
            }

            if (\mtf\Options::$coverageHtml) {
                (new \HtmlReport())->process($coverage, \mtf\Options::$coverageHtml, 'tester');
            }

            if (\mtf\Options::$coveragePhp) {
                (new \SebastianBergmann\CodeCoverage\Report\PHP())->process($coverage, \mtf\Options::$coveragePhp, 'tester');
            }

            if (\mtf\Options::$coverageText) {
                (new \SebastianBergmann\CodeCoverage\Report\Text())->process($coverage, \mtf\Options::$coverageText, 'tester');
            }
            if (\mtf\Options::$coverageXml) {
                (new \SebastianBergmann\CodeCoverage\Report\Xml())->process($coverage, \mtf\Options::$coverageXml, 'tester');
            }
        } else {
            (new HtmlReport)->process($coverage, \mtf\Options::$tmp, 'tester');
        }
    }

    /**
     * 判断是否使用默认的结果驱动
     */
    private function isDefault()
    {
        return (empty(\mtf\Options::$coverageClover) && empty(\mtf\Options::$coverageCrap4j) && empty(\mtf\Options::$coverageHtml) && empty(\mtf\Options::$coveragePhp) && empty(\mtf\Options::$coverageText) && empty(\mtf\Options::$coverageXml));
    }

}
