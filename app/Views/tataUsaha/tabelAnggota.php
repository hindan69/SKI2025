<?php foreach ($tim as $d): ?>
    <tr class="text-sm">
        <td><?= $d['firstname']; ?></td>
        <td><?= $d['username']; ?></td>
        <td style="text-align: center;"><?= $d['rolepk'] == 10 ? 'Ketua' : 'Anggota'; ?></td>
        <td style="text-align: center;">
            <a href="javascript:void(0);" class="btn btn-warning btn-xs" onclick="deleteData(<?= $d['id_pk'] ?>, this)">
                <i class="bx bxs-trash"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // fungsi delete data
    function deleteData(id, el) {
        if (confirm('Apakah yakin ingin menghapus data ini?')) {
            $.ajax({
                url: "<?= base_url('/delAnggota') ?>",
                type: "POST",
                data: {
                    id: id
                },
                success: function(response) {
                    if (response.success) {
                        $(el).closest('tr').remove();
                        checkPositions(); // Panggil fungsi setelah menghapus
                        alert('Data berhasil dihapus.');
                    } else {
                        alert('Gagal menghapus data.');
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat menghapus data.');
                }
            });
        }
    }

    // memanggil fungsi cek
    $(document).ready(function() {
        cek(); // Panggil cek() saat halaman dimuat
    });

    // fungsi untuk menonaktifkan tombol submit ketika susunan tim belum terbentuk
    function cek() {
        // Data tim dari PHP yang sudah di-encode jadi JSON
        const posisi = <?= json_encode($tim); ?>;

        let jumlahKetua = 0;
        let jumlahAnggota = 0;

        // Cek jumlah posisi 1 (Ketua) dan 2 (Anggota)
        posisi.forEach(item => {
            if (item.posisi == 1) jumlahKetua++; // Hitung Ketua
            if (item.posisi == 2) jumlahAnggota++; // Hitung Anggota
        });

        console.log("Jumlah Ketua:", jumlahKetua);
        console.log("Jumlah Anggota:", jumlahAnggota);

        // Aktifkan tombol jika ada Ketua dan Anggota
        const bolehSubmit = jumlahKetua > 0 && jumlahAnggota > 0;
        $('#submitButton').prop('disabled', !bolehSubmit);
    }
</script>