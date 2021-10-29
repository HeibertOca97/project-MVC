<?php

namespace core;

class Secret
{
    public static function bscrypt($str)
    {
        $hash = password_hash($str, PASSWORD_DEFAULT, ["cost" => 10]);

        return $hash;
    }

    public static function generateToken()
    {
        $hashToken = password_hash(self::characterGenerator(), PASSWORD_DEFAULT, ["cost" => 10]);

        return $hashToken;
    }

    private static function characterGenerator()
    {
        $charaters = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", ".", "-", "_", "$", "&", "#", "@"];

        $n = 15;
        $initRandomNumber = 3;
        $result = [];

        for ($i = 0; $i < $n; $i++) {
            $random = (mt_rand(0, mt_getrandmax()) / mt_getrandmax());

            $initRandomNumber = intval($random * count($charaters));

            array_push($result, $charaters[$initRandomNumber]);
        }

        $str_result = implode("", $result);
        return $str_result;
    }
}
