<?php

namespace app\middleware;

use core\HelpView;
use core\Auth;

class UserDataIsComplete extends HelpView
{
    public static function handle()
    {
        if (Auth::user()->username == null) {
            Auth::createSession("complete_user", true);
        } else {
            Auth::clearSession("complete_user");
        }

        if (!Auth::getSession("complete_user")) {
            self::redirect("dashboard");
        }
    }
}
