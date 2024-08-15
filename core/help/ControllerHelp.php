<?php namespace core\help;

use core\RouterView;

trait ControllerHelp{
    use RouterView;

    private $data = [];

    public function getHTMLBufferView($view, $data = [])
    {
        $view = $this->strReplace($view);

        $this->data = $data;
        foreach ($this->data as $key => $value) {
            ${$key} = $value;
        }

        ob_start();
        require_once $this->content($view);
        return ob_get_clean();
    }

    public function view($view, $data = [])
    {
        $view = $this->strReplace($view);
        $this->data = $data;
        foreach ($data as $id_data => $value) {
            ${$id_data} = $value;
        }

        require_once $this->content($view);
        die();
    }  

    public function template($view)
    {
        $view = $this->strReplace($view);
        foreach ($this->data as $id_data => $value) {
            ${$id_data} = $value;
        }

        require_once $this->content($view);
    }

}

