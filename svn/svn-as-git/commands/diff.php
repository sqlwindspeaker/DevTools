<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/13
 * Time: 17:34
 *
 */
## 1. 可以调用vimdiff
## 2. 可以比较两个分支之间的差别
## 3. 比较分支的时候可以选择name-only
system("git difftool HEAD^");

/**
 * @param Array $arguments
 */
function svn_diff(Array $arguments)
{
    system("git difftool HEAD^");
}
