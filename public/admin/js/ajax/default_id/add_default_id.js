$('.addDefaultId').validate({
    highlight: function (input) {
        $(input).parents('.form-line').addClass('error');
    },
    unhighlight: function (input) {
        $(input).parents('.form-line').removeClass('error');
    },
    errorPlacement: function (error, element) {
        $(element).parents('.form-group').append(error);
    },
    rules: {
        count: {
            required: true,
            min: 1
        }
    },
    messages: {
        count: {
            required: "Please enter the number of IDs to add",
            min: "Please enter a value greater than or equal to 1"
        }
    }
});

$('form.addDefaultId').on('submit', function (event) {
    event.preventDefault();

    const form = $(this);
    
    if (form.valid()) {
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
    }
});

function addShowLoading() {
    HoldOn.open({
        theme: 'sk-circle',
        message: '<div class="loading-message">Please wait, adding ID...</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}