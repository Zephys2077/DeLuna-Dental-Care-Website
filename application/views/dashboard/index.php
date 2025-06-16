<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 2.5rem;">Dashboard</h1>
                    <p style="color: #CD853F;">Overview statistik klinik</p>
                </div>
                <div class="col-sm-6">
                    <div class="float-end text-end">
                        <h5 class="mb-0" style="background: linear-gradient(135deg, #DAA520, #B8860B); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 600;"><?= date('l, d F Y') ?></h5>
                        <p style="color: #CD853F;">
                            <i class="fas fa-clock me-1"></i>
                            <?= date('H:i', time()+((60*60)*7)) ?> WIB
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <?php 
                $box_styles = [
                    ['gradient' => 'linear-gradient(135deg, #FFD700, #DAA520)', 'hover' => '#B8860B'],
                    ['gradient' => 'linear-gradient(135deg, #DAA520, #B8860B)', 'hover' => '#8B4513'],
                    ['gradient' => 'linear-gradient(135deg, #B8860B, #8B4513)', 'hover' => '#654321'],
                    ['gradient' => 'linear-gradient(135deg, #D4AF37, #B8860B)', 'hover' => '#8B4513']
                ];
                ?>
                <?php foreach($box_styles as $i => $style): ?>
                <div class="col-lg-3 col-6">
                    <div class="small-box rounded-4 shadow-lg" style="background: <?= $style['gradient'] ?>; transition: all 0.3s ease;">
                        <div class="inner p-4">
                            <h3 class="text-white" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2); font-size: 1.8rem; font-weight: 700;">
                                <?php
                                switch($i) {
                                    case 0: echo number_format($total_pasien); break;
                                    case 1: echo number_format($total_reservasi); break;
                                    case 2: echo 'Rp ' . number_format($total_omset, 0, ',', '.'); break;
                                    case 3: echo count($jadwal_hari_ini); break;
                                }
                                ?>
                            </h3>
                            <p class="mb-0 text-white" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.1); font-size: 0.9rem;">
                                <?php
                                switch($i) {
                                    case 0: echo 'Total Pasien'; break;
                                    case 1: echo 'Total Reservasi'; break;
                                    case 2: echo 'Total Pendapatan'; break;
                                    case 3: echo 'Reservasi Hari Ini'; break;
                                }
                                ?>
                            </p>
                        </div>
                        <div class="icon" style="color: rgba(255,255,255,0.15); font-size: 70px; transition: all 0.3s ease;">
                            <i class="fas <?= $i == 0 ? 'fa-users' : ($i == 1 ? 'fa-calendar-check' : ($i == 2 ? 'fa-money-bill-wave' : 'fa-clock')) ?>"></i>
                        </div>
                        <a href="<?= base_url($i == 0 ? 'pasien' : 'reservasi') ?>" class="small-box-footer py-2 position-relative overflow-hidden" 
                           style="background: rgba(255,255,255,0.15); backdrop-filter: blur(5px); color: white; font-weight: 500;">
                            <div class="d-flex align-items-center justify-content-end pe-4 gap-2">
                                <span class="detail-text" style="font-size: 0.75rem; letter-spacing: 0.5px;">LIHAT DETAIL</span>
                                <i class="fas fa-arrow-right detail-icon" style="font-size: 0.75rem;"></i>
                            </div>
                        </a>
                    </div>
                    <style>
                        .small-box-footer::before {
                            content: '';
                            position: absolute;
                            top: 0;
                            left: -100%;
                            width: 100%;
                            height: 100%;
                            background: rgba(255,255,255,0.1);
                            transform: skewX(-30deg);
                            transition: all 0.5s ease;
                        }
                        .small-box-footer:hover::before {
                            left: 100%;
                        }
                        .detail-icon {
                            transition: transform 0.3s ease;
                        }
                        .small-box-footer:hover .detail-icon {
                            transform: translateX(5px);
                        }
                        .detail-text {
                            position: relative;
                        }
                        .detail-text::after {
                            content: '';
                            position: absolute;
                            bottom: -2px;
                            left: 0;
                            width: 0;
                            height: 1px;
                            background: white;
                            transition: width 0.3s ease;
                        }
                        .small-box-footer:hover .detail-text::after {
                            width: 100%;
                        }
                    </style>
                </div>
                <?php endforeach; ?>
            </div>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-lg rounded-4" style="border: 1px solid rgba(218,165,32,0.1);">
                        <div class="card-header bg-white py-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700; font-size: 1.3rem;">
                                    <i class="fas fa-calendar-day me-2"></i>Jadwal Reservasi Hari Ini
                                </h5>
                                <span class="badge rounded-pill px-4 py-2" style="background: linear-gradient(135deg, #DAA520, #B8860B); font-size: 0.9rem;">
                                    <i class="fas fa-calendar-alt me-1"></i><?= date('d/m/Y') ?>
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(empty($jadwal_hari_ini)): ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-calendar-times fa-3x mb-3" style="color: #DAA520;"></i>
                                    <p class="text-muted mb-0">Tidak ada jadwal reservasi hari ini</p>
                                </div>
                            <?php else: ?>
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle">
                                        <thead>
                                            <tr style="color: #8B4513;">
                                                <th>Waktu</th>
                                                <th>Nama Pasien</th>
                                                <th>Layanan</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($jadwal_hari_ini as $jadwal): ?>
                                            <tr>
                                                <td>
                                                    <i class="fas fa-clock me-1" style="color: #DAA520;"></i>
                                                    <?= date('H:i', strtotime($jadwal->tgl_jam)) ?>
                                                </td>
                                                <td>
                                                    <i class="fas fa-user me-1" style="color: #DAA520;"></i>
                                                    <?= $jadwal->nama_pasien ?>
                                                </td>
                                                <td><?= $jadwal->jenis_layanan ?></td>
                                                <td>
                                                    <span class="badge rounded-pill" style="background: <?= $jadwal->status == 'Selesai' ? 'linear-gradient(135deg, #28a745, #218838)' : 'linear-gradient(135deg, #DAA520, #B8860B)' ?>">
                                                        <?= $jadwal->status ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url('reservasi/edit/'.$jadwal->No) ?>" class="btn btn-sm" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
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
            </div>
        </div>
    </section>
</div>

<style>
    .content-wrapper {
        background: linear-gradient(135deg, #FFF8DC, #FAFAD2);
        padding: 20px;
    }
    
    /* Enhanced Card Styles */
    .card {
        border: none;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(135deg, #DAA520, #B8860B);
    }
    
    /* Enhanced Small Box Styles */
    .small-box {
        overflow: hidden;
        border: none;
        transform: translateY(0);
        transition: all 0.3s ease;
    }
    .small-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(218,165,32,0.2) !important;
    }
    .small-box .icon {
        opacity: 0.2;
        right: 15px;
        top: 15px;
        transition: all 0.3s ease;
    }
    .small-box:hover .icon {
        opacity: 0.3;
        transform: scale(1.1);
    }
    
    /* Table Enhancements */
    .table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .table thead th {
        border: none;
        font-weight: 600;
        padding: 15px;
        background: rgba(218,165,32,0.05);
    }
    .table tbody tr {
        box-shadow: 0 2px 10px rgba(218,165,32,0.05);
        border-radius: 8px;
        transition: transform 0.3s ease;
    }
    .table tbody tr:hover {
        transform: translateX(5px);
        background: rgba(218,165,32,0.02);
    }
    .table td {
        padding: 15px;
        border: none;
        background: white;
    }
    .table tbody tr td:first-child {
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
    }
    .table tbody tr td:last-child {
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
    }
    
    /* Badge Enhancements */
    .badge {
        padding: 8px 15px;
        font-weight: 500;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 10px rgba(218,165,32,0.15);
    }
    
    /* Button Enhancements */
    .btn {
        border-radius: 8px;
        padding: 8px 15px;
        transition: all 0.3s ease;
    }
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(218,165,32,0.2);
    }
    
    /* Empty State Enhancement */
    .text-center.py-5 {
        background: rgba(218,165,32,0.02);
        border-radius: 15px;
        padding: 40px !important;
    }
    .text-center.py-5 i {
        filter: drop-shadow(0 2px 5px rgba(218,165,32,0.2));
    }
</style>