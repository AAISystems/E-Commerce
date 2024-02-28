"use strict";

let delivery = document.getElementById('delivery');
let newAddressBtn = document.getElementById('newAddressBtn');
let registeredBtn = document.getElementById('registeredBtn');

let registeredAddressesContent = document.getElementById('registeredAddresses').outerHTML;
let newAddressContent = document.getElementById('newAddress').outerHTML;

delivery.classList.add('d-none');

function newAddress() {
    delivery.classList.remove('d-none');
    // Muestra la sección de nueva dirección
    delivery.innerHTML = newAddressContent;

    // Actualiza las clases de los botones
    newAddressBtn.classList.remove('btn-outline-warning');
    newAddressBtn.classList.add('btn-warning');

    registeredBtn.classList.add('btn-outline-warning');
    registeredBtn.classList.remove('btn-warning');
}

function registeredAddress() {
    delivery.classList.remove('d-none');

    // Muestra la sección de direcciones registradas
    delivery.innerHTML = registeredAddressesContent;

    // Actualiza las clases de los botones
    registeredBtn.classList.remove('btn-outline-warning');
    registeredBtn.classList.add('btn-warning');

    newAddressBtn.classList.add('btn-outline-warning');
    newAddressBtn.classList.remove('btn-warning');
}
