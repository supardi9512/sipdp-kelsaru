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
                            <?php if($_SESSION['level'] == 'penduduk' && empty($data['ket_pindah'])) { ?>
                                <a href="<?= BASEURL; ?>/ketpindah/create" class="btn btn-primary float-right ml-2"><i class="fa fa-plus"></i> Add Data</a>
                            <?php } ?>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Pindah</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Pindah</th>
                                <th>Alasan Pindah</th>
                                <th>Validasi RT</th>
                                <th>Validasi RW</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['ket_pindah'] as $ket_pindah) : 

                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    
                                    $pecahkan = explode('-', $ket_pindah['tgl_pindah']);
                                        
                                    $tgl_pindah = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $ket_pindah['no_pindah']; ?></td>
                                    <td><?= $ket_pindah['nik']; ?></td>
                                    <td><?= $ket_pindah['nama_penduduk']; ?></td>
                                    <td><?= $tgl_pindah; ?></td>
                                    <td><?= $ket_pindah['alasan_pindah']; ?></td>
                                    <td><?= $ket_pindah['validasi_rt']; ?></td>
                                    <td><?= $ket_pindah['validasi_rw']; ?></td>
                                    <td class="text-center">
                                        <?php if($_SESSION['level'] == 'penduduk') { ?>
                                            <a href="<?= BASEURL; ?>/ketpindah/edit/<?= $ket_pindah['no_pindah']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                        <?php } elseif($_SESSION['level'] == 'rt' || $_SESSION['level'] == 'rw') { ?>
                                            <?php if($_SESSION['level'] == 'rt' && $ket_pindah['validasi_rt'] == 'Sudah Validasi') { ?>
                                                <a class="btn btn-success btn-sm disabled" href="#" tabindex="-1" role="button" aria-disabled="true"><i class="fa fa-check"></i> Validasi</a>
                                            <?php } elseif($_SESSION['level'] == 'rw' && $ket_pindah['validasi_rw'] == 'Sudah Validasi') { ?>
                                                <a class="btn btn-success btn-sm disabled" href="#" tabindex="-1" role="button" aria-disabled="true"><i class="fa fa-check"></i> Validasi</a>
                                            <?php } else { ?>
                                                <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $ket_pindah['no_pindah']); ?>()"><i class="fa fa-check"></i> Validasi</a>
                                            <?php } ?>
                                        <?php } ?>

                                        <?php if($ket_pindah['validasi_rt'] == 'Sudah Validasi' && $ket_pindah['validasi_rw'] == 'Sudah Validasi') { ?>
                                            <a href="<?= BASEURL; ?>/ketpindah/print/<?= $ket_pindah['no_pindah']; ?>" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
                                        <?php } else { ?>
                                            <a href="#" class="btn btn-primary btn-sm disabled" tabindex="-1" role="button" aria-disabled="true"><i class="fa fa-print"></i> Print</a>
                                        <?php } ?>
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
<?php foreach($data['ket_pindah'] as $ket_pindah) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $ket_pindah['no_pindah']); ?>() {
      swal({
        title: "Anda Yakin Ingin Memvalidasi Data Ini?",
        text: "Data yang sudah divalidasi tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/ketpindah/validasi/<?= $ket_pindah['no_pindah']; ?>"), {
            icon: "success",
          });
        } else {
          swal("Batal Validasi Data!", {
              icon: "error",
          })
        }
      });;
    }
  </script>
<?php } ?>