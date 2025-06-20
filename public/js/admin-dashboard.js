/**
 * Admin Dashboard JavaScript
 * Xử lý tương tác và các tính năng khác trong dashboard admin
 */

document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo các tính năng dashboard
    initDashboardFeatures();
    
    // Cập nhật thời gian thực
    updateCurrentTime();
    setInterval(updateCurrentTime, 60000); // Cập nhật mỗi phút
    
    // Khởi tạo số liệu với hiệu ứng đếm
    animateCounters();
});

/**
 * Khởi tạo các tính năng dashboard
 */
function initDashboardFeatures() {
    // Thêm hiệu ứng hover cho các card thống kê
    initStatCardEffects();
    
    // Khởi tạo tooltip cho các element cần thiết
    initTooltips();
    
    // Thiết lập auto-refresh cho dashboard (mỗi 5 phút)
    setInterval(refreshDashboardData, 300000);
}

/**
 * Thêm hiệu ứng cho các card thống kê
 */
function initStatCardEffects() {
    const statCards = document.querySelectorAll('.stat-card');
    
    statCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.classList.add('transform', 'scale-105', 'transition-transform', 'duration-200');
            this.style.boxShadow = '0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.classList.remove('transform', 'scale-105');
            this.style.boxShadow = '';
        });
    });
}

/**
 * Khởi tạo tooltips
 */
function initTooltips() {
    // Thêm tooltip cho các icon trạng thái
    const statusIcons = document.querySelectorAll('.fas');
    statusIcons.forEach(icon => {
        if (icon.parentElement.classList.contains('bg-yellow-500')) {
            icon.title = 'Đơn hàng chờ xử lý';
        } else if (icon.parentElement.classList.contains('bg-blue-500')) {
            icon.title = 'Đơn hàng đang giao';
        } else if (icon.parentElement.classList.contains('bg-green-500')) {
            icon.title = 'Đơn hàng hoàn thành';
        } else if (icon.parentElement.classList.contains('bg-red-500')) {
            icon.title = 'Cảnh báo tồn kho';
        }
    });
}

/**
 * Hiệu ứng đếm số cho các thống kê
 */
function animateCounters() {
    const counters = document.querySelectorAll('.counter-animate');
    
    counters.forEach(counter => {
        const target = parseInt(counter.textContent.replace(/[^\d]/g, ''));
        if (isNaN(target)) return;
        
        const duration = 2000; // 2 giây
        const start = performance.now();
        
        function updateCounter(currentTime) {
            const elapsed = currentTime - start;
            const progress = Math.min(elapsed / duration, 1);
            
            // Sử dụng easing function
            const easeOutCubic = 1 - Math.pow(1 - progress, 3);
            const currentValue = Math.floor(target * easeOutCubic);
            
            // Format số
            if (counter.textContent.includes('đ')) {
                counter.textContent = new Intl.NumberFormat('vi-VN').format(currentValue) + 'đ';
            } else {
                counter.textContent = new Intl.NumberFormat('vi-VN').format(currentValue);
            }
            
            if (progress < 1) {
                requestAnimationFrame(updateCounter);
            }
        }
        
        // Bắt đầu từ 0
        counter.textContent = counter.textContent.includes('đ') ? '0đ' : '0';
        requestAnimationFrame(updateCounter);
    });
}

/**
 * Cập nhật thời gian hiện tại
 */
function updateCurrentTime() {
    const timeElement = document.getElementById('currentTime');
    if (timeElement) {
        const now = new Date();
        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit',
            timeZone: 'Asia/Ho_Chi_Minh'
        };
        timeElement.textContent = now.toLocaleDateString('vi-VN', options);
    }
}

/**
 * Refresh dữ liệu dashboard
 */
function refreshDashboardData() {
    console.log('Refreshing dashboard data...');
    
    // Hiển thị indicator đang refresh
    showRefreshIndicator();
    
    // Giả lập API call (có thể thay thế bằng fetch thực tế)
    setTimeout(() => {
        hideRefreshIndicator();
        console.log('Dashboard data refreshed');
    }, 2000);
}

/**
 * Hiển thị indicator đang refresh
 */
function showRefreshIndicator() {
    // Tạo indicator nếu chưa có
    let indicator = document.getElementById('refresh-indicator');
    if (!indicator) {
        indicator = document.createElement('div');
        indicator.id = 'refresh-indicator';
        indicator.className = 'fixed top-4 right-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg z-50 flex items-center';
        indicator.innerHTML = `
            <div class="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
            Đang cập nhật...
        `;
        document.body.appendChild(indicator);
    }
    
    indicator.style.display = 'flex';
}

/**
 * Ẩn indicator refresh
 */
function hideRefreshIndicator() {
    const indicator = document.getElementById('refresh-indicator');
    if (indicator) {
        indicator.style.display = 'none';
    }
}

/**
 * Format số thành chuỗi dễ đọc
 */
function formatNumber(num) {
    if (num >= 1000000000) {
        return (num / 1000000000).toFixed(1) + 'B';
    }
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M';
    }
    if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K';
    }
    return num.toString();
}

/**
 * Cập nhật một stat card cụ thể
 */
function updateStatCard(cardSelector, newValue, isAnimated = true) {
    const card = document.querySelector(cardSelector);
    if (!card) return;
    
    const valueElement = card.querySelector('.counter-animate');
    if (!valueElement) return;
    
    if (isAnimated) {
        // Thêm hiệu ứng highlight
        card.classList.add('highlight-update');
        setTimeout(() => {
            card.classList.remove('highlight-update');
        }, 1000);
    }
    
    valueElement.textContent = newValue;
}

/**
 * Hiển thị thông báo toast
 */
function showToast(message, type = 'info') {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-4 right-4 px-6 py-3 rounded-lg shadow-lg z-50 text-white transition-opacity duration-300 ${
        type === 'success' ? 'bg-green-600' : 
        type === 'error' ? 'bg-red-600' : 
        type === 'warning' ? 'bg-yellow-600' : 'bg-blue-600'
    }`;
    toast.textContent = message;
    
    document.body.appendChild(toast);
    
    // Hiển thị toast
    setTimeout(() => toast.style.opacity = '1', 100);
    
    // Tự động ẩn sau 3 giây
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => document.body.removeChild(toast), 300);
    }, 3000);
}

// Export các functions để có thể sử dụng từ bên ngoài
window.dashboardUtils = {
    updateStatCard,
    showToast,
    formatNumber,
    refreshDashboardData
};
