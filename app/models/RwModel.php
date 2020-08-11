<?php

class RwModel {
    private $table = 'm_rw';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT * FROM '.$this->table.' ORDER BY id_rw DESC');
        return $this->db->resultSet();
    }

    public function getByUsername($username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE username=:username');
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByNo($no_rw)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE no_rw=:no_rw');
        $this->db->bind('no_rw', $no_rw);

        return $this->db->single();
    }

    public function getMaxId()
    {
        $this->db->query('SELECT MAX(id_rw) AS id_rw_terbesar FROM '.$this->table);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO m_rw VALUES (:id_rw, :username, :password, :no_rw, :nama_rw)";

        $this->db->query($query);
        $this->db->bind('id_rw', $data['id_rw']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('no_rw', $data['no_rw']);
        $this->db->bind('nama_rw', $data['nama_rw']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}