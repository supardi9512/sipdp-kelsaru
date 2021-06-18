<!DOCTYPE html>
<html>
<head>
	<title>SIPDP-KELSARU | <?= $data['title']; ?></title>
    <style>
        h2, p {
            text-align: center;
        }

        table.detail {
            width: 100%; 
            border: 1px solid #000; 
            border-collapse: collapse;
        }

        table.detail tr, table.detail th, table.detail td {
            border: 1px solid #000; 
        }

        table.detail td {
            padding: 2px;
        }

        table.detail td:first-child {
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <h2 style="margin-bottom: 0px;"><?= $data['title']; ?></h2>
        <p style="margin-top: 0px;">No. <span style="letter-spacing: 5px;"><?= $data['kartu_keluarga']['no_kk']; ?></span></p>
    </div>
    <div style="margin-bottom: 100px;">
        <table style="float: left;">
            <tr>
                <td>Nama Kepala Keluarga</td><td>:</td><td><?= $data['kartu_keluarga']['nama_penduduk']; ?></td>
            </tr>
            <tr>
                <td>Alamat</td><td>:</td><td><?= $data['kartu_keluarga']['alamat']; ?></td>
            </tr>
            <tr>
                <td>RT/RW</td><td>:</td><td><?= sprintf("%03s", $data['kartu_keluarga']['no_rt']).'/'.sprintf("%03s", $data['kartu_keluarga']['no_rw']); ?></td>
            </tr>
            <tr>
                <td>Kelurahan</td><td>:</td><td><?= $data['kartu_keluarga']['kelurahan']; ?></td>
            </tr>
        </table>
        <table style="float: right;">
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
    <br>
	<table class="detail">
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Jenis Kelamin</th>
                <th>TTL</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['anggota_keluarga'] as $anggota_keluarga) : 

                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    $pecahkan = explode('-', $anggota_keluarga['tgl_lahir']);
                        
                    if($pecahkan[2] == "0000" || $pecahkan[1] == "00" || $pecahkan[0] == "00") {
                        $tgl_lahir = $pecahkan[2] . ' ' . $pecahkan[1] . ' ' . $pecahkan[0];
                    } else {
                        $tgl_lahir = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $anggota_keluarga['nama_penduduk']; ?></td>
                    <td><?= $anggota_keluarga['nik']; ?></td>
                    <td><?= $anggota_keluarga['jenis_kelamin']; ?></td>
                    <td><?= $anggota_keluarga['tempat_lahir'].', '.$tgl_lahir; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
    <table class="detail">
        <thead>
            <tr>
                <th>No.</th>
                <th>Agama</th>
                <th>Pendidikan</th>
                <th>Pekerjaan</th>
                <th>Status Kawin</th>
                <th>Status Hubungan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['anggota_keluarga'] as $anggota_keluarga) : 
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $anggota_keluarga['agama']; ?></td>
                    <td><?= $anggota_keluarga['pendidikan']; ?></td>
                    <td><?= $anggota_keluarga['pekerjaan']; ?></td>
                    <td><?= $anggota_keluarga['status_kawin']; ?></td>
                    <td><?= $anggota_keluarga['status_hubungan']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>