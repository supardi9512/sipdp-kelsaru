<?php

class PendudukusahaController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Usaha Penduduk';
        $data['penduduk_usaha'] = $this->model('PendudukusahaModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk_usaha/index', $data);
        $this->view('templates/footer');
    }

    public function delete($no, $nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PendudukusahaModel')->delete($no);

        Flasher::setSuccess('Data penduduk usaha berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/pendudukusaha');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Usaha Penduduk';
        $data['penduduk_usaha'] = $this->model('PendudukusahaModel')->getAll();

        $this->view('penduduk_usaha/print', $data);
    }
}