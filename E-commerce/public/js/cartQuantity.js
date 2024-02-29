"use strict";

function add(productId, productPrice) {
    let quantityElement = document.getElementById('quantity_' + productId);
    let showQuantityElement = document.getElementById('showQuantity_' + productId);
    let totalElement = document.getElementById('total');

    let quantity = Number(quantityElement.value);
    quantity += 1;
    quantityElement.value = quantity;
    showQuantityElement.textContent = "x" + quantity;

    if (totalElement) {
        let currentTotal = parseFloat(totalElement.innerText.trim());

        if (!isNaN(currentTotal)) {
            let newTotal = currentTotal + productPrice;
            totalElement.innerText = newTotal.toFixed(2);
        } else {
            console.error('El contenido de totalElement no es un número válido. Contenido:', totalElement.innerText);
        }
    }
}

function subtract(productId, productPrice) {
    let quantityElement = document.getElementById('quantity_' + productId);
    let showQuantityElement = document.getElementById('showQuantity_' + productId);
    let totalElement = document.getElementById('total');

    let quantity = Number(quantityElement.value);

    if (quantity > 1) {
        quantity -= 1;
        quantityElement.value = quantity;
        showQuantityElement.textContent = "x" + quantity;

        if (totalElement) {
            let currentTotal = parseFloat(totalElement.innerText.trim());

            if (!isNaN(currentTotal)) {
                let newTotal = currentTotal - productPrice;
                totalElement.innerText = newTotal.toFixed(2);
            } else {
                console.error('El contenido de totalElement no es un número válido. Contenido:', totalElement.innerText);
            }
        }
    }
}
