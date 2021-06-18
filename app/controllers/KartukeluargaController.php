<?php

class KartukeluargaController extends Controller {
    public function __construct()
    {
        if(!isset($_SESSION['is_login'])) {
            header('Location: '.BASEURL.'/login');
            exit;
        }
    }

    public function index()
    {
        $data['title'] = 'Data Kartu Keluarga';
        $data['kartu_keluarga'] = $this->model('KartukeluargaModel')->getAll();

        $this->view('templates/header', $data);
        $this->view('kartu_keluarga/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Tambah Data Kartu Keluarga';
        
        $data['rt'] = $this->model('RtModel')->getById($_SESSION['id']);
        $data['penduduk_by_id_rt'] = $this->model('PendudukModel')->getByIdRt($_SESSION['id']);
        
        $this->view('templates/header', $data);
        $this->view('kartu_keluarga/create', $data);
        $this->view('templates/footer');
    }

    public function store()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_kk = $_POST['no_kk'];
        $nik = $_POST['nik'];
        $alamat = $_POST['alamat'];

        $data['kartu_keluarga_by_no_kk'] = $this->model('KartukeluargaModel')->getByNoKk($no_kk);
        $data['kartu_keluarga_by_nik'] = $this->model('KartukeluargaModel')->getByNik($nik);
        $data['anggota_keluarga_by_nik'] = $this->model('AnggotakeluargaModel')->getByNik($nik);

        if(isset($data['kartu_keluarga_by_no_kk']['no_kk'])) {
            $duplicate_no_kk = TRUE;
        } else {
            $duplicate_no_kk = FALSE;
        }
        if(isset($data['kartu_keluarga_by_nik']['nik']) || isset($data['anggota_keluarga_by_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }

        if($no_kk == '' || $duplicate_no_kk == TRUE || $nik == '' || $duplicate_nik == TRUE || $alamat == '') {

            Flasher::setOldData('no_kk', $no_kk);
            Flasher::setOldData('nik', $nik);
            Flasher::setOldData('alamat', $alamat);

            if($no_kk == '') {
                Flasher::setError('No. KK wajib diisi!', 'danger', 'no_kk');
            } elseif($duplicate_no_kk == TRUE) {
                Flasher::setError('No. KK sudah digunakan!', 'danger', 'no_kk');
            }

            if($nik == '') {
                Flasher::setError('Kepala keluarga wajib dipilih!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('Kepala keluarga sudah digunakan!', 'danger', 'nik');
            }

            if($alamat == '') {
                Flasher::setError('Alamat wajib diisi!', 'danger', 'alamat');
            }

            header('Location: '.BASEURL.'/kartukeluarga/create');
            exit;
        } else {
            $this->model('KartukeluargaModel')->create($_POST);
            $this->model('PendudukModel')->updateNoKk($nik, $no_kk);

            $data['anggota_keluarga_max'] = $this->model('AnggotakeluargaModel')->getMaxNo();            
            $no_anggota = $data['anggota_keluarga_max']['no_anggota_terbesar'];
            $urutan = (int) substr($no_anggota, 3, 7);
            $urutan++;
            $huruf = "AK-";
            $data['no_anggota_max'] = $huruf . sprintf("%07s", $urutan);

            $data_anggota_keluarga = [
                'no_anggota'        => $data['no_anggota_max'],
                'no_kk'             => $no_kk,
                'nik'               => $nik,
                'status_hubungan'   => 'Kepala Keluarga'
            ];

            $this->model('AnggotakeluargaModel')->create($data_anggota_keluarga);

            Flasher::setSuccess('Data kartu keluarga berhasil ditambah.', 'success');
            Flasher::unsetOldData('no_kk');
            Flasher::unsetOldData('nik');
            Flasher::unsetOldData('alamat');
            
            header('Location: '.BASEURL.'/kartukeluarga');
            exit;
        }
    }

    public function store_anggota()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_kk = $_POST['no_kk'];
        $nik = $_POST['nik'];
        $status_hubungan = $_POST['status_hubungan'];

        $data['anggota_keluarga_by_nik'] = $this->model('AnggotakeluargaModel')->getByNik($nik);

        if(isset($data['anggota_keluarga_by_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }

        if($nik == '' || $duplicate_nik == TRUE || $status_hubungan == '') {
            Flasher::setOldData('nik', $nik);
            Flasher::setOldData('status_hubungan', $status_hubungan);

            if($nik == '') {
                Flasher::setError('Anggota keluarga wajib dipilih!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('Anggota keluarga sudah digunakan!', 'danger', 'nik');
            }

            if($status_hubungan == '') {
                Flasher::setError('Status hubungan wajib dipilih!', 'danger', 'status_hubungan');
            }

            header('Location: '.BASEURL.'/kartukeluarga/detail/'.$no_kk);
            exit;
        } else {
            $data['anggota_keluarga_max'] = $this->model('AnggotakeluargaModel')->getMaxNo();            
            $no_anggota = $data['anggota_keluarga_max']['no_anggota_terbesar'];
            $urutan = (int) substr($no_anggota, 3, 7);
            $urutan++;
            $huruf = "AK-";
            $data['no_anggota_max'] = $huruf . sprintf("%07s", $urutan);

            $data_anggota_keluarga = [
                'no_anggota'        => $data['no_anggota_max'],
                'no_kk'             => $no_kk,
                'nik'               => $nik,
                'status_hubungan'   => $status_hubungan
            ];

            $this->model('AnggotakeluargaModel')->create($data_anggota_keluarga);
            $this->model('PendudukModel')->updateNoKk($nik, $no_kk);

            Flasher::setSuccess('Data anggota keluarga berhasil ditambah.', 'success');
            Flasher::unsetOldData('nik');
            Flasher::unsetOldData('status_hubungan');
            
            header('Location: '.BASEURL.'/kartukeluarga/detail/'.$no_kk);
            exit;
        }
    }

    public function edit($no_kk)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $data['title'] = 'Edit Data Kartu Keluarga';
        
        $data['kartu_keluarga'] = $this->model('KartukeluargaModel')->getByNoKk($no_kk);
        $data['rt'] = $this->model('RtModel')->getById($_SESSION['id']);
        $data['penduduk_by_id_rt'] = $this->model('PendudukModel')->getByIdRt($_SESSION['id']);

        $this->view('templates/header', $data);
        $this->view('kartu_keluarga/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $no_kk = $_POST['no_kk'];
        $nik = $_POST['nik'];
        $nik_old = $_POST['nik_old'];
        $alamat = $_POST['alamat'];
        
        $data['kartu_keluarga_by_no_kk_n_nik'] = $this->model('KartukeluargaModel')->getByNoKkAndNik($no_kk, $nik);
        $data['anggota_keluarga_by_no_kk_n_nik'] = $this->model('AnggotakeluargaModel')->getByNoKkAndNik($no_kk, $nik);

        if(isset($data['kartu_keluarga_by_no_kk_n_nik']['nik']) || isset($data['anggota_keluarga_by_no_kk_n_nik']['nik'])) {
            $duplicate_nik = TRUE;
        } else {
            $duplicate_nik = FALSE;
        }

        if($nik == '' || $duplicate_nik == TRUE || $alamat == '') {

            if($nik == '') {
                Flasher::setError('Kepala keluarga wajib dipilih!', 'danger', 'nik');
            } elseif($duplicate_nik == TRUE) {
                Flasher::setError('Kepala keluarga sudah digunakan!', 'danger', 'nik');
            }

            if($alamat == '') {
                Flasher::setError('Alamat wajib diisi!', 'danger', 'alamat');
            }

            header('Location: '.BASEURL.'/kartukeluarga/edit/'.$no_kk);
            exit;
        } else {
            $this->model('KartukeluargaModel')->update($_POST);
            $this->model('AnggotakeluargaModel')->updateKepalaKeluarga($_POST);
            $this->model('PendudukModel')->updateNoKk($nik_old, NULL);
            $this->model('PendudukModel')->updateNoKk($nik, $no_kk);

            Flasher::setSuccess('Data kartu keluarga berhasil diubah.', 'success');
            header('Location: '.BASEURL.'/kartukeluarga');
            exit;
        }
    }

    public function delete($no_kk, $nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PendudukModel')->updateNoKkByNoKk($no_kk, NULL);
        $this->model('AnggotakeluargaModel')->deleteByNoKk($no_kk);
        $this->model('KartukeluargaModel')->delete($no_kk);

        Flasher::setSuccess('Data kartu keluarga berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/kartukeluarga');
        exit;
    }

    public function delete_anggota($no_anggota, $no_kk, $nik)
    {
        if($_SESSION['level'] != 'rt') {
            header('Location: '.BASEURL);
            exit;
        }

        $this->model('PendudukModel')->updateNoKk($nik, NULL);
        $this->model('AnggotakeluargaModel')->delete($no_anggota);

        Flasher::setSuccess('Data anggota keluarga berhasil dihapus.', 'success');
        header('Location: '.BASEURL.'/kartukeluarga/detail/'.$no_kk);
        exit;
    }

    public function detail($no_kk)
    {
        $data['title'] = 'Detail Anggota Keluarga';
        $data['kartu_keluarga'] = $this->model('KartukeluargaModel')->getByNoKk($no_kk);
        $data['penduduk_by_id_rt'] = $this->model('PendudukModel')->getByIdRt($_SESSION['id']);
        $data['anggota_keluarga'] = $this->model('AnggotakeluargaModel')->getByNoKk($no_kk);

        $this->view('templates/header', $data);
        $this->view('kartu_keluarga/detail', $data);
        $this->view('templates/footer');
    }

    public function print($no_kk)
    {
        $data['title'] = 'Data Kartu Keluarga';
        $data['kartu_keluarga'] = $this->model('KartukeluargaModel')->getByNoKk($no_kk);
        $data['anggota_keluarga'] = $this->model('AnggotakeluargaModel')->getByNoKk($no_kk);

        $this->view('kartu_keluarga/print', $data);
    }
}