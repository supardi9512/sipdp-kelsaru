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
                            <a href="<?= BASEURL; ?>/penduduktidakmampu/print" class="btn btn-primary float-right"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Tidak Mampu</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kota - Provinsi</th>
                                <th>Pekerjaan</th>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['penduduk_tidak_mampu'] as $penduduk_tidak_mampu) : 
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $penduduk_tidak_mampu['no_tidak_mampu']; ?></td>
                                <td><?= $penduduk_tidak_mampu['nik']; ?></td>
                                <td><?= $penduduk_tidak_mampu['nama_penduduk']; ?></td>
                                <td><?= $penduduk_tidak_mampu['alamat'].' RT. '.sprintf("%03s", $penduduk_tidak_mampu['no_rt']).' RW. '.sprintf("%03s", $penduduk_tidak_mampu['no_rw']).' Kel. '.$penduduk_tidak_mampu['kelurahan'].', Kec. '.$penduduk_tidak_mampu['kecamatan']; ?></td>
                                <td><?= $penduduk_tidak_mampu['kota'].' - '.$penduduk_tidak_mampu['provinsi']; ?></td>
                                <td><?= $penduduk_tidak_mampu['pekerjaan']; ?></td>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $penduduk_tidak_mampu['no_tidak_mampu']); ?>()"><i class="fa fa-trash"></i> Delete</a>
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
<?php foreach($data['penduduk_tidak_mampu'] as $penduduk_tidak_mampu) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $penduduk_tidak_mampu['no_tidak_mampu']); ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/penduduktidakmampu/delete/<?= $penduduk_tidak_mampu['no_tidak_mampu'].'/'.$penduduk_tidak_mampu['nik']; ?>"), {
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