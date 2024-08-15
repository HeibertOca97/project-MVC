<?php

namespace core\help;

trait RequestMethod
{
    protected function file(string $filename)
    {
        if (isset($_FILES[$filename]))
            return json_decode(json_encode($_FILES[$filename]));
    }

    protected function input(string $inputName)
    {
        if (isset($_POST[$inputName]))
            return json_decode(json_encode($_POST[$inputName]));
    }

    protected function inputJson(string $inputName)
    {
        $request = json_decode(file_get_contents("php://input"), true);
        if ($inputName == null) {
            return $request;
        }

        return $request[$inputName];
    } 
}
