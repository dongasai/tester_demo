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
#### Class 可用注解

* `@thread [int $number]`   使用平行线程
    * `$number` 可选参数int类型,使用第几个平行线程,默认为随机选择线程.超出允许线程数之外将取余,这样可以保证使用同一线程的测试用例位于同一线程.
    
> (**<=0 都是随机线程**)
* `@times   int `   运行次数,该测试用例的运行次数(要确保该用例可重复运行)

#### method 可用注解

* `@times   int `  运行次数,该测试用例的运行次数(要确保该用例可重复运行)
