$(document).ready(function () {
    $('#printExamineesForm').on('submit', function (event) {
        event.preventDefault();

        printLoading();

        var formData = $(this).serialize();
        var printRoute = $(this).data('route-print');

        var request = new XMLHttpRequest();
        request.open("GET", `${printRoute}?${formData}`, true);

        request.responseType = "blob";

        request.onload = function () {
            HoldOn.close();

            if (request.status === 200) {
                printResponse(request);
            } else if (request.responseText) {
                alert(request.responseText);
            }
        };

        request.send();
    });
});

function printResponse(request) {
    var blob = new Blob([request.response], { type: request.getResponseHeader('Content-Type') });
    var filename = "examinees_list.pdf";
    var disposition = request.getResponseHeader('Content-Disposition');
    if (disposition && disposition.indexOf('attachment') !== -1) {
        var matches = /filename[^;=\n]*=((['"]).+?\2|([^;\n]*))/;
        var parts = matches.exec(disposition);
        if (parts && parts[3]) {
            filename = parts[3];
        }
    }

    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}


function printLoading() {
    HoldOn.open({
        theme: 'sk-circle',
        message: '<div class="loading-message">Please wait...</div>',
        backgroundColor: 'rgba(0, 0, 0, 0.7)',
        textColor: '#fff'
    });
}