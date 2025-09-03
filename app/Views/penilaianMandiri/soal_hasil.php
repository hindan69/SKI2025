<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<?php
$pm_satker = 0;
$n_pm = 0;
$persentase_pm = 0;
$n_pk = 0;
$persentase_pk = 0;
$n_lvl = 0;
$persentase_lvl = 0;

foreach ($presen as $data) {
    if ($data['id_unsur'] >= 5 and $data['id_unsur'] <= 9) {
        $pm_satker += $data['jumlah_pm_satker'];
        $n_pm += $data['jumlah_nilai_pm'];
        $n_pk += $data['jumlah_nilai_pk'];
        $n_lvl += $data['jumlah_nilai_lvl'];
    }
}

if ($pm_satker > 0) {
    $persentase_pm = ceil(($n_pm / $pm_satker) * 100);
    $persentase_pk = ceil(($n_pk / $pm_satker) * 100);
    $persentase_lvl = ceil(($n_lvl / $pm_satker) * 100);
}

$roleMapping = [
    'satker' => [3, 4],
    'pk' => [10, 11],
    'lvl' => [12, 13]
];

// Menentukan role berdasarkan ID
$role_user = null;
foreach ($roleMapping as $key => $ids) {
    if (in_array($role, $ids)) {
        $role_user = $key;
        break;
    }
}
?>

<div class="row">
    <div class="demo-vertical-spacing mb-4">
        <?php if ($role_user === 'satker') : ?>
            <div class="progress" data-role="satker">
                <div
                    class="progress-bar"
                    role="progressbar"
                    style="width: <?= $persentase_pm ?>%"
                    aria-valuenow="<?= $persentase_pm ?>"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    <span class="progress-label"><?= $persentase_pm ?>%</span>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($role_user === 'pk') : ?>
            <div class="progress" data-role="pk">
                <div
                    class="progress-bar bg-info"
                    role="progressbar"
                    style="width: <?= $persentase_pk ?>%"
                    aria-valuenow="<?= $persentase_pk ?>"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    <span class="progress-label"><?= $persentase_pk ?>%</span>
                </div>
            </div>
        <?php endif; ?>
        <?php if ($role_user === 'lvl') : ?>
            <div class="progress" data-role="lvl">
                <div
                    class="progress-bar bg-success"
                    role="progressbar"
                    style="width: <?= $persentase_lvl ?>%"
                    aria-valuenow="<?= $persentase_lvl ?>"
                    aria-valuemin="0"
                    aria-valuemax="100">
                    <span class="progress-label"><?= $persentase_lvl ?>%</span>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="col-lg-12 order-0">
        <div class="card mb-2">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body p-2">

                        <h5 class="card-title text-primary mt-2">B. KOMPONEN HASIL</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-12 mt-4">
        <?php
        // Array untuk menyimpan unsur yang sudah ditampilkan
        $displayedUnsur = [];
        foreach ($syncedData as $index => $row) : ?>
            <!-- Cek apakah nama_unsur sudah ditampilkan -->
            <div class="card accordion-item mb-2">
                <?php if (!in_array($row['nama_unsur'], $displayedUnsur)) : ?>
                    <!-- // Tambahkan ke array untuk mencegah duplikasi -->

                    <div class="card-header bg-secondary">
                        <h5 class="mb-0 text-white"><?= $row['nama_unsur']; ?></h5>
                    </div>
                    <?php $displayedUnsur[] = $row['nama_unsur']; ?>
                <?php endif; ?>
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
                            onclick="<?= ($role == 4) ? "handleSave($index, '{$row['id_indikator']}')" : 'return false;'; ?>" <?= ($role != 4 || !empty($s_pm)) ? 'hidden' : ''; ?>>
                            Simpan
                        </a>
                    </div>
                    <hr>
                    <div class="accordion-body" <?= (!in_array($role, [10, 11, 12, 13])) ? 'hidden' : ''; ?>>
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
                        <a href="javascript:void(0);" class="btn btn-sm btn-primary btn-info mt-2" onclick="<?= ($role == 11) ? "handleSavePK($index, '{$row['id_indikator']}')" : 'return false;'; ?>" <?= !($role == 11) ? 'hidden' : ''; ?>>Simpan</a>
                    </div>

                    <div class="accordion-body" <?= (!in_array($role, [12, 13])) ? 'hidden' : ''; ?>>
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
        <?php endforeach; ?>

    </div>


    <div class="d-flex justify-content-between mt-3">
        <a href="javascript:void(0);" class="btn btn-primary" onclick="handleBackClick()">Sebelumnya</a>
        <a href="javascript:void(0);" class="btn btn-primary" onclick="handleNextClick()">Selesai</a>
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
    function updateButton(satkerId, tahun) {
        const role = Number(<?= json_encode($role); ?>);
        $.ajax({
            url: '<?= base_url('/tombol') ?>',
            type: 'GET',
            data: {
                satkerId: satkerId,
                tahun: tahun
            },
            dataType: 'json',
            success: function(response) {
                console.log('Response :', response);

                response.forEach(function(item) {
                    let button = $(".unsur-btn[data-id='" + item.id_unsur + "']");
                    let presentase = 0;

                    // Cek role user
                    if ([3, 4].includes(role)) {
                        presentase = item.presentase_pm; // Jika user adalah satker
                    } else if ([10, 11].includes(role)) {
                        presentase = item.presentase_pk; // Jika user adalah PK
                    } else if ([12, 13].includes(role)) {
                        presentase = item.presentase_lvl; // Jika user adalah lvl
                    }

                    // Update warna tombol berdasarkan presentase yang sesuai dengan role
                    if (presentase == 100) {
                        button.removeClass("btn-dark").addClass("btn-info");
                        localStorage.setItem('buttonColor_' + item.id_unsur, 'info');
                    } else {
                        button.removeClass("btn-success").addClass("btn-dark");
                        localStorage.setItem('buttonColor_' + item.id_unsur, 'dark');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Error saat mengambil data terbaru:', error);
            }
        });
    }

    function updateProgress(satkerId, tahun) {
        $.ajax({
            url: '<?= base_url('/progress2') ?>', // Endpoint ambil progress terbaru
            type: 'GET',
            data: {
                satkerId: satkerId,
                tahun: tahun
            },
            dataType: 'json',
            success: function(response) {
                console.log("Data Progress Terbaru:", response);

                let role = Number(<?= json_encode($role); ?>); // Pastikan role dalam bentuk angka

                // Update masing-masing progress bar sesuai role
                if ([3, 4].includes(role)) { // Satker
                    $(".progress[data-role='satker'] .progress-bar")
                        .css("width", response.persentase_pm + "%")
                        .attr("aria-valuenow", response.persentase_pm);
                    $(".progress[data-role='satker'] .progress-label")
                        .text(response.persentase_pm.toFixed(2) + "% PM");
                }

                if ([10, 11].includes(role)) { // PK
                    $(".progress[data-role='pk'] .progress-bar")
                        .css("width", response.persentase_pk + "%")
                        .attr("aria-valuenow", response.persentase_pk);
                    $(".progress[data-role='pk'] .progress-label")
                        .text(response.persentase_pk.toFixed(2) + "% PK");
                }

                if ([12, 13].includes(role)) { // LVL
                    $(".progress[data-role='lvl'] .progress-bar")
                        .css("width", response.persentase_lvl + "%")
                        .attr("aria-valuenow", response.persentase_lvl);
                    $(".progress[data-role='lvl'] .progress-label")
                        .text(response.persentase_lvl.toFixed(2) + "% Level");
                }
            },
            error: function(xhr, status, error) {
                console.error('Gagal mengambil data progress:', error);
            }
        });
    }

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
                    updateProgress(satkerId, tahun);
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
        const tahun = <?= json_encode($tahun); ?>;
        const userId = <?= json_encode(session()->get('id')); ?>;
        const satkerId = <?= json_encode($id_satker); ?>;

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

        // console.log("Rekomendasi PK:", rekomenPK);
        // console.log("Tahun:", tahun);
        // console.log("User ID:", userId);
        // console.log("Satker ID:", satkerId);
        // console.log("Nilai PK:", nilaiSelectPKValue);
        // console.log("Komentar PK:", komentarPKValue);
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
                    updateButton(satkerId, tahun);
                    updateProgress(satkerId, tahun);
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
                    updateProgress(satkerId, tahun);
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

    function handleNextClick() {
        window.location.href = "<?= base_url('/dash_pk?thn=' . $tahun . '&id_satker=' . $id_satker) ?>"; // Ganti dengan URL tujuan
    }

    function handleBackClick() {
        window.location.href = "<?= base_url('/soal_pengungkit?thn=' . $tahun . '&id_satker=' . $id_satker) ?>"; // Ganti dengan URL tujuan
    }
</script>

<?= $this->endSection(); ?>