<?php

class KetkematianModel {
    private $table = 'p_meninggal';
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
                AND '.$this->table3.'.id_rw = :id_rw ORDER BY '.$this->table.'.no_meninggal DESC');

            $this->db->bind('validasi_rt', 'Sudah Validasi');
            $this->db->bind('id_rw', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'rt') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table4.'.id_rt = :id_rt ORDER BY '.$this->table.'.no_meninggal DESC');

            $this->db->bind('id_rt', $_SESSION['id']);
        } elseif($_SESSION['level'] == 'penduduk') {
            $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk
                FROM '.$this->table.' 
                INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
                INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
                INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
                WHERE '.$this->table2.'.nik = :nik ORDER BY '.$this->table.'.no_meninggal DESC');
        
            $this->db->bind('nik', $_SESSION['id']);
        }

        return $this->db->resultSet();
    }

    public function getByNo($no)
    {
        $this->db->query('SELECT '.$this->table.'.*, '.$this->table2.'.nama_penduduk,  '.$this->table2.'.tempat_lahir,  '.$this->table2.'.tgl_lahir,  
                '.$this->table2.'.jenis_kelamin, '.$this->table2.'.pekerjaan, '.$this->table2.'.agama, '.$this->table2.'.alamat, '.$this->table2.'.kelurahan, 
                '.$this->table2.'.kecamatan, '.$this->table2.'.kota, '.$this->table3.'.no_rw, '.$this->table3.'.nama_rw,
                '.$this->table4.'.no_rt, '.$this->table4.'.nama_rt
            FROM '.$this->table.' 
            INNER JOIN '.$this->table2.' ON '.$this->table.'.nik = '.$this->table2.'.nik 
            INNER JOIN '.$this->table3.' ON '.$this->table2.'.id_rw = '.$this->table3.'.id_rw 
            INNER JOIN '.$this->table4.' ON '.$this->table2.'.id_rt = '.$this->table4.'.id_rt
            WHERE '.$this->table.'.no_meninggal = :no_meninggal');

        $this->db->bind('no_meninggal', $no);

        return $this->db->single();
    }

    public function getMaxNo()
    {
        $this->db->query('SELECT MAX(no_meninggal) AS no_meninggal_terbesar FROM '.$this->table);
        return $this->db->single();
    }

    public function create($data)
    {
        $query = "INSERT INTO ".$this->table." VALUES (:no_meninggal, :nik, :umur, :hari_kematian, :tgl_kematian,
                    :tempat_kematian, :penyebab_kematian, :validasi_rt, :validasi_rw)";

        $this->db->query($query);
        $this->db->bind('no_meninggal', $data['no_meninggal']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('umur', $data['umur']);
        $this->db->bind('hari_kematian', $data['hari_kematian']);
        $this->db->bind('tgl_kematian', $data['tgl_kematian']);
        $this->db->bind('tempat_kematian', $data['tempat_kematian']);
        $this->db->bind('penyebab_kematian', $data['penyebab_kematian']);
        $this->db->bind('validasi_rt', 'Belum Validasi');
        $this->db->bind('validasi_rw', 'Belum Validasi');

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function update($data)
    {
        $query = "UPDATE ".$this->table." SET nik = :nik, umur = :umur, hari_kematian = :hari_kematian, tgl_kematian = :tgl_kematian, 
                tempat_kematian = :tempat_kematian, penyebab_kematian = :penyebab_kematian
                WHERE no_meninggal = :no_meninggal";

        $this->db->query($query);
        $this->db->bind('no_meninggal', $data['no_meninggal']);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('umur', $data['umur']);
        $this->db->bind('hari_kematian', $data['hari_kematian']);
        $this->db->bind('tgl_kematian', $data['tgl_kematian']);
        $this->db->bind('tempat_kematian', $data['tempat_kematian']);
        $this->db->bind('penyebab_kematian', $data['penyebab_kematian']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function updateValidasi($no, $validasi)
    {
        if($_SESSION['level'] == 'rw') {
            $query = "UPDATE ".$this->table." SET validasi_rw = :validasi_rw
                    WHERE no_meninggal = :no_meninggal";

            $this->db->query($query);
            $this->db->bind('no_meninggal', $no);
            $this->db->bind('validasi_rw', $validasi);
        } elseif($_SESSION['level'] == 'rt') {
            $query = "UPDATE ".$this->table." SET validasi_rt = :validasi_rt
                    WHERE no_meninggal = :no_meninggal";

            $this->db->query($query);
            $this->db->bind('no_meninggal', $no);
            $this->db->bind('validasi_rt', $validasi);
        }
    
        $this->db->execute();

        return $this->db->rowCount();
    }
}