<?php

use Symfony\Component\VarDumper\VarDumper;

function dd()
{
    $trace = debug_backtrace();
    $stack = $trace[0];
    $file  = isset($stack['file']) ? $stack['file'] : '';
    $line  = isset($stack['line']) ? $stack['line'] : '';
//    $func = isset($stack['function']) ? $stack['function'] : '';
//         $args = isset($stack['args'])?$stack['args']:'';
    // $class = isset($stack['class'])?$stack['class']:'';
    echo " \n file :$file ; line :$line ";
    foreach (func_get_args() as $v) {
        VarDumper::dump($v);
    }
    exit;
}

function dump()
{

    $trace = debug_backtrace();
    $stack = $trace[0];
    $file  = isset($stack['file']) ? $stack['file'] : '';
    $line  = isset($stack['line']) ? $stack['line'] : '';
//    $func = isset($stack['function']) ? $stack['function'] : '';
//         $args = isset($stack['args'])?$stack['args']:'';
    // $class = isset($stack['class'])?$stack['class']:'';
    echo " \n file :$file ; line :$line ";
    foreach (func_get_args() as $v) {
        VarDumper::dump($v);
    }
}
