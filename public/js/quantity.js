function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const formQuantity = document.getElementById('form-quantity');
    const currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
        formQuantity.value = currentValue - 1;
    }
}

function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    const formQuantity = document.getElementById('form-quantity');
    const currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
    formQuantity.value = currentValue + 1;
}

document.getElementById('quantity').addEventListener('change', function() {
    document.getElementById('form-quantity').value = this.value;
});