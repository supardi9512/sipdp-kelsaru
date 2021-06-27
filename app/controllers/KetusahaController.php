<?php

class KetusahaController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Surat Keterangan Usaha';
        $data['ket_usaha'] = $this->model('KetusahaModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('ket_usaha/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Surat Ket. Usaha';
        $data['penduduk_usaha_max'] = $this->model('KetusahaModel')->getMaxNo();

        $no_usaha = $data['penduduk_usaha_max']['no_usaha_terbesar'];

        $urutan = (int) substr($no_usaha, 3, 7);
        
        $urutan++;

        $huruf = "PU-";
        $data['no_usaha_max'] = $huruf . sprintf("%07s", $urutan);

                
        $this->view('templates/header', $data);
        $this->view('ket_usaha/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_usaha = $_POST['no_usaha'];
        $nik = $_POST['nik'];
        $tgl_buka_usaha = $_POST['tgl_buka_usaha'];
        $nama_usaha = $_POST['nama_usaha'];
        $jenis_usaha = $_POST['jenis_usaha'];
        $alamat_usaha = $_POST['alamat_usaha'];

        if($no_usaha == '' || $nik == '' || $tgl_buka_usaha == '' || $nama_usaha == '' || $jenis_usaha == '' || $alamat_usaha == '') {
            
            Flasher::setOldData('tgl_buka_usaha', $tgl_buka_usaha);
            Flasher::setOldData('nama_usaha', $nama_usaha);
            Flasher::setOldData('jenis_usaha', $jenis_usaha);
            Flasher::setOldData('alamat_usaha', $alamat_usaha);
           
            if($tgl_buka_usaha == '') {
                Flasher::setError('Tanggal buka usaha wajib diisi!', 'danger', 'tgl_buka_usaha');
            }

            if($nama_usaha == '') {
                Flasher::setError('Nama usaha wajib diisi!', 'danger', 'nama_usaha');
            }

            if($jenis_usaha == '') {
                Flasher::setError('Jenis usaha wajib diisi!', 'danger', 'jenis_usaha');
            }

            if($alamat_usaha == '') {
                Flasher::setError('Alamat usaha wajib diisi!', 'danger', 'nama_usaha');
            }

            header('Location: '.BASEURL.'/ketusaha/create');
            exit;
        } else {
            $this->model('KetusahaModel')->create($_POST);

            Flasher::setSuccess('Data surat keterangan usaha berhasil ditambah.', 'success');
            Flasher::unsetOldData('tgl_buka_usaha');
            Flasher::unsetOldData('nama_usaha');
            Flasher::unsetOldData('jenis_usaha');
            Flasher::unsetOldData('alamat_usaha');

            header('Location: '.BASEURL.'/ketusaha');
            exit;
        }
    }

    public function edit($no)
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Surat Ket. Usaha';
        
        $data['penduduk_usaha'] = $this->model('KetusahaModel')->getByNo($no);

        $this->view('templates/header', $data);
        $this->view('ket_usaha/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_usaha = $_POST['no_usaha'];
        $nik = $_POST['nik'];
        $tgl_buka_usaha = $_POST['tgl_buka_usaha'];
        $nama_usaha = $_POST['nama_usaha'];
        $jenis_usaha = $_POST['jenis_usaha'];
        $alamat_usaha = $_POST['alamat_usaha'];

        if($no_usaha == '' || $nik == '' || $tgl_buka_usaha == '' || $nama_usaha == '' || $jenis_usaha == '' || $alamat_usaha == '') {
            
            if($tgl_buka_usaha == '') {
                Flasher::setError('Tanggal buka usaha wajib diisi!', 'danger', 'tgl_buka_usaha');
            }

            if($nama_usaha == '') {
                Flasher::setError('Nama usaha wajib diisi!', 'danger', 'nama_usaha');
            }

            if($jenis_usaha == '') {
                Flasher::setError('Jenis usaha wajib diisi!', 'danger', 'jenis_usaha');
            }

            if($alamat_usaha == '') {
                Flasher::setError('Alamat usaha wajib diisi!', 'danger', 'nama_usaha');
            }

            header('Location: '.BASEURL.'/ketusaha/edit/'.$no_usaha);
            exit;
        } else {
            $this->model('KetusahaModel')->update($_POST);

            Flasher::setSuccess('Data surat keterangan usaha berhasil diubah.', 'success');
            
            header('Location: '.BASEURL.'/ketusaha');
            exit;
        }
    }

    public function validasi($no, $nik)
    {
        $this->model('KetusahaModel')->updateValidasi($no, 'Sudah Validasi');

        Flasher::setSuccess('Data surat keterangan usaha berhasil divalidasi.', 'success');
            
        header('Location: '.BASEURL.'/ketusaha');
        exit;
    }

    public function print($no)
    {
        $data['title'] = 'Surat Keterangan Usaha';
        $data['ket_usaha'] = $this->model('KetusahaModel')->getByNo($no);

        $this->view('ket_usaha/print', $data);
    }
}