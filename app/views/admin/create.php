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
                            <li><a href="<?= BASEURL; ?>/admin">Data Admin</a></li>
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
                    <form action="<?= BASEURL; ?>/admin/store" method="post">
                        <div class="form-group">
                            <label for="idAdmin" class="form-control-label">ID Admin</label>
                            <input type="text" id="idAdmin" name="id_admin" class="form-control form-control-sm" value="<?= $data['id_admin_max']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namaAdmin" class="form-control-label">Nama</label>
                            <?php Flasher::error('nama_admin'); ?>
                            <input type="text" id="namaAdmin" name="nama_admin" placeholder="Masukkan Nama Admin" class="form-control form-control-sm" value="<?php Flasher::oldData('nama_admin'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-control-label">Username</label>
                            <?php Flasher::error('username'); ?>
                            <input type="text" id="username" name="username" placeholder="Masukkan Username Admin" class="form-control form-control-sm" value="<?php Flasher::oldData('username'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <?php Flasher::error('password'); ?>
                            <input type="password" id="password" name="password" placeholder="Masukkan Password Admin" class="form-control form-control-sm" autocomplete="off">
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