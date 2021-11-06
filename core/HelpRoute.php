<?php

namespace core;

class HelpRoute
{
    private $controller;

    public function __construct()
    {
        if (isset($_GET["url"])) {
            $url = $_GET["url"];
            $url = explode("/", $url);
            $this->controller = $url[0];
            array_shift($url);
        }
    }

    public function requestRoute($controller = null)
    {
        if (strcasecmp($this->controller, $controller) === 0) {
            return true;
        }

        return false;
    }
}
