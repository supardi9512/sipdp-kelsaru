<!-- Content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3><?= $data['title']; ?></h3>
                    <ul class="list-group">
                        <?php foreach($data['admin'] as $admin) : ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= $admin['nama_admin']; ?>
                                <a href="<?= BASEURL; ?>/admin/detail/<?= $admin['id_admin']; ?>" class="badge badge-primary">Detail</a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->