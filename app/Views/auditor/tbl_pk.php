<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<!-- function button submit -->
<?php
$hasData = !empty($s_pm);
$hasData1 = !empty($s_pim); // Data setelah submit
$pm_satker = 0;
$n_pk = 0;
$persentase_pk = 0;

// Menghitung total pm_satker dan n_pm
foreach ($persen as $data) {
    $pm_satker += $data['jumlah_pm_satker'];
    $n_pk += $data['jumlah_nilai_pk'];
}

// Menghitung persentase PM
if ($pm_satker > 0) {
    $persentase_pk = ceil(($n_pk / $pm_satker) * 100);
}

// Default tombol tidak aktif (pra submit)
$isDisabled = true;
$btnClass = 'btn-dark';
$btnText = 'Submit';

// Tombol aktif jika:
// 1. $role == 3 dan ada data ($hasData = true)
// 2. $role == 4 dan $persentase_pm == 100
if (($user[0]['rolepk'] == 10 && $hasData) || ($user[0]['rolepk'] == 11 && $persentase_pk == 100)) {
    $isDisabled = false;
    $btnClass = 'btn-info';
    $btnText = 'Submit';
}

// Tombol menjadi tidak aktif setelah submit jika:
// 1. $role == 3 dan ada data setelah submit ($hasData1 = true)
// 2. $role == 4 dan $persentase_pm == 100 dan ada data setelah submit ($hasData = true)
if (($user[0]['rolepk'] == 10 && $hasData1) || ($user[0]['rolepk'] == 11 && $persentase_pk == 100 && $hasData)) {
    $isDisabled = true;
    $btnClass = 'btn-dark';
    $btnText = 'Telah Submit';
}

function formatData($dash)
{
    $output = '<table class="table ml-2">';
    $output .= '<tr class="table-info">
                    <th scope="col" class="text-center align-middle"><strong>No</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Faktor Penilaian</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Bobot</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Skor PM</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Skor PK</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Nilai Rata-Rata PM</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Nilai Rata-Rata PK</strong></th>
                </tr>';

    $komponenData = [];
    $totalKomponen = [];

    // **1️⃣ Struktur array dari data**
    foreach ($dash as $row) {
        if ($row->id_sub_unsur == 0 && $row->name_sub_unsur === null) {
            // Unsur tanpa sub-unsur
            $komponenData[$row->nama_komponen]['unsur'][$row->nama_unsur]['no_sub_unsur'][] = [
                'bobot' => $row->bobot_indikator,
                'nilai_pm' => $row->nilai_pm,
                'nilai_pk' => $row->nilai_pk,
            ];
        } else {
            // Unsur dengan sub-unsur
            $komponenData[$row->nama_komponen]['unsur'][$row->nama_unsur]['sub_unsur'][$row->name_sub_unsur][] = [
                'bobot' => $row->bobot_indikator,
                'nilai_pm' => $row->nilai_pm,
                'nilai_pk' => $row->nilai_pk,
            ];
        }
    }

    $komponenIndex = 64; // ASCII 'A'

    // **2️⃣ Loop berdasarkan komponen**
    foreach ($komponenData as $komponen => $unsurData) {
        $komponenIndex++;
        $unsurIndex = 0;
        $totalKomponenBobot = 0;
        $totalKomponenNilai_pm = 0;
        $totalKomponenNilai_pk = 0;

        foreach ($unsurData['unsur'] as $unsur => $subUnsurData) {
            $bobotUnsur = 0;
            $nilaiUnsur_pm = 0;
            $nilaiUnsur_pk = 0;

            if (!empty($subUnsurData['no_sub_unsur'])) {
                foreach ($subUnsurData['no_sub_unsur'] as $item) {
                    if ($item['nilai_pm'] != -1) {
                        $bobotUnsur += $item['bobot'];
                        $nilaiUnsur_pm += $item['nilai_pm'] * $item['bobot'];
                        $nilaiUnsur_pk += $item['nilai_pk'] * $item['bobot'];
                    }
                }
            }

            if (!empty($subUnsurData['sub_unsur'])) {
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    foreach ($data as $item) {
                        if ($item['nilai_pm'] != -1) {
                            $bobotUnsur += $item['bobot'];
                            $nilaiUnsur_pm += $item['nilai_pm'] * $item['bobot'];
                            $nilaiUnsur_pk += $item['nilai_pk'] * $item['bobot'];
                        }
                    }
                }
            }

            $totalKomponenBobot += $bobotUnsur;
            $totalKomponenNilai_pm += $nilaiUnsur_pm;
            $totalKomponenNilai_pk += $nilaiUnsur_pk;
        }

        $persentaseKomponen_pm = ($totalKomponenBobot > 0) ? ($totalKomponenNilai_pm / $totalKomponenBobot) * 100 : 0;
        $persentaseKomponen_pk = ($totalKomponenBobot > 0) ? ($totalKomponenNilai_pk / $totalKomponenBobot) * 100 : 0;

        // **Tampilkan komponen**
        $output .= '<tr class="table-warning">
            <td><b>' . chr($komponenIndex) . '.</b></td>
            <td><b>' . $komponen . '</b></td>
            <td class="text-center"><b>' . number_format($totalKomponenBobot, 2, ',', '') . '</b></td>
            <td class="text-center"><b>' . number_format($totalKomponenNilai_pm, 2, ',', '') . '</b></td>
            <td class="text-center"><b>' . number_format($totalKomponenNilai_pk, 2, ',', '') . '</b></td>
            <td class="text-center"><b>' . number_format($persentaseKomponen_pm, 2, ',', '') . '%</b></td>
            <td class="text-center"><b>' . number_format($persentaseKomponen_pk, 2, ',', '') . '%</b></td>
        </tr>';

        foreach ($unsurData['unsur'] as $unsur => $subUnsurData) {
            $unsurIndex++;
            $bobotUnsur = 0;
            $nilaiUnsur_pm = 0;
            $nilaiUnsur_pk = 0;

            if (!empty($subUnsurData['no_sub_unsur'])) {
                foreach ($subUnsurData['no_sub_unsur'] as $item) {
                    if ($item['nilai_pm'] != -1) {
                        $bobotUnsur += $item['bobot'];
                        $nilaiUnsur_pm += $item['nilai_pm'] * $item['bobot'];
                        $nilaiUnsur_pk += $item['nilai_pk'] * $item['bobot'];
                    }
                }
            }

            if (!empty($subUnsurData['sub_unsur'])) {
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    foreach ($data as $item) {
                        if ($item['nilai_pm'] != -1) {
                            $bobotUnsur += $item['bobot'];
                            $nilaiUnsur_pm += $item['nilai_pm'] * $item['bobot'];
                            $nilaiUnsur_pk += $item['nilai_pk'] * $item['bobot'];
                        }
                    }
                }
            }

            $persentaseUnsur_pm = ($bobotUnsur > 0) ? ($nilaiUnsur_pm / $bobotUnsur) * 100 : 0;
            $persentaseUnsur_pk = ($bobotUnsur > 0) ? ($nilaiUnsur_pk / $bobotUnsur) * 100 : 0;

            $output .= "<tr class='table-secondary'>
                <td>{$unsurIndex}.</td>
                <td><b>{$unsur}</b></td>                
                <td class='text-center'><b>" . number_format($bobotUnsur, 2, ',', '') . "</b></td>
                <td class='text-center'><b>" . number_format($nilaiUnsur_pm, 2, ',', '') . "</b></td>
                <td class='text-center'><b>" . number_format($nilaiUnsur_pk, 2, ',', '') . "</b></td>
                <td class='text-center'><b>" . number_format($persentaseUnsur_pm, 2, ',', '') . "%</b></td>
                <td class='text-center'><b>" . number_format($persentaseUnsur_pk, 2, ',', '') . "%</b></td>
            </tr>";

            if (!empty($subUnsurData['sub_unsur'])) {
                $subUnsurIndex = 0;
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    $bobotSubUnsur = 0;
                    $nilaiSubUnsur_pm = 0;
                    $nilaiSubUnsur_pk = 0;

                    foreach ($data as $item) {
                        if ($item['nilai_pm'] != -1) {
                            $bobotSubUnsur += $item['bobot'];
                            $nilaiSubUnsur_pm += $item['nilai_pm'] * $item['bobot'];
                            $nilaiSubUnsur_pk += $item['nilai_pk'] * $item['bobot'];
                        }
                    }

                    $persentaseSubUnsur_pm = ($bobotSubUnsur > 0) ? ($nilaiSubUnsur_pm / $bobotSubUnsur) * 100 : 0;
                    $persentaseSubUnsur_pk = ($bobotSubUnsur > 0) ? ($nilaiSubUnsur_pk / $bobotSubUnsur) * 100 : 0;

                    $subUnsurIndex++;
                    $output .= "<tr>
                        <td>{$unsurIndex}.{$subUnsurIndex}</td>
                        <td>{$subUnsur}</td>                        
                        <td class='text-center'>" . number_format($bobotSubUnsur, 2, ',', '') . "</td>
                        <td class='text-center'>" . number_format($nilaiSubUnsur_pm, 2, ',', '') . "</td>
                        <td class='text-center'>" . number_format($nilaiSubUnsur_pk, 2, ',', '') . "</td>
                        <td class='text-center'>" . number_format($persentaseSubUnsur_pm, 2, ',', '') . "%</td>
                        <td class='text-center'>" . number_format($persentaseSubUnsur_pk, 2, ',', '') . "%</td>
                    </tr>";
                }
            }
        }
    }

    $totalPersentaseKeseluruhan_pm = 0;
    $totalPersentaseKeseluruhan_pk = 0;
    foreach ($komponenData as $komponen => $unsurData) {
        $totalKomponenBobot = 0;
        $totalKomponenNilai_pm = 0;
        $totalKomponenNilai_pk = 0;

        foreach ($unsurData['unsur'] as $unsur => $subUnsurData) {
            $bobotUnsur = 0;
            $nilaiUnsur_pm = 0;
            $nilaiUnsur_pk = 0;

            if (!empty($subUnsurData['no_sub_unsur'])) {
                foreach ($subUnsurData['no_sub_unsur'] as $item) {
                    if ($item['nilai_pm'] != -1) {
                        $bobotUnsur += $item['bobot'];
                        $nilaiUnsur_pm += $item['nilai_pm'] * $item['bobot'];
                        $nilaiUnsur_pk += $item['nilai_pk'] * $item['bobot'];
                    }
                }
            }

            if (!empty($subUnsurData['sub_unsur'])) {
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    foreach ($data as $item) {
                        if ($item['nilai_pm'] != -1) {
                            $bobotUnsur += $item['bobot'];
                            $nilaiUnsur_pm += $item['nilai_pm'] * $item['bobot'];
                            $nilaiUnsur_pk += $item['nilai_pk'] * $item['bobot'];
                        }
                    }
                }
            }

            $totalKomponenBobot += $bobotUnsur;
            $totalKomponenNilai_pm += $nilaiUnsur_pm;
            $totalKomponenNilai_pk += $nilaiUnsur_pk;
        }

        $persentaseKomponen_pm = ($totalKomponenBobot > 0) ? ($totalKomponenNilai_pm / $totalKomponenBobot) * 100 : 0;
        $persentaseKomponen_pk = ($totalKomponenBobot > 0) ? ($totalKomponenNilai_pk / $totalKomponenBobot) * 100 : 0;
        $output .= '<tr class="table-warning">
                    <td colspan="5" class="text-right"><strong>Rata-Rata Skor ' . $komponen . ' PM</strong></td>
                    <td class="text-center"><b>' . number_format($persentaseKomponen_pm, 2, ',', '') . '%</b></td>
                    <td class="text-center"><b>' . number_format($persentaseKomponen_pk, 2, ',', '') . '%</b></td>
                    </tr>';

        $totalPersentaseKeseluruhan_pm += $persentaseKomponen_pm / 2;
        $totalPersentaseKeseluruhan_pk += $persentaseKomponen_pk / 2;
    }

    $output .= '<tr class="table-warning">
                <td colspan="5" class="text-right"><strong>Total Skor</strong></td>
                <td class="text-center"><b>' . number_format($totalPersentaseKeseluruhan_pm, 2, ',', '') . '%</b></td>
                <td class="text-center"><b>' . number_format($totalPersentaseKeseluruhan_pk, 2, ',', '') . '%</b></td>
                </tr>';

    if ($totalPersentaseKeseluruhan_pm >= 80.01 && $totalPersentaseKeseluruhan_pm <= 100) {
        $keterangan_pm = "SANGAT EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pm >= 60.01 && $totalPersentaseKeseluruhan_pm <= 80) {
        $keterangan_pm = "EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pm >= 40.01 && $totalPersentaseKeseluruhan_pm <= 60) {
        $keterangan_pm = "CUKUP EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pm >= 20.01 && $totalPersentaseKeseluruhan_pm <= 40) {
        $keterangan_pm = "KURANG EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pm >= 0 && $totalPersentaseKeseluruhan_pm <= 20) {
        $keterangan_pm = "TIDAK EFEKTIF";
    } else {
        $keterangan_pm = "NILAI DI LUAR JANGKAUAN"; // Jika nilai di luar 0-100
    }

    if ($totalPersentaseKeseluruhan_pk >= 80.01 && $totalPersentaseKeseluruhan_pk <= 100) {
        $keterangan_pk = "SANGAT EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pk >= 60.01 && $totalPersentaseKeseluruhan_pk <= 80) {
        $keterangan_pk = "EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pk >= 40.01 && $totalPersentaseKeseluruhan_pk <= 60) {
        $keterangan_pk = "CUKUP EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pk >= 20.01 && $totalPersentaseKeseluruhan_pk <= 40) {
        $keterangan_pk = "KURANG EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan_pk >= 0 && $totalPersentaseKeseluruhan_pk <= 20) {
        $keterangan_pk = "TIDAK EFEKTIF";
    } else {
        $keterangan_pk = "NILAI DI LUAR JANGKAUAN"; // Jika nilai di luar 0-100
    }

    $output .= '<tr class="table-secondary">
            <td colspan="5" class="text-right"><strong>Kesimpulan</strong></td>
            <td class="text-center"><b>' . $keterangan_pm . '</b></td>
            <td class="text-center"><b>' . $keterangan_pk . '</b></td>
        </tr>';


    $output .= '</table>';

    // $nilai_pm = number_format($totalPersentaseKeseluruhan, 2, ',', '');
    $nilai_pm = round($totalPersentaseKeseluruhan_pm, 2);
    $nilai_pk = round($totalPersentaseKeseluruhan_pk, 2);
    return [
        'html' => $output,
        'total_pm' => $nilai_pm,
        'total_pk' => $nilai_pk
    ];
}
?>

<div class="row">
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body">
                        <small class="text-muted float-end">
                            <a href="<?= base_url('/soal_pengungkit?thn=' . $tahun . '&id_satker=' . $id_satker) ?>" class="btn btn-info btn-sm">LKE</a>
                            <button id="submitButton" class="btn <?= $btnClass; ?> btn-sm" <?= $isDisabled ? 'disabled' : ''; ?> data-role="<?= $role; ?>" onclick="handleClick()">
                                <?= $btnText; ?>
                            </button>
                            <button id="reverseButton" class="btn btn-warning btn-sm" <?= ($role == 10 && !empty($s_pm) && empty($s_pim)) ? '' : 'hidden'; ?> onclick="reverseClick()">Revisi</button>
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
                                        <?php
                                        $result = formatData($dash);
                                        echo $result['html'];
                                        ?>
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

<script>
    function handleClick() {
        const id_satker = <?= json_encode($id_satker); ?>;
        const id_user = <?= json_encode($user[0]['id_auditor']); ?>;
        const tahun = <?= json_encode($tahun); ?>;
        const nilai_pk = <?= json_encode($result['total_pk']); ?>;

        console.log(tahun);
        console.log(id_satker);
        console.log(id_user);
        console.log(nilai_pk);
        var role = <?= json_encode($role); ?>; // Ambil role dari session PHP
        var url = null;
        const urls = {
            10: "<?= base_url('/spk_pim') ?>",
            11: "<?= base_url('/submit_pk') ?>",
        };
        if (urls[role]) {
            url = urls[role]; // Ambil URL sesuai role
            // alert("Role memiliki aksi submit.");
        } else {
            alert("Role tidak memiliki aksi submit.");
            return;
        }
        $.ajax({
            url: url, // URL endpoint untuk menyimpan data
            type: 'POST',
            data: {
                tahun: tahun,
                id_satker: id_satker,
                id_user: id_user,
                nilai_pk: nilai_pk,
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    let button = $("#submitButton");
                    button.removeClass("btn-info").addClass("btn-dark").prop("disabled", true);
                    button.text("Telah Submit");
                    $("#reverseButton").hide();
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

    function reverseClick() {
        const id_satker = <?= json_encode($id_satker); ?>;
        const tahun = <?= json_encode($tahun); ?>;
        // console.log(id_satker);
        // alert('alert');
        $.ajax({
            url: '<?= base_url('/reverse_pk') ?>', // URL endpoint untuk menyimpan data
            type: 'post',
            data: {
                tahun: tahun,
                id_satker: id_satker,
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    let button = $("#submitButton");
                    button.removeClass("btn-info").addClass("btn-dark").prop("disabled", true);
                    button.text("Submit");
                    $("#reverseButton").hide();
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