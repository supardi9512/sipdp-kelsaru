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
                <th>No. Usaha</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Buka Usaha</th>
                <th>Nama Usaha</th>
                <th>Jenis Usaha</th>
                <th>Alamat Usaha</th>
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
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>