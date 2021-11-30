<?php


/**
 * Description of ATest
 * 一个测试案例
 *
 * @thread 1 运行于那个线程
 * @author dongasai
 */
class ATest extends \mtf\Framework\TestCase
{

    public function testA()
    {

        $this->assertArrayHasKey('foo', [ 'foo' => 'baz' ]);
        $this->assertClassHasAttribute('foo', ATest1::class);
        $this->assertClassHasStaticAttribute('fsoo', ATest1::class);
        $this->assertContains(4, [ 1, 2, 3, 4 ]);
        $this->assertStringContainsString('foo', 'fooo');
        $this->assertStringContainsStringIgnoringCase('foo', 'Fooo');
        $this->assertContainsOnly('string', [ '1', '2' ]);
        $this->assertContainsOnlyInstancesOf(
            ATest1::class,
            [ new ATest1, new ATest1 ]
        );
        // 数组元素个数
        $this->assertCount(1, [ 'foo' ]);
        // 文件夹
        $this->assertDirectoryExists('/var/www/html');
        // 可读文件夹
        $this->assertDirectoryIsReadable('/var/www/html');
        // 可写入文件夹
        $this->assertDirectoryIsWritable('/var/www/html');
        // empty
        $this->assertEmpty([]);
        // 相同
        $this->assertEquals(1, 1);
        // assertEqualsCanonicalizing  规范的相等
        $this->assertEqualsCanonicalizing([ 3, 2, 1 ], [ 2, 3, 1 ]);
        // 相等，不区分大小写
        $this->assertEqualsIgnoringCase('aaa', 'aaA');
        // 有误差的相等
        $this->assertEqualsWithDelta(10, 9, 2);

        // false
        $this->assertFalse(false);
        // 文件内容相同
        $this->assertFileEquals('/var/www/html/README.md', '/var/www/html/README.md');
        // 文件存在
        $this->assertFileExists('/var/www/html/README.md');
        // INF 判断（无限大）
        $this->assertInfinite(log(0));
        // 实例类型
        $this->assertInstanceOf(ATest1::class,new ATest1());
        // assertIsArray
        $this->assertIsArray([1]);
        // assertIsBool
        $this->assertIsBool(true);
        // assertIsCallable
        $this->assertIsCallable(function(){
            return 1;
        });
        // assertIsFloat
        $this->assertIsFloat(1.2);
        // assertIsInt
        $this->assertIsInt(1);
        foreach (range(1, 4) as $item) {
            self::assertLessThanOrEqual(5, $item);
        }

    }

}


class ATest1
{

    private $foo  = 1;
    static  $fsoo = 2;

}

class ATest2
{

    private $foo  = 1;
    static  $fsoo = 2;

}

