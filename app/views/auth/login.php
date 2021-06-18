<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIPDP-KELSARU | <?= $data['title']; ?></title>
    <meta name="description" content="Sistem Informasi Pengolahan Data Penduduk RT/RW Kelurahan Sawah Baru">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png">
    <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/style.css">

    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/lib/chosen/chosen.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand mt-1" href="<?= BASEURL; ?>"><h3>SIPDP-KELSARU</h3></a>
                </div>
            </div>
        </header>
        <!-- /#header -->
    </div>
    <!-- /#right-panel -->
    <!-- Content -->
    <div class="container-fluid" style="background-color: #f1f2f7 !important;">
        <div class="row">
            <div class="col-md-6 offset-3">
                <h4 class="text-center mt-5">SISTEM INFORMASI PENGOLAHAN DATA PENDUDUK<br>RT/RW KELURAHAN SAWAH BARU</h4>
                <div class="card my-5">
                    <div class="card-body">
                        <h4 class="mb-4">Login</h4>
                        <form action="<?= BASEURL; ?>/login/login" method="post">
                            <div class="form-group">
                                <label for="username" class="form-control-label">Username</label>
                                <?php Flasher::error('username'); ?>
                                <input type="text" id="username" name="username" placeholder="Masukkan Username Anda" class="form-control form-control-sm" value="<?php Flasher::oldData('username'); ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">Password</label>
                                <?php Flasher::error('password'); ?>
                                <input type="password" id="password" name="password" placeholder="Masukkan Password Anda" class="form-control form-control-sm" autocomplete="off">
                            </div>
                            <div class="form-actions form-group float-right">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-sign-in"></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
    <footer class="site-footer">
        <div class="footer-inner bg-white">
            <div class="row">
                <div class="col-sm-12 text-center">
                    &copy; 2020 Sistem Informasi Pengolahan Data Penduduk - RT/RW Kelurahan Sawah Baru
                </div>
            </div>
        </div>
    </footer>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="http://localhost/sipdp-kelsaru/public/js/main.js"></script>

    <!-- datatables -->
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/datatables.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/jszip.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/vfs_fonts.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.print.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="<?= BASEURL; ?>/public/js/init/datatables-init.js"></script>

    <!-- select  -->
    <script src="<?= BASEURL; ?>/public/js/lib/chosen/chosen.jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#bootstrap-data-table-export').DataTable();
        } );
    </script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                no_results_text: "Tidak ada data yang ditemukan!",
                width: "100%"
            });
        });
    </script>
</body>
</html>
