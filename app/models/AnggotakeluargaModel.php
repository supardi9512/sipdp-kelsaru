<?php

class AnggotakeluargaModel {
    private $table = 'm_anggota';
    private $table2 = 'm_kk';
    private $table3 = 'm_penduduk';
    private $table4 = 'm_rw';
    private $table5 = 'm_rt';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // public function getAll()
    // {
    //     if($_SESSION['level'] == 'rw') {
    //         $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nik, '.$this->table2.'.nama_penduduk, '.$this->table4.'.id_rw, '.$this->table4.'.no_rw, '.$this->table5.'.id_rt, '.$this->table5.'.no_rt 
    //             FROM '.$this->table.' 
    //             INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
    //             INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rw = '.$this->table4.'.id_rw 
    //             INNER JOIN '.$this->table5.' ON '.$this->table.'.id_rt = '.$this->table5.'.id_rt
    //             WHERE '.$this->table4.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_kk DESC');

    //             $this->db->bind('id_rw', $_SESSION['id']);
    //     } elseif($_SESSION['level'] == 'rt') {
    //         $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nik, '.$this->table2.'.nama_penduduk, '.$this->table4.'.id_rw, '.$this->table4.'.no_rw, '.$this->table5.'.id_rt, '.$this->table5.'.no_rt 
    //             FROM '.$this->table.' 
    //             INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
    //             INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rw = '.$this->table4.'.id_rw 
    //             INNER JOIN '.$this->table5.' ON '.$this->table.'.id_rt = '.$this->table5.'.id_rt
    //             WHERE '.$this->table5.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_kk DESC');

    //             $this->db->bind('id_rt', $_SESSION['id']);
    //     } else {
    //         $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nik, '.$this->table2.'.nama_penduduk, '.$this->table4.'.id_rw, '.$this->table4.'.no_rw, '.$this->table5.'.id_rt, '.$this->table5.'.no_rt 
    //             FROM '.$this->table.' 
    //             INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
    //             INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rw = '.$this->table4.'.id_rw 
    //             INNER JOIN '.$this->table5.' ON '.$this->table.'.id_rt = '.$this->table5.'.id_rt
    //             ORDER BY '.$this->table.'.no_kk DESC');
    //     }

    //     return $this->db->resultSet();
    // }

    public function getByNoKk($no_kk)
    {
        $this->db->query('SELECT '.$this->table.'.*, '.$this->table3.'.nama_penduduk, '.$this->table3.'.jenis_kelamin, '.$this->table3.'.tempat_lahir, '.$this->table3.'.tgl_lahir, '.$this->table3.'.agama, '.$this->table3.'.pendidikan, '.$this->table3.'.pekerjaan, '.$this->table3.'.status_kawin
            FROM '.$this->table.' 
            INNER JOIN '.$this->table3.' ON '.$this->table.'.nik = '.$this->table3.'.nik 
            WHERE '.$this->table.'.no_kk = :no_kk ORDER BY '.$this->table.'.no_anggota ASC');

        $this->db->bind('no_kk', $no_kk);

        return $this->db->resultSet();
    }

    public function getMaxNo()
    {
        $this->db->query('SELECT MAX(no_anggota) AS no_anggota_terbesar FROM '.$this->table);
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

    // public function getByNoKkAndNik($no_kk, $nik)
    // {
    //     $this->db->query('SELECT * FROM '.$this->table.' WHERE no_kk NOT IN (:no_kk) AND nik=:nik');
    //     $this->db->bind('no_kk', $no_kk);
    //     $this->db->bind('nik', $nik);

    //     return $this->db->single();
    // }

    // public function getByIdRt($id_rt)
    // {
    //     $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rt=:id_rt');
    //     $this->db->bind('id_rt', $id_rt);

    //     return $this->db->resultSet();
    // }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:no_anggota, :no_kk, :nik, :status_hubungan)";

        $this->db->query($query);
        $this->db->bind('no_anggota', $data['no_anggota']);
        $this->db->bind('no_kk', $data['no_kk']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('status_hubungan', $data['status_hubungan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    // public function update($data)
    // {
    //     $query = "UPDATE ".$this->table." SET nik = :nik, alamat = :alamat
    //         WHERE no_kk = :no_kk";

    //     $this->db->query($query);
    //     $this->db->bind('no_kk', $data['no_kk']);
    //     $this->db->bind('nik', $data['nik']);
    //     $this->db->bind('alamat', $data['alamat']);

    //     $this->db->execute();

    //     return $this->db->rowCount();
    // }

    public function updateKepalaKeluarga($data)
    {
        $query = "UPDATE ".$this->table." SET nik = :nik 
            WHERE no_kk = :no_kk AND nik = :nik_old";

        $this->db->query($query);
        $this->db->bind('no_kk', $data['no_kk']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('nik_old', $data['nik_old']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($no_anggota)
    {
        $query = "DELETE FROM ".$this->table." WHERE no_anggota = :no_anggota";
        $this->db->query($query);
        $this->db->bind('no_anggota', $no_anggota);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteByNoKk($no_kk)
    {
        $query = "DELETE FROM ".$this->table." WHERE no_kk = :no_kk";
        $this->db->query($query);
        $this->db->bind('no_kk', $no_kk);

        $this->db->execute();

        return $this->db->rowCount();
    }
}