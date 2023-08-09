//index.php js
const elements = document.querySelectorAll('#preventdefault a');

elements.forEach(element => {
        element.addEventListener('click', function(event) {
            event.preventDefault(); // Ini akan mencegah pengalihan ke URL yang ditentukan
        });
    });