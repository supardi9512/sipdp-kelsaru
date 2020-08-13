<?php

class AdminController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Data Admin';
        $data['admin'] = $this->model('AdminModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }
    
    public function create()
    {
        $data['title'] = 'Tambah Data Admin';
        
        $data['admin_max'] = $this->model('AdminModel')->getMaxId();
        
        $id_admin = $data['admin_max']['id_admin_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($id_admin, 2, 2);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "A-";
        $data['id_admin_max'] = $huruf . sprintf("%02s", $urutan);
        
        $this->view('templates/header', $data);
        $this->view('admin/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        $id_admin = $_POST['id_admin'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_admin = $_POST['nama_admin'];

        $data['admin'] = $this->model('AdminModel')->getByUsername($username);

        if(isset($data['admin']['username'])) {
            $duplicate_username = TRUE;
        } else {
            $duplicate_username = FALSE;
        }

        if($id_admin == '' || $username == '' || $duplicate_username == TRUE|| $password == '' || $nama_admin == '') {
            Flasher::setOldData('nama_admin', $nama_admin);
            Flasher::setOldData('username', $username);

            if($username == '') {
                Flasher::setError('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::setError('Username sudah digunakan!', 'danger', 'username');
            }

            if($password == '') {
                Flasher::setError('Password wajib diisi!', 'danger', 'password');
            }

            if($nama_admin == '') {
                Flasher::setError('Nama wajib diisi!', 'danger', 'nama_admin');
            }

            header('Location: '.BASEURL.'/admin/create');
            exit;
        } else {
            $this->model('AdminModel')->create($_POST);
            Flasher::setSuccess('Data admin berhasil ditambah.', 'success');
            header('Location: '.BASEURL.'/admin');
            exit;
        }
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Data Admin';
        
        $data['admin'] = $this->model('AdminModel')->getById($id);        

        $this->view('templates/header', $data);
        $this->view('admin/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        $id_admin = $_POST['id_admin'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_admin = $_POST['nama_admin'];

        $data['admin'] = $this->model('AdminModel')->getByIdAndUsername($id_admin, $username);

        if(isset($data['admin']['username'])) {
            $duplicate_username = TRUE;
        } else {
            $duplicate_username = FALSE;
        }

        if($username == '' || $duplicate_username == TRUE || $nama_admin == '') {
            if($username == '') {
                Flasher::setError('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::setError('Username sudah digunakan!', 'danger', 'username');
            }

            if($nama_admin == '') {
                Flasher::setError('Nama wajib diisi!', 'danger', 'nama_admin');
            }

            header('Location: '.BASEURL.'/admin/edit/'.$id_admin);
            exit;
        } else {
            $this->model('AdminModel')->update($_POST);
            Flasher::setSuccess('Data admin berhasil diubah.', 'success');
            header('Location: '.BASEURL.'/admin');
            exit;
        }
    }

    public function delete($id)
    {
        $this->model('AdminModel')->delete($id);
        Flasher::setSuccess('Data admin berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/admin');
        exit;
    }
}