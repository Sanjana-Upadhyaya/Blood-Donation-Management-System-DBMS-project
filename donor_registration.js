document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("donorForm");

  form.addEventListener("submit", function(event) {
    event.preventDefault();
    if (validateForm()) {
      this.submit();
    }
  });

  function validateForm() {
    const name = document.getElementById("name").value;
    const age = document.getElementById("age").value;
    const bloodType = document.getElementById("bloodType").value;
    const state = document.getElementById("state").value;
    const city = document.getElementById("city").value;
    const pincode = document.getElementById("pincode").value;
    const phoneNumber = document.getElementById("phoneNumber").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;

    if (name.trim() === "" || age.trim() === "" || bloodType.trim() === "" || state.trim() === "" || city.trim() === "" || pincode.trim() === "" || phoneNumber.trim() === "" || email.trim() === "" || password.trim() === "") {
      alert("All fields are required.");
      return false;
    }
    return true;
  }
});
