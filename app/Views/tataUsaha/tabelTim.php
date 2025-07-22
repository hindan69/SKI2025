<div class="card">
    <h5 class="card-header">Tabel Tim Penilaian</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover table-sm text-sm">
            <thead>
                <tr>
                    <th>Satuan Kerja</th>
                    <th>Organisasi</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th style="text-align: center;">Aksi</th>
                </tr>
                <tr>
                    <th><input type="text" class="form-control" placeholder="SatKer" onkeyup="filterTable(0)" /></th>
                    <th><input type="text" class="form-control" placeholder="Organisasi" onkeyup="filterTable(1)" /></th>
                    <th><input type="text" class="form-control" placeholder="Tahun" onkeyup="filterTable(2)" /></th>
                    <th><input type="text" class="form-control" placeholder="Tipe" onkeyup="filterTable(3)" /></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0 small">
                <?php foreach ($tim as $data): ?>
                    <tr id=row-<?= $data['id_timaudit'] ?>>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i><?= $data['nama_satker'] ?></td>
                        <td><?= $data['nama_organisasi'] ?></td>
                        <td><?= date('Y', strtotime($data['tgl_surat'])); ?></td>
                        <td><?= ($data['tim'] == 1) ? 'Penjaminan Kualitas' : (($data['tim'] == 2) ? 'Penilaian Leveling' : ''); ?></td>
                        <td>
                            <?php if ($data['statustim'] == 0): ?>
                                <a href="javascript:void(0);" class="btn btn-success btn-xs" onclick="userPlus('<?= base64_encode($data['id_timaudit']) ?>')">
                                    <i class='bx bxs-user-plus'></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-xs" onclick="deleteData(<?= $data['id_timaudit']; ?>)">
                                    <i class="bx bxs-trash"></i>
                                </a>
                            <?php else: ?>
                                <a href="javascript:void(0);" class="btn btn-warning btn-xs" onclick="userPlus('<?= base64_encode($data['id_timaudit']) ?>')">
                                    <i class="bx bxs-edit"></i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-info btn-xs" onclick="viewData(<?= $data['id_timaudit']; ?>)">
                                    Lihat
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
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

    function userPlus(id) {
        // alert('Edit data ID: ' + id);
        // atau arahkan ke halaman edit
        window.location.href = '/tAnggota?id=' + id;
    }

    function deleteData(id) {
        if (confirm('Apakah yakin ingin menghapus data ini?')) {
            // atau panggil AJAX untuk hapus data
            $.ajax({
                url: "<?= base_url('/disTim') ?>",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#row-' + id).remove();
                        alert(response.message);
                    } else {
                        alert('Gagal: ' + response.message);
                    }
                },
                error: function() {
                    alert("Gagal menghapus tim.");
                }
            });
        }
    }

    function viewData(id) {
        // alert('Lihat data ID: ' + id);
        // bisa juga redirect ke halaman detail
        // window.location.href = 'view.php?id=' + id;
        $.ajax({
            url: "<?= base_url('/disTim') ?>",
            type: "GET",
            data: {
                id: id
            },
            success: function(data) {
                renderDisplay(data);
            },
            error: function() {
                alert("Gagal mengambil data tim.");
            }
        });
    }

    function renderDisplay(response) {
        // Buka tab baru
        const newWindow = window.open('', '_blank');

        // Data tim (asumsi satu tim)
        const tim = response.tim[0];
        const infoHtml = `
        <h2>Informasi Tim</h2>
        <p><strong>Tim :</strong> ${tim.nama_satker}</p>
        <p><strong>Status :</strong> ${tim.statustim == 1 ? 'Aktif' : 'Belum Aktif'}</p>
        <hr>
        `;

        // Data anggota
        let anggotaHtml = `
            <h3>Anggota Tim</h3>
            <table border="1" cellpadding="8">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIP</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                    </tr>
                </thead>
                <tbody>
        `;

        response.anggota.forEach((a, i) => {
            anggotaHtml += `
                <tr>
                    <td>${i + 1}</td>
                    <td>${a.username}</td>
                    <td>${a.firstname}</td>
                    <td>${a.rolepk == 10 ? 'Ketua' : 'Anggota'}</td>
                </tr>
             `;
        });

        anggotaHtml += `</tbody></table>`;

        // Gabungkan semua HTML
        const fullHtml = `
            <html>
                <head>
                    <title>Detail Tim</title>
                    <style>
                        body { font-family: Arial; padding: 20px; }
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; }
                    </style>
                </head>
                <body>
                    ${infoHtml}
                    ${anggotaHtml}
                </body>
            </html>
        `;

        // Tampilkan di tab baru
        newWindow.document.write(fullHtml);
        newWindow.document.close(); // penting untuk render!
    }
</script>