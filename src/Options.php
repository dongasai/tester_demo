<?php

namespace mtf;

use TypeExtension\Single\Dir;

/**
 * Description of Options
 * 配置项
 *
 * @author dongasai
 */
class Options
{

    private static $type = [
        'tmp'            => 'dir',
        'dir'            => 'dir',
        'configuration'  => 'file',
        'bootstrap'      => 'file',
        'checkVersion'   => 'bool',
        'stopOnDefect'   => 'bool',
        'stopOnFailure'  => 'bool',
        'stopOnError'    => 'bool',
        'stopOnWarning'  => 'bool',
        'stopOnRisky'    => 'bool',
        'stopOnSkipped'  => 'bool',
        'failOnWarning'  => 'bool',
        'verbose'        => 'bool',
        'parallel'       => 'int',
        'debug'          => 'bool',
        'repeat'         => 'int',
        'pathCoverage'   => 'dir',
        'coverageFilter' => 'dir',
        'coverageClover' => 'dir',
        'coverageCrap4j' => 'dir',
        'coverageHtml'   => 'dir',
        'coveragePhp'    => 'dir',
        'coverageText'   => 'dir',
        'coverageXml'    => 'dir',
        'xmlPath'        => 'file',
        'testSuites'     => 'array',
        'testSuite'      => 'string',
        'group'          => 'string',
        'display'        => 'Display'
    ];
    public static  $i18n = 'zh-CN';
    /**
     * @var array 要测试的文件
     */
    public static $file;
    /**
     * @var string 要测试的文件夹
     */
    public static $dir;
    /**
     * @var string 启动文件
     */
    public static $bootstrap;
    /**
     * @var string 配置文件(夹)
     */
    public static $configuration;
    /**
     * @var bool 是否检查升级
     */
    public static $checkVersion; //
    /**
     * @var bool 产生 Defect （缺陷）即停止
     */
    public static $stopOnDefect;
    /**
     * @var bool 产生失败即停止
     */
    public static $stopOnFailure;
    /**
     * @var bool 产生错误即停止
     */
    public static $stopOnError;
    /**
     * @var bool 产生警告即停止
     */
    public static $stopOnWarning;
    /**
     * @var bool 产生Risky（风险跳过）即停止
     */
    public static $stopOnRisky;
    /**
     * @var bool 产生跳过即停止
     */
    public static $stopOnSkipped;
    /**
     * @var bool 产生警告即升级为错误
     */
    public static $failOnWarning;
    public static $verbose;
    /**
     * @var bool 开启调试模式
     */
    public static $debug;
    /**
     * @var int 重复运行测试
     */
    public static $repeat;
    public static $pathCoverage;
    public static $coverageFilter;
    public static $coverageClover; //覆盖率测试输出目录 Clover 格式
    public static $coverageCrap4j; // 
    public static $coverageHtml; // 
    public static $coveragePhp; //
    public static $coverageText; //
    public static $coverageXml;

    /**
     * @var array 要运行的分组
     */
    public static $group;
    /**
     * @var string 临时文件目
     */
    public static $tmp;
    /**
     * @var int 同时运行多个平行的测试任务
     */
    public static $parallel;
    /**
     * @var string 配置文件的路径
     */
    public static $xmlPath;

    /**
     * @var array 测试集合
     */
    public static $testSuites;
    /**
     * @var string 运行的测试集合
     */
    public static $testSuite;

    /**
     * 展示层
     *
     * @var string $display
     */
    public static $display = '';

    public function __construct($value)
    {
        $oldValue = $value;

        // 读取xml 配置项 configuration
        $loadXml          = new LoadXml(self::$configuration, $_SERVER['PWD']);
        $xmlData          = $loadXml->load();
        $value['xmlPath'] = $loadXml->xmlPath;
        $xmlOption        = new XmlOption($xmlData);
        $value            = $xmlOption->applyOption($value);

        if (!empty($value['file'])) {
            $real = START_DIR . DIRECTORY_SEPARATOR . $value['file'];
            if (is_file($real)) {
                self::$file[] = $real;
            }
            if (is_dir($real)) {

                self::$dir = $real;
            }
        }
        unset($value['file']);
        foreach (self::$type as $key => $type) {
            $func       = 'validate' . ucwords($type);
            $item       = $value[$key] ?? $value[strtolower($key)];
            self::$$key = $this->$func($item, $key);
        }

        $this->applyDefault();
        //
        if (self::$debug) {
            \mtf\Framework\Display::getDi()->text(\mtf\Framework\Display::LevelWarn, '当前已经开启调试模式，将展示更多的输出信息！');
        }
        if (self::$debug) {
            \mtf\Framework\Display::getDi()->dump(
                \mtf\Framework\Display::LevelDebug,
                '输入的参数',
                $oldValue
            );
        }

        if (self::$debug) {
            \mtf\Framework\Display::getDi()->dump(
                \mtf\Framework\Display::LevelDebug,
                'XML读取的参数',
                $xmlOption->config
            );
        }


        if (self::$debug) {
            \mtf\Framework\Display::getDi()->dump(
                \mtf\Framework\Display::LevelInfo,
                '处理后参数',
                self::getAllOption()
            );

        }
    }

    /**
     * 获取所有的配置信息
     *
     * @return array
     */
    public static function getAllOption(): array
    {
        $arr = [
            'file' => self::$file,
            'dir'  => self::$dir
        ];
        foreach (self::$type as $key => $type) {
            $arr[$key] = self::$$key;
        }

        return $arr;
    }

    /**
     * 应用默认值
     */
    private function applyDefault()
    {
        if (empty(self::$file) && empty(self::$dir)) {
            self::$dir = START_DIR;
        }
        $configFile = START_DIR . DIRECTORY_SEPARATOR . 'mtf.php';
        if (empty(self::$configuration) && is_file($configFile)) {
            self::$configuration = $configFile;
        }
        if (empty(self::$tmp)) {
            self::$tmp = START_DIR . DIRECTORY_SEPARATOR . '.tmp';
        }
        if (empty(self::$display)) {
            self::$display = \mtf\Display\View::class;
        }
    }


    /**
     * 验证是是否为文件
     *
     * @param string $file
     * @param string $key
     * @return string
     * @throws \Exception
     */
    public function validateFile($file, $key)
    {
        if (empty($file)) {
            return $file;
        }
        if (substr($file, 0, 1) == DIRECTORY_SEPARATOR) {
            $real = $file;
        } else {
            $real = START_DIR . DIRECTORY_SEPARATOR . $file;
        }

        if (!is_file($real)) {
            throw new \Exception("配置 $key 不是文件 $real ");
        }

        return $real;
    }

    /**
     * 验证是否为数组，并过滤
     *
     * @param $array
     * @param string $key
     * @return array
     */
    public function validateArray($array, $key)
    {
        if (empty($array)) {
            return [];
        }
        if (is_array($array)) {
            return $array;
        }

        return [];
    }

    /**
     * 验证是否为数组，并过滤
     *
     * @param $array
     * @param string $string
     * @return array
     */
    public function validateString($string, $key)
    {
        if (empty($string)) {
            return '';
        }
        if (is_string($string)) {
            return $string;
        } else {
            throw new \Exception("配置 $key 不是字符串");
        }

        return '';
    }

    /**
     * 验证是否为文件夹
     *
     * @param string $dir
     * @param string $key
     * @throws \Exception
     */
    public function validateDir($dir, $key)
    {
        if (empty($dir)) {
            return $dir;
        }
        if (substr($dir, 0, 1) == DIRECTORY_SEPARATOR) {
            $realDir = $dir;
        } else {
            $realDir = START_DIR . DIRECTORY_SEPARATOR . $dir;
        }

        if (!is_dir($realDir)) {
            throw new \Exception("配置 $key 不是文件夹");
        }

        return $realDir;
    }

    /**
     * 转换为bool类型
     *
     * @param bool $value
     * @return bool
     */
    public function validateBool($value)
    {
        if (is_bool($value)) {
            return $value;
        }
        if ($value == 'true' || $value == 'TRUE') {
            return true;
        }
        if ($value == 'false' || $value == 'FALSE') {
            return false;
        }

        return (bool)$value;
    }

    /**
     * 转换为int类型
     *
     * @param bool $value
     * @return int
     */
    public function validateInt($value, $key)
    {
        if (is_numeric($value)) {
            return (int)$value;
        }
        throw new \Exception("配置项 $key 不是数字类型");
    }

    /**
     * 是否为展示层
     *
     * @param $value
     * @param $key
     */
    public function validateDisplay($value, $key)
    {
        if (class_exists($value)) {
            return $value;
        }

        return null;
    }

    /**
     * 获取文件夹位置
     *
     * @return Dir
     * @throws \Exception
     */
    static public function getDir(): Dir
    {
        return new Dir(self::$dir);
    }

}
