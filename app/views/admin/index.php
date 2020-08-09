<!-- Content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h1>Halaman Admin</h1>
                    <?php foreach($data['admin'] as $admin) : ?>
                        <ul>
                            <li><?= $admin['username']; ?></li>
                            <li><?= $admin['nama_admin']; ?></li>
                        </ul>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->