<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DeLuna | Patient Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFF8DC, #FAFAD2);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }
        .login-box {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(218,165,32,0.15);
            padding: 2.5rem;
            width: 420px;
            position: relative;
            overflow: hidden;
        }
        .login-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(135deg, #DAA520, #B8860B);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .login-logo a {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-size: 2.5rem;
            text-decoration: none;
            font-weight: 300;
        }
        .login-logo p {
            color: #CD853F;
            margin-top: 0.5rem;
            font-size: 1.1rem;
        }
        .input-group {
            border: 1px solid #ced4da;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .input-group:hover {
            border-color: #DAA520;
        }
        .input-group-text {
            background: transparent;
            border: none;
            padding-left: 1.2rem;
        }
        .form-control {
            border: none;
            padding: 0.8rem;
            font-size: 1rem;
        }
        .form-control:focus {
            box-shadow: none;
        }
        .btn-login {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
            padding: 1rem;
            border-radius: 10px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
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
    </style>

    <!-- Add Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>De</b>Luna</a>
        <p style="color: #CD853F;">Patient Portal</p>
    </div>
    <!-- Add this after the register-logo div -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?= $this->session->flashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <form action="<?= base_url('Patient_login/auth') ?>" method="post">
        <div class="input-group mb-3">
            <span class="input-group-text">
                <i class="fas fa-id-card text-muted"></i>
            </span>
            <input type="text" class="form-control" name="id_pasien" placeholder="ID Pasien" required>
        </div>
        <div class="input-group mb-4">
            <span class="input-group-text">
                <i class="fas fa-phone text-muted"></i>
            </span>
            <input type="text" class="form-control" name="no_hp" placeholder="Nomor HP" required>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-login w-100">Masuk</button>
        </div>
        <div class="text-center">
            <p class="mb-0" style="color: #CD853F;">Belum punya akun? <a href="<?= base_url('Patient_register') ?>" style="color: #DAA520;">Daftar disini</a></p>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>