<?php namespace core;

use core\RouterView;
use core\Controller;

class Middleware{
    
    use RouterView;

    protected $url, $controller, $method;
    protected $ctr;

    public function __construct(){
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
            }else{
                $this->method = 'index';
            }

        }else{
            $this->controller = 'home';
            $this->method = 'index';
        }

        $this->ctr = new Controller();
    }

}
