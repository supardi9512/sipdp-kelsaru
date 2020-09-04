<?php

class KetlahirController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }
    
    public function index()
    {
        $data['title'] = 'Data Surat Keterangan Lahir';
        $data['ket_lahir'] = $this->model('KetlahirModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('ket_lahir/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Surat Ket. Lahir';
        $data['penduduk_lahir_max'] = $this->model('KetlahirModel')->getMaxNo();

        $no_lahir = $data['penduduk_lahir_max']['no_lahir_terbesar'];

        // mengambil angka dari kode barang terbesar, menggunakan fungsi substr
        // dan diubah ke integer dengan (int)
        $urutan = (int) substr($no_lahir, 3, 7);
        
        // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
        $urutan++;

        // membentuk kode barang baru
        // perintah sprintf("%03s", $urutan); berguna untuk membuat string menjadi 3 karakter
        // misalnya perintah sprintf("%03s", 15); maka akan menghasilkan '015'
        // angka yang diambil tadi digabungkan dengan kode huruf yang kita inginkan, misalnya BRG 
        $huruf = "PL-";
        $data['no_lahir_max'] = $huruf . sprintf("%07s", $urutan);

                
        $this->view('templates/header', $data);
        $this->view('ket_lahir/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_lahir = $_POST['no_lahir'];
        $nik = $_POST['nik'];
        $nama_bayi = $_POST['nama_bayi'];
        $hari_lahir = $_POST['hari_lahir'];
        $jam_lahir = $_POST['jam_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $berat_badan = $_POST['berat_badan'];
        $nama_ayah = $_POST['nama_ayah'];
        $nama_ibu = $_POST['nama_ibu'];

        if($no_lahir == '' || $nik == '' || $nama_bayi == '' || $hari_lahir == '' || $jam_lahir == '' || $tgl_lahir == '' || 
            $tempat_lahir == '' || $jenis_kelamin == '' || $berat_badan == '' || $nama_ayah == '' || $nama_ibu == '') {
            
            Flasher::setOldData('nama_bayi', $nama_bayi);
            Flasher::setOldData('hari_lahir', $hari_lahir);
            Flasher::setOldData('jam_lahir', $jam_lahir);
            Flasher::setOldData('tgl_lahir', $tgl_lahir);
            Flasher::setOldData('tempat_lahir', $tempat_lahir);
            Flasher::setOldData('jenis_kelamin', $jenis_kelamin);
            Flasher::setOldData('berat_badan', $berat_badan);
            Flasher::setOldData('nama_ayah', $nama_ayah);
            Flasher::setOldData('nama_ibu', $nama_ibu);

            if($nama_bayi == '') {
                Flasher::setError('Nama bayi wajib diisi!', 'danger', 'nama_bayi');
            }

            if($hari_lahir == '') {
                Flasher::setError('Hari lahir wajib diisi!', 'danger', 'hari_lahir');
            }

            if($jam_lahir == '') {
                Flasher::setError('Jam lahir wajib diisi!', 'danger', 'jam_lahir');
            }

            if($tgl_lahir == '') {
                Flasher::setError('Tanggal lahir wajib diisi!', 'danger', 'tgl_lahir');
            }

            if($tempat_lahir == '') {
                Flasher::setError('Tempat lahir wajib diisi!', 'danger', 'tempat_lahir');
            }

            if($jenis_kelamin == '') {
                Flasher::setError('Jenis kelamin wajib diisi!', 'danger', 'jenis_kelamin');
            }

            if($berat_badan == '') {
                Flasher::setError('Berat badan wajib diisi!', 'danger', 'berat_badan');
            }

            if($nama_ayah == '') {
                Flasher::setError('Nama ayah wajib diisi!', 'danger', 'nama_ayah');
            }

            if($nama_ibu == '') {
                Flasher::setError('Nama ibu wajib diisi!', 'danger', 'nama_ibu');
            }

            header('Location: '.BASEURL.'/ketlahir/create');
            exit;
        } else {
            $this->model('KetlahirModel')->create($_POST);

            Flasher::setSuccess('Data surat keterangan lahir berhasil ditambah.', 'success');
            Flasher::unsetOldData('nama_bayi', $nama_bayi);
            Flasher::unsetOldData('hari_lahir', $hari_lahir);
            Flasher::unsetOldData('jam_lahir', $jam_lahir);
            Flasher::unsetOldData('tgl_lahir', $tgl_lahir);
            Flasher::unsetOldData('tempat_lahir', $tempat_lahir);
            Flasher::unsetOldData('jenis_kelamin', $jenis_kelamin);
            Flasher::unsetOldData('berat_badan', $berat_badan);
            Flasher::unsetOldData('nama_ayah', $nama_ayah);
            Flasher::unsetOldData('nama_ibu', $nama_ibu);

            header('Location: '.BASEURL.'/ketlahir');
            exit;
        }
    }

    public function edit($no)
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Surat Ket. Lahir';
        
        $data['penduduk_lahir'] = $this->model('KetlahirModel')->getByNo($no);

        $this->view('templates/header', $data);
        $this->view('ket_lahir/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'penduduk') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_lahir = $_POST['no_lahir'];
        $nik = $_POST['nik'];
        $nama_bayi = $_POST['nama_bayi'];
        $hari_lahir = $_POST['hari_lahir'];
        $jam_lahir = $_POST['jam_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $berat_badan = $_POST['berat_badan'];
        $nama_ayah = $_POST['nama_ayah'];
        $nama_ibu = $_POST['nama_ibu'];

        if($no_lahir == '' || $nik == '' || $nama_bayi == '' || $hari_lahir == '' || $jam_lahir == '' || $tgl_lahir == '' || 
            $tempat_lahir == '' || $jenis_kelamin == '' || $berat_badan == '' || $nama_ayah == '' || $nama_ibu == '') {
            
            if($nama_bayi == '') {
                Flasher::setError('Nama bayi wajib diisi!', 'danger', 'nama_bayi');
            }

            if($hari_lahir == '') {
                Flasher::setError('Hari lahir wajib diisi!', 'danger', 'hari_lahir');
            }

            if($jam_lahir == '') {
                Flasher::setError('Jam lahir wajib diisi!', 'danger', 'jam_lahir');
            }

            if($tgl_lahir == '') {
                Flasher::setError('Tanggal lahir wajib diisi!', 'danger', 'tgl_lahir');
            }

            if($tempat_lahir == '') {
                Flasher::setError('Tempat lahir wajib diisi!', 'danger', 'tempat_lahir');
            }

            if($jenis_kelamin == '') {
                Flasher::setError('Jenis kelamin wajib diisi!', 'danger', 'jenis_kelamin');
            }

            if($berat_badan == '') {
                Flasher::setError('Berat badan wajib diisi!', 'danger', 'berat_badan');
            }

            if($nama_ayah == '') {
                Flasher::setError('Nama ayah wajib diisi!', 'danger', 'nama_ayah');
            }

            if($nama_ibu == '') {
                Flasher::setError('Nama ibu wajib diisi!', 'danger', 'nama_ibu');
            }

            header('Location: '.BASEURL.'/ketlahir/edit/'.$no_lahir);
            exit;
        } else {
            $this->model('KetlahirModel')->update($_POST);

            Flasher::setSuccess('Data surat keterangan lahir berhasil diubah.', 'success');
            
            header('Location: '.BASEURL.'/ketlahir');
            exit;
        }
    }

    public function validasi($no)
    {
        $this->model('KetlahirModel')->updateValidasi($no, 'Sudah Validasi');
        Flasher::setSuccess('Data surat keterangan lahir berhasil divalidasi.', 'success');
            
        header('Location: '.BASEURL.'/ketlahir');
        exit;
    }

    public function print($no)
    {
        $data['title'] = 'Surat Keterangan Lahir';
        $data['ket_lahir'] = $this->model('KetlahirModel')->getByNo($no);

        $this->view('ket_lahir/print', $data);
    }
}