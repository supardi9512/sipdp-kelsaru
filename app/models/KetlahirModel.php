<?php

class KetlahirModel {
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
                WHERE '.$this->table.'.validasi_rt = :validasi_rt
                AND '.$this->table3.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_lahir DESC');

            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table4.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_lahir DESC');

            $this->db->bind('id_rt', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'penduduk') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table2.'.nik = :nik ORDER BY '.$this->table.'.no_lahir DESC');
        
            $this->db->bind('nik', $_SESSION['id']);
        }

        return $this->db->resultSet();
    }

    public function getByNo($no)
    {
        $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk, '.$this->table2.'.pekerjaan, '.$this->table2.'.alamat, '.$this->table2.'.kelurahan, 
                '.$this->table2.'.kecamatan, '.$this->table2.'.kota, '.$this->table3.'.no_rw, '.$this->table3.'.nama_rw,
                '.$this->table4.'.no_rt, '.$this->table4.'.nama_rt
            FROM '.$this->table.' 
            INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
            INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
            INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
            WHERE '.$this->table.'.no_lahir = :no_lahir');

        $this->db->bind('no_lahir', $no);

        return $this->db->single();
    }

    public function getMaxNo()
    {
        $this->db->query('SELECT MAX(no_lahir) AS no_lahir_terbesar FROM '.$this->table);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:no_lahir, :nik, :nama_bayi, :hari_lahir, :jam_lahir, :tgl_lahir,
                    :tempat_lahir, :jenis_kelamin, :berat_badan, :nama_ayah, :nama_ibu, :validasi_rt, :validasi_rw)";

        $this->db->query($query);
        $this->db->bind('no_lahir', $data['no_lahir']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('nama_bayi', $data['nama_bayi']);
        $this->db->bind('hari_lahir', $data['hari_lahir']);
        $this->db->bind('jam_lahir', $data['jam_lahir']);
        $this->db->bind('tgl_lahir', $data['tgl_lahir']);
        $this->db->bind('tempat_lahir', $data['tempat_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('berat_badan', $data['berat_badan']);
        $this->db->bind('nama_ayah', $data['nama_ayah']);
        $this->db->bind('nama_ibu', $data['nama_ibu']);
        $this->db->bind('validasi_rt', 'Belum Validasi');
        $this->db->bind('validasi_rw', 'Belum Validasi');

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE ".$this->table." SET nama_bayi = :nama_bayi, hari_lahir = :hari_lahir, jam_lahir = :jam_lahir, tgl_lahir = :tgl_lahir, 
                tempat_lahir = :tempat_lahir, jenis_kelamin = :jenis_kelamin, berat_badan = :berat_badan, nama_ayah = :nama_ayah, nama_ibu = :nama_ibu
                WHERE no_lahir = :no_lahir";

        $this->db->query($query);
        $this->db->bind('no_lahir', $data['no_lahir']);
        $this->db->bind('nama_bayi', $data['nama_bayi']);
        $this->db->bind('hari_lahir', $data['hari_lahir']);
        $this->db->bind('jam_lahir', $data['jam_lahir']);
        $this->db->bind('tgl_lahir', $data['tgl_lahir']);
        $this->db->bind('tempat_lahir', $data['tempat_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('berat_badan', $data['berat_badan']);
        $this->db->bind('nama_ayah', $data['nama_ayah']);
        $this->db->bind('nama_ibu', $data['nama_ibu']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateValidasi($no, $validasi)
    {
        if($_SESSION['level'] == 'rw') {
            $query = "UPDATE ".$this->table." SET validasi_rw = :validasi_rw
                    WHERE no_lahir = :no_lahir";

            $this->db->query($query);
            $this->db->bind('no_lahir', $no);
            $this->db->bind('validasi_rw', $validasi);
        } elseif($_SESSION['level'] == 'rt') {
            $query = "UPDATE ".$this->table." SET validasi_rt = :validasi_rt
                    WHERE no_lahir = :no_lahir";

            $this->db->query($query);
            $this->db->bind('no_lahir', $no);
            $this->db->bind('validasi_rt', $validasi);
        }
    
        $this->db->execute();

        return $this->db->rowCount();
    }
}