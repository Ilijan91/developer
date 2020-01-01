<?php

class User {
    public function __construct(){
        $this->db = new Database;
    }




    public function getUserType(){
        
        $this->db->query('SELECT * FROM user_type');
        
        $results= $this->db->resultset();
    
        return $results;
        
    }

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





}
