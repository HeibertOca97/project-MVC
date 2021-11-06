<?php

namespace core;

class Auth
{
    private static $nameSession = "auth_user";

    public function __construct()
    {
        session_start();
    }

    public static function setSessionUser($userData)
    {
        $_SESSION[self::$nameSession] = $userData;
    }

    public static function user()
    {
        return $_SESSION[self::$nameSession];
    }

    public static function checkAuth()
    {
        if (!isset($_SESSION[self::$nameSession]) || $_SESSION[self::$nameSession] == null) {
            return false;
        } else {
            return true;
        }
    }

    public static function logout()
    {
        unset($_SESSION[self::$nameSession]);
        session_destroy();
    }

    public static function createSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function getSession($name)
    {
        return $_SESSION[$name];
    }

    public static function clearSession($name)
    {
        unset($_SESSION[$name]);
    }
}
