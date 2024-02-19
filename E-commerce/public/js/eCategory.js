"use strict"

// Función para validar el formulario antes de enviarlo
function validateForm(event) {
    // Obtenemos el valor del campo de nombre
    var nameInput = document.getElementById('name').value.trim();

    // Verificamos si el campo de nombre está vacío
    if (nameInput === '') {
        // Mostramos un mensaje de error y evitamos que el formulario se envíe
        document.getElementById('nameError').style.display = 'block';
        event.preventDefault(); // Evita que el formulario se envíe
    } else {
        // Si el campo de nombre no está vacío, ocultamos el mensaje de error si está visible
        document.getElementById('nameError').style.display = 'none';
    }
}

// Asignamos la función de validación al evento submit del formulario
document.getElementById('categoryForm').addEventListener('submit', validateForm);
