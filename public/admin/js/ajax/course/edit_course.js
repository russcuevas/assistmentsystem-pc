$(document).ready(function () {
    $('.updateCourse').validate({
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
                required: true,
                minlength: 5
            }
        },
        messages: {
            course_name: {
                required: "Course name is required.",
                minlength: "Course name must be at least 3 characters."
            },
            course_description: {
                required: "Course description is required.",
                minlength: "Course description must be at least 5 characters."
            }
        }
    });

    $('form.updateCourse').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);
        const courseId = form.data('course-id');
        $('#error-edit-course' + courseId).text('');

        if (form.valid()) {
            const formData = new FormData(this);  // Use FormData to include file uploads
            const updateCourseUrl = form.data('route-edit-course');
            updateCourseShowLoading();

            $.ajax({
                url: updateCourseUrl,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
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

                    if (errors) {
                        $.each(errors, function (key, value) {
                            if (key === 'course_name') {
                                $('#error-edit-course' + courseId).text(value[0]);
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
        const courseId = $(this).closest('form').data('course-id');
        $('#error-edit-course' + courseId).text('');
    });

    function updateCourseShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, updating course...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});
