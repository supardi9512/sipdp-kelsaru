<?php

class Admin extends Controller {
    public function index()
    {
        $data['title'] = 'Daftar Admin';
        $data['admin'] = $this->model('Admin_model')->getAllAdmin();

        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id)
    {
        $data['title'] = 'Detail Admin';
        $data['admin'] = $this->model('Admin_model')->getAdminById($id);

        $this->view('templates/header', $data);
        $this->view('admin/detail', $data);
        $this->view('templates/footer');
    }
}