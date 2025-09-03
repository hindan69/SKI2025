<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<!-- function button submit -->
<?php
$hasData = !empty($s_pm);
$hasData1 = !empty($s_pim); // Data setelah submit
$pm_satker = 0;
$n_pm = 0;
$persentase_pm = 0;

// Menghitung total pm_satker dan n_pm
foreach ($persen as $data) {
    $pm_satker += $data['jumlah_pm_satker'];
    $n_pm += $data['jumlah_nilai_pm'];
}

// Menghitung persentase PM
if ($pm_satker > 0) {
    $persentase_pm = ceil(($n_pm / $pm_satker) * 100);
}

// Default tombol tidak aktif (pra submit)
$isDisabled = true;
$btnClass = 'btn-dark';
$btnText = 'Submit';

// Tombol aktif jika:
// 1. $role == 3 dan ada data ($hasData = true)
// 2. $role == 4 dan $persentase_pm == 100
if (($role == 3 && $hasData) || ($role == 4 && $persentase_pm == 100)) {
    $isDisabled = false;
    $btnClass = 'btn-info';
    $btnText = 'Submit';
}

// Tombol menjadi tidak aktif setelah submit jika:
// 1. $role == 3 dan ada data setelah submit ($hasData1 = true)
// 2. $role == 4 dan $persentase_pm == 100 dan ada data setelah submit ($hasData = true)
if (($role == 3 && $hasData1) || ($role == 4 && $persentase_pm == 100 && $hasData)) {
    $isDisabled = true;
    $btnClass = 'btn-dark';
    $btnText = 'Telah Submit';
}

?>

<?= d($dash) ?>
<div class="row">
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body">
                        <small class="text-muted float-end">
                            <a href="<?= base_url('/soal_pengungkit?thn=' . $tahun) ?>" class="btn btn-info btn-sm">LKE</a>
                            <button id="submitButton" class="btn <?= $btnClass; ?> btn-sm" <?= $isDisabled ? 'disabled' : ''; ?> data-role="<?= $role; ?>" onclick="handleClick()">
                                <?= $btnText; ?>
                            </button>
                            <button id="reverseButton" class="btn btn-warning btn-sm" <?= ($role == 3 && !empty($s_pm) && empty($s_pim)) ? '' : 'hidden'; ?> onclick="reverseClick()">Revisi</button>
                        </small>
                        <h5 class="card-title text-primary">Penjaminan Kualitas SPI/SKI<?= $tahun ?></h5>
                        <p class="mb-0">

                            <span class="fw-bold"><?= $satker['nama_satker'] ?></span><br>
                            <?= $satker['nama_organisasi'] ?>
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 order-0">
                                <div class="row">
                                    <!-- table -->
                                    <div class="card" style="border: 1px solid #dee2e6; border-radius: .375rem; padding: 1rem;">
                                        <table class="table ml-2">
                                            <thead>
                                                <tr class="table-info">
                                                    <th scope="col" class="text-center align-middle"><strong>No</strong></th>
                                                    <th scope="col" class="text-center align-middle"><strong>Faktor Penilaian</strong></th>
                                                    <th scope="col" rowspan="2" class="text-center align-middle"><strong>Bobot</strong></th>
                                                    <th scope="col" rowspan="2" class="text-center align-middle"><strong>Skor PM</strong></th>
                                                    <th scope="col" rowspan="2" class="text-center align-middle"><strong>Skor PK</strong></th>
                                                    <th scope="col" rowspan="2" class="text-center align-middle"><strong>Nilai Rata-Rata PM</strong></th>
                                                    <th scope="col" rowspan="2" class="text-center align-middle"><strong>Nilai Rata-Rata PK</strong></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-warning">
                                                    <td class="text-center">A</td>
                                                    <td>Komponen Pengungkit</td>
                                                    <td class="text-center">70.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">1</td>
                                                    <td>Dukungan Sumber Daya Manusia, Akses Data & Informasi, serta Komunikasi</td>
                                                    <td class="text-center">15.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">1.1</td>
                                                    <td>Dukungan Sumber Daya Manusia</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">1.2</td>
                                                    <td>Akses Data & Informasi</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">1.3</td>
                                                    <td>Komunikasi</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">2</td>
                                                    <td>Pemantauan dan Evaluasi Tata Kelola Organisasi</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2.1</td>
                                                    <td>Pengelola Keuangan</td>
                                                    <td class="text-center">4.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2.2</td>
                                                    <td>Kinerja</td>
                                                    <td class="text-center">4.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2.3</td>
                                                    <td>Kedisiplinan Pegawai</td>
                                                    <td class="text-center">4.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2.4</td>
                                                    <td>Reformasi Birokrasi/WBK/WBBM</td>
                                                    <td class="text-center">4.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">3</td>
                                                    <td>Manajemen Resiko</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">4</td>
                                                    <td>Pengendalian Intern</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-warning">
                                                    <td class="text-center">B</td>
                                                    <td>Komponen Hasil</td>
                                                    <td class="text-center">70.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">1</td>
                                                    <td>Akuntabilitas Keuangan</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">2</td>
                                                    <td>Akuntabilitas Kinerja</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">3</td>
                                                    <td>Reformasi Birokrasi/WBK/WBBM</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">4</td>
                                                    <td>Kepatuhan terhadap peraturan perundang-undangan</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td class="text-center">5</td>
                                                    <td>Kepuasan Pelanggan</td>
                                                    <td class="text-center">5.0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0</td>
                                                    <td class="text-center">0 %</td>
                                                    <td class="text-center">0 %</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="table-dark">
                                                <td colspan="5" class="text-left">Kesimpulan PK</td>
                                                <td colspan="2" class="text-center">-</td>
                                            </tfoot>
                                            <tfoot class="table-warning">
                                                <td colspan="5" class="text-left">Rata-Rata Skor Komponen Pengungkit PM</td>
                                                <td colspan="2" class="text-center">0 %</td>
                                            </tfoot>
                                            <tfoot class="table-warning">
                                                <td colspan="5" class="text-left">Rata-Rata Skor Komponen Pengungkit PK</td>
                                                <td colspan="2" class="text-center">0 %</td>
                                            </tfoot>
                                            <tfoot class="table-warning">
                                                <td colspan="5" class="text-left">Rata-Rata Skor Komponen Hasil PM</td>
                                                <td colspan="2" class="text-center">0 %</td>
                                            </tfoot>
                                            <tfoot class="table-warning">
                                                <td colspan="5" class="text-left">Rata-Rata Skor Komponen Hasil PK</td>
                                                <td colspan="2" class="text-center">0 %</td>
                                            </tfoot>
                                            <tfoot class="table-warning">
                                                <td colspan="5" class="text-left">Total Skor PM</td>
                                                <td colspan="2" class="text-center">0 %</td>
                                            </tfoot>
                                            <tfoot class="table-warning">
                                                <td colspan="5" class="text-left">Total Skor PK</td>
                                                <td colspan="2" class="text-center">0 %</td>
                                            </tfoot>
                                            <tfoot class="table-secondary">
                                                <td colspan="5" class="text-left">Kesimpulan PM</td>
                                                <td colspan="2" class="text-center">-</td>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <!-- table -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>