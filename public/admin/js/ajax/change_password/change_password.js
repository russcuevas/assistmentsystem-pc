$('.changePasswordForm').validate({
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
        password_confirmation: {
            equalTo: "[name='password']"
        }
    },
    messages: {
        password_confirmation: {
            equalTo: "Passwords do not match."
        }
    }
});

$('input[name="old_password"]').on('input', function () {
    $('#error-old_password').html('');
    $(this).parents('.form-line').removeClass('error');
});

$('.changePasswordForm').on('submit', function (e) {
    e.preventDefault();

    var form = $(this);
    if (form.valid()) {
        var url = form.attr('action');
        var formData = new FormData(form[0]);
        formData.append('_method', 'POST');
        changePassShowLoading();
        
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            processData: false,
            contentType: false,
            success: function (response) {
                $('.error-message').html('');
                swal("Success", response.success, "success");
                $('#changePasswordModal').modal('hide');
                form[0].reset();
                HoldOn.close();
            },
            error: function (xhr) {
                let errors = xhr.responseJSON.errors || {};
                $('.error-message').html('');
                $.each(errors, function (key, value) {
                    $('#error-' + key).html(value[0]);
                });
                HoldOn.close();
            }
        });
    }
});


function changePassShowLoading() {
    HoldOn.open({
        theme: 'sk-circle',
        message: '<div class="loading-message">Please wait, changing password..</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}