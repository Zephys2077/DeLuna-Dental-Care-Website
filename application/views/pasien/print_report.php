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
            <h2>Laporan Data Pasien Klinik De Luna</h2>
            <p>Periode: <?= date('d/m/Y', strtotime($start_date)) ?> - <?= date('d/m/Y', strtotime($end_date)) ?></p>
        </div>

        <button onclick="window.print()" class="btn btn-primary mb-3 no-print">Print</button>

        <table class="table table-bordered">
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

        <div class="mt-4">
            <p><strong>Total Pasien:</strong> <?= count($pasien) ?></p>
        </div>
    </div>
</body>
</html>