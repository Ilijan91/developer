<?php

class User {
    public function __construct(){
        $this->db = new Database;
    }


    // return value of user type 

    public function getUserType(){
        
        $this->db->query('SELECT * FROM user_type');
        
        $results= $this->db->resultset();
    
        return $results;
        
    }

    // User registration

    public function register($data){

        $this->db->query('INSERT INTO users ( name, email, password, user_type) VALUES (:name,:email,:password,:user_type)');
        //Bind values
        
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':user_type',$data['user_type']);

        //excecute
        if($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }


    // Login user

    public function login($email, $password){

        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind(':email',$email);
    
        $row= $this->db->single();
           
        $hashed_password= $row->password;
    
        if(password_verify($password ,  $hashed_password)){
            return $row;
        }else{
            return false;
        }
    
        }

    // Find user by email
    public function findUserByEmail($email){

        $this->db->query('SELECT * FROM users WHERE email = :email');
        // Bind value
        $this->db->bind(':email',$email);

        $row = $this->db->single();

        // Check row
        if($this->db->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }


    // Get results from search form
    public function getResults(){

        if(isset($_POST['submit'])){
          
            // Sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $search_text=trim($_POST['search_text']);
            $select=trim($_POST['search_select']);

            if($select == "" || ($select !="type" && $select !="sub_type")){
                $select= "type";
            }
                
            if(empty($search_text)){
                flash("search_none","Please insert search text", "alert alert-danger");
                redirect("pages/index");
            }

            $data=$this->db->query("SELECT * FROM user_type WHERE type LIKE '%$search_text%' OR sub_type  LIKE '%$search_text%'");
            
            $data=$this->db->execute();
            
            // Check row
            if($this->db->rowCount() > 0){
                if($data= $this->db->resultset()){
                    return $data;
                }
                
            } else {
                flash("search_fail","Your search does not match any data", "alert alert-danger");
            }
            
        }

    }




}
