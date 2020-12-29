<?php
include_once 'vendor/autoload.php';

// 代码覆盖率测试

use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;
use SebastianBergmann\CodeCoverage\Report\Clover as CloverReport;
use SebastianBergmann\CodeCoverage\Report\Cobertura as CoberturaReport;
use SebastianBergmann\CodeCoverage\Report\Crap4j as Crap4jReport;
use SebastianBergmann\CodeCoverage\Report\PHP as PHPReport;
use SebastianBergmann\CodeCoverage\Report\Text as TextReport;

$filter = new Filter;
$filter->includeDirectory(__DIR__ . DIRECTORY_SEPARATOR . 'tester');

$coverage = new CodeCoverage(
        (new Selector)->forLineCoverage($filter),
        $filter
);

$coverage->start('aa');

// ...

$coverage->stop();


(new HtmlReport)->process($coverage, __DIR__ . DIRECTORY_SEPARATOR . '.tmp/'. date('Ymd'));
(new CloverReport)->process($coverage, __DIR__ . DIRECTORY_SEPARATOR . '.tmp/'. date('Ymd_1'));
(new CoberturaReport)->process($coverage, __DIR__ . DIRECTORY_SEPARATOR . '.tmp/'. date('Ymd_2'));
(new Crap4jReport)->process($coverage, __DIR__ . DIRECTORY_SEPARATOR . '.tmp/'. date('Ymd_3'));
(new TextReport)->process($coverage, __DIR__ . DIRECTORY_SEPARATOR . '.tmp/'. date('Ymd_4'));
(new PHPReport)->process($coverage, __DIR__ . DIRECTORY_SEPARATOR .  date('Ymd_5').'.php');
