<?php

class Admin extends Controller {
    public function index($nama = 'Supardi', $pekerjaan = 'Programmer')
    {
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['title'] = 'Admin';

        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }
}