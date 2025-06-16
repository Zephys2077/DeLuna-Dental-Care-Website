<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<style>
.page-item.active .page-link {
    background: linear-gradient(135deg, #DAA520, #B8860B) !important;
    border-color: #B8860B !important;
    color: white !important;
}
.page-link {
    color: #B8860B !important;
}
.page-link:hover {
    color: #8B4513 !important;
}
.dataTables_wrapper .dataTables_filter input:focus,
.dataTables_wrapper .dataTables_length select:focus {
    border-color: #DAA520 !important;
    box-shadow: 0 0 0 0.2rem rgba(218, 165, 32, 0.25) !important;
}
</style>

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Pilih obat",
        allowClear: true,
        theme: "classic",
        selectionCssClass: 'select2-gold'
    });

    $('.table').DataTable({
        "responsive": true,
        "language": {
            "search": "Cari:",
            "lengthMenu": "Tampilkan _MENU_ data per halaman",
            "zeroRecords": "Data tidak ditemukan",
            "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
            "infoEmpty": "Tidak ada data tersedia",
            "infoFiltered": "(difilter dari _MAX_ total data)",
            "paginate": {
                "first": "Pertama",
                "last": "Terakhir",
                "next": "Selanjutnya",
                "previous": "Sebelumnya"
            }
        }
    });
});
</script>
</body>
</html>