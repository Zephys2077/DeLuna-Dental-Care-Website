<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h1 class="m-0" style="background: linear-gradient(135deg, #B8860B, #DAA520); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 700;">Rekam Medis</h1>
                    <p style="color: #CD853F;">Riwayat rekam medis pasien</p>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card shadow-sm rounded-4">
                <div class="card-body">
                    <div class="accordion" id="rekamMedisAccordion">
                        <?php foreach($grouped_records as $id_pasien => $records): ?>
                            <div class="accordion-item border rounded-3 mb-3 shadow-sm">
                                <h2 class="accordion-header" id="heading<?= $id_pasien ?>">
                                    <button class="accordion-button collapsed rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $id_pasien ?>">
                                        <i class="fas fa-user-circle me-2" style="color: #DAA520;"></i>
                                        <div class="d-flex align-items-center flex-grow-1">
                                            <div>
                                                <strong style="color: #8B4513;"><?= $records[0]->nama_pasien ?></strong>
                                                <small style="color: #CD853F;" class="ms-2">(ID: <?= $id_pasien ?>)</small>
                                            </div>
                                            <div class="ms-auto">
                                                <span class="badge rounded-pill" style="background: linear-gradient(135deg, #DAA520, #B8860B);">
                                                    <i class="fas fa-calendar-check me-1"></i>
                                                    <?= count($records) ?> Kunjungan
                                                </span>
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="collapse<?= $id_pasien ?>" class="accordion-collapse collapse" data-bs-parent="#rekamMedisAccordion">
                                    <div class="accordion-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <thead style="background: linear-gradient(135deg, #FFF8DC, #FAFAD2);">
                                                    <tr style="color: #8B4513;">
                                                        <th>No</th>
                                                        <th>Tanggal</th>
                                                        <th>Layanan</th>
                                                        <th>Keluhan</th>
                                                        <th>Diagnosa</th>
                                                        <th>Tindakan</th>
                                                        <th>Obat</th>
                                                        <th>Keterangan</th>
                                                        <th class="text-center">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($records as $key => $row): ?>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td>
                                                            <i class="fas fa-calendar me-1" style="color: #DAA520;"></i>
                                                            <?= date('d/m/Y', strtotime($row->tanggal)) ?>
                                                            <br>
                                                            <small style="color: #CD853F;">
                                                                <i class="fas fa-clock me-1"></i>
                                                                <?= date('H:i', strtotime($row->tanggal)) ?>
                                                            </small>
                                                        </td>
                                                        <td><?= $row->jenis_layanan ?></td>
                                                        <td><?= $row->keluhan ?></td>
                                                        <td><?= $row->diagnosa ?></td>
                                                        <td><?= $row->tindakan ?></td>
                                                        <td>
                                                            <i class="fas fa-pills me-1" style="color: #DAA520;"></i>
                                                            <?= $row->obat ?>
                                                        </td>
                                                        <td><?= $row->keterangan ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group" role="group">
                                                                <a href="<?= base_url('rekam_medis/edit/'.$row->id) ?>" class="btn btn-sm" style="background: #DAA520; color: white;" title="Edit">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <a href="<?= base_url('rekam_medis/delete/'.$row->id) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                                                    <i class="fas fa-trash"></i>
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
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>