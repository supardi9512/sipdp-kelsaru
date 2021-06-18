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
                <th>No. Meninggal</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Hari Kematian</th>
                <th>Tempat & Tanggal Kematian</th>
                <th>Penyebab Kematian</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['penduduk_meninggal'] as $penduduk_meninggal) : 

                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    $pecahkan = explode('-', $penduduk_meninggal['tgl_kematian']);
                        
                    $tgl_kematian = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $penduduk_meninggal['no_meninggal']; ?></td>
                    <td><?= $penduduk_meninggal['nik']; ?></td>
                    <td><?= $penduduk_meninggal['nama_penduduk']; ?></td>
                    <td><?= $penduduk_meninggal['umur']; ?> Tahun</td>
                    <td><?= $penduduk_meninggal['hari_kematian']; ?></td>
                    <td><?= $penduduk_meninggal['tempat_kematian'].', '.$tgl_kematian; ?></td>
                    <td><?= $penduduk_meninggal['penyebab_kematian']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>