<?php

namespace core\help;

trait DateTime
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

    public static function dateFormatter($strDate, $format)
    {
        $date = new \DateTime($strDate);
        return $date->format($format); // ej: 'Y-m-d H:i:s'
    }

    public static function getMapNewDateInSpanish(){
        $days = ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'];
        $months = ['Dic', 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov'];
    }

    public static function getTimeAgo($date)
    {
        $timestamp = strtotime($date);

        $strTime = array("segundo", "minuto", "hora", "dia", "mes", "año");
        $length = array("60", "60", "24", "30", "12", "10");

        $currentTime = time();
        if ($currentTime >= $timestamp) {
            $diff = time() - $timestamp;
            for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
                $diff = $diff / $length[$i];
            }
            $diff = round($diff);
            return "Hace " . $diff . " " . $strTime[$i] . "(s)";
        }
    }

    public static function getElapsedTime($datetime)
    {
        if (empty($datetime)) {
            return;
        }

        // check datetime var type
        $strTime = (is_object($datetime)) ? $datetime->format('Y-m-d H:i:s') : $datetime;

        $time = strtotime($strTime);
        $time = time() - $time;
        $time = ($time < 1) ? 1 : $time;

        $tokens = array(
            31536000 => 'año',
            2592000 => 'mes',
            604800 => 'semana',
            86400 => 'día',
            3600 => 'hora',
            60 => 'minuto',
            1 => 'segundo'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            $plural = ($unit == 2592000) ? 'es' : 's';
            return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? $plural : '');
        }
    }
}
