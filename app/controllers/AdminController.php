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
        if($this->model('AdminModel')->create($_POST) > 0) {
            header('Location: '.BASEURL.'/admin');
            exit;
        }
    }
}