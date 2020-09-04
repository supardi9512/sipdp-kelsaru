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
                            <?php if($_SESSION['level'] == 'penduduk') { ?>
                                <a href="<?= BASEURL; ?>/ketlahir/create" class="btn btn-primary float-right ml-2"><i class="fa fa-plus"></i> Add Data</a>
                            <?php } ?>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Lahir</th>
                                <th>NIK Pengaju</th>
                                <th>Nama Pengaju</th>
                                <th>Nama Bayi</th>
                                <th>TTL</th>
                                <th>Hari Lahir</th>
                                <th>Jam Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Berat Badan</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Validasi RT</th>
                                <th>Validasi RW</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['ket_lahir'] as $ket_lahir) : 

                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    
                                    $pecahkan = explode('-', $ket_lahir['tgl_lahir']);
                                        
                                    if($pecahkan[2] == "0000" || $pecahkan[1] == "00" || $pecahkan[0] == "00") {
                                        $tgl_lahir = $pecahkan[2] . ' ' . $pecahkan[1] . ' ' . $pecahkan[0];
                                    } else {
                                        $tgl_lahir = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                                    }
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $ket_lahir['no_lahir']; ?></td>
                                    <td><?= $ket_lahir['nik']; ?></td>
                                    <td><?= $ket_lahir['nama_penduduk']; ?></td>
                                    <td><?= $ket_lahir['nama_bayi']; ?></td>
                                    <td><?= $ket_lahir['tempat_lahir'].', '.$tgl_lahir; ?></td>
                                    <td><?= $ket_lahir['hari_lahir']; ?></td>
                                    <td><?= date('H:i', strtotime($ket_lahir['jam_lahir'])); ?> WIB</td>
                                    <td><?= $ket_lahir['jenis_kelamin']; ?></td>
                                    <td><?= str_replace('.', ',', $ket_lahir['berat_badan']).' Kg'; ?></td>
                                    <td><?= $ket_lahir['nama_ayah']; ?></td>
                                    <td><?= $ket_lahir['nama_ibu']; ?></td>
                                    <td><?= $ket_lahir['validasi_rt']; ?></td>
                                    <td><?= $ket_lahir['validasi_rw']; ?></td>
                                    <td class="text-center">
                                        <?php if($_SESSION['level'] == 'penduduk') { ?>
                                            <a href="<?= BASEURL; ?>/ketlahir/edit/<?= $ket_lahir['no_lahir']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                        <?php } elseif($_SESSION['level'] == 'rt' || $_SESSION['level'] == 'rw') { ?>
                                            <?php if($_SESSION['level'] == 'rt' && $ket_lahir['validasi_rt'] == 'Sudah Validasi') { ?>
                                                <a class="btn btn-success btn-sm disabled" href="#" tabindex="-1" role="button" aria-disabled="true"><i class="fa fa-check"></i> Validasi</a>
                                            <?php } elseif($_SESSION['level'] == 'rw' && $ket_lahir['validasi_rw'] == 'Sudah Validasi') { ?>
                                                <a class="btn btn-success btn-sm disabled" href="#" tabindex="-1" role="button" aria-disabled="true"><i class="fa fa-check"></i> Validasi</a>
                                            <?php } else { ?>
                                                <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $ket_lahir['no_lahir']); ?>()"><i class="fa fa-check"></i> Validasi</a>
                                            <?php } ?>
                                        <?php } ?>

                                        <?php if($ket_lahir['validasi_rt'] == 'Sudah Validasi' && $ket_lahir['validasi_rw'] == 'Sudah Validasi') { ?>
                                            <a href="<?= BASEURL; ?>/ketlahir/print/<?= $ket_lahir['no_lahir']; ?>" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Print</a>
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
<?php foreach($data['ket_lahir'] as $ket_lahir) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $ket_lahir['no_lahir']); ?>() {
      swal({
        title: "Anda Yakin Ingin Memvalidasi Data Ini?",
        text: "Data yang sudah divalidasi tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/ketlahir/validasi/<?= $ket_lahir['no_lahir']; ?>"), {
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