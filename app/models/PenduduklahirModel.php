<?php

class PenduduklahirModel {
    private $table = 'p_lahir';
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
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table.'.validasi_rt = :validasi_rt AND '.$this->table.'.validasi_rw = :validasi_rw
                AND '.$this->table3.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_lahir DESC');

            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('validasi_rw', 'Sudah Validasi');
            $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table.'.validasi_rt = :validasi_rt
                AND '.$this->table4.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_lahir DESC');

            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('id_rt', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'admin') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table.'.validasi_rt = :validasi_rt AND '.$this->table.'.validasi_rw = :validasi_rw 
                ORDER BY '.$this->table.'.no_lahir DESC');
        
            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('validasi_rw', 'Sudah Validasi');
        }

        return $this->db->resultSet();
    }

    public function delete($no)
    {
        $query = "DELETE FROM ".$this->table." WHERE no_lahir = :no_lahir";
        $this->db->query($query);
        $this->db->bind('no_lahir', $no);

        $this->db->execute();

        return $this->db->rowCount();
    }
}