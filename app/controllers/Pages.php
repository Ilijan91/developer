<?php
  class Pages extends Controller {

    public function __construct(){
      $this->userModel=$this->model('User');
    }
    
    public function index(){
      $users = $this->userModel->getUserType();
      $data = [
        'title' => 'Welcome',
        'users'=> $users
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

      $results = $this->userModel->getResults();
      //print_r($results);
      $data=[
        "results"=> $results
      ];
      $this->view('pages/results', $data);
    }
  }