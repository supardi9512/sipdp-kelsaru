<?php

class RtController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login']) || $_SESSION['level'] != 'admin') {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Ketua RT';
        $data['rt'] = $this->model('RtModel')->getAll();
        
        $this->view('templates/header', $data);
        $this->view('rt/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Ketua RT';
        
        $data['rt_max'] = $this->model('RtModel')->getMaxId();
        $data['rw'] = $this->model('RwModel')->getAll();
        
        $id_rt = $data['rt_max']['id_rt_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($id_rt, 3, 2);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "RT-";
        $data['id_rt_max'] = $huruf . sprintf("%02s", $urutan);
        
        $this->view('templates/header', $data);
        $this->view('rt/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        $id_rt = $_POST['id_rt'];
        $id_rw = $_POST['id_rw'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $no_rt = $_POST['no_rt'];
        $nama_rt = $_POST['nama_rt'];

        $data['rt_by_username'] = $this->model('RtModel')->getByUsername($username);
        $data['rt_by_no_n_id_rw'] = $this->model('RtModel')->getByNoAndIdRw($no_rt, $id_rw);

        if(isset($data['rt_by_username']['username'])) {
            $duplicate_username = TRUE;
        } else {
            $duplicate_username = FALSE;
        }

        if(isset($data['rt_by_no_n_id_rw']['no_rt'])) {
            $duplicate_no_rt = TRUE;
        } else {
            $duplicate_no_rt = FALSE;
        }

        if($id_rw == '' || $username == '' || $duplicate_username == TRUE || $no_rt == '' || $duplicate_no_rt == TRUE || $password == '' || $nama_rt == '') {
            Flasher::setOldData('id_rw', $id_rw);
            Flasher::setOldData('nama_rt', $nama_rt);
            Flasher::setOldData('username', $username);
            Flasher::setOldData('no_rt', $no_rt);

            if($id_rw == '') {
                Flasher::setError('RW wajib dipilih!', 'danger', 'id_rw');
            }

            if($username == '') {
                Flasher::setError('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::setError('Username sudah digunakan!', 'danger', 'username');
            }

            if($no_rt == '') {
                Flasher::setError('Nomor RT wajib diisi!', 'danger', 'no_rt');
            } elseif($duplicate_no_rt == TRUE) {
                Flasher::setError('Nomor RT sudah digunakan!', 'danger', 'no_rt');
            }

            if($password == '') {
                Flasher::setError('Password wajib diisi!', 'danger', 'password');
            }

            if($nama_rt == '') {
                Flasher::setError('Nama wajib diisi!', 'danger', 'nama_rt');
            }

            header('Location: '.BASEURL.'/rt/create');
            exit;
        } else {
            $this->model('RtModel')->create($_POST);

            Flasher::setSuccess('Data ketua RT berhasil ditambah.', 'success');
            Flasher::unsetOldData('id_rw');
            Flasher::unsetOldData('nama_rt');
            Flasher::unsetOldData('username');
            Flasher::unsetOldData('no_rt');
            
            header('Location: '.BASEURL.'/rt');
            exit;
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Ketua RT';
        
        $data['rt'] = $this->model('RtModel')->getById($id);
        $data['rw'] = $this->model('RwModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('rt/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        $id_rt = $_POST['id_rt'];
        $id_rw = $_POST['id_rw'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $no_rt = $_POST['no_rt'];
        $nama_rt = $_POST['nama_rt'];

        $data['rt_by_id_n_username'] = $this->model('RtModel')->getByIdAndUsername($id_rt, $username);
        $data['rt_by_id_n_no_n_id_rw'] = $this->model('RtModel')->getByIdNoAndIdRw($id_rt, $no_rt, $id_rw);


        if(isset($data['rt_by_id_n_username']['username'])) {
            $duplicate_username = TRUE;
        } else {
            $duplicate_username = FALSE;
        }

        if(isset($data['rt_by_id_n_no_n_id_rw']['no_rt'])) {
            $duplicate_no_rt = TRUE;
        } else {
            $duplicate_no_rt = FALSE;
        }

        if($id_rw == '' || $username == '' || $duplicate_username == TRUE || $no_rt == '' || $duplicate_no_rt == TRUE || $nama_rt == '') {
        
            if($id_rw == '') {
                Flasher::setError('RW wajib dipilih!', 'danger', 'id_rw');
            }

            if($username == '') {
                Flasher::setError('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::setError('Username sudah digunakan!', 'danger', 'username');
            }

            if($no_rt == '') {
                Flasher::setError('Nomor RT wajib diisi!', 'danger', 'no_rt');
            } elseif($duplicate_no_rt == TRUE) {
                Flasher::setError('Nomor RT sudah digunakan!', 'danger', 'no_rt');
            }

            if($nama_rt == '') {
                Flasher::setError('Nama wajib diisi!', 'danger', 'nama_rt');
            }

            header('Location: '.BASEURL.'/rt/edit/'.$id_rt);
            exit;
        } else {
            $this->model('RtModel')->update($_POST);
            Flasher::setSuccess('Data ketua RT berhasil diubah.', 'success');
            header('Location: '.BASEURL.'/rt');
            exit;
        }
    }

    public function delete($id)
    {
        $this->model('RtModel')->delete($id);
        Flasher::setSuccess('Data ketua RT berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/rt');
        exit;
    }
}