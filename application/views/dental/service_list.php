<!DOCTYPE html>
<html>
<head>
    <title>Dental Services</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        .service-card {
            transition: transform 0.3s;
            border-radius: 15px;
            overflow: hidden;
        }
        .service-card:hover {
            transform: translateY(-5px);
        }
        .book-btn {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
        }
        .book-btn:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">Our Dental Services</h2>
        <div class="row">
            <?php foreach($layanan as $service): ?>
            <div class="col-md-4 mb-4">
                <div class="card service-card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $service->jenis_layanan ?></h5>
                        <p class="card-text">
                            <strong>Price:</strong> Rp <?= number_format($service->harga, 0, ',', '.') ?>
                            <?php if($service->waktu_pengerjaan): ?>
                            <br><strong>Duration:</strong> <?= $service->waktu_pengerjaan ?> minutes
                            <?php endif; ?>
                        </p>
                        <a href="<?= base_url('dental_booking/create/' . $service->No) ?>" 
                           class="btn book-btn w-100">Book Now</a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>