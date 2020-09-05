<?php

class PendudukdatangController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Penduduk Datang';
        $data['penduduk_datang'] = $this->model('PendudukdatangModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk_datang/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Penduduk Datang';
        
        $data['penduduk_datang_max'] = $this->model('PendudukdatangModel')->getMaxNo();
        $data['penduduk_by_id_rt'] = $this->model('PendudukModel')->getByIdRt($_SESSION['id'], 'Pendatang');
        
        $no_datang = $data['penduduk_datang_max']['no_datang_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($no_datang, 3, 7);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "PD-";
        $data['no_datang_max'] = $huruf . sprintf("%07s", $urutan);
        
        $this->view('templates/header', $data);
        $this->view('penduduk_datang/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_datang = $_POST['no_datang'];
        $nik = $_POST['nik'];
        $tgl_datang = $_POST['tgl_datang'];
        $alamat_asal = $_POST['alamat_asal'];
        $kelurahan_asal = $_POST['kelurahan_asal'];     
        $kecamatan_asal = $_POST['kecamatan_asal'];     
        $kota_asal = $_POST['kota_asal'];
        $provinsi_asal = $_POST['provinsi_asal'];

        $data['penduduk_datang_by_nik'] = $this->model('PendudukdatangModel')->getByNik($nik);

        if(isset($data['penduduk_datang_by_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }

        if($no_datang == '' || $nik == '' || $duplicate_nik == TRUE || $tgl_datang == '' || $alamat_asal == '' || 
            $kelurahan_asal == '' || $kecamatan_asal == '' || $kota_asal == '' || $provinsi_asal == '') {

            Flasher::setOldData('nik', $nik);
            Flasher::setOldData('tgl_datang', $tgl_datang);
            Flasher::setOldData('alamat_asal', $alamat_asal);
            Flasher::setOldData('kelurahan_asal', $kelurahan_asal);
            Flasher::setOldData('kecamatan_asal', $kecamatan_asal);
            Flasher::setOldData('kota_asal', $kota_asal);
            Flasher::setOldData('provinsi_asal', $provinsi_asal);

            if($nik == '') {
                Flasher::setError('Penduduk wajib diisi!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('Penduduk sudah digunakan!', 'danger', 'nik');
            }

            if($tgl_datang == '') {
                Flasher::setError('Tanggal datang wajib diisi!', 'danger', 'tgl_datang');
            }

            if($alamat_asal == '') {
                Flasher::setError('Alamat asal wajib diisi!', 'danger', 'alamat_asal');
            }

            if($kelurahan_asal == '') {
                Flasher::setError('Kelurahan asal wajib diisi!', 'danger', 'kelurahan_asal');
            }

            if($kecamatan_asal == '') {
                Flasher::setError('Kecamatan asal wajib diisi!', 'danger', 'kecamatan_asal');
            }

            if($kota_asal == '') {
                Flasher::setError('Kota asal wajib diisi!', 'danger', 'kota_asal');
            }

            if($provinsi_asal == '') {
                Flasher::setError('Provinsi asal wajib diisi!', 'danger', 'provinsi_asal');
            }

            header('Location: '.BASEURL.'/pendudukdatang/create');
            exit;
        } else {
            $this->model('PendudukdatangModel')->create($_POST);
            $this->model('PendudukModel')->updateStatusPenduduk($nik, 'Pendatang');

            Flasher::setSuccess('Data penduduk datang berhasil ditambah.', 'success');
            Flasher::unsetOldData('nik');
            Flasher::unsetOldData('tgl_datang');
            Flasher::unsetOldData('alamat_asal');
            Flasher::unsetOldData('kelurahan_asal');
            Flasher::unsetOldData('kecamatan_asal');
            Flasher::unsetOldData('kota_asal');
            Flasher::unsetOldData('provinsi_asal');

            header('Location: '.BASEURL.'/pendudukdatang');
            exit;
        }
    }

    public function edit($no)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Penduduk Datang';
        
        $data['penduduk_datang'] = $this->model('PendudukdatangModel')->getByNo($no);
        $data['penduduk_by_id_rt'] = $this->model('PendudukModel')->getByIdRt($_SESSION['id'], 'Pendatang');

        $this->view('templates/header', $data);
        $this->view('penduduk_datang/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_datang = $_POST['no_datang'];
        $nik_old = $_POST['nik_old'];
        $nik = $_POST['nik'];
        $tgl_datang = $_POST['tgl_datang'];
        $alamat_asal = $_POST['alamat_asal'];
        $kelurahan_asal = $_POST['kelurahan_asal'];     
        $kecamatan_asal = $_POST['kecamatan_asal'];     
        $kota_asal = $_POST['kota_asal'];
        $provinsi_asal = $_POST['provinsi_asal'];

        $data['penduduk_datang_by_no_n_nik'] = $this->model('PendudukdatangModel')->getByNoAndNik($no_datang, $nik);

        if(isset($data['penduduk_datang_by_no_n_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }

        if($no_datang == '' || $nik == '' || $duplicate_nik == TRUE || $tgl_datang == '' || $alamat_asal == '' || 
            $kelurahan_asal == '' || $kecamatan_asal == '' || $kota_asal == '' || $provinsi_asal == '') {

            if($nik == '') {
                Flasher::setError('Penduduk wajib diisi!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('Penduduk sudah digunakan!', 'danger', 'nik');
            }

            if($tgl_datang == '') {
                Flasher::setError('Tanggal datang wajib diisi!', 'danger', 'tgl_datang');
            }

            if($alamat_asal == '') {
                Flasher::setError('Alamat asal wajib diisi!', 'danger', 'alamat_asal');
            }

            if($kelurahan_asal == '') {
                Flasher::setError('Kelurahan asal wajib diisi!', 'danger', 'kelurahan_asal');
            }

            if($kecamatan_asal == '') {
                Flasher::setError('Kecamatan asal wajib diisi!', 'danger', 'kecamatan_asal');
            }

            if($kota_asal == '') {
                Flasher::setError('Kota asal wajib diisi!', 'danger', 'kota_asal');
            }

            if($provinsi_asal == '') {
                Flasher::setError('Provinsi asal wajib diisi!', 'danger', 'provinsi_asal');
            }

            header('Location: '.BASEURL.'/pendudukdatang/edit/'.$no_datang);
            exit;
        } else {
            $this->model('PendudukdatangModel')->update($_POST);
            $this->model('PendudukModel')->updateStatusPenduduk($nik_old, NULL);
            $this->model('PendudukModel')->updateStatusPenduduk($nik, 'Pendatang');

            Flasher::setSuccess('Data penduduk datang berhasil diubah.', 'success');
            
            header('Location: '.BASEURL.'/pendudukdatang');
            exit;
        }
    }

    public function delete($no, $nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PendudukdatangModel')->delete($no);
        $this->model('PendudukModel')->updateStatusPenduduk($nik, NULL);

        Flasher::setSuccess('Data penduduk datang berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/pendudukdatang');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Penduduk Datang';
        $data['penduduk_datang'] = $this->model('PendudukdatangModel')->getAll();

        $this->view('penduduk_datang/print', $data);
    }
}