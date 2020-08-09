<!-- Content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><?= $data['title']; ?></h3>
                    <p><?= $data['admin']['nama_admin']; ?></p>
                    <p><?= $data['admin']['username']; ?></p>
                    <a href="<?= BASEURL; ?>/admin">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->