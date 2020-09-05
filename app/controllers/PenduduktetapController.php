<?php

class PenduduktetapController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Penduduk Tetap';
        $data['penduduk_tetap'] = $this->model('PenduduktetapModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk_tetap/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Penduduk Tetap';
        
        $data['penduduk_tetap_max'] = $this->model('PenduduktetapModel')->getMaxNo();
        $data['penduduk_by_id_rt'] = $this->model('PendudukModel')->getByIdRt($_SESSION['id'], 'Tetap');
        
        $no_tetap = $data['penduduk_tetap_max']['no_tetap_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($no_tetap, 3, 7);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "PT-";
        $data['no_tetap_max'] = $huruf . sprintf("%07s", $urutan);
        
        $this->view('templates/header', $data);
        $this->view('penduduk_tetap/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_tetap = $_POST['no_tetap'];
        $nik = $_POST['nik'];
        $tgl_menetap = $_POST['tgl_menetap'];

        $data['penduduk_tetap_by_nik'] = $this->model('PenduduktetapModel')->getByNik($nik);

        if(isset($data['penduduk_tetap_by_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }

        if($no_tetap == '' || $nik == '' || $duplicate_nik == TRUE || $tgl_menetap == '') {
            Flasher::setOldData('nik', $nik);
            Flasher::setOldData('tgl_menetap', $tgl_menetap);

            if($nik == '') {
                Flasher::setError('Penduduk wajib diisi!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('Penduduk sudah digunakan!', 'danger', 'nik');
            }

            if($tgl_menetap == '') {
                Flasher::setError('Tanggal menetap wajib diisi!', 'danger', 'tgl_menetap');
            }

            header('Location: '.BASEURL.'/penduduktetap/create');
            exit;
        } else {
            $this->model('PenduduktetapModel')->create($_POST);
            $this->model('PendudukModel')->updateStatusPenduduk($nik, 'Tetap');

            Flasher::setSuccess('Data penduduk tetap berhasil ditambah.', 'success');
            Flasher::unsetOldData('nik');
            Flasher::unsetOldData('tgl_menetap');

            header('Location: '.BASEURL.'/penduduktetap');
            exit;
        }
    }

    public function edit($no)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Penduduk Tetap';
        
        $data['penduduk_tetap'] = $this->model('PenduduktetapModel')->getByNo($no);
        $data['penduduk_by_id_rt'] = $this->model('PendudukModel')->getByIdRt($_SESSION['id'], 'Tetap');

        $this->view('templates/header', $data);
        $this->view('penduduk_tetap/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_tetap = $_POST['no_tetap'];
        $nik_old = $_POST['nik_old'];
        $nik = $_POST['nik'];
        $tgl_menetap = $_POST['tgl_menetap'];

        $data['penduduk_tetap_by_no_n_nik'] = $this->model('PenduduktetapModel')->getByNoAndNik($no_tetap, $nik);

        if(isset($data['penduduk_tetap_by_no_n_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }

        if($no_tetap == '' || $nik == '' || $duplicate_nik == TRUE || $tgl_menetap == '') {

            if($nik == '') {
                Flasher::setError('Penduduk wajib diisi!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('Penduduk sudah digunakan!', 'danger', 'nik');
            }

            if($tgl_menetap == '') {
                Flasher::setError('Tanggal menetap wajib diisi!', 'danger', 'tgl_menetap');
            }

            header('Location: '.BASEURL.'/penduduktetap/edit/'.$no_tetap);
            exit;
        } else {
            $this->model('PenduduktetapModel')->update($_POST);
            $this->model('PendudukModel')->updateStatusPenduduk($nik_old, NULL);
            $this->model('PendudukModel')->updateStatusPenduduk($nik, 'Tetap');

            Flasher::setSuccess('Data penduduk tetap berhasil diubah.', 'success');
            
            header('Location: '.BASEURL.'/penduduktetap');
            exit;
        }
    }

    public function delete($no, $nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PenduduktetapModel')->delete($no);
        $this->model('PendudukModel')->updateStatusPenduduk($nik, NULL);

        Flasher::setSuccess('Data penduduk tetap berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/penduduktetap');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Penduduk Tetap';
        $data['penduduk_tetap'] = $this->model('PenduduktetapModel')->getAll();

        $this->view('penduduk_tetap/print', $data);
    }
}