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
                            <a href="<?= BASEURL; ?>/pendudukusaha/print" class="btn btn-primary float-right"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Usaha</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Buka Usaha</th>
                                <th>Nama Usaha</th>
                                <th>Jenis Usaha</th>
                                <th>Alamat Usaha</th>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['penduduk_usaha'] as $penduduk_usaha) : 

                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    
                                    $pecahkan = explode('-', $penduduk_usaha['tgl_buka_usaha']);
                                        
                                    $tgl_buka_usaha = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $penduduk_usaha['no_usaha']; ?></td>
                                <td><?= $penduduk_usaha['nik']; ?></td>
                                <td><?= $penduduk_usaha['nama_penduduk']; ?></td>
                                <td><?= $tgl_buka_usaha; ?></td>
                                <td><?= $penduduk_usaha['nama_usaha']; ?></td>
                                <td><?= $penduduk_usaha['jenis_usaha']; ?></td>
                                <td><?= $penduduk_usaha['alamat_usaha']; ?></td>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $penduduk_usaha['no_usaha']); ?>()"><i class="fa fa-trash"></i> Delete</a>
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
<?php foreach($data['penduduk_usaha'] as $penduduk_usaha) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $penduduk_usaha['no_usaha']); ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/pendudukusaha/delete/<?= $penduduk_usaha['no_usaha'].'/'.$penduduk_usaha['nik']; ?>"), {
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