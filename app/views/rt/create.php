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
                            <li><a href="<?= BASEURL; ?>/rw">Data Ketua RT</a></li>
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
                    <form action="<?= BASEURL; ?>/rt/store" method="post">
                        <div class="form-group">
                            <label for="idRt" class="form-control-label">ID RT</label>
                            <input type="text" id="idRt" name="id_rt" class="form-control form-control-sm" value="<?= $data['id_rt_max']; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="namaRt" class="form-control-label">Nama</label>
                            <?php Flasher::error('nama_rt'); ?>
                            <input type="text" id="namaRt" name="nama_rt" placeholder="Masukkan Nama Ketua RT" class="form-control form-control-sm" value="<?php Flasher::oldData('nama_rt'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="noRt" class="form-control-label">RT</label>
                            <?php Flasher::error('no_rt'); ?>
                            <input type="number" id="noRt" name="no_rt" min="001" max="999" placeholder="Masukkan Nomor RT" class="form-control form-control-sm" value="<?php Flasher::oldData('no_rt'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="idRw" class="form-control-label">RW</label>
                            <?php Flasher::error('id_rw'); ?>
                            <?php $old_id_rw = Flasher::oldData('id_rw', 'selected'); ?>
                            <select data-placeholder="Pilih RW" id="idRw" name="id_rw" class="standardSelect" tabindex="1">
                                <option value="" label="default"></option>
                                <?php foreach($data['rw'] as $rw) : ?>
                                    <option value="<?= $rw['id_rw']; ?>" <?= (!empty($old_id_rw) && $old_id_rw == $rw['id_rw'] ? 'selected' : ''); ?>><?= sprintf("%03s", $rw['no_rw']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php Flasher::unsetOldData('id_rw'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username" class="form-control-label">Username</label>
                            <?php Flasher::error('username'); ?>
                            <input type="text" id="username" name="username" placeholder="Masukkan Username Ketua RT" class="form-control form-control-sm" value="<?php Flasher::oldData('username'); ?>" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <?php Flasher::error('password'); ?>
                            <input type="password" id="password" name="password" placeholder="Masukkan Password Ketua RT" class="form-control form-control-sm" autocomplete="off">
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