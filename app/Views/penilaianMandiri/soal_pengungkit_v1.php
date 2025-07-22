<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<div class="row">
    <div class="demo-vertical-spacing">
        <div class="progress">
            <div
                class="progress-bar"
                role="progressbar"
                style="width: 25%"
                aria-valuenow="25"
                aria-valuemin="0"
                aria-valuemax="100">
                25% PM
            </div>
        </div>
        <div class="progress">
            <div
                class="progress-bar bg-info"
                role="progressbar"
                style="width: 50%"
                aria-valuenow="50"
                aria-valuemin="0"
                aria-valuemax="100">
                50% PK
            </div>
        </div>
        <div class="progress">
            <div
                class="progress-bar bg-success"
                role="progressbar"
                style="width: 75%"
                aria-valuenow="75"
                aria-valuemin="0"
                aria-valuemax="100">
                75% Level
            </div>
        </div>
    </div>
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body p-2">
                        <h5 class="card-title text-primary mt-2">A. KOMPONEN PENGUNGKIT</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 order-0 mt-4">
        <?php
        $displayedUnsur = [];
        $displayedSubUnsur = [];

        foreach ($syncedData as $index => $row) : ?>
            <!-- Menampilkan nama_unsur hanya sekali dan membuat card baru untuk setiap nama_unsur -->
            <?php if (!in_array($row['nama_unsur'], $displayedUnsur)) : ?>
                <?php if (!empty($displayedUnsur)) : ?>
                    <!-- Tutup div sebelumnya jika ini bukan card pertama -->
    </div>
</div>
<?php endif; ?>
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title text-primary">
            <?= $row['nama_unsur']; ?>
            <h5>
                <hr>
    </div>
    <div class="card-body">
        <?php $displayedUnsur[] = $row['nama_unsur']; ?>
    <?php endif; ?>

    <!-- Menampilkan name_sub_unsur hanya sekali -->
    <h5 class="mt-4 text-primary">
        <?php if (!in_array($row['name_sub_unsur'], $displayedSubUnsur)) : ?>
            <?= $row['name_sub_unsur']; ?>
            <?php $displayedSubUnsur[] = $row['name_sub_unsur']; ?>
        <?php endif; ?>
    </h5>

    <div class="row">
        <div class="col-md mb-4 mb-md-0">
            <div class="accordion mt-3" id="accordionExample<?= $index; ?>">
                <div class="card accordion-item">
                    <h2 class="accordion-header" id="heading<?= $index; ?>">
                        <button type="button" class="accordion-button <?= $index === 0 ? '' : 'collapsed'; ?>"
                            data-bs-toggle="collapse"
                            data-bs-target="#accordion<?= $index; ?>"
                            aria-expanded="<?= $index === 0 ? 'true' : 'false'; ?>"
                            aria-controls="accordion<?= $index; ?>">
                            <?= $row['nama_indikator']; ?>
                        </button>
                    </h2>
                    <div id="accordion<?= $index; ?>"
                        class="accordion-collapse collapse <?= $index === 0 ? 'show' : ''; ?>"
                        aria-labelledby="heading<?= $index; ?>"
                        data-bs-parent="#accordionExample<?= $index; ?>">
                        <div class="accordion-body">

                            <!-- Ambil data nilai_pm jika ada -->
                            <?php $n_pm = !empty($row['nilai_pm']) ? reset($row['nilai_pm']) : null; ?>


                            <!-- Input Link Dakung -->
                            <label for="linkDakung<?= $index; ?>" class="form-label">Link Dakung:</label>
                            <div class="input-group">
                                <?php if (!empty($n_pm['link_dakung'])) : ?>
                                    <a href="<?= $n_pm['link_dakung']; ?>"
                                        class="input-group-text"
                                        id="basic-addon<?= $index; ?>"
                                        target="_blank">
                                        <i class="bx bxs-file-pdf text-danger fs-2"></i>
                                    </a>
                                    <input type="text"
                                        class="form-control"
                                        placeholder="URL"
                                        id="linkDakung<?= $index; ?>"
                                        aria-describedby="basic-addon<?= $index; ?>"
                                        value="<?= $n_pm['link_dakung']; ?>" />
                                <?php else : ?>
                                    <span class="input-group-text"
                                        id="basic-addon<?= $index; ?>">https://drive.google.com/drive/</span>
                                    <input type="text"
                                        class="form-control"
                                        placeholder="URL"
                                        id="linkDakung<?= $index; ?>"
                                        aria-describedby="basic-addon<?= $index; ?>"
                                        value="" />
                                <?php endif; ?>
                            </div>

                            <!-- Select Nilai -->
                            <div>
                                <label for="nilaiSelect<?= $index; ?>" class="form-label">Nilai:</label>
                                <select id="nilaiSelect<?= $index; ?>" class="form-select form-select-sm">
                                    <option value="" selected disabled>Pilih Nilai</option>
                                    <?php foreach ($row['jawaban'] as $jawab): ?>
                                        <option value="<?= $jawab['id']; ?>"
                                            <?= $n_pm && $jawab['id'] == $n_pm['nilai'] ? 'selected' : ''; ?>>
                                            <?= $jawab['desc']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <!-- Tombol Simpan -->
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-info mt-2"
                                onclick="<?= ($role == 4) ? "handleSave($index, '{$row['id_indikator']}')" : 'return false;'; ?>" <?= $role != 4 ? 'hidden' : ''; ?>>
                                Simpan
                            </a>
                        </div>

                        <div class="accordion-body" <?= ($role != 11 && $role != 10) ? 'hidden' : ''; ?>>
                            <!-- Ambil data nilai_pk jika ada -->
                            <?php $n_pk = !empty($row['nilai_pk']) ? reset($row['nilai_pk']) : null; ?>

                            <div>
                                <label for="nilaiSelectPK<?= $index; ?>" class="form-label">Nilai PK:</label>
                                <select id="nilaiSelectPK<?= $index; ?>" class="form-select form-select-sm">
                                    <option value="" selected disabled>Pilih Nilai</option>
                                    <?php foreach ($row['jawaban'] as $jawab): ?>
                                        <option value="<?= $jawab['id']; ?>"
                                            <?= $n_pk && $jawab['id'] == $n_pk['nilai'] ? 'selected' : ''; ?>>
                                            <?= $jawab['desc']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="komentarPK<?= $index; ?>" class="form-label">Komentar</label>
                                <textarea class="form-control" id="komentarPK<?= $index; ?>" rows="3" style="resize: none;"><?= $n_pk['komenpk'] ?? ''; ?></textarea>
                            </div>
                            <div>
                                <label for="rekomendasiPK<?= $index; ?>" class="form-label">Rekomendasi</label>
                                <textarea class="form-control" id="rekomendasiPK<?= $index; ?>" rows="3" style="resize: none;"><?= $n_pk['rekomendasi'] ?? ''; ?></textarea>
                            </div>
                            <!-- Tombol Simpan -->
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-info mt-2" onclick="<?= ($role == 11 || $role == 11) ? "handleSave($index, '{$row['id_indikator']}')" : 'return false;'; ?>" <?= !($role == 11 || $role == 11) ? 'hidden' : ''; ?>>Simpan</a>
                        </div>

                        <div class="accordion-body" <?= ($role === 10 || $role === 11 || $role === 12 || $role === 13) ? '' : 'hidden'; ?>>
                            <!-- Mengambil data nilai_lvl jika ada -->
                            <?php $n_lvl = !empty($row['nilai_lvl']) ? reset($row['nilai_lvl']) : null; ?>

                            <div>
                                <label for="nilaiSelectlvl<?= $index; ?>" class="form-label">Nilai Leveling:</label>
                                <select id="nilaiSelectlvl<?= $index; ?>" class="form-select form-select-sm">
                                    <option value="" selected disabled>Pilih Nilai</option>
                                    <?php foreach ($row['jawaban'] as $jawab): ?>
                                        <option value="<?= $jawab['id']; ?>"
                                            <?= $n_lvl && $jawab['id'] == $n_lvl['nilai'] ? 'selected' : ''; ?>>
                                            <?= $jawab['desc']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="komentarLvl<?= $index; ?>" class="form-label">Komentar</label>
                                <textarea class="form-control" id="komentarlvl<?= $index; ?>" rows="3" style="resize: none;"><?= $n_lvl['komenlvl'] ?? ''; ?></textarea>
                            </div>
                            <div>
                                <label for="rekomendasiLvl<?= $index; ?>" class="form-label">Rekomendasi</label>
                                <textarea class="form-control" id="rekomendasilvl<?= $index; ?>" rows="3" style="resize: none;"><?= $n_lvl['rekomendasi'] ?? ''; ?></textarea>
                            </div>
                            <!-- Tombol Simpan -->
                            <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-info mt-2" onclick="<?= ($role == 13 || $role == 13) ? "handleSave($index, '{$row['id_indikator']}')" : 'return false;'; ?>" <?= !($role == 13 || $role == 13) ? 'hidden' : ''; ?>>Simpan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Tutup card terakhir -->
<?php if (!empty($displayedUnsur)) : ?>
    </div>
</div>
<?php endif; ?>

<div class="d-flex justify-content-between mt-3">
    <a href="javascript:void(0);" class="btn btn-secondary disabled">Sebelumnya</a>
    <a href="javascript:void(0);" class="btn btn-secondary" onclick="handleNextClick()">Selanjutnya</a>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!-- <div class="d-flex justify-content-between mt-3">
                            <a href="javascript:void(0);" class="btn btn-secondary">Prev</a>
                            <a href="javascript:void(0);" class="btn btn-secondary" onclick="handleNextClick()">Next</a>
                        </div> -->

<script>
    function handleSave(index, idPmSatker) {
        const linkDakung = document.getElementById('linkDakung' + index);
        const nilaiSelect = document.getElementById('nilaiSelect' + index);
        const userId = <?= json_encode(session()->get('id')); ?>;
        const satkerId = <?= json_encode(session()->get('id_satker')); ?>;
        const tahun = '2024';

        // Cek jika elemen tidak ada
        if (!linkDakung || !nilaiSelect) {
            console.error('Elemen tidak ditemukan untuk index:', index);
            alert('Terjadi kesalahan, elemen tidak ditemukan!');
            return;
        }

        const linkDakungValue = linkDakung.value;
        const nilaiSelectValue = nilaiSelect.value;

        // Cek jika linkDakung kosong
        if (!linkDakungValue) {
            alert('Link Dakung tidak boleh kosong!');
            return;
        }

        // Cek jika nilaiSelect tidak dipilih
        if (!nilaiSelectValue) {
            alert('Silakan pilih nilai!');
            return;
        }

        // Kirim data ke server (gunakan AJAX atau metode lain)
        // console.log('Link Dakung:', linkDakungValue);
        // console.log('Nilai:', nilaiSelectValue);
        // console.log('ID:', userId);
        // console.log('ID Satker:', satkerId);
        // console.log('tahun:', tahun);
        // console.log('ID PM Satker:', idPmSatker);

        // Lakukan pengiriman data ke server di sini        
        $.ajax({
            url: '<?= base_url('/soal/save') ?>', // URL endpoint untuk menyimpan data
            type: 'POST',
            data: {
                linkDakung: linkDakungValue,
                nilaiSelect: nilaiSelectValue,
                id: userId,
                satkerId: satkerId,
                tahun: tahun,
                idPmSatker: idPmSatker
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    // Lakukan tindakan lain jika diperlukan, seperti memperbarui UI
                    $(`#basic-addon${index}`).replaceWith(`
                    <a href="${linkDakungValue}" 
                        class="input-group-text"
                        id="basic-addon${index}" 
                        target="_blank">
                        <i class="bx bxs-file-pdf text-danger fs-2"></i>
                    </a>
                    `);
                    linkDakung.value = linkDakungValue; // Set ulang nilai input
                } else {
                    alert('Gagal menyimpan data: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('Terjadi kesalahan saat mengirim data!');
            }
        });
    }

    function handleSavePK(index, idPmSatker) {
        const nilaiSelectPK = document.getElementById('nilaiSelectPK' + index);
        const komentarPK = document.getElementById('komentarPK' + index);
        const rekomenPK = document.getElementById('rekomendasiPK' + index).value;
        const tahun = '2024';
        const userId = <?= json_encode(session()->get('id')); ?>;
        const satkerId = <?= json_encode(session()->get('id_satker')); ?>;

        // Cek jika elemen tidak ada
        if (!nilaiSelectPK) {
            console.error('Elemen tidak ditemukan untuk index:', index);
            alert('Terjadi kesalahan, elemen tidak ditemukan!');
            return;
        }

        const nilaiSelectPKValue = nilaiSelectPK.value;
        const komentarPKValue = komentarPK.value;

        // Cek jika nilaiSelectPK tidak dipilih
        if (!nilaiSelectPKValue) {
            alert('Silakan pilih nilai!');
            return;
        }

        // Kirim data ke server (gunakan AJAX atau metode lain)
        $.ajax({
            url: '<?= base_url('/soal/savePK') ?>', // URL endpoint untuk menyimpan data
            type: 'POST',
            data: {
                nilaiSelectPK: nilaiSelectPKValue,
                komentarPK: komentarPKValue,
                rekomenPK: rekomenPK,
                id: userId,
                satkerId: satkerId,
                tahun: tahun,
                idPmSatker: idPmSatker
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert('Gagal menyimpan data: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('Terjadi kesalahan saat mengirim data!');
            }
        });
    }

    function handleSavelvl(index, idPmSatker) {
        const nilaiSelectlvl = document.getElementById('nilaiSelectlvl' + index).value; // Ambil nilai
        const komentarlvl = document.getElementById('komentarlvl' + index).value; // Ambil nilai komentar
        const rekomenlvl = document.getElementById('rekomendasilvl' + index).value; // Ambil nilai rekomendasi
        const tahun = '2024';
        const userId = <?= json_encode(session()->get('id')); ?>;
        const satkerId = <?= json_encode(session()->get('id_satker')); ?>;

        // Cek jika nilaiSelectlvl tidak dipilih
        if (!nilaiSelectlvl) {
            alert('Silakan pilih nilai level !');
            return;
        }

        // Debugging: Cek nilai yang diambil
        // console.log('Nilai Select Level:', nilaiSelectlvl);
        // console.log('Komentar Level:', komentarlvl);
        // console.log('Rekomendasi Level:', rekomenlvl);

        $.ajax({
            url: '<?= base_url('/soal/savelvl') ?>', // URL endpoint untuk menyimpan data
            type: 'POST',
            data: {
                nilaiSelectlvl: nilaiSelectlvl,
                komentarlvl: komentarlvl,
                rekomenlvl: rekomenlvl,
                id: userId,
                satkerId: satkerId,
                tahun: tahun,
                idPmSatker: idPmSatker
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                } else {
                    alert('Gagal menyimpan data: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('Terjadi kesalahan saat mengirim data!');
            }
        });
    }
</script>

<?= $this->endSection(); ?>