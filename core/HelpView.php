<?php namespace core;

class HelpView{

    public function assets($dir){
        $strPathUrl = URL . $dir; 
        return $strPathUrl;
    }
    
    public function content($dir){
        $strPathUrl = PATH . "resources/" . $dir . ".php"; 
        require $strPathUrl;
    }

    public function strReplace($str){
        $strRoute =  str_replace('.', '/', $str);
        return $strRoute;
    }
}