// Blog Show Page JavaScript
// Image modal functionality with navigation

/**
 * Global variables for image modal
 */
let currentImageIndex = 0;
let blogImages = [];

/**
 * Initialize image modal functionality
 * @param {Array} images - Array of image filenames
 */
function initializeImageModal(images) {
    blogImages = images || [];
}

/**
 * Open image modal with navigation
 * @param {string} imageSrc - Image source URL
 * @param {number} index - Image index
 */
function openImageModal(imageSrc, index) {
    const modal = document.getElementById('imageModal');
    const modalImage = document.getElementById('modalImage');
    const imageCounter = document.getElementById('imageCounter');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    
    if (!modal || !modalImage) {
        console.error('Modal elements not found');
        return;
    }
    
    currentImageIndex = index;
    modalImage.src = imageSrc;
    modal.classList.remove('hidden');
    
    // Show navigation if multiple images
    if (blogImages.length > 1) {
        if (imageCounter) imageCounter.classList.remove('hidden');
        if (prevBtn) prevBtn.classList.remove('hidden');
        if (nextBtn) nextBtn.classList.remove('hidden');
        updateImageCounter();
    }
    
    // Close modal when clicking outside the image
    modal.onclick = function(e) {
        if (e.target === modal) {
            closeImageModal();
        }
    };
    
    // Add keyboard navigation
    document.addEventListener('keydown', handleKeyPress);
    
    // Prevent body scroll when modal is open
    document.body.style.overflow = 'hidden';
}

/**
 * Close image modal
 */
function closeImageModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.classList.add('hidden');
    }
    
    // Remove keyboard event listener
    document.removeEventListener('keydown', handleKeyPress);
    
    // Restore body scroll
    document.body.style.overflow = '';
}

/**
 * Navigate to previous image
 */
function previousImage() {
    if (currentImageIndex > 0) {
        currentImageIndex--;
    } else {
        currentImageIndex = blogImages.length - 1;
    }
    updateModalImage();
}

/**
 * Navigate to next image
 */
function nextImage() {
    if (currentImageIndex < blogImages.length - 1) {
        currentImageIndex++;
    } else {
        currentImageIndex = 0;
    }
    updateModalImage();
}

/**
 * Update modal image source
 */
function updateModalImage() {
    const modalImage = document.getElementById('modalImage');
    if (modalImage && blogImages[currentImageIndex]) {
        // Construct the full URL
        const baseUrl = window.location.origin;
        const imagePath = `/uploads/blogs/${blogImages[currentImageIndex]}`;
        modalImage.src = baseUrl + imagePath;
        updateImageCounter();
    }
}

/**
 * Update image counter display
 */
function updateImageCounter() {
    const currentIndexElement = document.getElementById('currentImageIndex');
    if (currentIndexElement) {
        currentIndexElement.textContent = currentImageIndex + 1;
    }
}

/**
 * Handle keyboard navigation
 * @param {KeyboardEvent} e - Keyboard event
 */
function handleKeyPress(e) {
    switch(e.key) {
        case 'Escape':
            closeImageModal();
            break;
        case 'ArrowLeft':
            e.preventDefault();
            previousImage();
            break;
        case 'ArrowRight':
            e.preventDefault();
            nextImage();
            break;
    }
}

/**
 * Auto-hide notification messages
 */
function autoHideNotifications() {
    const notifications = document.querySelectorAll('.fixed.bottom-4');
    notifications.forEach(notification => {
        setTimeout(() => {
            if (notification && notification.parentNode) {
                notification.style.opacity = '0';
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }
        }, 3000);
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Auto-hide notifications
    autoHideNotifications();
    
    // Add smooth loading for images
    const images = document.querySelectorAll('img[src*="uploads/blogs"]');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        img.addEventListener('error', function() {
            this.style.opacity = '0.5';
            this.alt = 'Không thể tải ảnh';
        });
    });
});
