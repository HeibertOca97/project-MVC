<?php

namespace core;

class Routing
{

    private $url, $controller, $method, $params;

    public function __construct()
    {
        $this->run();
    }

    public function run()
    {
        if (isset($_GET['url'])) {
            $this->url = $_GET['url'];
        }

        if (!empty($this->url)) {
            $this->url = explode('/', $this->url);

            $this->controller = $this->url[0];
            array_shift($this->url);

            if (isset($this->url[0]) && !empty($this->url[0])) {
                $this->method = $this->url[0];
                array_shift($this->url);
            } else {
                $this->method = METHOD_DEFAULT;
            }

            if (count($this->url) > 0) {
                $this->params = $this->url;
            }
        } else {
            $this->controller = CONTROLLER_DEFAULT;
            $this->method = METHOD_DEFAULT;
        }

        $controllerObj = $this->launchController($this->controller);
        $this->launchMethod($controllerObj);
    }

    private function launchController($controller)
    {
        $controller = ucwords($controller) . "Controller";
        $strFileController = "./controllers/" . $controller . '.php';

        if (!file_exists($strFileController)) {
            $strFileController = './controllers/' . CONTROLLER_DEFAULT . 'Controller.php';
        }

        $controllerObj = null;
        try {
            require_once $strFileController;
            $controller = "controllers\\" . $controller;
            $controllerObj = new $controller;
        } catch (\Throwable $th) {
            $controllerObj = $this->getControllerError();
        } finally {
            return $controllerObj;
        }
    }

    private function launchMethod($controllerObj)
    {
        if (isset($this->method) && method_exists($controllerObj, $this->method)) {
            $this->loadAction($controllerObj, $this->method);
        } else {
            $controllerObj = $this->getControllerError();
            $this->loadAction($controllerObj, METHOD_DEFAULT);
        }
    }

    public function loadAction($controllerObj, $action)
    {
        if (isset($this->params)) {
            call_user_func_array(array($controllerObj, $action), $this->params);
        } else {
            call_user_func(array($controllerObj, $action));
        }
    }

    private function getControllerError()
    {
        $controller = "ErrorController";
        $strFileController = "./controllers/" . $controller . '.php';
        require_once $strFileController;
        $controller = "controllers\\" . $controller;
        $controllerObj = new $controller;
        return $controllerObj;
    }
}
