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
                            <?php if($_SESSION['level'] == 'rt') { ?>
                                <a href="<?= BASEURL; ?>/kartukeluarga/create" class="btn btn-primary float-right ml-2"><i class="fa fa-plus"></i> Add Data</a>
                            <?php } ?>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. KK</th>
                                <th>Nama Kepala Keluarga</th>
                                <th>Alamat</th>
                                <th>Kota - Provinsi</th>
                                <th>Anggota KK</th>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['kartu_keluarga'] as $kartu_keluarga) : 
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $kartu_keluarga['no_kk']; ?></td>
                                    <td><?= $kartu_keluarga['nama_penduduk']; ?></td>
                                    <td><?= $kartu_keluarga['alamat'].' RT. '.sprintf("%03s", $kartu_keluarga['no_rt']).' RW. '.sprintf("%03s", $kartu_keluarga['no_rw']).' Kel. '.$kartu_keluarga['kelurahan'].', Kec. '.$kartu_keluarga['kecamatan']; ?></td>
                                    <td><?= $kartu_keluarga['kota'].' - '.$kartu_keluarga['provinsi']; ?></td>
                                    <td class="text-center">
                                        <a href="<?= BASEURL; ?>/kartukeluarga/detail/<?= $kartu_keluarga['no_kk']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-users"></i> Detail</a>
                                    </td>
                                    <?php if($_SESSION['level'] == 'rt') { ?>
                                        <td class="text-center">
                                            <a href="<?= BASEURL; ?>/kartukeluarga/edit/<?= $kartu_keluarga['no_kk']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= $kartu_keluarga['no_kk']; ?>()"><i class="fa fa-trash"></i> Delete</a>
                                        </td>
                                    <?php } ?>
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
<?php foreach($data['kartu_keluarga'] as $kartu_keluarga) { ?>
  <script type="text/javascript">
    function sweet_<?= $kartu_keluarga['no_kk']; ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/kartukeluarga/delete/<?= $kartu_keluarga['no_kk'].'/'.$kartu_keluarga['nik']; ?>"), {
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