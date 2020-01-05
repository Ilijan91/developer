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

    public function getUserParent(){
        
        $this->db->query('SELECT * FROM parents');
        
        $results= $this->db->resultset();
    
        return $results;
        
    }
    public function getUsers($search_text , $search_select){
        
        $this->db->query('SELECT * 
                        FROM users
                        INNER JOIN parents ON users.parent_id =parents.id
                        INNER JOIN user_type ON users.user_type_id =user_type.id
                        WHERE  type = :search_text
                        AND parent = :search_select
                        ');
        
        $this->db->bind(':search_text',$search_text);
        $this->db->bind(':search_select',$search_select);
        
        $row = $this->db->resultset();
  
        return $row;
    }

    // User registration

    public function register($data){

        $this->db->query('INSERT INTO users ( name, email, password, user_type_id,parent_id) VALUES (:name,:email,:password,:user_type_id,:parent_id)');
        //Bind values
        
        $this->db->bind(':name',$data['name']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);
        $this->db->bind(':user_type_id',$data['user_type_id']);
        $this->db->bind(':parent_id',$data['parent_id']);

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

     // Find User By ID
     public function getUserById($id){
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
  
        $row = $this->db->single();
  
        return $row;
      }

    // Get results from search form
    public function getResultsType(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['submit'])){
          
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $search_text=trim($_POST['search_text']);
                $search_select=trim($_POST['search_select']);

                if(empty($search_select)){
                    flash("search_select","Please select type", "alert alert-danger");
                    redirect("pages/index");
                }
                    
                if(empty($search_text)){
                    flash("search_none","Please insert search text", "alert alert-danger");
                    redirect("pages/index");
                }
                
                $data=$this->db->query("SELECT * 
                                        FROM users
                                        INNER JOIN parents ON users.parent_id =parents.id
                                        INNER JOIN user_type ON users.user_type_id =user_type.id
                                        WHERE  type LIKE '%$search_text%' 
                                        OR parent LIKE '%$search_select%'
                                    ");

                $data=$this->db->execute();
                
                // Check row
                if($this->db->rowCount() > 0){
                    if($data= $this->db->single()){
                        return $data;
                    }
                }else {
                    flash("search_fail","Your search does not match any data", "alert alert-danger");
                }
            }
        }
    }


    public function countResultType($type){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['submit'])){
          
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
                $this->db->query("  SELECT users.user_type_id, count(*) AS 'total'
                                    FROM users
                                    JOIN user_type ON users.user_type_id=user_type.id
                                    WHERE user_type.type = '{$type}'
                                ");
    
                $data=$this->db->execute();
                $data=$this->db->single();
                return $data;
                
            }
    
        }
        
    }

    public function countResultParent($search_select){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($_POST['submit'])){
          
                // Sanitize POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
               
               
                $this->db->query("  SELECT users.parent_id, count(*) AS 'total_parent'
                                    FROM users
                                    JOIN parents ON users.parent_id=parents.id
                                    WHERE parents.parent = '{$search_select}'
                                ");
    
                $data=$this->db->execute();
                $data=$this->db->single();
                return $data;
            }
        }
    }




}
