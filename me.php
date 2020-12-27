<?php
//多进程测试框架

include_once 'vendor/autoload.php';


$command = new \Ahc\Cli\Input\Command('mtf', '多线程测试框架 Multithreaded testing framework');

$command
    ->version('0.0.1-dev')
    // Arguments are separated by space
    // Format: `<name>` for required, `[name]` for optional
    //  `[name:default]` for default value, `[name...]` for variadic (last argument)
    ->arguments('<dir> [dirs...]')
    // `-h --help`, `-V --version`, `-v --verbosity` options are already added by default.
    // Format: `<name>` for required, `[name]` for optional
    ->option('-s --with-subdir', 'Also delete subdirs (`with` means false by default)')
    ->option('-e,--no-empty', 'Delete empty (`no` means true by default)')
    // Specify santitizer/callback as 3rd param, default value as 4th param
    ->option('-d|--depth [nestlevel]', 'How deep to process subdirs', 'intval', 5)
    ->parse($_SERVER['argv']) // ``
;

// Print all values:


/*Array
(
    [help] =>
    [version] => 0.0.1
    [verbosity] => 3
    [dir] => dir
    [dirs] => Array
        (
            [0] => dir1
            [1] => dir2
        )

    [subdir] => true
    [empty] => false
    [depth] => 5
)*/

// To get values for options except the default ones (help, version, verbosity)



// Pick a value by name
$command->dir;   // dir
$command->dirs;  // [dir1, dir2]
$command->depth; // 5
