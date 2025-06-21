/**
 * Admin Sidebar Dropdown Menu
 * Xử lý chức năng mở/đóng các menu dropdown trong sidebar admin
 */

document.addEventListener('DOMContentLoaded', function() {
    // Lấy tất cả các nút dropdown trong sidebar
    const dropdownButtons = document.querySelectorAll('.sidebar-dropdown-button');
    
    // Thêm sự kiện click cho mỗi nút
    dropdownButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Tìm menu dropdown liên quan (phần tử kế tiếp sau nút)
            const dropdownContent = this.nextElementSibling;
            
            // Toggle class để hiển thị/ẩn dropdown
            dropdownContent.classList.toggle('hidden');
            
            // Xoay biểu tượng mũi tên
            const arrow = this.querySelector('.fa-chevron-down');
            if (arrow) {
                arrow.classList.toggle('rotate-180');
            }
        });
    });
    
    // Hiển thị dropdown hiện tại nếu menu con đang active
    dropdownButtons.forEach(button => {
        const dropdownContent = button.nextElementSibling;
        const hasActiveChild = dropdownContent.querySelector('.bg-gray-700.text-white');
        
        if (hasActiveChild) {
            dropdownContent.classList.remove('hidden');
            const arrow = button.querySelector('.fa-chevron-down');
            if (arrow) {
                arrow.classList.add('rotate-180');
            }
        }
    });

    // Mobile sidebar functionality
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const sidebarOverlay = document.getElementById('mobile-sidebar-overlay');
    const closeSidebar = document.getElementById('close-sidebar');

    // Hàm mở sidebar mobile
    function openMobileSidebar() {
        mobileSidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('opacity-0', 'pointer-events-none');
    }

    // Hàm đóng sidebar mobile
    function closeMobileSidebar() {
        mobileSidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('opacity-0', 'pointer-events-none');
    }

    // Sự kiện click nút menu mobile
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', openMobileSidebar);
    }

    // Sự kiện click nút đóng sidebar
    if (closeSidebar) {
        closeSidebar.addEventListener('click', closeMobileSidebar);
    }

    // Sự kiện click overlay để đóng sidebar
    if (sidebarOverlay) {
        sidebarOverlay.addEventListener('click', closeMobileSidebar);
    }

    // Đóng sidebar khi resize window về desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            closeMobileSidebar();
        }
    });
});