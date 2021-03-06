<?php

class Flasher {
    public static function setSuccess($pesan, $tipe)
    {
        $_SESSION['success'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function setError($pesan, $tipe, $kolom)
    {
        $_SESSION['error_'.$kolom] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function setOldData($kolom, $data)
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

    public static function oldData($kolom, $selected = '')
    {
        if(isset($_SESSION['old_data_'.$kolom])) {
            if($selected != '') {
                return $_SESSION['old_data_'.$kolom]['data'];
            }

            echo $_SESSION['old_data_'.$kolom]['data'];

            unset($_SESSION['old_data_'.$kolom]);
        }
    }

    public static function unsetOldData($kolom)
    {
        if(isset($_SESSION['old_data_'.$kolom])) {
            unset($_SESSION['old_data_'.$kolom]);
        }
    }
}