<!DOCTYPE html>
<html>
<head>
    <title>Laporan Reservasi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .summary { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Reservasi Klinik De Luna</h2>
        <p>Periode: <?= date('d/m/Y', strtotime($start_date)) ?> - <?= date('d/m/Y', strtotime($end_date)) ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal & Jam</th>
                <th>Nama Pasien</th>
                <th>Layanan</th>
                <th>Status</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($reservasi as $key => $row): ?>
            <tr>
                <td><?= $key + 1 ?></td>
                <td><?= date('d/m/Y H:i', strtotime($row->tgl_jam)) ?></td>
                <td><?= $row->nama_pasien ?></td>
                <td><?= $row->jenis_layanan ?></td>
                <td><?= $row->status ?></td>
                <td>Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <h3>Ringkasan</h3>
        <p>Total Reservasi: <?= count($reservasi) ?></p>
        <p>Total Pendapatan: Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></p>
    </div>
</body>
</html>