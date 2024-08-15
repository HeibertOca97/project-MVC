<?php namespace app\cookie_request;

use core\CookieRequest;
use core\interfaces\ICookieRequest;

class LoginCookie extends CookieRequest implements ICookieRequest {

    public function toCreateTheEntry(string $nameMethod){
        if($nameMethod == "sign_in"){
            $this->setRequestOldInput(false, array(
                "email" => $this->input('email'),
                "password" => $this->input('password')
            ));
        }
        if($nameMethod == "sign_up"){
            $this->setRequestOldInput(false, array(
                "email" => $this->input('email'),
                "password" => $this->input('password'),
                "confirm_password" => $this->input('confirm_password'),
            ));
        }
    }

    public function toDeleteTheEntry(string $nameMethod){
        if($nameMethod == "sign_in"){
            $this->setRequestOldInput(true, array(
                "email" => "",
                "password" => ""
            ));
        }
        if($nameMethod == "sign_up"){
            $this->setRequestOldInput(true, array(
                "email" => "",
                "password" => "",
                "confirm_password" => "",
            ));
        }
    }

}
