<?php

class KetpindahController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Surat Keterangan Pindah';
        $data['ket_pindah'] = $this->model('KetpindahModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('ket_pindah/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Surat Ket. Pindah';
        $data['penduduk_pindah_max'] = $this->model('KetpindahModel')->getMaxNo();

        $no_pindah = $data['penduduk_pindah_max']['no_pindah_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($no_pindah, 3, 7);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "PP-";
        $data['no_pindah_max'] = $huruf . sprintf("%07s", $urutan);

                
        $this->view('templates/header', $data);
        $this->view('ket_pindah/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_pindah = $_POST['no_pindah'];
        $nik = $_POST['nik'];
        $tgl_pindah = $_POST['tgl_pindah'];
        $alasan_pindah = $_POST['alasan_pindah'];

        if($no_pindah == '' || $nik == '' || $tgl_pindah == '' || $alasan_pindah == '') {
            
            Flasher::setOldData('tgl_pindah', $tgl_pindah);
            Flasher::setOldData('alasan_pindah', $alasan_pindah);
           
            if($tgl_pindah == '') {
                Flasher::setError('Tanggal pindah wajib diisi!', 'danger', 'tgl_pindah');
            }

            if($alasan_pindah == '') {
                Flasher::setError('Alasan pindah wajib diisi!', 'danger', 'alasan_pindah');
            }

            header('Location: '.BASEURL.'/ketpindah/create');
            exit;
        } else {
            $this->model('KetpindahModel')->create($_POST);

            Flasher::setSuccess('Data surat keterangan pindah berhasil ditambah.', 'success');
            Flasher::unsetOldData('tgl_pindah');
            Flasher::unsetOldData('alasan_pindah');
            
            header('Location: '.BASEURL.'/ketpindah');
            exit;
        }
    }

    public function edit($no)
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Surat Ket. Pindah';
        
        $data['penduduk_pindah'] = $this->model('KetpindahModel')->getByNo($no);

        $this->view('templates/header', $data);
        $this->view('ket_pindah/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_pindah = $_POST['no_pindah'];
        $nik = $_POST['nik'];
        $tgl_pindah = $_POST['tgl_pindah'];
        $alasan_pindah = $_POST['alasan_pindah'];

        if($no_pindah == '' || $nik == '' || $tgl_pindah == '' || $alasan_pindah == '') {

            if($tgl_pindah == '') {
                Flasher::setError('Tanggal pindah wajib diisi!', 'danger', 'tgl_pindah');
            }

            if($alasan_pindah == '') {
                Flasher::setError('Alasan pindah wajib diisi!', 'danger', 'alasan_pindah');
            }

            header('Location: '.BASEURL.'/ketpindah/edit/'.$no_pindah);
            exit;
        } else {
            $this->model('KetpindahModel')->update($_POST);

            Flasher::setSuccess('Data surat keterangan pindah berhasil diubah.', 'success');
            
            header('Location: '.BASEURL.'/ketpindah');
            exit;
        }
    }

    public function validasi($no)
    {
        $this->model('KetpindahModel')->updateValidasi($no, 'Sudah Validasi');

        if($_SESSION['level'] == 'rw') {
            $this->model('PendudukModel')->updateStatusPenduduk($nik, 'Pindah');
        }

        Flasher::setSuccess('Data surat keterangan pindah berhasil divalidasi.', 'success');
            
        header('Location: '.BASEURL.'/ketpindah');
        exit;
    }

    public function print($no)
    {
        $data['title'] = 'Surat Keterangan Pindah';
        $data['ket_pindah'] = $this->model('KetpindahModel')->getByNo($no);

        $this->view('ket_pindah/print', $data);
    }
}