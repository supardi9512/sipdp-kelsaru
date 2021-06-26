<?php

class PenduduktidakmampuController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Penduduk Tidak Mampu';
        $data['penduduk_tidak_mampu'] = $this->model('PenduduktidakmampuModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk_tidak_mampu/index', $data);
        $this->view('templates/footer');
    }

    public function delete($no, $nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PenduduktidakmampuModel')->delete($no);

        Flasher::setSuccess('Data penduduk tidak mampu berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/penduduktidakmampu');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Penduduk Tidak Mampu';
        $data['penduduk_tidak_mampu'] = $this->model('PenduduktidakmampuModel')->getAll();

        $this->view('penduduk_tidak_mampu/print', $data);
    }
}