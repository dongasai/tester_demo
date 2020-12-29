<?php

namespace mtf;

/**
 * Description of Options
 * 配置项
 * @author dongasai
 */
class Options
{

    private static $type = [
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
        'debug'          => 'bool',
        'repeat'         => 'int',
        'pathCoverage'   => 'dir',
        'coverageFilter' => 'dir'
    ];
    public static $file; // 要测试的文件
    public static $dir; // 要测试的文件夹
    public static $bootstrap;
    public static $configuration; // 配置文件夹
    public static $checkVersion; // 是否检查升级
    public static $stopOnDefect; //
    public static $stopOnError;
    public static $stopOnWarning;
    public static $stopOnRisky;
    public static $stopOnSkipped;
    public static $failOnWarning;
    public static $verbose;
    public static $debug;
    public static $repeat;
    public static $pathCoverage;
    public static $coverageFilter;

    public function __construct($value)
    {
        if ($value['debug']) {
            Command::getWriter()->info("原始参数:", true);
            Helper::array2table($value);
        }
        if (!empty($value['file'])) {
            $real = START_DIR . DIRECTORY_SEPARATOR . $value['file'];
            if (is_file($real)) {
                self::$file = $real;
            }
            if (is_dir($real)) {

                self::$dir = $real;
            }
        }
        unset($value['file']);
        foreach (self::$type as $key => $type) {
            $func       = 'validate' . ucwords($type);
            self::$$key = $this->$func($value[$key], $key);
        }
        $this->applyDefault();
        if (self::$debug) {
            Command::getWriter()->warn("处理后参数:", true);
            Helper::array2table(self::getAllOption());
        }
    }

    /**
     * 获取所有的配置信息
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
        $configFile = START_DIR . 'mtf.php';
        if (empty(self::$configuration) && is_file($configFile)) {
            self::$configuration = $configFile;
        }
    }

    /**
     * 验证是是否为文件
     * @param string $file
     * @param string $key
     * @return string
     * @throws Exception
     */
    public function validateFile($file, $key)
    {
        if (empty($file)) {
            return $file;
        }
        $real = START_DIR . DIRECTORY_SEPARATOR . $file;
        if (!is_file($real)) {
            throw new \Exception("配置 $key 不是文件");
        }
        return $real;
    }

    /**
     * 验证是否为文件夹
     * @param string $dir
     * @param string $key
     * @throws Exception
     */
    public function validateDir($dir, $key)
    {
        if (empty($dir)) {
            return $dir;
        }
        $realDir = START_DIR . DIRECTORY_SEPARATOR . $dir;
        if (!is_dir($realDir)) {
            throw new \Exception("配置 $key 不是文件夹");
        }
        return $realDir;
    }

    /**
     * 转换为bool类型
     * @param bool $value
     * @return type
     */
    public function validateBool($value)
    {
        if (is_bool($value)) {
            return $value;
        }
        return (bool) $value;
    }

    /**
     * 转换为int类型
     * @param bool $value
     * @return type
     */
    public function validateInt($value, $key)
    {
        if (is_numeric($value)) {
            return (int) $value;
        }
        throw new Exception("配置项 $key 不是数字类型");
    }

}
