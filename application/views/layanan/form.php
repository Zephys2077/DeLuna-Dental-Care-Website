<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;"><?= $title ?></h1>
                    <p style="color: #CD853F;">Form layanan klinik</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm rounded-4">
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Jenis Layanan</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-th"></i></span>
                                        <input type="text" class="form-control" name="jenis_layanan" value="<?= isset($layanan) ? $layanan->jenis_layanan : '' ?>" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Harga</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;">Rp</span>
                                        <input type="number" class="form-control" name="harga" value="<?= isset($layanan) ? $layanan->harga : '' ?>" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Waktu Pengerjaan</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-clock"></i></span>
                                        <input type="text" class="form-control" name="waktu_pengerjaan" value="<?= isset($layanan) ? $layanan->waktu_pengerjaan : '' ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <a href="<?= base_url('layanan') ?>" class="btn" style="border: 1px solid #DAA520; color: #B8860B;">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-4" style="background: linear-gradient(135deg, #FFF8DC, #FAFAD2);">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #8B4513;">
                                <i class="fas fa-info-circle me-2" style="color: #DAA520;"></i>Informasi
                            </h5>
                            <p class="card-text" style="color: #8B4513;">
                                Silakan isi form layanan dengan lengkap. Pastikan harga dan waktu pengerjaan sesuai dengan standar klinik.
                            </p>
                            <hr style="border-color: #DAA520;">
                            <div style="color: #CD853F;">
                                <small>
                                    <i class="fas fa-exclamation-circle me-1" style="color: #DAA520;"></i>
                                    Format waktu pengerjaan: 30 Menit, 1 Jam, dll.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>