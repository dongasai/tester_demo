<?php

include_once "/var/www/html/vendor/autoload.php";

use Tester\Assert;

/**
 * 数字整形的测试
 */
class IntTest extends \Tester\TestCase
{
    public function testA(){

        Assert::equal(1,1);
    }

}