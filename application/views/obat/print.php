<!DOCTYPE html>
<html>
<head>
    <title>Data Obat</title>
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
        <h1>Data Obat</h1>
        <p>Tanggal Cetak: <?= date('d/m/Y') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Deskripsi</th>
                <th>Stok</th>
                <th>Tanggal Kadaluarsa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($obat as $key => $row): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= $row->nama_obat ?></td>
                <td><?= $row->deskripsi ?></td>
                <td><?= $row->stok ?></td>
                <td><?= date('d/m/Y', strtotime($row->expired)) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="no-print" onclick="window.print()" style="margin-top: 20px; padding: 10px 20px;">
        Print
    </button>
</body>
</html>