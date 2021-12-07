<?php

namespace mtf\Display;

use mtf\Command;
use mtf\Framework\Display;
use Symfony\Component\VarDumper\VarDumper;

class View
{

    public $i18n;

    public function __construct($i18n)
    {
        $this->i18n = $i18n;
    }

    /**
     * 输出变量
     *
     * @param string $level
     * @param string $text
     * @param $value
     */
    public function dump($level, $text, $value)
    {
        if ($level == Display::LevelDebug) {
            Command::getWriter()->white($text, true);
        } else {
            Command::getWriter()->$level($text, true);
        }

        VarDumper::dump($value);
    }

    /**
     * 输出文字
     *
     * @param $level
     * @param $text
     */
    public function text($level, $text)
    {
        if ($level == Display::LevelDebug) {
            Command::getWriter()->white($text, true);
        } else {
            Command::getWriter()->$level($text, true);
        }
    }

    /**
     * 输出debug级别的文本信息
     * @param string $text
     * @return void
     */
    public function textDebug(string $text)
    {
        $this->text(Display::LevelDebug, $text);
    }

}