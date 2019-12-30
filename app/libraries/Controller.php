<?php

class Controller {
    // Load model
    public function model($model){
        
        // require model file
        require_once '../app/models/' . $model . '.php';

        // instanitate model
        return new $model();
    }


    // load view
    public function view($view, $data=[]){
        // check if view file exists in folder view
        if(file_exists('../app/views/'. $view . '.php')){
            require_once '../app/views/'. $view . '.php';
        }else {
            die('View does not exist');
        }

    }
}