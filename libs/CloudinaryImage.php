<?php

namespace libs;

use core\App;
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
use core\RouterView;
use Cloudinary\Api\Admin\AdminApi;

class CloudinaryImage{
    use RouterView;

    public function __construct(){
        Configuration::instance(App::config('cloudinary.url'));
    }

    public function upload($url_file, $options){
        $response = (new UploadApi())->upload($url_file, $options);

        return $this->jsonDecode($response);
    }  

    public function delete($public_id, $options){
        (new UploadApi())->destroy($public_id, $options);
    }

    public function getAsset($public_id){
        return (new AdminApi())->asset($public_id);
    }

    public function verificateAsset($public_id){
        if((new AdminApi())->asset($public_id)) return true;

        return false;
    }

}
