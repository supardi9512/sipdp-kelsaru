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
                            <li><a href="<?= BASEURL; ?>/kartukeluarga">Data Kartu Keluarga</a></li>
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
                    <div class="row mb-3 mx-3">
                        <div class="col-md-12 px-0">
                            <a href="<?= BASEURL; ?>/kartukeluarga/print/<?= $data['kartu_keluarga']['no_kk']; ?>" class="btn btn-primary float-right"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                    <div class="row mb-5 mx-1">
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>No. KK</td><td>:</td><td><?= $data['kartu_keluarga']['no_kk']; ?></td>
                                </tr>
                                <tr>
                                    <td>Nama Kepala Keluarga</td><td>:</td><td><?= $data['kartu_keluarga']['nama_penduduk']; ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td><td>:</td><td><?= $data['kartu_keluarga']['alamat']; ?></td>
                                </tr>
                                <tr>
                                    <td>RT/RW</td><td>:</td><td><?= sprintf("%03s", $data['kartu_keluarga']['no_rt']).'/'.sprintf("%03s", $data['kartu_keluarga']['no_rw']); ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table>
                                <tr>
                                    <td>Kelurahan</td><td>:</td><td><?= $data['kartu_keluarga']['kelurahan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Kecamatan</td><td>:</td><td><?= $data['kartu_keluarga']['kecamatan']; ?></td>
                                </tr>
                                <tr>
                                    <td>Kota</td><td>:</td><td><?= $data['kartu_keluarga']['kota']; ?></td>
                                </tr>
                                <tr>
                                    <td>Provinsi</td><td>:</td><td><?= $data['kartu_keluarga']['provinsi']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php if($_SESSION['level'] == 'rt') { ?>
                        <form action="<?= BASEURL; ?>/kartukeluarga/store_anggota" method="post" class="mb-5 mx-3">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="hidden" name="no_kk" value="<?= $data['kartu_keluarga']['no_kk']; ?>">
                                    <div class="form-group">
                                        <label for="nik" class="form-control-label">Anggota Keluarga</label>
                                        <?php Flasher::error('nik'); ?>
                                        <?php $old_nik = Flasher::oldData('nik', 'selected'); ?>
                                        <select data-placeholder="Pilih Anggota Keluarga" id="nik" name="nik" class="standardSelect" tabindex="1">
                                            <option value="" label="default"></option>
                                            <?php foreach($data['penduduk_by_id_rt'] as $penduduk) : ?>
                                                <option value="<?= $penduduk['nik']; ?>" <?= (!empty($old_nik) && $old_nik == $penduduk['nik'] ? 'selected' : ''); ?>><?= $penduduk['nik'].' - '.$penduduk['nama_penduduk']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php Flasher::unsetOldData('nik'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="statusHubungan" class="form-control-label">Status Hubungan</label>
                                        <?php Flasher::error('status_hubungan'); ?>
                                        <?php $old_status_hubungan = Flasher::oldData('status_hubungan', 'selected'); ?>
                                        <select data-placeholder="Pilih Status Hubungan" id="statusHubungan" name="status_hubungan" class="standardSelect" tabindex="1">
                                            <option value="" label="default"></option>
                                            <option value="Istri" <?= (!empty($old_status_hubungan) && $old_status_hubungan == 'Istri' ? 'selected' : ''); ?>>Istri</option>
                                            <option value="Anak" <?= (!empty($old_status_hubungan) && $old_status_hubungan == 'Anak' ? 'selected' : ''); ?>>Anak</option>
                                            <option value="Menantu" <?= (!empty($old_status_hubungan) && $old_status_hubungan == 'Menantu' ? 'selected' : ''); ?>>Menantu</option>
                                            <option value="Cucu" <?= (!empty($old_status_hubungan) && $old_status_hubungan == 'Cucu' ? 'selected' : ''); ?>>Cucu</option>
                                            <option value="Orang Tua" <?= (!empty($old_status_hubungan) && $old_status_hubungan == 'Orang Tua' ? 'selected' : ''); ?>>Orang Tua</option>
                                            <option value="Mertua" <?= (!empty($old_status_hubungan) && $old_status_hubungan == 'Mertua' ? 'selected' : ''); ?>>Mertua</option>
                                            <option value="Famili Lain" <?= (!empty($old_status_hubungan) && $old_status_hubungan == 'Famili Lain' ? 'selected' : ''); ?>>Famili Lain</option>
                                        </select>
                                        <?php Flasher::unsetOldData('status_hubungan'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions form-group float-right">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-floppy-o"></i> Create</button>
                            </div>
                        </form>
                    <?php } ?>
                    <div class="row mb-3 mx-1">
                        <div class="col-lg-12 col-md-12">
                            <?php Flasher::success(); ?>
                        </div>
                    </div>
                    <table id="data-table" class="table table-striped table-bordered nowrap" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Status Hubungan</th>
                                <?php if($_SESSION['level'] == 'rt') { ?>
                                    <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1; 
                                foreach($data['anggota_keluarga'] as $anggota_keluarga) : 
                            ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $anggota_keluarga['nik']; ?></td>
                                    <td><?= $anggota_keluarga['nama_penduduk']; ?></td>
                                    <td><?= $anggota_keluarga['jenis_kelamin']; ?></td>
                                    <td><?= $anggota_keluarga['status_hubungan']; ?></td>
                                    <?php if($_SESSION['level'] == 'rt') { ?>
                                        <td class="text-center">
                                        <?php if($anggota_keluarga['status_hubungan'] != 'Kepala Keluarga') { ?>
                                            <a class="btn btn-danger btn-sm" href="#" onclick="sweet_<?= str_replace('-', '', $anggota_keluarga['no_anggota']); ?>()"><i class="fa fa-trash"></i> Delete</a>
                                        <?php } ?>
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
<?php foreach($data['anggota_keluarga'] as $anggota_keluarga) { ?>
  <script type="text/javascript">
    function sweet_<?= str_replace('-', '', $anggota_keluarga['no_anggota']); ?>() {
      swal({
        title: "Anda Yakin Ingin Menghapus Data Ini?",
        text: "Data yang sudah dihapus tidak dapat dikembalikan!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if(willDelete) {
          swal(window.location.assign("<?= BASEURL; ?>/kartukeluarga/delete_anggota/<?= $anggota_keluarga['no_anggota'].'/'.$anggota_keluarga['no_kk'].'/'.$anggota_keluarga['nik']; ?>"), {
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