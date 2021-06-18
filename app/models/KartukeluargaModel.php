<?php

class KartukeluargaModel {
    private $table = 'm_kk';
    private $table2 = 'm_penduduk';
    private $table3 = 'm_anggota';
    private $table4 = 'm_rw';
    private $table5 = 'm_rt';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAll()
    {
        if($_SESSION['level'] == 'rw') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nik, '.$this->table2.'.nama_penduduk, '.$this->table4.'.id_rw, '.$this->table4.'.no_rw, '.$this->table5.'.id_rt, '.$this->table5.'.no_rt 
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rw = '.$this->table4.'.id_rw 
                INNER JOIN '.$this->table5.' ON '.$this->table.'.id_rt = '.$this->table5.'.id_rt
                WHERE '.$this->table4.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_kk DESC');

                $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nik, '.$this->table2.'.nama_penduduk, '.$this->table4.'.id_rw, '.$this->table4.'.no_rw, '.$this->table5.'.id_rt, '.$this->table5.'.no_rt 
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rw = '.$this->table4.'.id_rw 
                INNER JOIN '.$this->table5.' ON '.$this->table.'.id_rt = '.$this->table5.'.id_rt
                WHERE '.$this->table5.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_kk DESC');

                $this->db->bind('id_rt', $_SESSION['id']);
        } else {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nik, '.$this->table2.'.nama_penduduk, '.$this->table4.'.id_rw, '.$this->table4.'.no_rw, '.$this->table5.'.id_rt, '.$this->table5.'.no_rt 
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rw = '.$this->table4.'.id_rw 
                INNER JOIN '.$this->table5.' ON '.$this->table.'.id_rt = '.$this->table5.'.id_rt
                ORDER BY '.$this->table.'.no_kk DESC');
        }

        return $this->db->resultSet();
    }

    public function getByNoKk($no_kk)
    {
        $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nik, '.$this->table2.'.nama_penduduk, '.$this->table4.'.id_rw, '.$this->table4.'.no_rw, '.$this->table5.'.id_rt, '.$this->table5.'.no_rt 
            FROM '.$this->table.' 
            INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
            INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rw = '.$this->table4.'.id_rw 
            INNER JOIN '.$this->table5.' ON '.$this->table.'.id_rt = '.$this->table5.'.id_rt
            WHERE '.$this->table.'.no_kk = :no_kk');

        $this->db->bind('no_kk', $no_kk);

        return $this->db->single();
    }

    public function getByNik($nik)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE nik=:nik');
        $this->db->bind('nik', $nik);

        return $this->db->single();
    }

    public function getByNoKkAndNik($no_kk, $nik)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE no_kk NOT IN (:no_kk) AND nik=:nik');
        $this->db->bind('no_kk', $no_kk);
        $this->db->bind('nik', $nik);

        return $this->db->single();
    }

    // public function getByIdRt($id_rt)
    // {
    //     $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rt=:id_rt');
    //     $this->db->bind('id_rt', $id_rt);

    //     return $this->db->resultSet();
    // }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:no_kk, :nik, :id_rw, :id_rt, :alamat, 
            :kelurahan, :kecamatan, :kota, :provinsi)";

        $this->db->query($query);
        $this->db->bind('no_kk', $data['no_kk']);
        $this->db->bind('nik', $data['nik']);

        $id_rt_id_rw = $data['id_rt_id_rw'];
        $explode_id_rt_id_rw = explode('/', $id_rt_id_rw);
        
        $this->db->bind('id_rw', $explode_id_rt_id_rw[1]);
        $this->db->bind('id_rt', $explode_id_rt_id_rw[0]);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('kelurahan', $data['kelurahan']);
        $this->db->bind('kecamatan', $data['kecamatan']);
        $this->db->bind('kota', $data['kota']);
        $this->db->bind('provinsi', $data['provinsi']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE ".$this->table." SET nik = :nik, alamat = :alamat
            WHERE no_kk = :no_kk";

        $this->db->query($query);
        $this->db->bind('no_kk', $data['no_kk']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('alamat', $data['alamat']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // public function updateStatusPenduduk($nik, $status_penduduk)
    // {
    //     $query = "UPDATE ".$this->table." SET status_penduduk = :status_penduduk WHERE nik = :nik";

    //     $this->db->query($query);
    //     $this->db->bind('nik', $nik);
    //     $this->db->bind('status_penduduk', $status_penduduk);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }

    public function delete($no_kk)
    {
        $query = "DELETE FROM ".$this->table." WHERE no_kk = :no_kk";
        $this->db->query($query);
        $this->db->bind('no_kk', $no_kk);

        $this->db->execute();

        return $this->db->rowCount();
    }
}