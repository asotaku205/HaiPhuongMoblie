document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuIcon = document.getElementById('mobile-menu-icon');
    const submenuButtons = document.querySelectorAll('.mobile-submenu-button');

    // Toggle mobile menu
    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
        // Change hamburger to X when menu is open
        if (mobileMenu.classList.contains('hidden')) {
            mobileMenuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
        } else {
            mobileMenuIcon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
        }
    });

    // Toggle submenus
    submenuButtons.forEach(button => {
        button.addEventListener('click', function() {
            const submenu = this.nextElementSibling;
            const arrow = this.querySelector('svg');
            submenu.classList.toggle('hidden');
            arrow.style.transform = submenu.classList.contains('hidden') ? 'rotate(0deg)' : 'rotate(180deg)';
        });
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
            mobileMenu.classList.add('hidden');
            mobileMenuIcon.setAttribute('d', 'M4 6h16M4 12h16M4 18h16');
        }
    });
}); 