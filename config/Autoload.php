<?php namespace config;

class Autoload{
    public static function run(){
        try{
            spl_autoload_register(function($class){
                $ruta = "./".str_replace("\\", "/", $class) . ".php";
                if(file_exists($ruta)){
                    require_once $ruta;
                }
            });
        }catch(\Exception $err){
            throw new \Exception("An error has occurred in the class \"autoload\" ");
        }
    }
}
