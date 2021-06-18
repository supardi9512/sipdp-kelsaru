<?php

class PendudukModel {
    private $table = 'm_penduduk';
    private $table2 = 'm_kk';
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
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table3.'.id_rw, '.$this->table3.'.no_rw, '.$this->table4.'.id_rt, '.$this->table4.'.no_rt 
                FROM '.$this->table.' 
                INNER JOIN '.$this->table3.' ON '.$this->table.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table3.'.id_rw = :id_rw ORDER BY '.$this->table.'.nik DESC');

                $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table3.'.id_rw, '.$this->table3.'.no_rw, '.$this->table4.'.id_rt, '.$this->table4.'.no_rt 
                FROM '.$this->table.' 
                INNER JOIN '.$this->table3.' ON '.$this->table.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table4.'.id_rt = :id_rt ORDER BY '.$this->table.'.nik DESC');

                $this->db->bind('id_rt', $_SESSION['id']);
        } else {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table3.'.id_rw, '.$this->table3.'.no_rw, '.$this->table4.'.id_rt, '.$this->table4.'.no_rt 
                FROM '.$this->table.' 
                INNER JOIN '.$this->table3.' ON '.$this->table.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table.'.id_rt = '.$this->table4.'.id_rt
                ORDER BY '.$this->table.'.nik DESC');
        }

        return $this->db->resultSet();
    }

    public function getByNik($nik)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE nik=:nik');
        $this->db->bind('nik', $nik);

        return $this->db->single();
    }

    public function getByUsername($username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE username=:username');
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByNikAndUsername($nik, $username)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE nik NOT IN (:nik) AND username=:username');
        $this->db->bind('nik', $nik);
        $this->db->bind('username', $username);

        return $this->db->single();
    }

    public function getByIdRt($id_rt)
    {
        $this->db->query('SELECT * FROM '.$this->table.' WHERE id_rt=:id_rt');
        $this->db->bind('id_rt', $id_rt);

        return $this->db->resultSet();
    }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:nik, :no_kk, :id_rw, :id_rt, :username, :password, :nama_penduduk,
            :tempat_lahir, :tgl_lahir, :jenis_kelamin, :alamat, :kelurahan, :kecamatan, :kota, :provinsi, :pekerjaan,
            :pendidikan, :agama, :status_kawin, :status_penduduk)";

        $this->db->query($query);
        $this->db->bind('nik', $data['nik']);

        $id_rt_id_rw = $data['id_rt_id_rw'];
        $explode_id_rt_id_rw = explode('/', $id_rt_id_rw);
        
        $this->db->bind('no_kk', NULL);
        $this->db->bind('id_rw', $explode_id_rt_id_rw[1]);
        $this->db->bind('id_rt', $explode_id_rt_id_rw[0]);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', md5($data['password']));
        $this->db->bind('nama_penduduk', $data['nama_penduduk']);
        $this->db->bind('tempat_lahir', $data['tempat_lahir']);
        $this->db->bind('tgl_lahir', $data['tgl_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('kelurahan', $data['kelurahan']);
        $this->db->bind('kecamatan', $data['kecamatan']);
        $this->db->bind('kota', $data['kota']);
        $this->db->bind('provinsi', $data['provinsi']);
        $this->db->bind('pekerjaan', $data['pekerjaan']);
        $this->db->bind('pendidikan', $data['pendidikan']);
        $this->db->bind('agama', $data['agama']);
        $this->db->bind('status_kawin', $data['status_kawin']);
        $this->db->bind('status_penduduk', NULL);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        if($data['password'] == '') {

            $query = "UPDATE ".$this->table." SET nik = :nik, username = :username, nama_penduduk = :nama_penduduk,
                    tempat_lahir = :tempat_lahir, tgl_lahir = :tgl_lahir, jenis_kelamin = :jenis_kelamin, alamat = :alamat,
                    pekerjaan = :pekerjaan, pendidikan = :pendidikan, agama = :agama, status_kawin = :status_kawin
                    WHERE nik = :nik_old";

            $this->db->query($query);
            $this->db->bind('nik_old', $data['nik_old']);
            $this->db->bind('nik', $data['nik']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('nama_penduduk', $data['nama_penduduk']);
            $this->db->bind('tempat_lahir', $data['tempat_lahir']);
            $this->db->bind('tgl_lahir', $data['tgl_lahir']);
            $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
            $this->db->bind('alamat', $data['alamat']);
            $this->db->bind('pekerjaan', $data['pekerjaan']);
            $this->db->bind('pendidikan', $data['pendidikan']);
            $this->db->bind('agama', $data['agama']);
            $this->db->bind('status_kawin', $data['status_kawin']);
        } else {
            $query = "UPDATE ".$this->table." SET nik = :nik, username = :username, password = :password, nama_penduduk = :nama_penduduk,
                    tempat_lahir = :tempat_lahir, tgl_lahir = :tgl_lahir, jenis_kelamin = :jenis_kelamin, alamat = :alamat,
                    pekerjaan = :pekerjaan, pendidikan = :pendidikan, agama = :agama, status_kawin = :status_kawin
                    WHERE nik = :nik_old";

            $this->db->query($query);
            $this->db->bind('nik_old', $data['nik_old']);
            $this->db->bind('nik', $data['nik']);
            $this->db->bind('username', $data['username']);
            $this->db->bind('password', md5($data['password']));
            $this->db->bind('nama_penduduk', $data['nama_penduduk']);
            $this->db->bind('tempat_lahir', $data['tempat_lahir']);
            $this->db->bind('tgl_lahir', $data['tgl_lahir']);
            $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
            $this->db->bind('alamat', $data['alamat']);
            $this->db->bind('pekerjaan', $data['pekerjaan']);
            $this->db->bind('pendidikan', $data['pendidikan']);
            $this->db->bind('agama', $data['agama']);
            $this->db->bind('status_kawin', $data['status_kawin']);
        }

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateNoKk($nik, $no_kk)
    {
        $query = "UPDATE ".$this->table." SET no_kk = :no_kk WHERE nik = :nik";

        $this->db->query($query);
        $this->db->bind('nik', $nik);
        $this->db->bind('no_kk', $no_kk);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateNoKkByNoKk($no_kk_old, $no_kk)
    {
        $query = "UPDATE ".$this->table." SET no_kk = :no_kk WHERE no_kk = :no_kk_old";

        $this->db->query($query);
        $this->db->bind('no_kk_old', $no_kk_old);
        $this->db->bind('no_kk', $no_kk);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateStatusPenduduk($nik, $status_penduduk)
    {
        $query = "UPDATE ".$this->table." SET status_penduduk = :status_penduduk WHERE nik = :nik";

        $this->db->query($query);
        $this->db->bind('nik', $nik);
        $this->db->bind('status_penduduk', $status_penduduk);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function delete($nik)
    {
        $query = "DELETE FROM ".$this->table." WHERE nik = :nik";
        $this->db->query($query);
        $this->db->bind('nik', $nik);

        $this->db->execute();

        return $this->db->rowCount();
    }
}