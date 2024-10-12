$(function () {
    $('.js-basic-example').DataTable({
        responsive: true,
        searching: false
    });

    $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        responsive: true,
        searching: false,
        buttons: [
            { extend: 'copy', className: 'custom-button' },
            { extend: 'csv', className: 'custom-button' },
            { extend: 'excel', className: 'custom-button' },
            { extend: 'pdf', className: 'custom-button' },
            { extend: 'print', className: 'custom-button' }
        ]
    });
});
