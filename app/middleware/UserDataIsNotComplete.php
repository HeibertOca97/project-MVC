<?php

namespace app\middleware;

use core\RouterView;
use core\Auth;

class UserDataIsNotComplete
{
    use RouterView;
    
    public static function handle()
    {
        if (Auth::user()->username == null) {
            Auth::createSession("complete_user", true);
        } else {
            Auth::clearSession("complete_user");
        }

        if (Auth::getSession("complete_user")) {
            self::redirect("completeData");
        }
    }
}
