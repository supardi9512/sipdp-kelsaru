<?php

class PenduduktidakmampuModel {
    private $table = 'p_tidak_mampu';
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
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk,  '.$this->table2.'.tempat_lahir,  '.$this->table2.'.tgl_lahir,  
                '.$this->table2.'.pekerjaan, '.$this->table2.'.alamat, '.$this->table2.'.kelurahan, 
                '.$this->table2.'.kecamatan, '.$this->table2.'.kota, '.$this->table2.'.provinsi, '.$this->table3.'.no_rw, '.$this->table3.'.nama_rw,
                '.$this->table4.'.no_rt, '.$this->table4.'.nama_rt
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table.'.validasi_rt = :validasi_rt AND '.$this->table.'.validasi_rw = :validasi_rw
                AND '.$this->table3.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_tidak_mampu DESC');

            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('validasi_rw', 'Sudah Validasi');
            $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk,  '.$this->table2.'.tempat_lahir,  '.$this->table2.'.tgl_lahir,  
                '.$this->table2.'.pekerjaan, '.$this->table2.'.alamat, '.$this->table2.'.kelurahan, 
                '.$this->table2.'.kecamatan, '.$this->table2.'.kota, '.$this->table2.'.provinsi, '.$this->table3.'.no_rw, '.$this->table3.'.nama_rw,
                '.$this->table4.'.no_rt, '.$this->table4.'.nama_rt
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table.'.validasi_rt = :validasi_rt
                AND '.$this->table4.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_tidak_mampu DESC');

            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('id_rt', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'admin') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk,  '.$this->table2.'.tempat_lahir,  '.$this->table2.'.tgl_lahir,  
                '.$this->table2.'.pekerjaan, '.$this->table2.'.alamat, '.$this->table2.'.kelurahan, 
                '.$this->table2.'.kecamatan, '.$this->table2.'.kota, '.$this->table2.'.provinsi, '.$this->table3.'.no_rw, '.$this->table3.'.nama_rw,
                '.$this->table4.'.no_rt, '.$this->table4.'.nama_rt
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table.'.validasi_rt = :validasi_rt AND '.$this->table.'.validasi_rw = :validasi_rw 
                ORDER BY '.$this->table.'.no_tidak_mampu DESC');
        
            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('validasi_rw', 'Sudah Validasi');
        }

        return $this->db->resultSet();
    }

    public function delete($no)
    {
        $query = "DELETE FROM ".$this->table." WHERE no_tidak_mampu = :no_tidak_mampu";
        $this->db->query($query);
        $this->db->bind('no_tidak_mampu', $no);

        $this->db->execute();

        return $this->db->rowCount();
    }
}