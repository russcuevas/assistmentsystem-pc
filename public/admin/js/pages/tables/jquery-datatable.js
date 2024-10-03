$(function () {
    $('.js-basic-example').DataTable({
        responsive: true
    });

    // Exportable table
    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            { extend: 'copy', className: 'custom-button' },
            { extend: 'csv', className: 'custom-button' },
            { extend: 'excel', className: 'custom-button' },
            { extend: 'pdf', className: 'custom-button' },
            { extend: 'print', className: 'custom-button' }
        ]
    });
});
