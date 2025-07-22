<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<div class="row">

    <!-- Ucapan Profil -->
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang! 🎉</h5>
                        <p class="mb-4">
                            <span class="fw-bold">Administrasi Umum</span>
                            <br> Inspektorat I
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img
                            src="/sneat/assets/img/illustrations/man-with-laptop-light.png"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Ucapan Profil -->

    <!-- Jumlah Penugasan -->
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="/sneat/assets/img/icons/unicons/wallet-info.png"
                                    alt="Credit card"
                                    class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button
                                    class="btn p-0"
                                    type="button"
                                    id="cardOpt3"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Penilaian PK</span>
                        <h3 class="card-title mb-2">2</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img
                                    src="/sneat/assets/img/icons/unicons/cc-warning.png"
                                    alt="Credit Card"
                                    class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button
                                    class="btn p-0"
                                    type="button"
                                    id="cardOpt6"
                                    data-bs-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Leveling</span>
                        <h3 class="card-title text-nowrap mb-2">1</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jumlah Penugasan -->
</div>


<div class="row">
    <!-- Order Statistics -->
    <div class="col-md-12 col-lg-8 col-xl-8 order-0 ">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2">Status Penilaian SPI/SKI Satuan Kerja</h5>

                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap mt-4">
                    <div class="card">
                        <div class="table-responsive">
                            <div class="mb-3">
                                <input type="text" id="search-satuan-kerja" class="form-control" placeholder="Cari Satuan Kerja ......">
                            </div>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Satuan Kerja</th>
                                        <th>Tahun</th>
                                        <th>PM</th>
                                        <th>PK</th>
                                        <th>Level</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body" class="table-border-bottom-0">
                                    <?php $no = 1;
                                    foreach ($resume as $p): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td class="text-wrap"><strong><?= $p->nama_satker; ?></strong></td>
                                            <td><?= $p->thn_anggaran; ?></td>
                                            <td class="text-center">
                                                <?= $p->status_pim == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-minus-circle text-danger'></i>"; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $p->status_kpk == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-minus-circle text-danger'></i>"; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $p->status_klvl == 1 ? "<i class='bx bxs-check-circle text-success'></i>" : "<i class='bx bxs-minus-circle text-danger'></i>"; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    <!-- Tambahkan baris lainnya sesuai kebutuhan -->
                                </tbody>
                            </table>
                        </div>
                        <div class="pagination-controls text-center mt-4">
                            <button onclick="prevPage()" class="btn btn-primary btn-sm">Previous</button>
                            <span id="page-info"></span>
                            <button onclick="nextPage()" class="btn btn-primary btn-sm">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Order Statistics -->

    <!-- Riwayat Bentuk Tim -->
    <div class="col-md-6 col-lg-4 order-1">
        <div class="card h-100">
            <a href="<?= base_url('/cTim') ?>" class="btn btn-info btn-sm">Buat Tim Penilaian</a>
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Riwayat Bentuk Tim</h5>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <?php foreach ($tim as $index => $t) : ?>
                        <li class="d-flex mb-4 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <a href="javascript:void(0);" onclick="userPlus('<?= base64_encode($t['id_timaudit']) ?>')">
                                    <img
                                        src="/sneat/assets/img/icons/unicons/<?= $t['statustim'] == 1 ? 'cc-success.png' : 'cc-warning.png' ?>"
                                        alt="Status"
                                        class="rounded" />
                                </a>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0"><?= $t['nama_satker'] ?></h6>
                                    <small class="text-muted d-block mb-1">
                                        <i class='bx bx-notepad'></i>
                                        <?= ($t['tim'] == 1) ? "PK" : "Leveling"; ?> · <?= date('d M Y', strtotime($t['tgl_surat'])) ?>
                                    </small>

                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <!--/ Riwayat Penilaian -->
</div>

<script>
    // fungsi untuk melihat tim
    function userPlus(id) {
        // alert('Edit data ID: ' + id);
        // atau arahkan ke halaman edit
        window.location.href = '/tAnggota?id=' + id;
    }

    const rowsPerPage = 5;
    let currentPage = 1;
    const tableBody = document.getElementById("table-body");
    const pageInfo = document.getElementById("page-info");

    let filteredRows = [];

    function updateFilteredRows() {
        const searchValue = document.getElementById("search-satuan-kerja").value.toLowerCase();
        const allRows = Array.from(tableBody.querySelectorAll("tr"));
        filteredRows = allRows.filter(row => {
            const satuanKerja = row.cells[1].textContent.toLowerCase();
            return satuanKerja.includes(searchValue);
        });
    }

    function displayTable() {
        // Update filter dulu sebelum hitung pagination
        updateFilteredRows();

        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        if (currentPage > totalPages) currentPage = 1;

        // Sembunyikan semua baris
        Array.from(tableBody.querySelectorAll("tr")).forEach(row => row.style.display = "none");

        // Tampilkan baris yang sesuai halaman
        const start = (currentPage - 1) * rowsPerPage;
        const end = currentPage * rowsPerPage;
        filteredRows.slice(start, end).forEach(row => row.style.display = "");

        pageInfo.textContent = `Page ${currentPage} of ${totalPages || 1}`;
    }

    function nextPage() {
        const totalPages = Math.ceil(filteredRows.length / rowsPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            displayTable();
        }
    }

    function prevPage() {
        if (currentPage > 1) {
            currentPage--;
            displayTable();
        }
    }

    document.getElementById("search-satuan-kerja").addEventListener("input", () => {
        currentPage = 1;
        displayTable();
    });

    // Inisialisasi pertama
    displayTable();
</script>


<?= $this->endSection(); ?>