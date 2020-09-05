<?php

class PendudukpindahController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Penduduk Pindah';
        $data['penduduk_pindah'] = $this->model('PendudukpindahModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk_pindah/index', $data);
        $this->view('templates/footer');
    }

    public function delete($no, $nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PendudukpindahModel')->delete($no);
        $this->model('PendudukModel')->updateStatusPenduduk($nik, NULL);

        Flasher::setSuccess('Data penduduk pindah berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/pendudukpindah');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Penduduk Pindah';
        $data['penduduk_pindah'] = $this->model('PendudukpindahModel')->getAll();

        $this->view('penduduk_pindah/print', $data);
    }
}