<?php

namespace mtf\Framework;

use mtf\Options;
use mtf\Util\Path;
use TypeExtension\Single\CName;
use TypeExtension\Single\Dir;
use TypeExtension\Single\File;

/**
 * 分组测试
 * @author dongasai
 *
 */
class TestGroup
{

    private $name = '';
    private $list = [];

    /**
     * 构造函数，设置名字和文件夹
     *
     * @param string $name
     * @param string
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * 处理配置项
     *
     * @param \mtf\Action\Tester $tester
     */
    static public function callOptions(\mtf\Action\Tester $tester)
    {
        $list = [];
        foreach ($tester->getCaseList() as $CName) {
            $comment                                    = new Comment($CName->getName(), 'class');
            $commentOption                              = $comment->parse();
            $groups = $commentOption['group']??[];
            foreach ($groups as $group){
                if(!isset($list[$group])){
                    $list[$group] = new TestGroup($group);
                }
                $list[$group]->addCase($CName);
            }
        }

        foreach ($list as $value){
            $tester->addTestGroup($value);
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




}
