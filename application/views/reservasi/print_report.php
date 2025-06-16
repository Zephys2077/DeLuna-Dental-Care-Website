<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print { display: none; }
            .table { border-collapse: collapse; }
            .table td, .table th { border: 1px solid #ddd; }
        }
        .print-header { text-align: center; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="print-header">
            <h2>Laporan Reservasi Klinik De Luna</h2>
            <p>Periode: <?= date('d/m/Y', strtotime($start_date)) ?> - <?= date('d/m/Y', strtotime($end_date)) ?></p>
        </div>

        <button onclick="window.print()" class="btn btn-primary mb-3 no-print">Print</button>

        <table class="table table-bordered">
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
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end"><strong>Total Pendapatan:</strong></td>
                    <td><strong>Rp <?= number_format($total_pendapatan, 0, ',', '.') ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="mt-4">
            <p><strong>Total Reservasi:</strong> <?= count($reservasi) ?></p>
        </div>
    </div>
</body>
</html>