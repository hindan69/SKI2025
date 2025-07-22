<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>


<!-- modal tambah data SK -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">SK TIM SPI/SKI</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div>
                        <label for="thn_anggaran" class="form-label">Tahun Anggaran</label>
                        <select id="thn_anggaran" class="form-select form-select-sm">
                            <option value="" selected disabled>Pilih Tahun...</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div>
                        <label for="input_html5-url-input" class="col-md-2 col-form-label">URL</label>
                        <div class="col-md-12">
                            <input
                                class="form-control"
                                type="url"
                                value="https://drive.google.com/"
                                id="link_sk" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="button" class="btn btn-primary btn-sm" onclick="handleSave()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- modal tambah data SK -->

<!-- modal edit data SK -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <p id="edit_id_sk"></p>
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditTitle">Edit Data SK TIM SPI/SKI</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div>
                        <label for="edit_thn_anggaran" class="form-label">Tahun Anggaran</label>
                        <select id="edit_thn_anggaran" class="form-select form-select-sm" disabled>
                            <option value="" selected disabled>Pilih Tahun...</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <div>
                        <label for="edit_link_sk" class="col-md-2 col-form-label">URL</label>
                        <div class="col-md-12">
                            <input
                                class="form-control"
                                type="url"
                                id="edit_link_sk" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                    Tutup
                </button>
                <button type="button" class="btn btn-primary btn-sm" onclick="handleEdit()">Simpan</button>
            </div>
        </div>
    </div>
</div>
<!-- modal edit data SK -->

<h4 class="card-title text-primary">Penilaian Mandiri SPI/SKI</h4>
<div class="row">
    <div class="col-md-12 col-lg-8 col-xl-8 order-0 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <p class="mb-0">
                        <span class="fw-bold">Rumah Sakit Penyakit Infeksi Prof. Dr. Sulianti Saroso Jakarta</span>
                        <br>
                        Direktorat Jenderal Pelayanan Kesehatan
                    </p>
                </div>
                <div>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCenter">Tambah</button>
                </div>
            </div>
            <div class="card-body mt-4">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th class="text-center">SK</th>
                            <th class="text-center">PM</th>
                            <th class="text-center">PK</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($SK as $SK):
                        ?>
                            <tr id="row-<?= $SK['id_sk'] ?>"> <!-- Tambahkan ID unik untuk setiap baris -->
                                <td><?= $SK['thn_anggaran'] ?></td>
                                <td class="text-center"><a href="<?= $SK['link_sk'] ?>"><i class='bx bxs-file-pdf text-danger'></i></a></td>
                                <td class="text-center"><i class='bx <?= $SK['status_pim'] == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary" ?>'></i></td>
                                <td class="text-center"><i class='bx <?= $SK['status_kpk'] == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary" ?>'></i></td>
                                <td class="text-center"><i class='bx <?= $SK['status_klvl'] == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary" ?>'></i></td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                        data-thn-anggaran="<?= $SK['thn_anggaran'] ?>"
                                        data-link-sk="<?= $SK['link_sk'] ?>"
                                        data-id-sk="<?= $SK['id_sk'] ?>"
                                        onclick="EditModal(this)">Edit SK</a>
                                    <a href="<?= base_url('/dash_pm?thn=' . $SK['thn_anggaran']) ?>" class="btn btn-primary btn-sm">Penilaian</a>
                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--/ Order Statistics -->


    <!-- Profile Satker -->
    <div class="col-md-6 col-lg-4 order-1 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Profil Satuan Kerja</h5>
                <a href="<?= base_url(empty($dataUmum) ? '/prfl_satker' : '/prfl_satker') ?>"
                    class="btn btn-<?= empty($dataUmum) ? 'primary' : 'primary' ?> btn-sm">
                    <?= empty($dataUmum) ? 'Tambah' : 'Edit' ?>
                </a>
            </div>
            <div class="card-body">
                <?php foreach ($dataUmum as $data): ?>
                    <span class="label"><strong>Pimpinan Satuan Kerja</strong></span>
                    <br>
                    <span class="value"><?= esc($data['nama_pimpinan']); ?></span>
                    <br>
                    <span class="value"><?= esc($data['nip_pimpinan']); ?></span>
                    <br>
                    <span class="value"><?= esc($data['nama_jabatan']); ?></span>
                    <br>
                    <hr>
                    <span class="label"><strong>Ketua SPI/SKI</strong></span>
                    <br>
                    <span class="value"><?= esc($data['nama_ketua']); ?></span>
                    <br>
                    <span class="value"><?= esc($data['nip_ketua']); ?></span>
                    <br>
                    <hr>
                    <span class="label"><strong>Alamat Satuan Kerja</strong></span>
                    <br>
                    <span class="value"><?= esc($data['alamat_satker']); ?></span>
                    <br>
                    <span class="value"><?= esc($data['kota_satker']); ?></span>
                    <br>
                    <span class="value"><?= esc($data['kodepos']); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!--/ Riwayat Penilaian -->
</div>

<script>
    function EditModal(element) {
        const tahunAnggaran = element.getAttribute('data-thn-anggaran');
        const linkSk = element.getAttribute('data-link-sk');
        const idSk = element.getAttribute('data-id-sk');

        console.log('Tahun Anggaran:', tahunAnggaran); // Debugging
        console.log('Link SK:', linkSk); // Debugging
        console.log('ID SK:', idSk); // Debugging

        document.getElementById('edit_thn_anggaran').value = tahunAnggaran || ''; // Mengisi tahun anggaran
        document.getElementById('edit_link_sk').value = linkSk || ''; // Mengisi link SK
        document.getElementById('edit_id_sk').value = idSk || ''; // Mengisi link SK
    }

    function handleEdit() {
        const tahunAnggaran = document.getElementById('edit_thn_anggaran').value;
        const urlInput = document.getElementById('edit_link_sk').value;
        const idSK = document.getElementById('edit_id_sk').value;
        const idUser = '<?= session()->get('id') ?>';
        const idSatker = '<?= session()->get('id_satker') ?>';

        $.ajax({
            url: '<?= base_url('/edit_sk') ?>',
            type: 'POST',
            data: {
                tahun_anggaran: tahunAnggaran,
                url: urlInput,
                id_SK: idSK,
                id_user: idUser,
                id_satker: idSatker
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Data yang dikirim:', {
                        tahun_anggaran: tahunAnggaran,
                        url: urlInput,
                        id_SK: idSK,
                        id_user: idUser,
                        id_satker: idSatker
                    });
                    alert('status: ' + response.message);
                    $('#modalEdit').modal('hide');
                    $('#row-' + idSK).remove();

                    // Add the updated row
                    const newRow = `
                    <tr id="row-${idSK}">
                        <td>${tahunAnggaran}</td>
                        <td class="text-center"><a href="${urlInput}"><i class='bx bxs-file-pdf text-danger'></i></a></td>
                        <td class="text-center"><i class='bx ${response.data.status_pim == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary"}'></i></td>
                        <td class="text-center"><i class='bx ${response.data.status_kpk == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary"}'></i></td>
                        <td class="text-center"><i class='bx ${response.data.status_klvl == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary"}'></i></td>
                        <td class="text-center">
                            <a href="javascript:void(0);" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"
                                data-thn-anggaran="${tahunAnggaran}"
                                data-link-sk="${urlInput}"
                                data-id-sk="${idSK}"
                                onclick="EditModal(this)">Edit SK</a>
                            <a href="<?= base_url('/dash_pm') ?>" class="btn btn-primary btn-sm">Penilaian</a>
                        </td>
                    </tr>
                `;
                    $('table tbody').append(newRow);

                } else {
                    alert('Status: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
                alert('Terjadi kesalahan saat mengirim data!');
            }
        });

    }

    function handleSave() {
        const tahunAnggaran = document.getElementById('thn_anggaran').value;
        const urlInput = document.getElementById('link_sk').value;
        const idUser = '<?= session()->get('id') ?>';
        const idSatker = '<?= session()->get('id_satker') ?>';
        $.ajax({
            url: '<?= base_url('/save_sk') ?>',
            type: 'POST',
            data: {
                tahun_anggaran: tahunAnggaran,
                url: urlInput,
                id_user: idUser,
                id_satker: idSatker
            },
            success: function(response) {
                if (response.status === 'success') {
                    console.log('Data berhasil disimpan:', response.message);
                    alert('status: ' + response.message);
                    $('#modalCenter').modal('hide');

                    // Update the table with new data
                    const newRow = `
                        <tr id="row-${response.data.id}">
                            <td>${response.data.thn_anggaran}</td>
                            <td class="text-center"><a href="${response.data.link_sk}"><i class='bx bxs-file-pdf text-danger'></i></a></td>
                            <td class="text-center"><i class='bx ${response.data.status_pim == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary"}'></i></td>
                            <td class="text-center"><i class='bx ${response.data.status_kpk == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary"}'></i></td>
                            <td class="text-center"><i class='bx ${response.data.status_klvl == 1 ? "bxs-check-circle text-success" : "bxs-minus-circle text-secondary"}'></i></td>
                            <td class="text-center">
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm">Edit SK</a>
                                <a href="<?= base_url('/dash_pm') ?>" class="btn btn-primary btn-sm">Penilaian</a>
                            </td>
                        </tr>
                    `;
                    $('table tbody').append(newRow); // Menambahkan baris baru ke tabel
                } else {
                    alert('Status: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
                alert('Terjadi kesalahan saat mengirim data!');
            }
        });
    }
</script>

<?= $this->endSection(); ?>