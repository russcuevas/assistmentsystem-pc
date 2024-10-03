
$('.changePasswordForm').on('submit', function (e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');
    var formData = new FormData(form[0]);
    formData.append('_method', 'POST');

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
            $('.changePasswordForm')[0].reset();
        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors || {};
            $.each(errors, function (key, value) {
                $('#error-' + key).html(value[0]);
            });
        }
    });
});
