<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/27
 * Time: 10:18
 */

if ($argc == 1) {
    system("mysql -e 'show databases' | sed -n '1!p'");
} else {
    $params = $argv[1];
    if (strpos($params, ".") === false) {
        system("mysql -e 'use {$params}; show tables' | sed -n '1!p'");
    } else {
        system('mysql -e \'show create table ' . $params . '\G\' | sed -n \'3,$p\'');
    }
}
// query: