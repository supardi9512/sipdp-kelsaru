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
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <!-- menu active dimanis -->
                <?php 
                    $directoryURI = $_SERVER['REQUEST_URI'];
                    $path = parse_url($directoryURI, PHP_URL_PATH);
                    $components = explode('/', $path);
                    $first_part = $components[2];
                ?>
                <ul class="nav navbar-nav">
                    <li class="<?= ($first_part == "") ? "active" : "noactive"; ?>">
                        <a href="<?= BASEURL; ?>"><i class="menu-icon fa fa-home"></i>Home</a>
                    </li>
                    <?php if($_SESSION['level'] == 'admin') { ?>
                        <li class="<?= ($first_part == "admin") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/admin"> <i class="menu-icon fa fa-user"></i>Admin</a>
                        </li>
                        <li class="<?= ($first_part == "rw") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/rw"> <i class="menu-icon fa fa-user"></i>Ketua RW</a>
                        </li>
                        <li class="<?= ($first_part == "rt") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/rt"> <i class="menu-icon fa fa-user"></i>Ketua RT</a>
                        </li>
                    <?php } ?>
                    <?php if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'rw' || $_SESSION['level'] == 'rt') { ?>
                        <li class="<?= ($first_part == "penduduk") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/penduduk"> <i class="menu-icon fa fa-user"></i>Penduduk</a>
                        </li>
                        <li class="<?= ($first_part == "kartukeluarga") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/kartukeluarga"> <i class="menu-icon fa fa-users"></i>Kartu Keluarga</a>
                        </li>
                        <li class="<?= ($first_part == "penduduktetap") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/penduduktetap"> <i class="menu-icon fa fa-users"></i>Penduduk Tetap</a>
                        </li>
                        <li class="<?= ($first_part == "penduduklahir") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/penduduklahir"> <i class="menu-icon fa fa-users"></i>Penduduk Lahir</a>
                        </li>
                        <li class="<?= ($first_part == "pendudukmeninggal") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/pendudukmeninggal"> <i class="menu-icon fa fa-users"></i>Penduduk Meninggal</a>
                        </li>
                        <li class="<?= ($first_part == "pendudukpindah") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/pendudukpindah"> <i class="menu-icon fa fa-users"></i>Penduduk Pindah</a>
                        </li>
                        <li class="<?= ($first_part == "pendudukdatang") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/pendudukdatang"> <i class="menu-icon fa fa-users"></i>Penduduk Datang</a>
                        </li>
                        <li class="<?= ($first_part == "penduduktidakmampu") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/penduduktidakmampu"> <i class="menu-icon fa fa-users"></i>Penduduk Tidak Mampu</a>
                        </li>
                    <?php } ?>
                    <!-- <?php if($_SESSION['level'] == 'penduduk') { ?>
                        <li class="<?= ($first_part == "biodata") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/biodata"> <i class="menu-icon fa fa-address-book"></i>Biodata Diri</a>
                        </li>
                    <?php } ?> -->
                    <?php if($_SESSION['level'] == 'penduduk' || $_SESSION['level'] == 'rw' || $_SESSION['level'] == 'rt') { ?>
                        <li class="<?= ($first_part == "ketlahir") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/ketlahir"> <i class="menu-icon fa fa-file"></i>Surat Ket. Lahir</a>
                        </li>
                        <li class="<?= ($first_part == "ketkematian") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/ketkematian"> <i class="menu-icon fa fa-file"></i>Surat Ket. Kematian</a>
                        </li>
                        <li class="<?= ($first_part == "ketpindah") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/ketpindah"> <i class="menu-icon fa fa-file"></i>Surat Ket. Pindah</a>
                        </li>
                        <li class="<?= ($first_part == "kettidakmampu") ? "active" : "noactive"; ?>">
                            <a href="<?= BASEURL; ?>/kettidakmampu"> <i class="menu-icon fa fa-file"></i>Surat Ket. Tidak Mampu</a>
                        </li>
                    <?php } ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand mt-1" href="<?= BASEURL; ?>"><h3>SIPDP-KELSARU</h3></a>
                    <a id="menuToggle" class="menutoggle align-top"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <button class="btn btn-secondary"><?= strtoupper($_SESSION['nama']).' - '.strtoupper($_SESSION['level']); ?></button>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="<?= BASEURL; ?>/login/logout"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->