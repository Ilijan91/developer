<?php


class Posts extends Controller {

public function __construct(){

    if(!isset($_SESSION['user_id'])){
        redirect('users/login');
      }
    
    $this->postModel=$this->model('Post');
    $this->userModel=$this->model('User');
    
}


public function index(){
    //get posts
   
    $posts= $this->postModel->getPosts();

    $data=[
        'posts'=> $posts
    ];

    $this->view('posts/index', $data);
}

// Add Post
public function add(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      // Sanitize POST
      $_POST  = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
      $data = [
        'title' => trim($_POST['title']),
        'body' => trim($_POST['body']),
        'user_id' => $_SESSION['user_id'],   
        'title_err' => '',
        'body_err' => ''
      ];

      

      

    } else {
      $data = [
        'title' => '',
        'body' => '',
      ];

      $this->view('posts/add', $data);
    }
  }



}