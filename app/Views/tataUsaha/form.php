<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<div class="row">
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Pembuatan Tim Penilaian SPI/SKI - <?= session()->get('email'); ?> </h5>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 order-0">
                                <div class="row">
                                    <!-- Data Tim Penilai -->
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <h5 class="card-header">Data Tim Penilai</h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6 mb-3">
                                                        <label for="noSurat" class="form-label">No Surat</label>
                                                        <input id="noSurat" class="form-control form-control-sm" type="text" placeholder="PS.03.04/G.IV/636/20" required />
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="tglSurat" class="form-label">Tgl Surat</label>
                                                        <input id="tglSurat" class="form-control form-control-sm" type="date" required />
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="tglAwal" class="form-label">Tgl Awal</label>
                                                        <input id="tglAwal" class="form-control form-control-sm" type="date" required />
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="tglAkhir" class="form-label">Tgl Akhir</label>
                                                        <input id="tglAkhir" class="form-control form-control-sm" type="date" required />
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="pj" class="form-label">Penanggung Jawab</label>
                                                        <select id="pj" class="form-select form-select-sm" required>
                                                            <option value="" disabled selected>Pilihan .....</option>
                                                            <?php foreach ($inspektur as $i): ?>
                                                                <option value="<?= $i['id']; ?>"><?= $i['firstname']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 mb-3">
                                                        <label for="ir" class="form-label">Inspektorat</label>
                                                        <select id="ir" class="form-select form-select-sm" required>
                                                            <option value="" disabled selected>Pilihan .....</option>
                                                            <option value="209">Inspektorat I</option>
                                                            <option value="210">Inspektorat II</option>
                                                            <option value="213">Inspektorat III</option>
                                                            <option value="211">Inspektorat IV</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Data Satker -->
                                    <div class="col-xl-6">
                                        <div class="card mb-4">
                                            <h5 class="card-header">Data Satker</h5>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 mb-3">
                                                        <label for="exampleDataList" class="form-label">Daftar Satker</label>
                                                        <input class="form-control" list="daftarSatker" id="exampleDataList" placeholder="ketik untuk mencari..." required />
                                                        <datalist id="daftarSatker">
                                                            <?php foreach ($satker as $s): ?>
                                                                <option data-value="<?= $s['id']; ?>" value="<?= $s['nama_satker']; ?>"></option>
                                                            <?php endforeach; ?>
                                                        </datalist>
                                                    </div>
                                                    <div class="col-md-12 mb-3">
                                                        <label for="tipePenilaian" class="form-label">Tipe Penilaian</label>
                                                        <select id="tipePenilaian" class="form-select form-select-sm" required>
                                                            <option value="" disabled selected>Pilihan .....</option>
                                                            <option value="1">Penjaminan Kualitas (PK)</option>
                                                            <option value="2">Leveling (lvl)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tombol Simpan -->
                                <div class="row">
                                    <div class="col-12 text-end">
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
<div class="row mt-2">
    <div class="col-lg-12 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 order-0">
                                <div class="row" id="contentArea"></div>
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
    // fungsi mengambil data inputan pencarian tim audit
    document.getElementById('exampleDataList').addEventListener('input', function() {
        const inputVal = this.value; // Ambil teks yang diketik
        const datalist = document.getElementById('daftarSatker');

        for (let option of datalist.options) {
            if (option.value === inputVal) {
                this.dataset.satkerId = option.getAttribute('data-value'); // Simpan ID di dataset
                break;
            }
        }
    });

    // fungsi ajax untuk menyimpan tim audit
    function handleFormSubmit(event) {
        event.preventDefault(); // Cegah submit langsung

        const noSurat = document.getElementById('noSurat').value;
        const tglSurat = document.getElementById('tglSurat').value;
        const tglAwal = document.getElementById('tglAwal').value;
        const tglAkhir = document.getElementById('tglAkhir').value;
        const pj = document.getElementById('pj').value;
        const ir = document.getElementById('ir').value;
        const tipePenilaian = document.getElementById('tipePenilaian').value;
        const satkerId = document.getElementById('exampleDataList').dataset.satkerId || '';
        if (!satkerId) {
            alert('Pilih Satker yang valid!');
            return;
        }

        const fields = ['noSurat', 'tglSurat', 'tglAwal', 'tglAkhir', 'pj', 'ir', 'exampleDataList', 'tipePenilaian'];

        for (let field of fields) {
            const element = document.getElementById(field);
            if (!element || !element.value) {
                alert(`Field ${field} tidak boleh kosong!`);
                return;
            }
        }

        $.ajax({
            url: '<?= base_url('/save_tim') ?>', // URL endpoint untuk menyimpan data
            type: 'POST',
            data: {
                noSurat: noSurat,
                tglSurat: tglSurat,
                tglAwal: tglAwal,
                tglAkhir: tglAkhir,
                pj: pj,
                ir: ir,
                tipePenilaian: tipePenilaian,
                satkerId: satkerId
            },
            success: function(response) {
                console.log('Response dari server:', response);
                if (response.status === 'success') {
                    alert(response.message);
                    document.getElementById('noSurat').value = '';
                    document.getElementById('tglSurat').value = '';
                    document.getElementById('tglAwal').value = '';
                    document.getElementById('tglAkhir').value = '';
                    document.getElementById('pj').value = '';
                    document.getElementById('ir').value = '';
                    document.getElementById('tipePenilaian').value = '';
                    document.getElementById('exampleDataList').value = '';
                    document.getElementById('exampleDataList').removeAttribute('data-satker-id');
                    loadData();
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

    // fungsi ajax tampil data
    function loadData() {
        $.ajax({
            url: "<?= base_url('/tTim') ?>",
            type: "GET",
            success: function(data) {
                $("#contentArea").html(data); // Menampilkan data di div target
            },
            error: function() {
                $("#contentArea").html("<p>Error loading content</p>");
            }
        });
    }

    $(document).ready(function() {
        loadData();
    });
</script>


<?= $this->endSection(); ?>