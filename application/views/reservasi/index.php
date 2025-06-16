<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">Data Reservasi</h1>
                    <p style="color: #CD853F;">Kelola jadwal reservasi klinik</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm rounded-4">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('reservasi/add') ?>" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                <i class="fas fa-plus me-2"></i>Tambah Reservasi
                            </a>
                            <!-- Add Report Button -->
                            <button type="button" class="btn" style="border: 1px solid #DAA520; color: #B8860B;" data-bs-toggle="modal" data-bs-target="#reportModal">
                                <i class="fas fa-chart-bar me-2"></i>Laporan
                            </button>
                        </div>
                        <div>
                            <select class="form-select" id="sortOrder" onchange="sortTable()">
                                <option value="asc">Tanggal Terlama</option>
                                <option value="desc">Tanggal Terbaru</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Add Modal at the bottom of the file -->
                <div class="modal fade" id="reportModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" style="color: #8B4513;">Generate Laporan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <form action="<?= base_url('reservasi/generate_report') ?>" method="post" target="_blank">
                                    <div class="mb-3">
                                        <label class="form-label" style="color: #8B4513;">Periode Laporan</label>
                                        <select name="period" class="form-select" required>
                                            <option value="daily">Hari Ini</option>
                                            <option value="weekly">Minggu Ini</option>
                                            <option value="monthly">Bulan Ini</option>
                                            <option value="yearly">Tahun Ini</option>
                                            <option value="custom">Kustom</option>
                                        </select>
                                    </div>
                                    
                                    <div id="customDateRange" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label" style="color: #8B4513;">Tanggal Mulai</label>
                                            <input type="date" name="start_date" class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label" style="color: #8B4513;">Tanggal Selesai</label>
                                            <input type="date" name="end_date" class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                            <i class="fas fa-file-pdf me-2"></i>Generate PDF
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr style="color: #8B4513;">
                                    <th>No</th>
                                    <th>Tanggal & Jam</th>
                                    <th>Nama Pasien</th>
                                    <th>Layanan</th>
                                    <th>Keluhan</th>
                                    <th>Harga</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($reservasi as $key => $row): ?>
                                <tr>
                                    <td><?= $key + 1 ?></td>
                                    <td>
                                        <i class="fas fa-calendar me-1" style="color: #DAA520;"></i>
                                        <?= date('d/m/Y', strtotime($row->tgl_jam)) ?>
                                        <br>
                                        <small style="color: #CD853F;">
                                            <i class="fas fa-clock me-1"></i>
                                            <?= date('H:i', strtotime($row->tgl_jam)) ?>
                                        </small>
                                    </td>
                                    <td>
                                        <i class="fas fa-user me-1" style="color: #DAA520;"></i>
                                        <?= $row->nama_pasien ?>
                                    </td>
                                    <td><?= $row->jenis_layanan ?></td>
                                    <td><?= $row->keluhan ?></td>
                                    <td>
                                        <span class="badge" style="background: linear-gradient(135deg, #DAA520, #B8860B);">
                                            Rp <?= number_format($row->harga, 0, ',', '.') ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge rounded-pill" style="background: <?= $row->status == 'Selesai' ? 'linear-gradient(135deg, #28a745, #218838)' : 'linear-gradient(135deg, #DAA520, #B8860B)' ?>">
                                            <?= $row->status ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <?php if($row->status != 'Selesai'): ?>
                                                <a href="<?= base_url('reservasi/selesai/'.$row->No) ?>" class="btn btn-sm btn-success" onclick="return confirm('Tambahkan ke rekam medis?')">
                                                    <i class="fas fa-check-circle"></i>
                                                </a>
                                            <?php endif; ?>
                                            <a href="<?= base_url('reservasi/edit/'.$row->No) ?>" class="btn btn-sm" style="background: #DAA520; color: white;">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('reservasi/delete/'.$row->No) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <a href="javascript:void(0)" 
                                               class="btn btn-sm" 
                                               style="background: #25D366; color: white;"
                                               onclick="sendWhatsApp('<?= $row->no_hp ?>', '<?= $row->nama_pasien ?>', '<?= date('d/m/Y', strtotime($row->tgl_jam)) ?>', '<?= date('H:i', strtotime($row->tgl_jam)) ?>', '<?= $row->jenis_layanan ?>', '<?= number_format($row->harga, 0, ',', '.') ?>')">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
function sendWhatsApp(phone, name, date, time, service, price) {
    // Remove any non-numeric characters from phone number
    phone = phone.replace(/\D/g, '');
    
    // Add country code if not present
    if (!phone.startsWith('62')) {
        phone = '62' + phone.replace(/^0+/, '');
    }
    
    // Create the message
    const message = `*KONFIRMASI RESERVASI KLINIK DE LUNA*\n\n`
        + `Yth. ${name},\n\n`
        + `Berikut detail reservasi Anda:\n`
        + `📅 Tanggal: ${date}\n`
        + `⏰ Jam: ${time}\n`
        + `💉 Layanan: ${service}\n`
        + `💰 Biaya: Rp ${price}\n\n`
        + `Mohon hadir 15 menit sebelum jadwal yang ditentukan.\n\n`
        + `Terima kasih telah memilih Klinik De Luna sebagai partner kesehatan Anda.`;
    
    // Encode the message for URL
    const encodedMessage = encodeURIComponent(message);
    
    // Create and open WhatsApp URL
    const whatsappURL = `https://wa.me/${phone}?text=${encodedMessage}`;
    window.open(whatsappURL, '_blank');
}

$(document).ready(function() {
    $('select[name="period"]').on('change', function() {
        if ($(this).val() === 'custom') {
            $('#customDateRange').show();
        } else {
            $('#customDateRange').hide();
        }
    });
});
</script>
