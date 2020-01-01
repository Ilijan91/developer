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








}
