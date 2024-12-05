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
        // We no longer need the 'count' field, so we remove validation for it.
        fullname: {
            required: true
        },
        gender: {
            required: true
        },
        age: {
            required: true,
            min: 1
        },
        birthday: {
            required: true
        },
        strand: {
            required: true
        },
        email: {
            required: true,
            email: true
        }
    },
    messages: {
        fullname: {
            required: "Please enter the full name."
        },
        gender: {
            required: "Please select the gender."
        },
        age: {
            required: "Please enter the age.",
            min: "Please enter a value greater than or equal to 1."
        },
        birthday: {
            required: "Please select the birthday."
        },
        strand: {
            required: "Please enter the strand."
        },
        email: {
            required: "Please enter the email address.",
            email: "Please enter a valid email address."
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
        message: '<div class="loading-message">Please wait, adding examiner...</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}
