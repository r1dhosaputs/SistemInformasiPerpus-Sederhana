// delete.php js
document.addEventListener("DOMContentLoaded", function () {
  var myModal = new bootstrap.Modal(document.getElementById("staticBackdrop"));
  myModal.show();
});

const closeBtnS = document.querySelectorAll("#btn-close");
closeBtnS.forEach((closeBtn) => {
  closeBtn.style.display = "none";
  closeBtn.removeAttribute("data-bs-dismiss");
  closeBtn.removeAttribute("aria-label");
  closeBtn.classList.remove("btn-close");
});


