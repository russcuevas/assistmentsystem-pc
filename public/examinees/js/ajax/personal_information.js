$(document).ready(function () {
    $('.form-validation').validate({
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
            fullname: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            birthday: {
                required: true,
                date: true
            },
            age: {
                required: true,
                maxlength: 3
            },
            strand: {
                required: true,
                maxlength: 255
            },
            course_1: {
                required: true
            },
            course_2: {
                required: true
            },
            course_3: {
                required: true
            }
        },
        messages: {
            fullname: {
                required: "Fullname is required.",
                maxlength: "Fullname must not exceed 255 characters."
            },
            email: {
                required: "Email is required.",
                email: "Please enter a valid email address.",
                maxlength: "Email must not exceed 255 characters."
            },
            birthday: {
                required: "Birthday is required.",
                date: "Please enter a valid date."
            },
            age: {
                required: "Age is required.",
                maxlength: "Age must not exceed 3 characters."
            },
            strand: {
                required: "Strand is required.",
                maxlength: "Strand must not exceed 255 characters."
            },
            course_1: {
                required: "Please select Course 1."
            },
            course_2: {
                required: "Please select Course 2."
            },
            course_3: {
                required: "Please select Course 3."
            }
        }
    });

    $('.form-validation').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);

        if (form.valid()) {
            const formData = form.serialize();
            const addInformationUrl = form.data('route-add-information');
            addInformationShowLoading();

            $.ajax({
                url: addInformationUrl,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                success: function (response) {
                    swal({
                        title: "Submit and take assessment?",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((willRedirect) => {
                        HoldOn.close();
                        if (willRedirect) {
                            window.location.href = response.redirect;
                        }
                    });
                },
                error: function (xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'An error occurred:';
                    $('.form-group .error').remove();

                    if (errors) {
                        $.each(errors, function (key, value) {
                            errorMessage += `\n- ${value[0]}`;
                            const inputElement = $('[name="' + key + '"]');
                            if (inputElement.length) {
                                HoldOn.close();
                                inputElement.parents('.form-group').append('<div class="error-message">' + value[0] + '</div>');
                            }
                        });
                    }
                }
            });
        }
    });

    function addInformationShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, submitting...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});