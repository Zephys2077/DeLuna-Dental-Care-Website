<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">Data Obat</h1>
                    <p style="color: #CD853F;">Kelola data obat klinik</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('obat/add') ?>" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                <i class="fas fa-plus me-2"></i>Tambah Obat
                            </a>
                            <!-- Add Report Button -->
                            <button type="button" class="btn" style="border: 1px solid #DAA520; color: #B8860B;" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="fas fa-chart-bar me-2"></i>Laporan
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-3">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr style="color: #8B4513;">
                                    <th>No</th>
                                    <th>Nama Obat</th>
                                    <th>Deskripsi</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Expired</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($obat as $key => $row): 
                                    $today = strtotime(date('Y-m-d'));
                                    $expired = strtotime($row->expired);
                                    $status = $expired < $today ? 'danger' : ($expired - $today < 30 * 24 * 60 * 60 ? 'warning' : 'success');
                                ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <i class="fas fa-pills me-2" style="color: #DAA520;"></i>
                                        <?= $row->nama_obat ?>
                                    </td>
                                    <td><?= $row->deskripsi ?></td>
                                    <td>
                                        <span class="badge" style="background: <?= $row->stok < 10 ? '#dc3545' : 'linear-gradient(135deg, #DAA520, #B8860B)' ?>">
                                            <?= $row->stok ?> unit
                                        </span>
                                    </td>
                                    <td>
                                        <span style="color: #CD853F;">Rp </span>
                                        <?= number_format($row->harga, 0, ',', '.') ?>
                                    </td>
                                    <td>
                                        <i class="fas fa-calendar me-2" style="color: <?= $status == 'danger' ? '#dc3545' : ($status == 'warning' ? '#ffc107' : '#28a745') ?>;"></i>
                                        <?= date('d/m/Y', strtotime($row->expired)) ?>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" style="background: <?= $status == 'danger' ? '#dc3545' : ($status == 'warning' ? '#ffc107' : '#28a745') ?>">
                                            <?= $status == 'danger' ? 'Kadaluarsa' : ($status == 'warning' ? 'Hampir Kadaluarsa' : 'Baik') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('obat/edit/'.$row->id) ?>" class="btn btn-sm" style="background: #DAA520; color: white;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('obat/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Add Modal -->
<div class="modal fade" id="reportModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="color: #8B4513;">Generate Laporan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('obat/generate_report') ?>" method="post" target="_blank">
                    <div class="mb-3">
                        <label class="form-label" style="color: #8B4513;">Periode Laporan</label>
                        <select name="period" class="form-select" required>
                            <option value="daily">Hari Ini</option>
                            <option value="weekly">Minggu Ini</option>
                            <option value="monthly">Bulan Ini</option>
                            <option value="yearly">Tahun Ini</option>
                            <option value="custom">Kustom</option>
                        </select>
                    </div>
                    
                    <div id="customDateRange" style="display: none;">
                        <div class="mb-3">
                            <label class="form-label" style="color: #8B4513;">Tanggal Mulai</label>
                            <input type="date" name="start_date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" style="color: #8B4513;">Tanggal Selesai</label>
                            <input type="date" name="end_date" class="form-control">
                        </div>
                    </div>
                    
                    <div class="text-end">
                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                            <i class="fas fa-print me-2"></i>Print Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('select[name="period"]').on('change', function() {
        if ($(this).val() === 'custom') {
            $('#customDateRange').show();
        } else {
            $('#customDateRange').hide();
        }
    });
});
</script>