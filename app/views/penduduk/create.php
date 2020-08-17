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
                    <form action="<?= BASEURL; ?>/penduduk/store" method="post">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">NIK</label>
                                    <?php Flasher::error('nik'); ?>
                                    <input type="number" id="nik" name="nik" min="1" max="9999999999999999" placeholder="Masukkan NIK" class="form-control form-control-sm" value="<?php Flasher::oldData('nik'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="noKk" class="form-control-label">No. KK</label>
                                    <?php Flasher::error('no_kk'); ?>
                                    <input type="number" id="noKk" name="no_kk" min="1" max="9999999999999999" placeholder="Masukkan No. KK" class="form-control form-control-sm" value="<?php Flasher::oldData('no_kk'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="namaPenduduk" class="form-control-label">Nama</label>
                                    <?php Flasher::error('nama_penduduk'); ?>
                                    <input type="text" id="namaPenduduk" name="nama_penduduk" placeholder="Masukkan Nama Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('nama_penduduk'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="username" class="form-control-label">Username</label>
                                    <?php Flasher::error('username'); ?>
                                    <input type="text" id="username" name="username" placeholder="Masukkan Username Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('username'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="form-control-label">Password</label>
                                    <?php Flasher::error('password'); ?>
                                    <input type="password" id="password" name="password" placeholder="Masukkan Password Penduduk" class="form-control form-control-sm" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="tempatLahir" class="form-control-label">Tempat Lahir</label>
                                    <?php Flasher::error('tempat_lahir'); ?>
                                    <input type="text" id="tempatLahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('tempat_lahir'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="tglLahir" class="form-control-label">Tanggal Lahir</label>
                                    <?php Flasher::error('tgl_lahir'); ?>
                                    <input type="date" id="tglLahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('tgl_lahir'); ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="alamat" class=" form-control-label">Alamat</label>
                                    <?php Flasher::error('alamat'); ?>
                                    <textarea name="alamat" id="alamat" rows="5" placeholder="Masukkan Alamat Penduduk" class="form-control form-control-sm"><?php Flasher::oldData('alamat'); ?></textarea>
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
                                    <?php $old_jenis_kelamin = Flasher::oldData('jenis_kelamin', 'selected'); ?>
                                    <select data-placeholder="Pilih Jenis Kelamin" id="jenisKelamin" name="jenis_kelamin" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Laki-laki" <?= (!empty($old_jenis_kelamin) && $old_jenis_kelamin == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                                        <option value="Perempuan" <?= (!empty($old_jenis_kelamin) && $old_jenis_kelamin == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                                    </select>
                                    <?php Flasher::unsetOldData('jenis_kelamin'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="pekerjaan" class="form-control-label">Pekerjaan</label>
                                    <?php Flasher::error('pekerjaan'); ?>
                                    <?php $old_pekerjaan = Flasher::oldData('pekerjaan', 'selected'); ?>
                                    <select data-placeholder="Pilih Pekerjaan" id="pekerjaan" name="pekerjaan" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Belum/Tidak Bekerja" <?= (!empty($old_pekerjaan) && $old_pekerjaan == 'Belum/Tidak Bekerja' ? 'selected' : ''); ?>>Belum/Tidak Bekerja</option>
                                        <option value="Mahasiswa/Pelajar" <?= (!empty($old_pekerjaan) && $old_pekerjaan == 'Mahasiswa/Pelajar' ? 'selected' : ''); ?>>Mahasiswa/Pelajar</option>
                                        <option value="Mengurus Rumah Tangga" <?= (!empty($old_pekerjaan) && $old_pekerjaan == 'Mengurus Rumah Tangga' ? 'selected' : ''); ?>>Mengurus Rumah Tangga</option>
                                        <option value="Pegawai Negeri Sipil" <?= (!empty($old_pekerjaan) && $old_pekerjaan == 'Pegawai Negeri Sipil' ? 'selected' : ''); ?>>Pegawai Negeri Sipil</option>
                                        <option value="Karyawan Swasta" <?= (!empty($old_pekerjaan) && $old_pekerjaan == 'Karyawan Swasta' ? 'selected' : ''); ?>>Karyawan Swasta</option>
                                        <option value="Wiraswasta" <?= (!empty($old_pekerjaan) && $old_pekerjaan == 'Wiraswasta' ? 'selected' : ''); ?>>Wiraswasta</option>
                                    </select>
                                    <?php Flasher::unsetOldData('pekerjaan'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="pendidikan" class="form-control-label">Pendidikan</label>
                                    <?php Flasher::error('pendidikan'); ?>
                                    <?php $old_pendidikan = Flasher::oldData('pendidikan', 'selected'); ?>
                                    <select data-placeholder="Pilih Pendidikan" id="pendidikan" name="pendidikan" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="SD/Sederajat" <?= (!empty($old_pendidikan) && $old_pendidikan == 'SD/Sederajat' ? 'selected' : ''); ?>>SD/Sederajat</option>
                                        <option value="SMP/Sederajat" <?= (!empty($old_pendidikan) && $old_pendidikan == 'SMP/Sederajat' ? 'selected' : ''); ?>>SMP/Sederajat</option>
                                        <option value="SLTA/Sederajat" <?= (!empty($old_pendidikan) && $old_pendidikan == 'SLTA/Sederajat' ? 'selected' : ''); ?>>SLTA/Sederajat</option>
                                        <option value="D1" <?= (!empty($old_pendidikan) && $old_pendidikan == 'D1' ? 'selected' : ''); ?>>D1</option>
                                        <option value="D2" <?= (!empty($old_pendidikan) && $old_pendidikan == 'D2' ? 'selected' : ''); ?>>D2</option>
                                        <option value="D3" <?= (!empty($old_pendidikan) && $old_pendidikan == 'D3' ? 'selected' : ''); ?>>D3</option>
                                        <option value="S1" <?= (!empty($old_pendidikan) && $old_pendidikan == 'S1' ? 'selected' : ''); ?>>S1</option>
                                        <option value="S2" <?= (!empty($old_pendidikan) && $old_pendidikan == 'S2' ? 'selected' : ''); ?>>S2</option>
                                    </select>
                                    <?php Flasher::unsetOldData('pendidikan'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="agama" class="form-control-label">Agama</label>
                                    <?php Flasher::error('agama'); ?>
                                    <?php $old_agama = Flasher::oldData('agama', 'selected'); ?>
                                    <select data-placeholder="Pilih Agama" id="agama" name="agama" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Islam" <?= (!empty($old_agama) && $old_agama == 'Islam' ? 'selected' : ''); ?>>Islam</option>
                                        <option value="Protestan" <?= (!empty($old_agama) && $old_agama == 'Protestan' ? 'selected' : ''); ?>>Protestan</option>
                                        <option value="Katolik" <?= (!empty($old_agama) && $old_agama == 'Katolik' ? 'selected' : ''); ?>>Katolik</option>
                                        <option value="Hindu" <?= (!empty($old_agama) && $old_agama == 'Hindu' ? 'selected' : ''); ?>>Hindu</option>
                                        <option value="Budha" <?= (!empty($old_agama) && $old_agama == 'Budha' ? 'selected' : ''); ?>>Budha</option>
                                        <option value="Konghucu" <?= (!empty($old_agama) && $old_agama == 'Konghucu' ? 'selected' : ''); ?>>Konghucu</option>
                                    </select>
                                    <?php Flasher::unsetOldData('agama'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="statusKawin" class="form-control-label">Status Kawin</label>
                                    <?php Flasher::error('status_kawin'); ?>
                                    <?php $old_status_kawin = Flasher::oldData('status_kawin', 'selected'); ?>
                                    <select data-placeholder="Pilih Status Kawin" id="statusKawin" name="status_kawin" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Belum Kawin" <?= (!empty($old_status_kawin) && $old_status_kawin == 'Belum Kawin' ? 'selected' : ''); ?>>Belum Kawin</option>
                                        <option value="Sudah Kawin" <?= (!empty($old_status_kawin) && $old_status_kawin == 'Sudah Kawin' ? 'selected' : ''); ?>>Sudah Kawin</option>
                                    </select>
                                    <?php Flasher::unsetOldData('status_kawin'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions form-group float-right">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-floppy-o"></i> Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->