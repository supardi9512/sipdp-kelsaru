<?php

class App {
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();
        
        if($url == NULL) {
			$url = [$this->controller];
        }
        
        // mengecek file controller yang sesuai dengan url index ke-0
        if(file_exists('./app/controllers/'.ucwords($url[0]).'.php')) {
            // ubah variable controller default dengan url index ke-0
            $this->controller = ucwords($url[0]);
            // hilangkan url index ke-0 dari elemen array
            unset($url[0]);
        }

        // memanggil controller
        require_once './app/controllers/'.$this->controller.'.php';
        // membuat objek baru pada controller atau diinstasiasi agar dapat menggunakan methodnya
        $this->controller = new $this->controller;

        // mengecek url index ke-1 atau methodnya
        if(isset($url[1])) {
            // mengecek method di dalam controller
            if(method_exists($this->controller, $url[1])) {
                // ubah variable method default menjadi url index ke-1
                $this->method = $url[1];
                // hilangkan url index ke-1 dari elemen array
                unset($url[1]);
            }
        }

        // mengecek url, jika ada berarti itu parameter
        if(!empty($url)) {
            // mengambil data dari url index ke-3 dan seterusnya atau parameter
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params jika ada 
        call_user_func_array([$this->controller, $this->method], $this->params);

    }
    
    public function parseURL()
    {
        if(isset($_GET['url'])) {
            // menghapus tanda '/' paling akhir dari url
            $url = rtrim($_GET['url'], '/');
            // membersihkan url dari karakter aneh
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // memecahkan url berdasarkan tanda slash '/'
            $url = explode('/', $url);
            return $url;
        }
    }
}