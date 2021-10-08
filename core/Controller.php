<?php namespace core;

use core\HelpView;

class Controller extends HelpView {

    public $data;

    public function __construct(){
        $this->data = array();
    }

    function template($view){
        $view = $this->strReplace($view);
        foreach ($this->data as $id_assoc => $value) {
            ${$id_assoc} = $value;
        }
        include PATH . "resources/" . $view . ".php"; 
    }

    public function view($view, $dataModel = array()) {
        $view = $this->strReplace($view);
        $this->data = $dataModel;
        // Forma 1
        foreach ($dataModel as $id_assoc => $value) {
            ${$id_assoc} = $value;
        }
        // Forma 2
        // extract($dataModel);
        require_once "./resources/views/" . $view . ".php";
    }

    public function redirect($url = null){
        header("Location: " . URL . $url);
    }
}