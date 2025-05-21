<?php

class TemplateController{

    //Vista principal de la Plantilla
    public function index(){
        require_once 'views/template.php';
    }

    //Ruta principal
    static public function path(){

        if(!empty($_SERVER["HTTPS"]) && ("on" == $_SERVER["HTTPS"])){
        
            return "https://".$_SERVER["SERVER_NAME"]."/";  
        }else{
            return "http://".$_SERVER["SERVER_NAME"]."/";
        }
    }
}