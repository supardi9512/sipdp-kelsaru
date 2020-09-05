<!DOCTYPE html>
<html>
<head>
	<title>SIPDP-KELSARU | <?= $data['title']; ?></title>
    <style>
        h2 {
            text-align: center;
        }

        table {
            width: 100%; 
            border: 1px solid #000; 
            border-collapse: collapse;
        }

        table tr, table th, table td {
            border: 1px solid #000; 
        }

        table td {
            padding: 2px;
        }

        table td:first-child {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2><?= $data['title']; ?></h2>
	<table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Datang</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Datang</th>
                <th>Alamat Asal</th>
                <th>Kelurahan Asal</th>
                <th>Kecamatan Asal</th>
                <th>Kota Asal</th>
                <th>Provinsi Asal</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['penduduk_datang'] as $penduduk_datang) : 

                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    $pecahkan = explode('-', $penduduk_datang['tgl_datang']);
                        
                    $tgl_datang = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $penduduk_datang['no_datang']; ?></td>
                <td><?= $penduduk_datang['nik']; ?></td>
                <td><?= $penduduk_datang['nama_penduduk']; ?></td>
                <td><?= $tgl_datang; ?></td>
                <td><?= $penduduk_datang['alamat_asal']; ?></td>
                <td><?= $penduduk_datang['kelurahan_asal']; ?></td>
                <td><?= $penduduk_datang['kecamatan_asal']; ?></td>
                <td><?= $penduduk_datang['kota_asal']; ?></td>
                <td><?= $penduduk_datang['provinsi_asal']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>