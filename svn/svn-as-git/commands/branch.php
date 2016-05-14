<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/13
 * Time: 17:34
 */
## 1. 创建新分支，基于某个分支创建新分支
## 2. 删除分支
## 3. 显示分支列表

require_once __DIR__ . "../lib/SVNInfo.php";

/**
 * @param $args
 */
function svn_branch($args)
{
    $currentUrl = SVNInfo::getCurrentUrl();

}


// 列出所有分支
// 1. 获取当前分支
//$currentUrl = "svn://10.21.200.52/yuangongbao_YJ001/Source/branches/lib/20160511_chaojijifen_dev";
$currentUrl = "svn://10.21.200.52/yuangongbao_YJ001/Source/trunk/lib/20160511_chaojijifen_dev";
$rootUrl = preg_replace('/(branches|trunk)[\w_:\/.]+$/', "", $currentUrl);

$branchBaseUrl = $rootUrl . "branches" . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR;
print_r($branchBaseUrl . "\n");

// 2. 显示分支列表
system("svn ls " . $branchBaseUrl);




// 创建新分支: svn branch branchName baseBranchName

$branchName = "";
$baseBranchName  = "";
ob_start();
system('svn ls ' . $branchBaseUrl);
$branchArray = explode("\n", trim(ob_get_clean()));

if ($baseBranchName == "trunk") {
    $baseBranchUrl = $rootUrl . $baseBranchName . DIRECTORY_SEPARATOR . "lib";
} else if (in_array($branchName, $branchArray)) {
    // Error 分支已存在
} else if (!in_array($baseBranchName, $branchArray)) {
    // Error 基于的分支不存在
} else {

    $baseBranchUrl = $rootUrl . "branches" . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . $baseBranchName;
    $newBranchUrl = $rootUrl . "branches" . DIRECTORY_SEPARATOR . "lib" . DIRECTORY_SEPARATOR . $branchName;
    ob_start();
    system("svn cp " . $baseBranchUrl . " " . $newBranchUrl, $retval);
    $errMsg = ob_get_clean();
    if ($retval === 0 && $errMsg === "") {
        // 成功
    } else {
        // 错误
    }
}


// 删除分支

if ($branchName == "trunk") {
    // error 不能删除分支
} else if (!in_array($branchName, $branchArray)) {
    // Error 要删除的分支不存在
} else {
    $deletedBranchUrl = SVNInfo::buildBranchUrl($branchName);
    ob_start();
    system("svn rm " . $deletedBranchUrl, $retval);
    $errMsg = ob_get_clean();
    if ($retval === 0 && $errMsg === "") {
        // 成功
    } else {
        // 错误
    }
}
