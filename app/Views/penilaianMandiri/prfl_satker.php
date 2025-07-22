<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<div class="row">
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Penilaian Mandiri SPI/SKI</h5>
                        <p class="mb-0">
                            <span class="fw-bold">Rumah Sakit Penyakit Infeksi Prof. Dr. Sulianti Saroso Jakarta</span>
                            <br>
                            Direktorat Jenderal Pelayanan Kesehatan
                        </p>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 order-0">
                                <div class="row">
                                    <!-- Basic Layout -->
                                    <div class="col-xxl">
                                        <div class="card">
                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                <h5 class="mb-0">Data Umum</h5>
                                                <small class="text-muted float-end">Profil satker</small>
                                            </div>
                                            <div class="card-body">
                                                <div class="row mb-3">
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label" for="basic-default-name">Nama Pimpinan Satker</label>
                                                        <input type="text" class="form-control" id="nama_pimpinan" placeholder="Pimpinan Satker" name="nama_pimpinan" value="<?= isset($dataUmum[0]['nama_pimpinan']) ? htmlspecialchars($dataUmum[0]['nama_pimpinan']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan nama_pimpinan, jika tidak kosong -->
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label" for="basic-default-nip">NIP Pimpinan</label>
                                                        <input type="number" class="form-control" id="nip_pimpinan" placeholder="123456789" name="nip_pimpinan" value="<?= isset($dataUmum[0]['nip_pimpinan']) ? htmlspecialchars($dataUmum[0]['nip_pimpinan']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan nip_pimpinan, jika tidak kosong -->
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label" for="basic-default-nip">Nama Jabatan</label>
                                                        <input type="text" class="form-control" id="nama_jabatan" placeholder="Direktur / Kepala / Pimpinan" name="nama_jabatan" value="<?= isset($dataUmum[0]['nama_jabatan']) ? htmlspecialchars($dataUmum[0]['nama_jabatan']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan nama_jabatan, jika tidak kosong -->
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label" for="basic-default-name">Nama Ketua SPI/SKI</label>
                                                        <input type="text" class="form-control" id="nama_ketua" placeholder="Nama Ketua" name="nama_ketua" value="<?= isset($dataUmum[0]['nama_ketua']) ? htmlspecialchars($dataUmum[0]['nama_ketua']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan nama_ketua, jika tidak kosong -->
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <label class="col-form-label" for="basic-default-nip">NIP Ketua SPI/SKI</label>
                                                        <input type="number" class="form-control" id="nip_ketua" placeholder="123456789" name="nip_ketua" value="<?= isset($dataUmum[0]['nip_ketua']) ? htmlspecialchars($dataUmum[0]['nip_ketua']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan nip_ketua, jika tidak kosong -->
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label" for="basic-default-alamat">Alamat Lengkap Satuan Kerja</label>
                                                        <input type="text" class="form-control" id="alamat_satker" placeholder="Jl. Raya Bandung" name="alamat_satker" value="<?= isset($dataUmum[0]['alamat_satker']) ? htmlspecialchars($dataUmum[0]['alamat_satker']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan alamat_satker, jika tidak kosong -->
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label" for="basic-default-kota">Kota</label>
                                                        <input type="text" class="form-control" id="kota_satker" placeholder="Bandung" name="kota_satker" value="<?= isset($dataUmum[0]['kota_satker']) ? htmlspecialchars($dataUmum[0]['kota_satker']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan kota_satker, jika tidak kosong -->
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <label class="col-form-label" for="basic-default-kodepos">Kode Pos</label>
                                                        <input type="number" class="form-control" id="kodepos" placeholder="12345" name="kodepos" value="<?= isset($dataUmum[0]['kodepos']) ? htmlspecialchars($dataUmum[0]['kodepos']) : '' ?>" />
                                                        <!-- Jika data ada, isi dengan kodepos, jika tidak kosong -->
                                                    </div>
                                                </div>
                                                <div class="row justify-content-end">
                                                    <div class="col-sm-12 text-end"> <!-- Ubah col-sm-10 menjadi col-sm-12 dan tambahkan text-end -->
                                                        <button type="submit" class="btn btn-primary" onclick="handleFormSubmit(event)">Simpan</button>
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
            </div>
        </div>
    </div>
</div>

<script>
    function handleFormSubmit() {
        const satkerId = <?= json_encode(session()->get('id_satker')); ?>;
        const namaPimpinan = document.getElementById('nama_pimpinan').value;
        const nipPimpinan = document.getElementById('nip_pimpinan').value;
        const namaJabatan = document.getElementById('nama_jabatan').value;
        const namaKetua = document.getElementById('nama_ketua').value;
        const nipKetua = document.getElementById('nip_ketua').value;
        const alamatSatker = document.getElementById('alamat_satker').value;
        const kotaSatker = document.getElementById('kota_satker').value;
        const kodepos = document.getElementById('kodepos').value;

        // Validasi jika input kosong
        if (!namaPimpinan || !nipPimpinan || !namaJabatan || !namaKetua || !nipKetua || !alamatSatker || !kotaSatker || !kodepos) {
            alert("Harap isi semua data sebelum mengirim.");
            return;
        }

        $.ajax({
            url: '<?= base_url('/save_prfl_satker') ?>',
            type: 'POST',
            data: {
                id_satker: satkerId,
                nama_pimpinan: namaPimpinan,
                nip_pimpinan: nipPimpinan,
                nama_jabatan: namaJabatan,
                nama_ketua: namaKetua,
                nip_ketua: nipKetua,
                alamat_satker: alamatSatker,
                kota_satker: kotaSatker,
                kodepos: kodepos
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#nama_pimpinan, #nip_pimpinan, #nama_jabatan, #nama_ketua, #nip_ketua, #alamat_satker, #kota_satker, #kodepos').val('');
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