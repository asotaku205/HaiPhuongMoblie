document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('iphone-slider');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    let currentPosition = 0;
    const itemWidth = 320; // Độ rộng của mỗi item
    const itemsPerView = Math.floor(slider.offsetWidth / itemWidth); // Số items hiển thị cùng lúc
    const maxPosition = (slider.children.length - itemsPerView) * itemWidth;

    function updateSliderPosition() {
        slider.style.transform = `translateX(-${currentPosition}px)`;
        
        // Hiển thị/ẩn nút điều hướng
        prevBtn.classList.toggle('hidden', currentPosition === 0);
        nextBtn.classList.toggle('hidden', currentPosition >= maxPosition);
    }

    prevBtn.addEventListener('click', () => {
        currentPosition = Math.max(currentPosition - itemWidth, 0);
        updateSliderPosition();
    });

    nextBtn.addEventListener('click', () => {
        currentPosition = Math.min(currentPosition + itemWidth, maxPosition);
        updateSliderPosition();
    });

    // Cập nhật trạng thái ban đầu của các nút
    updateSliderPosition();

    // Xử lý responsive
    window.addEventListener('resize', () => {
        const newItemsPerView = Math.floor(slider.offsetWidth / itemWidth);
        const newMaxPosition = (slider.children.length - newItemsPerView) * itemWidth;
        currentPosition = Math.min(currentPosition, newMaxPosition);
        updateSliderPosition();
    });
}); 