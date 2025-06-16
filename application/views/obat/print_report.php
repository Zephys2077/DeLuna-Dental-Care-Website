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
            <h2>Laporan Data Obat Klinik De Luna</h2>
            <p>Periode: <?= date('d/m/Y', strtotime($start_date)) ?> - <?= date('d/m/Y', strtotime($end_date)) ?></p>
        </div>

        <button onclick="window.print()" class="btn btn-primary mb-3 no-print">Print</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Deskripsi</th>
                    <th>Stok</th>
                    <th>Harga</th>
                    <th>Expired</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_obat = 0;
                $total_stok = 0;
                foreach($obat as $key => $row): 
                    $today = strtotime(date('Y-m-d'));
                    $expired = strtotime($row->expired);
                    $status = $expired < $today ? 'Kadaluarsa' : ($expired - $today < 30 * 24 * 60 * 60 ? 'Hampir Kadaluarsa' : 'Baik');
                    $total_obat++;
                    $total_stok += $row->stok;
                ?>
                <tr>
                    <td><?= $key + 1 ?></td>
                    <td><?= $row->nama_obat ?></td>
                    <td><?= $row->deskripsi ?></td>
                    <td><?= $row->stok ?> unit</td>
                    <td>Rp <?= number_format($row->harga, 0, ',', '.') ?></td>
                    <td><?= date('d/m/Y', strtotime($row->expired)) ?></td>
                    <td><?= $status ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="mt-4">
            <h4>Ringkasan:</h4>
            <p><strong>Total Jenis Obat:</strong> <?= $total_obat ?></p>
            <p><strong>Total Stok Obat:</strong> <?= $total_stok ?> unit</p>
        </div>
    </div>
</body>
</html>