<?php

class KettidakmampuController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Surat Keterangan Tidak Mampu';
        $data['ket_tidak_mampu'] = $this->model('KettidakmampuModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('ket_tidak_mampu/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Surat Ket. Tidak Mampu';
        $data['penduduk_tidak_mampu_max'] = $this->model('KettidakmampuModel')->getMaxNo();

        $no_tidak_mampu = $data['penduduk_tidak_mampu_max']['no_tidak_mampu_terbesar'];

        $urutan = (int) substr($no_tidak_mampu, 4, 6);
        
        $urutan++;

        $huruf = "PTM-";
        $data['no_tidak_mampu_max'] = $huruf . sprintf("%06s", $urutan);

                
        $this->view('templates/header', $data);
        $this->view('ket_tidak_mampu/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_tidak_mampu = $_POST['no_tidak_mampu'];
        $nik = $_POST['nik'];
        
        if($no_tidak_mampu == '' || $nik == '') {

            header('Location: '.BASEURL.'/kettidakmampu/create');
            exit;
        } else {
            $this->model('KettidakmampuModel')->create($_POST);

            Flasher::setSuccess('Data surat keterangan tidak mampu berhasil ditambah.', 'success');
            
            header('Location: '.BASEURL.'/kettidakmampu');
            exit;
        }
    }

    // public function edit($no)
    // {
    //     if($_SESSION['level'] != 'penduduk') {
    //         header('Location: '.BASEURL);
    //         exit;
    //     }

    //     $data['title'] = 'Edit Data Surat Ket. Tidak Mampu';
        
    //     $data['penduduk_tidak_mampu'] = $this->model('KetpindahModel')->getByNo($no);

    //     $this->view('templates/header', $data);
    //     $this->view('ket_pindah/edit', $data);
    //     $this->view('templates/footer');
    // }

    // public function update()
    // {
    //     if($_SESSION['level'] != 'penduduk') {
    //         header('Location: '.BASEURL);
    //         exit;
    //     }

    //     $no_pindah = $_POST['no_pindah'];
    //     $nik = $_POST['nik'];
    //     $tgl_pindah = $_POST['tgl_pindah'];
    //     $alasan_pindah = $_POST['alasan_pindah'];

    //     if($no_pindah == '' || $nik == '' || $tgl_pindah == '' || $alasan_pindah == '') {

    //         if($tgl_pindah == '') {
    //             Flasher::setError('Tanggal pindah wajib diisi!', 'danger', 'tgl_pindah');
    //         }

    //         if($alasan_pindah == '') {
    //             Flasher::setError('Alasan pindah wajib diisi!', 'danger', 'alasan_pindah');
    //         }

    //         header('Location: '.BASEURL.'/ketpindah/edit/'.$no_pindah);
    //         exit;
    //     } else {
    //         $this->model('KetpindahModel')->update($_POST);

    //         Flasher::setSuccess('Data surat keterangan pindah berhasil diubah.', 'success');
            
    //         header('Location: '.BASEURL.'/ketpindah');
    //         exit;
    //     }
    // }

    public function validasi($no, $nik)
    {
        $this->model('KettidakmampuModel')->updateValidasi($no, 'Sudah Validasi');

        Flasher::setSuccess('Data surat keterangan tidak mampu berhasil divalidasi.', 'success');
            
        header('Location: '.BASEURL.'/kettidakmampu');
        exit;
    }

    public function print($no)
    {
        $data['title'] = 'Surat Keterangan Tidak Mampu';
        $data['ket_tidak_mampu'] = $this->model('KettidakmampuModel')->getByNo($no);

        $this->view('ket_tidak_mampu/print', $data);
    }
}