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
                    <form action="<?= BASEURL; ?>/penduduktetap/update" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="noTetap" class="form-control-label">No. Tetap</label>
                                    <input type="text" id="noTetap" name="no_tetap" class="form-control form-control-sm" value="<?= $data['penduduk_tetap']['no_tetap']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">Penduduk</label>
                                    <input type="hidden" name="nik_old" value="<?= $data['penduduk_tetap']['nik']; ?>">
                                    <?php Flasher::error('nik'); ?>
                                    <select data-placeholder="Pilih Penduduk" id="nik" name="nik" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <?php foreach($data['penduduk_by_id_rt'] as $penduduk) : ?>
                                            <option value="<?= $penduduk['nik']; ?>" <?= ($data['penduduk_tetap']['nik'] == $penduduk['nik'] ? 'selected' : ''); ?>><?= $penduduk['nik'].' - '.$penduduk['nama_penduduk']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tglMenetap" class="form-control-label">Tanggal Menetap</label>
                                    <?php Flasher::error('tgl_menetap'); ?>
                                    <input type="date" id="tglMenetap" name="tgl_menetap" placeholder="Masukkan Tanggal Menetap Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk_tetap']['tgl_menetap']; ?>" autocomplete="off">
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