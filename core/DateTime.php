<?php

namespace core;

class DateTime
{
    /****
     * Values: "now", "+1 day", "+1 week", "+1 hour", "+1 second"
     * Check more at https://www.php.net/manual/es/function.strtotime.php
     ****/

    public static function generateAdvanceDateTime($strMarkNowTime)
    {
        $now = strtotime("+1 hour");
        $newDate = date("Y-m-d H:i:s", $now);
        return $newDate;
    }
}
