<?php

class AdminModel {
    private $table = 'm_admin';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM '.$this->table);
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_admin=:id_admin');
        $this->db->bind('id_admin', $id);

        return $this->db->single();
    }

    public function getMaxId()
    {
        $this->db->query('SELECT MAX(id_admin) AS id_admin_terbesar FROM '.$this->table);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO m_admin VALUES (:id_admin, :username, :password, :nama_admin)";

        $this->db->query($query);
        $this->db->bind('id_admin', $data['id_admin']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('nama_admin', $data['nama_admin']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}