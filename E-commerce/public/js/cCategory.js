"use strict"

document.addEventListener("DOMContentLoaded", function() {
    const categoryForm = document.getElementById("categoryForm");
    const nombreInputCategory = document.getElementById("name");
    const nombreErrorCategory = document.getElementById("nombreErrorCategory");

    categoryForm.addEventListener("submit", function(event) {
        if (nombreInputCategory.value.trim() === "") {
            event.preventDefault();
            nombreErrorCategory.style.display = "block";
        } else {
            nombreErrorCategory.style.display = "none";
        }
    });

    nombreInputCategory.addEventListener("input", function() {
        if (nombreInputCategory.value.trim() !== "") {
            nombreErrorCategory.style.display = "none";
        }
    });
});

