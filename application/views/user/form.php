<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;"><?= $title ?></h1>
                    <p style="color: #CD853F;">Form data pengguna sistem</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm rounded-4">
                        <form action="" method="post" id="userForm">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Nama Lengkap</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control" name="nama_lengkap" value="<?= isset($user) ? $user->nama_lengkap : '' ?>" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-at"></i></span>
                                        <input type="text" class="form-control" name="username" id="username" value="<?= isset($user) ? $user->username : '' ?>" required>
                                        <div class="invalid-feedback">Username sudah digunakan</div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Password <?= !isset($user) ? '<span class="text-danger">*</span>' : '<small style="color: #CD853F;">(Kosongkan jika tidak ingin mengubah password)</small>' ?></label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control" name="password" <?= !isset($user) ? 'required' : '' ?>>
                                        <button class="btn" style="border: 1px solid #DAA520; color: #B8860B;" type="button" onclick="togglePassword(this)">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <a href="<?= base_url('user') ?>" class="btn" style="border: 1px solid #DAA520; color: #B8860B;">
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
                                Silakan isi form data pengguna dengan lengkap. Pastikan username bersifat unik dan password cukup kuat.
                            </p>
                            <hr style="border-color: #DAA520;">
                            <div style="color: #CD853F;">
                                <small>
                                    <i class="fas fa-shield-alt me-1" style="color: #DAA520;"></i>
                                    Password minimal 6 karakter
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function togglePassword(button) {
    const input = button.previousElementSibling;
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

// Add username validation
document.getElementById('username').addEventListener('blur', function() {
    const username = this.value;
    if(username) {
        fetch('<?= base_url('user/check_username') ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'username=' + encodeURIComponent(username)
        })
        .then(response => response.json())
        .then(data => {
            if(data.exists) {
                this.classList.add('is-invalid');
                document.querySelector('button[type="submit"]').disabled = true;
            } else {
                this.classList.remove('is-invalid');
                document.querySelector('button[type="submit"]').disabled = false;
            }
        });
    }
});
</script>