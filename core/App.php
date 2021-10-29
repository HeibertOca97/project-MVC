<?php

namespace core;

class App
{
    public static function config($strDir)
    {
        $arrayKey = explode(".", $strDir);
        $collectionName = null;
        $collectionProperty = null;
        $appName = array();
        $strResult = null;
        $app = include "./config/app.php";

        if (isset($arrayKey[0])) {
            $collectionName = strtoupper($arrayKey[0]);
            array_shift($arrayKey);
            if (array_key_exists($collectionName, $app)) {
                $appName = $app[$collectionName];
                $collectionProperty = strtoupper($arrayKey[0]);
                array_shift($arrayKey);

                $strResult = array_key_exists($collectionProperty, $appName) ? $appName[$collectionProperty] : null;
            } else {
                $strResult = null;
            }
        } else {
            $strResult = null;
        }

        return $strResult;
    }
}
