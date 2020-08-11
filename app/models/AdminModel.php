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
        $this->db->query('SELECT * FROM '.$this->table.' ORDER BY id_admin DESC');
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_admin=:id_admin');
        $this->db->bind('id_admin', $id);

        return $this->db->single();
    }

    public function getByUsername($username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE username=:username');
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByIdAndUsername($id, $username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_admin NOT IN (:id_admin) AND username=:username');
        $this->db->bind('id_admin', $id);
        $this->db->bind('username', $username);

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

    public function update($data)
    {
        if($data['password'] == '') {
            $query = "UPDATE m_admin SET username = :username, nama_admin = :nama_admin 
                    WHERE id_admin = :id_admin";

            $this->db->query($query);
            $this->db->bind('id_admin', $data['id_admin']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('nama_admin', $data['nama_admin']);
        } else {
            $query = "UPDATE m_admin SET username = :username, password = :password, nama_admin = :nama_admin 
                    WHERE id_admin = :id_admin";

            $this->db->query($query);
            $this->db->bind('id_admin', $data['id_admin']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('password', md5($data['password']));
            $this->db->bind('nama_admin', $data['nama_admin']);
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM m_admin WHERE id_admin = :id_admin";
        $this->db->query($query);
        $this->db->bind('id_admin', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}