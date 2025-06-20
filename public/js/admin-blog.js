// Admin Blog Show Page JavaScript
// Enhanced image modal functionality for admin interface

/**
 * Global variables for admin image modal
 */
let currentImageIndex = 0;
let blogImages = [];

/**
 * Initialize admin image modal functionality
 * @param {Array} images - Array of image filenames
 */
function initializeAdminImageModal(images) {
    blogImages = images || [];
}

/**
 * Open image modal with enhanced admin features
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
        if (imageCounter) imageCounter.style.display = 'block';
        if (prevBtn) prevBtn.style.display = 'block';
        if (nextBtn) nextBtn.style.display = 'block';
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
 * Auto-hide admin notifications
 */
function autoHideAdminNotifications() {
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

/**
 * Initialize admin dashboard features
 */
function initializeAdminFeatures() {
    // Auto-hide notifications
    autoHideAdminNotifications();
    
    // Enhanced image loading for admin
    const images = document.querySelectorAll('img[src*="uploads/blogs"]');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.opacity = '1';
        });
        
        img.addEventListener('error', function() {
            this.style.opacity = '0.5';
            this.alt = 'Không thể tải ảnh';
            console.warn('Failed to load image:', this.src);
        });
    });
    
    // Add loading state for forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Đang xử lý...';
            }
        });
    });
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeAdminFeatures();
});
