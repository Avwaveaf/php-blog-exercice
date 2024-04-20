// Get a reference to the user menu button
const userMenuButton = document.getElementById('user-menu-button');

// Get a reference to the user menu dropdown
const userMenuDropdown = document.getElementById('user-menu-dropdown');

// Function to show the user menu dropdown
function showUserMenu() {
    userMenuDropdown.classList.add('block');
    userMenuDropdown.classList.remove('hidden');
}

// Function to hide the user menu dropdown
function hideUserMenu() {
    userMenuDropdown.classList.remove('block');
    userMenuDropdown.classList.add('hidden');
}

// Toggle the user menu dropdown visibility when the user menu button is clicked
userMenuButton.addEventListener('click', function () {
    if (userMenuDropdown.classList.contains('block')) {
        hideUserMenu();
    } else {
        showUserMenu();
    }
});

// Hide the user menu dropdown when clicking outside of it
document.addEventListener('click', function (event) {
    if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
        hideUserMenu();
    }
});
