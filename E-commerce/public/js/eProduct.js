"use strict";

document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form.needs-validation');
    const productCategoriesSelect = document.getElementById('product-categories');
    const availableCategoriesSelect = document.getElementById('available-categories');
    const removeCategoryButton = document.getElementById('remove-category');

    // Manejo del evento submit del formulario
    form.addEventListener('submit', function (event) {
        const nameInput = document.querySelector('input[name="name"]');
        const descriptionInput = document.querySelector('input[name="description"]');
        const priceInput = document.querySelector('input[name="price"]');
        const stockInput = document.querySelector('input[name="stock"]');
        const categoriesSelect = document.getElementById('categories');

        const nameValue = nameInput.value.trim();
        const descriptionValue = descriptionInput.value.trim();
        const priceValue = priceInput.value.trim();
        const stockValue = stockInput.value.trim();
        const selectedCategories = Array.from(categoriesSelect.selectedOptions).map(option => option.value);

        let isValid = true;

        if (!nameValue) {
            isValid = false;
            nameInput.classList.add('is-invalid');
        } else {
            nameInput.classList.remove('is-invalid');
        }

        if (!descriptionValue) {
            isValid = false;
            descriptionInput.classList.add('is-invalid');
        } else {
            descriptionInput.classList.remove('is-invalid');
        }

        if (!priceValue || isNaN(parseFloat(priceValue)) || parseFloat(priceValue) < 0) {
            isValid = false;
            priceInput.classList.add('is-invalid');
        } else {
            priceInput.classList.remove('is-invalid');
        }

        if (!stockValue || isNaN(parseInt(stockValue)) || parseInt(stockValue) < 0) {
            isValid = false;
            stockInput.classList.add('is-invalid');
        } else {
            stockInput.classList.remove('is-invalid');
        }

        if (selectedCategories.length === 0) {
            isValid = false;
            categoriesSelect.classList.add('is-invalid');
        } else {
            categoriesSelect.classList.remove('is-invalid');
        }

        if (!isValid) {
            event.preventDefault();
            event.stopPropagation();
        }

        form.classList.add('was-validated');
    });

    // Manejo del evento click del botón de eliminar categoría
    removeCategoryButton.addEventListener('click', function () {
        const selectedOptions = productCategoriesSelect.selectedOptions;
        for (let i = 0; i < selectedOptions.length; i++) {
            const option = selectedOptions[i];
            option.remove();
        }
    });
});
