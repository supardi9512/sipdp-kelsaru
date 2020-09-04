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
                            <li><a href="<?= BASEURL; ?>/ketlahir">Data Surat Ket. Lahir</a></li>
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
                    <form action="<?= BASEURL; ?>/ketlahir/store" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" name="nik" value="<?= $_SESSION['id']; ?>">
                                <div class="form-group">
                                    <label for="noLahir" class="form-control-label">No. Lahir</label>
                                    <input type="text" id="noLahir" name="no_lahir" class="form-control form-control-sm" value="<?= $data['no_lahir_max']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="namaBayi" class="form-control-label">Nama Bayi</label>
                                    <?php Flasher::error('nama_bayi'); ?>
                                    <input type="text" id="namaBayi" name="nama_bayi" placeholder="Masukkan Nama Bayi" class="form-control form-control-sm" value="<?php Flasher::oldData('nama_bayi'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="hariLahir" class="form-control-label">Hari Lahir</label>
                                    <?php Flasher::error('hari_lahir'); ?>
                                    <?php $old_hari_lahir = Flasher::oldData('hari_lahir', 'selected'); ?>
                                    <select data-placeholder="Pilih Hari Lahir" id="hariLahir" name="hari_lahir" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Senin" <?= (!empty($old_hari_lahir) && $old_hari_lahir == 'Senin' ? 'selected' : ''); ?>>Senin</option>
                                        <option value="Selasa" <?= (!empty($old_hari_lahir) && $old_hari_lahir == 'Selasa' ? 'selected' : ''); ?>>Selasa</option>
                                        <option value="Rabu" <?= (!empty($old_hari_lahir) && $old_hari_lahir == 'Rabu' ? 'selected' : ''); ?>>Rabu</option>
                                        <option value="Kamis" <?= (!empty($old_hari_lahir) && $old_hari_lahir == 'Kamis' ? 'selected' : ''); ?>>Kamis</option>
                                        <option value="Jum'at" <?= (!empty($old_hari_lahir) && $old_hari_lahir == "Jum'at" ? 'selected' : ''); ?>>Jum'at</option>
                                        <option value="Sabtu" <?= (!empty($old_hari_lahir) && $old_hari_lahir == 'Sabtu' ? 'selected' : ''); ?>>Sabtu</option>
                                        <option value="Minggu" <?= (!empty($old_hari_lahir) && $old_hari_lahir == 'Minggu' ? 'selected' : ''); ?>>Minggu</option>
                                    </select>
                                    <?php Flasher::unsetOldData('hari_lahir'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="jamLahir" class="form-control-label">Jam Lahir</label>
                                    <?php Flasher::error('jam_lahir'); ?>
                                    <input type="time" id="jamLahir" name="jam_lahir" placeholder="Masukkan Jam Lahir Bayi" class="form-control form-control-sm" value="<?php Flasher::oldData('jam_lahir'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="tglLahir" class="form-control-label">Tanggal Lahir</label>
                                    <?php Flasher::error('tgl_lahir'); ?>
                                    <input type="date" id="tglLahir" name="tgl_lahir" placeholder="Masukkan Tanggal Lahir Bayi" class="form-control form-control-sm" value="<?php Flasher::oldData('tgl_lahir'); ?>" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tempatLahir" class="form-control-label">Tempat Lahir</label>
                                    <?php Flasher::error('tempat_lahir'); ?>
                                    <input type="text" id="tempatLahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir Bayi" class="form-control form-control-sm" value="<?php Flasher::oldData('tempat_lahir'); ?>" autocomplete="off">
                                </div>
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
                                    <label for="beratBadan" class="form-control-label">Berat Badan</label>
                                    <?php Flasher::error('berat_badan'); ?>
                                    <input type="number" id="beratBadan" name="berat_badan" step="0.1" min="0" max="6" placeholder="Masukkan Berat Badan Bayi" class="form-control form-control-sm" value="<?php Flasher::oldData('berat_badan'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="namaAyah" class="form-control-label">Nama Ayah</label>
                                    <?php Flasher::error('nama_ayah'); ?>
                                    <input type="text" id="namaAyah" name="nama_ayah" placeholder="Masukkan Nama Ayah Bayi" class="form-control form-control-sm" value="<?php Flasher::oldData('nama_ayah'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="namaIbu" class="form-control-label">Nama Ibu</label>
                                    <?php Flasher::error('nama_ibu'); ?>
                                    <input type="text" id="namaIbu" name="nama_ibu" placeholder="Masukkan Nama Ibu Bayi" class="form-control form-control-sm" value="<?php Flasher::oldData('nama_ibu'); ?>" autocomplete="off">
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