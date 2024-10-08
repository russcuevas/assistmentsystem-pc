$(document).ready(function() {
    $('.addAdminForm').validate({
        highlight: function(input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function(input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function(error, element) {
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
                required: true,
                minlength: 6
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
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
                required: "Password is required.",
                minlength: "Password must be at least 6 characters."
            },
            password_confirmation: {
                required: "Please confirm your password.",
                equalTo: "Passwords do not match."
            }
        }
    });
    

    $('form.addAdminForm').on('submit', function(event) {
        event.preventDefault();
        const form = $(this);
        $('#error-email').text('');
    
        if (form.valid()) {
            const formData = new FormData(this);
            const addAdminUrl = form.data('route-add-admin');
            addAdminShowLoading();
    
            $.ajax({
                url: addAdminUrl,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    swal({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    const errors = xhr.responseJSON.errors;
                    let errorMessage = 'An error occurred:';
                    
                    if (errors) {
                        $.each(errors, function(key, value) {
                            if (key === 'email') {
                                $('#error-email').text(value[0]);
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
    
    function addAdminShowLoading() {
        HoldOn.open({
            theme: 'sk-circle',
            message: '<div class="loading-message">Please wait, adding admin...</div>',
            backgroundColor: 'rgba(0, 0, 0, 0.7)',
            textColor: '#fff'
        });
    }

    // DYNAMIC PROFILE PICTURE
    document.getElementById('profile_picture').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('profile-preview');
        const noImage = document.getElementById('no-image');

        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                noImage.style.display = 'none';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
            preview.style.display = 'none';
            noImage.style.display = 'block';
        }
    });
});
