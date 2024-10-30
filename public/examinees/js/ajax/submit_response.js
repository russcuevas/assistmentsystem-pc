$(document).ready(function () {
    $('#submit-response').on('submit', function (event) {
        event.preventDefault();

        const form = $(this);
        const formData = form.serialize();
        const submitUrl = form.data('route-submit');

        swal({
            title: "Are you sure?",
            text: "Do you really want to submit your responses?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willSubmit) => {
            if (willSubmit) {
                submitResponseShowLoading();

                $.ajax({
                    url: submitUrl,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    success: function (response) {
                        HoldOn.close();
                        swal({
                            title: "Success!",
                            text: response.message || "Submitted successfully.",
                            icon: "success",
                        }).then(() => {
                            window.location.href = response.redirect;
                        });
                    },
                    error: function (xhr) {
                        HoldOn.close();
                        const errors = xhr.responseJSON.errors;
                        let errorMessage = 'An error occurred:';

                        if (errors) {
                            $.each(errors, function (key, value) {
                                errorMessage += `\n- ${value[0]}`;
                            });
                        }
                        swal("Error!", errorMessage, "error");
                    }
                });
            }
        });
    });
});

function submitResponseShowLoading() {
    HoldOn.open({
        theme: 'sk-circle',
        message: '<div class="loading-message">Please wait, calculating the results.....</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}