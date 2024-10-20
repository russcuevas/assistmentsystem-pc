document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            if (this.checked) {
                this.nextElementSibling.classList.add('checked');
            } else {
                this.nextElementSibling.classList.remove('checked');
            }
        });
    });

    const riasecSelect = document.getElementById('riasec_id');
    const optionInput = document.getElementById('option_text');

    riasecSelect.addEventListener('change', function () {
        optionInput.value = this.options[this.selectedIndex].text;
    });

    optionInput.value = riasecSelect.options[riasecSelect.selectedIndex].text;

    $('.addQuestionnaire').validate({
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

    $('form.addQuestionnaire').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);

        if (form.valid()) {
            const formData = form.serialize();
            const addQuestionnaireUrl = form.data('route-add-course');
            addQuestionnaireShowLoading();

            $.ajax({
                url: addQuestionnaireUrl,
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

    function addQuestionnaireShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, adding question...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }
});