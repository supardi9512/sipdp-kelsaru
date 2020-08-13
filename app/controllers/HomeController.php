<?php

class HomeController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Home';

        // memanggil file header.php dan footer.php di dalam folder views/templates/
        // memanggil file index.php di dalam folder views/home/
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}