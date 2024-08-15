<?php

namespace app\middleware;

use core\Middleware;

class HTTPRequestMiddleware extends Middleware
{
    private array $ctrName;
    private array $allowed_method = ["GET", "POST"];

    public function __construct(array $ctrName)
    {
        parent::__construct();
        $this->ctrName = $ctrName;
    }


    public function handle(array $request)
    {
        $server_method = $_SERVER["REQUEST_METHOD"];
        $request_method = $request[$server_method];

        if(!in_array($server_method, $this->allowed_method)){
            http_response_code(404);
        }
        
        if(is_array($request) && empty($request_method) || !in_array($this->controller, $this->ctrName) || !in_array($this->method, $request_method)){
            http_response_code(404);
        }

        if(http_response_code() == 404){
            $error = "404 | This page could not be found.";
            $this->ctr->view('error.error', [
                'title' => $error,
                'message' => $error
            ]);
        }
    }

}
