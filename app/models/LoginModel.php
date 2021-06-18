<?php

class LoginModel {
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getByUsername($table, $username)
    {
        $this->db->query('SELECT * FROM '.$table.' WHERE username=:username');
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByUsernameAndPassword($table, $username, $password)
    {
        $this->db->query('SELECT * FROM '.$table.' WHERE username=:username AND password=:password');
        $this->db->bind('username', $username);
        $this->db->bind('password', md5($password));

        return $this->db->single();
    }
}