<?php namespace core;

class Core{

    private $url, $controller, $method, $params;

    public function __construct(){
        $this->run();
    }

    public function run(){
        // Verificar url
        if (isset($_GET['url'])) {
            $this->url = $_GET['url'];
        } 
        
        // Si existe valores en la url - Informacion
        if(!empty($this->url)){
            //Convertir a array
            $this->url = explode('/', $this->url);
            
            //Obtener controlador
            $this->controller = $this->url[0];
            array_shift($this->url);
            
            // Obtener metodo
            if(isset($this->url[0]) && !empty($this->url[0])){
                $this->method = $this->url[0];
                array_shift($this->url);
            }else{
                $this->method = METHOD_DEFAULT;
            }

            // Obtener parametros
            if(count($this->url) > 0){
                $this->params = $this->url;
            }
        }else{
            $this->controller = CONTROLLER_DEFAULT;
            $this->method = METHOD_DEFAULT;
        }

        $controllerObj = null;
        try{
            $controllerObj = $this->launchController($this->controller);
            $this->validatedParams($controllerObj, $this->params);

        }catch(\Throwable $th){
            $controller = "ErrorController";
            $strFileController = "./controllers/" . $controller . '.php';
            require_once $strFileController;
            $controller = "controllers\\". $controller;
            $controllerObj = new $controller;

        }
        finally{
            if($controllerObj != null){
                $this->launchMethod($controllerObj);
            }
        }

    }

    public function launchController($controller){
        $controller = ucwords($controller) . "Controller";
        $strFileController = "./controllers/" . $controller . '.php';

        if(!file_exists($strFileController)){
            $strFileController = './controllers/' . CONTROLLER_DEFAULT . 'Controller.php';
        }
        require_once $strFileController;
        $controller = "controllers\\". $controller;
        $controllerObj = new $controller;

        return $controllerObj;
    }

    public function loadAction($controllerObj, $action){
        $accion = $action;
        $controllerObj->$accion();
    }

    public function launchMethod($controllerObj){
        if(isset($this->method) && method_exists($controllerObj, $this->method)){
            $this->loadAction($controllerObj, $this->method);
        }else{
            $this->loadAction($controllerObj, METHOD_DEFAULT);
        }
    }

    public function validatedParams($controllerObj, $paramsObj){    
        if(isset($paramsObj)){
            $datos = call_user_func_array(array($controllerObj, $this->method), $paramsObj);
        }else{
            $datos = call_user_func(array($controllerObj, $this->method));
        }
    }

}