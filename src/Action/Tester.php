<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mtf\Action;

use mtf\Assert\Assert;
use mtf\Command;
use mtf\Framework\Cache;
use mtf\Framework\Comment;
use mtf\Framework\Display;
use mtf\Framework\OperationMode;
use mtf\Framework\Pool;
use mtf\Framework\Process;
use mtf\Framework\TestCase;
use mtf\Framework\TestGroup;
use mtf\Framework\TestResult;
use mtf\Framework\TestSuite;
use mtf\Framework\Timeer;
use mtf\Helper;
use mtf\Options;
use PHP_Timer;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use Prophecy\Exception\Doubler\ClassNotFoundException;
use SebastianBergmann\Diff\TimeEfficientImplementationTest;
use TypeExtension\Multiple\CNames;
use TypeExtension\Single\CName;
use TypeExtension\Single\File;

/**
 * Description of Test
 *
 * @author dongasai
 */
class Tester extends Action
{

    private $caseFiles = [
    ];
    /**
     * @var CName[]
     */
    private $caseClasss = [
    ];

    private $fileClassMap = [
    ];

    private $groupCase = [

    ];

    private $testSuites = [

    ];

    public function run()
    {
        PHP_Timer::start();
        if (Options::$pathCoverage) {
            $this->callAction(codeCoverage::class, [
                Options::$pathCoverage ]);
        }

        if (Options::$dir) {
            $dir = Options::$dir;
            // 读取其中的 测试用例
            $this->readDir($dir);
        }

        if (Options::$file) {
            foreach (Options::$file as $file) {
                if (substr($file, -8) === 'Test.php') {
                    $this->caseFiles[] = $file;
                } else {
                    // 错误的文件
                    throw new \Exception("文件$file 不和规范！ ");
                }
            }

        }


        // 加载测试用例
        $Mode = OperationMode::getMode();
        if ($this->caseFiles) {
            foreach ($this->caseFiles as $caseFile) {
                $this->readFile($caseFile);
            }
        }

        switch ($Mode) {
            case OperationMode::ALL:
                // 运行所有的测试用例
                if ($this->caseClasss) {
                    Display::getDi()->dump(Display::LevelDebug, '可测试的用例', $this->caseClasss);
                    $this->runCaseClasss($this->caseClasss);
                }
                break;
            case OperationMode::RUN_Suites:
                // 处理 用例组合 test Suites
                TestSuite::callOptions($this);

                // 运行用例组合
                /**
                 * @var TestSuite $runSuite
                 */
                $runSuite = $this->testSuites[Options::$testSuite] ?? null;

                if ($runSuite) {
                   $time  = new Timeer();
                    // 测试套件开始
                    TestResult::getInstance()->startTestSuite($runSuite);
                    Display::getDi()->dump(Display::LevelDebug, '可测试的用例', $runSuite->getList());
                    $this->runCaseClasss($runSuite->getList());
                    $time->end();
                    // 测试套件结束
                    TestResult::getInstance()->endTestSuite($runSuite,$time);
                }
            case OperationMode::RUN_Groups:
                TestGroup::callOptions($this);
                $runGroup = $this->groupCase[Options::$group] ?? null;

                if ($runGroup) {
                    Display::getDi()->dump(Display::LevelDebug, "分组 {$runGroup->getName()} 可测试的用例", $runGroup->getList());
                    $this->runCaseClasss($runGroup->getList());
                }

        }

        $time = PHP_Timer::stop();
        Command::getWriter()->info("\n \n \n测试用时:" . PHP_Timer::secondsToTimeString(Cache::getRunTime()), true);
        Command::getWriter()->info("运行用时:" . PHP_Timer::secondsToTimeString($time), true);
        Command::getWriter()->info("断言总量:" . Cache::getAssertCount(), true);
    }

    /**
     * 获取测试用例集合
     *
     * @return CName[]
     */
    public function getCaseList()
    {
        return $this->caseClasss;
    }


    /**
     * 运行测试用例
     *
     * @param CName[] $caseClasss
     */
    public function runCaseClasss($caseClasss)
    {
        $threadCase = [];
        foreach ($caseClasss as $CName) {
            $comment                                    = new Comment($CName, 'class');
            $commentOption                              = $comment->parse();
            $thread                                     = $commentOption['thread'][0] ?? 0;
            $threadCase[$thread % Options::$parallel][] = $CName;
        }

        $poll = new Pool(Options::$parallel);
        foreach ($threadCase as $t => $caseS) {
            foreach ($caseS as $case2) {
                $poll->execute(new Process(new \mtf\Framework\CaseRuner($case2), $t));
            }
        }
        $poll->wait(true, 100);
    }


    /**
     * 读取文件
     *
     * @param string $caseFile
     */
    private function readFile($caseFile)
    {
        $nameResolver  = new NameResolver;
        $nodeTraverser = new NodeTraverser;
        $nodeTraverser->addVisitor($nameResolver);
        include_once $caseFile;

        $code   = file_get_contents($caseFile);
        $parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
        try {
            $Stmts = $parser->parse($code);
            $asts  = $nodeTraverser->traverse($Stmts);

            foreach ($asts as $ast) {

                if ($ast instanceof Class_) {
                    $className = $ast->name->toString();

                    if ((new $className) instanceof TestCase) {
                        $this->caseClasss[]              = new CName($className);
                        $this->fileClassMap[$caseFile][] = new CName($className);
                    } else {
                        Display::getDi()->text(Display::LevelDebug, "类 $className 跳过 ");
                    }
                } elseif ($ast instanceof Namespace_) {
                    $namespace                     = $ast->namespacedName;
                    $this->fileClassMap[$caseFile] = [];

                    foreach ($ast->stmts as $ast2) {
                        if ($ast2 instanceof Class_) {
                            $className = $ast2->namespacedName->toString();
                            if ((new $className) instanceof TestCase) {
                                $this->caseClasss[]              = new CName($className);
                                $this->fileClassMap[$caseFile][] = new CName($className);
                            }
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            echo "Parse error: {$ex->getMessage()}\n";
            exit;
        }
    }

    /**
     * 读取文件夹,只选中测试文件 *Test.php
     *
     * @param string $dir
     */
    private function readDir(string $dir)
    {
        if (!is_dir($dir)) {
            throw new \mtf\Excetions\TestDirNotFoundException($dir);
        }

        $handle = opendir($dir);
        if ($handle) {
            while (($fl = readdir($handle)) !== false) {
                $temp = $dir . DIRECTORY_SEPARATOR . $fl;
                if (is_dir($temp) && $fl != '.' && $fl != '..') {
                    $this->readDir($temp);
                } else {
                    if ($fl != '.' && $fl != '..') {
                        // 文件
                        if (substr($fl, -8) === 'Test.php') {
                            $this->caseFiles[] = $temp;
                        }
                    }
                }
            }
        }
    }

    private function callAction($className, $param_arr)
    {
        if (!class_exists($className)) {
            throw new ClassNotFoundException("不存在的 Action 类", $className);
        }
        call_user_func_array([
                                 new $className($this->command),
                                 'run' ], $param_arr);
    }

    /**
     * 增加 用例集合
     *
     * @param TestSuite $suite
     * @return $this
     */
    public function addTestSuite(TestSuite $suite)
    {
        $this->testSuites[$suite->getName()] = $suite;

        return $this;
    }

    /**
     * 增加 用例分组
     *
     * @param TestGroup $suite
     * @return $this
     */
    public function addTestGroup(TestGroup $group)
    {
        $this->groupCase[$group->getName()] = $group;

        return $this;
    }

    /**
     *
     * 用例是否存在
     *
     * @param string $cname
     * @return bool
     */
    public function isExistCase($cname): bool
    {
        foreach ($this->caseClasss as $classs) {
            if ($cname == $classs->getName()) {
                return true;
            }
        }

        return false;
    }
        /**
     *
     * @param File $file
     * @return CNames
     */
    public function getFileCase(File $file): CNames
    {

        $cnams = new \TypeExtension\Multiple\CNames();
        $list  = $this->fileClassMap[$file->getPath()] ?? [];
        if (is_array($list)) {
            foreach ($list as $class) {
                $cnams->add(new CName($class));
            }
        } else {
            $cnams->add(new CName($list));
        }

        return $cnams;
    }


    /**
     * 析构函数
     */
    public function __destruct()
    {

    }

}
