<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;"><?= $title ?></h1>
                    <p style="color: #CD853F;">Form data pasien klinik</p>
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
                                    <label class="form-label" style="color: #8B4513;">ID Pasien</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-id-card"></i></span>
                                        <input type="text" class="form-control" name="id_pasien" value="<?= isset($pasien) ? $pasien->id_pasien : $new_id ?>" readonly>
                                        <span class="input-group-text bg-light">Auto Generated</span>
                                    </div>
                                </div>

                                <!-- Other form groups with same styling pattern -->
                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" name="nama_pasien" value="<?= isset($pasien) ? $pasien->nama_pasien : '' ?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">No HP</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                        <input type="text" class="form-control" name="no_hp" value="<?= isset($pasien) ? $pasien->no_hp : '' ?>" required>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">Alamat</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        <textarea class="form-control" name="alamat" rows="3" required><?= isset($pasien) ? $pasien->alamat : '' ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group mb-3">
                                    <label class="form-label">Tempat & Tanggal Lahir</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-2">
                                                <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                                <input type="text" class="form-control" name="tempat_lahir" 
                                                    placeholder="Tempat Lahir" 
                                                    value="<?= isset($pasien) ? explode(', ', $pasien->tempat_tgl_lahir)[0] : '' ?>" 
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                <input type="date" class="form-control" name="tanggal_lahir" 
                                                    value="<?= isset($pasien) && strpos($pasien->tempat_tgl_lahir, ', ') !== false ? 
                                                        date('Y-m-d', strtotime(explode(', ', $pasien->tempat_tgl_lahir)[1])) : '' ?>" 
                                                    required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="card-footer bg-white">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <a href="<?= base_url('pasien') ?>" class="btn" style="border: 1px solid #DAA520; color: #B8860B;">
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
                                Silakan isi form data pasien dengan lengkap dan benar. Data yang dimasukkan akan tersimpan dalam database klinik.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>