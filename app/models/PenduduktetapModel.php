<?php

class PenduduktetapModel {
    private $table = 'p_tetap';
    private $table2 = 'm_penduduk';
    private $table3 = 'm_rw';
    private $table4 = 'm_rt';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        if($_SESSION['level'] == 'rw') {
            $this->db->query('SELECT '.$this->table.'.no_tetap, '.$this->table.'.tgl_menetap, '.$this->table2.'.*
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table3.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_tetap DESC');

                $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.no_tetap, '.$this->table.'.tgl_menetap, '.$this->table2.'.*
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table4.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_tetap DESC');

                $this->db->bind('id_rt', $_SESSION['id']);
        } else {
            $this->db->query('SELECT '.$this->table.'.no_tetap, '.$this->table.'.tgl_menetap, '.$this->table2.'.*
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                ORDER BY '.$this->table.'.no_tetap DESC');
        }

        return $this->db->resultSet();
    }

    public function getByNo($no)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE no_tetap=:no_tetap');
        $this->db->bind('no_tetap', $no);

        return $this->db->single();
    }

    public function getMaxNo()
    {
        $this->db->query('SELECT MAX(no_tetap) AS no_tetap_terbesar FROM '.$this->table);
        return $this->db->single();
    }

    public function getByNik($nik)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE nik=:nik');
        $this->db->bind('nik', $nik);

        return $this->db->single();
    }

    public function getByNoAndNik($no, $nik)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE no_tetap NOT IN (:no_tetap) AND nik=:nik');
        $this->db->bind('no_tetap', $no);
        $this->db->bind('nik', $nik);

        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:no_tetap, :nik, :tgl_menetap)";

        $this->db->query($query);
        $this->db->bind('no_tetap', $data['no_tetap']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('tgl_menetap', $data['tgl_menetap']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE ".$this->table." SET nik = :nik, tgl_menetap = :tgl_menetap
                WHERE no_tetap = :no_tetap";

        $this->db->query($query);
        $this->db->bind('no_tetap', $data['no_tetap']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('tgl_menetap', $data['tgl_menetap']);
       
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($no)
    {
        $query = "DELETE FROM ".$this->table." WHERE no_tetap = :no_tetap";
        $this->db->query($query);
        $this->db->bind('no_tetap', $no);

        $this->db->execute();

        return $this->db->rowCount();
    }
}