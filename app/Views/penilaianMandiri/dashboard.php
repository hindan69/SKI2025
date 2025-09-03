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

<!-- function table -->
<?php
function formatData($dash)
{
    $output = '<table class="table ml-2">';
    $output .= '<tr class="table-info">
                    <th scope="col" class="text-center align-middle"><strong>No</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Faktor Penilaian</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Bobot</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Skor PM</strong></th>
                    <th scope="col" class="text-center align-middle"><strong>Nilai Rata-Rata PM</strong></th>
                </tr>';

    $komponenData = [];
    $totalKomponen = [];

    // **1️⃣ Struktur array dari data**
    foreach ($dash as $row) {
        if ($row->id_sub_unsur == 0 && $row->name_sub_unsur === null) {
            // Unsur tanpa sub-unsur
            $komponenData[$row->nama_komponen]['unsur'][$row->nama_unsur]['no_sub_unsur'][] = [
                'bobot' => $row->bobot_indikator,
                'nilai' => $row->nilai
            ];
        } else {
            // Unsur dengan sub-unsur
            $komponenData[$row->nama_komponen]['unsur'][$row->nama_unsur]['sub_unsur'][$row->name_sub_unsur][] = [
                'bobot' => $row->bobot_indikator,
                'nilai' => $row->nilai
            ];
        }
    }

    $komponenIndex = 64; // ASCII 'A'

    // **2️⃣ Loop berdasarkan komponen**
    foreach ($komponenData as $komponen => $unsurData) {
        $komponenIndex++;
        $unsurIndex = 0;
        $totalKomponenBobot = 0;
        $totalKomponenNilai = 0;

        foreach ($unsurData['unsur'] as $unsur => $subUnsurData) {
            $bobotUnsur = 0;
            $nilaiUnsur = 0;

            if (!empty($subUnsurData['no_sub_unsur'])) {
                foreach ($subUnsurData['no_sub_unsur'] as $item) {
                    if ($item['nilai'] != -1) {
                        $bobotUnsur += $item['bobot'];
                        $nilaiUnsur += $item['nilai'] * $item['bobot'];
                    }
                }
            }

            if (!empty($subUnsurData['sub_unsur'])) {
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    foreach ($data as $item) {
                        if ($item['nilai'] != -1) {
                            $bobotUnsur += $item['bobot'];
                            $nilaiUnsur += $item['nilai'] * $item['bobot'];
                        }
                    }
                }
            }

            $totalKomponenBobot += $bobotUnsur;
            $totalKomponenNilai += $nilaiUnsur;
        }

        $persentaseKomponen = ($totalKomponenBobot > 0) ? ($totalKomponenNilai / $totalKomponenBobot) * 100 : 0;

        // **Tampilkan komponen**
        $output .= '<tr class="table-warning">
            <td><b>' . chr($komponenIndex) . '.</b></td>
            <td><b>' . $komponen . '</b></td>
            <td class="text-center"><b>' . number_format($totalKomponenBobot, 2, ',', '') . '</b></td>
            <td class="text-center"><b>' . number_format($totalKomponenNilai, 2, ',', '') . '</b></td>
            <td class="text-center"><b>' . number_format($persentaseKomponen, 2, ',', '') . '%</b></td>
        </tr>';

        foreach ($unsurData['unsur'] as $unsur => $subUnsurData) {
            $unsurIndex++;
            $bobotUnsur = 0;
            $nilaiUnsur = 0;

            if (!empty($subUnsurData['no_sub_unsur'])) {
                foreach ($subUnsurData['no_sub_unsur'] as $item) {
                    if ($item['nilai'] != -1) {
                        $bobotUnsur += $item['bobot'];
                        $nilaiUnsur += $item['nilai'] * $item['bobot'];
                    }
                }
            }

            if (!empty($subUnsurData['sub_unsur'])) {
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    foreach ($data as $item) {
                        if ($item['nilai'] != -1) {
                            $bobotUnsur += $item['bobot'];
                            $nilaiUnsur += $item['nilai'] * $item['bobot'];
                        }
                    }
                }
            }

            $persentaseUnsur = ($bobotUnsur > 0) ? ($nilaiUnsur / $bobotUnsur) * 100 : 0;

            $output .= "<tr class='table-secondary'>
                <td>{$unsurIndex}.</td>
                <td><b>{$unsur}</b></td>                
                <td class='text-center'><b>" . number_format($bobotUnsur, 2, ',', '') . "</b></td>
                <td class='text-center'><b>" . number_format($nilaiUnsur, 2, ',', '') . "</b></td>
                <td class='text-center'><b>" . number_format($persentaseUnsur, 2, ',', '') . "%</b></td>
            </tr>";

            if (!empty($subUnsurData['sub_unsur'])) {
                $subUnsurIndex = 0;
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    $bobotSubUnsur = 0;
                    $nilaiSubUnsur = 0;

                    foreach ($data as $item) {
                        if ($item['nilai'] != -1) {
                            $bobotSubUnsur += $item['bobot'];
                            $nilaiSubUnsur += $item['nilai'] * $item['bobot'];
                        }
                    }

                    $persentaseSubUnsur = ($bobotSubUnsur > 0) ? ($nilaiSubUnsur / $bobotSubUnsur) * 100 : 0;

                    $subUnsurIndex++;
                    $output .= "<tr>
                        <td>{$unsurIndex}.{$subUnsurIndex}</td>
                        <td>{$subUnsur}</td>                        
                        <td class='text-center'>" . number_format($bobotSubUnsur, 2, ',', '') . "</td>
                        <td class='text-center'>" . number_format($nilaiSubUnsur, 2, ',', '') . "</td>
                        <td class='text-center'>" . number_format($persentaseSubUnsur, 2, ',', '') . "%</td>
                    </tr>";
                }
            }
        }
    }

    $totalPersentaseKeseluruhan = 0;
    foreach ($komponenData as $komponen => $unsurData) {
        $totalKomponenBobot = 0;
        $totalKomponenNilai = 0;

        foreach ($unsurData['unsur'] as $unsur => $subUnsurData) {
            $bobotUnsur = 0;
            $nilaiUnsur = 0;

            if (!empty($subUnsurData['no_sub_unsur'])) {
                foreach ($subUnsurData['no_sub_unsur'] as $item) {
                    if ($item['nilai'] != -1) {
                        $bobotUnsur += $item['bobot'];
                        $nilaiUnsur += $item['nilai'] * $item['bobot'];
                    }
                }
            }

            if (!empty($subUnsurData['sub_unsur'])) {
                foreach ($subUnsurData['sub_unsur'] as $subUnsur => $data) {
                    foreach ($data as $item) {
                        if ($item['nilai'] != -1) {
                            $bobotUnsur += $item['bobot'];
                            $nilaiUnsur += $item['nilai'] * $item['bobot'];
                        }
                    }
                }
            }

            $totalKomponenBobot += $bobotUnsur;
            $totalKomponenNilai += $nilaiUnsur;
        }

        $persentaseKomponen = ($totalKomponenBobot > 0) ? ($totalKomponenNilai / $totalKomponenBobot) * 100 : 0;
        $output .= '<tr class="table-warning">
                    <td colspan="4" class="text-right"><strong>Rata-Rata Skor ' . $komponen . ' PM</strong></td>
                    <td class="text-center"><b>' . number_format($persentaseKomponen, 2, ',', '') . '%</b></td>
                    </tr>';

        $totalPersentaseKeseluruhan += $persentaseKomponen / 2;
    }

    $output .= '<tr class="table-warning">
                <td colspan="4" class="text-right"><strong>Total Skor</strong></td>
                <td class="text-center"><b>' . number_format($totalPersentaseKeseluruhan, 2, ',', '') . '%</b></td>
                </tr>';

    if ($totalPersentaseKeseluruhan >= 80.01 && $totalPersentaseKeseluruhan <= 100) {
        $keterangan = "SANGAT EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan >= 60.01 && $totalPersentaseKeseluruhan <= 80) {
        $keterangan = "EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan >= 40.01 && $totalPersentaseKeseluruhan <= 60) {
        $keterangan = "CUKUP EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan >= 20.01 && $totalPersentaseKeseluruhan <= 40) {
        $keterangan = "KURANG EFEKTIF";
    } elseif ($totalPersentaseKeseluruhan >= 0 && $totalPersentaseKeseluruhan <= 20) {
        $keterangan = "TIDAK EFEKTIF";
    } else {
        $keterangan = "NILAI DI LUAR JANGKAUAN"; // Jika nilai di luar 0-100
    }

    $output .= '<tr class="table-secondary">
            <td colspan="4" class="text-right"><strong>Kesimpulan</strong></td>
            <td class="text-center"><b>' . $keterangan . '</b></td>
        </tr>';


    $output .= '</table>';

    // $nilai_pm = number_format($totalPersentaseKeseluruhan, 2, ',', '');
    $nilai_pm = round($totalPersentaseKeseluruhan, 2);
    return [
        'html' => $output,
        'total' => $nilai_pm
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
                            <?php if ($role != 1): ?>
                                <a href="<?= base_url('/soal_pengungkit?thn=' . $tahun) ?>" class="btn btn-info btn-sm">LKE</a>
                                <button id="submitButton" class="btn <?= $btnClass; ?> btn-sm" <?= $isDisabled ? 'disabled' : ''; ?> data-role="<?= $role; ?>" onclick="handleClick()">
                                    <?= $btnText; ?>
                                </button>
                                <button id="reverseButton" class="btn btn-warning btn-sm" <?= ($role == 3 && !empty($s_pm) && empty($s_pim)) ? '' : 'hidden'; ?> onclick="reverseClick()">Revisi</button>
                            <?php endif; ?>
                        </small>
                        <h5 class="card-title text-primary">Penilaian Mandiri SPI/SKI <?= $tahun ?></h5>
                        <p class="mb-0">
                            <?php
                            foreach ($user as $data) {
                                echo '<span class="fw-bold">' . $data->nama_satker . '</span><br>' . $data->nama_organisasi;
                            }
                            ?>
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 order-0">
                                <div class="row">
                                    <div class="card" style="border: 1px solid #dee2e6; border-radius: .375rem; padding: 1rem;">
                                        <?php
                                        $result = formatData($dash);
                                        echo $result['html'];
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function handleClick() {
        const id_satker = <?= json_encode($data->id_satker); ?>;
        const id_user = <?= json_encode($data->id); ?>;
        const tahun = <?= json_encode($tahun); ?>;
        const nilai_pm = <?= json_encode($result['total']); ?>;

        // console.log(tahun);
        // console.log(id_satker);
        // console.log(id_user);
        // console.log(nilai_pm);
        // alert('Button clicked!');
        var role = <?= json_encode(session()->get('role')); ?>; // Ambil role dari session PHP
        var url = null;
        const urls = {
            3: "<?= base_url('/spm_pim') ?>",
            4: "<?= base_url('/submit_pm') ?>",
        };
        if (urls[role]) {
            url = urls[role]; // Ambil URL sesuai role
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
                nilai_pm: nilai_pm,
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
        const id_satker = <?= json_encode($data->id_satker); ?>;
        const tahun = <?= json_encode($tahun); ?>;
        // console.log(id_satker);
        // alert('alert');
        $.ajax({
            url: '<?= base_url('/reverse_pm') ?>', // URL endpoint untuk menyimpan data
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