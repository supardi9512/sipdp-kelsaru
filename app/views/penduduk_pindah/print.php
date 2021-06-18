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
                <th>No. Pindah</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Tanggal Pindah</th>
                <th>Alasan Pindah</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['penduduk_pindah'] as $penduduk_pindah) : 

                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    $pecahkan = explode('-', $penduduk_pindah['tgl_pindah']);
                        
                    $tgl_pindah = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $penduduk_pindah['no_pindah']; ?></td>
                <td><?= $penduduk_pindah['nik']; ?></td>
                <td><?= $penduduk_pindah['nama_penduduk']; ?></td>
                <td><?= $tgl_pindah; ?></td>
                <td><?= $penduduk_pindah['alasan_pindah']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>