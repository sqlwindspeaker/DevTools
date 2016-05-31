#!/usr/bin/env bash

unset -f trim

function trim()
{


}

readonly -f trim

## 删除空行
## 删除多余空格: sed 's/^[ \t]*//;s/[ \t]*$//'
## 添加行号:ls -l | sed = | sed -n 'N;s/\n/ /p',  或者 cat -n, 或者cat -b (只添加非空行行号）
## 空行合并: cat -s
## expand 命令，将tab转成空格
## skip 跳过 N 行:
## 倒置所有行sed '1!G;h;$!d'
## 开，合 cat /etc/passwd | sed -n '11,$p' | sed 'G' | tr ":" "\n" | sed -E '1h;1!H;$!d;$x;s/\n([^\n])\n/:\1:/g;s/([A-z0-9*\/ -])\n([A-z0-9*\/ -])/\1:\2/g' | sed '/^$/d'