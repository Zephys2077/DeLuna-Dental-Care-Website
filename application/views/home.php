<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik De Luna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFF8DC, #FAFAD2);
            min-height: 100vh;
        }
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(218,165,32,0.1);
        }
        .navbar-brand {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
        }
        .hero {
            padding: 100px 0;
            text-align: center;
        }
        .btn-custom {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
            padding: 10px 30px;
            border-radius: 25px;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="<?= base_url('assets/img/deluna.jpg') ?>" alt="" style="height: 40px; width: auto; margin-right: 10px;">
                <span>De Luna</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Patient_login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('Patient_register') ?>">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    <!-- Keep the existing navbar and then add the following content -->
    </nav>

    <!-- Banner Section -->
    <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="banner" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= base_url("assets/img/banner1.jpg") ?>');">
                    <div class="banner-content">
                        <h1 class="mb-3" style="color: white; font-size: 2.5rem;">De Luna DentalCare</h1>
                        <p class="mb-0" style="color: white; font-size: 1.2rem; margin-bottom: 20px;">Pilih layanan perawatan gigi sesuai kebutuhan Anda</p><br>
                        <a href="<?= base_url('Patient_register') ?>" class="btn btn-custom">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="banner" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= base_url("assets/img/banner2.jpg") ?>');">
                    <div class="banner-content">
                        <h1 class="mb-3" style="color: white; font-size: 2.5rem;">Perawatan Profesional</h1>
                        <p class="mb-0" style="color: white; font-size: 1.2rem; margin-bottom: 20px;">Ditangani oleh dokter gigi berpengalaman</p><br>
                        <a href="<?= base_url('Patient_register') ?>" class="btn btn-custom">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="banner" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= base_url("assets/img/banner3.jpg") ?>');">
                    <div class="banner-content">
                        <h1 class="mb-3" style="color: white; font-size: 2.5rem;">Klinik Modern</h1>
                        <p class="mb-0" style="color: white; font-size: 1.2rem; margin-bottom: 20px;">Dilengkapi peralatan modern dan steril</p><br>
                        <a href="<?= base_url('Patient_register') ?>" class="btn btn-custom">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
    
    <style>
    .carousel-indicators [data-bs-target] {
        background-color: #DAA520;
    }
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-color: rgba(218,165,32,0.5);
        border-radius: 50%;
        padding: 20px;
    }
    </style>

    <!-- Remove the hero section -->
    <!-- Section Title -->
    <div class="container mb-4">
        <h2 class="text-center" style="color: #8B4513; font-weight: bold;">Pilih Layanan</h2>
        <hr class="mx-auto" style="width: 150px; border-width: 2px; border-color: #DAA520;">
    </div>

    <!-- Treatments Section -->
    <div class="container">
        <div class="row">
            <?php foreach($layanan as $item): ?>
            <div class="col-md-12 mb-4">
                <div class="treatment-card">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h3 class="treatment-title"><?= $item->jenis_layanan ?></h3>
                            <?php if($item->waktu_pengerjaan): ?>
                            <p class="treatment-desc">Estimasi waktu pengerjaan: <?= $item->waktu_pengerjaan ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="treatment-price">Rp. <?= number_format($item->harga, 0, ',', '.') ?></div>
                            <a href="<?= base_url('Patient_login') ?>" class="btn btn-book">BOOK NOW</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Doctor Information Section -->
    <div class="container my-5">
        <div class="card border-0" style="background: linear-gradient(135deg, #FFF8DC, #FAFAD2);">
            <div class="row g-0 align-items-center">
                <div class="col-md-6">
                    <img src="<?= base_url('assets/img/doctor.PNG') ?>" class="img-fluid rounded" alt="Drg. Putri Risma Dewi" style="max-height: 400px; object-fit: cover;">
                </div>
                <div class="col-md-6">
                    <div class="card-body p-5">
                        <h2 class="card-title mb-3" style="color: #8B4513; font-family: 'Playfair Display', serif;">Drg. Putri Risma Dewi</h2>
                        <p class="card-subtitle mb-4" style="color: #DAA520; font-weight: 500;">Dental Specialist</p>
                        <p class="card-text mb-4" style="color: #666;">Dokter gigi berpengalaman dengan dedikasi tinggi dalam memberikan perawatan gigi berkualitas dan menciptakan senyum sehat untuk semua pasien.</p>
                        <button class="btn btn-outline-warning px-4" style="border-color: #DAA520; color: #8B4513;">READ MORE</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add required styles -->
    <style>
        .banner {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= base_url("assets/img/banner.jpg") ?>');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            margin-bottom: 50px;
        }
        .treatment-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(218,165,32,0.1);
        }
        .treatment-title {
            color: #8B4513;
            margin-bottom: 10px;
        }
        .treatment-desc {
            color: #666;
            margin-bottom: 0;
        }
        .treatment-price {
            color: #DAA520;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .btn-book {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 25px;
        }
        .btn-book:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
            color: white;
        }
    </style>
    <!-- Remove this entire div -->
    <!--<div class="hero">
        <div class="container">
            <a href="<?= base_url('Patient_register') ?>" class="btn btn-custom">Daftar Sekarang</a>
        </div>
    </div>-->

    <!-- Patient Reviews Section -->
        <div class="container my-5">
            <h2 class="text-center" style="color: #8B4513; font-weight: bold;">Apa Kata Mereka?</h2>
            <hr class="mx-auto mb-5" style="width: 150px; border-width: 2px; border-color: #DAA520;">
            
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="review-card">
                        <div class="review-stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Pelayanan sangat profesional dan ramah. Perawatan gigi jadi tidak menakutkan lagi!"</p>
                        <div class="review-author">- Nazwa Aulya</div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="review-card">
                        <div class="review-stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Klinik yang bersih dan nyaman. Dokternya sangat teliti dalam menangani pasien."</p>
                        <div class="review-author">- Fikri Firmansyah</div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="review-card">
                        <div class="review-stars mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="review-text">"Harga terjangkau dengan kualitas pelayanan yang sangat baik. Recommended!"</p>
                        <div class="review-author">- Ginartriadi</div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Footer -->
        <footer class="footer mt-5">
            <div class="container py-4">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3" style="color: #8B4513;">De Luna DentalCare</h5>
                        <p style="color: #666;">Memberikan pelayanan kesehatan gigi terbaik dengan teknologi modern dan tim dokter berpengalaman.</p>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3" style="color: #8B4513;">Jam Operasional</h5>
                        <li class="mb-2 text-muted">Senin: 08:00 - 12:00 & 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Selasa: 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Rabu: 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Kamis: 08:00 - 12:00 & 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Jumat: 08:00 - 12:00 & 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Rabu: 09:00 - 14:00</li>
                    </div>
                    <div class="col-md-4 mb-4">
                        <h5 class="mb-3" style="color: #8B4513;">Kontak</h5>
                        <p style="color: #666;">
                            <i class="fas fa-map-marker-alt me-2"></i>Perumahan Mahkota Regency Blok K11 No.44 (sebrang UNSIKA).<br>
                            <i class="fas fa-phone me-2"></i> (031) 123-4567<br>
                            <i class="fas fa-envelope me-2"></i> info@deluna.com
                        </p>
                    </div>
                </div>
                <hr style="border-color: #DAA520;">
                <div class="text-center" style="color: #666;">
                    &copy; <?= date('Y') ?> De Luna DentalCare. All rights reserved.
                </div>
            </div>
        </footer>
    
        <!-- Add these styles to your existing style section -->
        <style>
            .review-card {
                background: white;
                padding: 25px;
                border-radius: 10px;
                box-shadow: 0 0 20px rgba(218,165,32,0.1);
                height: 100%;
            }
            .review-stars {
                color: #FFD700;
            }
            .review-text {
                color: #666;
                font-style: italic;
                margin-bottom: 15px;
            }
            .review-author {
                color: #8B4513;
                font-weight: 500;
            }
            .footer {
                background: white;
                box-shadow: 0 -2px 10px rgba(218,165,32,0.1);
            }
        </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>