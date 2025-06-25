// script.js

// Toggle Mobile Navbar
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const navLinks = document.querySelector("nav ul");

    if (menuToggle && navLinks) {
        menuToggle.addEventListener("click", () => {
            navLinks.classList.toggle("active");
        });
    }

    console.log("JavaScript Loaded Successfully");
});

// Alert Button Example
function showJoinAlert() {
    alert("Thank you for your interest in joining the Alumni Portal!");
}
