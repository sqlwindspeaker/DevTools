<?php

require_once __DIR__ . "/lib/SVNInfo.php";
require_once __DIR__ . "/lib/Error.php";
require_once __DIR__ . "/lib/Utils.php";

$baseDir = __DIR__;

if ($argc === 1) {   // no sub command name supplied
    exit(Error::E_NO_COMMAND);
} else {
    $subCommand = $argv[1];
    $subCommandFileName = $subCommand. ".php";
    $subCommandAbsPath = $baseDir . DIRECTORY_SEPARATOR . "commands" . DIRECTORY_SEPARATOR . $subCommandFileName;

    if (!is_file($subCommandAbsPath)) { exit(Error::E_NO_COMMAND); }  // 子命令不存在

    require_once $subCommandAbsPath;

    $funcName = "svn_" . $subCommand;
    exit ($funcName(array_slice($argv, 2)));
}



