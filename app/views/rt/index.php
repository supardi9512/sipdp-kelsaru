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
                    <div class="row mx-1">
                        <div class="col-lg-12 col-md-12">
                            <?php Flasher::success(); ?>
                        </div>
                    </div>
                    <div class="row mb-3 mx-3">
                        <div class="col-md-12 px-0">
                            <a href="<?= BASEURL; ?>/rt/create" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Add Data</a>
                        </div>
                    </div>
                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ID RT</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>RT</th>
                                <th>RW</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['rt'] as $rt) : 
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $rt['id_rt']; ?></td>
                                    <td><?= $rt['nama_rt']; ?></td>
                                    <td><?= $rt['username']; ?></td>
                                    <td><?= sprintf("%03s", $rt['no_rt']); ?></td>
                                    <td><?= sprintf("%03s", $rt['no_rw']); ?></td>
                                    <td class="text-center">
                                        <a href="<?= BASEURL; ?>/rt/edit/<?= $rt['id_rt']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                        <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $rt['id_rt']); ?>()"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<?php foreach($data['rt'] as $rt) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $rt['id_rt']); ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/rt/delete/<?= $rt['id_rt']; ?>"), {
            icon: "success",
          });
        } else {
          swal("Batal Hapus Data!", {
              icon: "error",
          })
        }
      });;
    }
  </script>
<?php } ?>