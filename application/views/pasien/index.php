<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">Data Pasien</h1>
                    <p style="color: #CD853F;">Kelola data pasien klinik</p>
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
                            <a href="<?= base_url('pasien/add') ?>" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                <i class="fas fa-plus me-2"></i>Tambah Pasien
                            </a>
                            <!-- Add Report Button -->
                            <button type="button" class="btn" style="border: 1px solid #DAA520; color: #B8860B;" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="fas fa-chart-bar me-2"></i>Laporan
                            </button>
                        </div>
                    </div>
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
                                <form action="<?= base_url('pasien/generate_report') ?>" method="post" target="_blank">
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
                <div class="card-body">
                    <?php if($this->session->flashdata('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show rounded-3">
                            <i class="fas fa-check-circle me-2"></i>
                            <?= $this->session->flashdata('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger alert-dismissible fade show rounded-3">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= $this->session->flashdata('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr style="color: #8B4513;">
                                    <th>No</th>
                                    <th>ID Pasien</th>
                                    <th>Nama Pasien</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Tempat, Tgl Lahir</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($pasien as $key => $row): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td><span class="badge" style="background: #F5F5F5; color: #8B4513; border: 1px solid #DAA520;"><?= $row->id_pasien ?></span></td>
                                    <td>
                                        <i class="fas fa-user me-1" style="color: #DAA520;"></i>
                                        <?= $row->nama_pasien ?>
                                    </td>
                                    <td><i class="fas fa-phone me-1" style="color: #28a745;"></i><?= $row->no_hp ?></td>
                                    <td><i class="fas fa-map-marker-alt me-1" style="color: #dc3545;"></i><?= $row->alamat ?></td>
                                    <td><i class="fas fa-calendar me-1" style="color: #DAA520;"></i><?= $row->tempat_tgl_lahir ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('pasien/edit/'.$row->id_pasien) ?>" class="btn btn-sm" style="background: #DAA520; color: white;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row->id_pasien ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    // Existing period select code remains unchanged
    $('select[name="period"]').on('change', function() {
        if ($(this).val() === 'custom') {
            $('#customDateRange').show();
        } else {
            $('#customDateRange').hide();
        }
    });

    // Modern delete handling with SweetAlert2
    $('.delete-btn').on('click', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#B8860B',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('pasien/delete/') ?>' + id,
                    type: 'GET',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data telah dihapus.',
                                icon: 'success',
                                confirmButtonColor: '#B8860B'
                            }).then(() => {
                                location.reload();
                            });
                        }
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Tidak Dapat Dihapus',
                            text: 'Data tidak dapat dihapus karena masih digunakan dalam data reservasi.',
                            icon: 'error',
                            confirmButtonColor: '#B8860B'
                        });
                    }
                });
            }
        });
    });
});
</script>