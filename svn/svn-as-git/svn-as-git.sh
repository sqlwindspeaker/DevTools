#!/usr/bin/env bash

## 删除环境中已经定义的命令wrapper
unalias svn
unset -f svn

function svn()
{
    ARGS=""
    if [ $# -gt 0 ] && [ $1 = 'log' ]; then ## svn log
        if grep "--oneline" <<< "$*"; then
            ARGS=${ARGS}-q;
        elif grep "--stat" <<< "$*"; then
            ARGS=${ARGS}--verbose;
        fi
        /usr/bin/svn log ${ARGS} | more
    elif [ $# -gt 0 ] && [ $1 = 'diff' ]; then ## svn diff
        /usr/bin/svn diff
    elif ! php /Users/Qilong/Workspace/DevTools/svn/svn-as-git/svn-as-git.php "$@"; then
        /usr/bin/svn "$@"
    fi
}

## 防止函数被后续修改
readonly -f svn

