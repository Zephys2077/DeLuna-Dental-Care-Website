<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Klinik De Luna - Patient Dashboard</title>
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
        .banner {
            background: url('<?= base_url("assets/img/dental-banner.jpg") ?>') center/cover;
            height: 300px;
            position: relative;
            margin-bottom: 50px;
        }
        .banner-content {
            position: relative;
            z-index: 1;
            text-align: center;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .banner-content img {
            max-height: 100%;
            width: auto;
            object-fit: contain;
            padding: 20px;
        }
        .banner::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
        }
        .banner-content {
            position: relative;
            z-index: 1;
            text-align: center;
            padding-top: 100px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .treatment-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(218,165,32,0.1);
            padding: 20px;
            margin-bottom: 30px;
            transition: transform 0.3s;
        }
        .treatment-card:hover {
            transform: translateY(-5px);
        }
        .treatment-title {
            color: #8B4513;
            font-size: 24px;
            margin-bottom: 15px;
        }
        .treatment-desc {
            color: #666;
            margin-bottom: 15px;
        }
        .treatment-price {
            color: #DAA520;
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 15px;
        }
        .btn-book {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 8px;
            float: right;
            text-decoration: none;
        }
        .btn-book:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
            color: white;
            text-decoration: none;
        }
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&display=swap');
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
                        <a class="nav-link" href="<?= base_url('patient/reservasi/history') ?>">
                            <i class="fas fa-history me-1"></i>Riwayat
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Remove the Riwayat Reservasi section and keep only Banner and Treatments sections -->
        </div>
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
                        <p class="mb-0" style="color: white; font-size: 1.2rem;">Pilih layanan perawatan gigi sesuai kebutuhan Anda</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="banner" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= base_url("assets/img/banner2.jpg") ?>');">
                    <div class="banner-content">
                        <h1 class="mb-3" style="color: white; font-size: 2.5rem;">Perawatan Profesional</h1>
                        <p class="mb-0" style="color: white; font-size: 1.2rem;">Ditangani oleh dokter gigi berpengalaman</p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="banner" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('<?= base_url("assets/img/banner3.jpg") ?>');">
                    <div class="banner-content">
                        <h1 class="mb-3" style="color: white; font-size: 2.5rem;">Klinik Modern</h1>
                        <p class="mb-0" style="color: white; font-size: 1.2rem;">Dilengkapi peralatan modern dan steril</p>
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
    .banner {
        background-size: cover !important;
        background-position: center !important;
    }
    </style>

    <!-- Section Title -->
    <div class="container mb-4">
        <h2 class="text-center" style="color: #8B4513; font-weight: bold;">Pilih Layanan</h2>
        <hr class="mx-auto" style="width: 150px; border-width: 2px; border-color: #DAA520;">
    </div>

    <!-- Add gradient accent styling -->
    <style>
        .banner {
            height: 500px;
            background-size: cover !important;
            background-position: center !important;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .banner-content {
            width: 100%;
            padding: 20px;
            text-align: center;
            z-index: 2;
        }
        .banner h1 {
            font-size: clamp(1.8rem, 5vw, 2.5rem);
            color: white;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            margin-bottom: 1rem;
        }
        .banner p {
            font-size: clamp(1rem, 3vw, 1.2rem);
            color: white;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
            max-width: 800px;
            margin: 0 auto;
        }

        @media (max-width: 768px) {
            .banner {
                height: 400px;
            }
            .carousel-control-prev-icon,
            .carousel-control-next-icon {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .banner {
                height: 300px;
            }
            .banner-content {
                padding: 15px;
            }
        }
    </style>

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
                            <a href="<?= base_url('patient/create_reservation/' . $item->No) ?>" class="btn btn-book">BOOK NOW</a>
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

    <!-- Patient Reviews Section -->
    <div class="container my-5">
        <h2 class="text-center mb-4" style="color: #8B4513; font-family: 'Playfair Display', serif;">Testimoni Pasien</h2>
        <hr class="mx-auto mb-5" style="width: 150px; border-width: 2px; border-color: #DAA520;">
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0" style="background: white; box-shadow: 0 0 20px rgba(218,165,32,0.1);">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4" style="color: #666;">"Pelayanan sangat memuaskan, dokter dan staff ramah. Perawatan dilakukan dengan profesional dan teliti."</p>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0" style="color: #8B4513;">Nazwa Aulya</h6>
                                <small class="text-muted">Pasien Orthodonti</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0" style="background: white; box-shadow: 0 0 20px rgba(218,165,32,0.1);">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4" style="color: #666;">"Klinik yang bersih dan nyaman. Hasil perawatan sangat memuaskan. Terima kasih De Luna DentalCare!"</p>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0" style="color: #8B4513;">Fikri Firmansyah</h6>
                                <small class="text-muted">Pasien Scaling</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0" style="background: white; box-shadow: 0 0 20px rgba(218,165,32,0.1);">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                        </div>
                        <p class="card-text mb-4" style="color: #666;">"Proses reservasi mudah dan cepat. Dokter sangat informatif dalam menjelaskan prosedur perawatan."</p>
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-warning" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-0" style="color: #8B4513;">Ginartriadi</h6>
                                <small class="text-muted">Pasien Tambal Gigi</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="py-5" style="background: white; box-shadow: 0 -2px 10px rgba(218,165,32,0.1);">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-4" style="color: #8B4513; font-family: 'Playfair Display', serif;">De Luna DentalCare</h5>
                    <p class="text-muted mb-4">Memberikan pelayanan kesehatan gigi terbaik dengan teknologi modern dan tim profesional yang berpengalaman.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-warning"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-warning"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-warning"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-4" style="color: #8B4513; font-family: 'Playfair Display', serif;">Jam Operasional</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 text-muted">Senin: 08:00 - 12:00 & 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Selasa: 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Rabu: 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Kamis: 08:00 - 12:00 & 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Jumat: 08:00 - 12:00 & 18:00 - 20:00</li>
                        <li class="mb-2 text-muted">Rabu: 09:00 - 14:00</li>
                    </ul>
                </div>

                <div class="col-lg-4 mb-4">
                    <h5 class="mb-4" style="color: #8B4513; font-family: 'Playfair Display', serif;">Kontak</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2 text-muted"><i class="fas fa-map-marker-alt me-2"></i>Perumahan Mahkota Regency Blok K11 No.44 (sebrang UNSIKA).</li>
                        <li class="mb-2 text-muted"><i class="fas fa-phone me-2"></i>(024) 1234567</li>
                        <li class="mb-2 text-muted"><i class="fas fa-envelope me-2"></i>info@delunadentalcare.com</li>
                    </ul>
                </div>
            </div>

            <hr class="my-4" style="border-color: #DAA520;">
            
            <div class="text-center text-muted">
                <small>&copy; <?= date('Y') ?> De Luna DentalCare. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>