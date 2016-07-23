<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/14
 * Time: 10:39
 */

final class SVNInfo
{
    const PROJECT_NAME  = "lib";

    /**
     * @return string Current Url
     */
    public static function getCurrentUrl()
    {
        ob_start();
        system("svn info | grep -E 'URL' | cut -d: -f2-");
        return trim(ob_get_clean());
    }

    public static function getRootUrl()
    {
        return preg_replace('/(branches|trunk)[\w_:\/.]+$/', "", self::getCurrentUrl());
    }


    /**
     * @param bool $includeTrunk
     * @return array svn branch list
     */
    public static function getBranchList($includeTrunk = false)
    {
        $rootUrl = preg_replace('/\/(branches|trunk)[\w_:\/.]+$/', "", self::getCurrentUrl());
        $branchBaseUrl = $rootUrl . "/branches/" . self::PROJECT_NAME;
        ob_start();
        system('svn ls ' . $branchBaseUrl . ' | sed -n \'s/\/$//p\'');
        $branchList = explode("\n", trim(ob_get_clean()));
        if (!$includeTrunk) { return $branchList; }
        else {
            $branchList[] = "trunk";
            return $branchList;
        }
    }


    /**
     * @param $branchName
     * @return string branchUrl
     */
    public static function buildBranchUrl($branchName)
    {
        $rootUrl = preg_replace('/\/(branches|trunk)[\w_:\/.]+$/', "", self::getCurrentUrl());
        if ($branchName == "trunk") {
            return $rootUrl . "/trunk/" . self::PROJECT_NAME;
        } else {
            return $rootUrl . "/branches/" . self::PROJECT_NAME . "/" . $branchName;
        }
    }


    /**
     * @return string
     */
    public static function getCurrentBranchName()
    {
        $url = self::getCurrentUrl();
        if (strpos($url, "trunk") !== false) { return "trunk"; }
        else {
            $idx = strrpos($url, "/");
            return substr($url, $idx + 1);
        }
    }
}
