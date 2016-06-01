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
 * @return int
 */
function svn_checkout($args)
{
    if (count($args) == 0) { $param = "./"; }
    else { $param = $args[0]; }

    // 1. 判断是不是路径:
    if (strpos($param, "/") === false && strpos($param, ".") === false) { // not contains '/' and '.', regards as branch name
        return _checkout_to_branch($param);
    } else { // regards as file
        if (strpos($param, "./") !== 0) {  // not starts with ./
            $path = "./" . $param;
        } else {
            $path = $param;
        }
        return _checkout_files($path);
    }
}


function _checkout_to_branch($branchName)
{
    if ($branchName != "trunk") {
        $branchList = SVNInfo::getBranchList();
        if (!in_array($branchName, $branchList)) {
            Utils::println("Error: branch {$branchName} not exists");
            return Error::E_PARAM;
        }
    }

    ob_start();
    system("/usr/bin/svn status");
    $result = ob_get_clean();

    if ($result == "") { // 工作目录干净, 可以切分支
        $command = "/usr/bin/svn switch " . SVNInfo::buildBranchUrl($branchName);
        return Utils::exec($command);
    } else {
        Utils::println("working dir not clean, switch branch failed");
        Utils::println("svn outputs: \n");
        Utils::println($result, false);

        return Error::E_SUCCESS;
    }
}

function _checkout_files($path, $revision = "")
{
    if (is_dir($path)) {
        return Utils::exec("/usr/bin/svn revert -R " . $path);
    } else {
        return Utils::exec("/usr/bin/svn revert " . $path);
    }
}

