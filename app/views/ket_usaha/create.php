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
                            <li><a href="<?= BASEURL; ?>/ketusaha">Data Surat Ket. Usaha</a></li>
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
                    <form action="<?= BASEURL; ?>/ketusaha/store" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="noUsaha" class="form-control-label">No. Usaha</label>
                                    <input type="text" id="noUsaha" name="no_usaha" class="form-control form-control-sm" value="<?= $data['no_usaha_max']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nik" class="form-control-label">NIK</label>
                                    <input type="text" id="nik" name="nik" class="form-control form-control-sm" value="<?= $_SESSION['id']; ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tglBukaUsaha" class="form-control-label">Tanggal Buka Usaha</label>
                                    <?php Flasher::error('tgl_buka_usaha'); ?>
                                    <input type="date" id="tglBukaUsaha" name="tgl_buka_usaha" placeholder="Masukkan Tanggal Usaha Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('tgl_buka_usaha'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="namaUsaha" class="form-control-label">Nama Usaha</label>
                                    <?php Flasher::error('nama_usaha'); ?>
                                    <input type="text" id="namaUsaha" name="nama_usaha" placeholder="Masukkan Nama Usaha Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('nama_usaha'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="jenisUsaha" class="form-control-label">Jenis Usaha</label>
                                    <?php Flasher::error('jenis_usaha'); ?>
                                    <input type="text" id="jenisUsaha" name="jenis_usaha" placeholder="Masukkan Nama Jenis Penduduk" class="form-control form-control-sm" value="<?php Flasher::oldData('jenis_usaha'); ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="alamatUsaha" class=" form-control-label">Alamat Usaha</label>
                                    <?php Flasher::error('alamat_usaha'); ?>
                                    <textarea name="alamat_usaha" id="alamatUsaha" rows="5" placeholder="Masukkan Alamat Usaha Penduduk" class="form-control form-control-sm"><?php Flasher::oldData('alamat_usaha'); ?></textarea>
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