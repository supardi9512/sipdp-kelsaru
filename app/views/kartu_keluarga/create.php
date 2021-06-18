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
                            <li><a href="<?= BASEURL; ?>/kartukeluarga">Data Kartu Keluarga</a></li>
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
                    <form action="<?= BASEURL; ?>/kartukeluarga/store" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noKk" class="form-control-label">No. KK</label>
                                    <?php Flasher::error('no_kk'); ?>
                                    <input type="number" id="noKk" name="no_kk" min="1" max="9999999999999999" placeholder="Masukkan No. KK" class="form-control form-control-sm" value="<?php Flasher::oldData('no_kk'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">Kepala Keluarga</label>
                                    <?php Flasher::error('nik'); ?>
                                    <?php $old_nik = Flasher::oldData('nik', 'selected'); ?>
                                    <select data-placeholder="Pilih Kepala Keluarga" id="nik" name="nik" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <?php foreach($data['penduduk_by_id_rt'] as $penduduk) : ?>
                                            <option value="<?= $penduduk['nik']; ?>" <?= (!empty($old_nik) && $old_nik == $penduduk['nik'] ? 'selected' : ''); ?>><?= $penduduk['nik'].' - '.$penduduk['nama_penduduk']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?php Flasher::unsetOldData('nik'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="alamat" class=" form-control-label">Alamat</label>
                                    <?php Flasher::error('alamat'); ?>
                                    <textarea name="alamat" id="alamat" rows="5" placeholder="Masukkan Alamat Penduduk" class="form-control form-control-sm"><?php Flasher::oldData('alamat'); ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
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