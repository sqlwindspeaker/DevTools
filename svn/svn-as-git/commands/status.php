<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/13
 * Time: 17:35
 */

## 1. 显示当前分支

/**
 * @param $args
 * @return int
 */
function svn_status($args)
{
    $result = SVNInfo::getCurrentUrl();

    if (strpos($result, "trunk") !== false) {
        $prompt = "On trunk";
    } else if (strpos($result, "branches") !== false) {
        $prompt = "On branch " . preg_replace('/^[\w_:\/.]+branches\//', "", $result);
    } else {
        $prompt = "On URL " . $result;
    }

    print_r($prompt . "\n\n");

    system("svn st");

    return Error::E_SUCCESS;
}

