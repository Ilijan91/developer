<?php
  class Pages extends Controller {

    public function __construct(){
      $this->userModel=$this->model('User');
    }
    
    public function index(){

      $users = $this->userModel->getUsers();
      

      $data = [
        'title' => 'Welcome',
        'users' => $users
        
      ];
     
      $this->view('pages/index', $data);
    }

    
  }