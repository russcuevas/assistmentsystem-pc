
$('.delete-checkbox').change(function () {
    if ($('.delete-checkbox:checked').length > 0) {
        $('#delete-selected-default-id-btn').show();
    } else {
        $('#delete-selected-default-id-btn').hide();
    }
});

$('#delete-selected-default-id-btn').click(function () {
    const selectedIds = [];
    $('.delete-checkbox:checked').each(function () {
        selectedIds.push($(this).val());
    });

    const deleteRoute = $(this).data('route');

    swal({
        title: "Are you sure?",
        text: "You want to delete the selected items?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            showLoading();
            $.ajax({
                url: deleteRoute,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    delete_selected_ids: selectedIds
                },
                success: function (response) {
                    swal({
                        title: "Deleted!",
                        text: response.success,
                        icon: "success",
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    swal("Error!", 'Error occurred: ' + xhr.responseJSON.error, "error");
                }
            });
        }
    });
});

function showLoading() {
    HoldOn.open({
        theme: 'sk-circle',
        message: '<div class="loading-message">Please wait, deleting ID...</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}