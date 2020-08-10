<?php

class AdminController extends Controller {
    public function index()
    {
        $data['title'] = 'Data Admin';
        $data['admin'] = $this->model('AdminModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    // public function detail($id)
    // {
    //     $data['title'] = 'Detail Admin';
    //     $data['admin'] = $this->model('AdminModel')->getAdminById($id);

    //     $this->view('templates/header', $data);
    //     $this->view('admin/detail', $data);
    //     $this->view('templates/footer');
    // }
    
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
            Flasher::set_old_data('nama_admin', $nama_admin);
            Flasher::set_old_data('username', $username);

            if($username == '') {
                Flasher::set_error('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::set_error('Username sudah digunakan!', 'danger', 'username');
            }

            if($password == '') {
                Flasher::set_error('Password wajib diisi!', 'danger', 'password');
            }

            if($nama_admin == '') {
                Flasher::set_error('Nama wajib diisi!', 'danger', 'nama_admin');
            }

            header('Location: '.BASEURL.'/admin/create');
            exit;
        } else {
            if($this->model('AdminModel')->create($_POST) > 0) {
                Flasher::set_success('Data admin berhasil ditambah.', 'success');
                header('Location: '.BASEURL.'/admin');
                exit;
            }
        }
    }

    public function delete($id)
    {
        if($this->model('AdminModel')->delete($id) > 0) {
            Flasher::set_success('Data admin berhasil dihapus.', 'success');
            header('Location: '.BASEURL.'/admin');
            exit;
        }
    }
}