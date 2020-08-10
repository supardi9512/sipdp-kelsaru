<?php

class Flasher {
    public static function set_success($pesan, $tipe)
    {
        $_SESSION['success'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function set_error($pesan, $tipe, $kolom)
    {
        $_SESSION['error_'.$kolom] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function set_old_data($kolom, $data)
    {
        $_SESSION['old_data_'.$kolom] = [
            'data' => $data        
        ];
    }

    public static function success()
    {
        if(isset($_SESSION['success'])) {
            echo '<div class="sufee-alert alert with-close alert-'.$_SESSION['success']['tipe'].' alert-dismissible fade show">
                    '.$_SESSION['success']['pesan'].'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

            unset($_SESSION['success']);
        }
    }

    public static function error($kolom)
    {
        if(isset($_SESSION['error_'.$kolom])) {
            echo '<p class="text-'.$_SESSION['error_'.$kolom]['tipe'].'">
                    '.$_SESSION['error_'.$kolom]['pesan'].'
                </p>';

            unset($_SESSION['error_'.$kolom]);
        }
    }

    public static function old_data($kolom)
    {
        if(isset($_SESSION['old_data_'.$kolom])) {
            echo $_SESSION['old_data_'.$kolom]['data'];

            unset($_SESSION['old_data_'.$kolom]);
        }
    }
}