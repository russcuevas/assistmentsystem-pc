$(document).ready(function () {
    // Initialize validation
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

    // Handle form submission
    $('form.addCourse').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);

        // Only submit if the form is valid
        if (form.valid()) {
            const formData = new FormData(this);  // Use FormData to handle file uploads
            const addCourseUrl = form.data('route-add-course');  // Get the URL from data attribute
            addCourseShowLoading();  // Show loading spinner

            $.ajax({
                url: addCourseUrl,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Add CSRF token to headers
                },
                data: formData,
                contentType: false,  // Important for file uploads
                processData: false,  // Prevent jQuery from processing data
                success: function (response) {
                    // On success, show success message
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        location.reload();  // Reload the page after successful form submission
                    });
                },
                error: function (xhr) {
                    // Handle errors
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'An error occurred:';

                    // Clear previous error messages
                    $('#error-course').text('');

                    if (errors) {
                        $.each(errors, function (key, value) {
                            if (key === 'course_name') {
                                // Display the error next to course name field
                                $('#error-course').text(value[0]);
                                HoldOn.close();  // Close loading spinner
                            } else {
                                errorMessage += `\n- ${value[0]}`;
                            }
                        });
                    }

                    if (errorMessage !== 'An error occurred:') {
                        swal("Error!", errorMessage, "error");  // Show error message
                    }
                }
            });
        }
    });

    // Clear error message on course name input
    $('input[name="course_name"]').on('input', function () {
        $('#error-course').text('');
    });

    // Show loading spinner during form submission
    function addCourseShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, adding course...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});
