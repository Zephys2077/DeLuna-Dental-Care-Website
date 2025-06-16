<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DeLuna | Patient Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFF8DC, #FAFAD2);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
            font-family: 'Poppins', sans-serif;
        }
        .register-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(218,165,32,0.15);
            padding: 2.5rem;
            width: 520px;
            position: relative;
            overflow: hidden;
        }
        .register-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #DAA520, #B8860B);
        }
        .register-logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .register-logo a {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            text-decoration: none;
            font-weight: 300;
        }
        .register-logo p {
            color: #CD853F;
            margin-top: 0.5rem;
            font-size: 1.1rem;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.8rem;
            border: 1px solid #ced4da;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #DAA520;
            box-shadow: 0 0 0 0.2rem rgba(218,165,32,0.15);
        }
        .form-label {
            color: #8B4513;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .btn-register {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(218,165,32,0.3);
        }
        .text-center p {
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }
        .text-center a {
            color: #DAA520;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .text-center a:hover {
            color: #B8860B;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }
        .text-muted {
            font-size: 0.85rem;
            color: #6c757d !important;
        }
    </style>
</head>
<body>
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>De</b>Luna</a>
        <p style="color: #CD853F;">Patient Registration</p>
    </div>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <form action="<?= base_url('Patient_register/register') ?>" method="post" id="registerForm">
        <div class="mb-3">
            <label class="form-label">ID Pasien</label>
            <input type="text" class="form-control" id="displayId" value="<?= $generated_id ?>" disabled>
            <input type="hidden" name="id_pasien" id="patientId" value="<?= $generated_id ?>">
            <small class="text-muted">ID ini akan digunakan untuk login</small>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_pasien" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nomor HP</label>
            <input type="text" class="form-control" name="no_hp" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" rows="2" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tempat & Tanggal Lahir</label>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" required>
                </div>
                <div class="col-md-6">
                    <input type="date" class="form-control" name="tanggal_lahir" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-register w-100" id="registerBtn">Daftar</button>
        </div>
        <div class="text-center">
            <p class="mb-0" style="color: #CD853F;">Sudah punya akun? <a href="<?= base_url('Patient_login') ?>" style="color: #DAA520;">Login disini</a></p>
        </div>
    </form>
</div>

<!-- Add SweetAlert2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const patientId = document.getElementById('patientId').value;
    
    Swal.fire({
        title: 'Simpan ID Pasien Anda!',
        html: `ID Pasien Anda adalah: <br><strong style="font-size: 24px; color: #DAA520;">${patientId}</strong><br><br>
               Harap simpan ID ini karena akan digunakan untuk login.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DAA520',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Saya Sudah Menyimpan ID',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit();
        }
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>