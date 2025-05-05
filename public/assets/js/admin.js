// Confirm action for approving or returning bookings
document.addEventListener('DOMContentLoaded', function () {
    const confirmButtons = document.querySelectorAll('.confirm-action');

    confirmButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            const action = button.dataset.action || 'this action';
            const confirmation = confirm(`Are you sure you want to ${action}?`);
            if (!confirmation) {
                event.preventDefault(); // Prevent the form submission or link navigation
            }
        });
    });
});

// Example: Toggle sidebar (if you have a sidebar in your admin panel)
const sidebarToggle = document.getElementById('sidebarToggle');
if (sidebarToggle) {
    sidebarToggle.addEventListener('click', function () {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('collapsed');
    });
}

// Example: Flash message auto-dismiss
const flashMessage = document.querySelector('.alert-success');
if (flashMessage) {
    setTimeout(() => {
        flashMessage.style.display = 'none';
    }, 5000); // Hide after 5 seconds
}