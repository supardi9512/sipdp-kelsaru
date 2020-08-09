<?php

class Home extends Controller {
    public function index()
    {
        $data['title'] = 'Home';
        $data['nama'] = $this->model('User_model')->getUser();

        // memanggil file header.php dan footer.php di dalam folder views/templates/
        // memanggil file index.php di dalam folder views/home/
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}