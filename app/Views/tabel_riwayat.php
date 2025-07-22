<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<div class="card">
    <h5 class="card-header">Riwayat Penilaian</h5>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Satuan Kerja</th>
                    <th>Organisasi</th>
                    <th>Tahun</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
                <tr>
                    <th><input type="text" class="form-control" placeholder="SatKer" onkeyup="filterTable(0)" /></th>
                    <th><input type="text" class="form-control" placeholder="Organisasi" onkeyup="filterTable(1)" /></th>
                    <th><input type="text" class="form-control" placeholder="Tahun" onkeyup="filterTable(2)" /></th>
                    <th><input type="text" class="form-control" placeholder="Tipe" onkeyup="filterTable(3)" /></th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>Poltekkes Kemenkes Mataram</td>
                    <td>Direktorat Jenderal Tenaga Kesehatan</td>
                    <td>2024</td>
                    <td>Penjaminan Kualitas</td>
                    <td>
                        <a href="<?= base_url('tbl_pk') ?>" class="btn btn-info">Rincian</a>
                    </td>
                </tr>
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i>Rumah Sakit Jiwa Dr. H. Marzoeki Mahdi Bogor</td>
                    <td>Direktorat Jenderal Pelayanan Kesehatan</td>
                    <td>2025</td>
                    <td>Penilaian Leveling</td>
                    <td>
                        <a href="<?= base_url('tbl_lvl') ?>" class="btn btn-info">Rincian</a>
                    </td>
                </tr>
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