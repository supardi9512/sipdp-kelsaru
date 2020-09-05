<?php

class PendudukmeninggalController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Penduduk Meninggal';
        $data['penduduk_meninggal'] = $this->model('PendudukmeninggalModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk_meninggal/index', $data);
        $this->view('templates/footer');
    }

    public function delete($no)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PendudukmeninggalModel')->delete($no);
        $this->model('PendudukModel')->updateStatusPenduduk($nik, NULL);

        Flasher::setSuccess('Data penduduk meninggal berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/pendudukmeninggal');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Penduduk Meninggal';
        $data['penduduk_meninggal'] = $this->model('PendudukmeninggalModel')->getAll();

        $this->view('penduduk_meninggal/print', $data);
    }
}