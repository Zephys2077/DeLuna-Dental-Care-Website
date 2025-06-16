<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservasi - <?= $layanan->jenis_layanan ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFF8DC, #FAFAD2);
            min-height: 100vh;
            padding: 2rem 0;
        }
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(218,165,32,0.1);
        }
        .card-header {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border-radius: 15px 15px 0 0 !important;
        }
        .btn-submit {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
        }
        .btn-submit:hover {
            background: linear-gradient(135deg, #B8860B, #DAA520);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Reservasi <?= $layanan->jenis_layanan ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= current_url() ?>" method="post" id="reservationForm">
                            <!-- Add CSRF token -->
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash() ?>">
                            
                            <div class="mb-3">
                                <label class="form-label">Tanggal dan Jam</label>
                                <input type="datetime-local" class="form-control" name="tgl_jam" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Keluhan</label>
                                <textarea class="form-control" name="keluhan" rows="3" placeholder="Deskripsikan keluhan Anda"></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Biaya</label>
                                <input type="text" class="form-control" value="Rp. <?= number_format($layanan->harga, 0, ',', '.') ?>" disabled>
                            </div>

                            <?php if($layanan->waktu_pengerjaan): ?>
                            <div class="mb-3">
                                <label class="form-label">Estimasi Waktu Pengerjaan</label>
                                <input type="text" class="form-control" value="<?= $layanan->waktu_pengerjaan ?> menit" disabled>
                            </div>
                            <?php endif; ?>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-submit">Buat Reservasi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.getElementById('reservationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            
            fetch(this.action, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData,
                credentials: 'same-origin'
            })
            .then(response => response.text())  // Change to text() first
            .then(text => {
                try {
                    return JSON.parse(text);  // Then parse as JSON
                } catch (e) {
                    console.error('Parse error:', text);
                    throw new Error('Invalid JSON response');
                }
            })
            .then(data => {
                if(data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Reservasi berhasil dibuat',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        window.location.href = '<?= base_url("patient/dashboard") ?>';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: data.message || 'Terjadi kesalahan'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan pada server'
                });
            });
        });
    </script>
</body>
</html>