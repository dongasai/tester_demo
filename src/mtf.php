<?php

//多进程测试框架

include_once 'function.php';

define('START_DIR', $_SERVER['PWD']);
define('START_TIME', time());


foreach (array(__DIR__ . '/../../autoload.php', __DIR__ . '/../vendor/autoload.php',
 __DIR__ . '/vendor/autoload.php') as $file) {
    if (file_exists($file)) {
        define('COMPOSER_AUTOLOAD_FILE', $file);
        require_once $file;
        break;
    }
}
if (!defined('COMPOSER_AUTOLOAD_FILE')) {
    // 未找到 自动加载
    fwrite(
            STDERR,
            'You need to set up the project dependencies using Composer:' . PHP_EOL . PHP_EOL .
            '    composer install' . PHP_EOL . PHP_EOL .
            'You can learn all about Composer on https://getcomposer.org/.' . PHP_EOL
    );
    die(1);
}

$command = new mtf\Command();

$command->parse($_SERVER['argv']);


(new mtf\Action\Tester($command))->run();
