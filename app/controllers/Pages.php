<?php
  class Pages extends Controller {

    public function __construct(){
     
    }
    
    public function index(){

      $user= 
      $data = [
        'title' => 'Welcome',
        
      ];
     
      $this->view('pages/index', $data);
    }

    
  }