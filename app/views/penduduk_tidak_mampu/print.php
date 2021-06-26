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
                <th>No. Tidak Mampu</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Kota - Provinsi</th>
                <th>Pekerjaan</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $no = 1; 
                foreach($data['penduduk_tidak_mampu'] as $penduduk_tidak_mampu) : 
            ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $penduduk_tidak_mampu['no_tidak_mampu']; ?></td>
                <td><?= $penduduk_tidak_mampu['nik']; ?></td>
                <td><?= $penduduk_tidak_mampu['nama_penduduk']; ?></td>
                <td><?= $penduduk_tidak_mampu['alamat'].' RT. '.sprintf("%03s", $penduduk_tidak_mampu['no_rt']).' RW. '.sprintf("%03s", $penduduk_tidak_mampu['no_rw']).' Kel. '.$penduduk_tidak_mampu['kelurahan'].', Kec. '.$penduduk_tidak_mampu['kecamatan']; ?></td>
                <td><?= $penduduk_tidak_mampu['kota'].' - '.$penduduk_tidak_mampu['provinsi']; ?></td>
                <td><?= $penduduk_tidak_mampu['pekerjaan']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

	<script>
		window.print();
	</script>

</body>
</html>