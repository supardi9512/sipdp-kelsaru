<?php

class RtModel {
    private $table = 'm_rt';
    private $table2 = 'm_rw';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.id_rw, '.$this->table2.'.no_rw FROM '.$this->table.' 
            INNER JOIN '.$this->table2.' ON '.$this->table.'.id_rw = '.$this->table2.'.id_rw ORDER BY '.$this->table.'.id_rt DESC');
        
        return $this->db->resultSet();
    }

    public function getById($id)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rt=:id_rt');
        $this->db->bind('id_rt', $id);

        return $this->db->single();
    }

    public function getByUsername($username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE username=:username');
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByNoAndIdRw($no_rt, $id_rw)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE no_rt=:no_rt AND id_rw=:id_rw');
        $this->db->bind('no_rt', $no_rt);
        $this->db->bind('id_rw', $id_rw);

        return $this->db->single();
    }

    public function getByIdAndUsername($id, $username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rt NOT IN (:id_rt) AND username=:username');
        $this->db->bind('id_rt', $id);
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByIdNoAndIdRw($id, $no_rt, $id_rw)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rt NOT IN (:id_rt) AND no_rt=:no_rt AND id_rw=:id_rw');
        $this->db->bind('id_rt', $id);
        $this->db->bind('no_rt', $no_rt);
        $this->db->bind('id_rw', $id_rw);

        return $this->db->single();
    }

    public function getMaxId()
    {
        $this->db->query('SELECT MAX(id_rt) AS id_rt_terbesar FROM '.$this->table);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:id_rt, :id_rw, :username, :password, :no_rt, :nama_rt)";

        $this->db->query($query);
        $this->db->bind('id_rt', $data['id_rt']);
        $this->db->bind('id_rw', $data['id_rw']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('no_rt', $data['no_rt']);
        $this->db->bind('nama_rt', $data['nama_rt']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        if($data['password'] == '') {
            $query = "UPDATE ".$this->table." SET id_rw = :id_rw, username = :username, no_rt = :no_rt, nama_rt = :nama_rt 
                    WHERE id_rt = :id_rt";

            $this->db->query($query);
            $this->db->bind('id_rt', $data['id_rt']);
            $this->db->bind('id_rw', $data['id_rw']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('no_rt', $data['no_rt']);
            $this->db->bind('nama_rt', $data['nama_rt']);
        } else {
            $query = "UPDATE ".$this->table." SET id_rw = :id_rw, username = :username, password = :password, no_rt = :no_rt, nama_rt = :nama_rt 
                    WHERE id_rt = :id_rt";

            $this->db->query($query);
            $this->db->bind('id_rt', $data['id_rt']);
            $this->db->bind('id_rw', $data['id_rw']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('password', md5($data['password']));
            $this->db->bind('no_rt', $data['no_rt']);
            $this->db->bind('nama_rt', $data['nama_rt']);
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($id)
    {
        $query = "DELETE FROM ".$this->table." WHERE id_rt = :id_rt";
        $this->db->query($query);
        $this->db->bind('id_rt', $id);

        $this->db->execute();

        return $this->db->rowCount();
    }
}