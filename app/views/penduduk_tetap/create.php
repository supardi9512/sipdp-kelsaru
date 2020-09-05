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
                            <li><a href="<?= BASEURL; ?>/penduduktetap">Data Penduduk Tetap</a></li>
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
                    <form action="<?= BASEURL; ?>/penduduktetap/store" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="noTetap" class="form-control-label">No. Tetap</label>
                                    <input type="text" id="noTetap" name="no_tetap" class="form-control form-control-sm" value="<?= $data['no_tetap_max']; ?>" readonly>
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
                                    <label for="tglMenetap" class="form-control-label">Tanggal Menetap</label>
                                    <?php Flasher::error('tgl_menetap'); ?>
                                    <input type="date" id="tglMenetap" name="tgl_menetap" placeholder="Masukkan Tanggal Menetap Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('tgl_menetap'); ?>" autocomplete="off">
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