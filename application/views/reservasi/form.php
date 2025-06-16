<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;"><?= $title ?></h1>
                    <p style="color: #CD853F;">Form reservasi layanan klinik</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card shadow-sm rounded-4">
                        <form action="" method="post">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Pasien</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-user"></i></span>
                                        <select name="id_pasien" class="form-control select2-pasien" required>
                                            <option value="">Cari Pasien...</option>
                                            <?php foreach($pasien as $p): ?>
                                                <option value="<?= $p->id_pasien ?>" <?= isset($reservasi) && $reservasi->id_pasien == $p->id_pasien ? 'selected' : '' ?>>
                                                    <?= $p->id_pasien ?> - <?= $p->nama_pasien ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Layanan</label>
                                    <div id="layananContainer">
                                        <div class="input-group mb-2">
                                            <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-th"></i></span>
                                            <select name="id_layanan[]" class="form-select layanan-select" required>
                                                <option value="">Pilih Layanan</option>
                                                <?php foreach($layanan as $l): ?>
                                                    <option value="<?= $l->No ?>" data-duration="<?= $l->waktu_pengerjaan ?>" data-price="<?= $l->harga ?>">
                                                        <?= $l->jenis_layanan ?> 
                                                        (<?= $l->waktu_pengerjaan ?> - Rp <?= number_format($l->harga, 0, ',', '.') ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="button" class="btn btn-sm" style="border: 1px solid #DAA520; color: #B8860B;" onclick="removeLayanan(this)">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm mt-2" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;" onclick="addLayanan()">
                                        <i class="fas fa-plus me-1"></i>Tambah Layanan
                                    </button>
                                    <div class="mt-3">
                                        <small class="text-muted">Total Durasi: <span id="totalDuration">0 menit</span></small>
                                        <small class="text-muted ms-3">Total Harga: Rp <span id="totalPrice">0</span></small>
                                    </div>
                                </div>

<!-- Add this script before the existing script -->
<script>
function addLayanan() {
    const container = document.getElementById('layananContainer');
    const template = container.children[0].cloneNode(true);
    template.querySelector('select').value = '';
    container.appendChild(template);
    updateTotals();
}

function removeLayanan(btn) {
    if (document.getElementsByClassName('layanan-select').length > 1) {
        btn.closest('.input-group').remove();
        updateTotals();
    }
}

function updateTotals() {
    let totalDuration = 0;
    let totalPrice = 0;
    
    document.querySelectorAll('.layanan-select').forEach(select => {
        const option = select.options[select.selectedIndex];
        if (option.value) {
            const duration = parseInt(option.dataset.duration);
            const price = parseInt(option.dataset.price);
            totalDuration += duration;
            totalPrice += price;
        }
    });
    
    document.getElementById('totalDuration').textContent = totalDuration + ' menit';
    document.getElementById('totalPrice').textContent = new Intl.NumberFormat('id-ID').format(totalPrice);
}

document.getElementById('layananContainer').addEventListener('change', function(e) {
    if (e.target.classList.contains('layanan-select')) {
        updateTotals();
        if ($('input[name="tgl_jam"]').val()) {
            checkTimeAvailability();
        }
    }
});
</script>

                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Tanggal & Jam</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-calendar"></i></span>
                                        <input type="datetime-local" class="form-control" name="tgl_jam" value="<?= isset($reservasi) ? date('Y-m-d\TH:i', strtotime($reservasi->tgl_jam)) : '' ?>" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label" style="color: #8B4513;">Keluhan</label>
                                    <div class="input-group">
                                        <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-comment-medical"></i></span>
                                        <textarea class="form-control" name="keluhan" rows="3" required><?= isset($reservasi) ? $reservasi->keluhan : '' ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white">
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <a href="<?= base_url('reservasi') ?>" class="btn" style="border: 1px solid #DAA520; color: #B8860B;">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card shadow-sm rounded-4" style="background: linear-gradient(135deg, #FFF8DC, #FAFAD2);">
                        <div class="card-body">
                            <h5 class="card-title" style="color: #8B4513;">
                                <i class="fas fa-info-circle me-2" style="color: #DAA520;"></i>Informasi
                            </h5>
                            <p class="card-text" style="color: #8B4513;">
                                Silakan isi form reservasi dengan lengkap. Pastikan data pasien dan layanan yang dipilih sudah benar.
                            </p>
                            <hr style="border-color: #DAA520;">
                            <p class="mb-0" style="color: #8B4513;">
                                <i class="fas fa-clock me-2" style="color: #DAA520;"></i>
                                Jam Praktik:
                            </p>
                            <ul class="list-unstyled ms-4 mb-0" style="color: #8B4513;">
                                <li>Senin - Sabtu: 08:00 - 17:00</li>
                                <li>Minggu: Tutup</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
$(document).ready(function() {
    function checkTimeAvailability() {
        var selectedTime = $('input[name="tgl_jam"]').val();
        var layananIds = [];
        $('.layanan-select').each(function() {
            if (this.value) layananIds.push(this.value);
        });
        
        if (selectedTime && layananIds.length > 0) {
            $.ajax({
                url: '<?= base_url("reservasi/check_available_time") ?>',
                type: 'POST',
                data: {
                    selected_time: selectedTime,
                    layanan_ids: layananIds.join(',') // Convert array to comma-separated string
                },
                success: function(response) {
                    try {
                        const result = JSON.parse(response);
                        if (!result.available) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Jadwal Tidak Tersedia',
                                text: 'Maaf, jadwal yang dipilih sudah terisi. Silakan pilih waktu lain.',
                                confirmButtonColor: '#DAA520',
                                confirmButtonText: 'Pilih Waktu Lain'
                            }).then((result) => {
                                $('input[name="tgl_jam"]').val('');
                            });
                        }
                    } catch (e) {
                        console.error('Parse error:', e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                }
            });
        }
    }

    // Update event listeners
    $('input[name="tgl_jam"]').on('change', checkTimeAvailability);
    $(document).on('change', '.layanan-select', function() {
        if ($('input[name="tgl_jam"]').val()) {
            checkTimeAvailability();
        }
    });
});
</script>
