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
</style>

<div class="card">
    <h5 class="card-header">Tabel Users</h5>
    <div class="card-body">        
        <div class="table-responsive text-nowrap">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>USERNAME</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>IS_ACTIVE</th>                    
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div

<!--  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
 const table = new DataTable('#myTable', {    
    ajax: '<?= base_url('/cms/users/data') ?>',
    columns: [       
        { data: 1 },
        { data: 2 },
        { data: 3 },
        { data: 4 },
        { data: 6 },
        { data: 7 },
    ]
  });
</script>
<?= $this->endSection(); ?>