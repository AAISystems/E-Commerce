// cProduct.js

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('productForm');

    form.addEventListener('submit', function(event) {
        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const priceInput = document.getElementById('price');
        const stockInput = document.getElementById('stock');
        const imagesInput = document.getElementById('images');
        const categoriesInput = document.getElementById('categories'); // Nuevo


        let isValid = true;

        if (!nameInput.value.trim()) {
            isValid = false;
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
        }

        if (!descriptionInput.value.trim()) {
            isValid = false;
            descriptionInput.classList.add('is-invalid');
        } else {
            descriptionInput.classList.remove('is-invalid');
        }

        if (!priceInput.value.trim() || isNaN(parseFloat(priceInput.value.trim())) || parseFloat(priceInput.value.trim()) < 0) {
            isValid = false;
            priceInput.classList.add('is-invalid');
        } else {
            priceInput.classList.remove('is-invalid');
        }

        if (!stockInput.value.trim() || isNaN(parseInt(stockInput.value.trim())) || parseInt(stockInput.value.trim()) < 0) {
            isValid = false;
            stockInput.classList.add('is-invalid');
        } else {
            stockInput.classList.remove('is-invalid');
        }

        if (imagesInput.files.length === 0) {
            isValid = false;
            imagesInput.classList.add('is-invalid');
        } else {
            imagesInput.classList.remove('is-invalid');
        }

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }

       // Validación de categorías
       if (categoriesInput.selectedOptions.length === 0) { // Verifica si no se ha seleccionado ninguna opción
        isValid = false;
        categoriesInput.classList.add('is-invalid');
    } else {
        categoriesInput.classList.remove('is-invalid');
    }

    if (!isValid) {
        event.preventDefault();
        event.stopPropagation();
    }

    form.classList.add('was-validated');
});
});