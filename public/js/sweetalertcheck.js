document.getElementById("checkout-alert").addEventListener("click", function () {
  Swal.fire({
    title: "Success!",
    text: "You Have Checked Out! Its time to go home 🏠",
    icon: "success",
    confirmButtonText: "OK",
  });
});
