<?php

namespace core;

use core\help\RouteControllerFile;
use core\help\Logger;

class Routing
{
    use RouteControllerFile;

    private $url, $controller, $method, $params, $directory = "app/controllers/";

    public function __construct()
    {
        $this->directory = "app/controllers/";
        $this->run();
    }

    public function run()
    {
        try{
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
        }catch(\Exception $err){
            Logger::error($err->getMessage());
            throw new \Exception($err->getMessage());
            $controllerObj = $this->launchController("error");
            $this->launchMethod($controllerObj);
        }
    }

    private function launchController($controller)
    {
        try{
            $nameController = ucwords($controller);
            $errorController = ucwords("Error");
            $path = "./" . $this->directory;
            $namespace = $this->directory;
            $getDirectory = $this->createAnArrayOfDirectories($path, $namespace);
            array_push($getDirectory, array(
                "path" => $path,
                "namespace" => $namespace
            ));

            if (isset($getDirectory)) {
                $getController = [];

                foreach ($getDirectory as $directory) {
                    $getRootFileName = $this->getPathOfControllerAndNameSpace($directory['namespace'], $nameController);

                    if (empty($getRootFileName)) {
                        $getRootFileName = $this->getPathOfControllerAndNameSpace($directory['namespace'], $errorController);
                    }

                    if (isset($getRootFileName)) {
                        $getController = $getRootFileName;
                        break;
                    }
                }
                
                require_once "./" . $getController['path'];
                $controllerObj = new $getController['namespace'];
                return $controllerObj;
            }

            return null;
        }catch(\Exception $err){
            Logger::error($err->getMessage());
            throw new \Exception("An error has occurred in the method \"launchController\" ");
        }

    }

    private function launchMethod($controllerObj)
    {
        try{
            if (isset($this->method) && method_exists($controllerObj, $this->method)) {
                $this->loadAction($controllerObj, $this->method);
            } else {
                $this->loadAction($controllerObj, 'error');
            }
        }catch(\Exception $err){
            Logger::error($err->getMessage());
            throw new \Exception("An error has occurred in the method \"launchMethod\" ");
        }

    }

    public function loadAction($controllerObj, $action)
    {
        try{
            if (isset($this->params)) {
                call_user_func_array(array($controllerObj, $action), $this->params);
            } else {
                call_user_func(array($controllerObj, $action));
            }
        }catch(\Exception $err){
            Logger::error($err->getMessage());
            throw new \Exception("An error has occurred in the method \"loadAction\" ");
        }

    }
}
