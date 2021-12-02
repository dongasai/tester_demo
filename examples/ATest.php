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
        $this->assertInstanceOf(ATest1::class, new ATest1());
        // assertIsArray
        $this->assertIsArray([ 1 ]);
        // assertIsBool
        $this->assertIsBool(true);
        // assertIsCallable
        $this->assertIsCallable(function () {
            return 1;
        });
        // assertIsFloat
        $this->assertIsFloat(1.2);
        // assertIsInt
        $this->assertIsInt(1);
        // assertIsIterable
        $this->assertIsIterable([ 1 ]);
        // assertIsNumeric
        $this->assertIsNumeric(1);
        $this->assertIsNumeric('1');
        // assertIsObject
        $this->assertIsObject(new \mtf\Assert\Type\IsInt(1));
        // assertIsResource
        $fp = fopen("/var/www/html/README.md", "r");

        $this->assertIsResource($fp);
        // assertIsScalar
        $this->assertIsScalar(1);
        // 可读取的
        $this->assertIsReadable('/var/www/html/README.md');
        // 可写入的
        $this->assertIsWritable('/var/www/html/README.md');
        // assertJsonFileEqualsJsonFile
        $this->assertJsonFileEqualsJsonFile('/var/www/html/examples/1.json', '/var/www/html/examples/2.json');
        // json字符串和json文件的数据相同
        $this->assertJsonStringEqualsJsonFile('{  "1": "1"}', '/var/www/html/examples/1.json');
        // assertJsonStringEqualsJsonString
        $this->assertJsonStringEqualsJsonString('{"1": "1"}', '{"1": "1"}');
        // assertLessThan
        $this->assertLessThan(2, 1);
        // assertLessThanOrEqual
        self::assertLessThanOrEqual(5, 5);
        // assertNan
        self::assertNan(acos(8));
        // assertNull
        self::assertNull(null);
        // assertObjectHasAttribute
        self::assertObjectHasAttribute('foo', new ATest1());
        self::assertMatchesRegularExpression('/fo/', 'fooooo');
        $this->assertStringMatchesFormat('%i', '-10');
        $this->assertStringMatchesFormat('张三%d', '张三10');
        $this->assertStringMatchesFormatFile('/var/www/html/examples/FormatFile.txt','张三11');
        $this->assertStringFileMatchesFormat('张三%d','/var/www/html/examples/FormatTxt.txt');
        // 全相等
        $this->assertSame(10,10);
        // 后缀相同
        self::assertStringEndsWith("888","15888");
        // 文件内容
        $this->assertStringEqualsFile('/var/www/html/examples/FormatTxt.txt', '张三10');
        // 前缀相同
        self::assertStringStartsWith('1111',"11115555");
        // assertXmlFileEqualsXmlFile
        self::assertXmlFileEqualsXmlFile('/var/www/html/examples/xml1.xml','/var/www/html/examples/xml2.xml');


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

