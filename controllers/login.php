<?php
namespace controllers;

use database\myDatabase;

class login
{
    private $db;
    private $sql = "SELECT token FROM users WHERE email = :email";
    private $email;
    private $result;

    public function __construct()
    {
        $this->db = new myDatabase();
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function checkToken($token){
        $this->result = $this->db->logIn($this->sql, $this->email);
        if($this->result == hash('sha256', $token)){
            return 'true';
        } else {
            $_SESSION['error'] = 'Wrong email or token!';
        }
    }
}