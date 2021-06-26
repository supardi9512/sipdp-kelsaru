<!DOCTYPE html>
<html>
<head>
	<title>SIPDP-KELSARU | <?= $data['title']; ?></title>
    <style>
        header, footer {
            position: relative;
        }

        .header-logo {
            position: absolute;
            top: 0;
            left: 60px;
        }

        .footer-ttd-rw {
            position: absolute;
            top: 10px;
            left: 0;
        }

        .footer-ttd-rt {
            position: absolute;
            top: 10px;
            right: 0;
        }

        .footer-ttd-rw p, .footer-ttd-rt p {
            text-align: center
        }

        h2, h3 {
            padding: 0;
            margin: 0;
            text-align: center
        }

        br {
            clear: both;
        }

        hr.line-top-header {
            clear: both;
            border: 2px solid #000;
        }

        hr.line-bottom-header {
            clear: both;
            border: 1px solid #000;
        }

        hr.line-title {
            clear: both;
            padding-top: 0;
            padding-bottom: 0;
            margin-top: 0;
            margin-bottom: 0;
            border: 1px solid #000;
            width: 360px;
        }

        /* .section-body table td {
            padding: 20px;
        } */
    </style>
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="<?= BASEURL; ?>/public/img/logo_tangsel.png" style="width: 100px;">
        </div>
        <div class="header-title">
            <h3>Pemerintah Kota Tangerang Selatan</h3>
            <h3>Kecamatan Ciputat</h3>
            <h3>Kelurahan Sawah Baru</h3>
            <h2>RT. 001 RW. 001</h2>
        </div>
    </header>
    <br><hr class="line-top-header"><hr class="line-bottom-header"><br>
    <section class="section-title">
        <h3>SURAT KETERANGAN TIDAK MAMPU</h3>
        <hr class="line-title">
        <p style="text-align: center; margin-top: 0;">Nomor: <?= $data['ket_tidak_mampu']['no_tidak_mampu']; ?></p>
    </section>
    <br>
    <section class="section-body">
        <p>Yang bertanda tangan di bawah ini Ketua Rukun Tetangga (RT) <?= sprintf("%03s", $data['ket_tidak_mampu']['no_rt']); ?> 
        Rukun Warga (RW) <?= sprintf("%03s", $data['ket_tidak_mampu']['no_rw']); ?>, menerangkan bahwa :</p>
        <table style="margin-left: 70px;">
            <tr>
                <td style="width: 35%;">Nama Lengkap</td>
                <td>:</td>
                <td><?= $data['ket_tidak_mampu']['nama_penduduk']; ?></td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>:</td>
                <td><?= $data['ket_tidak_mampu']['nik']; ?></td>
            </tr>
            <tr>
                <td>Pekerjaan</td>
                <td>:</td>
                <td><?= $data['ket_tidak_mampu']['pekerjaan']; ?></td>
            </tr>
            <tr>
                <td style="vertical-align: top;">Alamat</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;"><?= $data['ket_tidak_mampu']['alamat'].' RT. '.sprintf("%03s", $data['ket_tidak_mampu']['no_rt']).' RW. '.sprintf("%03s", $data['ket_tidak_mampu']['no_rw']).' Kel. '.$data['ket_tidak_mampu']['kelurahan'].', Kec. '.$data['ket_tidak_mampu']['kecamatan'].', Kota '.$data['ket_tidak_mampu']['kota']; ?></td>
            </tr>
        </table>
        <p>Menurut sepengetahuan kami bahwa nama tersebut di atas saat ini termasuk keluarga tidak mampu.</p>
        <p>Demikian surat keterangan tidak mampu ini dibuat dengan sebenar-benarnya dan untuk dapat dipergunakan seperlunya.</p>
    </section>
    <footer>
        <div class="footer-ttd-rw">
            <p>Mengetahui,
            <br>Ketua RW. <?= sprintf("%03s", $data['ket_tidak_mampu']['no_rw']); ?></p>
            <br><br><br>
            <p>( <?= $data['ket_tidak_mampu']['nama_rw']; ?> )</p>
        </div>
        <div class="footer-ttd-rt">
            <?php
                $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                
                $pecahkan = explode('-', date('Y-m-d'));
                    
                $tgl_sekarang = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
            ?>
            <p><?= $data['ket_tidak_mampu']['kota'].', '.$tgl_sekarang; ?>
            <br>Ketua RT. <?= sprintf("%03s", $data['ket_tidak_mampu']['no_rt']); ?> RW. <?= sprintf("%03s", $data['ket_tidak_mampu']['no_rw']); ?></p>
            <br><br><br>
            <p>( <?= $data['ket_tidak_mampu']['nama_rt']; ?> )</p>
        </div>
    </footer>
	<script>
		window.print();
	</script>

</body>
</html>