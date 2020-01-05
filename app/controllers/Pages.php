<?php
  class Pages extends Controller {

    public function __construct(){
      $this->userModel=$this->model('User');
    }
    
    public function index(){
      $users = $this->userModel->getUserType();
      $data = [
        'title' => 'Welcome',
        'text'=> 'Please register or login...',
        'users'=> $users
      ];
     
      $this->view('pages/index', $data);
    }

    public function about(){
      //Set Data
      $data = [
        'version' => '1.0.0',
        'description' =>'This is application that can search for users by user type, and users can create edit and delete posts.'
      ];

      // Load about view
      $this->view('pages/about', $data);
    }

    public function results(){

      $results = $this->userModel->getResultsType();
     
      
      $search_text=$_POST['search_text'];
      $search_select=$_POST['search_select'];

      $users= $this->userModel->getUsers($search_text , $search_select);
      $count= $this->userModel->countResultType($search_text);
      $countParent= $this->userModel->countResultParent($search_select);
      
      $data=[
        "results"=> $results,
        "count"=>$count,
        "title"=>$search_text,
        "select"=>$search_select,
        "countParent"=>$countParent,
        "users"=>$users
      ];
      $this->view('pages/results', $data);
    }
  }