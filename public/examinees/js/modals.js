document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('customModal').style.display = 'flex';
});

function closeModal() {
    document.getElementById('customModal').style.display = 'none';
}

window.onclick = function (event) {
    if (event.target == document.getElementById('customModal')) {
        closeModal();
    }
}