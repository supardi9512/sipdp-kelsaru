<?php

class AdminController extends Controller {
    public function index()
    {
        $data['title'] = 'Data Admin';
        $data['admin'] = $this->model('AdminModel')->getAllAdmin();

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
    
}