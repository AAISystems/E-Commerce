document.addEventListener('DOMContentLoaded', function () {
    var addressForm = document.getElementById('addressForm');

    addressForm.addEventListener('submit', function (event) {
        if (!validateForm()) {
            event.preventDefault();
        }
    });

    function validateForm() {
        var country = document.getElementById('inputCountry').value;
        var province = document.getElementById('inputProvince').value;
        var city = document.getElementById('inputCity').value;
        var postalCode = document.getElementById('inputCP').value;
        var street = document.getElementById('inputStreet').value;
        var number = document.getElementById('inputNumber').value;
        var floor = document.getElementById('inputFloor').value;
        var door = document.getElementById('inputDoor').value;

        // Verifica que haya al menos un carácter diferente de un espacio en nombres de países
        if (!validateTextWithSpaces(country)) {
            alert('Por favor, ingresa un país válido.');
            return false;
        }

        if (!validateTextWithSpaces(province)) {
            alert('Por favor, ingresa una provincia válida.');
            return false;
        }

        if (!validateTextWithSpaces(city)) {
            alert('Por favor, ingresa una ciudad válida.');
            return false;
        }

        // Verifica que el código postal tenga exactamente 5 dígitos
        if (!validatePostalCode(postalCode)) {
            alert('Por favor, ingresa un código postal válido (5 dígitos).');
            return false;
        }

        if (!validateAlphaNumericInput(number) || number < 0) {
            alert('Por favor, ingresa un número válido.');
            return false;
        }

        if (!validateAlphaNumericInput(floor) || floor < 0) {
            alert('Por favor, ingresa un número de piso válido.');
            return false;
        }

        // Verifica que haya al menos un carácter diferente de un espacio en el nombre de la calle
        if (!validateTextWithSpacesAndSpecialChars(street)) {
            alert('Por favor, ingresa una calle válida sin caracteres especiales.');
            return false;
        }

        // Verifica que haya al menos un carácter diferente de un espacio en el nombre de la puerta
        if (!validateTextWithSpacesAndSpecialChars(door)) {
            alert('Por favor, ingresa una puerta válida sin caracteres especiales.');
            return false;
        }

        // Puedes agregar más validaciones según tus requisitos

        return true;
    }

    function validateTextWithSpaces(input) {
        // Verifica que haya al menos un carácter diferente de un espacio
        return /\S/.test(input);
    }

    function validateTextWithSpacesAndSpecialChars(input) {
        // Verifica que haya al menos un carácter diferente de un espacio y ciertos caracteres especiales
        return /^[A-Za-z0-9\sñÑáéíóúÁÉÍÓÚäëïöüÄËÏÖÜ!"·$%&/()=?¿¡^`*{}[\]\-_<>\s]+$/.test(input);
    }

    function validateAlphaNumericInput(input) {
        // Verifica que solo haya letras y números
        return /^[A-Za-z0-9]+$/.test(input);
    }

    function validatePostalCode(postalCode) {
        // Verifica que el código postal tenga exactamente 5 dígitos
        return /^\d{5}$/.test(postalCode);
    }
});
