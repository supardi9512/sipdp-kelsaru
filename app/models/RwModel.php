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

    public function getById($id)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rw=:id_rw');
        $this->db->bind('id_rw', $id);

        return $this->db->single();
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

    public function getByIdAndUsername($id, $username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rw NOT IN (:id_rw) AND username=:username');
        $this->db->bind('id_rw', $id);
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByIdAndNo($id, $no_rw)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rw NOT IN (:id_rw) AND no_rw=:no_rw');
        $this->db->bind('id_rw', $id);
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
        $query = "INSERT INTO '.$this->table.' VALUES (:id_rw, :username, :password, :no_rw, :nama_rw)";

        $this->db->query($query);
        $this->db->bind('id_rw', $data['id_rw']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('no_rw', $data['no_rw']);
        $this->db->bind('nama_rw', $data['nama_rw']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        if($data['password'] == '') {
            $query = "UPDATE '.$this->table.' SET username = :username, no_rw = :no_rw, nama_rw = :nama_rw 
                    WHERE id_rw = :id_rw";

            $this->db->query($query);
            $this->db->bind('id_rw', $data['id_rw']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('no_rw', $data['no_rw']);
            $this->db->bind('nama_rw', $data['nama_rw']);
        } else {
            $query = "UPDATE '.$this->table.' SET username = :username, password = :password, no_rw = :no_rw, nama_rw = :nama_rw 
                    WHERE id_rw = :id_rw";

            $this->db->query($query);
            $this->db->bind('id_rw', $data['id_rw']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('password', md5($data['password']));
            $this->db->bind('no_rw', $data['no_rw']);
            $this->db->bind('nama_rw', $data['nama_rw']);
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM '.$this->table.' WHERE id_rw = :id_rw";
        $this->db->query($query);
        $this->db->bind('id_rw', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}