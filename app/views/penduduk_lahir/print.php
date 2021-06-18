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
                <th>No. Lahir</th>
                <th>NIK Pengaju</th>
                <th>Nama Pengaju</th>
                <th>Nama Bayi</th>
                <th>TTL</th>
                <th>Hari Lahir</th>
                <th>Jam Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Berat Badan</th>
                <th>Nama Ayah</th>
                <th>Nama Ibu</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['penduduk_lahir'] as $penduduk_lahir) : 

                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    $pecahkan = explode('-', $penduduk_lahir['tgl_lahir']);
                        
                    if($pecahkan[2] == "0000" || $pecahkan[1] == "00" || $pecahkan[0] == "00") {
                        $tgl_lahir = $pecahkan[2] . ' ' . $pecahkan[1] . ' ' . $pecahkan[0];
                    } else {
                        $tgl_lahir = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $penduduk_lahir['no_lahir']; ?></td>
                    <td><?= $penduduk_lahir['nik']; ?></td>
                    <td><?= $penduduk_lahir['nama_penduduk']; ?></td>
                    <td><?= $penduduk_lahir['nama_bayi']; ?></td>
                    <td><?= $penduduk_lahir['tempat_lahir'].', '.$tgl_lahir; ?></td>
                    <td><?= $penduduk_lahir['hari_lahir']; ?></td>
                    <td><?= date('H:i', strtotime($penduduk_lahir['jam_lahir'])); ?> WIB</td>
                    <td><?= $penduduk_lahir['jenis_kelamin']; ?></td>
                    <td><?= str_replace('.', ',', $penduduk_lahir['berat_badan']).' Kg'; ?></td>
                    <td><?= $penduduk_lahir['nama_ayah']; ?></td>
                    <td><?= $penduduk_lahir['nama_ibu']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>