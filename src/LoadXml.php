<?php

namespace mtf;

/**
 * 读取内容
 */
class LoadXml
{

    protected $xmlPath;

    public function __construct($path, $PWD)
    {
        if ($path) {
            $xmlPath = $PWD . "/{$path}";
        } else {
            $xmlPath = $PWD . "/mtftest.xml";
        }
        $this->xmlPath = $xmlPath;
    }

    public function load()
    {
        dump($this->xmlPath);
        $dom = simplexml_load_file($this->xmlPath);

        return $this->dom2Array($dom);
    }

    private function dom2Array(\SimpleXMLElement $dom)
    {
//        dump($dom);
        $array2 = get_object_vars($dom);
        $array  = $array2['@attributes'] ?? [];
        foreach ($array2 as $attr => $value) {
            if ($attr === '@attributes') {
                continue;
            }
            if($value instanceof \SimpleXMLElement){
                $array[$attr] = $this->dom2Array($value);
            }else{
                $array[$attr]  =$value;
            }


        }
//        dump($array);

        return $array;
    }

}