<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/14
 * Time: 10:39
 */

final class Utils
{
    public static function println($message)
    {
        echo $message, "\n";
    }

    public static function prompt($prompt, $withWrapper = true)
    {
        if ($withWrapper) { echo "**********     "; }
        echo $prompt;
        if ($withWrapper) { echo "    **********"; }
        echo "\n";
    }


    public static function exec($command)
    {
        self::println("will execute command: " . $command);

        ob_start();
        system($command, $result);
        $output = trim(ob_get_clean());

        if ($output != "") {
            self::println("svn outputs: \n");
            self::println($output);
        }

        if ($result === 0) { return Error::E_SUCCESS; }
        else { return Error::E_EXEC_FAIL; }
    }
}