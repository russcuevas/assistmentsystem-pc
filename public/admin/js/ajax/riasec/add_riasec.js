$(document).ready(function () {
    $.validator.addMethod("riasecInitial", function (value, element) {
        return this.optional(element) || /^[RIASEC]$/.test(value);
    }, "Only R, I, A, S, E, C initials are allowed.");

    $('.addRiasec').validate({
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
            riasec_id: {
                required: true,
                maxlength: 1,
                riasecInitial: true
            },
            riasec_name: {
                required: true,
                minlength: 3
            },
            description: {
                required: true
            },
            'career_name[]': {
                required: true
            }
        },
        messages: {
            riasec_id: {
                required: "Initial is required.",
                maxlength: "Initial must be 1 character long.",
                riasecInitial: "Only R, I, A, S, E, C initials are allowed."
            },
            riasec_name: {
                required: "RIASEC name is required.",
                minlength: "RIASEC name must be at least 3 characters."
            },
            description: {
                required: "Description is required."
            },
            'career_name[]': {
                required: "This field is required."
            }
        }
    });

    $('form.addRiasec').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);

        if (form.valid()) {
            const formData = form.serialize();
            const addRiasecUrl = form.data('route-add-riasec');
            addRiasecShowLoading();

            $.ajax({
                url: addRiasecUrl,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function (response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'An error occurred:';
                    $('#error-riasec').text('');

                    if (errors) {
                        $.each(errors, function (key, value) {
                            if (key === 'riasec_id') {
                                $('#error-riasec').text(value[0]);
                                HoldOn.close();
                            } else {
                                errorMessage += `\n- ${value[0]}`;
                            }
                        });
                    }

                    if (errorMessage !== 'An error occurred:') {
                        swal("Error!", errorMessage, "error");
                    }
                }
            });
        }
    });

    $('input[name="riasec_id"], input[name="riasec_name"], textarea[name="description"], input[name="career_name[]"]').on('input', function () {
        $('#error-riasec').text('');
    });

    function addRiasecShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, adding RIASEC...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});