#!/usr/bin/env bash

## 删除环境中已经定义的命令wrapper
if $(alias | grep '^svn$'); then
    unalias svn
fi

unset -f svn

function svn()
{
    ARGS=""
    if [ $# -gt 0 ] && [ $1 = 'log' ]; then ## svn log
        if echo "$*" | grep -E '[-]{2}oneline'; then
            /usr/bin/svn log | sed -n -E '/^-+$/{N;N;N;p;}' | more  # Mac下的sed命令大括号里最后一个命令要加分号
        elif echo "$*" | grep -E '[-]{2}stat'; then
            ARGS=${ARGS}--verbose;
            /usr/bin/svn log ${ARGS} | more
        else
            /usr/bin/svn log ${ARGS} | more
        fi
    elif [ $# -gt 0 ] && [ $1 = 'diff' ]; then ## svn diff
        /usr/bin/svn diff
    else
        php /Users/Qilong/Workspace/DevTools/svn/svn-as-git/svn-as-git.php "$@"
        if [ "$?" -eq "1" ]; then /usr/bin/svn "$@"; fi
    fi
}

