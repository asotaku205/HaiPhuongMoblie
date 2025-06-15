document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo tất cả các slider trên trang
    initializeAllSliders();
    
    // Xử lý responsive cho tất cả các slider
    window.addEventListener('resize', function() {
        initializeAllSliders();
    });
    
    function initializeAllSliders() {
        // Tìm tất cả các section chứa slider
        const sliderSections = document.querySelectorAll('section.relative.overflow-hidden');
        
        sliderSections.forEach(function(section, index) {
            const slider = section.querySelector('.slider');
            const prevBtn = section.querySelector('.prev-btn');
            const nextBtn = section.querySelector('.next-btn');
            
            if (slider && prevBtn && nextBtn) {
                // Hiển thị nút điều hướng ngay từ đầu
                prevBtn.classList.remove('hidden');
                nextBtn.classList.remove('hidden');
                
                initializeSlider(slider, prevBtn, nextBtn, index);
            }
        });
    }
    
    function initializeSlider(slider, prevBtn, nextBtn, index) {
        // Thiết lập các biến cho slider
        let currentPosition = 0;
        const itemWidth = 320; // Độ rộng của mỗi item
        const sliderWidth = slider.offsetWidth;
        const itemsPerView = Math.floor(sliderWidth / itemWidth); // Số items hiển thị cùng lúc
        const maxPosition = Math.max(0, (slider.children.length - itemsPerView) * itemWidth);
        
        // Hàm cập nhật vị trí slider
        function updateSliderPosition() {
            slider.style.transform = `translateX(-${currentPosition}px)`;
            
            // Chỉ ẩn nút khi đến giới hạn, không ẩn mặc định
            if (currentPosition === 0) {
                prevBtn.classList.add('opacity-50', 'cursor-not-allowed');
                prevBtn.classList.remove('opacity-100', 'cursor-pointer');
            } else {
                prevBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                prevBtn.classList.add('opacity-100', 'cursor-pointer');
            }
            
            if (currentPosition >= maxPosition) {
                nextBtn.classList.add('opacity-50', 'cursor-not-allowed');
                nextBtn.classList.remove('opacity-100', 'cursor-pointer');
            } else {
                nextBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                nextBtn.classList.add('opacity-100', 'cursor-pointer');
            }
        }
        
        // Xóa event listeners cũ (nếu có) để tránh trùng lặp
        const newPrevBtn = prevBtn.cloneNode(true);
        const newNextBtn = nextBtn.cloneNode(true);
        prevBtn.parentNode.replaceChild(newPrevBtn, prevBtn);
        nextBtn.parentNode.replaceChild(newNextBtn, nextBtn);
        
        // Thêm event listeners mới
        newPrevBtn.addEventListener('click', function() {
            if (currentPosition > 0) {
                currentPosition = Math.max(currentPosition - itemWidth, 0);
                updateSliderPosition();
            }
        });
        
        newNextBtn.addEventListener('click', function() {
            if (currentPosition < maxPosition) {
                currentPosition = Math.min(currentPosition + itemWidth, maxPosition);
                updateSliderPosition();
            }
        });
        
        // Cập nhật trạng thái ban đầu của các nút
        updateSliderPosition();
    }
}); 