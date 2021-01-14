<?php

namespace ter;

use Tester\Assert as AssertEr;

/**
 * Description of Assert
 *
 * @author Administrator
 */
class Assert
{

    /**
     * 大于判断 $actual >  $expected
     * @param type $expected
     * @param type $actual
     * @param type $description
     */
    public static function gt($expected, $actual, $description = null)
    {
        AssertEr::$counter++;
        if ($actual <= $expected) {
            AssertEr::fail(AssertEr::describe('%1 should be %2', $description), $actual, $expected);
        }
    }

    /**
     * 大于等于
     * @param type $expected
     * @param type $actual
     * @param type $description
     */
    public static function gte($expected, $actual, $description = null)
    {
        AssertEr::$counter++;
        if ($actual < $expected) {
            AssertEr::fail(AssertEr::describe('%1 should be %2', $description), $actual, $expected);
        }
    }

}
