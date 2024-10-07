$('.addDefaultId').on('submit', function (event) {
    event.preventDefault();

    const form = $(this);
    const formData = form.serialize();
    const addDefaultIdUrl = form.data('route-add-default-id');
    addShowLoading();

    $.ajax({
        url: addDefaultIdUrl,
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function (response) {
            swal({
                title: "Success!",
                text: response.success,
                icon: "success",
            }).then(() => {
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

function addShowLoading() {
    HoldOn.open({
        theme: 'sk-circle',
        message: '<div class="loading-message">Please wait, adding ID...</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}