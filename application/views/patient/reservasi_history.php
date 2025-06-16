<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Reservasi - Klinik De Luna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #FFF8DC, #FAFAD2);
            min-height: 100vh;
            padding: 2rem 0;
            font-family: 'Poppins', sans-serif;
        }
        
        /* Enhanced Navbar */
        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(218,165,32,0.15);
        }
        .nav-link {
            position: relative;
            padding: 0.8rem 1.2rem;
            color: #8B4513 !important;
            transition: all 0.3s ease;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(135deg, #DAA520, #B8860B);
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }
        .nav-link:hover::after {
            width: 80%;
        }
        
        /* Enhanced Card */
        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(218,165,32,0.15);
            overflow: hidden;
        }
        .card-header {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            padding: 1.2rem;
            border: none;
        }
        .card-header h5 {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        /* Enhanced Table */
        .table {
            margin: 0;
        }
        .table thead th {
            background: rgba(218,165,32,0.05);
            color: #8B4513;
            font-weight: 600;
            border: none;
            padding: 1rem;
        }
        .table tbody tr {
            transition: all 0.3s ease;
        }
        .table tbody tr:hover {
            background: rgba(218,165,32,0.05);
            transform: translateX(5px);
        }
        .table td {
            padding: 1rem;
            vertical-align: middle;
            border-color: rgba(218,165,32,0.1);
        }
        
        /* Enhanced Badges */
        .badge {
            padding: 0.6rem 1rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        .bg-warning {
            background: linear-gradient(135deg, #FFA500, #DAA520) !important;
        }
        .bg-success {
            background: linear-gradient(135deg, #28a745, #218838) !important;
        }
        .bg-danger {
            background: linear-gradient(135deg, #dc3545, #c82333) !important;
        }
        
        /* Enhanced Buttons */
        .btn-warning {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            border: none;
            color: white;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }
        .btn-warning:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(218,165,32,0.3);
            color: white;
        }
        
        /* Enhanced Modal */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }
        .modal-header {
            background: linear-gradient(135deg, #DAA520, #B8860B);
            color: white;
            border: none;
        }
        .modal-title {
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.8rem;
            border: 1px solid rgba(218,165,32,0.2);
        }
        .form-control:focus {
            border-color: #DAA520;
            box-shadow: 0 0 0 0.2rem rgba(218,165,32,0.15);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('patient/dashboard') ?>">De Luna</a>
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
                        <a class="nav-link" href="<?= base_url('home') ?>">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="margin-top: 80px;">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Riwayat Reservasi</h5>
            </div>
            <div class="card-body">
                <?php if(empty($reservasi)): ?>
                    <p class="text-muted text-center mb-0">Belum ada riwayat reservasi</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tanggal & Jam</th>
                                    <th>Layanan</th>
                                    <th>Keluhan</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reservasi as $res): ?>
                                <tr>
                                    <td><?= date('d/m/Y H:i', strtotime($res->tgl_jam)) ?></td>
                                    <td><?= $res->jenis_layanan ?></td>
                                    <td><?= $res->keluhan ?></td>
                                    <td>
                                        <span class="badge <?= $res->status == 'Pending' ? 'bg-warning' : ($res->status == 'Selesai' ? 'bg-success' : 'bg-danger') ?>">
                                            <?= $res->status ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($res->status == 'Pending'): ?>
                                            <button class="btn btn-sm btn-warning" 
                                                    onclick="reschedule(<?= $res->No ?>)" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#rescheduleModal">
                                                <i class="fas fa-calendar-alt"></i> Jadwalkan Ulang
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
        <div class="modal fade" id="rescheduleModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Jadwalkan Ulang Reservasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form id="rescheduleForm">
                        <div class="modal-body">
                            <input type="hidden" id="reservationId" name="reservation_id">
                            <div class="mb-3">
                                <label class="form-label">Tanggal dan Jam Baru</label>
                                <input type="datetime-local" class="form-control" name="new_datetime" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-warning">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            function reschedule(id) {
                document.getElementById('reservationId').value = id;
            }
    
            document.getElementById('rescheduleForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                formData.append('<?= $this->security->get_csrf_token_name() ?>', '<?= $this->security->get_csrf_hash() ?>');
                
                fetch('<?= base_url('patient/reschedule') ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Jadwal reservasi berhasil diubah',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: data.message || 'Terjadi kesalahan'
                        });
                    }
                });
            });
        </script>
    </body>
    </html>