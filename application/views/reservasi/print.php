<!DOCTYPE html>
<html>
<head>
    <title>Data Reservasi</title>
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
        <h1>Data Reservasi</h1>
        <p>Tanggal: <?= date('d/m/Y') ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal & Jam</th>
                <th>Nama Pasien</th>
                <th>Layanan</th>
                <th>Keluhan</th>
                <th>Harga</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reservasi as $key => $row): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= date('d/m/Y H:i', strtotime($row->tgl_jam)) ?></td>
                <td><?= $row->nama_pasien ?></td>
                <td><?= $row->jenis_layanan ?></td>
                <td><?= $row->keluhan ?></td>
                <td>Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
                <td><?= $row->status ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button class="no-print" onclick="window.print()" style="margin-top: 20px; padding: 10px 20px;">
        Print
    </button>
</body>
</html>