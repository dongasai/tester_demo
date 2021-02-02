# 多线程测试框架 Multithreaded testing framework 

## 特色

* 多线程运行(超快的速度)
* 语义化版本(优秀的兼容性)
* 模块化开发(良好的二次开发)
* 长期版本维护(更放心的使用)
* PHP7.x 版本支持(走起)
* PHP8.0 版本支持(飞起)
* 插件式扩展(打造属于你的特色)
* 熟悉的操作方式(类似于流行的测试框架的操作方式)
* 仅限使用实例进行测试(测试类实例)

## 使用的组件
* [adhocore/cli](https://packagist.org/packages/adhocore/cli) 用于进行命令行处理
* [jenner/simple_fork](https://packagist.org/packages/jenner/simple_fork) 进程处理
* [symfony/var-dumper](https://packagist.org/packages/symfony/var-dumper) 优雅的变量输出
* [webmozart/assert]() 优秀的断言工具 
* [phpunit/php-code-coverage](https://github.com/sebastianbergmann/php-code-coverage) 为PHP代码覆盖信息提供收集、处理和呈现功能。

## 灵感来源

* [tester](https://github.com/nette/tester) 简单的多进程测试框架
* [phpunit](https://github.com/sebastianbergmann/phpunit) 流行的测试框架

## 使用说明

### 注解


* `@thread [int $number]`   使用平行线程
    * * Class
    * `$number` 可选参数int类型,使用第几个平行线程,默认为随机选择线程(<u><=0 都是随机线程</u>).超出允许线程数之外将取余,这样可以保证使用同一线程的测试用例位于同一线程(**不同的进程**).
* `@times  int $times `   运行次数
    * * Class 整个测试用例都运行多次
      * Method 这个测试方法运行多次
    * `$times` 该测试的运行次数(要确保该测试可重复运行)
* `@author string $author ` 作者分组
    * `@author` 标注是 `@group` 标注（参见 "`@group`"一节）的别名，允许基于作者对测试进行过滤。
* `@after`  
    * 标注用于指明此方法应当在测试用例类中的每个测试方法运行完成之后调用。
* `@afterClass`
    * 标注用于指明此静态方法应该于测试类中的所有测试方法都运行完成之后调用，用于清理共享基境。

* `@backupGlobals $status`
    *   + Class 优先级高于方法的设置
        + Method 优先遵循类的设置
    * 全局变量的备份与还原操作可以对某个测试用例类中的所有测试彻底禁用
    * `$status` 可以是 `disabled`,`enabled`
* `@before` 
    * 标注用于指明此方法应当在测试用例类中的每个测试方法开始运行之前调用。

* `@beforeClass`
    * 标注用于指明此静态方法应该于测试类中的所有测试方法都运行完成之后调用，用于建立共享基境。
    * 必须 `static`

* `@dataProvider func $func` 
    *   + Method 仅方法可用
    *   `$func` 必须是一个方法名字
    * 数据供给器方法必须声明为 `public`，其返回值要么是一个数组，其每个元素也是数组；要么是一个实现了 `Iterator` 接口的对象，在对它进行迭代时每步产生一个数组。每个数组都是测试数据集的一部分，将以它的内容作为参数来调用测试方法。 
    * [数据供给器介绍](doc/dataProvider.md)
* `@depends func $func`
    *   + Method 仅方法可用
    *   `$func` 必须是一个方法名字
    * 声明依赖并不能影响测试方法的运行顺序,生产者的返回值将作为参数传递给消费者
    * [依赖关系介绍](doc/depends.md)
* `@expectedException Exception $Exception`
    *   + Method 仅方法可用
    * 标注来测试被测代码中是否抛出了异常。
    * `$Exception` 异常类
* `@expectedExceptionCode int $code`
    *   + Method 仅方法可用
    * 将 `@expectedExceptionCode` 标注与 `@expectedException` 联合使用,可以对抛出异常的代码作出断言,这样可以缩小具体异常的范围.
    * `$code` 异常的代码,可用常量
* `$expectedExceptionMessage string $message`
    *   + Method 仅方法可用
    * `@expectedExceptionMessage` 标注的运作方式类似于 `@expectedExceptionCode`,用它可以对异常的错误讯息作出断言.
    * `$message` 异常的错误消息,可用常量
* `@expectedExceptionMessageRegExp string $regExp`
    *   + Method 仅方法可用
    * 预期讯息也可以通过 @expectedExceptionMessageRegExp 标注以正则表达式来指定。当无法用子串来完成对给定讯息的匹配时，这种方式就非常有用了.
    *  + `$regExp` 正则表达式
* `@group string $group `
    * + Class 为这个类定义分组,与方法定义不冲突
      + Method 为这个方法定义分组
    * 测试可以用 @group 标注来标记为属于一个或多个组
    * 测试可以基于组来选择性的执行，使用命令行测试执行器的 `--group `和 `--exclude-group` 选项，或者使用对应的 `XML` 配置文件指令。
    * 可以定义多次,即多个组
* `@large`
    * `@large` 标注是 `@group large` 的别名.
* `@medium`
    * `@medium` 标注是 `@group medium` 的别名.
* `@small`
    * `@small` 标注是 `@group small` 的别名
* `@requires`
    *   + Class 为这个类定义前置条件,与方法定义不冲突
        + Method 为这个方法定义前置条件
    * @requires 标注用于在常规前提条件（例如 PHP 版本或所安装的扩展）不满足时跳过测试。
    * [跳过测试介绍](doc/ship.md)
* ~~`@test`~~ 
    * + Method 声明这个方法为测试方法
    * 除了用 test 作为测试方法名称的前缀外，还可以在方法的文档注释块中用 @test 标注来将其标记为测试方法。
    * > 不推荐使用











