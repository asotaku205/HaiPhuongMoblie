/**
 * Admin Dashboard Chart JavaScript
 * Xử lý biểu đồ doanh thu trong trang dashboard admin
 */

// Biến global để lưu instance của chart
let revenueChart = null;

/**
 * Khởi tạo biểu đồ doanh thu
 * @param {Array} chartData - Dữ liệu biểu đồ từ server
 */
function initRevenueChart(chartData) {
    const ctx = document.getElementById('revenueChart');
    if (!ctx) {
        console.warn('Revenue chart canvas not found');
        return;
    }

    // Hủy chart cũ nếu có
    if (revenueChart) {
        revenueChart.destroy();
    }

    // Tạo biểu đồ mới
    revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartData.map(item => {
                const date = new Date(item.date);
                return date.toLocaleDateString('vi-VN', { 
                    month: 'short', 
                    day: 'numeric' 
                });
            }),
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: chartData.map(item => item.revenue),
                borderColor: 'rgb(59, 130, 246)',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgb(59, 130, 246)',
                pointBorderColor: '#fff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    borderColor: 'rgb(59, 130, 246)',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return 'Doanh thu: ' + formatCurrency(context.parsed.y);
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return formatCurrency(value);
                        },
                        color: '#6b7280'
                    },
                    grid: {
                        color: 'rgba(0, 0, 0, 0.1)',
                        drawBorder: false
                    }
                },
                x: {
                    ticks: {
                        color: '#6b7280'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            elements: {
                point: {
                    radius: 4,
                    hoverRadius: 6
                }
            },
            interaction: {
                intersect: false,
                mode: 'index'
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
}

/**
 * Format số tiền theo định dạng VND
 * @param {number} amount - Số tiền cần format
 * @returns {string} - Chuỗi đã format
 */
function formatCurrency(amount) {
    if (amount === 0) return '0đ';
    
    // Sử dụng Intl.NumberFormat để format số
    return new Intl.NumberFormat('vi-VN', {
        style: 'decimal',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(amount) + 'đ';
}

/**
 * Cập nhật dữ liệu biểu đồ
 * @param {Array} newData - Dữ liệu mới
 */
function updateRevenueChart(newData) {
    if (!revenueChart) {
        initRevenueChart(newData);
        return;
    }

    // Cập nhật labels
    revenueChart.data.labels = newData.map(item => {
        const date = new Date(item.date);
        return date.toLocaleDateString('vi-VN', { 
            month: 'short', 
            day: 'numeric' 
        });
    });

    // Cập nhật data
    revenueChart.data.datasets[0].data = newData.map(item => item.revenue);

    // Render lại chart
    revenueChart.update('active');
}

/**
 * Thêm hiệu ứng loading cho chart
 */
function showChartLoading() {
    const chartContainer = document.querySelector('#revenueChart').parentElement;
    const loadingDiv = document.createElement('div');
    loadingDiv.id = 'chart-loading';
    loadingDiv.className = 'absolute inset-0 flex items-center justify-center bg-white bg-opacity-75';
    loadingDiv.innerHTML = `
        <div class="text-center">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-2 text-sm text-gray-600">Đang tải dữ liệu...</p>
        </div>
    `;
    
    chartContainer.style.position = 'relative';
    chartContainer.appendChild(loadingDiv);
}

/**
 * Ẩn hiệu ứng loading
 */
function hideChartLoading() {
    const loadingDiv = document.getElementById('chart-loading');
    if (loadingDiv) {
        loadingDiv.remove();
    }
}

/**
 * Xử lý lỗi khi load chart
 * @param {string} errorMessage - Thông báo lỗi
 */
function handleChartError(errorMessage = 'Không thể tải dữ liệu biểu đồ') {
    hideChartLoading();
    
    const chartContainer = document.querySelector('#revenueChart').parentElement;
    const errorDiv = document.createElement('div');
    errorDiv.className = 'flex items-center justify-center h-64 text-center text-gray-500';
    errorDiv.innerHTML = `
        <div>
            <i class="fas fa-exclamation-triangle text-3xl mb-2"></i>
            <p>${errorMessage}</p>
            <button onclick="retryLoadChart()" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700">
                Thử lại
            </button>
        </div>
    `;
    
    // Ẩn canvas và hiển thị error
    document.getElementById('revenueChart').style.display = 'none';
    chartContainer.appendChild(errorDiv);
}

/**
 * Thử load lại chart
 */
function retryLoadChart() {
    // Xóa error message
    const errorDiv = document.querySelector('#revenueChart').parentElement.querySelector('.flex.items-center.justify-center');
    if (errorDiv) {
        errorDiv.remove();
    }
    
    // Hiển thị lại canvas
    document.getElementById('revenueChart').style.display = 'block';
    
    // Load lại chart với dữ liệu từ window object
    if (window.revenueChartData) {
        initRevenueChart(window.revenueChartData);
    }
}

// Export functions để có thể sử dụng từ file khác
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initRevenueChart,
        updateRevenueChart,
        formatCurrency,
        showChartLoading,
        hideChartLoading,
        handleChartError
    };
}
