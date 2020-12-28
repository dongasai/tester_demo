<?php

namespace mtf;

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
        foreach ($array as $k => $v){
            $tarr[]= [
                'key'=>$k,
                'value'=> var_export($v,true)
            ];
        }
        Command::getWriter()->table($tarr);
    }

}
