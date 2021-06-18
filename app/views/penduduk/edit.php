<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1><?= $data['title']; ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="<?= BASEURL; ?>">Home</a></li>
                            <li><a href="<?= BASEURL; ?>/penduduk">Data Penduduk</a></li>
                            <li class="active"><?= $data['title']; ?></li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= BASEURL; ?>/penduduk/update" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">NIK</label>
                                    <?php Flasher::error('nik'); ?>
                                    <input type="hidden" name="nik_old" value="<?= $data['penduduk']['nik']; ?>">
                                    <input type="number" id="nik" name="nik" min="1" max="9999999999999999" placeholder="Masukkan NIK" class="form-control form-control-sm" value="<?= $data['penduduk']['nik']; ?>" autocomplete="off" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="namaPenduduk" class="form-control-label">Nama</label>
                                    <?php Flasher::error('nama_penduduk'); ?>
                                    <input type="text" id="namaPenduduk" name="nama_penduduk" placeholder="Masukkan Nama Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk']['nama_penduduk']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-control-label">Username</label>
                                    <?php Flasher::error('username'); ?>
                                    <input type="text" id="username" name="username" placeholder="Masukkan Username Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk']['username']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password <span class="text-sm text-muted">(Kosongkan jika tidak ingin diubah!)</span></label>
                                    <?php Flasher::error('password'); ?>
                                    <input type="password" id="password" name="password" placeholder="Masukkan Password Penduduk" class="form-control form-control-sm" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="tempatLahir" class="form-control-label">Tempat Lahir</label>
                                    <?php Flasher::error('tempat_lahir'); ?>
                                    <input type="text" id="tempatLahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk']['tempat_lahir']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="tglLahir" class="form-control-label">Tanggal Lahir</label>
                                    <?php Flasher::error('tgl_lahir'); ?>
                                    <input type="date" id="tglLahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk']['tgl_lahir']; ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="alamat" class=" form-control-label">Alamat</label>
                                    <?php Flasher::error('alamat'); ?>
                                    <textarea name="alamat" id="alamat" rows="5" placeholder="Masukkan Alamat Penduduk" class="form-control form-control-sm"><?= $data['penduduk']['alamat']; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="idRtIdRw" class="form-control-label">RT/RW</label>
                                    <input type="hidden" name="id_rt_id_rw" value="<?= $data['rt']['id_rt'].'/'.$data['rt']['id_rw']; ?>">
                                    <input type="text" id="idRtIdRw" class="form-control form-control-sm" value="<?= sprintf("%03s", $data['rt']['no_rt']).'/'.sprintf("%03s", $data['rt']['no_rw']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kelurahan" class="form-control-label">Kelurahan</label>
                                    <input type="text" id="kelurahan" name="kelurahan" class="form-control form-control-sm" value="Sawah Baru" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kecamatan" class="form-control-label">Kecamatan</label>
                                    <input type="text" id="kecamatan" name="kecamatan" class="form-control form-control-sm" value="Ciputat" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="kota" class="form-control-label">Kota</label>
                                    <input type="text" id="kota" name="kota" class="form-control form-control-sm" value="Tangerang Selatan" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="provinsi" class="form-control-label">Provinsi</label>
                                    <input type="text" id="provinsi" name="provinsi" class="form-control form-control-sm" value="Banten" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="jenisKelamin" class="form-control-label">Jenis Kelamin</label>
                                    <?php Flasher::error('jenis_kelamin'); ?>
                                    <select data-placeholder="Pilih Jenis Kelamin" id="jenisKelamin" name="jenis_kelamin" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Laki-laki" <?= ($data['penduduk']['jenis_kelamin'] == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= ($data['penduduk']['jenis_kelamin'] == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan" class="form-control-label">Pekerjaan</label>
                                    <?php Flasher::error('pekerjaan'); ?>
                                    <select data-placeholder="Pilih Pekerjaan" id="pekerjaan" name="pekerjaan" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Belum/Tidak Bekerja" <?= ($data['penduduk']['pekerjaan'] == 'Belum/Tidak Bekerja' ? 'selected' : ''); ?>>Belum/Tidak Bekerja</option>
                                        <option value="Mahasiswa/Pelajar" <?= ($data['penduduk']['pekerjaan'] == 'Mahasiswa/Pelajar' ? 'selected' : ''); ?>>Mahasiswa/Pelajar</option>
                                        <option value="Mengurus Rumah Tangga" <?= ($data['penduduk']['pekerjaan'] == 'Mengurus Rumah Tangga' ? 'selected' : ''); ?>>Mengurus Rumah Tangga</option>
                                        <option value="Pegawai Negeri Sipil" <?= ($data['penduduk']['pekerjaan'] == 'Pegawai Negeri Sipil' ? 'selected' : ''); ?>>Pegawai Negeri Sipil</option>
                                        <option value="Karyawan Swasta" <?= ($data['penduduk']['pekerjaan'] == 'Karyawan Swasta' ? 'selected' : ''); ?>>Karyawan Swasta</option>
                                        <option value="Wiraswasta" <?= ($data['penduduk']['pekerjaan'] == 'Wiraswasta' ? 'selected' : ''); ?>>Wiraswasta</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pendidikan" class="form-control-label">Pendidikan</label>
                                    <?php Flasher::error('pendidikan'); ?>
                                    <select data-placeholder="Pilih Pendidikan" id="pendidikan" name="pendidikan" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="SD/Sederajat" <?= ($data['penduduk']['pendidikan'] == 'SD/Sederajat' ? 'selected' : ''); ?>>SD/Sederajat</option>
                                        <option value="SMP/Sederajat" <?= ($data['penduduk']['pendidikan'] == 'SMP/Sederajat' ? 'selected' : ''); ?>>SMP/Sederajat</option>
                                        <option value="SLTA/Sederajat" <?= ($data['penduduk']['pendidikan'] == 'SLTA/Sederajat' ? 'selected' : ''); ?>>SLTA/Sederajat</option>
                                        <option value="D1" <?= ($data['penduduk']['pendidikan'] == 'D1' ? 'selected' : ''); ?>>D1</option>
                                        <option value="D2" <?= ($data['penduduk']['pendidikan'] == 'D2' ? 'selected' : ''); ?>>D2</option>
                                        <option value="D3" <?= ($data['penduduk']['pendidikan'] == 'D3' ? 'selected' : ''); ?>>D3</option>
                                        <option value="S1" <?= ($data['penduduk']['pendidikan'] == 'S1' ? 'selected' : ''); ?>>S1</option>
                                        <option value="S2" <?= ($data['penduduk']['pendidikan'] == 'S2' ? 'selected' : ''); ?>>S2</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="agama" class="form-control-label">Agama</label>
                                    <?php Flasher::error('agama'); ?>
                                    <select data-placeholder="Pilih Agama" id="agama" name="agama" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Islam" <?= ($data['penduduk']['agama'] == 'Islam' ? 'selected' : ''); ?>>Islam</option>
                                        <option value="Protestan" <?= ($data['penduduk']['agama'] == 'Protestan' ? 'selected' : ''); ?>>Protestan</option>
                                        <option value="Katolik" <?= ($data['penduduk']['agama'] == 'Katolik' ? 'selected' : ''); ?>>Katolik</option>
                                        <option value="Hindu" <?= ($data['penduduk']['agama'] == 'Hindu' ? 'selected' : ''); ?>>Hindu</option>
                                        <option value="Budha" <?= ($data['penduduk']['agama'] == 'Budha' ? 'selected' : ''); ?>>Budha</option>
                                        <option value="Konghucu" <?= ($data['penduduk']['agama'] == 'Konghucu' ? 'selected' : ''); ?>>Konghucu</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="statusKawin" class="form-control-label">Status Kawin</label>
                                    <?php Flasher::error('status_kawin'); ?>
                                    <select data-placeholder="Pilih Status Kawin" id="statusKawin" name="status_kawin" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Belum Kawin" <?= ($data['penduduk']['status_kawin'] == 'Belum Kawin' ? 'selected' : ''); ?>>Belum Kawin</option>
                                        <option value="Sudah Kawin" <?= ($data['penduduk']['status_kawin'] == 'Sudah Kawin' ? 'selected' : ''); ?>>Sudah Kawin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions form-group float-right">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-floppy-o"></i> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->