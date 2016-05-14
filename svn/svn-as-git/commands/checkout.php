<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/13
 * Time: 17:35
 */
## 1. 切换分支(检查当前工作目录是否干净）
## 2. 放弃文件的修改或使用某一个版本的文件

/**
 * @param $args
 */
function svn_checkout($args)
{
    $arg = "";

    // 1. 判断是不是路径:
    if (!preg_match($arg, '/(\/|\.)/')) { // not contains '/' and '.', regards as branch name
        _checkout_to_branch($arg);
    } else { // regards as file
        $path = "./" . $arg;
        if (is_dir($path)) {
            system("/usr/bin/svn revert -R " . $path);
        } else {
            system("/usr/bin/svn revert " . $path);
        }
    }
}


function _checkout_to_branch($branchName)
{
    ob_start();
    system("/usr/bin/svn status");
    $result = ob_get_clean();

    if (!$result) { // 工作目录干净, 可以切分支
        $branchUrl = SVNInfo::buildBranchUrl($branchName);
        system("/usr/bin/svn switch " . $branchUrl);
    }
}



function _checkout_files($path, $revision)
{}

