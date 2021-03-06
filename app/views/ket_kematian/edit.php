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
                            <li><a href="<?= BASEURL; ?>/ketlahir">Data Surat Ket. Kematian</a></li>
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
                    <form action="<?= BASEURL; ?>/ketkematian/update" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="noMeninggal" class="form-control-label">No. Meninggal</label>
                                    <input type="text" id="noMeninggal" name="no_meninggal" class="form-control form-control-sm" value="<?= $data['penduduk_meninggal']['no_meninggal']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control form-control-sm" value="<?= $_SESSION['id']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="umur" class="form-control-label">Umur</label>
                                    <?php Flasher::error('umur'); ?>
                                    <input type="text" id="umur" name="umur" placeholder="Masukkan Umur Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk_meninggal']['umur']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="hariKematian" class="form-control-label">Hari Kematian</label>
                                    <?php Flasher::error('hari_kematian'); ?>
                                    <select data-placeholder="Pilih Hari Kematian" id="hariKematian" name="hari_kematian" class="standardSelect" tabindex="1">
                                        <option value="" label="default"></option>
                                        <option value="Senin" <?= ($data['penduduk_meninggal']['hari_kematian'] == 'Senin' ? 'selected' : ''); ?>>Senin</option>
                                        <option value="Selasa" <?= ($data['penduduk_meninggal']['hari_kematian'] == 'Selasa' ? 'selected' : ''); ?>>Selasa</option>
                                        <option value="Rabu" <?= ($data['penduduk_meninggal']['hari_kematian'] == 'Rabu' ? 'selected' : ''); ?>>Rabu</option>
                                        <option value="Kamis" <?= ($data['penduduk_meninggal']['hari_kematian'] == 'Kamis' ? 'selected' : ''); ?>>Kamis</option>
                                        <option value="Jum'at" <?= ($data['penduduk_meninggal']['hari_kematian'] == "Jum'at" ? 'selected' : ''); ?>>Jum'at</option>
                                        <option value="Sabtu" <?= ($data['penduduk_meninggal']['hari_kematian'] == 'Sabtu' ? 'selected' : ''); ?>>Sabtu</option>
                                        <option value="Minggu" <?= ($data['penduduk_meninggal']['hari_kematian'] == 'Minggu' ? 'selected' : ''); ?>>Minggu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tglKematian" class="form-control-label">Tanggal Kematian</label>
                                    <?php Flasher::error('tgl_kematian'); ?>
                                    <input type="date" id="tglKematian" name="tgl_kematian" placeholder="Masukkan Tanggal Kematian Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk_meninggal']['tgl_kematian']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="tempatKematian" class="form-control-label">Tempat Kematian</label>
                                    <?php Flasher::error('tempat_kematian'); ?>
                                    <input type="text" id="tempatKematian" name="tempat_kematian" placeholder="Masukkan Tempat Kematian Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk_meninggal']['tempat_kematian']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="penyebabKematian" class="form-control-label">Penyebab Kematian</label>
                                    <?php Flasher::error('penyebab_kematian'); ?>
                                    <input type="text" id="penyebabKematian" name="penyebab_kematian" placeholder="Masukkan Penyebab Kematian Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk_meninggal']['penyebab_kematian']; ?>" autocomplete="off">
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