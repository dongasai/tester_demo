<?php

namespace mtf\Util;

/**
 * Description of Helper
 *
 * @author zy
 */
class Helper
{

    public static function array2table($array)
    {
        $tarr = [];
        foreach ($array as $k => $v) {
            if (self::isArrayIndex($v)) {
                $tarr[] = [
                    'key'   => $k ,
                    'value' => ''
                ];
                foreach ($v as $index => $v2) {
                    $tarr[] = [
                        'key'   =>  "   $index",
                        'value' => $v2
                    ];
                }
                $tarr[] = [
                    'key'   => '' ,
                    'value' => ''
                ];
            } else {
                $tarr[] = [
                    'key'   => $k,
                    'value' => var_export($v, true)
                ];
            }

        }
        Command::getWriter()->table($tarr);
    }

    /**
     * 是否为索引数组
     *
     * @param $array
     * @return bool
     */
    public function isArrayIndex($array)
    {

        if (is_array($array)) {
            return array_keys($array) === range(0, count($array) - 1);
        }

        return false;
    }

}
