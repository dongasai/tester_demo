<?php

namespace mtf\Framework;

/**
 * Description of Comment
 * 注释解析
 *
 * @author dongasai
 */
class Comment
{

    private $string;
    private $options;

    /**
     * 构造函数
     * @param $name
     * @param $type
     * @throws \ReflectionException
     */
    public function __construct($name, string $type = 'class')
    {
        if ($type === 'class') {
            $r            = new \ReflectionClass($name);
            $this->string = $r->getDocComment();
        }
        if ($type === 'Method') {
            $r            = new \ReflectionMethod($name[0], $name[1]);
            $this->string = $r->getDocComment();
        }
    }

    public function parse(): array
    {
        $s       = $this->string;
        $options = [];
        if (!preg_match('#^/\*\*(.*?)\*/#ms', $s, $content)) {
            return [];
        }
        if (preg_match('#^[ \t\*]*+([^\s@].*)#mi', $content[1], $matches)) {
            $options[0] = trim($matches[1]);
        }
        preg_match_all('#^[ \t\*]*@(\w+)([^\w\r\n].*)?#mi', $content[1], $matches, PREG_SET_ORDER);

        foreach ($matches as $match) {
            $name = $match[1];
            if (isset($options[$name])) {
                if (!is_array($options[$name])) {
                    $options[$name] = [ $options[$name] ];
                }

                $options[$name][] = isset($match[2]) ? trim($match[2]) : '';
            } else {
                $options[$name] = isset($match[2]) ? trim($match[2]) : '';
            }
        }
        $this->options = $options;
        foreach ($options as $k => $v) {
            if (is_string($k)) {
                $method_name = 'parse' . ucfirst($k);

                if (method_exists($this, $method_name)) {
                    $this->$method_name($v);
                } else {

                }
            }
        }

        return $this->options;
    }

    /**
     * 解析small
     */
    private function parseSmall()
    {
        $this->parseAuthor('small');
    }

    /**
     * 解析 medium
     */
    private function parseMedium()
    {
        $this->parseAuthor('medium');
    }

    /**
     * 解析 large
     */
    private function parseLarge()
    {
        $this->parseAuthor('large');
    }

    // large

    /**
     * 解析作者
     * 解析为分组
     *
     * @param string $string
     */
    private function parseAuthor($string)
    {
        $this->parseGroup($string);
        if (is_array($string)) {
            foreach ($string as $item){
                $this->parseAuthor($item);
            }
        }else{
            if (is_array($this->options['author'])) {
                $this->options['author'][] = $string;
            } else {
                $this->options['author'] = [ $string ];
            }
        }
        $this->options['author'] = array_unique($this->options['author']);

    }

    /**
     * 处理前置条件
     *
     * @param $requires
     * @return void
     */
    private function parseRequires($requires)
    {

        // @todo 待完善的功能
    }

    /**
     * 进行分组处理
     *
     * @param $group
     * @return void
     */
    private function parseGroup($group)
    {
        if (is_array($group)) {
            foreach ($group as $item){
                $this->parseGroup($item);
            }
        }else{
            if (is_array($this->options['group'])) {
                $this->options['group'][] = $group;
            } else {
                $this->options['group'] = [ $group ];
            }
        }
        $this->options['group'] = array_unique($this->options['group']);
    }


    /**
     * 解析线程
     *
     * @param string $string
     * @return array
     */
    private function parseThread($string)
    {
        $array                   = explode(' ', $string);
        $this->options['thread'] = array_shift($array);

        return $this;
    }

    /**
     * 获取重复执行次数
     *
     * @return int
     */
    public function getTimes(): int
    {
        return intval($this->options['times'] ?? 1);
    }

    /**
     * 获取数据供给器
     *
     * @return string
     */
    public function getDataProvider(): string
    {
        return $this->options['dataProvider'] ?? '';
    }

    /**
     *
     * @return string
     */
    public function getDepends(): string
    {
        return $this->options['depends'] ?? '';
    }

}
