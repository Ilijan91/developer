<?php

/*
 * Main app class
 * Creates URL and load  main controller
 * URL FORMAT controller/method/params
 * 
*/

class Core {

    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct(){
        //print_r($this->getUrl());

        $url=$this->getUrl();

        // Look for controllers first value

        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // if file exists in folder controllers set it to be controller
            $this->currentController=ucwords($url[0]);
            
            // unset 0 index
            unset($url[0]);
        }
        // Require controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller Class

        $this->currentController= new $this->currentController;
        //print_r($this->currentController);


        // check if there is method in controller in second part of the URL

        if(isset($url[1])){

            // check if there is method in controller
            if(method_exists($this->currentController, $url[1])){
                $this->currentMethod= $url[1];

                unset($url[1]);
            }

            // Get params
            $this->params = $url ? array_values($url) : [];

            // Call a callbeck with array of param

            call_user_func_array([$this->currentController , $this->currentMethod], $this->params);
        }

        
    }

    public function getUrl(){
        if(isset($_GET['url'])){
            $url=rtrim($_GET['url'],'/');
            $url=filter_var($url, FILTER_SANITIZE_URL);
            $url= explode('/',$url);
            return $url;
        }
    }
}
 
