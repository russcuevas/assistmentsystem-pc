$(document).ready(function () {
    $('.updateQuestionnaire').validate({
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
            question_text: {
                required: true,
                minlength: 3
            },
            riasec_id: {
                required: true
            }
        },
        messages: {
            question_text: {
                required: "Question text is required.",
                minlength: "Question text must be at least 3 characters."
            },
            riasec_id: {
                required: "Please select a Riasec."
            }
        }
    });

    $('form.updateQuestionnaire').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);

        if (form.valid()) {
            const formData = form.serialize();
            const updateQuestionnaireUrl = form.data('route-update-course');
            updateQuestionnaireShowLoading();

            $.ajax({
                url: updateQuestionnaireUrl,
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

                    $('#error-question').text('');

                    if (errors) {
                        $.each(errors, function (key, value) {
                            if (key === 'question_text') {
                                $('#error-question').text(value[0]);
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

    $('input[name="question_text"]').on('input', function () {
        $('#error-question').text('');
    });

    function updateQuestionnaireShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, updating question...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});