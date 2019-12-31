<?php

class Users extends Controller {

    public function __construct(){
        $this->userModel= $this->model('User');
    }


    public function register(){
          // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'user_type' => trim($_POST['user_type']),
          
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'user_type_err' => ''
        ];
        
        //FORM VALIDATION


      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'user_type' => '',

          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'user_type_err'=>''        
        ];

        // Load view just to see form before enter any data
        $this->view('users/register', $data);
      }
    }

}