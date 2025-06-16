<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;"><?= $title ?></h1>
                    <p style="color: #CD853F;">Form rekam medis pasien</p>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label" style="color: #8B4513;">Pasien</label>
                                            <div class="input-group">
                                                <span class="input-group-text" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white; border: none;"><i class="fas fa-user"></i></span>
                                                <select name="id_pasien" class="form-select" required <?= isset($rekam_medis) ? 'disabled' : '' ?>>
                                                    <option value="">Pilih Pasien</option>
                                                    <?php foreach($pasien as $p): ?>
                                                        <option value="<?= $p->id_pasien ?>" <?= isset($rekam_medis) && $rekam_medis->id_pasien == $p->id_pasien ? 'selected' : '' ?>>
                                                            <?= $p->nama_pasien ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Layanan</label>
                                            <div class="input-group">
                                                <span class="input-group-text"><i class="fas fa-th"></i></span>
                                                <select name="id_layanan" class="form-select" required>
                                                    <option value="">Pilih Layanan</option>
                                                    <?php foreach($layanan as $l): ?>
                                                        <option value="<?= $l->No ?>" <?= isset($rekam_medis) && $rekam_medis->id_layanan == $l->No ? 'selected' : '' ?>>
                                                            <?= $l->jenis_layanan ?> - Rp <?= number_format($l->harga, 0, ',', '.') ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Keluhan</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-comment-medical"></i></span>
                                        <textarea class="form-control" name="keluhan" rows="2" required><?= isset($rekam_medis) ? $rekam_medis->keluhan : '' ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Diagnosa</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-stethoscope"></i></span>
                                        <textarea class="form-control" name="diagnosa" rows="2" required><?= isset($rekam_medis) ? $rekam_medis->diagnosa : '' ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Tindakan</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-hand-holding-medical"></i></span>
                                        <textarea class="form-control" name="tindakan" rows="2" required><?= isset($rekam_medis) ? $rekam_medis->tindakan : '' ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Obat</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-pills"></i></span>
                                        <select name="obat[]" class="form-control select2" multiple required>
                                            <?php foreach($obat as $o): ?>
                                                <option value="<?= $o->nama_obat ?>" data-harga="<?= $o->harga ?>">
                                                    <?= $o->nama_obat ?> - Rp <?= number_format($o->harga, 0, ',', '.') ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Keterangan</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fas fa-clipboard"></i></span>
                                        <textarea class="form-control" name="keterangan" rows="2"><?= isset($rekam_medis) ? $rekam_medis->keterangan : '' ?></textarea>
                                    </div>
                                </div>

                                <!-- Payment Section -->
                                <hr>
                                <h5 class="mb-3" style="color: #8B4513;">Pembayaran</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Harga Layanan</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" class="form-control" id="harga_layanan" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="form-label">Harga Obat</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input type="text" class="form-control" id="harga_obat" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Total Bayar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" id="total_bayar" name="total_bayar" readonly>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Uang Bayar</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" id="uang_bayar" name="uang_bayar" required>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Kembalian</label>
                                    <div class="input-group">
                                        <span class="input-group-text">Rp</span>
                                        <input type="text" class="form-control" id="kembalian" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer bg-white">
                                <button type="button" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;" id="btnSimpan">
                                    <i class="fas fa-save me-2"></i>Simpan
                                </button>
                                <button type="submit" class="btn" style="background: linear-gradient(135deg, #DAA520, #B8860B); color: white;" id="btnPrint">
                                    <i class="fas fa-print me-2"></i>Print
                                </button>
                                <button type="button" class="btn" style="background: #25D366; color: white;" id="btnWhatsApp" onclick="sendToWhatsApp()">
                                    <i class="fab fa-whatsapp me-2"></i>Kirim ke WhatsApp
                                </button>
                                <a href="<?= base_url('rekam_medis') ?>" class="btn" style="border: 1px solid #DAA520; color: #B8860B;">
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
                                Silakan isi form rekam medis dengan lengkap. Data yang dimasukkan akan menjadi bagian dari riwayat kesehatan pasien.
                            </p>
                            <hr style="border-color: #DAA520;">
                            <div style="color: #CD853F;">
                                <small>
                                    <i class="fas fa-exclamation-circle me-1" style="color: #DAA520;"></i>
                                    Untuk pemilihan obat, Anda dapat memilih lebih dari satu obat.
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<script>
$(document).ready(function() {
    $('.select2').select2({
        theme: 'bootstrap-5',
        width: '100%'
    });

    // Format number to currency
    function formatRupiah(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    // Parse currency string to number
    function parseRupiah(string) {
        return parseInt(string.replace(/[^\d]/g, ''));
    }

    // Update calculations when layanan changes
    $('select[name="id_layanan"]').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var hargaText = selectedOption.text().split('Rp ')[1];
        var harga = hargaText ? parseRupiah(hargaText) : 0;
        $('#harga_layanan').val(formatRupiah(harga));
        updateTotal();
    });

    // Update calculations when obat changes
    $('select[name="obat[]"]').on('change', function() {
        var totalObat = 0;
        $(this).find('option:selected').each(function() {
            var hargaText = $(this).text().split('Rp ')[1];
            totalObat += parseRupiah(hargaText);
        });
        $('#harga_obat').val(formatRupiah(totalObat));
        updateTotal();
    });

    // Calculate total and kembalian
    function updateTotal() {
        var hargaLayanan = parseRupiah($('#harga_layanan').val() || '0');
        var hargaObat = parseRupiah($('#harga_obat').val() || '0');
        var total = hargaLayanan + hargaObat;
        $('#total_bayar').val(formatRupiah(total));
        
        var uangBayar = parseRupiah($('#uang_bayar').val() || '0');
        var kembalian = uangBayar - total;
        $('#kembalian').val(formatRupiah(kembalian));
    }

    // Format input uang bayar
    $('#uang_bayar').on('input', function() {
        var value = $(this).val().replace(/[^\d]/g, '');
        $(this).val(formatRupiah(value));
        updateTotal();
    });

    // Trigger initial calculation
    $('select[name="id_layanan"]').trigger('change');

    // Handle form submission
    $('form').on('submit', function(e) {
        e.preventDefault();
        
        // Get form data
        var formData = {
            pasien: $('select[name="id_pasien"] option:selected').text(),
            layanan: $('select[name="id_layanan"] option:selected').text(),
            obat: $('select[name="obat[]"]').val(),
            harga_layanan: $('#harga_layanan').val(),
            harga_obat: $('#harga_obat').val(),
            total_bayar: $('#total_bayar').val(),
            uang_bayar: $('#uang_bayar').val(),
            kembalian: $('#kembalian').val()
        };

        // Submit form via AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Open receipt in new window
                var receiptWindow = window.open('', '_blank', 'width=400,height=800');
                receiptWindow.document.write(`
                    <html>
                    <head>
                        <title>Struk Pembayaran - Klinik De Luna</title>
                        <style>
                            body { font-family: Arial, sans-serif; margin: 20px; font-size: 12px; }
                            .header { text-align: center; margin-bottom: 20px; }
                            .header h2 { margin: 0; font-size: 18px; }
                            .header p { margin: 5px 0; }
                            .content { margin-bottom: 20px; }
                            .item { display: flex; justify-content: space-between; margin: 5px 0; }
                            .divider { border-top: 1px dashed #000; margin: 10px 0; }
                            .total { font-weight: bold; font-size: 14px; }
                            .footer { text-align: center; font-size: 11px; margin-top: 20px; }
                            .medical-info { margin: 10px 0; padding: 10px; border: 1px dashed #000; }
                            @media print {
                                @page { margin: 0; }
                                body { margin: 10px; }
                            }
                        </style>
                    </head>
                    <body>
                        <div class="header">
                            <h2>KLINIK DE LUNA</h2>
                            <p>Perumahan Mahkota Regency Blok K11 No.44 (sebrang UNSIKA).</p>
                            <p>Telp: (022) 123456</p>
                            <div class="divider"></div>
                            <p>No. Transaksi: DL-${new Date().getTime()}</p>
                            <p>${new Date().toLocaleString('id-ID', { 
                                weekday: 'long',
                                year: 'numeric',
                                month: 'long',
                                day: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            })}</p>
                        </div>
                        <div class="content">
                            <div class="medical-info">
                                <div class="item">
                                    <span>Nama Pasien:</span>
                                    <span>${formData.pasien}</span>
                                </div>
                                <div class="item">
                                    <span>Keluhan:</span>
                                    <span>${$('textarea[name="keluhan"]').val()}</span>
                                </div>
                                <div class="item">
                                    <span>Diagnosa:</span>
                                    <span>${$('textarea[name="diagnosa"]').val()}</span>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="item">
                                <span>Jenis Layanan:</span>
                                <span>${formData.layanan.split('-')[0]}</span>
                            </div>
                            <div class="item">
                                <span>Biaya Layanan:</span>
                                <span>${formData.harga_layanan}</span>
                            </div>
                            <div class="divider"></div>
                            <div>
                                <p style="margin: 5px 0;">Obat-obatan:</p>
                                ${formData.obat.map(obat => `
                                    <div class="item">
                                        <span>- ${obat}</span>
                                    </div>
                                `).join('')}
                                <div class="item" style="margin-top: 5px;">
                                    <span>Total Biaya Obat:</span>
                                    <span>${formData.harga_obat}</span>
                                </div>
                            </div>
                            <div class="divider"></div>
                            <div class="item total">
                                <span>Total Pembayaran:</span>
                                <span>${formData.total_bayar}</span>
                            </div>
                            <div class="item">
                                <span>Tunai:</span>
                                <span>${formData.uang_bayar}</span>
                            </div>
                            <div class="item">
                                <span>Kembalian:</span>
                                <span>${formData.kembalian}</span>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="footer">
                            <p>Terima kasih atas kepercayaan Anda</p>
                            <p>Semoga lekas sembuh</p>
                            <p style="font-size: 10px; margin-top: 10px;">
                                * Simpan struk ini sebagai bukti pembayaran
                                <br>* Struk ini merupakan bukti pembayaran yang sah
                            </p>
                        </div>
                    </body>
                    </html>
                `);
                receiptWindow.document.close();
                receiptWindow.print();

                // Redirect after printing
                window.location.href = '<?= base_url('rekam_medis') ?>';
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data');
            }
        });
    });
});
</script>

<script>
// Add this function at the end of your existing script
function sendToWhatsApp() {
    var patientId = $('select[name="id_pasien"]').val();
    
    var receiptData = {
        pasien: $('select[name="id_pasien"] option:selected').text(),
        layanan: $('select[name="id_layanan"] option:selected').text().split('-')[0],
        keluhan: $('textarea[name="keluhan"]').val(),
        diagnosa: $('textarea[name="diagnosa"]').val(),
        tindakan: $('textarea[name="tindakan"]').val(),
        obat: $('select[name="obat[]"]').val().join(', '),
        harga_layanan: $('#harga_layanan').val(),
        harga_obat: $('#harga_obat').val(),
        total_bayar: $('#total_bayar').val(),
        no_transaksi: 'DL-' + new Date().getTime()
    };

    $.ajax({
        url: '<?= base_url('rekam_medis/get_patient_phone') ?>',
        type: 'POST',
        data: { id_pasien: patientId },
        success: function(response) {
            var phone = JSON.parse(response).phone;
            phone = phone.replace(/\D/g, '');
            if (!phone.startsWith('62')) {
                phone = '62' + phone.replace(/^0+/, '');
            }

            var date = new Date();
            var formattedDate = date.toLocaleString('id-ID', { 
                weekday: 'long',
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            var formattedTime = date.toLocaleString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            }) + ' WIB';

            var message = 
                `*KLINIK DE LUNA - STRUK PEMBAYARAN*\n` +
                `━━━━━━━━━━━━━━━━━━━━━━━\n\n` +
                `*Detail Transaksi*\n` +
                `No     : ${receiptData.no_transaksi}\n` +
                `Tgl    : ${formattedDate}\n` +
                `Pukul  : ${formattedTime}\n\n` +
                `*Data Pasien*\n` +
                `Nama   : ${receiptData.pasien.trim().split(/\s+/).map(word => word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()).join(' ')}\n\n` +
                `*Pemeriksaan*\n` +
                `Keluhan : ${receiptData.keluhan}\n` +
                `Diagnosa: ${receiptData.diagnosa}\n` +
                `Tindakan: ${receiptData.tindakan}\n\n` +
                `*Obat yang Diberikan*\n` +
                `- ${receiptData.obat}\n\n` +
                `*Rincian Pembayaran*\n` +
                `Layanan : ${receiptData.harga_layanan}\n` +
                `Obat    : ${receiptData.harga_obat}\n` +
                `━━━━━━━━━━━━━━━━━━━━━━━\n` +
                `*Total   : ${receiptData.total_bayar}*\n\n` +
                `*Klinik De Luna*\n` +
                `Perumahan Mahkota Regency\n` +
                `Blok K11 No.44 (seberang UNSIKA)\n` +
                `Telp: (022) 123456\n\n` +
                `━━━━━━━━━━━━━━━━━━━━━━━\n` +
                `_Semoga lekas sembuh_\n` +
                `_*Struk ini merupakan bukti pembayaran yang sah*_\n` +
                `_Terima kasih atas kepercayaan Anda_`;

            window.open(`https://wa.me/${phone}?text=${encodeURIComponent(message)}`, '_blank');
        },
        error: function() {
            alert('Gagal mendapatkan nomor telepon pasien');
        }
    });
}
</script>

// Add save button functionality
<script>
// Add save button functionality
$(document).ready(function() {
    $('#btnSimpan').on('click', function() {
        $.ajax({
            url: $('form').attr('action'),
            type: 'POST',
            data: $('form').serialize(),
            success: function(response) {
                alert('Data berhasil disimpan');
                window.location.href = '<?= base_url('rekam_medis') ?>';
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data');
            }
        });
    });
});
</script>