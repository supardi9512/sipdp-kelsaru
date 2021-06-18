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
                <th>No. Tetap</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Menetap</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['penduduk_tetap'] as $penduduk_tetap) : 

                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    $pecahkan = explode('-', $penduduk_tetap['tgl_menetap']);
                        
                    if($pecahkan[2] == "0000" || $pecahkan[1] == "00" || $pecahkan[0] == "00") {
                        $tgl_menetap = $pecahkan[2] . ' ' . $pecahkan[1] . ' ' . $pecahkan[0];
                    } else {
                        $tgl_menetap = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $penduduk_tetap['no_tetap']; ?></td>
                    <td><?= $penduduk_tetap['nik']; ?></td>
                    <td><?= $penduduk_tetap['nama_penduduk']; ?></td>
                    <td><?= $tgl_menetap; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>