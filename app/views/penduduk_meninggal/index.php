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
                            <a href="<?= BASEURL; ?>/pendudukmeninggal/print" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Print</a>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Meninggal</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Umur</th>
                                <th>Hari Kematian</th>
                                <th>Tempat & Tanggal Kematian</th>
                                <th>Penyebab Kematian</th>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['penduduk_meninggal'] as $penduduk_meninggal) : 

                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    
                                    $pecahkan = explode('-', $penduduk_meninggal['tgl_kematian']);
                                        
                                    $tgl_kematian = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $penduduk_meninggal['no_meninggal']; ?></td>
                                <td><?= $penduduk_meninggal['nik']; ?></td>
                                <td><?= $penduduk_meninggal['nama_penduduk']; ?></td>
                                <td><?= $penduduk_meninggal['umur']; ?> Tahun</td>
                                <td><?= $penduduk_meninggal['hari_kematian']; ?></td>
                                <td><?= $penduduk_meninggal['tempat_kematian'].', '.$tgl_kematian; ?></td>
                                <td><?= $penduduk_meninggal['penyebab_kematian']; ?></td>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <td class="text-center">
                                        <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $penduduk_meninggal['no_meninggal']); ?>()"><i class="fa fa-trash"></i> Delete</a>
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
<?php foreach($data['penduduk_meninggal'] as $penduduk_meninggal) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $penduduk_meninggal['no_meninggal']); ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/pendudukmeninggal/delete/<?= $penduduk_meninggal['no_meninggal'].'/'.$penduduk_meninggal['nik']; ?>"), {
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