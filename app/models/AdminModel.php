<?php

class AdminModel {
    private $table = 'm_admin';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllAdmin()
    {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getAdminById($id)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_admin=:id_admin');
        $this->db->bind('id_admin', $id);

        return $this->db->single();
    }
}