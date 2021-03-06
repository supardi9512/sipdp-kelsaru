<?php

class PendudukController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Data Penduduk';
        $data['penduduk'] = $this->model('PendudukModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('penduduk/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Penduduk';
        
        $data['rt'] = $this->model('RtModel')->getById($_SESSION['id']);
        
        $this->view('templates/header', $data);
        $this->view('penduduk/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $nik = $_POST['nik'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_penduduk = $_POST['nama_penduduk'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];
        $pendidikan = $_POST['pendidikan'];
        $agama = $_POST['agama'];
        $status_kawin = $_POST['status_kawin'];

        $data['penduduk_by_nik'] = $this->model('PendudukModel')->getByNik($nik);
        $data['penduduk_by_username'] = $this->model('PendudukModel')->getByUsername($username);

        if(isset($data['penduduk_by_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }
        
        if(isset($data['penduduk_by_username']['username'])) {
            $duplicate_username = TRUE;
        } else {
            $duplicate_username = FALSE;
        }

        if($nik == '' || $duplicate_nik == TRUE || $username == '' || $duplicate_username == TRUE || 
            $password == '' || $nama_penduduk == '' || $tempat_lahir == '' || $tgl_lahir == '' || $jenis_kelamin == '' || 
            $alamat == '' || $pekerjaan == '' || $pendidikan == '' || $agama == '' || $status_kawin == '') {

            Flasher::setOldData('nik', $nik);
            Flasher::setOldData('username', $username);
            Flasher::setOldData('nama_penduduk', $nama_penduduk);
            Flasher::setOldData('tempat_lahir', $tempat_lahir);
            Flasher::setOldData('tgl_lahir', $tgl_lahir);
            Flasher::setOldData('jenis_kelamin', $jenis_kelamin);
            Flasher::setOldData('alamat', $alamat);
            Flasher::setOldData('pekerjaan', $pekerjaan);
            Flasher::setOldData('pendidikan', $pendidikan);
            Flasher::setOldData('agama', $agama);
            Flasher::setOldData('status_kawin', $status_kawin);

            if($nik == '') {
                Flasher::setError('NIK wajib diisi!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('NIK sudah digunakan!', 'danger', 'nik');
            }

            if($username == '') {
                Flasher::setError('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::setError('Username sudah digunakan!', 'danger', 'username');
            }

            if($password == '') {
                Flasher::setError('Password wajib diisi!', 'danger', 'password');
            }

            if($nama_penduduk == '') {
                Flasher::setError('Nama penduduk wajib diisi!', 'danger', 'nama_penduduk');
            }

            if($tempat_lahir == '') {
                Flasher::setError('Tempat lahir wajib diisi!', 'danger', 'tempat_lahir');
            }

            if($tgl_lahir == '') {
                Flasher::setError('Tanggal lahir wajib diisi!', 'danger', 'tgl_lahir');
            }

            if($jenis_kelamin == '') {
                Flasher::setError('Jenis kelamin wajib dipilih!', 'danger', 'jenis_kelamin');
            }

            if($alamat == '') {
                Flasher::setError('Alamat wajib diisi!', 'danger', 'alamat');
            }

            if($pekerjaan == '') {
                Flasher::setError('Pekerjaan wajib dipilih!', 'danger', 'pekerjaan');
            }

            if($pendidikan == '') {
                Flasher::setError('Pendidikan wajib dipilih!', 'danger', 'pendidikan');
            }

            if($agama == '') {
                Flasher::setError('Agama wajib dipilih!', 'danger', 'agama');
            }

            if($status_kawin == '') {
                Flasher::setError('Status kawin wajib dipilih!', 'danger', 'status_kawin');
            }

            header('Location: '.BASEURL.'/penduduk/create');
            exit;
        } else {
            $this->model('PendudukModel')->create($_POST);

            Flasher::setSuccess('Data penduduk berhasil ditambah.', 'success');
            Flasher::unsetOldData('nik');
            Flasher::unsetOldData('id_rt_id_rw');
            Flasher::unsetOldData('username');
            Flasher::unsetOldData('nama_penduduk');
            Flasher::unsetOldData('tempat_lahir');
            Flasher::unsetOldData('tgl_lahir');
            Flasher::unsetOldData('jenis_kelamin');
            Flasher::unsetOldData('alamat');
            Flasher::unsetOldData('pekerjaan');
            Flasher::unsetOldData('pendidikan');
            Flasher::unsetOldData('agama');
            Flasher::unsetOldData('status_kawin');
            
            header('Location: '.BASEURL.'/penduduk');
            exit;
        }
    }

    public function edit($nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Penduduk';
        
        $data['penduduk'] = $this->model('PendudukModel')->getByNik($nik);
        $data['rt'] = $this->model('RtModel')->getById($_SESSION['id']);

        $this->view('templates/header', $data);
        $this->view('penduduk/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $nik_old = $_POST['nik_old'];
        $nik = $_POST['nik'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $nama_penduduk = $_POST['nama_penduduk'];
        $tempat_lahir = $_POST['tempat_lahir'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $alamat = $_POST['alamat'];
        $pekerjaan = $_POST['pekerjaan'];
        $pendidikan = $_POST['pendidikan'];
        $agama = $_POST['agama'];
        $status_kawin = $_POST['status_kawin'];
        
        if($nik != $nik_old) {
            $data['penduduk_by_nik'] = $this->model('PendudukModel')->getByNik($nik);

            if(isset($data['penduduk_by_nik']['nik'])) {
                $duplicate_nik = TRUE;
            } else {
                $duplicate_nik = FALSE;
            }
        } else {
            $duplicate_nik = FALSE;
        }

        $data['penduduk_by_nik_n_username'] = $this->model('PendudukModel')->getByNikAndUsername($nik_old, $username);
        
        if(isset($data['penduduk_by_nik_n_username']['username'])) {
            $duplicate_username = TRUE;
        } else {
            $duplicate_username = FALSE;
        }

        if($nik == '' || $duplicate_nik == TRUE || $username == '' || $duplicate_username == TRUE || 
            $nama_penduduk == '' || $tempat_lahir == '' || $tgl_lahir == '' || $jenis_kelamin == '' || 
            $alamat == '' || $pekerjaan == '' || $pendidikan == '' || $agama == '' || $status_kawin == '') {

            if($nik == '') {
                Flasher::setError('NIK wajib diisi!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('NIK sudah digunakan!', 'danger', 'nik');
            }

            if($username == '') {
                Flasher::setError('Username wajib diisi!', 'danger', 'username');
            } elseif($duplicate_username == TRUE) {
                Flasher::setError('Username sudah digunakan!', 'danger', 'username');
            }

            if($nama_penduduk == '') {
                Flasher::setError('Nama penduduk wajib diisi!', 'danger', 'nama_penduduk');
            }

            if($tempat_lahir == '') {
                Flasher::setError('Tempat lahir wajib diisi!', 'danger', 'tempat_lahir');
            }

            if($tgl_lahir == '') {
                Flasher::setError('Tanggal lahir wajib diisi!', 'danger', 'tgl_lahir');
            }

            if($jenis_kelamin == '') {
                Flasher::setError('Jenis kelamin wajib dipilih!', 'danger', 'jenis_kelamin');
            }

            if($alamat == '') {
                Flasher::setError('Alamat wajib diisi!', 'danger', 'alamat');
            }

            if($pekerjaan == '') {
                Flasher::setError('Pekerjaan wajib dipilih!', 'danger', 'pekerjaan');
            }

            if($pendidikan == '') {
                Flasher::setError('Pendidikan wajib dipilih!', 'danger', 'pendidikan');
            }

            if($agama == '') {
                Flasher::setError('Agama wajib dipilih!', 'danger', 'agama');
            }

            if($status_kawin == '') {
                Flasher::setError('Status kawin wajib dipilih!', 'danger', 'status_kawin');
            }

            header('Location: '.BASEURL.'/penduduk/edit/'.$nik_old);
            exit;
        } else {
            $this->model('PendudukModel')->update($_POST);
            Flasher::setSuccess('Data penduduk berhasil diubah.', 'success');
            header('Location: '.BASEURL.'/penduduk');
            exit;
        }
    }

    public function delete($nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PendudukModel')->delete($nik);
        Flasher::setSuccess('Data penduduk berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/penduduk');
        exit;
    }

    public function print()
    {
        $data['title'] = 'Data Penduduk';
        $data['penduduk'] = $this->model('PendudukModel')->getAll();

        $this->view('penduduk/print', $data);
    }
}