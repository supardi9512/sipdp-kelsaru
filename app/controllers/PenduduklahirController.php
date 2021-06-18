<?php

class PenduduklahirController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Penduduk Lahir';
        $data['penduduk_lahir'] = $this->model('PenduduklahirModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk_lahir/index', $data);
        $this->view('templates/footer');
    }

    public function delete($no)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PenduduklahirModel')->delete($no);

        Flasher::setSuccess('Data penduduk lahir berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/penduduklahir');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Penduduk Lahir';
        $data['penduduk_lahir'] = $this->model('PenduduklahirModel')->getAll();

        $this->view('penduduk_lahir/print', $data);
    }
}