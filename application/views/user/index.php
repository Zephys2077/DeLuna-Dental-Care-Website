<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">Data User</h1>
                    <p style="color: #CD853F;">Kelola data pengguna sistem</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= base_url('user/add') ?>" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                            <i class="fas fa-user-plus me-2"></i>Tambah User
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
                                    <th>ID User</th>
                                    <th>Nama Lengkap</th>
                                    <th>Username</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($user as $key => $row): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <span class="badge" style="background: #F5F5F5; color: #8B4513; border: 1px solid #DAA520;">
                                            <?= $row->id_user ?>
                                        </span>
                                    </td>
                                    <td>
                                        <i class="fas fa-user me-2" style="color: #DAA520;"></i>
                                        <?= $row->nama_lengkap ?>
                                    </td>
                                    <td>
                                        <i class="fas fa-at me-2" style="color: #DAA520;"></i>
                                        <?= $row->username ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('user/edit/'.$row->id_user) ?>" class="btn btn-sm" style="background: #DAA520; color: white;" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?= base_url('user/delete/'.$row->id_user) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
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