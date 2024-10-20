$(document).ready(function () {
    $('.delete-riasec-id').on('click', function () {
        const url = $(this).data('url');
        const modalId = $(this).closest('.modal');

        deleteRiasecShowLoading();

        $.ajax({
            url: url,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'DELETE'
            },
            success: function (response) {
                swal({
                    title: "Deleted!",
                    text: response.success,
                    icon: "success",
                }).then(() => {
                    modalId.modal('hide');
                    location.reload();
                });
            },
            error: function (xhr) {
                let errorMessage = 'An error occurred:';
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        errorMessage += `\n- ${value[0]}`;
                    });
                } else {
                    errorMessage += `\n- ${xhr.responseText || 'Unknown error'}`;
                }
                swal("Error!", errorMessage, "error");
            },
            complete: function () {
                HoldOn.close();
            }
        });
    });

    function deleteRiasecShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, deleting RIASEC...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});