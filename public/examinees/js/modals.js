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

document.addEventListener("DOMContentLoaded", function () {
    const changePasswordButton = document.querySelector('.btn-secondary.waves-effect');
    const changePasswordModal = document.getElementById('changePasswordModal');

    changePasswordButton.addEventListener('click', function () {
        changePasswordModal.style.display = 'flex';
    });

    function closeChangePasswordModal() {
        changePasswordModal.style.display = 'none';
    }

    window.onclick = function (event) {
        if (event.target === changePasswordModal) {
            closeChangePasswordModal();
        }
    };

    window.closeChangePasswordModal = closeChangePasswordModal; // Expose to global scope
});
