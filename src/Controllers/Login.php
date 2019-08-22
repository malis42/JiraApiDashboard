<?php

namespace SALESmanago\Controllers;

use SALESmanago\Database\myDatabase;
use SALESmanago\Libs\ControllerCore;

class Login extends ControllerCore
{
    private $db;
    private $email;
    private $result;

    public function __construct()
    {
        parent::__construct();
        $this->db = new myDatabase();
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function checkToken($token)
    {
        $sql = "SELECT token FROM users WHERE email = :email";
        $this->result = $this->db->logIn($sql, $this->email);
        if ($this->result == hash('sha256', $token)) {
            return 'true';
        } else {
            $_SESSION['error'] = 'Wrong email or token!';
        }
    }
}
