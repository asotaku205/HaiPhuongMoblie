// Blog Create Page JavaScript
// Image upload functionality with validation and preview

const MAX_FILES = 5;
const MAX_FILE_SIZE = 3 * 1024 * 1024; // 3MB

/**
 * Preview selected images with validation
 * @param {HTMLInputElement} input - File input element
 */
function previewImages(input) {
    const previewContainer = document.getElementById('imagePreview');
    const uploadStatus = document.getElementById('uploadStatus');
    const fileCount = document.getElementById('fileCount');
    const files = Array.from(input.files);

    // Validate file count
    if (files.length > MAX_FILES) {
        showAlert(`Bạn chỉ có thể tải lên tối đa ${MAX_FILES} ảnh.`, 'error');
        input.value = '';
        return;
    }

    // Validate file size and type
    const validFiles = [];
    const errors = [];

    files.forEach((file, index) => {
        if (!file.type.startsWith('image/')) {
            errors.push(`File "${file.name}" không phải là hình ảnh.`);
            return;
        }

        if (file.size > MAX_FILE_SIZE) {
            errors.push(`File "${file.name}" vượt quá 3MB.`);
            return;
        }

        validFiles.push(file);
    });

    if (errors.length > 0) {
        showAlert(errors.join('\n'), 'error');
        // Only keep valid files
        const dt = new DataTransfer();
        validFiles.forEach(file => dt.items.add(file));
        input.files = dt.files;
    }

    // Clear previous previews
    previewContainer.innerHTML = '';

    if (validFiles.length > 0) {
        previewContainer.classList.remove('hidden');
        uploadStatus.classList.remove('hidden');
        fileCount.textContent = validFiles.length;

        validFiles.forEach((file, index) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                const imageDiv = createImagePreview(e.target.result, file, index);
                previewContainer.appendChild(imageDiv);
            };

            reader.readAsDataURL(file);
        });
    } else {
        previewContainer.classList.add('hidden');
        uploadStatus.classList.add('hidden');
    }
}

/**
 * Create image preview element
 * @param {string} src - Image source
 * @param {File} file - File object
 * @param {number} index - Image index
 * @returns {HTMLElement} - Image preview element
 */
function createImagePreview(src, file, index) {
    const imageDiv = document.createElement('div');
    imageDiv.className = 'relative group';

    imageDiv.innerHTML = `
        <div class="aspect-square bg-gray-100 rounded-lg overflow-hidden">
            <img src="${src}" 
                 alt="Preview ${index + 1}" 
                 class="w-full h-full object-cover">
        </div>
        <button type="button" 
                onclick="removeImage(${index}, this)"
                class="absolute top-2 right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <div class="mt-1 text-xs text-gray-500 text-center truncate px-1">
            ${file.name}
        </div>
        <div class="text-xs text-gray-400 text-center">
            ${(file.size / 1024 / 1024).toFixed(2)} MB
        </div>
    `;

    return imageDiv;
}

/**
 * Remove image from preview and file input
 * @param {number} index - Image index to remove
 * @param {HTMLElement} button - Remove button element
 */
function removeImage(index, button) {
    const input = document.getElementById('images');
    const dt = new DataTransfer();
    const files = Array.from(input.files);

    files.forEach((file, i) => {
        if (i !== index) {
            dt.items.add(file);
        }
    });

    input.files = dt.files;
    previewImages(input);
}

// Drag and drop functionality
function dragOverHandler(event) {
    event.preventDefault();
    event.currentTarget.classList.add('border-blue-400', 'bg-blue-50');
}

function dragEnterHandler(event) {
    event.preventDefault();
}

function dragLeaveHandler(event) {
    event.preventDefault();
    event.currentTarget.classList.remove('border-blue-400', 'bg-blue-50');
}

function dropHandler(event) {
    event.preventDefault();
    const dropZone = event.currentTarget;
    dropZone.classList.remove('border-blue-400', 'bg-blue-50');

    const files = event.dataTransfer.files;
    const input = document.getElementById('images');

    if (files.length > MAX_FILES) {
        showAlert(`Bạn chỉ có thể tải lên tối đa ${MAX_FILES} ảnh.`, 'error');
        return;
    }

    input.files = files;
    previewImages(input);
}

/**
 * Show alert message
 * @param {string} message - Alert message
 * @param {string} type - Alert type (success, error, warning)
 */
function showAlert(message, type = 'info') {
    // You can customize this to show better notifications
    alert(message);
}

// Form validation before submit
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            const titleInput = document.getElementById('title');
            const contentInput = document.getElementById('content');

            if (!titleInput.value.trim()) {
                e.preventDefault();
                showAlert('Vui lòng nhập tiêu đề bài viết.', 'error');
                titleInput.focus();
                return;
            }

            if (contentInput.value.trim().length < 10) {
                e.preventDefault();
                showAlert('Nội dung phải có ít nhất 10 ký tự.', 'error');
                contentInput.focus();
                return;
            }
        });
    }
});
