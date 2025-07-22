<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<div class="card">
    <h5 class="card-header">Penugasan Penjaminan Kualitas</h5>
    <div class="card-body mt-0">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Satuan Kerja</th>
                    <th class="text-center">Tahun</th>
                    <th class="text-center">Nilai PM</th>
                    <th class="text-center">Status PM</th>
                    <th class="text-center">Nilai PK</th>
                    <th class="text-center">Status PK</th>
                    <!-- <th class="text-center">Nilai Level</th> -->
                    <!-- <th class="text-center">Status Level</th> -->
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($penugasan as $pk):
                    $params = [
                        'thn' => $pk['periode_penilaian'],
                        'id_satker'  => $pk['id_satker']
                    ];
                ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $pk['nama_satker'] ?></td>
                        <td class="text-center"><?= $pk['periode_penilaian'] ?></td>
                        <td class="text-center"><?= !empty($pk['nilai_pm']) ? number_format($pk['nilai_pm'], 2, ',', '')  : "<i class='bx bxs-minus-circle text-secondary'></i>" ?></td>
                        <td class="text-center"><i class='bx <?= $pk['status_pim'] == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary" ?>'></i></td>
                        <td class="text-center"><?= !empty($pk['nilai_pk']) ? $pk['nilai_pk'] : "<i class='bx bxs-minus-circle text-secondary'></i>" ?></td>
                        <td class="text-center"><i class='bx <?= $pk['status_kpk'] == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary" ?>'></i></td>
                        <td class="text-center">
                            <!-- <a href="" class="btn btn-primary btn-sm">Penilaian</a> -->
                            <?php
                            if (!array_key_exists('is_active', $pk) || !array_key_exists('status_kpk', $pk) || !array_key_exists('status_pim', $pk)) {
                                echo '<span class="text-danger">Data tidak lengkap</span>';
                            } elseif ($pk['is_active'] != 1) {
                                // Tim belum aktif
                                if ($pk['status_kpk'] == 1) {
                                    echo '<a href="#" class="btn btn-secondary btn-sm disabled" tabindex="-1" aria-disabled="true">Selesai</a>';
                                } else {
                                    echo '<a href="#" class="btn btn-secondary btn-sm disabled" tabindex="-1" aria-disabled="true">Terkunci</a>';
                                }
                            } elseif ($pk['status_pim'] != 1) {
                                // Belum disetujui pimpinan
                                echo '<a href="#" class="btn btn-secondary btn-sm disabled" tabindex="-1" aria-disabled="true">Menunggu PM</a>';
                            } elseif ($pk['status_kpk'] == 1) {
                                // Penilaian sudah selesai
                                echo '<a href="#" class="btn btn-secondary btn-sm disabled" tabindex="-1" aria-disabled="true">Selesai</a>';
                            } else {
                                // Semua kondisi aman, bisa menilai
                                echo '<a href="' . base_url('/dash_pk?' . http_build_query($params)) . '" class="btn btn-primary btn-sm">Penilaian</a>';
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>

</div>

<script>
    function filterTable(columnIndex) {
        const input = document.getElementsByTagName("thead")[0].getElementsByTagName("input")[columnIndex];
        const filter = input.value.toLowerCase();
        const table = document.querySelector("table tbody");
        const rows = table.getElementsByTagName("tr");

        for (let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName("td");
            if (cells[columnIndex]) {
                const textValue = cells[columnIndex].textContent || cells[columnIndex].innerText;
                if (textValue.toLowerCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    }
</script>


<?= $this->endSection(); ?>