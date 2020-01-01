<?php
  class Pages extends Controller {

    public function __construct(){
      $this->userModel=$this->model('User');
    }
    
    public function index(){

      
      

      $data = [
        'title' => 'Welcome'
        
        
      ];
     
      $this->view('pages/index', $data);
    }

    
  }