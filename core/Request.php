<?php

namespace core;

use core\RouterView;
use core\help\RequestMethod;

class Request
{
    use RequestMethod, RouterView;

    private $fields;
    
    protected function rules($type, $nameInput){
        $ruleArray = [
            "required" => "Campo $nameInput obligatorio.",
            "unique" => "Ya existe un registro con este dato."
        ];

        return $ruleArray[$type];
    }

    protected function setFields(array $fields){
        $requests = [];

        foreach ($fields as $key => $item){
            if($item[1] == "file"){
                $requests[$item[0]] = $this->file($item[0]);
            } 
            if($item[1] == "input"){
                $requests[$item[0]] = $this->input($item[0]);
            } 
        }

        $this->fields = json_decode(json_encode($requests));
    }

    public function getFields(){
        return $this->fields;
    }

}
