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
                            <li><a href="<?= BASEURL; ?>/ketpindah">Data Surat Ket. Pindah</a></li>
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
                    <form action="<?= BASEURL; ?>/ketpindah/update" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="noPindah" class="form-control-label">No. Pindah</label>
                                    <input type="text" id="noPindah" name="no_pindah" class="form-control form-control-sm" value="<?= $data['penduduk_pindah']['no_pindah']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control form-control-sm" value="<?= $_SESSION['id']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tglPindah" class="form-control-label">Tanggal Pindah</label>
                                    <?php Flasher::error('tgl_pindah'); ?>
                                    <input type="date" id="tglPindah" name="tgl_pindah" placeholder="Masukkan Tanggal Pindah Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk_pindah']['tgl_pindah']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="alasanPindah" class="form-control-label">Alasan Pindah</label>
                                    <?php Flasher::error('alasan_pindah'); ?>
                                    <input type="text" id="alasanPindah" name="alasan_pindah" placeholder="Masukkan Alasan Pindah Penduduk" class="form-control form-control-sm" value="<?= $data['penduduk_pindah']['alasan_pindah']; ?>" autocomplete="off">
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