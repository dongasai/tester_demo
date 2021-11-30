<?php

namespace mtfI18m;

/**
 * 国际化类
 *
 * @author dongasai
 *
 */
class I18n
{

    private        $lang = '';
    static private $di;

    public function __construct($lang = 'zh-CN')
    {
        $this->lang = $lang;
    }


    /**
     * 单例模式获取
     *
     * @return I18n
     */
    static public function getDi()
    {
        if (!self::$di) {
            self::$di = new I18n();
        }

        return self::$di;
    }


    /**
     * 获取多语言的内容
     * @param string $key 语言Key
     * @param array $p 参数
     * @return string
     */
    static public function t(string $key, array $p = []): string
    {
        return '';
    }

}