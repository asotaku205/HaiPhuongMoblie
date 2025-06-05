// Đơn giản hóa menu user dropdown
document.getElementById('user-menu-button')?.addEventListener('click', function () {
    const dropdown = this.nextElementSibling;
    dropdown.classList.toggle('hidden');
});

// Đóng dropdown khi click bên ngoài
window.addEventListener('click', function (e) {
    if (!document.getElementById('user-menu-button')?.contains(e.target)) {
        const dropdown = document.getElementById('user-menu-button')?.nextElementSibling;
        dropdown?.classList.add('hidden');
    }
});