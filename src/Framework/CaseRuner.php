<?php

namespace mtf\Framework;

/**
 * Description of CaseRuner
 * 测试用例运行
 * @author dongasai
 */
class CaseRuner
{

    private $caseClasss;

    public function __construct($caseClass)
    {
        $this->caseClasss = $caseClass;
    }

    /**
     * 追加测试用例文件
     * @param string $caseFile 测试用例文件
     */
    public function addCaseFile($caseClass)
    {
        $this->caseClasss[] = $caseClass;
        $this->caseClasss   = array_unique($this->caseClass);
        
    }

    /**
     * 运行测试测试用例们 
     */
    public function run()
    {
        \mtf\Command::getWriter()->warn("可测试的用例:", true);
        \mtf\Helper::array2table($this->caseClasss);
        foreach ($this->caseClasss as $class){
            $comment = new Comment($class,'class');
            $commentOption = $comment->parse();
            dump($commentOption);
            
        }
        
    }


}
