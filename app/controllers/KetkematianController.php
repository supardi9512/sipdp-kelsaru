<?php

class KetkematianController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Surat Keterangan Kematian';
        $data['ket_kematian'] = $this->model('KetkematianModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('ket_kematian/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Surat Ket. Kematian';
        $data['penduduk_meninggal_max'] = $this->model('KetkematianModel')->getMaxNo();

        $no_meninggal = $data['penduduk_meninggal_max']['no_meninggal_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($no_meninggal, 3, 7);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "PM-";
        $data['no_meninggal_max'] = $huruf . sprintf("%07s", $urutan);

                
        $this->view('templates/header', $data);
        $this->view('ket_kematian/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_meninggal = $_POST['no_meninggal'];
        $nik = $_POST['nik'];
        $umur = $_POST['umur'];
        $hari_kematian = $_POST['hari_kematian'];
        $tgl_kematian = $_POST['tgl_kematian'];
        $tempat_kematian = $_POST['tempat_kematian'];
        $penyebab_kematian = $_POST['penyebab_kematian'];


        if($no_meninggal == '' || $nik == '' || $umur == '' || $hari_kematian == '' || $tgl_kematian == '' || 
            $tempat_kematian == '' || $penyebab_kematian == '') {
            
            Flasher::setOldData('umur', $umur);
            Flasher::setOldData('hari_kematian', $hari_kematian);
            Flasher::setOldData('tgl_kematian', $tgl_kematian);
            Flasher::setOldData('tempat_kematian', $tempat_kematian);
            Flasher::setOldData('penyebab_kematian', $penyebab_kematian);

            if($umur == '') {
                Flasher::setError('Umur wajib diisi!', 'danger', 'umur');
            }

            if($hari_kematian == '') {
                Flasher::setError('Hari kematian wajib diisi!', 'danger', 'hari_kematian');
            }

            if($tgl_kematian == '') {
                Flasher::setError('Tanggal kematian wajib diisi!', 'danger', 'tgl_kematian');
            }

            if($tempat_kematian == '') {
                Flasher::setError('Tempat kematian wajib diisi!', 'danger', 'tempat_kematian');
            }

            if($penyebab_kematian == '') {
                Flasher::setError('Penyebab kematian wajib diisi!', 'danger', 'penyebab_kematian');
            }

            header('Location: '.BASEURL.'/ketkematian/create');
            exit;
        } else {
            $this->model('KetkematianModel')->create($_POST);

            Flasher::setSuccess('Data surat keterangan kematian berhasil ditambah.', 'success');
            Flasher::unsetOldData('umur');
            Flasher::unsetOldData('hari_kematian');
            Flasher::unsetOldData('tgl_kematian');
            Flasher::unsetOldData('tempat_kematian');
            Flasher::unsetOldData('penyebab_kematian');

            header('Location: '.BASEURL.'/ketkematian');
            exit;
        }
    }

    public function edit($no)
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Surat Ket. Kematian';
        
        $data['penduduk_meninggal'] = $this->model('KetkematianModel')->getByNo($no);

        $this->view('templates/header', $data);
        $this->view('ket_kematian/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_meninggal = $_POST['no_meninggal'];
        $nik = $_POST['nik'];
        $umur = $_POST['umur'];
        $hari_kematian = $_POST['hari_kematian'];
        $tgl_kematian = $_POST['tgl_kematian'];
        $tempat_kematian = $_POST['tempat_kematian'];
        $penyebab_kematian = $_POST['penyebab_kematian'];

        if($no_meninggal == '' || $nik == '' || $umur == '' || $hari_kematian == '' || $tgl_kematian == '' || 
            $tempat_kematian == '' || $penyebab_kematian == '') {

            if($umur == '') {
                Flasher::setError('Umur wajib diisi!', 'danger', 'umur');
            }

            if($hari_kematian == '') {
                Flasher::setError('Hari kematian wajib diisi!', 'danger', 'hari_kematian');
            }

            if($tgl_kematian == '') {
                Flasher::setError('Tanggal kematian wajib diisi!', 'danger', 'tgl_kematian');
            }

            if($tempat_kematian == '') {
                Flasher::setError('Tempat kematian wajib diisi!', 'danger', 'tempat_kematian');
            }

            if($penyebab_kematian == '') {
                Flasher::setError('Penyebab kematian wajib diisi!', 'danger', 'penyebab_kematian');
            }

            header('Location: '.BASEURL.'/ketkematian/edit/'.$no_meninggal);
            exit;
        } else {
            $this->model('KetkematianModel')->update($_POST);

            Flasher::setSuccess('Data surat keterangan kematian berhasil diubah.', 'success');
            
            header('Location: '.BASEURL.'/ketkematian');
            exit;
        }
    }

    public function validasi($no, $nik)
    {
        $this->model('KetkematianModel')->updateValidasi($no, 'Sudah Validasi');

        if($_SESSION['level'] == 'rw') {
            $this->model('PendudukModel')->updateStatusPenduduk($nik, 'Meninggal');
        }

        Flasher::setSuccess('Data surat keterangan kematian berhasil divalidasi.', 'success');
            
        header('Location: '.BASEURL.'/ketkematian');
        exit;
    }

    public function print($no)
    {
        $data['title'] = 'Surat Keterangan Kematian';
        $data['ket_kematian'] = $this->model('KetkematianModel')->getByNo($no);

        $this->view('ket_kematian/print', $data);
    }
}