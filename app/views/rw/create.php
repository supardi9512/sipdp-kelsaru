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
                            <li><a href="<?= BASEURL; ?>/rw">Data Ketua RW</a></li>
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
                    <form action="<?= BASEURL; ?>/rw/store" method="post">
                        <div class="form-group">
                            <label for="idRw" class="form-control-label">ID RW</label>
                            <input type="text" id="idRw" name="id_rw" class="form-control" value="<?= $data['id_rw_max']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namaRw" class="form-control-label">Nama</label>
                            <?php Flasher::error('nama_rw'); ?>
                            <input type="text" id="namaRw" name="nama_rw" placeholder="Masukkan Nama Ketua RW" class="form-control" value="<?php Flasher::oldData('nama_rw'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="noRw" class="form-control-label">RW</label>
                            <?php Flasher::error('no_rw'); ?>
                            <input type="number" id="noRw" name="no_rw" min="001" max="999" placeholder="Masukkan Nomor RW" class="form-control" value="<?php Flasher::oldData('no_rw'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-control-label">Username</label>
                            <?php Flasher::error('username'); ?>
                            <input type="text" id="username" name="username" placeholder="Masukkan Username RW" class="form-control" value="<?php Flasher::oldData('username'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <?php Flasher::error('password'); ?>
                            <input type="password" id="password" name="password" placeholder="Masukkan Password RW" class="form-control" autocomplete="off">
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