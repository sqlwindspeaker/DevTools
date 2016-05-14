<?php
/**
 * Created by PhpStorm.
 * User: Qilong
 * Date: 16/5/14
 * Time: 10:39
 */

final class SVNInfo
{
    /**
     * @return string Current Url
     */
    public static function getCurrentUrl()
    {
        ob_start();
        system("svn info | grep -E 'URL' | cut -d: -f2-");
        return trim(ob_get_clean());
    }


    /**
     * @param bool $includeTrunk
     * @return array svn branch list
     */
    public static function getBranchList($includeTrunk = false)
    {
        $rootUrl = preg_replace('/\/(branches|trunk)[\w_:\/.]+$/', "", self::getCurrentUrl());
        $branchBaseUrl = $rootUrl . "branches/lib";
        ob_start();
        system('svn ls ' . $branchBaseUrl);
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
            return $rootUrl . "/trunk/lib";
        } else {
            return $rootUrl . "/branches/lib/" . $branchName;
        }
    }

}