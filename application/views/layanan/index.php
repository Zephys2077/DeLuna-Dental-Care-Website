<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">Data Layanan</h1>
                    <p style="color: #CD853F;">Kelola layanan klinik</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= base_url('layanan/add') ?>" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                            <i class="fas fa-plus me-2"></i>Tambah Layanan
                        </a>
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
                                    <th>Jenis Layanan</th>
                                    <th>Harga</th>
                                    <th>Waktu Pengerjaan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($layanan as $key => $row): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <i class="fas fa-th me-2" style="color: #DAA520;"></i>
                                        <?= $row->jenis_layanan ?>
                                    </td>
                                    <td>
                                        <span class="badge" style="background: linear-gradient(135deg, #DAA520, #B8860B);">
                                            Rp <?= number_format($row->harga, 0, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="fas fa-clock me-2" style="color: #DAA520;"></i>
                                        <?= $row->waktu_pengerjaan ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('layanan/edit/'.$row->No) ?>" class="btn btn-sm me-1" style="background: #DAA520; color: white;">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row->No ?>">
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

<!-- Add SweetAlert2 library -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('.delete-btn').on('click', function() {
        const id = $(this).data('id');
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus layanan ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#B8860B',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '<?= base_url('layanan/delete/') ?>' + id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data layanan berhasil dihapus',
                                icon: 'success',
                                confirmButtonColor: '#B8860B'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Data layanan gagal dihapus',
                                icon: 'error',
                                confirmButtonColor: '#B8860B'
                            });
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'Data layanan tidak dapat dihapus';
                        try {
                            const response = JSON.parse(xhr.responseText);
                            errorMessage = response.error || errorMessage;
                        } catch(e) {}
                        
                        Swal.fire({
                            title: 'Tidak Dapat Dihapus',
                            text: errorMessage,
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