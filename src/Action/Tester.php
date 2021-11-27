<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace mtf\Action;

use mtf\Assert\Assert;
use mtf\Command;
use mtf\Framework\Comment;
use mtf\Framework\OperationMode;
use mtf\Framework\Pool;
use mtf\Framework\Process;
use mtf\Framework\TestCase;
use mtf\Framework\TestSuite;
use mtf\Helper;
use mtf\Options;
use PHP_Timer;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\ParserFactory;
use Prophecy\Exception\Doubler\ClassNotFoundException;
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

    private $caseClasss = [
    ];

    private $fileClassMap = [
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
        foreach (range(1, 100) as $item) {
            echo " 进度 $item % \r";
            sleepms(0.01);
        }
        // 处理 用例组合 test Suites
        TestSuite::callOptions($this);
        dd($this->testSuites);

        // 运行所有的测试用例
        if ($this->caseClasss) {
            Command::getWriter()->warn("可测试的用例:", true);
            Helper::array2table($this->caseClasss);
            $this->runCaseClasss($this->caseClasss);
        }
        $time = PHP_Timer::stop();
        Command::getWriter()->info("测试总用时:" . PHP_Timer::secondsToTimeString($time), true);
        Command::getWriter()->info("断言总数量:" . TestCase::$AssertCount, true);
    }

    /**
     * 运行测试用例
     *
     * @param array $caseClasss
     */
    public function runCaseClasss($caseClasss)
    {
        $threadCase = [];
        foreach ($caseClasss as $class) {
            $comment                                    = new Comment($class, 'class');
            $commentOption                              = $comment->parse();
            $thread                                     = $commentOption['thread'][0] ?? 0;
            $threadCase[$thread % Options::$parallel][] = $class;
        }

        $poll = new Pool(Options::$parallel);
        foreach ($threadCase as $t => $caseS) {
            foreach ($caseS as $caseClass) {
                $poll->execute(new Process(new \mtf\Framework\CaseRuner($caseClass), $t));
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
                        $this->caseClasss[]            = $className;
                        $this->fileClassMap[$caseFile] = $className;
                    }
                } elseif ($ast instanceof Namespace_) {
                    $namespace                     = $ast->namespacedName;
                    $this->fileClassMap[$caseFile] = [];

//                            dump($ast->stmts);
                    foreach ($ast->stmts as $ast2) {
                        if ($ast2 instanceof Class_) {
                            $className = $ast2->namespacedName->toString();
                            if ((new $className) instanceof TestCase) {
                                $this->caseClasss[]              = $className;
                                $this->fileClassMap[$caseFile][] = $className;
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
     * @param TestSuite $suite
     * @return $this
     */
    public function addTestSuite(TestSuite $suite)
    {
        $this->testSuites[$suite->getName()] = $suite;

        return $this;
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

}
