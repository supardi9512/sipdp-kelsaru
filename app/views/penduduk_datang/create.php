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
                            <li><a href="<?= BASEURL; ?>/pendudukdatang">Data Penduduk Datang</a></li>
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
                    <form action="<?= BASEURL; ?>/pendudukdatang/store" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noDatang" class="form-control-label">No. Datang</label>
                                    <input type="text" id="noDatang" name="no_datang" class="form-control form-control-sm" value="<?= $data['no_datang_max']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">Penduduk</label>
                                    <?php Flasher::error('nik'); ?>
                                    <?php $old_nik = Flasher::oldData('nik', 'selected'); ?>
                                    <select data-placeholder="Pilih Penduduk" id="nik" name="nik" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <?php foreach($data['penduduk_by_id_rt'] as $penduduk) : ?>
                                            <option value="<?= $penduduk['nik']; ?>" <?= (!empty($old_nik) && $old_nik == $penduduk['nik'] ? 'selected' : ''); ?>><?= $penduduk['nik'].' - '.$penduduk['nama_penduduk']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php Flasher::unsetOldData('nik'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="tglDatang" class="form-control-label">Tanggal Datang</label>
                                    <?php Flasher::error('tgl_datang'); ?>
                                    <input type="date" id="tglDatang" name="tgl_datang" placeholder="Masukkan Tanggal Datang Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('tgl_datang'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="alamatAsal" class=" form-control-label">Alamat Asal</label>
                                    <?php Flasher::error('alamat_asal'); ?>
                                    <textarea name="alamat_asal" id="alamatAsal" rows="5" placeholder="Masukkan Alamat Asal Penduduk" class="form-control form-control-sm"><?php Flasher::oldData('alamat_asal'); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kelurahanAsal" class="form-control-label">Kelurahan Asal</label>
                                    <?php Flasher::error('kelurahan_asal'); ?>
                                    <input type="text" id="kelurahanAsal" name="kelurahan_asal" placeholder="Masukkan Kelurahan Asal Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('kelurahan_asal'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="kecamatanAsal" class="form-control-label">Kecamatan Asal</label>
                                    <?php Flasher::error('kecamatan_asal'); ?>
                                    <input type="text" id="kecamatanAsal" name="kecamatan_asal" placeholder="Masukkan Kecamatan Asal Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('kecamatan_asal'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="kotaAsal" class="form-control-label">Kota Asal</label>
                                    <?php Flasher::error('kota_asal'); ?>
                                    <input type="text" id="kotaAsal" name="kota_asal" placeholder="Masukkan Kota Asal Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('kota_asal'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="provinsiAsal" class="form-control-label">Provinsi Asal</label>
                                    <?php Flasher::error('provinsi_asal'); ?>
                                    <input type="text" id="provinsiAsal" name="provinsi_asal" placeholder="Masukkan Provinsi Asal Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('provinsi_asal'); ?>" autocomplete="off">
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