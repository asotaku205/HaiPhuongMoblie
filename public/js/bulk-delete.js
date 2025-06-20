/**
 * Bulk Delete - Simple version
 */
document.addEventListener('DOMContentLoaded', function() {
    initBulkDelete();
});

function initBulkDelete() {
    const selectAll = document.getElementById('select-all');
    const itemCheckboxes = document.querySelectorAll('input[name="selected_items[]"]');
    const deleteBtn = document.getElementById('bulk-delete-btn');
    
    if (!selectAll || !deleteBtn) return;

    // Select all checkbox
    selectAll.addEventListener('change', function() {
        itemCheckboxes.forEach(cb => cb.checked = this.checked);
        updateDeleteButton();
    });

    // Individual checkboxes
    itemCheckboxes.forEach(cb => {
        cb.addEventListener('change', updateDeleteButton);
    });

    // Delete button
    deleteBtn.addEventListener('click', function() {
        const selected = getSelectedItems();
        if (selected.length === 0) {
            alert('Vui lòng chọn ít nhất một mục để xóa!');
            return;
        }
        
        if (confirm(`Bạn có chắc muốn xóa ${selected.length} mục đã chọn?`)) {
            submitBulkDelete(selected);
        }
    });
}

function getSelectedItems() {
    return Array.from(document.querySelectorAll('input[name="selected_items[]"]:checked'))
                .map(cb => cb.value);
}

function updateDeleteButton() {
    const deleteBtn = document.getElementById('bulk-delete-btn');
    const selected = getSelectedItems();
    
    if (selected.length > 0) {
        deleteBtn.disabled = false;
        deleteBtn.classList.remove('opacity-50');
        deleteBtn.textContent = `Xóa ${selected.length} mục`;
    } else {
        deleteBtn.disabled = true;
        deleteBtn.classList.add('opacity-50');
        deleteBtn.textContent = 'Xóa mục đã chọn';
    }
}

function submitBulkDelete(selectedItems) {
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = getBulkDeleteURL();
    
    // CSRF token
    const token = document.querySelector('meta[name="csrf-token"]');
    if (token) {
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = token.getAttribute('content');
        form.appendChild(csrfInput);
    }

    // Selected items
    selectedItems.forEach(item => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'selected_items[]';
        input.value = item;
        form.appendChild(input);
    });

    document.body.appendChild(form);
    form.submit();
}

function getBulkDeleteURL() {
    const path = window.location.pathname;
    if (path.includes('/product')) return '/admin/product/bulk-delete';
    if (path.includes('/category')) return '/admin/category/bulk-delete';
    if (path.includes('/user')) return '/admin/user/bulk-delete';
    return '/admin/bulk-delete';
}
