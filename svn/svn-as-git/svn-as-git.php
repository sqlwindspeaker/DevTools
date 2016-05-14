<?php

$baseDir = __DIR__;

$argList = $argv;
$argCnts = $argc;

if ($argCnts === 0) {   // no arguments for script
    exit(1);
} else {
    if (preg_match('/svn-as-git\.php$/', $argv[0])) { // 使用 php svn-as-git.php 的方式调用, 第一个参数脚本名称
        array_shift($argv);
        $argc -= 1;
        if ($argc === 0) { exit(1); }   // no arguments for script
    }

    $subCommand = $argv[0];
    array_shift($argv);
    $subCommandFileName = $subCommand. ".php";
    $subCommandAbsPath = $baseDir . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . $subCommandFileName;

    if (!is_file($subCommandAbsPath)) { exit(1); }  // 子命令不存在

    require_once $subCommandAbsPath;

    $funcName = "svn_" . $subCommand;
    exit ($funcName($argv));
}



