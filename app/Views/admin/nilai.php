<?= $this->extend('layout/index'); ?>
<?= $this->section('page_content'); ?>

<style>
    /* Ukuran font dan padding DataTables */
    table.dataTable {
    font-size: 13px; /* atau 0.8125rem */
    }

    table.dataTable thead th,
    table.dataTable tbody td {
    padding: 4px 8px !important; /* Perkecil padding */
    vertical-align: middle;
    }

    /* Untuk text di bawah tabel (info dan pagination) */
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
    font-size: 12px;
    }

    /* Optional: kecilkan search dan dropdown */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
    font-size: 13px;
    padding: 2px 6px;
    }

    div.dataTables_length {
        font-size: 0.875rem !important;
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        margin-bottom: 1rem !important;
    }

    div.dataTables_length label {
        display: flex !important;
        align-items: center !important;
        gap: 0.5rem !important;
        margin-bottom: 0 !important;
    }

    div.dataTables_length select {
        padding: 0.375rem 1rem !important;
        font-size: 0.875rem !important;
        border: 1px solid #d9dee3 !important;
        border-radius: 0.375rem !important;
        background-color: #fff !important;
        height: auto !important;
        line-height: 1.5 !important;
        width: auto !important;
    }

    .dataTables_length select.form-select {
    all: unset;
    display: inline-block;
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #697a8d;
    background-color: #fff;
    border: 1px solid #d9dee3;
    border-radius: 0.375rem;
    }

    .table th, .table td {
    text-align: center;
    vertical-align: middle;
  }
</style>

<div class="card">
    <h5 class="card-header">Tabel Nilai </h5>
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>SATUAN KERJA</th>
                        <th>ESELON SATU</th>                                    
                        <th></th>                                        
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>  

<!-- Modal -->
<div class="modal fade" id="nilaiModal" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="nilaiModalLabel">Penilaian Satker</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body">
        <!-- Konten akan dimasukkan via JavaScript -->
        <p id="modal-content-placeholder">Loading...</p>
      </div>     
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    const table = new DataTable('#myTable', {    
        ajax: '<?= base_url('/cms/nilai/data') ?>',
        columns: [       
            { data: 1 },
            { data: 2 },
            { data: 5 },
        ]
    });

    function renderStatusButton(label, status, url = '#') {
        const isDisabled = status === 0 || status === '0';

        if (isDisabled) {
            return `<button class="btn btn-secondary btn-sm" disabled>${label}</button>`;
        } else {
            return `<a href="${url}" class="btn btn-primary btn-sm">${label}</a>`;
        }
    }

    $(document).on('click', '.btn-nilai', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        const nama = $(this).data('nama');

            $.ajax({
                url: '/cms/nilai/data/' + id, // pastikan bukan "datail"
                type: 'GET',
                success: function(data) {
                    let html = '<h5>' + nama + '</h5>';
                    html += '<table class="table table-bordered">';
                    html += '<thead><tr><th>Tahun</th><th>PM</th><th>PK</th><th>Leveling</th></tr></thead><tbody>';
                    const baseUrl = '/cms/';
                    if (data.length > 0) {
                        data.forEach(row => {
                            html += '<tr>';
                            html += '<td>' + (row.thn_anggaran || '-') + '</td>';
                            html += '<td>' + renderStatusButton('PM', row.status_pim, `${baseUrl}dashPm?jenis=pm&id=${row.id_satker}&thn=${row.thn_anggaran}`) + '</td>';
                            html += '<td>' + renderStatusButton('PK', row.status_kpk, `${baseUrl}?jenis=pk&id=${row.id_satker}&thn=${row.thn_anggaran}`) + '</td>';
                            html += '<td>' + renderStatusButton('Leveling', row.status_klvl, `${baseUrl}?jenis=leveling&id=${row.id_satker}&thn=${row.thn_anggaran}`) + '</td>';
                            html += '</tr>';
                        });
                    } else {
                        html += '<tr><td colspan="4" class="text-center">Tidak ada data penilaian</td></tr>';
                    }

                    html += '</tbody></table>';

                    $('#modal-content-placeholder').html(html);
                    const modal = new bootstrap.Modal(document.getElementById('nilaiModal'));
                    modal.show();
                }
            });
    });

</script>

<?= $this->endSection(); ?>