$(document).ready(function () {
    $('.addCourse').validate({
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
            course_name: {
                required: true,
                minlength: 3
            },
            course_description: {
                required: true
            }
        },
        messages: {
            course_name: {
                required: "Course name is required.",
                minlength: "Course name must be at least 3 characters."
            },
            course_description: {
                required: "Course description is required."
            }
        }
    });

    $('form.addCourse').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);

        if (form.valid()) {
            const formData = form.serialize();
            const addCourseUrl = form.data('route-add-course');
            addCourseShowLoading();

            $.ajax({
                url: addCourseUrl,
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

                    // Clear previous error messages
                    $('#error-course').text('');

                    if (errors) {
                        $.each(errors, function (key, value) {
                            if (key === 'course_name') {
                                $('#error-course').text(value[0]);
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

    $('input[name="course_name"]').on('input', function () {
        $('#error-course').text('');
    });

    function addCourseShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, adding course...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});
