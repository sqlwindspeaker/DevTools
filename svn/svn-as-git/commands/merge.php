<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/13
 * Time: 17:35
 */
## 1. 合并分支
function svn_merge($args)
{
    if (count($args) == 0) {
        Utils::println("Error: no branch name supplied");
        return Error::E_PARAM;
    } else {
        $branch = $args[0];
        if ($branch != "trunk") {
            $branchList = SVNInfo::getBranchList();
            if (!in_array($branch, $branchList)) {
                Utils::println("Error: branch {$branch} does not exists");
                return Error::E_PARAM;
            }
        }

        ob_start();
        system("/usr/bin/svn status");
        $result = ob_get_clean();

        if ($result == "") { // 工作目录干净, 可以切分支
            $command = "/usr/bin/svn merge " . SVNInfo::buildBranchUrl($branch);
            return Utils::exec($command);
        } else {
            Utils::println("working dir not clean, merge branch failed");
            Utils::println("svn outputs: \n");
            Utils::println($result, false);

            return Error::E_SUCCESS;
        }
    }
}
