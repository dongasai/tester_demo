<?php

namespace mtf\Framework;

/**
 * Description of Comment
 * 注释解析
 * @author dongasai
 */
class Comment
{

    private $string;

    public function __construct($name, $type)
    {
        if ($type === 'class') {
            $r            = new \ReflectionClass($name);
            $this->string = $r->getDocComment();
        }
    }

    public function parse(): array
    {
        $s = $this->string;
        $options = [];
        if (!preg_match('#^/\*\*(.*?)\*/#ms', $s, $content)) {
            return [];
        }
        if (preg_match('#^[ \t\*]*+([^\s@].*)#mi', $content[1], $matches)) {
            $options[0] = trim($matches[1]);
        }
        preg_match_all('#^[ \t\*]*@(\w+)([^\w\r\n].*)?#mi', $content[1], $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $ref = &$options[strtolower($match[1])];
            if (isset($ref)) {
                $ref = (array) $ref;
                $ref = &$ref[];
            }
            $ref = isset($match[2]) ? trim($match[2]) : '';
        }
        foreach ($options as $k => $v) {
            if (is_string($k)) {
                $method_name = 'parse' . ucfirst($k);
                if(method_exists($this, $method_name)){
                    $options[$k] = $this->$method_name($v);
                }
            }
        }

        return $options;
    }

    /**
     * 解析线程
     * @param string $string
     * @return array
     */
    private function parseThread($string): array
    {
        $array = explode(' ', $string);
        $re    = [array_shift($array)];
        $re[]  = implode(' ', $array);
        return $re;
    }

}
