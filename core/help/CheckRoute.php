<?php

namespace core\help;

trait CheckRoute
{

    private $url, $controller, $method;
    /*****
        VIEWS CHECKER
     *******/

    public function checkRoute($controller = null, $method = [''])
    {
        if (isset($_GET["url"])) {
            $this->url = $_GET["url"];
        }

        if (isset($this->url)) {
            $this->url = explode("/", $this->url);
            $this->controller = $this->url[0];
            array_shift($this->url);

            if (isset($this->url[0])) {
                $this->method = $this->url[0];
                array_shift($this->url);
            }
        }


        if ($this->controller == null && $controller == null && in_array($this->method, $method)) {
            return true;
        }

        if ($controller == $this->controller && in_array($this->method, $method)) {
            return true;
        }

        if ($controller == $this->controller && in_array($this->method, $method)) {
            return true;
        }

        return false;
    }
}
