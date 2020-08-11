<?php

class RwController extends Controller {
    public function index()
    {
        $data['title'] = 'Data Ketua RW';
        $data['rw'] = $this->model('RwModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('rw/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Ketua RW';
        
        $data['rw_max'] = $this->model('RwModel')->getMaxId();
        
        $id_rw = $data['rw_max']['id_rw_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($id_rw, 3, 2);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "RW-";
        $data['id_rw_max'] = $huruf . sprintf("%02s", $urutan);
        
        $this->view('templates/header', $data);
        $this->view('rw/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        $id_rw = $_POST['id_rw'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $no_rw = $_POST['no_rw'];
        $nama_rw = $_POST['nama_rw'];

        $data['rw_by_username'] = $this->model('RwModel')->getByUsername($username);
        $data['rw_by_no'] = $this->model('RwModel')->getByNo($no_rw);

        if(isset($data['rw_by_username']['username'])) {
            $duplicate_username = TRUE;
        } else {
            $duplicate_username = FALSE;
        }

        if(isset($data['rw_by_no']['username'])) {
            $duplicate_no_rw = TRUE;
        } else {
            $duplicate_no_rw = FALSE;
        }

        if($username == '' || $duplicate_username == TRUE || $duplicate_no_rw == TRUE || $password == '' || $nama_rw == '') {
            Flasher::setOldData('nama_rw', $nama_rw);
            Flasher::setOldData('username', $username);
            Flasher::setOldData('no_rw', $no_rw);

            if($username == '') {
                Flasher::setError('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::setError('Username sudah digunakan!', 'danger', 'username');
            }

            if($no_rw == '') {
                Flasher::setError('Nomor RW wajib diisi!', 'danger', 'no_rw');
            } elseif($duplicate_no_rw == TRUE) {
                Flasher::setError('Nomor RW sudah digunakan!', 'danger', 'no_rw');
            }

            if($password == '') {
                Flasher::setError('Password wajib diisi!', 'danger', 'password');
            }

            if($nama_rw == '') {
                Flasher::setError('Nama wajib diisi!', 'danger', 'nama_rw');
            }

            header('Location: '.BASEURL.'/rw/create');
            exit;
        } else {
            $this->model('RwModel')->create($_POST);
            Flasher::setSuccess('Data Ketua RW berhasil ditambah.', 'success');
            header('Location: '.BASEURL.'/rw');
            exit;
        }
    }
}