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

    private $caseFiles  = [
    ];
    private $caseClasss = [
    ];

    public function run()
    {
        if (\mtf\Options::$pathCoverage) {
            $this->callAction(codeCoverage::class, [
                \mtf\Options::$pathCoverage]);
        }

        if (\mtf\Options::$dir) {
            $dir = \mtf\Options::$dir;
            // 读取其中的 测试用例
            $this->readDir($dir);
        }

        if (\mtf\Options::$file) {
            if (substr(\mtf\Options::$file, -8) === 'Test.php') {
                $this->caseFiles[] = \mtf\Options::$file;
            }
        }


        // Resolve names
//        $stmts = $nodeTraverser->traverse($stmts);
        if ($this->caseFiles) {
            // 运行测试用例
            $classOld = get_declared_classes();
            foreach ($this->caseFiles as $caseFile) {
                $this->readFile($caseFile);
            }
        }
        if ($this->caseClasss) {
            \mtf\Command::getWriter()->warn("可测试的用例:", true);
            \mtf\Helper::array2table($this->caseClasss);
            $threadCase = [];
            foreach ($this->caseClasss as $class) {
                $comment                                         = new \mtf\Framework\Comment($class, 'class');
                $commentOption                                   = $comment->parse();
                $thread                                          = $commentOption['thread'][0] ?? 0;
                $threadCase[$thread % \mtf\Options::$parallel][] = $class;
            }

            $poll = new \mtf\Framework\Pool(\mtf\Options::$parallel);
            foreach ($threadCase as $t => $caseS) {
                foreach ($caseS as $caseClass) {
                    $poll->execute(new \mtf\Framework\Process(new \mtf\Framework\CaseRuner($caseClass), $t));
                }
            }
            $poll->wait(true, 1000);
//            dump($poll->getProcesses());
        }
    }

    /**
     * 读取文件
     * @param string $caseFile
     */
    private function readFile($caseFile)
    {
        $nameResolver  = new \PhpParser\NodeVisitor\NameResolver;
        $nodeTraverser = new \PhpParser\NodeTraverser;
        $nodeTraverser->addVisitor($nameResolver);
        include_once $caseFile;

        $code   = file_get_contents($caseFile);
        $parser = (new \PhpParser\ParserFactory())->create(\PhpParser\ParserFactory::PREFER_PHP7);
        try {
            $Stmts = $parser->parse($code);
            $asts = $nodeTraverser->traverse($Stmts);
            foreach ($asts as $ast) {
                if ($ast instanceof \PhpParser\Node\Stmt\Class_) {
                    $className = $ast->name->toString();
                    if ((new $className)instanceof \mtf\Framework\TestCase) {
                        $this->caseClasss[] = $className;
                    }
                } elseif ($ast instanceof \PhpParser\Node\Stmt\Namespace_) {
                    $namespace = $ast->namespacedName;

//                            dump($ast->stmts);
                    foreach ($ast->stmts as $ast2) {
                        if ($ast2 instanceof \PhpParser\Node\Stmt\Class_) {
                            $className = $ast2->namespacedName->toString();
                            if ((new $className) instanceof \mtf\Framework\TestCase) {
                                $this->caseClasss[] = $className;
                            }
                        }
                    }
                }
            }
        } catch (\Exception $ex) {
            echo "Parse error: {$error->getMessage()}\n";
            exit;
        }
    }

    /**
     * 读取文件夹,只选中测试文件 *Test.php
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
            throw new Exception("不存在的 Action 类");
        }
        call_user_func_array([
            new $className($this->command),
            'run'], $param_arr);
    }

}
