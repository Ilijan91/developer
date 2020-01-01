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
          'user_type' => trim($_POST['user_type']),
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          
          
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          
        ];
        
        //FORM VALIDATION

         //Validate email
         if(empty($data['email'])){
          $data['email_err']='Please enter your email';
        }else{
          //check email
          if($this->userModel->findUserByEmail($data['email'])){
            $data['email_err']='Email is already taken!';
          }
        }

        //Validate name
        if(empty($data['name'])){
          $data['name_err']='Please enter your name';
        }

        //Validate password
        if(empty($data['password'])){
          $data['password_err']='Please enter password';
        }elseif(strlen($data['password']) < 6){
          $data['password_err']='Please enter at least 6 characters!';
        }

        //Validate confirm_password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err']='Please confirm password';
        }else{
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err']='Passwords do not match!';
          }
        }

        

        //Make sure data errors are empty
        if(empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          //Form is validated

          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
          // Register User
          if($this->userModel->register($data)){
            echo "Success!";

          } else {
            die('Something went wrong');
          }


        }else {

          // Load form with errors
          $this->view('users/register',$data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'user_type_id' => '',

          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
          'user_type_id_err'=>''        
        ];

        // Load view just to see form before enter any data
        $this->view('users/register', $data);
      }
    }


    public function login(){
       // Check for POST
       if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form

         // Sanitize POST data
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
         // Init data
         $data =[
           
           'email' => trim($_POST['email']),
           'password' => trim($_POST['password']),
           'password_err' => '',
           'email_err' => ''
         ];

         // VALIDATE FORM

         // Validate email

         if(empty($data['email'])){
          $data['email_err']="Please enter email";
        }

        // Validate password

        if(empty($data['password'])){
         $data['password_err']="Please enter password!";
       }

       // Check if user exists in database
       if($this->userModel->findUserByEmail($data['email'])){
        // user found
       }else {
         $data['email_err']='No user!';
       }



       


      

      } else {
        // Init data
        $data =[
          
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',
          
        ];

        // Load view before enter data to the form
        $this->view('users/login', $data);
      }
    
    }





}