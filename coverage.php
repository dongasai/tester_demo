<?php
include_once 'vendor/autoload.php';

// 代码覆盖率测试

use SebastianBergmann\CodeCoverage\Filter;
use SebastianBergmann\CodeCoverage\Driver\Selector;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use SebastianBergmann\CodeCoverage\Report\Html\Facade as HtmlReport;

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
