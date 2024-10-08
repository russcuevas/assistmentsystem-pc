$(document).ready(function () {
    $('.editAdminForm').validate({
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
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            password: {
                minlength: 6
            }
        },
        messages: {
            fullname: {
                required: "Fullname is required.",
                minlength: "Fullname must be at least 3 characters."
            },
            email: {
                required: "Email is required.",
                email: "Please enter a valid email address."
            },
            password: {
                minlength: "Password must be at least 6 characters."
            }
        }
    });

    $('form.editAdminForm').on('submit', function (event) {
        event.preventDefault();
        const form = $(this);
        const adminId = form.data('admin-id');
        $('#error-edit-email' + adminId).text('');
        $('.error-message').text('');

        if (form.valid()) {
            const formData = new FormData(this);
            const editAdminUrl = form.data('route-edit-admin');
            editAdminShowLoading();

            $.ajax({
                url: editAdminUrl,
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
                            if (key === 'email') {
                                $('#error-edit-email' + adminId).text(value[0]);
                                HoldOn.close();
                            } else {
                                errorMessage += `\n- ${value[0]}`;
                            }
                        });
                    }

                    if (errorMessage !== 'An error occurred:') {
                        swal("Error!", errorMessage, "error");
                    }
                },
            });
        }
    });

    function editAdminShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, updating admin...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }

    function previewImage(event) {
        const preview = document.getElementById('edit_profile_preview');
        const noImage = document.getElementById('no-image');

        if (event.target.files && event.target.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                noImage.style.display = 'none';
            }

            reader.readAsDataURL(event.target.files[0]);
        } else {
            preview.src = '{{ asset("storage/" . $admin->profile_picture) }}';
            noImage.style.display = 'none';
        }
    }
    window.previewImage = previewImage;

    $(document).on('input', 'input[name="email"]', function () {
        const adminId = $(this).closest('form').data('admin-id');
        $('#error-edit-email' + adminId).text('');
    });
});
