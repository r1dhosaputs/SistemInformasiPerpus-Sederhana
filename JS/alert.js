document.addEventListener("DOMContentLoaded", function() {
    const alertDiv = document.getElementById("myAlert");
    alertDiv.style.display = "block";

    setTimeout(function() {
        alertDiv.style.display = "none";
    }, 3000); // 3000 milidetik = 3 detik
});