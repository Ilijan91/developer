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

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0',
        'description' =>'This is application that can search for users by user type...'
      ];

      // Load about view
      $this->view('pages/about', $data);
    }

    public function results(){
      
      $data=[];
      $this->view('pages/results', $data);
    }
  }