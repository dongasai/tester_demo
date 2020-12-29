<?php

namespace mtf;

/**
 * Description of InitCommand
 * 命令行初始化工具
 * @author dongasai
 */
class Command extends \Ahc\Cli\Input\Command
{

    public static $options;
    public static $di;

    public function __construct()
    {
        parent::__construct('mtf', '多线程测试框架 Multithreaded testing framework');
        $this->removeV();
        $version = '0.0.1';
        $this->version($version)
                ->option('-c --configuration', "使用的配置文件")
                ->option('--bootstrap', '引导启动文件');
        $this->argument('[file]', "要运行的测试文件或文件夹");
        $this->usageExample();
        $this->testExecutionOptions();
        $this->coverageOption();
        $this->tool();
        $this->check();
        self::$di = $this;
    }
    
    /**
     * 设置一些工具
     */
    public function tool(){
        $this->option('--check-version', "检查版本你是否最新", 'boolval', false);
        $this->callAction(Action\checkVersion::class,'checkVersion');
    }

    /**
     * 移除默认的 -v -verbosity相关的操作 
     */
    private function removeV(){
       // 我草,竟然还不好解决这个问题, _options 是私有变量,很棒
    }


    /**
     * 进行一系列的检查
     */
    private function check()
    {
        
    }

    /**
     * 设置一个回调动作
     * @param string $actionClass
     * @param string $name
     * @return $this
     * @throws Exception
     */
    public function callAction($actionClass, $name)
    {
        if (!class_exists($actionClass)) {
            throw new Exception("不存在的 Action 类");
        }
        $this->on([new $actionClass($this),'run'], $name);
        return $this;
    }

    /**
     * 使用案例
     */
    private function usageExample()
    {
        $usage = <<<EOT
    mtf [options] UnitTest.php 
    mtf [options] <directory>
EOT;

        $this->usage($usage);
    }
    
    /**
     * 测试选择器相关
     */
    public function testSelectionOptions(){
        $this->option('--filter', '运行测试时使用的筛选器');
        $this->option('--testsuite', '运行测试套件时使用的筛选器');
        $this->option('--group', '只运行来自指定组的测试。使用配置文件进行组配置');
        $this->option('--exclude-group', '排除指定组的测试');
        $this->option('--list-groups','列出可用的测试组。');
        $this->option('--list-suites','列出可用的测试套件');
        $this->option('--test-suffix','仅在指定的文件中搜索test后缀(es)。默认值:Test.php .phpt');
    }


    /**
     * 测试扩展选项
     * 
     */
    private function testExecutionOptions()
    {
        $this->option('--dont-report-useless-tests','不要报告不测试任何东西的测试。');
        $this->option('--stop-on-defect', '在第一次测试未通过的位置停止', 'boolval', false)
                ->option('--stop-on-error', '在第一次出现错误的位置停止', 'boolval', false)
                ->option('--stop-on-failure', '在第一次出现错误或断言失败的位置停止', 'boolval', false)
                ->option('--stop-on-warning', '在第一次警告的位置停止', 'boolval', false)
                ->option('--stop-on-risky', '在第一次遇到有风险的测试时停止', 'boolval', false)
                ->option('--stop-on-skipped', '在第一次遇到测试跳过的位置停止', 'boolval', false)
                ->option('--stop-on-incomplete', '在第一次遇到不完整的测试停止', 'boolval', false)
                ->option('--fail-on-incomplete', '将不完整的测试视为失败', 'boolval', false)
                ->option('--fail-on-risky', '将有风险的测试视为失败', 'boolval', false)
                ->option('--fail-on-skipped', '将跳过的测试视为失败', 'boolval', false)
                ->option('--fail-on-warning', '将警告的测试视为失败', 'boolval', false)
                ->option('--verbose', "输出更详细的测试信息", 'boolval', false)
                ->option('--debug', '输出测试信息', 'boolval', false)
                ->option('--repeat', '重复的运行测试', null, 1);
    }

    /**
     * Coverage参数设置
     */
    private function coverageOption()
    {
        $this->option('--path-coverage', "执行代码覆盖率分析的目录")
                ->option('--coverage-filter', "在代码覆盖率分析中包含文件夹")
                ->option('--coverage-clover','执行代码覆盖率分析clover格式输出结果的位置')
                ->option('--coverage-crap4j','执行代码覆盖率分析 crap4j 格式输出结果的位置')
                ->option('--coverage-html','执行代码覆盖率分析 html 格式输出结果的位置')
                ->option('--coverage-php','执行代码覆盖率分析 php 格式输出结果的位置')
                ->option('--coverage-text','执行代码覆盖率分析 text 格式输出结果的位置')
                ->option('--coverage-xml','执行代码覆盖率分析 xml 格式输出结果的位置');
    }

    /**
     * Parse the argv input.
     *
     * @param array $argv The first item is ignored.
     *
     * @throws \RuntimeException When argument is missing or invalid.
     *
     * @return self
     */
    public function parse(array $argv): \Ahc\Cli\Input\Parser
    {
        $re            = parent::parse($argv);
        self::$options = new Options($this->values(false));
        return $re;
    }
    
    public static function getWriter(): \Ahc\Cli\Output\Writer
    {
        return self::$di->writer();
    }
    

}
