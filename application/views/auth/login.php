<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DeLuna | Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(120deg, #DAA520 0%, #FFD700 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 400px;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 2rem;
        }
        .login-logo a {
            color: #333;
            font-size: 2rem;
            text-decoration: none;
            font-weight: 300;
        }
        .login-logo a b {
            font-weight: 600;
        }
        .input-group-text {
            background: transparent;
            border-left: none;
        }
        .form-control {
            border-right: none;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }
        .btn-primary {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            border: none;
            padding: 0.8rem;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
        }
    </style>
</head>
<body>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>De</b>Luna</a>
        <p class="text-muted small">Dental Care Management System</p>
    </div>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <?= $this->session->flashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <form action="<?= base_url('auth/login') ?>" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <span class="input-group-text">
                <i class="fas fa-user text-muted"></i>
            </span>
        </div>
        <div class="input-group mb-4">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <span class="input-group-text">
                <i class="fas fa-lock text-muted"></i>
            </span>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary w-100">Sign In</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>