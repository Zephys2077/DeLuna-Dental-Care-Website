<!DOCTYPE html>
<html>
<head>
    <title>Book Appointment - <?= $layanan->jenis_layanan ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .booking-form {
            max-width: 600px;
            margin: 40px auto;
        }
        .submit-btn {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
        }
        .submit-btn:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container">
        <div class="booking-form">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Book <?= $layanan->jenis_layanan ?></h4>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Date & Time</label>
                            <input type="datetime-local" class="form-control" name="tgl_jam" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Complaints/Notes</label>
                            <textarea class="form-control" name="keluhan" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" 
                                   value="Rp <?= number_format($layanan->harga, 0, ',', '.') ?>" readonly>
                        </div>

                        <?php if($layanan->waktu_pengerjaan): ?>
                        <div class="mb-3">
                            <label class="form-label">Duration</label>
                            <input type="text" class="form-control" 
                                   value="<?= $layanan->waktu_pengerjaan ?> minutes" readonly>
                        </div>
                        <?php endif; ?>

                        <button type="submit" class="btn submit-btn w-100">Confirm Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>