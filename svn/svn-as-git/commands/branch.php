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

/**
 * @param $args
 * @return int
 */
function svn_branch($args)
{
    $argsCount = count($args);
    if ($argsCount == 0) { return show_branch_list(); }
    else if (($idx = array_search("-d", $args)) !== false) {
        if (!isset($args[$idx + 1])) { return -1; }
        $branch = $args[$idx + 1];
        return remove_branch($branch);
    } else { // create branch
        $new = $args[0];
        $base = isset($args[1]) ? $args[1] : "";
        return create_branch($new, $base);
    }
}

function show_branch_list()
{
    $branchList = SVNInfo::getBranchList();
    print_r($branchList);
    return Error::E_SUCCESS;
}

// 创建新分支: svn branch branchName baseBranchName
function create_branch($new, $base = "")
{
    $branchArray = SVNInfo::getBranchList();
    $rootUrl = SVNInfo::getRootUrl();

    if ($base == "") { $base = SVNInfo::getCurrentBranchName(); }

    if ($base == "trunk") {
        $baseBranchUrl = $rootUrl . $base . DIRECTORY_SEPARATOR . SVNInfo::PROJECT_NAME;
    } else {
        if (in_array($new, $branchArray)) {
            Utils::println("Error: branch {$new} already exists");
            return Error::E_PARAM;
        } else if (!in_array($base, $branchArray)) {
            Utils::println("Error: branch {$base} not exists");
            return Error::E_PARAM;
        }
        $baseBranchUrl = $rootUrl . "branches" . DIRECTORY_SEPARATOR . SVNInfo::PROJECT_NAME . DIRECTORY_SEPARATOR . $base;
    }

    $newBranchUrl = $rootUrl . "branches" . DIRECTORY_SEPARATOR . SVNInfo::PROJECT_NAME . DIRECTORY_SEPARATOR . $new;

    $command = "svn cp " . $baseBranchUrl . " " . $newBranchUrl . " -m ''";
    Utils::exec($command);
}


// 删除分支
function remove_branch($branch)
{
    $branchArray = SVNInfo::getBranchList();
    if ($branch == "trunk") {
        Utils::println("Error: trunk cannot be removed");
        return Error::E_PARAM;
    } else if (!in_array($branch, $branchArray)) {
        Utils::println("Error: branch {$branch} does not exist");
        return Error::E_PARAM;
    } else {
        $command = "svn rm " . SVNInfo::buildBranchUrl($branch) . " -m ''";
        Utils::exec($command);
    }
}

