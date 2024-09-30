document.addEventListener("DOMContentLoaded", function() {
    const loginForm = document.getElementById("loginForm");
    const errorText = document.getElementById("error");


    loginForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Prevent the form from submitting

        // Get the values entered by the user
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        if (username === "kaikai" && password === "kai1412") {
            window.location.href = "index.html";
            alert('Login successful.');
        } else {
            errorText.textContent = "Incorrect username or password. Please try again.";
        }
    });
});


