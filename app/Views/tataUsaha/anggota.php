<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<div class="row">
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Penyusunan Tim Penilaian SPI/SKI - <?= session()->get('email'); ?> </h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 order-0">
                                <div class="row">

                                    <!-- Edit Data tim -->
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <!-- <h5 class="card-header">Data Tim Penilai</h5> -->
                                            <div class="card-body">
                                                <?php
                                                foreach ($tim as $data) {
                                                    $jenisTim = ($data['tim'] == 1) ? 'Penjaminan Kualitas' : (($data['tim'] == 2) ? 'Leveling' : 'Tidak Diketahui');
                                                    echo $data['nosurat'] . '<br>' . $data['nama_satker'] . '<br><strong> Tim ' . $jenisTim . '</strong><br><br>';
                                                ?>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tglAwal" class="form-label">Tgl Awal</label>
                                                            <input id="tglAwal" class="form-control form-control-sm" type="date" value="<?= $data['tgl_awal'] ?>" required />
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="tglAkhir" class="form-label">Tgl Akhir</label>
                                                            <input id="tglAkhir" class="form-control form-control-sm" type="date" value="<?= $data['tgl_akhir'] ?>" required />
                                                        </div>
                                                        <div class="col-12 text-end">
                                                            <p class="text-danger small">*) Update jika ada perubahan</p>
                                                            <button type="submit" class="btn btn-sm btn-primary" onclick="handleFormUpdate(<?= $data['id_timaudit'] ?>)">Update</button>
                                                        </div>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pilih Anggota Tim -->
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <h5 class="card-header">Data Susunan Tim</h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="exampleDataList" class="form-label">Nama Auditor</label>
                                                        <input class="form-control" list="daftarAuditor" id="inputAuditor" placeholder="ketik untuk mencari..." required />
                                                        <datalist id="daftarAuditor">
                                                            <?php foreach ($auditor as $a): ?>
                                                                <option data-value="<?= $a['id']; ?>" value="<?= $a['firstname']; ?>"></option>
                                                            <?php endforeach; ?>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="posisi" class="form-label">Peran Dalam Tim</label>
                                                        <select id="posisi" class="form-select form-select-sm" required>
                                                            <option value="" disabled selected>Pilihan .....</option>
                                                            <option value="10">Ketua Tim</option>
                                                            <option value="11">Anggota</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12 text-end">
                                                        <button type="submit" class="btn btn-sm btn-primary" onclick="handleFormTambah()">Tambah</button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Anggota tim -->
                                    <div class="col-xl-12">
                                        <div class="card mb-4">
                                            <h5 class="card-header">Data Tim Penilai</h5>
                                            <div class="card-body">
                                                <table class="table table-hover table-sm text-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama Auditor</th>
                                                            <th>NIP</th>
                                                            <th style="text-align: center;">Peran</th>
                                                            <th style="text-align: center;">Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="table-border-bottom-0" id="contentArea">

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- Tombol Simpan -->
                                <div class="row">
                                    <div class="col-12 text-end">
                                        <?= ($tim[0]['statustim'] == 0)
                                            ? '<button type="submit" class="btn btn-primary" onclick="handleFormSubmit(event)">Submit Tim</button>'
                                            : '<button type="button" class="btn btn-secondary" disabled>Tim telah aktif</button>';
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        loadData();
    });

    function loadData() {
        const urlParams = new URLSearchParams(window.location.search);
        const idTim = urlParams.get('id');
        $.ajax({
            url: "<?= base_url('/tabAnggota') ?>",
            type: "GET",
            data: {
                id: idTim
            },
            success: function(data) {
                $("#contentArea").html(data); // Menampilkan data di div target               
            },
            error: function() {
                $("#contentArea").html("<p>Error loading content</p>");
            }
        });
    }

    function handleFormTambah(id) {
        const posisi = document.getElementById('posisi').value;
        const idTim = <?= json_encode($data['id_timaudit']); ?>;
        const idSatker = <?= json_encode($data['id_satker']); ?>;
        const idTU = <?= session()->get('id'); ?>;
        const inputVal = document.getElementById('inputAuditor').value;
        const options = document.querySelectorAll('#daftarAuditor option');
        let selectedId = null;

        options.forEach(option => {
            if (option.value === inputVal) {
                selectedId = option.getAttribute('data-value');
            }
        });

        $.ajax({
            url: '<?= base_url('/saveAngg') ?>',
            type: 'POST',
            data: {
                id_timaudit: idTim,
                id_user: selectedId,
                posisi: posisi,
                idSatker: idSatker,
                idTu: idTU
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#inputAuditor').val('');
                    $('#posisi').val('');
                    loadData();
                } else {
                    alert('Gagal: ' + response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
                alert('Terjadi kesalahan saat mengirim data!');
            }
        });
    }

    function handleFormUpdate(x) {
        const id_timaudit = x;
        const tglAwal = document.getElementById('tglAwal').value;
        const tglAkhir = document.getElementById('tglAkhir').value;
        console.log(id_timaudit);
        console.log(tglAwal);
        console.log(tglAkhir);
        $.ajax({
            url: '<?= base_url('/uTim') ?>',
            type: 'POST',
            data: {
                id_timaudit: id_timaudit,
                tglAwal: tglAwal,
                tglAkhir: tglAkhir
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert('Data berhasil diupdate!');
                } else {
                    alert('Gagal update data: ' + (response.message || ''));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat update data.');
            }
        });
    }

    function handleFormSubmit() {
        const idTim = <?= json_encode($data['id_timaudit']) ?>;
        $.ajax({
            url: '<?= base_url('/subTim') ?>',
            type: 'POST',
            data: {
                id_timaudit: idTim
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    window.location.href = "<?= base_url('/cTim') ?>";
                } else {
                    alert('Gagal update data: ' + (response.message || ''));
                }
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat update data.');
            }
        });
    }
</script>

<?= $this->endSection(); ?>