document.querySelector("form").addEventListener("submit", function (event) {
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm-password");

    if (password.value !== confirmPassword.value) {
        event.preventDefault();
        alert("Passwords do not match!");
    }
});
