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
                <th>NIK</th>
                <th>Nama</th>
                <th>No. KK</th>
                <th>TTL</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Kota - Provinsi</th>
                <th>Pekerjaan</th>
                <th>Pendidikan</th>
                <th>Agama</th>
                <th>Status Kawin</th>
                <th>Status Penduduk</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['penduduk'] as $penduduk) : 

                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',  
                                'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    
                    $pecahkan = explode('-', $penduduk['tgl_lahir']);
                        
                    if($pecahkan[2] == "0000" || $pecahkan[1] == "00" || $pecahkan[0] == "00") {
                        $tgl_lahir = $pecahkan[2] . ' ' . $pecahkan[1] . ' ' . $pecahkan[0];
                    } else {
                        $tgl_lahir = $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
                    }
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $penduduk['nik']; ?></td>
                    <td><?= $penduduk['nama_penduduk']; ?></td>
                    <td><?= $penduduk['no_kk']; ?></td>
                    <td><?= $penduduk['tempat_lahir'].', '.$tgl_lahir; ?></td>
                    <td><?= $penduduk['jenis_kelamin']; ?></td>
                    <td><?= $penduduk['alamat'].' RT. '.sprintf("%03s", $penduduk['no_rt']).' RW. '.sprintf("%03s", $penduduk['no_rw']).' Kel. '.$penduduk['kelurahan'].', Kec. '.$penduduk['kecamatan']; ?></td>
                    <td><?= $penduduk['kota'].' - '.$penduduk['provinsi']; ?></td>
                    <td><?= $penduduk['pekerjaan']; ?></td>
                    <td><?= $penduduk['pendidikan']; ?></td>
                    <td><?= $penduduk['agama']; ?></td>
                    <td><?= $penduduk['status_kawin']; ?></td>
                    <td><?= !empty($penduduk['status_penduduk']) ? $penduduk['status_penduduk'] : '-'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>