<!DOCTYPE html>
<html>
<head>
    <title>Data Pasien</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        h1 { text-align: center; }
        .header { text-align: center; margin-bottom: 30px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Data Pasien</h1>
        <p>Tanggal Cetak: <?= date('d/m/Y') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Pasien</th>
                <th>Nama Pasien</th>
                <th>No HP</th>
                <th>Alamat</th>
                <th>Tempat, Tgl Lahir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pasien as $key => $row): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $row->id_pasien ?></td>
                <td><?= $row->nama_pasien ?></td>
                <td><?= $row->no_hp ?></td>
                <td><?= $row->alamat ?></td>
                <td><?= $row->tempat_tgl_lahir ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="no-print" onclick="window.print()" style="margin-top: 20px; padding: 10px 20px;">
        Print
    </button>
</body>
</html>