<?php

class App {
    public function __construct()
    {
        $url = $this->parseURL();
        var_dump($url);
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