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
        //@todo 只进行了对文件的处理，未进行对类名 的处理
        foreach (Options::$testSuites as $testSuite) {
            $dir   = Path::getDirRealPath(Options::getDir(), $testSuite['dir'] ?? '');
            $name  = $testSuite['name'];
            $Suite = new TestSuite($name, $dir);
            foreach ($testSuite['file'] as $f) {
                if(strpos($f,'.')===false){
                    // 不是文件就是类名
                    if($tester->isExistCase($f)){
                        $Suite->addCase(new CName($f));
                    }
                }else{
                    $file = Path::getRealPath($dir, $f);

                    $cs   = $tester->getFileCase($file);
                    foreach ($cs as $cname) {
                        $Suite->addCase($cname);
                    }
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
        $this->list[] = $class;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return CName[]
     */
    public function getList()
    {
        return $this->list;
    }

    public function getDir(): Dir
    {
        return $this->dir;
    }

}
