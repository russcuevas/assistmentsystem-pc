$('.delete-course').on('click', function () {
    const url = $(this).data('url');
    const modalId = $(this).closest('.modal');

    deleteCourseShowLoading();

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
                text: response.message,
                icon: "success",
            }).then(() => {
                modalId.modal('hide');
                location.reload();
            });
        },
        error: function (xhr) {
            const errors = xhr.responseJSON.errors;
            let errorMessage = 'An error occurred:';
            if (errors) {
                $.each(errors, function (key, value) {
                    errorMessage += `\n- ${value[0]}`;
                });
            }
            swal("Error!", errorMessage, "error");
        }
    });
});

function deleteCourseShowLoading() {
    HoldOn.open({
        theme: 'sk-circle',
        message: '<div class="loading-message">Please wait, deleting course...</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}