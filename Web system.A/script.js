// JavaScript for all pages

// Function to handle registration form submission
document.getElementById('registrationForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    // Get form values
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password').value;
    // Perform validation (you can add more validation logic)
    if (username === '' || email === '' || password === '') {
        alert('Please fill in all fields.');
    } else {
        alert('Registration successful!');
        // Redirect to homepage after registration (you can change the URL)
        window.location.href = 'index.html';
    }
});

// Function to handle login form submission
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    // Get form values
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    // Perform validation (you can add more validation logic)
    if (username === '' || password === '') {
        alert('Please enter both username and password.');
    } else {
        alert('Login successful!');
        // Redirect to dashboard page after login (you can change the URL)
        window.location.href = 'dashboard.html';
    }
});

// Function to handle event booking
function bookEvent(eventId) {
    // Placeholder function for event booking (you can add actual logic here)
    alert('Event booked successfully!');
}
