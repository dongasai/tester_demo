<?php

namespace mtf\Framework;

use mtf\Options;
use mtf\Util\Path;
use TypeExtension\Single\CName;
use TypeExtension\Single\Dir;
use TypeExtension\Single\File;

/**
 * Description of TestSuite
 * 测试套件
 *
 * @author Administrator
 */
class TestSuite
{

    private $name = '';
    private $list = [];
    private $dir  = '';

    /**
     * 构造函数，设置名字和文件夹
     *
     * @param string $name
     * @param string
     */
    public function __construct(string $name, Dir $dir)
    {
        $this->name = $name;
        $this->dir  = $dir;
    }

    /**
     * 处理配置项
     *
     * @param \mtf\Action\Tester $tester
     */
    static public function callOptions(\mtf\Action\Tester $tester)
    {
        foreach (Options::$testSuites as $testSuite) {
            $dir   = Path::getDirRealPath(Options::getDir(), $testSuite['dir'] ?? '');
            $name  = $testSuite['name'];
            $Suite = new TestSuite($name, $dir);
            foreach ($testSuite['file'] as $f) {
                $file = Path::getRealPath($dir, $f);
                $cs   = $tester->getFileCase($file);
                foreach ($cs as $cname) {
                    $Suite->addCase($cname);
                }
            }
            $tester->addTestSuite($Suite);
        }
    }

    /**
     * 增加测试用例
     *
     * @param $class
     */
    public function addCase(CName $class)
    {
        $this->list[] = $class->getName();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getList()
    {
        return $this->list;
    }

    public function getDir(): Dir
    {
        return $this->dir;
    }

}
