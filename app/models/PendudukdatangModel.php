<?php

class PendudukdatangModel {
    private $table = 'p_datang';
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
                WHERE '.$this->table3.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_datang DESC');

                $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table4.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_datang DESC');

                $this->db->bind('id_rt', $_SESSION['id']);
        } else {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                ORDER BY '.$this->table.'.no_datang DESC');
        }

        return $this->db->resultSet();
    }

    public function getByNo($no)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE no_datang=:no_datang');
        $this->db->bind('no_datang', $no);

        return $this->db->single();
    }

    public function getMaxNo()
    {
        $this->db->query('SELECT MAX(no_datang) AS no_datang_terbesar FROM '.$this->table);
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
        $this->db->query('SELECT * FROM '.$this->table.' WHERE no_datang NOT IN (:no_datang) AND nik=:nik');
        $this->db->bind('no_datang', $no);
        $this->db->bind('nik', $nik);

        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:no_datang, :nik, :tgl_datang, :alamat_asal, 
                :kelurahan_asal, :kecamatan_asal, :kota_asal, :provinsi_asal)";

        $this->db->query($query);
        $this->db->bind('no_datang', $data['no_datang']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('tgl_datang', $data['tgl_datang']);
        $this->db->bind('alamat_asal', $data['alamat_asal']);
        $this->db->bind('kelurahan_asal', $data['kelurahan_asal']);
        $this->db->bind('kecamatan_asal', $data['kecamatan_asal']);
        $this->db->bind('kota_asal', $data['kota_asal']);
        $this->db->bind('provinsi_asal', $data['provinsi_asal']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE ".$this->table." SET nik = :nik, tgl_datang = :tgl_datang, alamat_asal = :alamat_asal,
                kelurahan_asal = :kelurahan_asal, kecamatan_asal = :kecamatan_asal, kota_asal = :kota_asal, provinsi_asal = :provinsi_asal
                WHERE no_datang = :no_datang";

        $this->db->query($query);
        $this->db->bind('no_datang', $data['no_datang']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('tgl_datang', $data['tgl_datang']);
        $this->db->bind('alamat_asal', $data['alamat_asal']);
        $this->db->bind('kelurahan_asal', $data['kelurahan_asal']);
        $this->db->bind('kecamatan_asal', $data['kecamatan_asal']);
        $this->db->bind('kota_asal', $data['kota_asal']);
        $this->db->bind('provinsi_asal', $data['provinsi_asal']);
       
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($no)
    {
        $query = "DELETE FROM ".$this->table." WHERE no_datang = :no_datang";
        $this->db->query($query);
        $this->db->bind('no_datang', $no);

        $this->db->execute();

        return $this->db->rowCount();
    }
}