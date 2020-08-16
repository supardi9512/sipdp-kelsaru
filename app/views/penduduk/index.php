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
                                <a href="<?= BASEURL; ?>/penduduk/create" class="btn btn-primary float-right ml-2"><i class="fa fa-plus"></i> Add Data</a>
                            <?php } ?>
                            <a href="<?= BASEURL; ?>/penduduk/print" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Print</a>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>No. KK</th>
                                <th>TTL</th>
                                <th>Jenis Kelamin</th>
                                <th>Alamat</th>
                                <th>Kota - Provinsi</th>
                                <th>Pekerjaan</th>
                                <th>Pendidikan</th>
                                <th>Agama</th>
                                <th>Status Kawin</th>
                                <th>Status Penduduk</th>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['penduduk'] as $penduduk) : 

                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    
                                    $pecahkan = explode('-', $penduduk['tgl_lahir']);
                                        
                                    if($pecahkan[2] == "0000" || $pecahkan[1] == "00" || $pecahkan[0] == "00") {
                                        $tgl_lahir = $pecahkan[2] . ' ' . $pecahkan[1] . ' ' . $pecahkan[0] . ' ' . $jam;
                                    } else {
                                        $tgl_lahir = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                                    }
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $penduduk['nik']; ?></td>
                                    <td><?= $penduduk['nama_penduduk']; ?></td>
                                    <td><?= $penduduk['username']; ?></td>
                                    <td><?= $penduduk['no_kk']; ?></td>
                                    <td><?= $penduduk['tempat_lahir'].', '.$tgl_lahir; ?></td>
                                    <td><?= $penduduk['jenis_kelamin']; ?></td>
                                    <td><?= $penduduk['alamat'].' RT. '.sprintf("%03s", $penduduk['no_rt']).' RW. '.sprintf("%03s", $penduduk['no_rw']).' Kel. '.$penduduk['kelurahan'].', Kec. '.$penduduk['kecamatan']; ?></td>
                                    <td><?= $penduduk['kota'].' - '.$penduduk['provinsi']; ?></td>
                                    <td><?= $penduduk['pekerjaan']; ?></td>
                                    <td><?= $penduduk['pendidikan']; ?></td>
                                    <td><?= $penduduk['agama']; ?></td>
                                    <td><?= $penduduk['status_kawin']; ?></td>
                                    <td><?= $penduduk['status_penduduk']; ?></td>
                                    <?php if($_SESSION['level'] == 'rt') { ?>
                                        <td class="text-center">
                                            <a href="<?= BASEURL; ?>/penduduk/edit/<?= $penduduk['nik']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= $penduduk['nik']; ?>()"><i class="fa fa-trash"></i> Delete</a>
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
<?php foreach($data['penduduk'] as $penduduk) { ?>
  <script type="text/javascript">
    function sweet_<?= $penduduk['nik']; ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/penduduk/delete/<?= $penduduk['nik']; ?>"), {
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