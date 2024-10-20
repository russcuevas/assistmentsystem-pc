$(document).ready(function () {
    $.validator.addMethod("riasecInitial", function (value, element) {
        return this.optional(element) || /^[RIASEC]$/.test(value);
    }, "Only R, I, A, S, E, C initials are allowed.");

    $('.editRiasec').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            let errorArea = $(element).parents('.form-group').find('.error-message');
            if (errorArea.length) {
                errorArea.text(error.text());
            } else {
                $(element).parents('.form-group').append(`<div class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;">${error.text()}</div>`);
            }
        },
        rules: {
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

    $('form.editRiasec').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);
        const careerNames = form.find('input[name="career_name[]"]');
        let allValid = true;

        careerNames.each(function () {
            const value = $(this).val().trim();
            console.log("Career name value:", value);
            if (!value) {
                allValid = false;
                $(this).closest('.form-group').find('.error-message').remove();
                $(this).closest('.form-group').append(`<div class="error-message" style="font-size:12px; margin-top:5px; font-weight:900; color: red;">This field is required.</div>`);
            }
        });

        console.log("All valid:", allValid);
        if (allValid && form.valid()) {
            console.log("Form is valid, proceeding with submission...");

            const formData = form.serialize();
            const updateRiasecUrl = form.data('route-update-riasec');
            updateRiasecShowLoading();

            $.ajax({
                url: updateRiasecUrl,
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
                            if (key === 'riasec_name') {
                                $('#error-riasec').text(value[0]);
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
        } else {
            console.log("Form validation failed");
        }
    });


    $('input[name="riasec_name"], textarea[name="description"], input[name="career_name[]"]').on('input', function () {
        $(this).parents('.form-group').find('.error-message').remove();
        $('#error-riasec').text('');
    });

    function updateRiasecShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, updating RIASEC...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});