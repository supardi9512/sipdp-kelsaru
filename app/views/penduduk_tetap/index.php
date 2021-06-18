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
                                <a href="<?= BASEURL; ?>/penduduktetap/create" class="btn btn-primary float-right ml-2"><i class="fa fa-plus"></i> Add Data</a>
                            <?php } ?>
                            <a href="<?= BASEURL; ?>/penduduktetap/print" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Print</a>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Tetap</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Menetap</th>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['penduduk_tetap'] as $penduduk_tetap) : 

                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    
                                    $pecahkan = explode('-', $penduduk_tetap['tgl_menetap']);
                                        
                                    if($pecahkan[2] == "0000" || $pecahkan[1] == "00" || $pecahkan[0] == "00") {
                                        $tgl_menetap = $pecahkan[2] . ' ' . $pecahkan[1] . ' ' . $pecahkan[0];
                                    } else {
                                        $tgl_menetap = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                                    }
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $penduduk_tetap['no_tetap']; ?></td>
                                    <td><?= $penduduk_tetap['nik']; ?></td>
                                    <td><?= $penduduk_tetap['nama_penduduk']; ?></td>
                                    <td><?= $tgl_menetap; ?></td>
                                    <?php if($_SESSION['level'] == 'rt') { ?>
                                        <td class="text-center">
                                            <a href="<?= BASEURL; ?>/penduduktetap/edit/<?= $penduduk_tetap['no_tetap']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $penduduk_tetap['no_tetap']); ?>()"><i class="fa fa-trash"></i> Delete</a>
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
<?php foreach($data['penduduk_tetap'] as $penduduk_tetap) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $penduduk_tetap['no_tetap']); ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/penduduktetap/delete/<?= $penduduk_tetap['no_tetap'].'/'.$penduduk_tetap['nik']; ?>"), {
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