<?php

namespace mtf\Framework;

use mtf\Options;

class Display
{

    static $di;
    const LevelDebug = 'debug';
    const LevelInfo = 'info';
    const LevelWarn = 'warn';
    /**
     * 获取展示实例
     *
     * @return \mtf\Display\View
     */
    static public function getDi()
    {
        if (!self::$di) {
            self::init();
        }

        return self::$di;
    }

    static public function init()
    {
        self::$di = new Options::$display(Options::$i18n);
    }

}